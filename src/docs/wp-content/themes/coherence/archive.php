<?php 
	global $avia_config, $more;

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 		
	?>


		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php avia_layout_class( 'main' ); ?>' id='main'>
		<div class="news">
			<div class='container template-blog '>	
			
				<?php 
				
				$description = is_tag() ? tag_description() : category_description();
				//echo avia_title(avia_which_archive(), $description); 
				?>
				<h1 class="category">Новости</h1>
				
				<div class='content <?php avia_layout_class( 'content' ); ?> units'>
				<?php
				
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-index.php and that will be used instead.
				*/
				
				
				$more = 0;
				get_template_part( 'includes/loop', 'archive' );
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 

				//get the sidebar
				$avia_config['currently_viewing'] = 'blog';
				get_sidebar();
				
				?>
				
			</div><!--end container-->
		</div>
	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>