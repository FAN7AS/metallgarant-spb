<?php 
global $avia_config;

	/*
	 * check which page template should be applied: 
	 * cecks for dynamic pages as well as for portfolio, fullwidth, blog, contact and any other possibility :)
	 * Be aware that if a match was found another template wil be included and the code bellow will not be executed
 	 * located at the bottom of includes/helper-templates.php
	 */
	 do_action( 'avia_action_template_check' , 'page' );

	 get_header();
	/*
	Template Name: Страница Контакты
	*/

 	 
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
					
?> 


<div itemscope itemtype="http://schema.org/Organization">



<h1 style="margin-bottom: 15px;" itemprop="name"><? the_title(); ?></h1>
<?	} else {
			echo avia_title(false, false, 'small_title'); 
					
					}
				?>
				<div class='template-page content  <?php avia_layout_class( 'content' ); ?> units'>


				<div class="tabs">
					<div class="tabs_caption">
						<h2 class="tab_ind active">Офис</h2>
						<h2 class="tab_ind">Завод</h2>
						<h2 class="tab_ind">Шоу-Рум в Гатчине</h2>
						<h2 class="tab_ind">Шоу-Рум в Сосново</h2>
						<h2 class="tab_ind">Филиал в Москве</h2>
					</div>

					<div class="tabs_item active">
						<?php if(get_field('vkl1')){echo ''.get_field('vkl1').'';} ?>
						<div class="owl-carousel slider_vkl">
							<?php if( have_rows('sl1') ): ?>
								<?php while( have_rows('sl1') ): the_row(); 
								$image = get_sub_field('sl1_img');?>
									<div class="item">
										<img src="<?php echo $image['url']; ?>" alt="" />
									</div>
							<?php endwhile; ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="tabs_item">
						<?php if(get_field('vkl2')){echo ''.get_field('vkl2').'';} ?>
						<div class="owl-carousel slider_vkl">
							<?php if( have_rows('sl2') ): ?>
								<?php while( have_rows('sl2') ): the_row(); 
								$image = get_sub_field('sl2_img');?>
									<div class="item">
										<img src="<?php echo $image['url']; ?>" alt="" />
									</div>
							<?php endwhile; ?>
							<?php endif; ?>
						</div>						
					</div>
					<div class="tabs_item">
						<?php if(get_field('vkl3')){echo ''.get_field('vkl3').'';} ?>
						<div class="owl-carousel slider_vkl">
							<?php if( have_rows('sl3') ): ?>
								<?php while( have_rows('sl3') ): the_row(); 
								$image = get_sub_field('sl3_img');?>
									<div class="item">
										<img src="<?php echo $image['url']; ?>" alt="" />
									</div>
							<?php endwhile; ?>
							<?php endif; ?>
						</div>						
					</div>
					<div class="tabs_item">
						<?php if(get_field('vkl4')){echo ''.get_field('vkl4').'';} ?>
						<div class="owl-carousel slider_vkl">
							<?php if( have_rows('sl4') ): ?>
								<?php while( have_rows('sl4') ): the_row(); 
								$image = get_sub_field('sl4_img');?>
									<div class="item">
										<img src="<?php echo $image['url']; ?>" alt="" />
									</div>
							<?php endwhile; ?>
							<?php endif; ?>
						</div>						
					</div>
					<div class="tabs_item">					
						<?php if(get_field('vkl5')){echo ''.get_field('vkl5').'';} ?>
						<div class="owl-carousel slider_vkl">
							<?php if( have_rows('sl5') ): ?>
								<?php while( have_rows('sl5') ): the_row(); 
								$image = get_sub_field('sl5_ing');?>
									<div class="item">
										<img src="<?php echo $image['url']; ?>" alt="" />
									</div>
							<?php endwhile; ?>
							<?php endif; ?>
						</div>						
					</div>

				</div>


				<?php
				/* Run the loop to output the posts.
				* If you want to overload this in a child theme then include a file
				* called loop-page.php and that will be used instead.
				*/
				$avia_config['size'] = 'page';
				get_template_part( 'includes/loop', 'page' );
				?>
				
				


<?php if(get_field('tabl_sotr')){echo ''.get_field('tabl_sotr').'';} ?> 






				<span style="color: #003366;">
					<?php echo do_shortcode('[contact-form-7 id="3851" title="Контакты"]'); ?>
				</span>


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

	</div>
	<!-- ####### END MAIN CONTAINER ####### -->



<script>
jQuery(function() {
    jQuery('.tabs_caption').on('click', '.tab_ind:not(.active)', function() {
    jQuery(this).addClass('active').siblings().removeClass('active')
      .closest('.tabs').find('.tabs_item').removeClass('active').eq(jQuery(this).index()).addClass('active');
  });

});
</script>




<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>

<script>
ymaps.ready(init);
function init () {
    var myMap1 = new ymaps.Map("map1", {
        center:[59.866944, 30.472131],
        zoom: 13,
        controls: []
    });  
    var myMap2 = new ymaps.Map("map2", {
        center:[59.825047, 30.527516],
        zoom: 16,
        controls: []
    });   
    var myMap3 = new ymaps.Map("map3", {
        center:[59.526537, 30.083662],
        zoom: 14,
        controls: []
    });   
    var myMap4 = new ymaps.Map("map4", {
        center:[60.551173, 30.215828],
        zoom: 15,
        controls: []
    });   
    var myMap5 = new ymaps.Map("map5", {
        center:[55.832911, 37.939953],
        zoom: 12,
        controls: []
    });   


    var myGeoObjects1 = [];    
    // Указываем координаты метки
    myGeoObjects1 = new ymaps.Placemark([59.866944, 30.472131],{
                    balloonContentBody: 'Офис Ленинградского Завода МеталлГарант в Санкт-Петербурге',
                    },{
                    iconLayout: 'default#image',
                    // Путь до нашей картинки
						  iconImageHref: '/wp-content/themes/coherence/images/map_icon.png',
                    // Размеры иконки
                    iconImageSize: [70, 70],
                    // Смещение верхнего угла относительно основания иконки
                    iconImageOffset: [-35, -35]
    });                
    var clusterer1 = new ymaps.Clusterer({
        clusterDisableClickZoom: false,
        clusterOpenBalloonOnClick: false,
    });

    var myGeoObjects2 = [];    
    // Указываем координаты метки
    myGeoObjects2 = new ymaps.Placemark([59.825047, 30.527516],{
                    balloonContentBody: 'Ленинградский завод Металлоконструкций МеталлГарант',
                    },{
                    iconLayout: 'default#image',
                    // Путь до нашей картинки
						  iconImageHref: '/wp-content/themes/coherence/images/map_icon.png',
                    // Размеры иконки
                    iconImageSize: [70, 70],
                    // Смещение верхнего угла относительно основания иконки
                    iconImageOffset: [-35, -35]
    });                
    var clusterer2 = new ymaps.Clusterer({
        clusterDisableClickZoom: false,
        clusterOpenBalloonOnClick: false,
    });

    var myGeoObjects3 = [];    
    // Указываем координаты метки
    myGeoObjects3 = new ymaps.Placemark([59.526537, 30.083662],{
                    balloonContentBody: 'Шоу-рум МеталлГарант в Гатчине',
                    },{
                    iconLayout: 'default#image',
                    // Путь до нашей картинки
						  iconImageHref: '/wp-content/themes/coherence/images/map_icon.png',
                    // Размеры иконки
                    iconImageSize: [70, 70],
                    // Смещение верхнего угла относительно основания иконки
                    iconImageOffset: [-35, -35]
    });                
    var clusterer3 = new ymaps.Clusterer({
        clusterDisableClickZoom: false,
        clusterOpenBalloonOnClick: false,
    });

    var myGeoObjects4 = [];    
    // Указываем координаты метки
    myGeoObjects4 = new ymaps.Placemark([60.551173, 30.215828],{
                    balloonContentBody: 'Шоу-рум МеталлГарант в Сосново',
                    },{
                    iconLayout: 'default#image',
                    // Путь до нашей картинки
						  iconImageHref: '/wp-content/themes/coherence/images/map_icon.png',
                    // Размеры иконки
                    iconImageSize: [70, 70],
                    // Смещение верхнего угла относительно основания иконки
                    iconImageOffset: [-35, -35]
    });                
    var clusterer4 = new ymaps.Clusterer({
        clusterDisableClickZoom: false,
        clusterOpenBalloonOnClick: false,
    });

    var myGeoObjects5 = [];    
    // Указываем координаты метки
    myGeoObjects5 = new ymaps.Placemark([55.832911, 37.939953],{
                    balloonContentBody: 'Офис Ленинградского завода МеталлГарант в Москве',
                    },{
                    iconLayout: 'default#image',
                    // Путь до нашей картинки
						  iconImageHref: '/wp-content/themes/coherence/images/map_icon.png',
                    // Размеры иконки
                    iconImageSize: [70, 70],
                    // Смещение верхнего угла относительно основания иконки
                    iconImageOffset: [-35, -35]
    });                
    var clusterer5 = new ymaps.Clusterer({
        clusterDisableClickZoom: false,
        clusterOpenBalloonOnClick: false,
    });


    clusterer1.add(myGeoObjects1);
    myMap1.geoObjects.add(clusterer1);

    clusterer2.add(myGeoObjects2);
    myMap2.geoObjects.add(clusterer2);

    clusterer3.add(myGeoObjects3);
    myMap3.geoObjects.add(clusterer3);

    clusterer4.add(myGeoObjects4);
    myMap4.geoObjects.add(clusterer4);

    clusterer5.add(myGeoObjects5);
    myMap5.geoObjects.add(clusterer5);
}




</script>

<script src="<?php bloginfo('template_directory'); ?>/js/owl.carousel.min.js"></script>

<script>
var owl=jQuery(".owl-carousel");owl.owlCarousel( {
  loop: true,
  autoplay: true,
  margin: 0,
  nav: true,
  dots: false,
  autoplayTimeout: 17000,
  responsiveClass: false,
  responsive: {
    0: {
      items: 1,
    },
    500: {
      items: 1
    },
    780: {
      items: 1,
    },
    1000: {
      items: 1,
      loop: true
    }
  }
})
</script>



<?php get_footer(); ?>