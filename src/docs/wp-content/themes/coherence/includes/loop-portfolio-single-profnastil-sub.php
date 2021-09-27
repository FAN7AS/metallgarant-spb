<?php
	global $avia_config, $slider, $post_loop_count;
	$post_class = "post-entry-".avia_get_the_id();
	$slider = new avia_slideshow(avia_get_the_id());
	$slider	->setImageSize('fullsize');
	do_action( 'avia_action_query_check' , 'loop-portfolio-single' );
	// check if we got posts to display:
	if (have_posts()) :
		while (have_posts()) : the_post();
?>
	<div class='post-entry post-entry-type-portfolio <?php echo $post_class; ?>'>
		<span class='entry-border-overflow extralight-border'></span>

			<?php //bcn_display(); ?>
			<?php if($post -> ID == 1263): ?>
					<a href="/">Главная</a> - <a href="/">Металлопрокат</a> - Арматура
				<?php
				else:
				if($post ->post_parent == 0): //если у терма нету родительского терма
					$productcategories = wp_get_object_terms($post->ID, 'portfolio_entries');
					foreach($productcategories as $pc):
						$term = get_term_by('id', $pc -> term_taxonomy_id, 'portfolio_entries');
					endforeach;
					$mycat = get_term_by('id', $term -> term_taxonomy_id, 'portfolio_entries');
					if($term -> term_taxonomy_id == 6){
						echo "<a href='/'>Главная</a> - <a href='/'>".$mycat -> name."</a> - " . $post->post_title ;
					}
					elseif($term -> term_taxonomy_id == 21){
						echo "<a href='/'>Главная</a> - <a href='/nashi-obektyi-2/'>".$mycat -> name."</a> - " . $post->post_title ;
					}else {
						echo "<a href='/'>Главная</a> - <a href='/". $mycat -> slug ."/'>".$mycat -> name."</a> - " . $post->post_title ;
					}
				//print_r($mycat -> slug);
				else: //если у терма есть родительский терм
					if($post ->post_parent == 1263): ?>
						<a href="/">Главная</a> - <a href="/">Металлопрокат</a> -
						<?php
						$title_this_post = $post ->post_title;
						$post_parent = get_post($post -> post_parent);
						$parent_post = wp_get_object_terms($post ->post_parent, 'portfolio_entries');
						$post_parent_title = $post_parent -> post_title;
						$post_parent_slug = $post_parent -> guid;
						echo " <a href='". $post_parent_slug."/'>".$post_parent_title."</a> - " . $title_this_post ;
					else:
						$title_this_post = $post ->post_title;
						$post_parent = get_post($post -> post_parent);
						$parent_post = wp_get_object_terms($post ->post_parent, 'portfolio_entries');
						$post_parent_title = $post_parent -> post_title;
						$post_parent_slug = $post_parent -> guid;
						$productcategories = wp_get_object_terms($post_parent -> ID, 'portfolio_entries');

						foreach($productcategories as $pc):
							$term = get_term_by('id', $pc -> term_taxonomy_id, 'portfolio_entries');
						endforeach;
					$mycat = get_term_by('id', $term -> term_taxonomy_id, 'portfolio_entries');
					//echo "<a href='/'>Главная</a> - <a href='/". $mycat -> slug ."'>".$mycat -> name."</a> - <a href='". $post_parent_slug."'>".$post_parent_title."</a> - " . $title_this_post ;
					echo "<a href='/'>Главная</a> - <a href='/". ($mycat -> slug=='prokat'?'':$mycat -> slug.'/') ."'>".$mycat -> name."</a> - <a href='".get_permalink($post_parent -> ID)."'>".$post_parent_title."</a> - " . $title_this_post ;
					endif;
				endif;
			endif;
			?>
			
			<h1 style="margin:10px 0;font-size:24px"><?php the_title() ?></h1>

 
<?php if($slider->slidecount) echo /*$slider->display()*/ ""; ?>
<?php
$attr =  array(
	'class'	=> "alignright",
);
 echo get_the_post_thumbnail( $post -> ID, 'medium', $attr ); 
?>
			<? the_content(__('Посмотреть цены','avia_framework').'<span class="more-link-arrow"> &rarr;</span>'); ?>	

		<span style="display:none;"><a href="#order_form_pop" id="link_order" class="fancybox-inline">Заказать</a></span>
 <div style="display:none" class="fancybox-hidden">
 <div id="order_form_pop">                
  <?php echo do_shortcode('[contact-form-7 id="3884" title="Заказ товара"]'); ?>
 </div>
 </div>
<script type="text/javascript">
window.onload=function() {
$('.price_table tbody tr').append("<td><input type='number' placeholder='Количество'/><a href='#order_form_pop' class='order fancybox-inline' onclick='test();'>Заказать</a></td>");
$('.price_table thead tr').append("<th style='text-align:left;width:100%;white-space: nowrap;'>Количество Заказ</th>");	
$('#test').html("<a href='#order_form_pop' class='order fancybox-inline'>Заказать</a>");

$( ".order" ).click(function() {
 var item = $(this).parent().parent().find('.column-1').html();
var count = $(this).parent().find('input').val();
$('#count').val(count);
$('#item').val(item);
$("#link_order")[0].click();
});
}
</script>	

	</div><!--end post-entry-->
	<!-- /wp-content/themes/coherence/ -->
	<style type="text/css">
	.profnastil__table tr td a{
		display: inline-block;
		width: 100%;
		font-size: 22px;
		color: #777;
		text-decoration: none;
		cursor: pointer;
		font-weight: bold;
    	font-family: Calibri,Arial,sans-serif;
    	text-transform: uppercase;
	}
	.profnastil__table{
		border-left: 1px solid #E1E1E1;
	}
	.profnastil__table tr td{
		text-align: center;
		height: 309px;
		vertical-align: middle;
	}
	.profnastil__table tr td img{
		text-align: center;
		width: 90%;
		margin-bottom: 20px;
	}
	@media only screen and (max-width: 767px) and (min-width: 480px){
		.profnastil__table tr td a{
			font-size: 15px;
		}
		.profnastil__table tr td{
			height: 209px;
		}
	}
	@media only screen and (max-width: 480px){
		.profnastil__table tr td a{
			font-size: 10px;
		}
		.profnastil__table tr td{
			height: 109px;
		}
	}
	</style>
<!-- 	<table class="profnastil__table">
		<tr>
			<td><a href="/product/profnastil/ocinkovannyj"><img src="/wp-content/themes/coherence/images/profnastil/1.jpg"><span>профлист Оцинкованный</span></a></td>
			<td><a href="/product/profnastil/polimernyj"><img src="/wp-content/themes/coherence/images/profnastil/2.jpg"><span>профлист Полимерный</span></a></td>
			<td><a href="/product/profnastil/metallocherepeca"><img src="/wp-content/themes/coherence/images/profnastil/3.jpg"><span>Металлочерепица</span></a></td>
		</tr>
		<tr>
			<td><a href="/product/profnastil/stolbiki-i-lagi"><img src="/wp-content/themes/coherence/images/profnastil/4.jpg"><span>Столбики и лаги</span></a></td>
			<td><a href="/product/profnastil/dobornye-jelementy"><img src="/wp-content/themes/coherence/images/profnastil/5.jpg"><span>Доборные элементы кровли</span></a></td>
			<td><a href="/product/profnastil/soputstvujushhie-tovary"><img src="/wp-content/themes/coherence/images/profnastil/6.jpg"><span>Сопутствующие товары</span></a></td>
		</tr>
	</table>
 -->

<? if( has_term( 'prokat', 'portfolio_entries' ) ) { 	

show_table();

 } ?>

<span style="display:none;"><a href="#order_form_pop" id="link_order" class="fancybox-inline">Заказать</a></span>
 <div style="display:none" class="fancybox-hidden">
 <div id="order_form_pop">                
  <?php echo do_shortcode('[contact-form-7 id="3884" title="Заказ товара"]'); ?>
 </div>
 </div>
<script type="text/javascript">
window.onload=function() {
	//$('.price_table').insertAfter('.post-entry');
$('.price_table tbody tr').append("<td><input type='number' placeholder='Количество'/><a href='#order_form_pop' class='order fancybox-inline' onclick='test();'>Заказать</a></td>");
$('.price_table thead tr').append("<th style='text-align:left;width:100%;white-space: nowrap;'>Количество&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Заказ</th>");	
$('#test').html("<a href='#order_form_pop' class='order fancybox-inline'>Заказать</a>");

$( ".order" ).click(function() {
 var item = $(this).parent().parent().find('.column-1').html();
var count = $(this).parent().find('input').val();
$('#count').val(count);
$('#item').val(item);
$("#link_order")[0].click();
});
}
</script>	




<style type="text/css">
	.spc_hdd{
		display: none;
	}
</style>
<!-- /ОПИСАНИЕ-->
<?php
endwhile;
else:
?>	
<div class="entry">
<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
<p><?php _e('Sorry, no posts matched your criteria', 'avia_framework'); ?></p>
</div>
<?php
endif;
if(!isset($avia_config['remove_pagination'] )) echo avia_pagination();
?>
