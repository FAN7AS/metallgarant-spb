<?php 
global $avia_config;
do_action( 'avia_action_template_check' , 'single' );
get_header(); 
?>
<div class='container_wrap <?php avia_layout_class( 'main' ); ?>' id='main'>
<div class='container template-blog template-single-blog'>
<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
<?php if ( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
</div>
<div class='content units <?php avia_layout_class( 'content' ); ?>'>
<h1><?php the_title(); ?></h1>
<?php while ( have_posts() ) { the_post(); the_content(); } ?>
<?php previous_post_link(); ?><br />
<?php next_post_link(); ?>
<br />
<br />
<?php get_template_part( 'includes/related-posts'); ?>


</div>
<?php 
$avia_config['currently_viewing'] = "blog";
get_sidebar();
echo avia_post_nav();
?>
</div>
</div>
<?php get_footer(); ?>