<?php 
	$style 		= 'boxed'; 
	$responsive	= avia_get_option('responsive_layout','responsive');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo avia_get_browser('class', true); echo " html_$style ".$responsive;?> ">
<head>
<meta name="robots" content="noodp"/>
<meta name="robots" content="noyaca"/>
<meta name="yandex-verification" content="7720139e13c99bbb" />
<meta name="yandex-verification" content="bc91aca6e9868fcf" />
<meta name="yandex-verification" content="f56e2a2ba3d3c0f6" />
<meta name="yandex-verification" content="f0f0dbb31a8ea290" />
<meta name="yandex-verification" content="2abfafa57337aa50" />
<meta name="google-site-verification" content="AKpy8sLBB_EWUGu4KXBKFc5Z3P_BzPKT9IkwvG7ziDk" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="google-site-verification" content="E14wURT0so_ujL1AzIscv1wTtIQ7C7BYTVcoTOC66qg" />
<link rel="stylesheet" href="/wp-content/plugins/elementor/assets/lib/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/d-bootstrap.css?v=1">
	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-52JSXG6');</script>
<!-- End Google Tag Manager -->
<!-- test -->
<?php 
	global $avia_config;

	/*
	 * outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
	 * located in framework/php/function-set-avia-frontend.php
	 */
	 if (function_exists('avia_set_follow')) { echo avia_set_follow(); }
	 
	 
	 /*
	 * outputs a favicon if defined
	 */
	 if (function_exists('avia_favicon'))    { echo avia_favicon(avia_get_option('favicon')); }
	 
?>


<!-- page title, displayed in your browser bar -->
<title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>


<!-- add feeds, pingback and stuff-->
<link rel="profile" href="https://gmpg.org/xfn/11" />
<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> RSS2 Feed" href="<?php avia_option('feedburner',get_bloginfo('rss2_url')); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<!-- add css stylesheets -->	




<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/grid.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/base.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/layout.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/shortcodes.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/slideshow.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/projekktor/theme/style.css" type="text/css" media="screen"/>
<link href="https://fonts.googleapis.com/css?family=Marck+Script|Roboto|Roboto+Slab|PT+Sans+Caption" rel="stylesheet"> 
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/jquery-ui.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/bests.css" type="text/css"/>

<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/timeTo.css" type="text/css"/>

<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/style.css" type="text/css"/>
<!-- mobile setting -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


<style>
@media only screen and (max-width: 767px) {
	#left-block-button {
	display: none;
}
}
#glbox {
	width: 930px;
    height: 465px;
    overflow: hidden;
    position: relative;
}
#gl1 {
    position: absolute;
    top: -57px;
}



</style>
	
	
<style>
.desc-hit {
    padding: 0 10px;
}
	.b24-widget-button-position-bottom-right {
		right: 25px !important;
        bottom: 130px !important;
}
.desc-hit-a {
    color: white;
    font: bold 11px "Roboto",sans-serif;
    left: 20px;
    padding: 5px 10px;
    text-decoration: none;
    text-transform: uppercase;
    display: block;
    text-align: center;
    margin-bottom: 5px;
    background: #f32b2b;
    border-radius: 2px;
}

.desc-hit-a:hover {
    border-bottom: 3px solid #242424;
    text-decoration: underline;
    text-decoration: none;
    margin-bottom: 2px;
}
</style>

<?php 
if($responsive === 'responsive') echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
?>


<?php

	/* add javascript */

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'avia-default' );
	//wp_enqueue_script( 'avia-prettyPhoto' );
	wp_enqueue_script( 'avia-html5-video' );
	wp_enqueue_script( 'aviapoly-slider' );
	wp_enqueue_script( 'avia-social' );
	wp_enqueue_script( 'timeTo' );



	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
	
?>


<!-- plugin and theme output with wp_head() -->
<?php 

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	
	wp_head();
?>

<script type="text/javascript" src="/wp-content/themes/coherence/js/jquery.smslider.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('#sm_slider').smSlider()
});
</script>
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/custom.css?2" type="text/css" media="screen"/>
	<!--link href="//fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200,300,400,700" rel="stylesheet" type="text/css"-->
	<!--link href='//fonts.googleapis.com/css?family=PT+Sans+Caption&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'-->

		




<?php 
/*
 * prepare big slideshow if available
 * If we are displaying a dynamic template the slideshow might already be set
 * therefore we dont need to call it here
 */

if(!avia_is_dynamic_template_active())
{
	if(isset($post))
	{
		$slider = new avia_slideshow(avia_get_the_ID());
		$slider->customClass('stretch_full');
		$avia_config['slide_output'] =  $slider->display_big();
	}
}


?>

<script type="text/javascript" src="/wp-content/themes/coherence/js/bests-calc.js?v=2"></script>
    
    <script type='application/ld+json'> 
{
  "@context": "http://www.schema.org",
  "@type": "LocalBusiness",
  "name": "МеталлГарант",
  "url": "https://metallgarant-spb.ru",
  "sameAs": [
    "https://metallgarant-spb.ru/contact/"
  ],
  "logo": "https://metallgarant-spb.ru/wp-content/themes/coherence/images/logos4.png",
"telephone": "+7 (812) 660-55-00",
  "image": "https://metallgarant-spb.ru/wp-content/uploads/2018/03/zavod11-1.jpg",
  "description": "Компания «МеталлГарант» является одним из крупнейших производителей и поставщиков металлоконструкций и металлопроката в Северо-Западном регионе.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Санкт-Петербург, проспект Обуховской Обороны, дом № 112, корпус 2, литер И, помещение 517",
    "addressLocality": "Санкт-Петербург",
    "addressRegion": "Россия"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "59.866795",
    "longitude": "30.472316"
  },
  "openingHours": "Mo, Tu, We, Th, Fr 09:00-18:00",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+7 (812) 660-55-00",
    "contactType": "customer service"
  }
}
 </script>
<script src="//st.yagla.ru/js/y.c.js?h=aa5bc40187cc7a3084e63185df18259e"></script>
<script src="//st.yagla.ru/js/y.c.js?h=aa5bc40187cc7a3084e63185df18259e"></script>

</head>
<body id="top" <?php body_class($style." ".$avia_config['font_stack']); ?>>
	<!-- <div class="topmessage" style="background: #f32b2b;color: #fff;text-align: center;font-size: 17px;">Уважаемые клиенты и партнеры мы продолжаем работать в штатном режиме. <a href="/info/" style="color: #ffe252;">Подробнее-></a></div>-->
	
	<!--div class="bg-ng"-->
	<!--div class="bg-sneg" style="background: rgba(255, 255, 255, 0.3);"-->
		<!--div class="bg-sneg"-->
	<div>
	<div>


	<div id='wrap_all'>	

			
		
<div class='container_wrap' id='meta_header'>
						
						<div class='container'>


	

					<?php 	
							
							do_action('avia_meta_header');	
							//avia_banner();   // avia_banner functions located in functions.php - creates the notification at the top of the site
							
							/*
							*	display the themes social media icons, defined in the wordpress backend
							*   the avia_social_media_icons function is located in includes/helper-social-media-php
							*/
							$args = array('outside'=>'ul', 'inside'=>'li', 'append' => '');
							avia_social_media_icons($args);
						?>
						
					</div><!-- end container-->
			
			</div><!-- end container_wrap-->
				  
			<!-- ####### HEAD CONTAINER ####### -->
						
				<div class='container_wrap head_top' id='header'>
			
						<div class='container'>
						<div class="firstScreen">
						<div class="one_third first">
						   <a href="/" id="logotype">
							   <img src="/wp-content/themes/coherence/images/logos4.png">
							   
						   </a>
						   <div class="desc">
								<span> <a href="/">Металлопрокат</a> &#8226 <a href="/constr#main">Металлоконструкции</a> &#8226 <a href="/krovelnye-materialy#main">Кровля</a></span>
							</div>
							<div class="email" style="text-align: center; margin-top: 2px;">
						      <a class="callibri_email newclass" href="mailto:info@metallgarant-spb.ru">info@metallgarant-spb.ru</a>
						   </div>
							<!--div class="desc-hit"><a href="/contact/" class="desc-hit-a">График работы в праздничные дни</a></div-->
<a href="/kamera/" style="position: static;"><img src="/img/bottoncam.png" style="margin-top: 12px;"></a>
						</div>

						<div class="one_third phone">

						  <a class="clock_after" href="/aktsiya-dostavka-v-den-oplatyi/" style="text-decoration: none;"> </a>
						  <div class="">

						   <div class="header-phone-big ya-phone-2">
							  <div><!--✆--> Санкт-Петербург: <a href="tel:+78126605500">+7 (812) 660-55-00</a></div>
							  <div>Москва: <a href="tel:+74993227778">+7 (499) 322-77-78</a></div>
							  <div>Региональный оптовый отдел: <a href="tel:+78001008065">+7 (800) 100-80-65</a></div>
						   </div>



						   <div ><a href="#contact_form_pop" class="order-call fancybox-inline" style="position: static;">Заказать звонок</a>
						      <div style="display:none" class="fancybox-hidden">
							     <div id="contact_form_pop">                
								 <?php echo do_shortcode('[contact-form-7 id="3869" title="Заказать звонок (модальное окно)"]'); ?>
								 </div>
							   </div>
						   </div>
						      
						   <div><a href="#director_form_pop" class="order-call fancybox-inline" style="position: static;background: #f32b2b !important;">Написать директору</a>
						      <div style="display:none" class="fancybox-hidden">
							     <div id="director_form_pop">                
								 <?php echo do_shortcode('[contact-form-7 id="67474" title="Написать директору (модальное окно)"]'); ?>
								 </div>
							   </div>
						   </div>
							<!--div class="zv"><a href="#contact_form_pop" class="order-call fancybox-inline" style="position: static;">Заказать звонок</a>
						      <div style="display:none" class="fancybox-hidden">
							     <div id="contact_form_pop">                
								 <?php echo do_shortcode('[contact-form-7 id="3869" title="Заказать звонок (модальное окно)"]'); ?>
								 </div>
							   </div>
						   </div-->

						   <!--div class="email">
						      <a class="callibri_email newclass" href="mailto:info@metallgarant-spb.ru">info@metallgarant-spb.ru</a>
						   </div-->

						  </div>
						</div>

						<div class="one_third searchblock">
							<div class="search">
							<ul class="header__social">
								<li class="header__social-item">
									<a href="https://www.youtube.com/channel/UCq8Vm8qVIPJP20cj6krhqGA" class="header__social-item-link yt" target="_blank" rel="nofollow"></a>
								</li>
								<li class="header__social-item">
									<a href="https://www.instagram.com/metallgarantspb/" class="header__social-item-link ig" target="_blank" rel="nofollow"></a>
								</li>
								<li class="header__social-item">
									<a href="https://vk.com/lzmmetallgarant" class="header__social-item-link vk" target="_blank" rel="nofollow"></a>
								</li>
								<li class="header__social-item">
									<a href="https://www.tiktok.com/@metallgarantspb" class="header__social-item-link vk tk" target="_blank" rel="nofollow"></a>
								</li>
							</ul>
							<?php get_search_form(); ?>
							</div>
							<div class="address">
								<!--Адреса:<br-->
								Офис: м.Пролетарская, пр.Обуховской Обороны, 112/2, БЦ Вант, оф.517<br>
								Завод: м.Рыбацкое, ул. Караваевская, д.57<br>
								Филиал: Москва г. Балашиха, Покровский проезд, 4<br>
								Шоу-рум Сосново: пос. Сосново ул. Вокзальная д. 21<br>
								Шоу-рум Гатчина: Киевское ш., 53 км, Гатчинский район
							</div>
						</div>



						</div>
							<div class="stretch_full mega-menu menu-full">
								<?	echo "<div id='top_nav' class='main_menu' data-selectname='".__('Выбрать страницу','avia_framework')."'";
								$args = array('theme_location'=>'avia', 'fallback_cb' => 'avia_fallback_menu');
								wp_nav_menu($args); 
								echo "</div>";
								?>
							</div>
							<div class="clear"></div>
							<!-- End third row -->


				<?php  
						/*
						*	display the theme logo by checking if the default logo was overwritten in the backend.
						*   the function is located at framework/php/function-set-avia-frontend-functions.php in case you need to edit the output
						*/
						/* echo avia_logo(AVIA_BASE_URL.'images/layout/logo.png'); */
						
						/*
						*	display the main navigation menu
						*   check if a description for submenu items was added and change the menu class accordingly
						*   modify the output in your wordpress admin backend at appearance->menus
						*/ ?>


					





						</div><!-- end container-->
				
				</div><!-- end container_wrap-->
			
			<!-- ####### END HEAD CONTAINER ####### -->
 <?php if(is_home() ){?>
			 <div class="vidos" style="display: none;">
					<div class="container gggg">
			<div class="two_third first videotitle">
			<span>Производим, доставляем металлопрокат и монтируем металлоконструкции.<p class="small">Собственное производство, площадью 6000 м2</p></span>
			<img src="<?php bloginfo('template_url'); ?>/images/provol.png"><span class="akcii">При покупке от 20т одной позиции арматуры, Вы получаете в подарок бухту вязальной проволки &#216;1,2 мм</span>
			</div>
			<div class="one_third">
			<div id="fancybox-content" style="border-width: 10px; width: 220px; height: auto; margin-top: 67px">
<div style="width:auto;height:auto;overflow: hidden;position:relative;">
			<?php echo do_shortcode('[contact-form-7 id="5203" title="На видео"]'); ?>
			
			</div> 
</div>

</div>
			</div>
					<div class='bg_ge' id='main'>
					
		<div id="trailer" class="is_overlay">
		
	<video id="video" width="100%" height="auto" autoplay="autoplay" loop="loop" preload="auto">
		<source src="/book.mp4"></source>
		<source src="/book.webm" type="video/webm"></source>
	</video>
</div>
		</div>

		
		
		
		</div>
		<?php } ?>
		
		
			<?php 
			//display slideshow big if one is available	
			if(!empty($avia_config['slide_output'])) echo "<div class='container_wrap' id='slideshow_big'><div class='container'>".$avia_config['slide_output']."</div></div>";	
			?>

			<div class="yellow-menu">
				<div class="container_wrap">
					<div class="container">
										<?php wp_nav_menu('menu=middle-menu&container=middle-menu'); ?>
					</div>
				</div>


			</div>
<script>
$(document).ready(function(){   
    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('#scroller').fadeIn();
        } else {
            $('#scroller').fadeOut();
        }
    });
    $('#scroller').click(function () {
    $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
    $(function(){
        var col1 = $("#tablepress-152 .row-2 .column-1").width();
        var col2 = $("#tablepress-152 .row-2 .column-2").width();
        var col3 = $("#tablepress-152 .row-2 .column-3").width();
        var col4 = $("#tablepress-152 .row-2 .column-4").width();
        var col5 = $("#tablepress-152 .row-2 .column-5").width();
        var col6 = $("#tablepress-152 .row-2 .column-6").width();
        var col7 = $("#tablepress-152 .row-2 .column-7").width();
        var col8 = $("#tablepress-152 .row-2 .column-8").width();
        var col9 = $("#tablepress-152 .row-2 .column-9").width();
        var col10 = $("#tablepress-152 .row-2 .column-10").width();
        var col11 = $("#tablepress-152 .row-2 .column-11").width();
        var col12 = $("#tablepress-152 .row-2 .column-12").width();
        $(window).scroll(function() {
            var top = $(document).scrollTop();
            if (top < 350) $("#tablepress-152 thead").css({top: '0', position: 'relative'});
            else {
                $("#tablepress-152 thead").css({top: '0px', position: 'fixed'});
                $("#tablepress-152 thead .column-1").css('width', col1);
                $("#tablepress-152 thead .column-2").css('width', col2);
                $("#tablepress-152 thead .column-3").css('width', col3);
                $("#tablepress-152 thead .column-4").css('width', col4);
                $("#tablepress-152 thead .column-5").css('width', col5);
                $("#tablepress-152 thead .column-6").css('width', col6);
                $("#tablepress-152 thead .column-7").css('width', col7);
                $("#tablepress-152 thead .column-8").css('width', col8);
                $("#tablepress-152 thead .column-9").css('width', col9);
                $("#tablepress-152 thead .column-10").css('width', col10);
                $("#tablepress-152 thead .column-11").css('width', col11);
                $("#tablepress-152 thead .column-12").css('width', col12);
                //$("#tablepress-152 thead, #tablepress-152 thead tr").css('width', '930px');
            }
        });
    });
});
</script>

<script>
//var h_hght = 150; // высота шапки
var h_hght = 218; // высота шапки
var windowWidth  = $(window).width();
if (windowWidth < 990 && windowWidth > 767) h_hght = 230;
var h_mrg = 0;    // отступ когда шапка уже не видна
                 
$(function(){
 
    var elem = $('#top_nav');
    var top = $(this).scrollTop();
     
    if(top > h_hght){
        elem.css('top', h_mrg);
    }           
     
    $(window).scroll(function(){
        top = $(this).scrollTop();
        if (top+h_mrg < h_hght) {
            elem.css('top', (h_hght-top));
        } else {
            elem.css('top', h_mrg);
        }
    });
 
});
</script>
<div id="scroller"></div>
		<div class="container">
<div style="display:none" class="fancybox-hidden">
<div id="contact_form_akciya">                
<?php echo do_shortcode('[contact-form-7 id="69241" title="Акция ЗАБОР"]'); ?>
</div>
</div>
<?php
		
/*if ($_SERVER[REQUEST_URI]=="/")
{
echo '<div class="banya"><img src="/img/17062020.jpg?v=2"></div>';
} else {
	echo '<div class="banya"><img src="/img/17062020.jpg?v=2"></div>';
}*/
if ($_SERVER[REQUEST_URI]=="/") {
echo '

<div class="d-none d-lg-block"><a href="#contact_form_akciya" class="fancybox-inline"><img src="https://metallgarant-spb.ru/img/mg1507zabor.jpg?v=2" class="img-fluid"></a></div>

<div class="d-none d-lg-block"><img src="https://metallgarant-spb.ru/wp-content/uploads/2020/12/banner-kapital.png" class="img-fluid"></div>
<div class="d-none d-md-block d-lg-none d-xl-none d-xxl-none"><img src="https://metallgarant-spb.ru/file/bn714.jpg" class="img-fluid" ></div>
<div class="d-none d-sm-block d-md-none d-lg-none d-xl-none d-xxl-none"><img src="https://metallgarant-spb.ru/file/bn418.jpg" class="img-fluid" ></div>
<div class="d-xs-block d-sm-none d-md-none d-lg-none d-xl-none d-xxl-none text-center"><img src="https://metallgarant-spb.ru/file/bn258.jpg" class="img-fluid" ></div>



<div class="banya" style="background: #fff;text-align: center;margin-top: 15px;">
<iframe width="560" height="315" src="https://www.youtube.com/embed/RP0muZU3Ahs?rel=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<p style="margin-top: 25px;font-weight: 700;font-size: 18px;"><a href="https://metallgarant-spb.ru/kamera/" taget="_blank">Онлайн-трансляция с производства</a></p>

<!--p style="font-size: 24px;font-weight: 900;">Дорогие друзья!</p>
<p>Компания МеталлГарант стала ещё прозрачней.<br>
Теперь Вы можете наблюдать за исполнением Ваших заказов на нашем производстве в прямом эфире. <a href="https://metallgarant-spb.ru/kamera/" taget="_blank">Приятного просмотра!</a></p>
<p>Мы подключили 3 камеры:<br>
Общий вид первого цеха<br>
Заготовительный участок<br>
Малярный цех</p>
<p>Если Вам понравится такая идея, то в дальнейшем будем увеличивать число подключенных камер на нашем сайте.</p-->
</div>


';
} else if ($_SERVER[REQUEST_URI]=="/product/profnastil/" || $_SERVER[REQUEST_URI]=="/krovelnye-materialy/ustanovka-zaborov-v-spb/" || $_SERVER[REQUEST_URI]=="/krovelnye-materialy/kalkulyator-zabora/") {
	echo '<div class="d-none d-lg-block"><img src="https://metallgarant-spb.ru/wp-content/uploads/2020/12/banner-kapital.png" class="img-fluid"></div>
	<div class="d-none d-lg-block"><img src="https://metallgarant-spb.ru/img/mg1507zabor.jpg" class="img-fluid"></div>';
} else {
	echo '<div class="d-none d-lg-block"><img src="https://metallgarant-spb.ru/wp-content/uploads/2020/12/banner-kapital.png" class="img-fluid"></div>';
}
?>
			</div>