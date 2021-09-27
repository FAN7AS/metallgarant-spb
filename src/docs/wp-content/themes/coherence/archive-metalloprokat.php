<?php get_header();?>
<div style="background: #fff; padding: 10px 30px;">
<?php
$args = array(
	'posts_per_page' => 98,
	'post_type' => 'metalloprokat',
	'orderby' => 'title',
	'order' => "ASC"
);

$query = new WP_Query( $args );
if ( $query->have_posts() ) { ?>

<div class='portfolio-wrap  avia_sortable'>
	<div class='portfolio-details stretch_full'>
		<div class='portfolio-details-inner'></div>
	</div>
	<div class='portfolio-sort-container isotope'>

	<?php while ( $query->have_posts() ) {
		$query->the_post();

?>

		<div data-ajax-id='41' class='sortovoy isotope-item post-entry post-entry-41 flex_column no_margin portfolio-entry-overview portfolio-loop-1 portfolio-parity-odd prokat_sort  one_fourth first portfolio-entry-description'>
			
			<div class='inner-entry'>										
				<div class='slideshow_container  slide_container_small'>
					<ul class='slideshow preloading move_slider' data-autorotation='false' data-autorotation-timer='5' data-transition='move' >
						<li data-animation='random'  class='featured featured_container1 caption_right caption_right_framed caption_framed' >
							<a  href='<?php the_permalink(); ?>'>

								<?php echo get_the_post_thumbnail( $post->ID , 'portfolio_small' ); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class='portfolio-title title_container'>
					<p class="main-title">
						<a href='<?php the_permalink(); ?>' rel='bookmark' title='<?php the_title(); ?>'><?php the_title(); ?></a>
					</p>
					<!--div class='title_meta meta-color'>
						
					</div-->
				</div>		
			</div>		        
		<!-- end post-entry-->
		</div>


<?php
	} ?>
	</div></div><!-- end -->
<?php } else {
	// Постов не найдено
}

?>
</div>
<?php get_footer(); ?>
