<?php
/*
 * 
 * This file holds all the template checking functions for the theme
 * These functions make sure that the correct template file is served
 * for each post and page
 *
 */


if (!function_exists('avia_new_main_query'))
{
	add_action('avia_action_query_check', 'avia_new_main_query');
	
	/**
	*
	* If one of the template checking functions bellow, or any of the template files
	* have set a new query execute it and remove the default query
	*
	* On dynamic templates instantly activate the current post
	*/
	
	function avia_new_main_query($template = false)
	{
		global $avia_config;
		
		if(isset($avia_config['new_query'])) 
		{ 
			query_posts($avia_config['new_query']); 
			
			if($template === 'template-dynamic') the_post(); 
		}
	}
}




if(!function_exists('avia_get_frontpage_template'))
{
	/**
	*
	* This function retrieves the template for the frontpage. 
	* If any of the conditions are met the template is loaded followed by a php exit so code located afterwards wont be executed.
	*
	*/
	
	add_action('avia_action_frontpage_check', 'avia_get_frontpage_template');
	
	function avia_get_frontpage_template()
	{
		global $avia_config, $post;

		$frontpage = avia_get_option('frontpage');

		//if the user has set a different frontpage in the theme option settings show that page, otherwise show the default blog
		if(is_front_page() && $frontpage != "" && !isset($avia_config['new_query']))
		{ 
			$paged = get_query_var('paged');
			if(empty($paged)) $paged = get_query_var('page');
			if(empty($paged)) $paged = 1;
			
			$avia_config['conditionals']['is_redirected_frontpage'] = true;
			
			
			$avia_config['new_query'] = array("page_id"=> avia_get_option('frontpage'), "paged" => $paged);
					
			$custom_fields = get_post_meta(avia_get_option('frontpage'), '_wp_page_template', true);
			
			//if the page we are about to redirect uses a template use that template instead of the default page
			if($custom_fields != "" && strpos($custom_fields,'template') !== false && $custom_fields = explode('-',str_replace('.php','',$custom_fields)))
			{
				get_template_part( $custom_fields[0], $custom_fields[1]); 
			}
			else
			{
				get_template_part( 'page' );
			}
			exit();		
		}
	}
}



if(!function_exists('avia_get_template'))
{
	/**
	*
	* This function retrieves the template for the currently viewed post or page. 
	* If any of the conditions are met the template is loaded followed by a php exit so code located afterwards wont be executed.
	*
	*/
	
	add_action('avia_action_template_check', 'avia_get_template');
	
	function avia_get_template( $current_template = false )
	{
		global $avia_config, $post;
		$dynamic_id = "";
		if(isset($post)) $dynamic_id = $post->ID;
		
		
		/*get infos for conditionals*/
		$frontpage_switch = avia_get_option('frontpage');
		$avia_config['conditionals'][$frontpage_switch]['is_redirected_frontpage'] = true;
		
		$blog_page_id = avia_get_option('blogpage');
		$avia_config['conditionals'][$blog_page_id]['is_blog'] = true;
		
		$portfolios = avia_get_option('portfolio');
		
		if(is_array($portfolios))
		{
			foreach($portfolios as $portfolio)
			{
				if(!empty($portfolio['portfolio_page'])) $avia_config['conditionals'][$portfolio['portfolio_page']]['is_portfolio'] = true;
			}
		}
		
		/*
		*  Check if the frontpge redirected us to this function
		*/
		if($frontpage_switch && isset($avia_config['new_query']) && $avia_config['new_query']['page_id'] == $frontpage_switch)
		{
			$dynamic_id = $frontpage_switch;
		}
		
		/*
		 *  first check for dynamic templates
		 */
		if(avia_is_dynamic_template_active($dynamic_id) && ( is_singular() || isset($avia_config['new_query'])))
		{
			get_template_part( 'template', 'dynamic' ); exit();
		}
		
		
		/*
		 *  if the user wants to display a blog on that page do so by
		 *  calling the blog template and then exit the script
		 */
		
		if($frontpage_switch != "" && $blog_page_id == $post->ID && !isset($avia_config['new_query']))
		{ 	
			$avia_config['conditionals']['is_blog'] = true;
			
			$avia_config['new_query'] = array( 	'paged' => get_query_var( 'paged' ), 
												'posts_per_page' => get_option('posts_per_page'));
											
			get_template_part( 'template', 'blog' ); exit();
		}
		
		
		
		
		/*
		*  check if this page was set as a portfolio page by the user
		*  in the theme portfolio options. If so check if the user has set portfolio categories and query those, 
		*  otherwise perform a simple query for items of all categories
	 	*/
		
		$avia_config['portfolio'] = avia_get_option_set('portfolio', 'portfolio_page', get_the_ID());
		
		//check if the avia_get_option_set found a valid array: then we know this is a portfolio page
		if(isset($avia_config['portfolio']['portfolio_page']))
		{
			$avia_config['conditionals']['is_portfolio'] = true;
			
			avia_set_portfolio_query();
			
			//retrieve the portfolio template
			get_template_part( 'template', 'portfolio' ); exit();
				
		}
	}
}

if(!function_exists('avia_set_portfolio_options'))
{
	function avia_set_portfolio_query()
	{
		global $avia_config;
		
		//set some default values in case there are none set in the backend
		$itemcount 	= isset($avia_config['portfolio']['portfolio_item_count']) ? $avia_config['portfolio']['portfolio_item_count'] : -1;
	
		
		if(isset($avia_config['portfolio']['portfolio_cats']))
		{
			//get the portfolio categories
			$terms 	= explode(',', $avia_config['portfolio']['portfolio_cats']);
		}
		
		//if we find categories perform complex query, otherwise simple one
		if(isset($terms[0]) && !empty($terms[0]) && !is_null($terms[0]) && $terms[0] != "null")
		{	
			$avia_config['new_query'] = array(	'orderby' 	=> 'ID', 
												'order' 	=> 'ASC', 
												'paged' 	=> get_query_var( 'paged' ), 
												'posts_per_page' => $itemcount,  
												'tax_query' => array( 	array( 	'taxonomy' 	=> 'portfolio_entries', 
																				'field' 	=> 'id', 
																				'terms' 	=> $terms, 	
																				'operator' 	=> 'IN')));
		}
		else
		{
			$avia_config['new_query'] = array(	'paged' 		 => get_query_var( 'paged' ),  
												'posts_per_page' => $itemcount,  
												'post_type' 	 => 'portfolio'); 
		}
		
	}
}



if(!function_exists('avia_template_helper_get_layout_string'))
{

/*
* support function that checks if the current page 
* should have a blog or page layout and returns the 
* string
*/

	function avia_template_helper_get_layout_string($post_type = "")
	{
		
		//$post_type should either be 'page_layout' or 'blog_layout'
		if(!$post_type) $post_type = 'blog_layout';
		if(is_page() && !avia_is_overview()) $post_type = 'page_layout';
		if(avia_is_redirected_frontpage()) $post_type = 'page_layout';
		if((is_search() || is_404())) $post_type = 'page_layout';
		
		return $post_type;
	}
}


if(!function_exists('avia_layout_class'))
{

/*
* support function that checks if the current page 
* should have a post or page layout and returns the 
* string so avia_template_set_page_layout can check it
*
* the function is called for each main layout div
* and then delivers the grid classes defined in functions.php 
*/


	function avia_layout_class($key = false, $echo = true)
	{		
		global $avia_config;
		
		if(!isset($avia_config['layout']['current']['main'])) 
		{
			avia_fetch_layout_array();
		}
		
		$return = $avia_config['layout']['current'];
		
		if( $key ) { $return = $avia_config['layout']['current'][$key]; }
		
		if( $echo == true ){ echo $return; } else { return $return; }
		
	}
}

if(!function_exists('avia_offset_class'))
{

/*
* retrieves the offset length of an element based on the current page layout
*/
	function avia_offset_class($key = false, $echo = true)
	{		
		$alpha  = "";
		$offset = avia_layout_class($key, false);
		if(strpos($offset, 'alpha') !== false)
		{
			$offset = str_replace('alpha',"",$offset);
			$alpha = " alpha";
		}
		
		$offset = 'offset-by-'.trim($offset).$alpha;
		if( $echo == true ){ echo $offset; } else { return $offset; }
	}
}



if(!function_exists('avia_fetch_layout_array'))
{

	/*
	* The function checks which layout is applied to the template (eg: fullwidth, right_sidebar, left_sidebar)
	* If no layout is applied it checks for the default layout, set in the general options
	*
	* The final value is then stored in $avia_config['layout']['current'] where it can be accessed by the avia_layout function
	*/


	function avia_fetch_layout_array($post_type = false, $post_id = false)
	{
		global $avia_config;
				
		//get the global page layout option set in your backend
		

		if(avia_is_portfolio())
		{
			$result = $avia_config['portfolio']['portfolio_layout'];
		}
		else
		{
			if($post_type === false) $post_type = avia_template_helper_get_layout_string();
			if($post_id === false) $post_id = avia_get_the_ID();
		
			if($post_id && $new = avia_post_meta($post_id, 'layout'))
			{
				 $result = $new;
				 
				 //check if its a dynamic template, if so set the result to false and let the dynamic template handle the layout
				 if($result === 'dynamic') $result = false;
			}
			else
			{
				 $result = avia_get_option($post_type);
			}
		}
		
		if($result)
		{
			$avia_config['layout']['current'] = $avia_config['layout'][$result];
			$avia_config['layout']['current']['main'] = $result;
		}
	}
}




if(!function_exists('avia_is_dynamic_template_active'))
{
	/*
	* since the theme needs not only to check if a 
	* dynamic template was selected but also if the 
	* page layout is set to dynamic here is a improved 
	* version of avia_is_dynamic_template
	*/
	
	
		function avia_is_dynamic_template_active($id = false)
		{
			$return = false;
		
			if(!$id) $id = avia_get_the_ID();
			if(!$id) return $return;
			
			if(avia_is_dynamic_template($id) && (avia_post_meta($id, 'layout') == 'dynamic' ) ) $return = true;
			
			return $return;
		}
}

if(!function_exists('avia_is_portfolio_single'))
{
	/*
	* conditional check if current page is a single portfolio page
	*/
	
	function avia_is_portfolio_single($id = false)
	{
		return get_post_type($id) == 'portfolio' ? true : false;
	}
}


if(!function_exists('avia_is_portfolio'))
{
	/*
	* conditional check if current page is a portfolio page
	*/
	
	function avia_is_portfolio($id = false)
	{
		return avia_get_conditional('is_portfolio', $id);
	}
}

if(!function_exists('avia_is_blog'))
{
	/*
	* conditional check if current page is a blog page
	*/
	
	function avia_is_blog($id = false)
	{
		return avia_get_conditional('is_blog', $id);
	}
}

if(!function_exists('avia_is_redirected_frontpage'))
{
	/*
	* conditional check if current page is frontpage and is not the default blog but rather a page
	*/
	
	function avia_is_redirected_frontpage($id = false)
	{
		return avia_get_conditional('is_redirected_frontpage', $id);
	}
}

if(!function_exists('avia_get_conditional'))
{
	/*
	* helper function for conditional checks
	*/
	
	function avia_get_conditional($key = false, $id = false)
	{
		global $avia_config;
		
		if($id === false)
		{
			if(isset($avia_config['conditionals'][$key]) && $avia_config['conditionals'][$key] == true) return true;
		}
		else
		{
			if(isset($avia_config['conditionals'][$id][$key]) && $avia_config['conditionals'][$id][$key] == true) return true;
		}
		
		return false;
	}
}


