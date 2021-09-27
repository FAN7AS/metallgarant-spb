<?php
global $avia_config;

/* 
 * if you run a child theme and dont want to load the default functions.php file 
 * set the global var bellow in you childthemes function.php to true:
 *
 * example: global $avia_config; $avia_config['use_child_theme_functions_only'] = true;
 * The default functions.php file will then no longer be loaded. You need to make sure than
 * of course to include framework and functions that you want to use by yourself.
 *
 * This is only recommended for advanced users
 */

 if(isset($avia_config['use_child_theme_functions_only'])) return;



/*
 * wpml multi site config file
 * needs to be loaded before the framework
 */

require_once( 'config-wpml/config.php' );




##################################################################
# AVIA FRAMEWORK by Kriesi

# this include calls a file that automatically includes all 
# the files within the folder framework and therefore makes 
# all functions and classes available for later use
						
require_once( 'framework/avia_framework.php' );

##################################################################


/*
 * Register additional image thumbnail sizes 
 * Those thumbnails are generated on image upload!
 * 
 * If the size of an array was changed after an image was uploaded you either need to re-upload the image
 * or use the thumbnail regeneration plugin: http://wordpress.org/extend/plugins/regenerate-thumbnails/
 */

$avia_config['imgSize']['widget'] 			 	= array('width'=>36,  'height'=>36 );						// small preview pics eg sidebar news
$avia_config['imgSize']['slider_thumb'] 		= array('width'=>70,  'height'=>50 , 'copy'=>'greyscale');	// slideshow preview pics
$avia_config['imgSize']['fullsize'] 		 	= array('width'=>930, 'height'=>930, 'crop'=>false);		// big images for lightbox and portfolio single entries
$avia_config['imgSize']['featured'] 		 	= array('width'=>990, 'height'=>360 );						// images for fullsize pages and fullsize slider
$avia_config['imgSize']['portfolio'] 		 	= array('width'=>448, 'height'=>330, 'copy'=>'greyscale');	// images for portfolio entries (2,3 column)
$avia_config['imgSize']['portfolio_small'] 		= array('width'=>241, 'height'=>179, 'copy'=>'greyscale');	// images for portfolio 4 columns
$avia_config['imgSize']['portfolio_small_2'] 		= array('width'=>216, 'height'=>160, 'copy'=>'greyscale');	// images for portfolio 4 columns

//dynamic columns
$avia_config['imgSize']['dynamic_1'] 		 	= array('width'=>430, 'height'=>138);						// images for 2/4 (aka 1/2) dynamic portfolio columns when using 3 columns
$avia_config['imgSize']['dynamic_2'] 		 	= array('width'=>593, 'height'=>204);						// images for 2/3 dynamic portfolio columns
$avia_config['imgSize']['dynamic_3'] 		 	= array('width'=>672, 'height'=>138);						// images for 3/4 dynamic portfolio columns

avia_backend_add_thumbnail_size($avia_config);






/*
 * register the layout sizes: the written number represents the grid size, if the elemnt should not have a left margin add "alpha"
 *
 * Calculation of the with: the layout is based on a twelve column grid system, so content + sidebar must equal twelve.
 * example:  'content' => 'nine alpha',  'sidebar' => 'three'
 *
 * if the theme uses fancy blog layouts ( meta data beside the content for example) use the meta and entry values.
 * calculation of those: meta + entry = content
 *
 */
 
$avia_config['layout']['fullsize'] 		= array('content' => 'twelve alpha', 'sidebar' => 'hidden', 	'meta' => 'two alpha', 'entry' => 'ten');
$avia_config['layout']['sidebar_left'] 	= array('content' => 'eight', 		 'sidebar' => 'four alpha' ,'meta' => 'two alpha', 'entry' => 'six');
$avia_config['layout']['sidebar_right'] = array('content' => 'eight alpha',  'sidebar' => 'four', 		'meta' => 'two alpha', 'entry' => 'six');


/*
 * compat mode for easier theme switching from one avia framework theme to another
 */
add_theme_support( 'avia_post_meta_compat');  


##################################################################
# Frontend Stuff necessary for the theme:
##################################################################
/* 
 * Register theme text domain
 */
if(!function_exists('avia_lang_setup'))
{
	add_action('after_setup_theme', 'avia_lang_setup');
	function avia_lang_setup()
	{
		$lang = TEMPLATEPATH . '/lang';
		load_theme_textdomain('avia_framework', $lang);
	}
}


/* 
 * Register frontend javascripts: 
 */
if(!function_exists('avia_frontend_js'))
{
	if(!is_admin()){
		add_action('init', 'avia_frontend_js');
	}
	
	function avia_frontend_js()
	{
		wp_register_script( 'avia-default', AVIA_BASE_URL.'js/avia.js', array('jquery','avia-html5-video'), 1, false );
		wp_register_script( 'avia-prettyPhoto',  AVIA_BASE_URL.'js/prettyPhoto/js/jquery.prettyPhoto.js', 'jquery', "3.0.1", true);
		wp_register_script( 'avia-html5-video',  AVIA_BASE_URL.'js/projekktor/projekktor.min.js', 'jquery', "1", true);
		wp_register_script( 'aviapoly-slider',  AVIA_BASE_URL.'js/aviapoly2.js', 'jquery', "1.0.0", true);
		wp_register_script( 'avia-social' , AVIA_BASE_URL.'js/avia-social.js', array('jquery'), 1, true );
		wp_register_script( 'timeTo' , AVIA_BASE_URL.'js/jquery.timeTo.js', array('jquery'), 2, true );
		//wp_register_script( 'jquery-modal' , AVIA_BASE_URL.'js/jquery.modal.min.js', array('jquery'), 2, true );
		//wp_register_script( 'mask' , AVIA_BASE_URL.'js/mask.js', array('jquery'), 1, true );
	}
}






/* 
 * Activate native wordpress navigation menu and register a menu location 
 */
if(!function_exists('avia_nav_menus'))
{
	function avia_nav_menus()
	{
		add_theme_support('nav_menus');
		$avia_config['nav_menus'] = array('avia' => 'Main Menu Coherence');
		foreach($avia_config['nav_menus'] as $key => $value){ register_nav_menu($key, THEMENAME.' '.$value); }
	}
	
	avia_nav_menus(); //call the function immediatly to activate
}








/*
 *  load some frontend functions in folder include:
 */
 
require_once( 'includes/admin/register-portfolio.php' );		// register custom post types for portfolio entries
require_once( 'includes/admin/register-widget-area.php' );		// register sidebar widgets for the sidebar and footer

require_once( 'includes/admin/register-shortcodes.php' );		// register wordpress shortcodes
require_once( 'includes/loop-comments.php' );					// necessary to display the comments properly
require_once( 'includes/helper-slideshow.php' ); 				// holds the class that generates the 2d & 3d slideshows, as well as feature images
require_once( 'includes/helper-template-dynamic.php' ); 		// holds some helper functions necessary for dynamic templates
require_once( 'includes/helper-template-logic.php' ); 			// holds the template logic so the theme knows which tempaltes to use
require_once( 'includes/helper-social-media.php' ); 			// holds some helper functions necessary for twitter and facebook buttons
require_once( 'includes/helper-post-format.php' ); 				// holds actions and filter necessary for post formats
require_once( 'includes/admin/compat.php' );					// compatibility functions for 3rd party plugins
require_once( 'includes/admin/register-plugins.php');			// register the plugins we need



/*
 *  dynamic styles for front and backend
 */
if(!function_exists('avia_custom_styles'))
{
	function avia_custom_styles()
	{
		require_once( 'css/dynamic-css.php' );						// register the styles for dynamic frontend styling
	}
	
	add_action('wp_head', 'avia_custom_styles', 20);
	add_action('admin_init', 'avia_custom_styles', 20);
}




/*
 *  activate framework widgets 
 */
if(!function_exists('avia_register_avia_widgets'))
{
	function avia_register_avia_widgets()
	{
		register_widget( 'avia_tweetbox');
		register_widget( 'avia_newsbox' );
		register_widget( 'avia_portfoliobox' );
		register_widget( 'avia_socialcount' );
		register_widget( 'avia_combo_widget' );
		register_widget( 'avia_partner_widget' );
	}
	
	avia_register_avia_widgets(); //call the function immediatly to activate
}






/*
 *  add post format options
 */

add_theme_support( 'post-formats', array('link', 'quote', 'gallery','video','image' ) );  



/*
 *  add shortcode editor functions
 */

add_theme_support( 'avia-shortcodes', array('table') );  



/*
 *  register custom functions that are not related to the framework but necessary for the theme to run 
 */
 
require_once( 'functions-coherence.php');


/* Generate Quote Ticket */
function genTicketString() {
    $length = 8;
    $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters)-1)];
    }
    return $string;
}
add_shortcode('quoteticket', 'genTicketString');



function bests(){
	return '
		<div class="mybests">
						<div class="mybests-title">Наши преимущества</div>
							<table class="table-bests">
								<tr>
									<td width="70">
										<img src="/wp-content/themes/coherence/images/sertif.png" alt="">
									</td>
									<td>
										<strong>Производство и монтаж металлоконструкций сертифицирован <br>СРО № 260-29012013</strong>
									</td>
								</tr>
								<tr>
									<td><img src="/wp-content/themes/coherence/images/keys.png" alt=""></td>
									<td>
										<strong>Реализация проектов любой сложности «под ключ»:</strong><br>
										<strong>1.</strong><span class="hl"> Опытные специалисты отдела продаж решат задачи подбора необходимого сортамента;</span><br>
										<strong>2.</strong><span class="hl"> Опытные проектировщики подготовят всю необходимую проектную документацию для изготовления металлоконструкций;</span><br>
										<strong>3.</strong><span class="hl"> Собственные производственные мощности позволяют выпускать более 300 тонн изделий ежемесячно в одну смену, при необходимости выполнения срочных заказов за одни сутки формируется вторая, при необходимости третья смена.</span><br>
										<strong>4.</strong><span class="hl"> Собственный строительный отдел осуществит монтаж любого уровня сложности, также наша компания осуществляет ген подрядные работы и авторский надзор.</span>
									</td>
								</tr>
								<tr>
									<td><img src="/wp-content/themes/coherence/images/zavod.png" alt=""></td>
									<td>
										<strong>Налаженная посредством многолетнего сотрудничества сеть заводов-производителей металлопроката позволяет в короткий срок и по оптимальным ценам удовлетворять практически любой запрос клиента.</strong>
									</td>
								</tr>
								<tr>
									<td><img src="/wp-content/themes/coherence/images/cars.png" alt=""></td>
									<td>
										<strong>Собственный автопарк позволяет решать ежедневные логистические задачи и подстраиваться под нужды клиента.</strong>
									</td>
								</tr>
							</table>
					</div>
	';
}
add_shortcode('bests', 'bests');

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }           
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

function obshestroy_childrens($atts){
	  extract( shortcode_atts( array(
        'id' => ''
    ), $atts ) );


switch ($id) {
case 1:
	$posts = get_posts( array('post_type' => 'page','post_status'=> 'publish','include' => array(3303,3326,3350,3347,3344,3341,3369),'order'=> 'ASC') );
    break;
case 2:
    $posts = get_posts( array('post_type' => 'page','post_status'=> 'publish','include' => array(3184,3186),'order'=> 'ASC') );
    break;
case 3:
    $posts = get_posts( array('post_type' => 'page','post_status'=> 'publish','include' => array(3214,3300,3269,3266,3263,3260,3254,3251),'order'=> 'ASC') );
    break;
case 4:
    $posts = get_posts( array('post_type' => 'page','post_status'=> 'publish','include' => array(3248),'order'=> 'ASC') );
    break;
case 5:
    $posts = get_posts( array('post_type' => 'page','post_status'=> 'publish','include' => array(3638,3359,3356,3353),'order'=> 'ASC') );
    break;
case 6:
    $posts = get_posts( array('post_type' => 'page','post_status'=> 'publish','include' => array(3338,3329,3335),'order'=> 'ASC') );
    break;
case 7:
    $posts = get_posts( array('post_type' => 'page','post_status'=> 'publish','include' => array(3317,3314,3320),'order'=> 'ASC') );
    break;
case 8:
    $posts = get_posts( array('post_type' => 'page','post_status'=> 'publish','include' => array(3311,3365),'order'=> 'ASC') );
    break;
case 9:
    $posts = get_posts( array('post_type' => 'page','post_status'=> 'publish','include' => array(3308,3362),'order'=> 'ASC') );
    break;
case 10:
    $posts = get_posts( array('post_type' => 'page','post_status'=> 'publish','include' => array(3372),'order'=> 'ASC') );
    break;
}
//print_r($obshestroy_childrens );



foreach($posts as $post){ 


    $allposts .= '				<div data-ajax-id="1263" class="isotope-item post-entry post-entry-1263 flex_column no_margin portfolio-entry-overview portfolio-loop-1 portfolio-parity-odd prokat_sort  one_fourth  portfolio-entry-description">
					
					<div class="inner-entry">										
						<div class="slideshow_container  slide_container_small ilya">
							<ul class="slideshow fade_slider" data-autorotation="false" data-autorotation-timer="5" data-transition="fade" style="height: 160px;">
								<li data-animation="random" class="featured featured_container1 caption_right caption_right_framed caption_framed">
									<a href="' . $post->post_name. '/">'.get_the_post_thumbnail($post->ID, "portfolio_small").'</a>
								</li>
							</ul>
						</div>
						<div class="portfolio-title title_container">
							<p class="main-title">
								<a href="' . $post->post_name. '/" rel="bookmark" title="Перейти к  ' . $post->post_title . '">' . $post->post_title . '</a>
							</p>
						</div>		
					</div>		        
				
				</div>';
}
wp_reset_postdata();
return $allposts;
}
add_shortcode('obshestroy_childrens', 'obshestroy_childrens', 1);

//add_action('avia_action_query_check', 'my_main_query');

add_action('wp_ajax_nopriv_sort_main', 'my_main_query_old');
add_action('wp_ajax_sort_main', 'my_main_query_old');
function my_main_query(){
        var_dump($_POST);
	wp_die();
}

function my_main_query_old(){


		$html ="";
		$html .="<div class='portfolio-sort-container isotope' style='height: 100%;'>";
		if( $_POST['type'] ) {
			$query = new WP_Query( array(
				'posts_per_page' => -1,
				'post_type' => array(  'portfolio' ),
				'post_status' => 'publish',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_entries',
						'field' => 'id',
						'terms' => 6
					)
				),
				'meta_query' => array(
					array(
						'key'     => 'type_prokat',
						'value'   => $_POST['type'],
						'compare' => '='
					)
				)
			) );
			

		} else {
			$query = new WP_Query( array(
				'post_type' => array(  'portfolio' ),
				'post_status' => 'publish',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio_entries',
						'field' => 'id',
						'terms' => 6
					)
				),
				'posts_per_page' => -1,

			) );
		}

			while ( $query->have_posts() ) {
				$query->the_post(); ?>

<div data-ajax-id="1263" class="isotope-item post-entry post-entry-1263 flex_column no_margin portfolio-entry-overview portfolio-loop-1 portfolio-parity-odd prokat_sort  one_fourth  portfolio-entry-description">
					
					<div class="inner-entry">										
						<div class="slideshow_container  slide_container_small ilya3">
							<ul  data-autorotation="false" data-autorotation-timer="5" data-transition="fade" style="height: 160px;">
								<li data-animation="random" class="featured featured_container1 caption_right caption_right_framed caption_framed">
									<a href="<?php the_permalink();?>"><?php echo get_the_post_thumbnail($post->ID, "portfolio_small"); ?></a>
								</li>
							</ul>
						</div>
						<div class="portfolio-title title_container">
							<p class="main-title">
								<a href="<?php the_permalink();?>" rel="bookmark" ><?php the_title();?></a>
							</p>
						</div>		
					</div>		        
				
				</div>
				
			<?php  }
			$html .= $title;
			$html .= "</div>";
		echo $html;

	wp_die();
}


add_action('init', 'my_custom_init');
function my_custom_init()
{
 $labels = array(
	'name' => 'Цветной металлопрокат', // Основное название типа записи
	'singular_name' => 'Цветной металлопрокат', // отдельное название записи типа Book
	'add_new' => 'Добавить',
	'add_new_item' => 'Добавить новый цвет. мет.',
	'edit_item' => 'Редактировать цвет. мет.',
	'new_item' => 'Новая цвет. мет.',
	'view_item' => 'Посмотреть цвет. мет.',
	'search_items' => 'Найти цвет. мет.',
	'not_found' =>  'Цвет. мет. не найдено',
	'not_found_in_trash' => 'В корзине цвет. мет. не найдено',
	'parent_item_colon' => '',
	'menu_name' => 'Цветной металлопрокат'

  );
  $args = array(
	'labels' => $labels,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'tsvetnoy-metalloprokat', 'with_front'=> true ),
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => false,
	'menu_position' => null,
	'supports' => array('title','editor','author','thumbnail','excerpt','comments'),

  );
  register_post_type('metalloprokat', $args);
	
	$labels_project = array(
	'name' => 'Проект', // Основное название типа записи
	'singular_name' => 'Проекты', // отдельное название записи типа Book
	'add_new' => 'Добавить',
	'add_new_item' => 'Добавить новый проект',
	'edit_item' => 'Редактировать проект',
	'new_item' => 'Новый проект',
	'view_item' => 'Посмотреть проект',
	'search_items' => 'Найти проект',
	'not_found' =>  'Проект не найден',
	'not_found_in_trash' => 'В корзине проектов не найдено',
	'parent_item_colon' => '',
	'menu_name' => 'Проекты'

  );
  $args_project = array(
	'labels' => $labels_project,
	'public' => true,
	'publicly_queryable' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'project', 'with_front'=> true ),
	'capability_type' => 'post',
	'has_archive' => true,
	'hierarchical' => true,
	'menu_position' => null,
	'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes', 'post-formats'),

  );
  register_post_type('project', $args_project);
}


function register_my_widgets(){
	register_sidebar( array(
		'name' => 'Сайдбар цвет. мет.',
		'id' => "sidebar-$i",
		'description' => '',
		'class' => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => "</li>\n",
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => "</h2>\n",
	) );
}
function show_banner(){
	echo '<img src="http://metallgarant-spb.ru/wp-content/uploads/2018/02/skuvshe.jpg" alt="" style="float:right; margin: 0 0 30px 30px; width: 290px !important; cursor: pointer;" class="java_link2" onclick="window.location.href = \'/metalloprokat-v-kredit/\'">';
}

function show_table(){
	?>
<div class="price_table">

<?php
			$meta = avia_portfolio_meta(get_the_ID());
			if($meta)
			{
				echo $meta;
				echo avia_advanced_hr(false, 'small');
			}
			$price_id = avia_post_meta($id, 'price');
			$get_table = tablepress_get_table("id=$price_id" );
			$pos      = strripos($get_table, "not found");
			
			
			
			if($pos > 0 || $price_id == 1):
			else:
				tablepress_print_table( "id=$price_id" );
			endif;
			
			/*the_content(__('Посмотреть цены','avia_framework').'<span class="more-link-arrow"> &rarr;</span>');*/
			if(has_tag() && is_single())
			{
				echo '<span class="text-sep">/</span><span class="blog-tags minor-meta">';
				echo the_tags('<strong>'.__('Tags: ','avia_framework').'</strong><span>');
				echo '</span></span>';
			}
	
			?>
</div>


	<?
}
//add_action( 'widgets_init', 'register_my_widgets' );


//Не работает сайт некоторое время
global $spNotAvaible;

if(empty($_COOKIE['spAvaibleN'])){
    setcookie("spAvaibleN", true);
    $spNotAvaible = true;
} else {
    $spNotAvaible = false;
}





//Дополнение к плагину sitemap xml generator
function sitemapChange(&$sitemap) {
	$types = array('portfolio','metalloprokat');

	foreach ($types as $item) {
		$args = array(
			'post_type' => $item,
			'posts_per_page' => -1,
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {

			while ( $query->have_posts() ) {
				$query->the_post();
				$date = get_the_modified_date('Y-m-d');
				$link = get_permalink();
				$priority = 0.8;

				$sitemap->write($link, $date, 'daily', $priority);
			}
			wp_reset_postdata();
		}
	}
}
add_action('xml_sitemaps', 'sitemapChange');


function prevLinkChange($link){
	$id = get_the_ID();
	if($id==1381){
		return "<link rel='prev' title='Цветной металлопрокат' href='http://metallgarant-spb.ru/tsvetnoy-metalloprokat/' />";
	} else return $link;
}
add_action('previous_post_rel_link', 'prevLinkChange');

function nextLinkChange($link){
	$id = get_the_ID();
	if($id==1378){
		return "<link rel='next' title='Цветной металлопрокат' href='http://metallgarant-spb.ru/tsvetnoy-metalloprokat/' />";
	} else return $link;
}
add_action('next_post_rel_link', 'nextLinkChange');

add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );
add_action( 'elementor/frontend/after_enqueue_styles', function () { wp_dequeue_style( 'font-awesome' ); } );
add_action( 'elementor/frontend/after_enqueue_styles', function() { wp_dequeue_style( 'elementor-icons' ); } );

//Contact Form 7 в Bitrix24
//Вызываем функцию для перехвата данных
add_action( 'wpcf7_mail_sent', 'your_wpcf7_mail_sent_function' );
function your_wpcf7_mail_sent_function( $contact_form ) {
 
   //подключение к серверу CRM
   define('CRM_HOST', 'crm.metallgarant-spb.ru'); // Ваш домен CRM системы
   define('CRM_PORT', '443'); // Порт сервера CRM. Установлен по умолчанию
   define('CRM_PATH', '/crm/configs/import/lead.php'); // Путь к компоненту lead.rest
 
   //авторизация в CRM
   define('CRM_LOGIN', 'pethkin'); // Логин пользователя Вашей CRM по управлению лидами
   define('CRM_PASSWORD', 'P1K4tHuK4'); // Пароль пользователя Вашей CRM по управлению лидами
 
   //перехват данных из Contact Form 7
   $title = $contact_form->title;
   $posted_data = $contact_form->posted_data;
   if ('Контакты' == $title ) { //Вместо "Контактная форма 1" необходимо указать название Вашей контактной формы
       $submission = WPCF7_Submission::get_instance();
       $posted_data = $submission->get_posted_data();
       //далее мы перехватывает введенные данные в Contact Form 7
       $firstName = $posted_data['your-name']; //перехватываем поле [your-name]
       $message = $posted_data['your-message']; //перехватываем поле [your-message]
	   $myphone = $posted_data['phone'];
 
       //сопостановление полей Bitrix24 с полученными данными из Contact Form 7
       $postData = array(
          'TITLE' => 'Лид с формы контакты', // Установить значение свое значение
          'NAME' => $firstName,
          'COMMENTS' => $message,
		  'PHONE_WORK' => $myphone
       );
 
       //передача данных из Contact Form 7 в Bitrix24
       if (defined('CRM_AUTH')) {
          $postData['AUTH'] = CRM_AUTH;
       } else {
          $postData['LOGIN'] = CRM_LOGIN;
          $postData['PASSWORD'] = CRM_PASSWORD;
       }
 
       $fp = fsockopen("ssl://".CRM_HOST, CRM_PORT, $errno, $errstr, 30);
       if ($fp) {
          $strPostData = '';
          foreach ($postData as $key => $value)
             $strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);
 
          $str = "POST ".CRM_PATH." HTTP/1.0\r\n";
          $str .= "Host: ".CRM_HOST."\r\n";
          $str .= "Content-Type: application/x-www-form-urlencoded\r\n";
          $str .= "Content-Length: ".strlen($strPostData)."\r\n";
          $str .= "Connection: close\r\n\r\n";
 
          $str .= $strPostData;
 
          fwrite($fp, $str);
 
          $result = '';
          while (!feof($fp))
          {
             $result .= fgets($fp, 128);
          }
          fclose($fp);
 
          $response = explode("\r\n\r\n", $result);
 
          $output = '<pre>'.print_r($response[1], 1).'</pre>';
       } else {
          echo 'Connection Failed! '.$errstr.' ('.$errno.')';}
    }
 
}