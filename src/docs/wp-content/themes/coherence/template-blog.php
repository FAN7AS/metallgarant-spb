<?php 

	global $avia_config, $more;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	
	get_header();	
	
	?>


		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php avia_layout_class( 'main' ); ?>' id='main'>
		
			<div class='container template-blog '>	
				
				<?php 
					
					$title  = __('Blog - Latest News', 'avia_framework'); //default blog title
					$t_link = "<a href='".home_url('/')."'>".$title."</a>";
					$t_sub = "";
					
					if(avia_get_option('frontpage') && $new = avia_get_option('blogpage')) 
					{ 
						$title 	= get_the_title($new); //if the blog is attached to a page use this title
						$t_link = "<a href='".get_permalink($new)."'>".$title."</a>"; 
						$t_sub =  avia_post_meta($new, 'subtitle');
						
					}
					
					echo avia_title($t_link, $t_sub); 
					
				 ?>
				
				
				<div class='content <?php avia_layout_class( 'content' ); ?> units'>

				<?php
				
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-index.php and that will be used instead.
				*/
				
				
				$more = 0;
				get_template_part( 'includes/loop', 'index' );
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 
				wp_reset_query();
				//get the sidebar
				$avia_config['currently_viewing'] = 'blog';
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>