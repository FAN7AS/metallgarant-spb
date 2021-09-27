<?php 
	
	global $avia_config;
	 /* 
	  * create a new dynamic template object and display it.
	  * The rendering class is located in includes/helper-templates.php
	  */
	 $post_id = avia_get_the_ID();
	 $template_name = avia_post_meta($post_id, 'dynamic_templates');	 
 	 $template = new avia_dynamic_template($template_name);
 	
 	 
 	 $template -> generate_html();
 	 $template -> special_slider_config();


 	 /*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
 	 get_header();
	 do_action( 'avia_action_query_check' , 'template-dynamic' );
function loop_portfolio_query( $location ) {
if ( $location == 'loop-portfolio' ) {
global $avia_config;
if(isset($avia_config['new_query']) && is_home()) {
$avia_config['new_query']['orderby'] = "desc";
query_posts($avia_config['new_query']);
}
}
}
add_action( 'avia_action_query_check' , 'loop_portfolio_query', 10, 1 );
	 ?>

		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php avia_layout_class( 'main' ); ?>' id='main'>
		
			<div class='container'>
			
				<?php 
				if(!post_password_required($post_id))
				{
					$template -> element_on_condition('heading', 0); 
				}
				?>

				<div class='content <?php avia_layout_class('content'); ?> units template-dynamic template-dynamic-<?php echo $template_name; ?>'>
				
				<?php
				
				if(!post_password_required($post_id))
				{
					$template -> display();
				}
				else
				{
					echo get_the_password_form();
				}
				
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 

				//get the sidebar
				wp_reset_query();
				
				if(!isset($avia_config['currently_viewing']))
				{
					$avia_config['currently_viewing'] = 'page';
					if(is_singular('post')) $avia_config['currently_viewing'] = 'blog';
					
				}

				
				if($avia_config['layout']['current']['main'] != 'fullsize') get_sidebar();
				
				?>
				
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>