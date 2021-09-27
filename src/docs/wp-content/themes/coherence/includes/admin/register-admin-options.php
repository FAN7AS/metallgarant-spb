<?php


//avia pages holds the data necessary for backend page creation
$avia_pages = array( 
	
	array( 'slug' => 'avia', 		'parent'=>'avia', 'icon'=>"hammer_screwdriver.png" , 	'title' =>  'Theme Options' ),
	array( 'slug' => 'styling', 	'parent'=>'avia', 'icon'=>"palette.png", 				'title' =>  'Styling'  ),
	array( 'slug' => 'layout', 		'parent'=>'avia', 'icon'=>"blueprint_horizontal.png", 	'title' =>  'Layout &amp; Settings'  ),
	array( 'slug' => 'portfolio', 	'parent'=>'avia', 'icon'=>"photo_album.png" , 			'title' =>  'Portfolio' ),
	array( 'slug' => 'contact', 	'parent'=>'avia', 'icon'=>"book_addresses.png" , 		'title' =>  'Contact' ),
	array( 'slug' => 'sidebar', 	'parent'=>'avia', 'icon'=>"layout_select_sidebar.png", 	'title' =>  'Sidebar'  ),
	array( 'slug' => 'footer', 		'parent'=>'avia', 'icon'=>"layout_select_footer.png", 	'title' =>  'Footer'  ),
	array( 'slug' => 'templates', 	'parent'=>'templates','icon'=>"page_white_wrench.png", 	'title' =>  'Template Builder'  ),
	array( 'slug' => 'frontpage', 	'parent'=>'templates','icon'=>"layout_header_footer_3_mix.png", 	'title' =>  'Frontpage', 'sortable' => 'avia_sortable'  )
					 
);





/*Frontpage Settings*/


					
/*$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Import Dummy Content: Posts, Pages, Categories",
					"desc" 	=> "If you are new to wordpress or have problems creating posts or pages that look like the theme preview you can import dummy posts and pages here that will definitley help to understand how those tasks are done.",
					"id" 	=> "import",
					"type" 	=> "import"); */
	
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Frontpage Settings",
					"desc" 	=> "Select which page to display on your Frontpage. If left blank the Blog will be displayed",
					"id" 	=> "frontpage",
					"type" 	=> "select",
					"subtype" => 'page');
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "And where do you want to display the Blog?",
					"desc" 	=> "Select which page to display as your Blog Page. If left blank no blog will be displayed",
					"id" 	=> "blogpage",
					"type" 	=> "select",
					"subtype" => 'page',
					"required" => array('frontpage','{true}')
					);
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Logo",
					"desc" 	=> "Upload a logo image, or enter the URL to an image if its already uploaded. The themes default logo gets applied if the input field is left blank<br/>Logo Dimension: 200px * 100px (if your logo is larger you might need to modify style.css to align it perfectly)",
					"id" 	=> "logo",
					"type" 	=> "upload",
					"label"	=> "Use Image as logo");
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Favicon",
					"desc" 	=> "Specify a <a href='http://en.wikipedia.org/wiki/Favicon'>favicon</a> for your site. <br/>Accepted formats: .ico, .png, .gif",
					"id" 	=> "favicon",
					"type" 	=> "upload",
					"label"	=> "Use Image as Favicon");
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Top Welcome Message",
					"desc" 	=> "Enter a short welcome message or any other text that appears at the top of your site.",
					"id" 	=> "banner",
					"std" 	=> "Call us now: 555-34534",
					"type" 	=> "textarea"
					);
					
					
$avia_elements[] =	array(
					"type" 			=> "group", 
					"id" 			=> "social_icons", 
					"slug"			=> "avia",
					"linktext" 		=> "Add another social icon",
					"deletetext" 	=> "Remove icon",
					"blank" 		=> true, 
					"nodescription" => true,
					"std"			=> array(
										array('social_icon'=>'twitter', 'social_icon_link'=>'http://twitter.com/kriesi'),
										array('social_icon'=>'dribbble', 'social_icon_link'=>'http://dribbble.com/kriesi'),
										array('social_icon'=>'rss', 'social_icon_link'=>''),
										),
					'subelements' 	=> array(	
	
							array(	
								"name" 	=> "Social Icon",
								"desc" 	=> "",
								"id" 	=> "social_icon",
								"type" 	=> "select",
								"slug"	=> "sidebar",
								"class" => "av_2columns av_col_1",
								"subtype" => array(
								
									'Behance' 	=> 'behance',
									'Dribbble' 	=> 'dribbble',
									'Facebook' 	=> 'facebook',
									'Flickr' 	=> 'flickr',
									'Forrst' 	=> 'forrst',
									'Google Plus' => 'gplus',
									'LinkedIn' 	=> 'linkedin',
									'Myspace' 	=> 'myspace',
									'Tumblr' 	=> 'tumblr',
									'Twitter' 	=> 'twitter',
									'Vimeo' 	=> 'vimeo',
									'Youtube' 	=> 'youtube',
									'Special: Feedburner RSS (add Feedburner URL, leave blank if you want to use default WordPress RSS feed)' => 'rss',
									'Special: Email Icon (add URL to a contact form, leave blank if you want to use this Sites contact form)' => 'mail',
								
								)),	
								
							array(	
								"name" 	=> "Social Icon URL:",
								"desc" 	=> "",
								"id" 	=> "social_icon_link",
								"type" 	=> "text",
								"slug"	=> "sidebar",
								"class" => "av_2columns av_col_2"),			           
						        )   
						);					

			
					
$avia_elements[] =	array(	
					"slug"	=> "avia",
					"name" 	=> "Google Analytics Tracking Code",
					"desc" 	=> "Enter your Google analytics tracking Code here. It will automatically be added to the themes footer so google can track your visitors behaviour.",
					"id" 	=> "analytics",
					"type" 	=> "textarea"
					);
			

/*Styling Settings*/
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"id" 	=> "default_slideshow_target",
					"type" 	=> "target",
					"std" 	=> "
					<style type='text/css'>
						.live_bg_wrap_top{border-bottom:20px solid; position:relative; top:-12px; width:150px;)}
						.live_bg_default{border:1px solid; }
						.live_bg, .live_bg_default{padding:10px;}
						.live_bg_wrap{ padding:4%; background:#f8f8f8; overflow:hidden; border:1px solid #e1e1e1; background-position: top center;}
						.live_bg_default{background:#transparent; color:#777;}
						.live_bg_default h3{font-size:30px;}
						.live_bg_highlight{height:20px; line-height:20px; padding:5px; border:1px solid;}
						.live_bg_default{}
						.live_bg_socket{height:20px; line-height:20px; padding:10px; clear:both;}
						.live_bg_small{font-size:10px; color:#999;}
						.avia_google_font{  font-weight:normal; } 
						div .link_controller_list a{ width:81px; font-size:11px;}
						#avia_preview .webfont_google_webfont{  font-weight:normal; } 
						.webfont_default_font{  font-weight:normal; font-size:13px; line-height:1.7em;} 
						
					</style>
					<small class='live_bg_small'>A rough preview of the frontend.</small>
					
					<div id='avia_preview' class='live_bg_wrap webfont_default_font'>
						<div class='live_bg_wrap_top'></div>
						<div class='live_bg_socket'>Header Text</div>
						<div class='live_bg_default'>
							<h3 class='webfont_google_webfont'>Demo heading</h3>
							<p>This is default content with a default heading. Font color and text are set based on the skin you choose above. Headings and link colors can be choosen below. <br/> 
								<a class='a_link' href='#'>A link</a>  
								<a class='an_activelink' href='#'>A hovered link</a>
							</p>
							
							<div class='live_bg_highlight'>Highlight Background + Border Color</div>
						</div>
					
						<div class='live_bg'>
							<h3>Demo heading (Footer)</h3>
							<p>This is text on the footer background</p>
							<!--, as for example in your footer.</p><p>Text and <a href='#'>links</a> got the same color, headings are a little lighter</p>-->
						</div>
						
						<div class='live_bg_socket'>Socket Text</div>
					</div>
					
					",
					"nodescription" => true
					);	
					
					

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Select a predefined color scheme",
					"desc" 	=> "Choose a predefined color scheme here. You can edit the settings of the scheme bellow then.",
					"id" 	=> "color_scheme",
					"type" 	=> "link_controller",
					"std" 	=> "",
					"class"	=> "link_controller_list",
					"subtype" => array(
															
										'Purple Grunge' => array(	
															'style'=>'background-color:#94315d;',
															'default_font' => 'Open Sans',
															'google_webfont' => 'Open Sans',
															'color_scheme'	=>'Purple Grunge',
															'bg_color'		=>'#333333',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#777777',
															'border'		=>'#e1e1e1',
															'primary'		=>'#94315d',
															'highlight'		=>'#c75086',
															'footer_bg'		=>'#f8f8f8',
															'footer_font'	=>'#666666',
															'socket_bg'		=>'#111111',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/grunge-light.png',																		
															'bg_image_custom' => '',
															'bg_image_position' => 'center',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),	
						
										'Blue' => array(	
															'style'=>'background-color:#2d5c88;',
															'default_font' => 'Open Sans',
															'google_webfont' => 'Open Sans',
															'color_scheme'	=>'',
															'bg_color'		=>'#444444',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#2d5c88',
															'highlight'		=>'#4686c2',
															'footer_bg'		=>'#111111',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#111111',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),
										
										'Purple' => array(	
															'style'=>'background-color:#46424f;',
															'default_font' => 'Open Sans',
															'google_webfont' => 'Open Sans',
															'color_scheme'	=>'Purple',
															'bg_color'		=>'#333333',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#46424f',
															'highlight'		=>'#6b5c8c',
															'footer_bg'		=>'#46424f',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#201e24',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),
															
										'Green' => array(	
															'style'=>'background-color:#719430;',
															'default_font' => 'Droid Sans',
															'google_webfont' => 'Open Sans',
															'color_scheme'	=>'Green',
															'bg_color'		=>'#333333',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#719430',
															'highlight'		=>'#8bba34',
															'footer_bg'		=>'#415719',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#181f0b',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),
															
										'Orange' => array(	
															'style'=>'background-color:#f0b70c;',
															'default_font' => 'Open Sans',
															'google_webfont' => 'Oswald',
															'color_scheme'	=>'Orange',
															'bg_color'		=>'#555555',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#f0b70c',
															'highlight'		=>'#edc756',
															'footer_bg'		=>'#333333',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#222222',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),
										'Cyan' => array(	
															'style'=>'background-color:#2997ab;',
															'default_font' => 'Arial-websave',
															'google_webfont' => 'Terminal Dosis',
															'color_scheme'	=>'Cyan',
															'bg_color'		=>'#333333',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#2997ab',
															'highlight'		=>'#23b5cf',
															'footer_bg'		=>'#f8f8f8',
															'footer_font'	=>'#8a8a8a',
															'socket_bg'		=>'#0e343b',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),
										'Red' => array(	
															'style'=>'background-color:#a81010;',
															'default_font' => 'Arial-websave',
															'google_webfont' => 'Terminal Dosis',
															'color_scheme'	=>'Red',
															'bg_color'		=>'#170b0b',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#a81010',
															'highlight'		=>'#eb3b3b',
															'footer_bg'		=>'#000000',
															'footer_font'	=>'#8a8a8a',
															'socket_bg'		=>'#420b0b',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),	
										
										'Black' => array(	
															'style'=>'background-color:#000000;',
															'default_font' => 'Open Sans',
															'google_webfont' => 'Open Sans',
															'color_scheme'	=>'Black',
															'bg_color'		=>'#333333',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#000000',
															'highlight'		=>'#23b5cf',
															'footer_bg'		=>'#222222',
															'footer_font'	=>'#8a8a8a',
															'socket_bg'		=>'#000000',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>'',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),					
															
										'Striped Cyan' => array(	
															'style'=>'background-color:#2997ab;',
															'default_font' => 'Arial-websave',
															'google_webfont' => 'Terminal Dosis',
															'color_scheme'	=>'Striped Cyan',
															'bg_color'		=>'#111111',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#2997ab',
															'highlight'		=>'#23b5cf',
															'footer_bg'		=>'#0b3e47',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#0c2b30',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/diagonal-bold-light.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),
											
										'Light Grey' => array(	
															'style'=>'background-color:#999999;',
															'default_font' => 'Arial-websave',
															'google_webfont' => 'Metrophobic',
															'color_scheme'	=>'Light Grey',
															'bg_color'		=>'#555555',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#333333',
															'highlight'		=>'#ffa200',
															'footer_bg'		=>'#f8f8f8',
															'footer_font'	=>'#666666',
															'socket_bg'		=>'#333333',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/dots-for-dark-background.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),
										
										'Pink' => array(	
															'style'=>'background-color:#c71c77;',
															'default_font' => 'Arial-websave',
															'google_webfont' => 'Coustard',
															'color_scheme'	=>'Pink',
															'bg_color'		=>'#222222',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#c71c77',
															'highlight'		=>'#eb419c',
															'footer_bg'		=>'#222222',
															'footer_font'	=>'#aaaaaa',
															'socket_bg'		=>'#c71c77',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/grunge-light.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),
															
										'Lime' => array(	
															'style'=>'background-color:#aec71e;',
															'default_font' => 'Open Sans',
															'google_webfont' => 'Open Sans',
															'color_scheme'	=>'Lime',
															'bg_color'		=>'#333333',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#aec71e',
															'highlight'		=>'#becf50',
															'footer_bg'		=>'#222222',
															'footer_font'	=>'#aaaaaa',
															'socket_bg'		=>'#222222',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/dots-mini-light.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),
															
										'Wood' => array(	
															'style'=>'background-color:#2e1f06;',
															'default_font' => 'Arial-websave',
															'google_webfont' => 'Open Sans',
															'color_scheme'	=>'Wood',
															'bg_color'		=>'#2e1f06',
															'bg_highlight'	=>'#ebdecd',
															'body_font'		=>'#423114',
															'border'		=>'#e8d8c3',
															'primary'		=>'#3d2b0d',
															'highlight'		=>'#ff8c00',
															'footer_bg'		=>'#1f170b',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#3d2b0d',
															'socket_font'	=>'#ebdecd',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/wood-light.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),
										
										'Navy' => array(	
															'style'=>'background-color:#435960;',
															'default_font' => 'Arial-websave',
															'google_webfont' => 'Terminal Dosis',
															'color_scheme'	=>'Navy',
															'bg_color'		=>'#333333',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#29383d',
															'border'		=>'#e1e1e1',
															'primary'		=>'#435960',
															'highlight'		=>'#749aa6',
															'footer_bg'		=>'#222829',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#435960',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/dashed-cross-light.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),
															
										'Teal' => array(	
															'style'=>'background-color:#43605b;',
															'default_font' => 'Open Sans',
															'google_webfont' => 'Open Sans',
															'color_scheme'	=>'Teal',
															'bg_color'		=>'#333333',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#22302d',
															'border'		=>'#e1e1e1',
															'primary'		=>'#43605b',
															'highlight'		=>'#749aa6',
															'footer_bg'		=>'#283b38',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#43605b',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/floral-light.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),	
															
										'Dark' => array(	
															'style'=>'background-color:#222222;',
															'default_font' => 'Arial-websave',
															'google_webfont' => 'Metrophobic',
															'color_scheme'	=>'Dark',
															'bg_color'		=>'#444444',
															'bg_highlight'	=>'#333333',
															'body_font'		=>'#cccccc',
															'border'		=>'#444444',
															'primary'		=>'#e8c517',
															'highlight'		=>'#ffd519',
															'footer_bg'		=>'#111111',
															'footer_font'	=>'#666666',
															'socket_bg'		=>'#333333',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/grunge-big-light.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#222222',
															),	
																			
										'Striped Green' => array(	
															'style'=>'background-color:#719430;',
															'default_font' => 'Arial-websave',
															'google_webfont' => 'Mate SC',
															'color_scheme'	=>'Striped Green',
															'bg_color'		=>'#f3f5f1',
															'bg_highlight'	=>'#e6eddf',
															'body_font'		=>'#25330b',
															'border'		=>'#dfe6d8',
															'primary'		=>'#719430',
															'highlight'		=>'#8bba34',
															'footer_bg'		=>'#415719',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#2a3810',
															'socket_font'	=>'#7a8568',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/wool-diagonal-for-light-background.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),	
										
										'Noisy Blue' => array(	
															'style'=>'background-color:#1a324b;',
															'default_font' => 'Arial-websave',
															'google_webfont' => 'Open Sans',
															'color_scheme'	=>'Noisy Blue',
															'bg_color'		=>'#f2f5fa',
															'bg_highlight'	=>'#dfe6f0',
															'body_font'		=>'#102438',
															'border'		=>'#d1def0',
															'primary'		=>'#1a324b',
															'highlight'		=>'#2a4a69',
															'footer_bg'		=>'#2a4a69',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#1a324b',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/noise-for-light-background.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),	
															
										'Dirty Brown' => array(	
															'style'=>'background-color:#2f2522;',
															'default_font' => 'Arial-websave',
															'google_webfont' => 'Cardo',
															'color_scheme'	=>'Dirty Brown',
															'bg_color'		=>'#e9e2db',
															'bg_highlight'	=>'#e0d6cd',
															'body_font'		=>'#2f2522',
															'border'		=>'#d4c5b9',
															'primary'		=>'#2f2522',
															'highlight'		=>'#544743',
															'footer_bg'		=>'#2f2522',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#3d302c',
															'socket_font'	=>'#d4c9c5',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/linen-for-light-background.png',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),	
															
										'Pink Dark' => array(	
															'style'=>'background-color:#e6177b;',
															'default_font' => 'Open Sans',
															'google_webfont' => 'Open Sans',
															'color_scheme'	=>'Pink Dark',
															'bg_color'		=>'#666666',
															'bg_highlight'	=>'#333333',
															'body_font'		=>'#ffffff',
															'border'		=>'#444444',
															'primary'		=>'#e6177b',
															'highlight'		=>'#f0529e',
															'footer_bg'		=>'#111111',
															'footer_font'	=>'#666666',
															'socket_bg'		=>'#000000',
															'socket_font'	=>'#ffffff',
															'bg_image'=> '',
															'bg_image_custom' => '',
															'bg_image_position' => 'left',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#111111',
															),				
										'Wine' => array(	
															'style'=>'background-color:#4f0627;',
															'default_font' => 'Open Sans',
															'google_webfont' => 'Open Sans',
															'color_scheme'	=>'Wine',
															'bg_color'		=>'#000000',
															'bg_highlight'	=>'#f8f8f8',
															'body_font'		=>'#666666',
															'border'		=>'#e1e1e1',
															'primary'		=>'#4f0627',
															'highlight'		=>'#801b4a',
															'footer_bg'		=>'#3b2d33',
															'footer_font'	=>'#ffffff',
															'socket_bg'		=>'#240412',
															'socket_font'	=>'#ffffff',
															'bg_image'		=>AVIA_BASE_URL.'images/background-images/floral-light.png',																		
															'bg_image_custom' => '',
															'bg_image_position' => 'center',
															'bg_image_repeat'=>'repeat',
															'bg_image_attachment'=>'fixed',
															'boxed'			=>'boxed',
															'bg_color_boxed'=>'#ffffff',
															),	
														
																	   
					));
	


$avia_elements[] =	array(	"name" 	=> "Heading Font",
							"slug"	=> "styling",
							"desc" 	=> "The Font heading utilizes google fonts and allows you to use a wide range of custom fonts for your headings",
				            "id" 	=> "google_webfont",
				            "type" 	=> "select",
				            "no_first" => true,
				            "class" => "av_2columns av_col_1",
				            "onchange" => "avia_add_google_font",
				            "std" 	=> "Open Sans",
				            "subtype" => array(	'no custom font'=>'',
				            
				            					'Alice'=>'Alice',
				            					'Allerta'=>'Allerta',
				            					'Arvo'=>'Arvo',
				            					'Antic'=>'Antic',
				            
				            					'Bangers'=>'Bangers',
				            					'Bitter'=>'Bitter',
				            					
				            					'Cabin'=>'Cabin',
				            					'Cardo'=>'Cardo',
				            					'Carme'=>'Carme',
				            					'Coda'=>'Coda',
				            					'Coustard'=>'Coustard',
				            					'Gruppo'=>'Gruppo',

				            					'Damion'=>'Damion',
				            					'Dancing Script'=>'Dancing Script',
				            					'Droid Sans'=>'Droid Sans',
				            					'Droid Serif'=>'Droid Serif',
				            					
				            					'EB Garamond'=>'EB Garamond',
				            					
				            					'Fjord One'=>'Fjord One',
				            					
				            					'Inconsolata'=>'Inconsolata',
				            					
				            					'Josefin Sans' => 'Josefin Sans',
				            					'Josefin Slab'=>'Josefin Slab',
				            					
				            					'Kameron'=>'Kameron',
				            					'Kreon'=>'Kreon',
				            					
				            					'Lobster'=>'Lobster',
				            					'League Script'=>'League Script',

				            					'Mate SC'=>'Mate SC',
				            					'Mako'=>'Mako',
				            					'Merriweather'=>'Merriweather',
				            					'Metrophobic'=>'Metrophobic',
				            					'Molengo'=>'Molengo',
				            					'Muli'=>'Muli',

				            					'Nobile'=>'Nobile',
				            					'News Cycle'=>'News Cycle',

				            					'Open Sans'=>'Open Sans',
				            					'Orbitron'=>'Orbitron',
				            					'Oswald'=>'Oswald',
				            					
				            					'Pacifico'=>'Pacifico',
				            					'Poly'=>'Poly',
				            					'Podkova'=>'Podkova',

				            					'Quattrocento'=>'Quattrocento',
				            					'Questrial'=>'Questrial',
				            					'Quicksand'=>'Quicksand',
				            					
				            					'Raleway'=>'Raleway',

				            					'Salsa'=>'Salsa',
				            					'Sunshiney'=>'Sunshiney',
				            					'Signika Negative'=>'Signika Negative',


				            					'Tangerine'=>'Tangerine',
				            					'Terminal Dosis'=>'Terminal Dosis',
				            					'Tenor Sans'=>'Tenor Sans',

				            					'Varela Round'=>'Varela Round',
				            					
				            					'Yellowtail'=>'Yellowtail',

				            					
				            					));
				            					
$avia_elements[] =	array(	"name" 	=> "Defines the Font for your body text",
							"slug"	=> "styling",
							"desc" 	=> "Choose between web save fonts (faster rendering) and google webkit fonts (more unqiue)",
				            "id" 	=> "default_font",
				            "type" 	=> "select",
				            "no_first" => true,
				            "class" => "av_2columns av_col_2",
				            "onchange" => "avia_add_google_font",
				            "std" 	=> "Helvetica-Neue,Helvetica-websave",
				            "subtype" => array(	':: :: Web save fonts :: ::'=>'',
				            					'Arial'=>'Arial-websave',
				            					'Georgia'=>'Georgia-websave',
				            					'Verdana'=>'Verdana-websave',
				            					'Helvetica'=>'Helvetica-websave',
				            					'Helvetica Neue'=>'Helvetica-Neue,Helvetica-websave',
				            					'Lucida'=>'"Lucida-Sans",-"Lucida-Grande",-"Lucida-Sans-Unicode-websave"',
				            					':: :: Google fonts :: ::'=>'',
				            					'Arimo'=>'Arimo',
				            					'Cardo'=>'Cardo',
				            					'Droid Sans'=>'Droid Sans',
				            					'Droid Serif'=>'Droid Serif',
				            					'Kameron'=>'Kameron',
				            					'Maven Pro'=>'Maven Pro',
				            					'Open Sans'=>'Open Sans',
				            					'Lora'=>'Lora',
				            					
				            					));				            					
				            					

/*
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Use stretched or boxed layout?",
					"desc" 	=> "The stretched layout expands from the left side of the viewport to the right.",
					"id" 	=> "boxed",
					"type" 	=> "select",
					"std" 	=> "stretched",
					"no_first"=>true,
					"class" => "av_2columns av_col_1",
					"subtype" => array('Stretched layout'=>'stretched','Boxed Layout'=>'boxed'));
*/
					

	
$avia_elements[] =	array(	"slug"	=> "styling", "type" => "visual_group_start", "id" => "default_image_settings", "nodescription" => true);	

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Header and Socket background color",
					"desc" 	=> "Choose a background Color for your socket",
					"id" 	=> "socket_bg",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_1",
					"std" 	=> "#333333",
					"target" => array("default_slideshow_target::.live_bg_socket::background-color"),
					);				
					

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Header and Socket font color",
					"desc" 	=> "Choose a font color for your socket",
					"id" 	=> "socket_font",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#ffffff",
					"target" => array("default_slideshow_target::.live_bg_socket::color"),
					);	

	$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Content Background color",
					"desc" 	=> "Choose the background color for the boxed content area<br/><br/>",
					"id" 	=> "bg_color_boxed",
					"type" 	=> "colorpicker",
					"std" 	=> "#ffffff",
					"class" => "av_2columns av_col_2 set_blank_on_hide",
					"target" => array("default_slideshow_target::.live_bg_wrap .live_bg_default::background-color"));			

					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Highlight Background color",
					"desc" 	=> "Background color for highlighted areas on the site <br/>(eg menu hover)",
					"id" 	=> "bg_highlight",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#f8f8f8",
					"target" => array("default_slideshow_target::.live_bg_highlight::background-color"),
					);	

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Body Font color",
					"desc" 	=> "Default Font color. Color variations for headings and meta info is generated automatically",
					"id" 	=> "body_font",
					"type" 	=> "colorpicker",
					"std" 	=> "#444444",
					"class" => "av_2columns av_col_1",
					"target" => array("default_slideshow_target::.live_bg_default::color"),
					);	
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Border color",
					"desc" 	=> "Color of all the borders and rulers on your site<br/><br/>",
					"id" 	=> "border",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#e1e1e1",
					"target" => array("default_slideshow_target::.live_bg_highlight, .live_bg_default::border-color"),
					);
					
					

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Primary color",
					"desc" 	=> "Choose a font color for links, dropcaps and a few other elements",
					"id" 	=> "primary",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_1",
					"std" 	=> "#2d5c88",
					"target" => array("default_slideshow_target::.live_bg_default .a_link, .live_bg_wrap_top::color,border-color"),
					);	

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Highlight color",
					"desc" 	=> "Choose a secondary color for link and button hover<br/><br/>",
					"id" 	=> "highlight",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#4383bf",
					"target" => "default_slideshow_target::.live_bg_default .an_activelink::color",
					);
						


$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Footer background color",
					"desc" 	=> "Choose a background Color for your footer",
					"id" 	=> "footer_bg",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_1",
					"std" 	=> "#f8f8f8",
					"target" => array("default_slideshow_target::.live_bg::background-color"),
					);				
					

$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Footer font color",
					"desc" 	=> "Choose a font color for your footer",
					"id" 	=> "footer_font",
					"type" 	=> "colorpicker",
					"class" => "av_2columns av_col_2",
					"std" 	=> "#666666",
					"target" => array("default_slideshow_target::.live_bg::color"),
					);						
					


$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Body Background color",
					"desc" 	=> "Background color for your site<br/><br/>",
					"id" 	=> "bg_color",
					"type" 	=> "colorpicker",
					"std" 	=> "#111111",
					"class" => "av_2columns av_col_1",
					"target" => array("default_slideshow_target::.live_bg_wrap::background-color"),
					);	

					
$avia_elements[] = array(	
					"slug"	=> "styling",
					"id" 	=> "bg_image",
					"name" 	=> "Background Image",
					"desc" 	=> "This background image of your site",
					"type" 	=> "select",
					"subtype" => array('No Background Image'=>'','Upload custom image'=>'custom','----------------------'=>''),
					"std" 	=> "",
					"no_first"=>true,
					"target" => array("default_slideshow_target::.live_bg_wrap::background-image"),
					"folder" => "images/background-images/",
					"folderlabel" => "");					
					
				
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Custom Background Image",
					"desc" 	=> "Upload a background image of your site",
					"id" 	=> "bg_image_custom",
					"type" 	=> "upload",
					"std" 	=> "",
					"class" => "set_blank_on_hide",
					"label"	=> "Use Image",
					"required" => array('bg_image','custom'),
					"target" => array("default_slideshow_target::.live_bg_wrap::background-image"),
					);
			 					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Position of the image",
					"desc" 	=> "",
					"id" 	=> "bg_image_position",
					"type" 	=> "select",
					"std" 	=> "left",
					"required" => array('bg_image','{true}'),
					"subtype" => array('Left'=>'left','Center'=>'center','Right'=>'right'));
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Repeat",
					"desc" 	=> "",
					"id" 	=> "bg_image_repeat",
					"type" 	=> "select",
					"std" 	=> "no-repeat",
					"required" => array('bg_image','{true}'),
					"subtype" => array('no repeat'=>'no-repeat','Repeat'=>'repeat','Tile Horizontally'=>'repeat-x','Tile Vertically'=>'repeat-y', 'Stretch Fullscreen'=>'fullscreen'));
					
$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Attachment",
					"desc" 	=> "",
					"id" 	=> "bg_image_attachment",
					"type" 	=> "select",
					"std" 	=> "scroll",
					"required" => array('bg_image','{true}'),
					"subtype" => array('Scroll'=>'scroll','Fixed'=>'fixed'));


										
$avia_elements[] =	array(	"slug"	=> "styling", "type" => "visual_group_end", "nodescription" => true);	

					


$avia_elements[] =	array(	
					"slug"	=> "styling",
					"name" 	=> "Quick CSS",
					"desc" 	=> "Just want to do some quick CSS changes? Enter them here, they will be applied to the theme. If you need to change major portions of the theme please use the custom.css file.",
					"id" 	=> "quick_css",
					"type" 	=> "textarea"
					);




					
/*Layout Settings*/


$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Responsive Layout",
					"desc" 	=> "By default the theme adapts to the screen size of the visitor and uses a layout best suited. You can disable this behavior so the theme will only show the default layout without adaptation",
					"id" 	=> "responsive_layout",
					"type" 	=> "select",
					"std" 	=> "responsive",
					"no_first"=>true,
					"subtype" => array( 'Responsive Layout' =>'responsive',
										'Fixed layout'=>'static_layout',
										));


$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Websave fonts fallback for Windows",
					"desc" 	=> "Older Browsers on Windows dont render custom fonts as smooth as modern ones. If you want to force websave fonts instead of custom fonts for those browsers activate the setting here (affects older versions of IE, Firefox and Opera)",
					"id" 	=> "websave_windows",
					"type" 	=> "select",
					"std" 	=> "",
					"no_first"=>true,
					"subtype" => array( 'Not activated' =>'',
										'Activated'=>'active',
										));
										
															

$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Default Blog Layout",
					"desc" 	=> "Choose the default blog layout here. You can create multiple blogs with different layouts by using the template builder if you want to",
					"id" 	=> "blog_layout",
					"type" 	=> "select",
					"std" 	=> "sidebar_right",
					"no_first"=>true,
					"subtype" => array( 'left sidebar' =>'sidebar_left',
										'right sidebar'=>'sidebar_right',
										/* 'no sidebar'=>'fullsize' */
										));



$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Default Page Layout",
					"desc" 	=> "Choose the default page layout here. You can change the setting of each individual page when editing that page",
					"id" 	=> "page_layout",
					"type" 	=> "select",
					"std" 	=> "sidebar_right",
					"no_first"=>true,
					"subtype" => array( 'left sidebar' =>'sidebar_left',
										'right sidebar'=>'sidebar_right',
										'no sidebar'=>'fullsize' 
										));
							
					
$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Page Sidebar navigation",
					"desc" 	=> "You can choose to display a sidebar navigation for all nested subpages of a page automatically. ",
					"id" 	=> "page_nesting_nav",
					"type" 	=> "select",
					"std" 	=> "true",
					"no_first"=>true,
					"subtype" => array( 'Display sidebar navigation'=>'true',
										'Don\'t display Sidebar navigation' => ""
										));			


$avia_elements[] =	array(	
					"slug"	=> "layout",
					"name" 	=> "Slideshow behavior on overview pages",
					"desc" 	=> "The default setting is: overview pages (eg Blog, Portfolio Overview) display the whole slideshow for each post. <br/><br/>You can change this so that overview pages always only display a single image. Only single entries will then show the whole slideshow",
					"id" 	=> "slideshow_poster",
					"type" 	=> "select",
					"std" 	=> "true",
					"no_first"=>true,
					"subtype" => array( 'Display default slideshow on overview pages and on single entries'=>'',
										'Display only single image on overview pages and all slideshow images on single entries' => "single",
										'Display only single image on overview pages and all slideshow images except the first one on single entries' => "poster",
										));	


/*portfolio settings*/

	
$avia_elements[] =	array(		
					"slug"	=> "portfolio",
					"name" 	=> "Enter a page slug that should be used for your portfolio single items",
					"desc" 	=> "For example if you enter 'portfolio-item' the link to the item will be <strong>".get_option('home').'/portfolio-item/post-name</strong><br/><br/>Dont use characters that are not allowed in urls and make sure that this slug is not used anywere else on your site (for example as a category or a page)',
					"id" 	=> "portfolio-slug",
					"std" 	=> "portfolio-item",
					"type" 	=> "text");

$avia_elements[] =	array(	"name" => "Add new portfolio meta fields",
							"desc" => "The Portfolio Meta fields hold extra information for your portfolio entries. Define the available Meta fields here, <a href='".admin_url('edit.php?post_type=portfolio')."'>then write/edit a portfolio entry</a> and you will notice the additional fields that allow you to enter extra information.",
							"std" => "",
							"slug"	=> "portfolio",
							"type" => "heading",
							"nodescription"=>true);

$avia_elements[] =	array(	
				"slug"			=> "portfolio",
				"type" 			=> "group", 
				"id" 			=> "portfolio-meta", 
				"linktext" 		=> "Add another Meta Field",
				"deletetext" 	=> "Remove Meta Field",
				"blank" 		=> true, 
				"std"			=> array(
										array('meta'=>'Skills Needed'),
										array('meta'=>'Client'),
										array('meta'=>'Project URL'),
										),
				'subelements' 	=> array(	
						
							array(	
							"name" 	=> "Portfolio Meta Field:",
							"slug"	=> "portfolio",
							"desc" 	=> "",
							"id" 	=> "meta",
							"std" 	=> "",
							"type" 	=> "text"),
 
				),	           
					           
			);

$avia_elements[] =	array(	"name" => "Add new portfolios",
							"desc" => "Here you can add new portfolio overview pages with multiple columns of portfolio Items. Before you start adding options here, please create a new blank page and save it. Afterwards return to this page and apply the portfolio overview page you want to create to that page.",
							"std" => "",
							"slug"	=> "portfolio",
							"type" => "heading",
							"nodescription"=>true);

				
$itemcount = array('All'=>'-1');
for($i = 1; $i<101; $i++) $itemcount[$i] = $i;		
	
$avia_elements[] =	array(	
				"slug"			=> "portfolio",
				"type" 			=> "group", 
				"id" 			=> "portfolio", 
				"linktext" 		=> "Add another Slide",
				"deletetext" 	=> "Remove Slide",
				"blank" 		=> true, 
				"nodescription" => true,
				'subelements' 	=> array(	
						
						array(	"name" 	=> "Which categories should be used for the portfolio?",
								"desc" 	=> "You can select multiple categories here. The Portfolio Page that you choose below will then show all posts from those categories, along with a sort option for each category.",
					            "id" 	=> "portfolio_cats",
					            "type" 	=> "select",
								"slug"	=> "portfolio",
	            				"multiple"=>6,
	            				"taxonomy" => "portfolio_entries",
					            "subtype" => "cat"),
					            
					    							
						array(	"name" 	=> "Which page should display the portfolio?",
								"slug"	=> "portfolio",
								"desc" 	=> "Please choose the page that should serve as portfolio overview page<br/><br/>",
					            "id" 	=> "portfolio_page",
					            "type" 	=> "select",
								"class" => "av_2columns av_col_1",
					            "subtype" => "page"),
					            
					    array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Details?",
								"desc" 	=> "Should the portfolio details be opened on the same page when someone clicks a portfolio item?<br/><br/>",
								"id" 	=> "portfolio_ajax_class",
								"type" 	=> "select",
								"std" 	=> "ajax_portfolio_container",
								"no_first"=>true,
								"class" => "av_2columns av_col_2",
								"subtype" => array( 'Yes, on the same page - known as AJAX Portfolio'=>'ajax_portfolio_container',
													'No, open entries on a single page'=>'')),
					            
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Columns",
								"desc" 	=> "How many columns should be displayed? Should a sidebar be displayed as well?<br/><br/>",
								"id" 	=> "portfolio_columns",
								"type" 	=> "select",
								"class" => "av_2columns av_col_1",
								"no_first"=>true,
								"std" 	=> "4",
								"subtype" => array(	'1 Column'=>'1',
													'2 Columns'=>'2',
													'3 Columns'=>'3',
													'4 Columns'=>'4',
													)),
								
						array(	
							"slug"	=> "layout",
							"name" 	=> "Portfolio Page Layout",
							"desc" 	=> "Choose the portfolio layout here. This will overwrite any individual page settings<br/><br/>",
							"id" 	=> "portfolio_layout",
							"type" 	=> "select",
							"std" 	=> "fullsize",
								"class" => "av_2columns av_col_2",
							"no_first"=>true,
							"subtype" => array( 'left sidebar' =>'sidebar_left',
												'right sidebar'=>'sidebar_right',
												'no sidebar'=>'fullsize' 
												)),
			
			
			
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Post Number",
								"desc" 	=> "How many items should be displayed per page?<br/><br/>",
								"id" 	=> "portfolio_item_count",
								"type" 	=> "select",
								"std" 	=> "16",
								"no_first"=>true,
								"class" => "av_2columns av_col_1",
								"subtype" => $itemcount),
								
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Title",
								"desc" 	=> "Display Title of entry?<br/><br/>",
								"id" 	=> "portfolio_text",
								"type" 	=> "select",
								"std" 	=> "yes",
								"no_first"=>true,
								"class" => "av_2columns av_col_2",
								"subtype" => array('yes'=>'yes','no'=>'no')),	
								
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Sortable?",
								"desc" 	=> "Should the sorting options based on categories be displayed?<br/><br/>",
								"id" 	=> "portfolio_sorting",
								"type" 	=> "select",
								"std" 	=> "yes",
								"no_first"=>true,
								"class" => "av_2columns av_col_1",
								"subtype" => array('yes'=>'yes','no'=>'no')),
								
								
						array(	
								"slug"	=> "portfolio",
								"name" 	=> "Portfolio Pagination",
								"desc" 	=> "Should a portfolio pagination be displayed?<br/><br/><br/>",
								"id" 	=> "portfolio_pagination",
								"type" 	=> "select",
								"std" 	=> "yes",
								"no_first"=>true,
								"class" => "av_2columns av_col_2",
								"subtype" => array('yes'=>'yes','no'=>'no'))
	
				)
			);
	





/*Contact + social stuff*/
$avia_elements[] =	array(	
			"name" 	=> "Contact Form Page",
			"slug"	=> "contact",
			"desc" 	=> "Select which page should be used to display your contact form.",
			"id" 	=> "email_page",
			"type" 	=> "select",
			"subtype" => 'page');
			
$avia_elements[] =	array(	
			"name" 	=> "Your email adress",
			"slug"	=> "contact",
			"desc" 	=> "Enter the Email adress where mails should be delivered to. (default is '".get_option('admin_email')."')",
			"id" 	=> "email",
			"std" 	=> get_option('admin_email'),
			"type" 	=> "text");
			
$avia_elements[] =	array(	
					"slug"	=> "contact",
					"name" 	=> "Autoresponder",
					"desc" 	=> "Enter a message that will be sent to the users email adress once he has submitted the form. If left empty no autoresponse will be sent. <br/>Please make sure to not delete the Email Field bellow, otherwise the script wont be able to send a mail",
					"id" 	=> "autoresponder",
					"std" 	=> "",
					"type" 	=> "textarea"
					);			
			
			
$avia_elements[] =	array(	
						"slug"	=> "contact",
						"name" 	=> "Contact Form Captcha",
						"desc" 	=> "Do you want to display a captcha field at the end of the form so users must proof they are human by solving a simply mathematical question? (It is recommended to only activate this if you receive spam from your contact form, since an invisible spam protection is also implemented that should filter most spam messages by robots anyways)",
						"id" 	=> "contact-form-captcha",
						"type" 	=> "select",
						"std" 	=> "",
						"no_first"=>true,
						"subtype" => array('Dont display Captcha'=>'', 'Display Captcha'=>'active')
					);				
			
			
$avia_elements[] =	array(	"name" => "Add new form elements to your contact form:",
							"desc" => "Here you can add, remove and edit the form Elements of your contact form. You can choose to display single line input elements, textareas, checkboxes and select dropdown menus. You also have the option to validate these options. It is recommended to not delete the 'E-Mail' field if you want to use an auto responder.",
							"id" => "contactformdescription",
							"std" => "",
							"slug"	=> "contact",
							"type" => "heading",
							"nodescription"=>true);

$avia_elements[] =	array(	
				"slug"			=> "contact",
				"type" 			=> "group", 
				"id" 			=> "contact-form-elements", 
				"linktext" 		=> "Add another Form Element",
				"deletetext" 	=> "Remove Form Element",
				"blank" 		=> true, 
				"nodescription" => true,
				"std"			=> array(
										array('label'=>'Name', 'type'=>'text', 'check'=>'is_empty'),
										array('label'=>'E-Mail', 'type'=>'text', 'check'=>'is_email'),
										array('label'=>'Subject', 'type'=>'text', 'check'=>'is_empty'),
										array('label'=>'Priority', 'type'=>'select', 'check'=>'', 'options'=>'Low, Medium, High, Urgent as Hell, ASAP DUDE!!!'),
										array('label'=>'Message', 'type'=>'textarea', 'check'=>'is_empty'),
										array('label'=>'I have read the general terms and conditions and I agree!', 'type'=>'checkbox', 'check'=>'is_empty'),
										),
				'subelements' 	=> array(	
						
							array(	
							"name" 	=> "Form Element Label",
							"slug"	=> "contact",
							"desc" 	=> "",
							"class" => "av_3columns av_col_1",
							"id" 	=> "label",
							"std" 	=> "",
							"type" 	=> "text"),
					        
					           
					        array(	
						"slug"	=> "contact",
						"name" 	=> "Form Element Type",
						"desc" 	=> "",
						"class" => "av_3columns av_col_2",
						"id" 	=> "type",
						"type" 	=> "select",
						"std" 	=> "text",
						"no_first"=>true,
						"subtype" => array('Text input'=>'text', 'Text Area'=>'textarea', 'Select Element'=>'select',  'Checkbox'=>'checkbox')),    
						
						    array(	
						"slug"	=> "contact",
						"name" 	=> "Form Element Validation",
						"desc" 	=> "",
						"id" 	=> "check",
						"type" 	=> "select",
						"class" => "av_3columns av_col_3",
						"std" 	=> "",
						"no_first"=>true,
						"subtype" => array('No Validation'=>'', 'Is not empty'=>'is_empty', 'Valid Mail adress'=>'is_email', 'Valid Phone Number'=>'is_phone', 'Valid Number'=>'is_number')), 
						
						array(	
							"name" 	=> "Form Element Options",
							"slug"	=> "contact",
							"desc" 	=> "Enter any number of options that the visitor can choose from. Separate these Options with a comma. <br/>Example: Option 1, Option 2, Option 3",
							"id" 	=> "options",
							"required" => array('type','select'),
							"std" 	=> "",
							"type" 	=> "text"),   
				),	           
					           
			);

			



			
			



/*sidebar settings*/
					
$avia_elements[] =	array(	"name" => "Add new widget areas for pages and categories:",
							"desc" => "Here you can add widget areas for single pages or categories. that way you can put different content for each page/category into your sidebar.
After you have choosen the Pages and Categorys which should receive a unique widget area press the 'Save Changes' button and then start adding widgets to the new widget areas <a href='widgets.php'>here</a>.
<br/><br/>
<strong>Attention when removing areas:</strong> You have to be carefull when deleting widget areas that are not the last one in the list.
It is recommended to avoid this. If you want to know more about this topic please read the documentation that comes with this theme.",
							"id" => "widgetdescription",
							"std" => "",
							"slug"	=> "sidebar",
							"type" => "heading",
							"nodescription"=>true);
			
			
					
$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_start", "id" => "sidebar_left", "class"=>"avia_one_half avia_first", "nodescription" => true);
$avia_elements[] =	array(
					"type" 			=> "group", 
					"id" 			=> "widget_pages", 
					"slug"			=> "sidebar",
					"linktext" 		=> "Add another widget",
					"deletetext" 	=> "Remove widget",
					"blank" 		=> true, 
					"nodescription" => true,
					'subelements' 	=> array(	
	
							array(	
								"name" 	=> "Select a PAGE that should receive a new widget area:",
								"desc" 	=> "",
								"id" 	=> "widget_page",
								"type" 	=> "select",
								"slug"	=> "sidebar",
								"subtype" => 'page'),				           
						        )   
						);
$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_end", "nodescription" => true);





$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_start", "id" => "sidebar_right", "class"=>"avia_one_half", "nodescription" => true);
$avia_elements[] =	array(
					"type" 			=> "group", 
					"slug"			=> "sidebar",
					"id" 			=> "widget_categories", 
					"linktext" 		=> "Add another widget",
					"deletetext" 	=> "Remove widget",
					"blank" 		=> true, 
					"nodescription" => true,
					'subelements' 	=> array(
						
							array(	
								"name" 	=> "Select a Category that should receive a new widget area:",
								"desc" 	=> "",
								"id" 	=> "widget_cat",
								"slug"	=> "sidebar",
								"type" 	=> "select",
								"subtype" => 'cat'),				           
						        )   
						);
$avia_elements[] =	array(	"slug"	=> "sidebar", "type" => "visual_group_end", "nodescription" => true);
	





/*footer settings*/


										
$avia_elements[] =	array(	
					"slug"	=> "footer",
					"name" 	=> "Footer Columns",
					"desc" 	=> "How many colmns should be diplayed in your footer",
					"id" 	=> "footer_columns",
					"type" 	=> "select",
					"std" 	=> "4",
					"subtype" => array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'));	


					
				
					

######################################################################
# TEMPLATE BUILDER
######################################################################


$avia_elements[] 	=		array(	"name" => "How does this work?",
							"desc" => "
							<p>It only takes a few simple steps to create any number of unique page layouts with the template builder. The description bellow is just a short intro on how it works, you can read more about it in the documentation</p>
							<ol>
								<li>First you need to create a new Template by adding a name and hitting the 'Create template' Button</li>
								<li>Next you select your template from the sidebar at the left. Add elements like columns, post snippets, text content and widget areas.</li>
								<li>Once that is done save the changes by hitting 'Save all Changes'</li>
								<li>Now create or edit a page/post and you will notice that you can select your template at the <strong>Post or Page Layout</strong> section. If you do, it will be applied to the post or page.</li>
							</ol>
							",
							"id" => "template_builder_description",
							"std" => "",
							"type" => "heading",
							"slug" => "templates",
							"nodescription"=>true);


$avia_elements[] 	=	array(	"name" 	=> "Create a new dynamic template",
								"desc" 	=> "Enter a name for your new template, then hit the 'Create template' Button<br/><strong>Please Note:</strong> Allowed characters include: a-z, A-Z, 0-9, space, underscore and dash",
								"label"	=> "Create template",
								"remove_label"=> "remove this template",
								"id" 	=> "template_builder",
								"type" 	=> "create_options_page",
								"slug"  => "templates",
								"template_sortable" => 'avia_sortable',
 								"temlate_parent" => "templates",
								"temlate_icon" => "layout_header_footer_3_mix.png",
								"temlate_default_elements" => array(
								
										array(	
										"slug"	=> "templates",
										"name" 	=> "Dynamic Template Page Layout",
										"desc" 	=> "Choose the default page layout here. You can change the setting of each individual page when editing that page",
										"id" 	=> "dynamic_page_layout",
										"type" 	=> "select",
										"std" 	=> "fullsize",
										"no_first"=>true,
										"subtype" => array( 'left sidebar' =>'sidebar_left',
															'right sidebar'=>'sidebar_right',
															'no sidebar'=>'fullsize' 
															)),
										
										array(
										"type" 	=> "dynamical_add_elements",
										"slug"  => 'templates',
										"name" 	=> "Add Elements",
										"desc" 	=> "Select an Element and hit the 'Add Element' Button.<br/>The Element will be added to the template and you will be able to position it via drag and drop",
										"std"	=> "",
										"id"	=> "add_template_option",
										"options_file"		=> "includes/admin/register-admin-dynamic-options.php"
										)
									)
								);



