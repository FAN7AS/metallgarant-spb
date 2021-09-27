<?php

/*
 * The function within this file are theme specific: 
 * they are used only by this theme and not by the Avia Framework in general
 */

/*wordpress 3.4 changed 404 check -  this is the mod for the avia framework to operate*/
function avia_disable_404( $query = false ) {

	global $avia_config, $wp_query;
	
	if(!isset($avia_config['first_query_run']) && is_front_page() && is_paged())
	{
		$wp_query->is_paged = false;
		$avia_config['first_query_run'] = true;
		add_action( 'wp', 'avia_enable_404' );
	}
}

function avia_enable_404() {

	global $wp_query;
	$wp_query->is_paged = true;
	
}

add_action( 'pre_get_posts', 'avia_disable_404' ,1 ,10000);



//check if the portfolio item was requested by an ajax call and returns that 
if(!function_exists('avia_check_ajax_request')){

	add_action('wp_ajax_avia_check_portfolio', 'avia_check_ajax_request');
	add_action('wp_ajax_nopriv_avia_check_portfolio', 'avia_check_ajax_request');

	function avia_check_ajax_request()
	{
		if(!isset($_POST['avia_ajax_request'])) return false;
	
		global $avia_config, $more;
		$avia_config['avia_is_overview'] = false;
		
		
		$id 	= $_POST['avia_ajax_request']; 

		global $post;
		$post = get_post( $id );
		setup_postdata($post);		

		
		$more   = 0;
		$slider = new avia_slideshow($id);
		$slider -> setImageSize('fullsize');
		$sliderHTML = $slider->display();
		
		echo "<div class='ajax_slide ajax_slide_".$id."' data-slide-id='".$id."' >";
			
			echo "<div class='inner_slide'>";
			
				echo "<div class='flex_column two_third first'>";
				echo $sliderHTML;
				echo "</div>";
				
				echo "<div class='portfolio-entry one_third'>";
				echo avia_title($id, false, "");
				
				echo "<div class='entry-content'>";
				$meta = avia_portfolio_meta($id);
				if($meta)
				{
					
					echo $meta;
					echo avia_advanced_hr(false, 'hr_small');
				}
				
				//echo apply_filters('the_content',$post->post_content);
				the_content(__('Смотреть прайс','avia_framework').'<span class="more-link-arrow">  &rarr;</span>');  
				echo "</div>";
				
					
				echo "</div>";
				
			echo "</div>";
			
		echo "</div>";
		
		die();
	}
}


// filter function that allows to create greyscaled, blured or sketched thumbnails of images when a user uplaods a new image.
// If a filtered image should be created set the "copy" value in the image array at the top of functions.php
if(!function_exists('avia_image_upload_filter'))
{
	add_filter('wp_generate_attachment_metadata','avia_image_upload_filter', 10, 2);
	
	function avia_image_upload_filter($meta, $attachment_id) 
	{	

		global $avia_config;
		$quality = 90; //value between 0 and 100 for image quality
		$blur = 6; // the higher the number the stronger the blur (if blur filter is requested)
		$file = false;
		$time = false;
		$default_size_filtered = false;
		$default_filename = end(explode('/', $meta['file']));
		
		if(function_exists('imagefilter') && function_exists('getimagesize'))
		{
			
			//backup in case we need a greyscale version of an image but the image is to small
			//in that case generate default size greyscale image 
			foreach($avia_config['imgSize'] as $name => $imgSize)
			{
				if(isset($imgSize['copy']) && !isset($meta['sizes'][$name]))
				{
					$default_size_filtered = $name;
				}
			}

			foreach($avia_config['imgSize'] as $name => $imgSize)
			{
				if(isset($imgSize['copy']) && (isset($meta['sizes'][$name])  || $default_size_filtered == $name ))
				{
					if($default_size_filtered == $name)
					{
						$filename = $default_filename;
					}
					else
					{
						$filename = $meta['sizes'][$name]['file'];
					}
				
				
					if($file === false)
					{
						$this_attachment 	= get_post($attachment_id);
						$parent 			= $this_attachment->post_parent;
						if($parent) $time 	= get_post($parent)->post_date;
						$file 				= wp_upload_dir($time);
					}

					$filepath = trailingslashit($file['path']).$filename;
					list($orig_w, $orig_h, $orig_type) = @getimagesize($filepath);
					$image = wp_load_image($filepath);
					
					if(!is_resource($image))
					{
						$file 		= wp_upload_dir($this_attachment->post_date);
						$filepath 	= trailingslashit($file['path']).$filename;
						list($orig_w, $orig_h, $orig_type) = @getimagesize($filepath);
						$image 		= wp_load_image($filepath);
					}
					

					$image_blur = $blur;
					
					if(is_resource($image))
					{
						if(strpos($imgSize['copy'], 'greyscale') !== false)	{ imagefilter($image, IMG_FILTER_GRAYSCALE); }
						if(strpos($imgSize['copy'], 'blur') !== false) 		{ while($image_blur--){imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR); } imagefilter($image, IMG_FILTER_SMOOTH, $blur);  }
						if(strpos($imgSize['copy'], 'sketch') !== false) 	{ imagefilter($image, IMG_FILTER_MEAN_REMOVAL); }
						
					
	
						switch ($orig_type) {
							case IMAGETYPE_GIF:
								$filepath = str_replace(".gif", "-".$imgSize['copy'].".gif", $filepath);
								imagegif( $image, $filepath);
								break;
							case IMAGETYPE_PNG:
								$filepath = str_replace(".png", "-".$imgSize['copy'].".png", $filepath);
								imagepng( $image, $filepath, (100 - $quality) / 10);
								break;
							case IMAGETYPE_JPEG:
								$filepath = str_replace(".jpg", "-".$imgSize['copy'].".jpg", $filepath);
								$filepath = str_replace(".jpeg", "-".$imgSize['copy'].".jpeg", $filepath);
								imagejpeg( $image, $filepath, $quality);
								break;
						}
					}
					
				}
			}
		}
		else
		{
			// Could not create greyscale image, your server needs to support an Image manupulation library like GD. 
			// Please contact your provider and tell them to install the module
		}
		return $meta;
	}
}




if(!is_front_page()):
//function to retrieve the filtered copy of a wordpress generated thumbnail. For example a greyscale image
if(!function_exists('avia_get_filtered_image_copy'))
{
	function avia_get_filtered_image_copy($image, $filter)
	{
		$filetype = substr(strrchr($image,'.'),1,3);
		$image = str_replace(".".$filetype, "-".$filter.".".$filetype, $image);
		
		if(strpos($image, ' class=') === false)
		{
			$image = str_replace("/>", "class='$filter-image filtered-image' />", $image);
		}
		else
		{
			$image = str_replace("class='", "class='$filter-image filtered-image ", $image);
		}
		
		return $image;
	}
	
}
endif;			
		
//function to retrieve the additional portfolio options
if(!function_exists('avia_portfolio_meta'))
{
	function avia_portfolio_meta($id = false, $portfolio_keys = false)
	{
		if(!$id) $id = get_the_ID();
		if(!$id) return false;
		
		$output = "";
		$metas = avia_post_meta($id);
		if(!$portfolio_keys) $portfolio_keys = avia_get_option('portfolio-meta', array(array('meta'=>'Skills Needed'), array('meta'=>'Client'), array('meta'=>'Project URL')));
		
		
		$p_metas = array();
		foreach($metas as $key =>$meta)
		{
			if(strpos($key,'portfolio-meta-') !== false)
			{
				$newkey = str_replace("portfolio-meta-","",$key);
				$p_metas[$newkey-1] = $meta;
			}
		}
		
		$counter = 0;
		foreach($portfolio_keys as $key)
		{
			if(!empty($p_metas[$counter]))
			{
				//convert urls
				if(avia_portfolio_url($p_metas[$counter]))
				{
					$linktext = $p_metas[$counter];
					if(strlen($linktext) > 50) $linktext = __('Link','avia_framework');
					$p_metas[$counter] = "<a href='".$p_metas[$counter]."'>".$linktext."</a>";
				}
				
				//$output .= "<li><strong class='portfolio-meta-key'>".$key['meta'].":</strong> <div class='portfolio-meta-value'>".$p_metas[$counter]."</div></li>";
			}
			$counter++;
		}
		
		if($output) $output = "<ul class='portfolio-meta-list'>".$output."</ul>";
		return $output;
	}
}

if(!function_exists('avia_portfolio_url'))
{
	function avia_portfolio_url($url)
	{
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
	}
}



//backend filter that allows iframe use in addition to videos
if(!function_exists('avia_filter_video_insert_label_mod'))
{
	add_filter('avia_filter_video_insert_label', 'avia_filter_video_insert_label_mod');							
	function avia_filter_video_insert_label_mod($label)
	{
		$label .= '<p class="help"><br/>Working examples of Iframe content:<br/>
					You can either paste only the URL of the content you want to embed o the whole iframe with "&lt;iframe src="url/to/iframe.html" &gt;&lt;/iframe&gt;" tags.
									</p>';
		return $label;
	}
}




//call functions for the theme
add_filter('the_content_more_link', 'avia_remove_more_jump_link');
add_post_type_support('page', 'excerpt');




//allow mp4, webm and ogv file uploads
if(!function_exists('avia_upload_mimes'))
{
	add_filter('upload_mimes','avia_upload_mimes');
	function avia_upload_mimes($mimes){ return array_merge($mimes, array ('mp4' => 'video/mp4', 'ogv' => 'video/ogg', 'webm' => 'video/webm')); }
}




//change default thumbnail size on theme activation
if(!function_exists('avia_set_thumb_size'))
{
	add_action('avia_backend_theme_activation', 'avia_set_thumb_size');
	function avia_set_thumb_size() {update_option( 'thumbnail_size_h', 80 ); update_option( 'thumbnail_size_w', 80 );}
}




//remove post thumbnails from pages, posts and various custom post types
if(!function_exists('avia_remove_post_thumbnails'))
{
	add_theme_support( 'post-thumbnails' );
	
	add_action('posts_selection', 'avia_remove_post_thumbnails');
	add_action('init', 'avia_remove_post_thumbnails');
	add_filter('post_updated_messages','avia_remove_post_thumbnails');
	function avia_remove_post_thumbnails($msg) 
	{
		global $post_type;
		$remove_when = array('post','page','portfolio');

		if(is_admin())
		{
			foreach($remove_when as $remove)
			{
				if($post_type == $remove || (isset($_GET['post_type']) && $_GET['post_type'] == $remove)) { remove_theme_support( 'post-thumbnails' ); };
			}
		}
		
		return $msg;
	}
}




//advanced horizontal ruler, used in tempalte files and also in shortcodes
if(!function_exists('avia_advanced_hr'))
{
	function avia_advanced_hr($content = "", $classname = "")
	{
		$output = "";
		
		if($content) $content = "<div class='hr_content'>$content</div>";
		
		$output .= "<div class='hr $classname'>$content <span class='hr_inner'></span></div>";
		
		return $output;
	}
}




//advanced title + breadcrumb function
if(!function_exists('avia_title'))
{
	function avia_title($title = false, $subtitle = false, $class = false, $link = false)
	{
		$output	= "";
		$id = avia_get_the_id();
		if(is_numeric($title))
		{
			$id = $title;
			$title = false;
		}
		
		if($title === false) $title = get_the_title($id);
		if($subtitle  === false) $subtitle = avia_post_meta($id, 'subtitle');
		if($class === false) $class = 'stretch_full';
		if($link)
		{
			if($link === true) $link = get_permalink();
			$title = "<a href='".$link."' rel='bookmark' title='".__('Перейти к ','avia_framework')." ".$title."'>".$title."</a>";
		} 
		
		$output .= "<div class='$class title_container'>";
			$output .= '<p class="main-title">'.$title.'</p>';
		
			if($subtitle)
			{
				
				if( is_search() ){
					global $avia_config, $wp_query;
					$subtitle = "Найдено по запросу - \" " . $wp_query->query_vars['s'] . " \" - " . $wp_query->post_count . " записи." ;
				}
				//$output .= "<div class='title_meta meta-color'>";
				//$output .= wpautop($subtitle);
				//$output .= "</div>";
			}
		$output .= "</div>";
		
		return $output;
	}
}

if(!function_exists('avia_post_nav'))
{
	function avia_post_nav()
	{
		return "";
		$output = "";
		ob_start();
		?>
		<div class='post_nav_container stretch_full'>
			<div class='post_nav'>
				<div class='previous_post_link_align'>
				<?php previous_post_link('<span class="previous_post_link">&larr; %link </span><span class="post_link_text">'.__('(previous entry)','avia_framework'))."</span>"; ?>
				</div>
				<div class='next_post_link_align'>
				<?php next_post_link('<span class="next_post_link"><span class="post_link_text">'.__('(next entry)','avia_framework').'</span> %link &rarr;</span>'); ?>
				</div>
			</div> <!-- end navigation -->
		</div>
		<?php
		
		$output = ob_get_clean();
		return $output;
	}
}

if(!function_exists('avia_legacy_websave_fonts'))
{
	add_filter('avia_style_filter', 'avia_legacy_websave_fonts');

	function avia_legacy_websave_fonts($styles)
	{
		global $avia_config;

		$os_info 	= avia_get_browser(false);
		$activate	= false;
	
		if('windows' == $os_info['platform'] && avia_get_option('websave_windows') == 'active')
		{
			if($os_info['shortname'] == 'MSIE' && $os_info['mainversion'] < 9) $activate = true;
			if($os_info['shortname'] == 'Firefox' && $os_info['mainversion'] < 8) $activate = true;
			if($os_info['shortname'] == 'Opera' && $os_info['mainversion'] < 11) $activate = true;
		
			if($activate == true)
			{
				foreach ($styles as $key => $style)
				{
					if($style['key'] == 'google_webfont')
					{
						if (strpos($style['value'], '-websave') !== false)
						{
							$websave = explode(',',$style['value']);
							$websave = strtolower(" ".$websave[0]);
							$websave = str_replace('"','',$websave);
							$websave = str_replace("'",'',$websave);
							$websave = str_replace("-websave",'',$websave);
							
							$avia_config['font_stack'] .= $websave.'-websave';
						}
						
					unset($styles[$key]);
					}
				}
				
			if(empty($avia_config['font_stack'])) $avia_config['font_stack'] = 'arial-websave';
			}
		}

		return $styles;
	}
}




//creates the banner at the top of the page for notifications
if(!function_exists('avia_banner'))
{
	function avia_banner()
	{
		$output = "";
		$bannerText = avia_get_option('banner');

		if(trim($bannerText) != "")
		{
			$output .= "<div style='float:left;font-size:28px;color:#eeb90b; margin-top:20px;font-style:italic;text-shadow: 1px 1px 2px #000;'>ВСЕ И СРАЗУ!</div>"; 
			$output .= "<div class='avia_welcome_text'>";
			$output .= "<div class='infotext'>$bannerText</div>";
			$output .= "</div>";
			echo $output;
		}
	}
}


//wrap ampersands into special calss to apply special styling

if(!function_exists('avia_ampersand'))
{
	add_filter('avia_ampersand','avia_ampersand');

	function avia_ampersand($content)
	{ 
		$content = str_replace(" &amp; "," <span class='special_amp'>&amp;</span> ",$content);
		$content = str_replace(" &#038; "," <span class='special_amp'>&amp;</span> ",$content);
		
		return $content; 
	}
}



//set post excerpt to be visible on theme acivation in user backend
if(!function_exists('avia_show_menu_description'))
{
	
	add_action('avia_backend_theme_activation', 'avia_show_menu_description');
	function avia_show_menu_description()
	{
		global $current_user;
	    get_currentuserinfo();
		$old_meta_data = $meta_data = get_user_meta($current_user->ID, 'metaboxhidden_page', true);
		
		if(is_array($meta_data) && isset($meta_data[0]))
		{
			$key = array_search('postexcerpt', $meta_data);
			
			if($key !== false)
			{	
				unset($meta_data[$key]);
				update_user_meta( $current_user->ID, 'metaboxhidden_page', $meta_data, $old_meta_data );
			}
		}	
		else
		{
				update_user_meta( $current_user->ID, 'metaboxhidden_page', array('postcustom', 'commentstatusdiv', 'commentsdiv', 'slugdiv', 'authordiv', 'revisionsdiv') );
		}
	}
}


//ROISTAT CODE BEGIN
function sendToRoistat($WPCF7_ContactForm)
{
    require_once $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/coherence/roistat/Bitrix.php';
    $roistatForm = getRoistatForm($_REQUEST['_wpcf7'], $_SERVER['HTTP_REFERER']);
    $roistatForm['managerId'] = getManagerByPage($_SERVER['HTTP_REFERER']);
    $B24 = new Bitrix('metallgarant.bitrix24.ru', 34, 'i9s3wissxiipywx8');
    initDeal($roistatForm, $B24);
}
add_action("wpcf7_before_send_mail", "sendToRoistat");

/**
 * @param $roistatForm
 * @param $B24 Bitrix
 * @return bool
 */
function initDeal($roistatForm, $B24)
{
    if (!empty($roistatForm['r_fields']['phone'])) {
        $communicationType  = 'PHONE';
        $communicationField = $roistatForm['r_fields']['phone'];
    }
    if (empty($roistatForm['r_fields']['phone']) && !empty($roistatForm['r_fields']['email'])) {
        $communicationType = 'EMAIL';
        $communicationField = $roistatForm['r_fields']['email'];
    }
    if (!empty($communicationField)){
        //Поиск контакта
        $arContact = $B24->getEntityList('CONTACT', [$communicationType => $communicationField] );
        $contact = $arContact->result[0];
        if(!empty($contact->ID)){
            //Сделки контакта
            $arDealsOfContact = $B24->getEntityList('DEAL', ['CONTACT_ID' => $contact->ID]);
            if (!empty($arDealsOfContact->result[0])){
            	$openDeal = getLastOpenDeal($arDealsOfContact);
                if ( is_null( $openDeal ) ){
                    //Все сделки контакта закрыты. Новый лид с менеджером из последней сделки
                    $roistatForm['managerId'] = getLastAssignedBy($arDealsOfContact);
                    initLead($roistatForm, $B24);
                }else{
                    //Есть открытые сделки. Добавление задачи и комента в последнюю открытую сделку
                    createTaskAndAddComment(
                        2,
                        $openDeal,
                        $communicationField,
                        $roistatForm['name'],
                        $roistatForm['managerId'],
                        $B24,
                        $roistatForm['r_fields']
                    );
                }
            }else{
                //Контакт есть, сделок нет
                initLead($roistatForm, $B24);
            }
        }else{
            //Нет Контакта
            initLead($roistatForm, $B24);
        }
	}
}


function getLastOpenDeal($deals)
{
    $openDeals = [];
    foreach ($deals->result as $deal) {
        if ( in_array($deal->STAGE_ID, ['NEW', '2', '1', 'PREPAYMENT_INVOICE', 'PREPARATION', 'EXECUTING', '4', '3']) ){
            $openDeals[] = $deal;
        }
    }
    if (empty($openDeals)){
        return null;
    }else{
        return $deals->result[count($deals->result) - 1];
    }
}


//Возвращает менеджера из последней закрытой сделки
function getLastAssignedBy($deals)
{
    return $deals->result[count($deals->result) - 1]->ASSIGNED_BY_ID;
}



function initLead($roistatForm, $B24)
{
    $contactId = null;
    $lead     = [];
    if (!empty($roistatForm['r_fields']['phone'])){
    	$communicationType  = 'PHONE';
    	$communicationField = $roistatForm['r_fields']['phone'];
    }elseif( !empty($roistatForm['r_fields']['email']) ){
    	$communicationType  = 'EMAIL';
    	$communicationField = $roistatForm['r_fields']['email'];
    }else{
    	//phone and email is empty - exit
    	return true;
    }
        //Лид висит 14 дней в статусе "Не обработан" - Создание нового
        $arLongTimeLeads = $B24->search(
                'LEAD', [
                        'STATUS_ID'        => 'NEW',
                        '<DATE_MODIFY'     => gmdate("Y-m-d\TH:i:s", strtotime('-14 day')  ),
                        $communicationType => $communicationField,
                    ]
        );
        if (!empty($arLongTimeLeads[0]->ID)){
            sendToProxyLead($roistatForm, "Повторное обращение");
            return false;
        }
        //Лид висит менее 14 дней, но существует - Создание задачи
        $arLeads = $B24->search(
            'LEAD', [
                    "!STATUS_ID" 	   => "CONVERTED",
                    $communicationType => $communicationField,
                ]
        );
		if (!empty($arLeads[0]->ID) && in_array($arLeads[0]->STATUS_ID, ['NEW', 'IN_PROCESS']) ){
           createTaskAndAddComment(
                   1,
                   $arLeads[0],
                   $communicationField,
                   $roistatForm['name'],
                   $roistatForm['managerId'],
                   $B24,
                   $roistatForm['r_fields']
           );
           return false;
        }else{
            sendToProxyLead($roistatForm);
            return false;
        }
}


function sendToProxyLead($roistatForm, $title = '')
{
    //old key 'MTAyMzc1OjEwOTY0NTpmYTUxMGQyODZiNzhkMDEyOTcyYmU1YjMwZDQ5MGIxNQ==',
    $r_comment = getRoistatCommentFromForm($roistatForm['r_fields']);
    $roistatData = array(
        'roistat' => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : null,
        'key'     => 'Mjg1NDAzNDJkZWIxNTA0YTczNzQ5YjRjODQwMjk5NDU6MTA5NjQ1',
        'title'   => !empty($title) ? $title : 'Заявка с сайта',
        'comment' => !empty($r_comment) ? $r_comment : null,
        'name'    => !empty($roistatForm['r_fields']['name'])  ? $roistatForm['r_fields']['name']  : null,
        'email'   => !empty($roistatForm['r_fields']['email']) ? $roistatForm['r_fields']['email'] : null,
        'phone'   => !empty($roistatForm['r_fields']['phone']) ? $roistatForm['r_fields']['phone'] : null,
        'order_creation_method' => $roistatForm['name'],
        'is_need_check_order_in_processing' => '0',
        'fields'  => array(
            'ASSIGNED_BY_ID'    => $roistatForm['managerId'],
            'UF_CRM_1550125319' => $roistatForm['name'],
            'UF_CRM_1550127732' => "{referrer}",
            'UF_CRM_1550127745' => "{landingPage}",
            'UF_CRM_1550127756' => "{source}",
            'UF_CRM_1550127767' => "{city}",
            'UF_CRM_1550127777' => "{callee}",
            'UF_CRM_1550127792' => "{utmSource}",
            'UF_CRM_1550127873' => "{utmMedium}",
            'UF_CRM_1550127888' => "{utmCampaign}",
            'UF_CRM_1550127904' => "{utmTerm}",
            'UF_CRM_1550127920' => "{utmContent}"
        ),
    );
    file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
}


function createTaskAndAddComment($type, $entity, $communication, $form, $assigned_by, $B24, $formFields)
{
    $activityFields = array(
        'OWNER_ID'       => $entity->ID,
        'OWNER_TYPE_ID'  => $type,
        'TYPE_ID'        => 2,
        'COMMUNICATIONS' => array(
            array(
                'VALUE'          => $communication,
                'ENTITY_TYPE_ID' => 2,
                'ENTITY_ID'      => $entity->ID,
            ),
        ),
        'SUBJECT'        => "Повторная заявка от клиента({$form})",
        'START_TIME'     => date('Y-m-d H:i:s'),
        'END_TIME'       => date('Y-m-d H:i:s', time() + 10 * 60),
        'COMPLETED'      => 'N',
        'PRIORITY'       => 2,
        'RESPONSIBLE_ID' => $entity->ASSIGNED_BY_ID,//$assigned_by,
        'DIRECTION'      => 2,
    );
    $newTask = $B24->addEntity('activity', $activityFields);
    if (!empty($formFields)) {
        $roistatComment = getRoistatCommentFromForm($formFields);
        $B24->addEntity('livefeedmessage', [
            "POST_TITLE"   => "Повторная заявка",
            "MESSAGE"      => "Повторная заявка c '{$form}'"."{$roistatComment}",
            "ENTITYTYPEID" => $type,
            "ENTITYID"     => $entity->ID,
        ]);
    }
}


function getRoistatCommentFromForm($fields)
{
    $comment = "";
    $fieldsTranslate = [
        'name'     => 'Имя',
        'phone'    => 'Телефон',
        'product'  => 'Товар',
        'quantity' => 'Количество',
        'email'    => 'Почта',
        'message'  => 'Сообщение',
        'zinked'   => 'Оцинкованный/Полимерный',
        'diametr'  => '0,4мм/0,5мм/0,6мм/0,7мм/0,8мм'
    ];
    foreach ($fields as $key => $value){
        $comment.= "\n";
        $comment.= $fieldsTranslate[$key] . " : ".$value;
    }
    return $comment;
}


function getManagerByPage($referer)
{
    $managerId = 10; //default по дефолту был 26 (Глазунов), а стал 10 (Сперанский)
    $managerPages = [
    	//Указывается ID сотрудника и часть адреса страницы после https://metallgarant-spb.ru/
    	//Пример: Страница https://metallgarant-spb.ru/constr соответствует сотруднику с ID 84 
        [
            'managerId' => 84,
            'pages' => [
                '/constr',
                '/bytovki-lp',
                '/modulnyie-zdaniya',
                '/opisanie-metallicheskih-byitovok',
                '/proizvodstvo-byitovok',
                '/komplektatsiya-i-stoimost',
                '/proizvodstvo',
                '/tehnologii',
                '/shvedskaya-tehnologiya',
                '/uslugi-2',
                '/modulnyie-obshhezhitiya',
                '/shtab-stroitelstva',
                '/vnutrennyaya-otdelka',
                '/dopolnitelnoe-oborudovanie',
                '/komplektatsiya-blok-konteynera',
                '/ostanovki',
                '/metallokonstruktsii-dlya-byistrovozvodimyih-sooruzheniy',
                '/metallicheskie-fermyi',
                '/metallicheskie-kolonnyi',
                '/potolochnyie-i-stenovyie-sektsii',
                '/ramyi',
                '/stoyki-fahverka',
                '/zakladnyie-detali',
                '/fundamentnyie-boltyi',
                '/ramnyie-konstruktsii',
                '/skladskie-kompleksyi',
                '/terminalyi',
                '/traversyi',
                '/nestandartnyie-metallokonstruktsii',
                '/lestnitsyi-metallicheskie',
                '/reklamnyie-konstruktsii',
                '/metallokonstruktsii-dlya-byistrovozvodimyih-sooruzheniy',
                '/avtozapravochnyie-stantsii',
                '/avtomoyki',
                '/metallokonstruktsii-obshhestvennyih-zdaniy',
                '/torgovyie-tsentryi',
                '/veloparkovki-velostoyanki',
                '/igrovyie-kompleksyi-dlya-ploshhadok',
                '/estakadyi-galerei-pod-transporteryi',
                '/vyisotnyie-sooruzheniya',
                '/reshyotki-metallicheskie'
            ]
        ],
        [
            'managerId' => 52,
            'pages' => [
                '/krovelnye-materialy',
                '/profnastil'
            ]
        ]
    ];
    foreach ($managerPages as $managerPage){
        foreach ($managerPage['pages'] as $page) {
            if ( strripos($referer, $page) !== false ){
                return $managerPage['managerId'];
            }
        }
    }
    return $managerId;
}


function getRoistatForm($wpcf7, $referer)
{
	Logs($_REQUEST);
    $roistatForm = "Заказать";
    $forms = [
        [
            'id'   => 3869,
            'name' => 'Заказать звонок',
            'fields' => [
                [
                    'alias'     => 'phone',
                    'name'      => 'phone'
                ]
            ],
        ],
        [
        	'id' => 13521,
        	'name' => 'Оставить заявку',
        	'fields' => [
        		[
        			'alias' => 'name',
        			'name'  => 'text-262'
        		],
        		[
        			'alias' => 'phone',
        			'name'  => 'tel-403'
        		]
        	]
        ],
        [
            'id'     => 3851,
            'name'   => 'Контакты',
            'fields' => [
                [
                    'alias' => 'name',
                    'name'  => 'your-name'
                ],
                [
                    'alias' => 'phone',
                    'name'  => 'phone'
                ],
                [
                    'alias' => 'message',
                    'name'  => 'your-message'
                ]
            ],
        ],
        [
            'id'   => 5209,
            'name' => 'Оставить заявку',
            'fields' => [
                [
                    'alias' => 'name',
                    'name'  => 'your-name'
                ],
                [
                    'alias' => 'phone',
                    'name'  => 'phone'
                ]
            ]
        ],
        [
            'id'   => 9344,
            'name' => 'Оставить заявку',
            'fields' => [
                [
                    'alias'    => 'zinked',
                    'name'     => 'radio-730'
                ],
                [
                	'alias'    => 'diametr',
                    'name'     => 'radio-546'
                ],
                [
                	'alias' => 'quantity',
                	'name'  => 'number-334'
                ],
                [
                    'alias' => 'name',
                    'name'  => 'text-262'
                ],
                [
                    'alias' => 'phone',
                    'name'  => 'tel-403'
                ]
            ]
        ],
        [
            'id'   => 9595,
            'name' => 'Оставить заявку',
            'fields' => [
                [
                    'alias'    => 'zinked',
                    'name'     => 'radio-730'
                ],
                [
                	'alias'    => 'diametr',
                    'name'     => 'radio-546'
                ],
                [
                	'alias' => 'quantity',
                	'name'  => 'number-334'
                ],
                [
                    'alias' => 'name',
                    'name'  => 'text-262'
                ],
                [
                    'alias' => 'phone',
                    'name'  => 'tel-403'
                ]
            ]
        ],
        [
            'id'   => 3903,
            'name' => 'Написать письмо',
            'fields' => [
                [
                    'alias' => 'name',
                    'name'  => 'your-name'
                ],
                [
                    'alias' => 'email',
                    'name'  => 'email-476'
                ],
                [
                    'alias' => 'message',
                    'name'  => 'your-message'
                ]
            ]
        ],
        [
            'id'    => 3884,
            'variants' => [
            	[
            		'name'  => 'Заказать',
            		'pages' => [
            			'/modulnyie-obshhezhitiya',
            			'/opisanie-metallicheskih-byitovok',
            			'/proizvodstvo-byitovok',
            			'/komplektatsiya-i-stoimost',
            			'/product',
            			'/modulnyie-zdaniya/modulnye-stroeniya/',
            			'/shtab-stroitelstva',
            			'/vnutrennyaya-otdelka',
            			'/dopolnitelnoe-oborudovanie',
            			'/komplektatsiya-blok-konteynera',
            			'/constr/angaryi',
            			'/krovelnye-materialy',
            			'/profnastil',
            			'/truba-profilnaya',
            			'/general-price',
                        '/prays-na-metallokonstruktsii',
                        '/product/dostavka',
                        '/prays-na-otsinkovannuyu-produktsiyu',
                        '/prays-na-nerzhaveyushhuyu-produktsiyu',
                        '/prays-na-metallokonstruktsii'
            		],
		            'fields' => [
		                [
		                    'alias' => 'name',
		                    'name'  => 'your-name'
		                ],
		                [
		                    'alias' => 'phone',
		                    'name'  => 'mobil'
		                ],
		                [
		                    'alias' => 'product',
		                    'name'  => 'text-118'
		                ],
		                [
		                    'alias' => 'quantity',
		                    'name'  => 'number-347'
		                ],
		            ],
            	],
                [
                    'name'  => 'Узнать подробнее',
                    'pages' => ['/metalloprokat-v-kredit'],
                    'fields' => [
                        [
                            'alias' => 'name',
                            'name'  => 'your-name'
                        ],
                        [
                            'alias' => 'phone',
                            'name'  => 'mobil'
                        ],
                        [
                            'alias' => 'product',
                            'name'  => 'text-118'
                        ],
                        [
                            'alias' => 'quantity',
                            'name'  => 'number-347'
                        ],
                    ]
                ],
            ]
        ],
    ];

    foreach ($forms as $form){
        if (empty($form['variants'])){
            if($wpcf7 == $form['id']){
                $roistatForm = $form;
                break;
            }
        }else{
            foreach ($form['variants'] as $variant) {
                foreach ($variant['pages'] as $page) {
                    if ( strripos($referer, $page) !== false ){
                        $roistatForm = $variant;
                        break;
                    }
                }
            }
        }
    }
    if (!empty($roistatForm['fields'])){
        foreach ($roistatForm['fields'] as $field){
            $roistatForm['r_fields'][$field['alias']] = $_REQUEST[$field['name']];
        }
        unset($roistatForm['fields']);
    }
    if (!empty( $roistatForm['r_fields']['phone'] )){
        $roistatForm['r_fields']['phone'] = clearPhone($roistatForm['r_fields']['phone']);
    }
    Logs($roistatForm);
    return $roistatForm;
}


function clearPhone($phone)
{
    return preg_replace("/[^0-9]/", '', $phone);
}


function Logs($var)
{
    $logfile = $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/coherence/roistat/log.log';
    $mode = 'a';
    if (!file_exists($logfile)) {
        $mode = 'w+';
    }
    $f = fopen($logfile, $mode);
    fwrite($f, PHP_EOL . "###############################################################################" . PHP_EOL .
        date('Y-m-d H:i:s') . ": " . print_r($var, 1));
}
//ROISTAT CODE END



//import the dynamic frontpage template on theme installation
if(!function_exists('avia_default_dynamics'))
{
	add_action('avia_backend_theme_activation', 'avia_default_dynamics');
	add_action('avia_ajax_reset_options_page',  'avia_default_dynamics');
	
	function avia_default_dynamics() 
	{
		global $avia;
		$firstInstall = get_option($avia->option_prefix.'_dynamic_elements');

		if(empty($firstInstall))
		{
			$custom_export = "dynamic_elements";
			require_once AVIA_PHP . 'inc-avia-importer.php';
			
			if(isset($_GET['page']) && $_GET['page'] == 'templates')
			{
				wp_redirect( $_SERVER['REQUEST_URI'] );
				exit();
			}
		}
	}
}

