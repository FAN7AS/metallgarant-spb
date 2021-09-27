<?php 
global $avia_config;

	/*
	 * check which page template should be applied: 
	 * cecks for dynamic pages as well as for portfolio, fullwidth, blog, contact and any other possibility :)
	 * Be aware that if a match was found another template wil be included and the code bellow will not be executed
 	 * located at the bottom of includes/helper-templates.php
	 */
	 do_action( 'avia_action_template_check' , 'page' );

	/*
	 * get_header is a basic wordpress function, used to retrieve the header.php file in your theme directory.
	 */	
	 get_header();
 	 
	?>
		
		<!-- ####### MAIN CONTAINER ####### -->
		<div class='container_wrap <?php avia_layout_class( 'main' ); ?>' id='main'>
			<div class='container'>
<? if(is_page('476') || is_page('1028') || is_page('1041') || is_page('488')|| is_page('3778')):?>
<script type="text/javascript">
window.onload=function() {
$('.price_table tbody tr').append("<td><input type='number' placeholder='Количество'/><a href='#order_form_pop' class='order fancybox-inline'>Заказать</a></td>");
$('.price_table thead tr').append("<th style='text-align:left;width:100%;white-space: nowrap;'>Количество Заказ</th>");	
$( ".order" ).click(function() {
 var item = $(this).parent().parent().find('.column-1').html();
var count = $(this).parent().find('input').val();
$('#count').val(count);
$('#item').val(item);
$("#link_order")[0].click();
});
}
</script>
<div  style="position: absolute;top: 17px;right: 32px;z-index: 99999;">
<a href='javascript:window.print(); void 0;' s class="print-page">Напечатать страницу</a>
<? if(is_page('476')) {?>  <a href="http://metallgarant-spb.ru/wp-content/uploads/2013/04/general_price.xlsx" style="margin-top:10px;
" class="print-page">Скачать прайс .xls</a> <?php }?>
<? if(is_page('1028')) {?>  <a href="http://metallgarant-spb.ru/wp-content/uploads/2013/05/Prays-na-otsinkovannuyu-produktsiyu.xlsx" style="margin-top:10px;
" class="print-page">Скачать прайс .xls</a> <?php }?>
<? if(is_page('1041')) {?>  <a href="http://metallgarant-spb.ru/wp-content/uploads/2013/05/Prays-na-nerzhaveyushhuyu-produktsiyu.xlsx"style="margin-top:10px;
" class="print-page">Скачать прайс .xls</a> <?php }?>
<? if(is_page('3778')) {?>  <a href="http://metallgarant-spb.ru/wp-content/uploads/2013/05/Prays-na-metallokonstruktsii.xlsx?v=2" style="margin-top:10px;
" class="print-page">Скачать прайс .xls</a> <?php }?>
<? if(is_page('488')) {?>  <a href="http://metallgarant-spb.ru/wp-content/uploads/2013/04/Prays-na-lezhalyiy-metalloprokat-na-sklade.xlsx" style="margin-top:10px;
" class="print-page">Скачать прайс .xls</a> <?php }?>
</div>
<? endif; ?>

				<?php 
					if(empty($avia_config['slide_output'])) 
					{
					
?> <h1 style="margin-bottom: 15px;"><? the_title(); ?></h1><?
//	echo avia_title(); 
					}
					else
					{
						echo avia_title(false, false, 'small_title'); 
					
					}
				?>
				<div class='template-page content  <?php avia_layout_class( 'content' ); ?> units'>

				<?php
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-page.php and that will be used instead.
				*/
				$avia_config['size'] = 'page';
				get_template_part( 'includes/loop', 'page' );
				?>
				
				<span style="display:none;"><a href="#order_form_pop" id="link_order" class="fancybox-inline">Заказать</a></span>
 <div style="display:none" class="fancybox-hidden">
 <div id="order_form_pop">                
  <?php echo do_shortcode('[contact-form-7 id="3884" title="Заказ товара"]'); ?>
 </div>
 </div>
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