<?php 
			global $avia_config;
						
			//reset wordpress query in case we modified it
			wp_reset_query();
			
	
			 /**
			 *  The footer default dummy widgets are defined in folder includes/register-widget-area.php
			 *  If you add a widget to the appropriate widget area in your wordpress backend the 
			 *  dummy widget will be removed and replaced by the real one previously defined
			 */
			?>
<?php if(is_singular('metalloprokat')){ ?>
<span style="display:none;"><a href="#order_form_pop" id="link_order" class="fancybox-inline">Заказать</a></span>
 <div style="display:none" class="fancybox-hidden">
 <div id="order_form_pop">                
  <?php echo do_shortcode('[contact-form-7 id="3884" title="Заказ товара"]'); ?>
 </div>
 </div>
		<script type="text/javascript">
window.onload=function() {
$('.price_table tbody tr').append("<td><input type='number' placeholder='Количество'/><a href='#order_form_pop' class='order fancybox-inline' >Заказать</a></td>");
$('.price_table thead tr').append("<th class='column-4' style='text-align:left;white-space: nowrap;'>Количество</th><th class='column-5' style='text-align:left;white-space: nowrap;'>Заказ</th>");	
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
	<?php } ?>



<?php if ( is_page(86) ) { ?>
	<div class="container">
	<div class="footer-block">
		<div class="one_third first">
			<p style="line-height:15px;">Пишите на почту - будем рады ответить <br /><strong>Наша почта:</strong> <a href="mailto:info@metallgarant-spb.ru">info@metallgarant-spb.ru</a><br />
			<a href="#letter_form_pop" id="link_order" class="fancybox-inline" style="margin:10px;" onclick="return false"><img src="<?php bloginfo('template_url') ?>/images/letter.png" style="margin: 0 10px;"/> Написать письмо</a>
			<div style="display:none" class="fancybox-hidden">
				<div id="letter_form_pop">                
				<?php echo do_shortcode('[contact-form-7 id="3903" title="Написать письмо"]'); ?>
				</div>
			</div>
			</p>
		</div>
		<div class="one_third">
			<img src="<?php bloginfo('template_url') ?>/images/phone-transparency.png" style="float:left;margin:5px 10px 0 0px;"/>
			<p>Звонок по России <strong>бесплатный</strong><br />
			<span class="ya-phone-5">8 (800) 100-80-65 </span><br /> 
			<strong>КРУГЛОСУТОЧНО 24/7/365</strong>
			</p>
		</div>
		<div class="one_third">
			<img src="<?php bloginfo('template_url') ?>/images/phone-callback.png" style="float:right;margin:5px 0 0 5px;"/>
			<p style="line-height:15px;text-align:center;">Оставьте заявку - мы перезвоним <br /> 
			в любое удобное для вас время<br />
			<a href="#contact_form_pop" class="fancybox-inline" onclick="return false">Заказать звонок</a>
			</p> 
		</div>
	</div>
</div>

<?php } else { ?>
	<div class="container">
	<div class="footer-block">
		<div class="title"><p>Свяжитесь с нами - и мы ответим на любой интересующий вас вопрос!</p></div>
		<div class="one_third first">
			<p style="line-height:15px;">Пишите на почту - будем рады ответить <br /><strong>Наша почта:</strong> <a href="mailto:info@metallgarant-spb.ru">info@metallgarant-spb.ru</a><br />
			<a href="#letter_form_pop" id="link_order" class="fancybox-inline" style="margin:10px;" onclick="return false"><img src="<?php bloginfo('template_url') ?>/images/letter.png" style="margin: 0 10px;"/> Написать письмо</a>
			<div style="display:none" class="fancybox-hidden">
				<div id="letter_form_pop">                
				<?php echo do_shortcode('[contact-form-7 id="3903" title="Написать письмо"]'); ?>
				</div>
			</div>
			</p>
		</div>
		<div class="one_third">
			<img src="<?php bloginfo('template_url') ?>/images/phone-transparency.png" style="float:left;margin:5px 10px 0 0px;"/>
			<p>Звонок по России <strong>бесплатный</strong><br />
			<span class="ya-phone-5">8 (812) 660-55-00</span><br /> 
			<strong>КРУГЛОСУТОЧНО 24/7/365</strong>
			</p>
		</div>
		<div class="one_third">
			<img src="<?php bloginfo('template_url') ?>/images/phone-callback.png" style="float:right;margin:5px 0 0 5px;"/>
			<p style="line-height:15px;text-align:center;">Оставьте заявку - мы перезвоним <br /> 
			в любое удобное для вас время<br />
			<a href="#contact_form_pop" class="fancybox-inline" onclick="return false">Заказать звонок</a>
			</p> 
		</div>
	</div>
</div>

<?php } ?>


			<!-- ####### FOOTER CONTAINER ####### -->
			<div class='container_wrap' id='footer' style="z-index:1;">
				<div class='container' style="z-index:1;">
				
					<?php 
					//create the footer columns by iterating  
					$columns = avia_get_option('footer_columns');
					
					$firstCol = 'first';
			        switch($columns)
			        {
			        	case 1: $class = ''; break;
			        	case 2: $class = 'one_half'; break;
			        	case 3: $class = 'one_third'; break;
			        	case 4: $class = 'one_fourth'; break;
			        	case 5: $class = 'one_fifth'; break;
			        }
					
					//display the footer widget that was defined at appearenace->widgets in the wordpress backend
					//if no widget is defined display a dummy widget, located at the bottom of includes/register-widget-area.php
					for ($i = 2; $i <= $columns; $i++)
					{
						if($i == 3){
							echo "<noindex><div class='flex_column one_half $firstCol'>";/*$class*/
							if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column'.$i) );
							echo "</div></noindex>";
							$firstCol = "";
						}else{
							echo "<div class='flex_column one_half $firstCol'>";/*$class*/
							if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer - column'.$i) );
							echo "</div>";
							$firstCol = "";
						}
					}
					
					?>

					
				</div>
				
			</div>
		<!-- ####### END FOOTER CONTAINER ####### -->
		
		
		
		<?php 
		
		// you can filter and remove the backlink with an add_filter function 
		// from your themes (or child themes) functions.php file if you dont want to edit this file
		// you can also just keep that link. I really do appreciate it ;)
		
		$kriesi_at_backlink =	apply_filters("kriesi_backlink", "- iqpromo");
		?>
		
		<!-- ####### SOCKET CONTAINER ####### -->
			<div class='container_wrap ' id='socket'>
				<div class='container'>


					<span class='copyright' style="margin-left:20px">&copy; 2001 - <?php echo date('Y'); ?> <?php _e('Copyright','avia_framework'); ?> - <?php echo get_bloginfo('name');?> / <a href="/product/proizvodstvo-metalloprokata-2/">Производство металлопроката</a> / <a href="/product/metallobazyi-sankt-peterburga-2/">Металлобазы Санкт-Петербурга и Москвы</a></span><span style="float:right;" class="ya-phone-4"><span class="ya-phone-1-1">8 (812) 660-5500</span><br /></span><br />

<noindex><p style="color: #ccc; font-size: 10px;">Данный прайс-лист носит исключительно информационный характер и ни при каких условиях не является публичной офертой, определяемой положениями ч. 2 ст. 437 Гражданского кодекса Российской Федерации.</p> </noindex>
				<!--</div>
				<div class="container" style="column-width: 500px">-->
<div itemtype="http://data-vocabulary.org/Review-aggregate" itemscope="" id="site_rating">
						<span itemprop="itemreviewed"><img src="/wp-content/uploads/star.png" alt="Оценка производства МеталлГарант"> Оценка: 4,8</span> (Голосов: <span itemprop="votes">49</span>)
						<span itemtype="http://data-vocabulary.org/Rating" itemscope="" itemprop="rating">
							<meta content="4.8" itemprop="value">
							<meta content="5" itemprop="best">
						</span>
					</div>
    <div>
        <a href="/policy" rel="nofollow" target="_blank" style="margin-right: 15px;">Политика конфиденциальности</a>&#9642;
        <a href="/otpisatsya-ot-rassyilki/" rel="nofollow" target="_blank" style="margin-left: 15px;">Отписаться от рассылки</a>
    </div>
</div>
			</div>
			<!-- ####### END SOCKET CONTAINER ####### -->
		
		<!-- </div> end wrap_all -->
		<script type="text/javascript">
$('.fancybox-inline').bind("click",function(e) {e.preventDefault();});
</script>


		
		
		<?php
		
			/*this adds a div with a fullscreen background container. due to compatibility reasons we use this method instead of a default css background*/
		
			$bg_image = avia_get_option('bg_image') == "custom" ? avia_get_option('bg_image_custom') : avia_get_option('bg_image');
			$bg_image_repeat = avia_get_option('bg_image_repeat');
			$the_post_id = avia_get_the_ID();
			
			if($new_bg_image = avia_post_meta($the_post_id, 'bg_image_custom'))
			{
				$bg_image = $new_bg_image;
				$bg_image_repeat = avia_post_meta($the_post_id, 'bg_image_settings');
			}
			
			if($bg_image && $bg_image_repeat == 'fullscreen') 
			{ ?>
				<!--[if lte IE 8]>
				<style type="text/css">
				.bg_container {
				-ms-filter:"progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $bg_image; ?>', sizingMethod='scale')";
				filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $bg_image; ?>', sizingMethod='scale');
				}
				</style>
				<![endif]-->
			<?php
				echo "<div class='bg_container' style='background-image:url(".$bg_image.");'></div>"; 
			}
			
			echo "<div class=''></div>"; 
		?>
		

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 
	avia_option('analytics', false, true, true);
	wp_footer();
	
	
?>
<div id="fb-root"></div>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108800058-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-108800058-1');
</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter21362176 = new Ya.Metrika({id:21362176,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/21362176" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- DATEPICKER -->
<script type="text/javascript" src="/wp-content/themes/coherence/js/jquery-ui.min.js"></script>
<script type="text/javascript">
(function( factory ) {
if ( typeof define === "function" && define.amd ) {
// AMD. Register as an anonymous module.
define([ "../datepicker" ], factory );
} else {
// Browser globals
factory( jQuery.datepicker );
}
}(function( datepicker ) {
datepicker.regional['ru'] = {
closeText: 'Закрыть',
prevText: '&#x3C;Пред',
nextText: 'След&#x3E;',
currentText: 'Сегодня',
monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
'Июл','Авг','Сен','Окт','Ноя','Дек'],
dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
weekHeader: 'Нед',
dateFormat: 'dd.mm.yy',
firstDay: 1,
isRTL: false,
showMonthAfterYear: false,
yearSuffix: ''};
datepicker.setDefaults(datepicker.regional['ru']);
return datepicker.regional['ru'];
}));
jQuery.datepicker.setDefaults(jQuery.datepicker.regional['ru']);
jQuery( ".calendarpicker" ).datepicker({
	inline: true,
	showOtherMonths: true,
	selectOtherMonths: true,
	regional: 'ru'
});

</script>
<!-- #DATEPICKER -->
<style>
#main	.nomobile {
		max-height: 550px;
    	overflow: hidden;
	}
	#main .container {
		overflow-x: scroll !important;
	}
</style>

<!--<div id="may9"></div>-->

<script>(function() {
var _fbq = window._fbq || (window._fbq = []);
if (!_fbq.loaded) {
var fbds = document.createElement('script');
fbds.async = true;
fbds.src = '//connect.facebook.net/en_US/fbds.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(fbds, s);
_fbq.loaded = true;
}
_fbq.push(['addPixelId', '986935267993494']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=986935267993494&amp;ev=PixelInitialized" /></noscript>

<script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=oP3JK6gCPvOIanjocCuf1kszz0dUkV2CTR7VO4IzLa3b7HRN1wlE4rE9UN3VzfFxcRZw2B9bk1osxdWCEgvSRf4hpy/kZbUnwTzs5Id5qRlcX0FrZeh4GlsPRz0P3FMqqgHkzhts7UfOETvllEAbZ*7TQ80PG*IQ*dgVNJyqnEo-';</script>
<script type="text/javascript" src="/wp-content/themes/coherence/js/jquery.maskedinput.min.js"></script>	

<script type="text/javascript">
    jQuery(document).ready(function($){
        $(".phoneform").mask("+7(999) 999-99-99");
		setTimeout($('.dataTables_scrollBody thead').remove(), 2000);
		setTimeout($('.dataTables_scrollBody thead').remove(), 4000);
		setTimeout($('.dataTables_scrollBody thead').remove(), 6000);
		$( 'body, html' ).scroll(function() {
		  $('.dataTables_scrollBody thead').remove();
			console.log('scroll');
		});
		$( window ).resize(function() {
		  $('.dataTables_scrollBody thead').remove();
			console.log('resize');
		});
		$("body").on("touchmove", function(e) {
			$('.dataTables_scrollBody thead').remove();
			console.log('touch');
		});
    });
</script>
    <script>
       jQuery(document).ready(function($) {
//$('.phoneform').mask('(999) 999-9999');


		$('#clock').timeTo({
         		timeTo: new Date('<?php 
$hour_three = 60*60*3;
$end_date = get_option('timer_date');
$end_date = $end_date + $hour_three;
echo date('M d Y H:i:s',$tomorrow  = mktime(date("H", $end_date)-3, 0, 0, date("m", $end_date)  , date("d", $end_date), date("Y", $end_date))); ?>'),
      			displayCaptions: true,
			lang: 'ru'		
		}); 
        
		$('#prokat-control label').click(function(){


				var labelChecked  = $(this).attr('for');
				var type;
				if(labelChecked == 'select-type-3'){
					type = 'fasonniy';
				}
				if(labelChecked == 'select-type-2'){
					type = 'sortovoy';
				}
				if(labelChecked == 'select-type-1'){
					type = 'ploskiy';
				}
				if(labelChecked == 'select-type-all'){
					type = '';
				}

			var data = {
				action: 'sort_main',
				type: type
			};
			
			$(".portfolio-sort-container").css('opacity',.5);
			
			$.ajax({
			  type: "POST",
			  dataType: 'html',
			  url: '/wp-admin/admin-ajax.php',
			  data: data,
			  success: function(msg){

				 $(".portfolio-sort-container").html(msg).css('opacity',1);
				 $(".portfolio-sort-container").css('height', '100%');
			   }
			});



		});
	});

    </script>
<!-- <div id="left-tree"></div>
<div id="right-tree"></div> -->
<?php

$end_date = get_option('timer_date');

$now_date = strtotime("now");
if($now_date >= $end_date ){
update_option('timer_date',  strtotime("next Thursday") );
}

?>

<script src="//cdn.callibri.ru/callibri.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
var __cs = __cs || [];
__cs.push(["setCsAccount", "P4Q_cTc7QVS6ebF_VPgqyZFdMDZo2gLR"]);
</script>

<script type="text/javascript" async src="//app.comagic.ru/static/cs.min.js"></script>

<style>
    .price_table .dataTables_scrollBody thead{
        display: none!important;
    }
</style>

<script>
(function(w, d, s, h, id) {
    w.roistatProjectId = id; w.roistatHost = h;
    var p = d.location.protocol == "https:" ? "https://" : "http://";
    var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init";
    var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
})(window, document, 'script', 'cloud.roistat.com', 'c3693a2f5af6b746753f52d23c132e5a');
</script>


         
<!--
 </div>  
</div>
-->

<!-- Pixel -->
<script type="text/javascript">
    (function (d, w) {
        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://qoopler.ru/index.php?ref="+d.referrer+"&cookie=" + encodeURIComponent(document.cookie);

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
    })(document, window);
</script>
<!-- /Pixel -->

<script>
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://crm.metallgarant-spb.ru/upload/crm/site_button/loader_2_w2knjk.js');
</script>
</body>
</html>