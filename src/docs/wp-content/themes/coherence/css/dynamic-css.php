<?php

/*
This file holds ALL color information of the theme that is applied with the styling backend admin panel. 
It is recommended to not edit this file, instead create new styles in custom.css and overwrite the styles within this file
*/

global 	$avia_config;

		$post_id 		= avia_get_the_ID();
		
		$output 		= "";
		$body_font		= avia_get_option('body_font');
		$primary		= avia_get_option('primary');
		$body_bg		= avia_get_option('bg_color');
		$boxed_bg		= avia_get_option('bg_color_boxed');
		$border			= avia_get_option('border');
		$highlight		= avia_get_option('highlight');
		$bg_highlight	= avia_get_option('bg_highlight');
		$socket			= avia_get_option('socket_bg'); 
		$socket_font	= avia_get_option('socket_font'); 
		$footer			= avia_get_option('footer_bg'); 
		$footer_font	= avia_get_option('footer_font'); 
		$footer_meta  	= avia_backend_merge_colors($footer_font, $footer);
		$footer_meta_2  = avia_backend_merge_colors($footer_meta, $footer);
		$footer_meta  	= avia_backend_merge_colors($footer_font, $footer_meta); 
		$bg_image		= avia_get_option('bg_image') == "custom" ? avia_get_option('bg_image_custom') : avia_get_option('bg_image');


		//calculates the inverse of the background color, then again creates a new color for headins (results in a stronger color)
		$heading_color 	= avia_backend_merge_colors($body_font, avia_backend_counter_color($boxed_bg)); 
		$content_bg 	= $boxed_bg;
		
		// creates a new color from the background color and the default font color (results in a lighter color)
		$meta_color 	= avia_backend_merge_colors($heading_color, $boxed_bg); 


		//background color overwrite for the current entry
		if($new_body = avia_post_meta($post_id, 'bg_color')) $body_bg = $new_body;
		if($new_bg_image = avia_post_meta($post_id, 'bg_image_custom')) 
		{
			$bg_image = $new_bg_image;
			$bg_image_repeat = avia_post_meta($post_id, 'bg_image_settings');
			
			if($bg_image_repeat === 'tiled')
			{
				$bg_image_position = "top center";
				$bg_image_repeat = "repeat";
				$bg_image_attachment = "fixed";
			}
			else if($bg_image_repeat !== 'fullscreen')
			{
				$bg_image_position = $bg_image_repeat;
				$bg_image_repeat = "no-repeat";
				$bg_image_attachment = "fixed";
			}
		}
		else if($bg_image)
		{
			$bg_image_position 		= avia_get_option('bg_image_position');
			$bg_image_repeat 		= avia_get_option('bg_image_repeat');
			$bg_image_attachment 	= avia_get_option('bg_image_attachment');
		}
		
		if($bg_pattern = avia_post_meta($post_id, 'bg_image'))
		{
			if(empty($new_bg_image))
			{
				$bg_image = $bg_pattern;
				unset($bg_pattern);
				$bg_image_position = "top center";
				$bg_image_repeat = "repeat";
				$bg_image_attachment = "fixed";
			}
		}
		

######################################################################
# CREATE DYNAMIC CSS RULES
######################################################################


$output .= "

div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video, #top .pullquote_boxed{
border-color:$border;
}


html, body{
color: $body_font;
background-color:$body_bg;
}

#top .site-background, .container,  #top .main_menu .menu ul li a, .first-quote, .slideshow_container, .pointer_arrow_wrap .pointer_arrow, .related_image_wrap, .gravatar img, .comment-reply-link, #top .inner_slide .numeric_controls a, .hr_content, .news-thumb {
background-color:$content_bg;
color: $body_font;
}

#top .bg_highlight, .stretch_full .portfolio-details-inner, #top .main_menu .menu ul li a:hover, .thumbnails_container, #top .pagination span, #top .pagination a, li:hover .pointer_arrow_wrap .pointer_arrow, .ajax_controlls a, .related_posts.stretch_full, .post_nav_container, #top div .numeric_controls a, .tab.active_tab, .tab_content.active_tab_content, .toggler.activeTitle{
background-color:$bg_highlight;
}


h1, h2, h3, h4, h5, h6, #top strong, #top strong a, .sidebar .current_page_item a, #top .pagination .current, .comment-count, .callout .content-area, #top #footer strong{
color:$heading_color;
}

#header .container, #socket .container, #socket .container a, .avia_wpml_language_switch, #top .slide_controls a, .invers_pointer span{
color: $socket_font;
background-color:$socket;
}

#header .container a{
color: $socket_font;
}

#footer .container, #footer .container a, #footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6, #footer .widgettitle, .contentSlideControlls a{
color: $footer_font;
background-color:$footer;
}

#top .primary-background, .dropcap2, #top .primary-background a, #top .social_bookmarks, #top .slide_controls a:hover, .avia_welcome_text, .avia_welcome_text a, #top .pagination a:hover, .button, #submit, #top .big_button{
background-color: $primary;
color:$content_bg;
border-color:$primary;
}

.button:hover, .ajax_controlls a:hover, #submit:hover, #top .big_button:hover, .contentSlideControlls a:hover{
background-color: $highlight;
color:$content_bg;
border-color:$highlight;
}

blockquote{
border-color:$primary;
}




.meta-color, .sidebar, .sidebar a, .minor-meta, .minor-meta a, .text-sep, .quote-content, .quote-content a, blockquote, .post_nav a, .comment-text, .template-search  a.news-content, .subtitle_intro, div .hr_content, .hr a {
color: $meta_color;
}

a{
color:$primary;
}

a:hover, #footer .container a:hover, #top h1 a:hover, #top h2 a:hover, #top h3 a:hover, #top h4 a:hover, #top h5 a:hover, #top h6 a:hover,  .template-search  a.news-content:hover{
color: $highlight;
}


.search-result-counter{
color:$bg_highlight;
}

#top div .numeric_controls .active_item{
background-color:$meta_color;
}



#footer a, #footer div, #footer span, #footer li, #footer ul {
border-color: $footer_meta_2;
color: $footer_meta;
}



::-moz-selection{
background-color: $primary;
color: $content_bg;
}

::-webkit-selection{
background-color: $primary;
color: $content_bg;
}

::selection{
background-color: $primary;
color: $content_bg;
}




";






/*backgound image additions:*/

if($bg_image != '')
{
	if($bg_image_repeat != 'fullscreen')
	{
		$output .="
		html.html_boxed, body{
		background-image: url( $bg_image );
		}
		
		html, body{
		background-position: top $bg_image_position;
		background-repeat: $bg_image_repeat;
		background-attachment: $bg_image_attachment;
		}
		";
	}
	
	if(!empty($bg_pattern))
	{
		$output .="
		.pattern_container{
		background-image: url( $bg_pattern );
		}
		";
	}
}


/*rules that should also be added to the backend (for example table builder colors, so the live preview shows the selected theme colors:)*/

$avia_config['backend_style'] = "

#top div .avia_table table, #top div .avia_table th, #top div .avia_table td {
border-color: $border;
}

div .avia_table, div .avia_table td{
background:$content_bg;
color: $body_font;
}


div .avia_table tr:nth-child(odd) td, div .avia_table tr:nth-child(odd) th, div .avia_table tr:nth-child(odd) .th, .avia_table .avia-button, #top .avia_table table tr.button-row td{
background-color: $bg_highlight;
}


div .avia_table tr.description_row td, div .avia_table tr.pricing-row td, tr.pricing-row .avia-table-icon, tr.description_row .avia-table-icon{
color:$content_bg;
background: $primary;
}

html #top .avia_table table tr td.description_column, html #top .avia_table table.description_row tr td.description_column, .avia-table-icon{
border-color:$border;
color:$meta_color;
}

.avia_table .avia-button{
color: $content_bg;
background-color:$primary;
border-color:$primary;
}



";

$output .= $avia_config['backend_style'];


$output = preg_replace('/\r|\n|\t/', '', $output);
################################################################################################################
# pass the rules above to the generator, as well as user input in the backend from the quick css panel and fonts
################################################################################################################

$avia_config['style'] = array(

		array(
		'key'	=>	'direct_input',
		'value'		=> $output
		),
		
		array(
		'key'	=>	'direct_input',
		'value'		=> avia_get_option('quick_css')
		),
		
		//google webfonts
		array(
		'elements'	=> 'h1, h2, h3, h4, h5, h6, tr.pricing-row td, #top .portfolio-title, .callout .content-area',
		'key'	=>	'google_webfont',
		'value'		=> avia_get_option('google_webfont')
		),
		
		//google webfonts
		array(
		'elements'	=> 'body, .flex_column h1, .flex_column h2, .flex_column h3, .flex_column h4, .flex_column h5, .flex_column h6, #top .widgettitle',
		'key'	=>	'google_webfont',
		'value'		=> avia_get_option('default_font')
		)
);
