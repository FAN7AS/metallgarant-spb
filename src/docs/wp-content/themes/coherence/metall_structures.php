<?php 
/*
Template Name: Металлоконструкции
*/

 //do_action('avia_action_template_check','page');
	/*
	 * check which page template should be applied: 
	 * cecks for dynamic pages as well as for portfolio, fullwidth, blog, contact and any other possibility :)
	 * Be aware that if a match was found another template wil be included and the code bellow will not be executed
 	 * located at the bottom of includes/helper-templates.php
	 */
	

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 	 
	?>
<?php 
function current_tab($input){ 

 $args=array('post_type' => 'portfolio','post_status'=> 'publish','post__in'=> array(2652,412,715,717,719,721,723,727,731,733,737,741,2012,2380,2651),'order'=> 'ASC');
$query = new WP_Query($input); 

while ( $query->have_posts() ) {
	$query->the_post();
?>
<!-- проверка -->
				<div data-ajax-id="1263" class="isotope-item post-entry post-entry-1263 flex_column no_margin portfolio-entry-overview portfolio-loop-1 portfolio-parity-odd prokat_sort  one_fourth  portfolio-entry-description">
					
					<div class="inner-entry ilya5">										
						<div class="slideshow_container slide_container_small ilya2">
							<ul class="slideshow fade_slider" data-autorotation="false" data-autorotation-timer="5" data-transition="fade" style="height: 160px;">
								<li data-animation="random" class="featured featured_container1 caption_right caption_right_framed caption_framed">
									<a href="<?php the_permalink();?>"><?php the_post_thumbnail("portfolio_small"); ?></a>
								</li>
							</ul>
						</div>
						<div class="portfolio-title title_container">
							<p class="main-title">
								<a href="<?php the_permalink();?>" rel="bookmark"><?php the_title(); ?></a>
							</p>
<!--div class="title_meta meta-color"><p><?php $arr=get_post_meta(get_the_ID(), '_avia_elements_theme_compatibility_mode', true); echo $arr['subtitle']; ?></p></div-->
						</div>		
					</div>		        
				
				</div>';
<?php 
}
wp_reset_postdata();
}
?>






		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap fullsize' id='main'>
				<div class='bd_g container_wrap' id='main'>
		
		</div>
			





<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>

<div class='container'>

			
				
				<div class="content twelve alpha units template-dynamic template-dynamic-metal_structures">
				
				<div class="dynamic_textarea_p dynamic_element dynamic_el_1"></div>

<div class="dynamic_element dynamic_el_2 template-portfolio-overview content portfolio-size-4 "><div class="portfolio-wrap  avia_not_sortable avia_sortable_active"><div class="portfolio-details stretch_full"><div class="portfolio-details-inner"></div></div>

<div class="link_holder"><a href="/wp-content/uploads/2013/04/1326831565_metall9-e1521110625143.jpg"><img src="/wp-content/uploads/2013/04/1326831565_metall9-e1521110625143.jpg" alt="ik-2-2-03-00" width="300" height="230" class="alignleft size-medium wp-image-2693" /></a><a class="show_link">Строительные металлоконструкции<span>&#9660;</span></a><div>
<div class="portfolio-sort-container isotope">
<?php  $args=array('post_type' => 'portfolio','post_status'=> 'publish','post__in'=> array(717,737,741,24010,715,39067,723,2650,719),'order'=> 'ASC');
current_tab($args); ?>
</div></div></div>

<div class="link_holder"><a href="/wp-content/uploads/2018/07/skladskie-i-logisticheskie.jpg"><img src="/wp-content/uploads/2018/07/skladskie-i-logisticheskie.jpg" alt="АНГАРЫ" width="300" height="220" class="alignleft size-medium wp-image-2413" /></a><a class="show_link">Складские и логистические<span>&#9660;</span></a><div>
<div class="portfolio-sort-container isotope">
<?php  $args=array('post_type' => 'portfolio','post_status'=> 'publish','post__in'=> array(2383,2385,2387,2652,733),'order'=> 'ASC');
current_tab($args); ?>
</div></div></div>
	
<div class="link_holder"><a href="/wp-content/uploads/2014/08/reklamnye-metallokonstruktsii-foto.jpg"><img src="/wp-content/uploads/2014/08/reklamnye-metallokonstruktsii-foto.jpg" alt="" width="300" height="224" class="alignleft size-medium wp-image-720" /></a><a class="show_link">Промышленные и коммерческие<span>&#9660;</span></a><div>
<div class="portfolio-sort-container isotope">
<?php  $args=array('post_type' => 'portfolio','post_status'=> 'publish','post__in'=> array(412,745,727,2662,743,2647,2653),'order'=> 'ASC');
current_tab($args); ?>
</div></div></div>	
	
	

<div class="link_holder"><a href="/wp-content/uploads/2018/07/kommercheskie.jpg"><img src="/wp-content/uploads/2018/07/kommercheskie.jpg" alt="Торговые центры" width="300" height="214" class="alignleft size-medium wp-image-2420" /></a><a class="show_link">Проектные решения<span>&#9660;</span></a><div>
<div class="portfolio-sort-container isotope">
<?php  $args=array('post_type' => 'portfolio','post_status'=> 'publish','post__in'=> array(2397,725,2391,2389,2395,2393,2660,2644),'order'=> 'ASC');
current_tab($args); ?>
</div></div></div>


<div class="link_holder"><a href="/wp-content/uploads/2014/05/czUuaG9zdGluZ2thcnRpbm9rLmNvbS91cGxvYWRzL2ltYWdlcy8yMDEzLzA0LzE1MmE3NDQ1YmFkYTYwMjAxZGYyMGM5NjI5ZTE4OTY2LnBuZz9fX2lkPTMxNDM21.jpg"><img src="/wp-content/uploads/2014/05/czUuaG9zdGluZ2thcnRpbm9rLmNvbS91cGxvYWRzL2ltYWdlcy8yMDEzLzA0LzE1MmE3NDQ1YmFkYTYwMjAxZGYyMGM5NjI5ZTE4OTY2LnBuZz9fX2lkPTMxNDM21.jpg" alt="" width="300" height="290" class="alignleft size-medium wp-image-2416" /></a><a class="show_link">Гражданское строительство<span>&#9660;</span></a><div>
<div class="portfolio-sort-container isotope">
<?php  $args=array('post_type' => 'portfolio','post_status'=> 'publish','post__in'=> array(2399,721,2649,2663),'order'=> 'ASC');
current_tab($args); ?>
</div></div></div>

<div class="link_holder"><a href="/wp-content/uploads/2018/07/e`lektroe`nergetika.jpg"><img src="/wp-content/uploads/2018/07/e`lektroe`nergetika.jpg" alt="Металлоконструкции для ЛЭП" width="300" height="200" class="alignleft size-medium wp-image-748" /></a><a class="show_link">Электроэнергетика и электротехника<span>&#9660;</span></a><div>
<div class="portfolio-sort-container isotope">
<?php  $args=array('post_type' => 'portfolio','post_status'=> 'publish','post__in'=> array(2699,739),'order'=> 'ASC');
current_tab($args); ?>
</div></div></div>

</div>
</div>
</div>


</div>

<div class="container container_split dynamic_element dynamic_el_3"><div class="content twelve alpha units template-dynamic template-dynamic-metal_structures">
<div class="post-entry post-entry-dynamic dynamic_element dynamic_el_5"><div class="entry-content">

<h1 class="post-title dynamic-post-title"><?php the_title(); ?></h1>
<?php the_content(); ?>

<?php endwhile; ?>
<?php endif; ?>

</div>
</div>
</div>
</div>
				
<script type='text/javascript'>
	$( '.show_link' ).click(function() {
        $(this).toggleClass('active_link');
       /*$('.link_holder').children('div').css('position','relative');*/
	var object = $(this).parent().find('div').get(0);
        var obj2 = $(this).parent().get(0);
	var obj = $(this).find('span').get(0);
 $(this).parent().toggleClass('active_tab');
/*object.style.position= (object.style.position== 'relative') ? 'absolute' : 'relative';
obj2.style.width= (obj2.style.width== '100%') ? '49%' : '100%';
object.style.height= (object.style.height== 'auto') ? '0px' : 'auto';*/
obj.innerHTML= (obj.innerHTML == '▼') ? '▲' : '▼';
});
</script>				
				
				
				
			</div><!--end container-->


	<!-- ####### END MAIN CONTAINER ####### -->


<?php get_footer(); ?>