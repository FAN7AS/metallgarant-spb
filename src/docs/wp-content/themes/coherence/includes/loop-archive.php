<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>
<div class="post-entry">
<span class='entry-border-overflow extralight-border'></span>

<div class="entry-content">
<span class="post-title" style="height: auto !important; line-height: 26px !important;">
	<a href="<?php echo get_permalink() ?>" rel="bookmark" style="color: #fff !important; line-height: 26px !important;" title="<?php _e('Permanent Link:','avia_framework')?> <?php the_title(); ?>"><?php the_title(); ?></a>
</span>
<?php echo content(60); ?>
</div>
<div class="blog-meta grid3">
<span class='post-date-comment-container'>
<span class='date-container'>
<strong><?php the_time('d') ?> <?php the_time('M') ?></strong> <span><?php the_time('Y') ?></span>
</span>
<span class='comment-container'><a href="<?php echo get_permalink() ?>" rel="bookmark" style="float:right;">Читать полностью</a>
</span>
</span>
</div>
</div>
<?php } } else { ?>
<div class="entry">
<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
<p><?php _e('Sorry, no posts matched your criteria', 'avia_framework'); ?></p>
</div>
<?php } ?>
<?php if ( !isset( $avia_config['remove_pagination'] )) { echo avia_pagination(); } ?>