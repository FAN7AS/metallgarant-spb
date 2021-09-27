<?php get_header(); ?>
<div class="container">
    <div class="post-entry post-entry-dynamic dynamic_element dynamic_el_3">
       	<?php 
			if(empty($avia_config['slide_output'])) 
			{
			    ?> <h1><? the_title(); ?></h1><?
			}
			else
			{
				echo avia_title(false, false, 'small_title'); 
			}
			while(have_posts()): the_post();
				the_content();
			endwhile;
		?>
        
    </div>
</div>
<?php get_footer(); ?>