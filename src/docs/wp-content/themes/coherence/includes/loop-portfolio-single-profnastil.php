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
		<div class="eight units alpha min_height_1">
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
						echo "<a href='/'>Главная</a> - <a href='/nashi-obektyi-2'>".$mycat -> name."</a> - " . $post->post_title ;
					}else {
						echo "<a href='/'>Главная</a> - <a href='/". $mycat -> slug ."'>".$mycat -> name."</a> - " . $post->post_title ;
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
						echo " <a href='". $post_parent_slug."'>".$post_parent_title."</a> - " . $title_this_post ;
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
					echo "<a href='/'>Главная</a> - <a href='/". $mycat -> slug ."'>".$mycat -> name."</a> - <a href='".get_permalink($post_parent -> ID)."'>".$post_parent_title."</a> - " . $title_this_post ;
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
		</div>
		<div class="four units entry-content">
			<img src="https://metallgarant-spb.ru/wp-content/uploads/2018/02/skuvshe.jpg" alt="" style="margin: 30px 0 0; width: 290px !important; cursor: pointer;"  class="java_link2" onclick="window.location.href = '/metalloprokat-v-kredit/'">

		
		</div>
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
	<table class="profnastil__table">
		<tr>
			<td><a href="/product/profnastil/ocinkovannyj/"><img src="/wp-content/themes/coherence/images/profnastil/1.jpg"><span>профлист Оцинкованный</span></a></td>
			<td><a href="/product/profnastil/polimernyj/"><img src="/wp-content/themes/coherence/images/profnastil/2.jpg"><span>профлист Полимерный</span></a></td>
			<td><a href="/product/profnastil/krovelnyiy-profnastil/"><img src="/wp-content/uploads/2018/02/krovelnyiy-proflist.jpg"><span>Кровельный</span></a></td>
		</tr>
		<tr>
			<td><a href="/product/profnastil/profnastil-stenovoy/"><img src="/wp-content/uploads/2018/02/prof4.jpg"><span>Стеновой</span></a></td>
			<td><a href="/product/profnastil/universalnyiy-profnastil/"><img src="/wp-content/uploads/2018/02/prof1.jpg"><span>Универсальный</span></a></td>
			<td><a href="/product/profnastil/nesushhiy-profnastil/"><img src="/wp-content/uploads/2018/02/prof2.jpg"><span>Несущий</span></a></td>
				</tr>
		<tr>
			<td><a href="/product/profnastil/dlya-zabora/"><img src="/wp-content/uploads/2018/02/profilirovannyiy-list-dlya-zabora1.jpg"><span>Для забора</span></a></td>
		</tr>
	</table>
<!-- ОПИСАНИЕ -->

<h3>Купить профнастил в СПб и Москве</h3>
<a href="https://metallgarant-spb.ru/wp-content/uploads/2013/04/markirovka.jpg"><img src="https://metallgarant-spb.ru/wp-content/uploads/2013/04/markirovka.jpg" alt="маркировка профнастила" width="903" height="200" class="alignleft size-full wp-image-9852" /></a>
<p>&nbsp;</p>
<h3>Профнастил с доставкой от производителя. Марки продукции, которые мы предлагаем:</h3>
<p>&nbsp;</p>

<div class="dataTables_scrollHead" style="margin: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; overflow: auto; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Open Sans&quot;; vertical-align: baseline; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); overflow: hidden; position: relative; width: 610px;">
<div class="dataTables_scrollHeadInner" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; box-sizing: content-box; width: 610px;">
<table class="dataTable no-footer tablepress tablepress-id-308" role="grid" style="border-collapse:collapse; border-spacing:0px; border:none; overflow: auto; clear:both; font-family:inherit; font-size:11px; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; line-height:inherit; margin-bottom:0px !important; margin-left:0px; margin-right:0px !important; margin-top:0px !important; padding:0px; vertical-align:baseline; width:610px">
	<thead style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
		<tr class="row-1 odd" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<th class="column-2 sorting_disabled" colspan="1" rowspan="1" style="font-size: inherit; margin: 0px; padding: 8px; border-top: none; border-right: none; border-bottom: 1px solid rgb(221, 221, 221); border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-stretch: inherit; line-height: 1.5em; font-family: inherit; vertical-align: middle; letter-spacing: 1.5px; text-transform: uppercase; text-align: left; background: 0px 0px rgb(217, 237, 247); width: 127px; float: none !important;">ОПИСАНИЕ</th>
			<th class="column-3 sorting_disabled" colspan="1" rowspan="1" style="font-size: inherit; margin: 0px; padding: 8px; border-top: none; border-right: none; border-bottom: 1px solid rgb(221, 221, 221); border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-stretch: inherit; line-height: 1.5em; font-family: inherit; vertical-align: middle; letter-spacing: 1.5px; text-transform: uppercase; text-align: left; background: 0px 0px rgb(217, 237, 247); width: 235px; float: none !important;">ОБЛАСТЬ ПРИМЕНЕНИЯ</th>
		</tr>
	</thead>
</table>
</div>
</div>

<div class="dataTables_scrollBody" style="margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; line-height: inherit; font-family: &quot;Open Sans&quot;; vertical-align: baseline; color: rgb(102, 102, 102); background-color: rgb(255, 255, 255); position: relative; overflow: auto; width: 610px;">
<table class="dataTable no-footer tablepress tablepress-id-308" id="tablepress-308" role="grid" style="border-collapse:collapse; overflow: auto; border-spacing:0px; border:none; clear:both; font-family:inherit; font-size:11px; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; line-height:inherit; margin:0px !important; padding:0px; vertical-align:baseline; width:610px" >
	<thead style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
		<tr class="row-1 odd" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; height: 0px;">
			<th class="column-1 sorting_disabled" colspan="1" rowspan="1" style="font-size: inherit; margin: 0px; padding: 0px 8px; border-top: 0px none; border-right: none; border-bottom: 0px solid rgb(221, 221, 221); border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-stretch: inherit; line-height: 1.5em; font-family: inherit; vertical-align: middle; letter-spacing: 1.5px; text-transform: uppercase; text-align: left; background: 0px 0px rgb(217, 237, 247); width: 200px; height: 0px; float: none !important;">
			<div class="dataTables_sizing" style="font-size: inherit; margin: 0px !important; padding: 0px !important; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; height: 0px; overflow: hidden;">&nbsp;</div>
			</th>
			<th class="column-2 sorting_disabled" colspan="1" rowspan="1" style="font-size: inherit; margin: 0px; padding: 0px 8px; border-top: 0px none; border-right: none; border-bottom: 0px solid rgb(221, 221, 221); border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-stretch: inherit; line-height: 1.5em; font-family: inherit; vertical-align: middle; letter-spacing: 1.5px; text-transform: uppercase; text-align: left; background: 0px 0px rgb(217, 237, 247); width: 127px; height: 0px; float: none !important;">
			<div class="dataTables_sizing" style="font-size: inherit; margin: 0px !important; padding: 0px !important; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; height: 0px; overflow: hidden;">&nbsp;</div>
			</th>
			<th class="column-3 sorting_disabled" colspan="1" rowspan="1" style="font-size: inherit; margin: 0px; padding: 0px 8px; border-top: 0px none; border-right: none; border-bottom: 0px solid rgb(221, 221, 221); border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-stretch: inherit; line-height: 1.5em; font-family: inherit; vertical-align: middle; letter-spacing: 1.5px; text-transform: uppercase; text-align: left; background: 0px 0px rgb(217, 237, 247); width: 235px; height: 0px; float: none !important;">
			<div class="dataTables_sizing" style="font-size: inherit; margin: 0px !important; padding: 0px !important; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; height: 0px; overflow: hidden;">&nbsp;</div>
			</th>
		</tr>
	</thead>
	<tbody class="row-hover" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
		<tr class="row-2 even" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 0px; border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2017/11/s8-poli.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="1"><img alt="1" class="alignleft size-medium wp-image-5065" src="https://metallgarant-spb.ru/wp-content/uploads/2017/11/s8-poli.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 0px; border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-s8/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профнастил C8-1150</a>&nbsp;<br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.4-0.8 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 1205 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 1205 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина: 1150 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Длина: 1.0 - 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 0px; border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; white-space: nowrap; float: none !important;">Стеновой:&nbsp;<br style="margin: 0px; padding: 0px;" />
			ограждения, заборы,&nbsp;<br style="margin: 0px; padding: 0px;" />
			ворота, калитки.</td>
		</tr>
		<tr class="row-3 odd" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2017/11/Profnastil-S-10polimer.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="2"><img alt="2" class="alignleft size-medium wp-image-5066" src="https://metallgarant-spb.ru/wp-content/uploads/2017/11/Profnastil-S-10polimer.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-s10/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист C10-1100&nbsp;</a><br style="margin: 0px; padding: 0px;" />
			Толщина стали 0.4-0.8 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина 1154 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина 1100 мм</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); white-space: nowrap; float: none !important;">Стеновой: граждения, заборы,<br style="margin: 0px; padding: 0px;" />
			ворота, калитки.</td>
		</tr>
		<tr class="row-4 even" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2017/11/c17-poli.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="3"><img alt="3" class="alignleft size-medium wp-image-5067" src="https://metallgarant-spb.ru/wp-content/uploads/2017/11/c17-poli.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-s17/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист C17-1100&nbsp;</a><br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.5-0.8 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 1162 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина: 1100 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Длина: 1.0 - 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; white-space: nowrap; float: none !important;">Стеновой:&nbsp;<br style="margin: 0px; padding: 0px;" />
			граждения, заборы, ворота, калитки.</td>
		</tr>
		<tr class="row-5 odd" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2017/12/c18-poli.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="3"><img alt="3" class="alignleft size-medium wp-image-5067" src="https://metallgarant-spb.ru/wp-content/uploads/2017/12/c18-poli.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-s18/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист C18-1100</a><br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.5-0.8 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 1150 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина: 1080 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Длина: 1.0 - 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); white-space: nowrap; float: none !important;">Стеновой:&nbsp;<br style="margin: 0px; padding: 0px;" />
			граждения, заборы, ворота, калитки.</td>
		</tr>
		<tr class="row-6 even" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2017/12/c20-poli.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="3"><img alt="3" class="alignleft size-medium wp-image-5067" src="https://metallgarant-spb.ru/wp-content/uploads/2017/12/c20-poli.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-s20/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист C20-1100</a><br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.5-0.8 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 1150 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина: 1100 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Длина: 1.0 - 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; white-space: nowrap; float: none !important;">Стеновой:&nbsp;<br style="margin: 0px; padding: 0px;" />
			граждения, заборы, ворота, калитки.</td>
		</tr>
		<tr class="row-7 odd" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2018/02/mp20.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="мп20"><img alt="мп20" class="alignleft size-medium wp-image-9159" src="https://metallgarant-spb.ru/wp-content/uploads/2018/02/mp20-300x121.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-mp20/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист МП20-1100</a><br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.4-0.8 мм<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 1150 мм<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина: 1100 мм<br style="margin: 0px; padding: 0px;" />
			Длина: 1.0 - 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); white-space: nowrap; float: none !important;">Универсальный:&nbsp;<br style="margin: 0px; padding: 0px;" />
			обустройство кровли, перегородок,&nbsp;<br style="margin: 0px; padding: 0px;" />
			ограждений, забора.</td>
		</tr>
		<tr class="row-8 even" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2017/11/c21-poli.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="4"><img alt="4" class="alignleft size-medium wp-image-5068" src="https://metallgarant-spb.ru/wp-content/uploads/2017/11/c21-poli.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-s21/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист C21-1000</a><br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.5-0.8 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 1054 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина: 1000 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Длина: 1.0 - 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; white-space: nowrap; float: none !important;">Универсальный:&nbsp;<br style="margin: 0px; padding: 0px;" />
			обустройство кровли, перегородок,&nbsp;<br style="margin: 0px; padding: 0px;" />
			ограждений, забора.</td>
		</tr>
		<tr class="row-9 odd" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2017/11/ns35-poli.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="5"><img alt="5" class="alignleft size-medium wp-image-5069" src="https://metallgarant-spb.ru/wp-content/uploads/2017/11/ns35-poli.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-ns35/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист НС35-1000</a><br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.4-0.8 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 1060 мм<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина: 1000 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Длина: 1.0 - 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); white-space: nowrap; float: none !important;">Универсальный:&nbsp;<br style="margin: 0px; padding: 0px;" />
			обустройство кровли, стеновой.&nbsp;<br style="margin: 0px; padding: 0px;" />
			Исключает боковое протекание</td>
		</tr>
		<tr class="row-10 even" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2018/10/ns44.jpe" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="нс44 полимер"><img alt="нс44 полимер" class="alignleft size-medium wp-image-9273" src="https://metallgarant-spb.ru/wp-content/uploads/2018/10/ns44.jpe" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-ns44/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист НС44-1000</a><br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.5-0.8 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 1070 мм<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина: 1000 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Длина: 1.0 - 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; white-space: nowrap; float: none !important;">Универсальный:&nbsp;<br style="margin: 0px; padding: 0px;" />
			обустройство кровли, стеновой.&nbsp;<br style="margin: 0px; padding: 0px;" />
			Исключает боковое протекание</td>
		</tr>
		<tr class="row-11 odd" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2017/11/nc-57-poli.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="6"><img alt="6" class="alignleft size-medium wp-image-5070" src="https://metallgarant-spb.ru/wp-content/uploads/2017/11/nc-57-poli.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-n57/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист Н57-750</a><br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.5-0.8 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 805 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Длина: 1.0 - 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); white-space: nowrap; float: none !important;">Несущий:&nbsp;<br style="margin: 0px; padding: 0px;" />
			строительство промышленных зданий,&nbsp;<br style="margin: 0px; padding: 0px;" />
			кровли&nbsp;и для перекрытий.&nbsp;<br style="margin: 0px; padding: 0px;" />
			Выдерживает значительные нагрузки.&nbsp;<br style="margin: 0px; padding: 0px;" />
			Устойчивость к ветровым&nbsp;<br style="margin: 0px; padding: 0px;" />
			и снеговым нагрузкам.</td>
		</tr>
		<tr class="row-12 even" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2017/11/ns-60-poli.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="7"><img alt="7" class="alignleft size-medium wp-image-5071" src="https://metallgarant-spb.ru/wp-content/uploads/2017/11/ns-60-poli.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-n60/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист Н60-845</a><br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.6-0.9 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 902 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина: 845 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Длина: от 1 до 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; white-space: nowrap; float: none !important;">Несущий:&nbsp;<br style="margin: 0px; padding: 0px;" />
			строительство промышленных зданий,&nbsp;<br style="margin: 0px; padding: 0px;" />
			кровли&nbsp;и для перекрытий.&nbsp;<br style="margin: 0px; padding: 0px;" />
			Выдерживает значительные нагрузки.&nbsp;<br style="margin: 0px; padding: 0px;" />
			Устойчивость к ветровым&nbsp;<br style="margin: 0px; padding: 0px;" />
			и снеговым нагрузкам.</td>
		</tr>
		<tr class="row-13 odd" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2017/11/ns75-poli.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="8"><img alt="8" class="alignleft size-medium wp-image-5072" src="https://metallgarant-spb.ru/wp-content/uploads/2017/11/ns75-poli.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-n75/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист Н75-750</a>&nbsp;<br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.5-1.0 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 800 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина: 750 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Длина: 1.0 - 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background: 0px 0px rgb(249, 249, 249); white-space: nowrap; float: none !important;">Несущий:&nbsp;<br style="margin: 0px; padding: 0px;" />
			строительство промышленных зданий,&nbsp;<br style="margin: 0px; padding: 0px;" />
			кровли&nbsp;и для перекрытий.&nbsp;<br style="margin: 0px; padding: 0px;" />
			Выдерживает значительные нагрузки.&nbsp;<br style="margin: 0px; padding: 0px;" />
			Устойчивость к ветровым&nbsp;<br style="margin: 0px; padding: 0px;" />
			и снеговым нагрузкам.</td>
		</tr>
		<tr class="row-14 even" role="row" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;">
			<td class="column-1" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a class="cboxElement" href="https://metallgarant-spb.ru/wp-content/uploads/2017/11/ns-114-poli.jpg" rel="lightbox[707]" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240); float: left; position: relative; display: inline-block; left: auto;" title="9"><img alt="9" class="alignleft size-medium wp-image-5073" src="https://metallgarant-spb.ru/wp-content/uploads/2017/11/ns-114-poli.jpg" style="display:block; float:left; font-family:inherit; font-size:inherit; font-stretch:inherit; font-style:inherit; font-variant:inherit; font-weight:inherit; height:auto; left:0px; line-height:inherit; margin:0px; max-width:none; padding:0px; vertical-align:baseline; width:200px" /></a></td>
			<td class="column-2" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; float: none !important;"><a href="https://metallgarant-spb.ru/product/profnastil/profnastil-n114/" style="font-size: inherit; margin: 0px; padding: 0px; border: 0px rgb(225, 225, 225); font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline; outline: 0px; color: rgb(10, 167, 240);">Профлист Н114-600</a>&nbsp;<br style="margin: 0px; padding: 0px;" />
			Толщина стали: 0.7-1.2 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Габаритная ширина: 653 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Монтажная ширина: 600 мм&nbsp;<br style="margin: 0px; padding: 0px;" />
			Длина: 1.0 - 13.5 м</td>
			<td class="column-3" style="font-size: 12px; margin: 0px; padding: 8px; border-top: 1px solid rgb(221, 221, 221); border-right: none; border-bottom: none; border-left: none; border-image: initial; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; line-height: inherit; font-family: inherit; vertical-align: top; background-image: initial; background-position: 0px 0px; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; white-space: nowrap; float: none !important;">Несущий:&nbsp;<br style="margin: 0px; padding: 0px;" />
			строительство промышленных зданий,&nbsp;<br style="margin: 0px; padding: 0px;" />
			кровли&nbsp;и для перекрытий.&nbsp;<br style="margin: 0px; padding: 0px;" />
			Выдерживает значительные нагрузки.&nbsp;<br style="margin: 0px; padding: 0px;" />
			Устойчивость к ветровым и снеговым<br style="margin: 0px; padding: 0px;" />
			нагрузкам. Можно в качестве&nbsp;<br style="margin: 0px; padding: 0px;" />
			не снимаемой опалубки.</td>
		</tr>
	</tbody>
</table>
</div>

<h2>Виды профнастила</h2>
<font style="font-size: 12pt;">
<a href="https://metallgarant-spb.ru/wp-content/uploads/2013/04/vidyi-profnastila.jpg"><img src="https://metallgarant-spb.ru/wp-content/uploads/2013/04/vidyi-profnastila-300x210.jpg" alt="виды профнастила" width="300" height="210" class="alignleft size-medium wp-image-8349" /></a>

Покрытие из алюцинка позволяет повысить устойчивость профнастила к коррозии. Кроме того, такие профильные листы более пластичны и эластичны, что делает спектр их применения еще шире.
	Оцинкованный металлический профнастил с покрытием из полимеров наиболее практичен и распространён. Полимерное покрытие позволяет обеспечить долговечность эксплуатации профнастила, его эстетичность, которая сохраняется в течение долгих лет. Покрытие из полимеров позволяет существенно разнообразить цветовые решения, благодаря чему подобные изделия выполняют не только практическую, но и эстетическую функцию. Такой материал отлично подходит для декоративной облицовки стен, обустройства кровли.
	

<h3>Отличительные особенности профнастила</h3>
Основной отличительной особенностью профнастила являются высокие прочностные характеристики, которые обеспечиваются за счёт высоты волны. Благодаря этому листы даже большой площади не прогибаются и не провисают во время эксплуатации. Высокая прочность также позволяет обойтись без дополнительных элементов каркаса.

Профнастил является доступным материалом. Цена на металлопрофиль и стоимость листов формируется под влиянием различных критериев:
<ul style="padding-left: 40px; list-style: disc;">
	<li>толщина стального листа;</li>
	<li>высота профилирования;</li>
	<li>вид антикоррозийного покрытия (оцинковка, алюмоцинк, полимеры, лакокрасочные материалы).</li>
</ul>
Профнастил является распространенным строительным материалом, имеющим широкий спектр применения. С его помощью обустраивается кровля, возводятся перекрытия и заборы, обшиваются фасады зданий. Широкое применение металлопрофильный лист нашел в строительстве быстровозводимых конструкций (складов, ангаров, павильонов и т. д.).

Невысокий вес и простота монтажа позволяют проводить все необходимые работы без специальной подготовки и помощи специалистов.

По показателям шумо-, гидро, теплоизоляции профнастил превосходит большинство популярных материалов.
	</font>
<br><br>
<? if( has_term( 'prokat', 'portfolio_entries' ) ) { ?>	

<div class="price_table">

<?php
			$meta = avia_portfolio_meta(get_the_ID());
			if($meta)
			{
				echo $meta;
				echo avia_advanced_hr(false, 'small');
			}
			$price_id = avia_post_meta($id, 'price');
			$get_table = tablepress_get_table("id=$price_id" );
			$pos      = strripos($get_table, "not found");
			
			
			
			if($pos > 0 || $price_id == 1):
			else:
				tablepress_print_table( "id=$price_id" );
			endif;
			
			/*the_content(__('Посмотреть цены','avia_framework').'<span class="more-link-arrow"> &rarr;</span>');*/
			if(has_tag() && is_single())
			{
				echo '<span class="text-sep">/</span><span class="blog-tags minor-meta">';
				echo the_tags('<strong>'.__('Tags: ','avia_framework').'</strong><span>');
				echo '</span></span>';
			}
			?>
</div>


		<!-- /calc -->

		<? } ?>

<span style="display:none;"><a href="#order_form_pop" id="link_order" class="fancybox-inline">Заказать</a></span>
 <div style="display:none" class="fancybox-hidden">
 <div id="order_form_pop">                
  <?php echo do_shortcode('[contact-form-7 id="3884" title="Заказ товара"]'); ?>
 </div>
 </div>
<script type="text/javascript">
window.onload=function() {
$('.price_table tbody tr').append("<td><input type='number' placeholder='Количество'/><a href='#order_form_pop' class='order fancybox-inline' onclick='test();'>Заказать</a></td>");
$('.price_table thead tr').append("<th style='text-align:center; min-width: 200px;'>Заказ</th>");
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
