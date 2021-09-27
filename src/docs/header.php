<?php 
	$style 		= 'boxed'; 
	$responsive	= avia_get_option('responsive_layout','responsive');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="<?php echo avia_get_browser('class', true); echo " html_$style ".$responsive;?> ">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="google-site-verification" content="E14wURT0so_ujL1AzIscv1wTtIQ7C7BYTVcoTOC66qg" />
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
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> RSS2 Feed" href="<?php avia_option('feedburner',get_bloginfo('rss2_url')); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<!-- add css stylesheets -->	




<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/grid.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/base.css?7" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/layout.css?7" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/shortcodes.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/slideshow.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/js/projekktor/theme/style.css" type="text/css" media="screen"/>
<link href='http://fonts.googleapis.com/css?family=Roboto&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Marck+Script&subset=cyrillic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/jquery-ui.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/bests.css" type="text/css"/>

<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/timeTo.css?8" type="text/css"/>

<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/style.css?11" type="text/css"/>
<!-- mobile setting -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


<style>
@media only screen and (max-width: 767px) {
	#left-block-button {
	display: none;
}
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

<script type="text/javascript" src="http://metallgarant-spb.ru/wp-content/themes/coherence/js/jquery.smslider.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($){
    $('#sm_slider').smSlider()
})
</script>
	<link rel="stylesheet" href="<?php echo get_bloginfo('template_url'); ?>/css/custom.css?1" type="text/css" media="screen"/>
	<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:200,300,400,700" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption&subset=latin,cyrillic-ext,cyrillic' rel='stylesheet' type='text/css'>

		




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

<script type="text/javascript" src="/wp-content/themes/coherence/js/bests-calc.js"></script>

</head>
<body id="top" <?php body_class($style." ".$avia_config['font_stack']); ?>>


			<div id="left-block-button">Акция
				<div id="left-block-panel">
					<p>При покупке от 20т одной позиции арматуры, вы получите в подарок бухту вязальной проволоки Ø1,2 мм.</p>
					<p>Арматура A3 Ø12 Н/Д, <br> цена 22 200р. за 1т.</p>
                                        <p>Подробности узнавайте у менеджеров отдела продаж.</p>
					<p style="font-size: 25px;">✆ 8 (812) 600-20-00</p>
					<hr style="border: 1px solid red;">

					<p>При покупке от 20т одной позиции арматуры, вы получите в подарок бухту вязальной проволоки Ø1,2 мм.</p>					
					<p>Арматура A Ø12мм 11.7м, <br> цена 25 400р. за 1т.</p>
                                        <p>Подробности узнавайте у менеджеров отдела продаж.</p>
					<p style="font-size: 25px;">✆ 8 (812) 600-20-00</p>
                                        <hr style="border: 1px solid red;">

                                        <p>При покупке от 20т одной позиции арматуры, вы получите в подарок бухту вязальной проволоки Ø1,2 мм.</p>
					<p>Арматура A3 Ø10мм Н/Д, <br> цена 23 200р. за 1т.</p>
                                        <p>Подробности узнавайте у менеджеров отдела продаж.</p>
					<p style="font-size: 25px;">✆ 8 (812) 600-20-00</p>
					
				</div>
			</div>
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
						
				<div class='container_wrap' id='header'>
			
						<div class='container'>
						<div class="firstScreen">
						<div class="one_third first">
						   <a href="/" id="logotype">
							   <img src="/wp-content/themes/coherence/images/logos9.png">
						   </a>
						</div>
						<div class="one_third searchblock">
						<div class="four_fifth search">
						<?php get_search_form(); ?>
						</div>
						<div class="desc">
						<span>Продажа металлопроката и производство металлоконструкций в СПБ
						</div>
						</div>
						<div class="one_third">
						  <a class="clock_after" href="http://metallgarant-spb.ru/aktsiya-dostavka-v-den-oplatyi/" style="text-decoration: none;"> </a>
						  <div class="">
						   <div class="header-phone-big ya-phone-2">
						      ✆ <a href="tel:+788005554069">8 (800) 555-40-69</a>
						   </div>
						   <div class="header-phone-big ya-phone-2">
							  ✆ <a href="tel:+78126002000">8 (812) 600-20-00</a>
						   </div>
						   <div class="email">
						      <a style="color:#F1B70D" href="mailto:info@mh-spb.ru">info@mh-spb.ru</a>
						   </div>
						   <div class="zv"><a href="#contact_form_pop" class="order-call fancybox-inline" style="position: static;">Заказать звонок</a>
						      <div style="display:none" class="fancybox-hidden">
							     <div id="contact_form_pop">                
								 <?php echo do_shortcode('[contact-form-7 id="3869" title="Заказать звонок (модальное окно)"]'); ?>
								 </div>
							   </div>
						   </div>
						  </div>
						</div>
						</div>
							<div class="stretch_full mega-menu menu-full">
								<?	echo "<div id='top_nav' class='main_menu' data-selectname='".__('Выбрать страницу','avia_framework')."'>";
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
var h_hght = 120; // высота шапки
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