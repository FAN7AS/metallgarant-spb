<?php 

	 get_header();
 	 
	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php avia_layout_class( 'main' ); ?>' id='main'>
		
			<div class='container'>

				<h1><? the_title(); ?></h1>
				<div class='template-page content  <?php avia_layout_class( 'content' ); ?> units'>

				<?php
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-page.php and that will be used instead.
				*/
				$avia_config['size'] = 'page';
				get_template_part( 'includes/loop', 'page' );
				?>
				
				
				<!--end content-->
				</div>
				
				<?php 

				//get the sidebar
				$avia_config['currently_viewing'] = 'page';
				get_sidebar();
				
				?>
				
			</div><!--end container-->

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>