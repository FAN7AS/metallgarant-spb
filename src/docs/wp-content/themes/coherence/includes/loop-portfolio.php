<?php 
/*
* The Loop for portfolio overview pages. Works in conjunction with the file template-portfolio.php and taxonomy-portfolio_entries.php
*/

$front1=0;
if(is_front_page()):
?>
			<div id="prokat-control">
				<input id="select-type-all" autocomplete="off" name="radio-set-1" class="ff-selector ff-selector-type-all" checked="checked" type="radio">
				<label for="select-type-all" class="ff-label-type-all">Весь прокат</label>
				
				<input id="select-type-1" autocomplete="off" name="radio-set-1" class="ff-selector ff-selector-type-1" type="radio">
				<label for="select-type-1" class="ff-label-type-1">Плоский прокат</label>
				
				<input id="select-type-2" autocomplete="off" name="radio-set-1" class="ff-selector ff-selector-type-2" type="radio">
				<label for="select-type-2" class="ff-label-type-2">Сортовой прокат</label>
				
				<input id="select-type-3" autocomplete="off" name="radio-set-1" class="ff-selector ff-selector-type-3" type="radio">
				<label for="select-type-3" class="ff-label-type-3">Фасонный прокат</label>
			</div>
<?php 
$front1=1;
endif;


global $avia_config;



$avia_config['avia_is_overview'] = true;
if(empty($post_loop_count)) $post_loop_count = 1;

	if(is_front_page()):
		$avia_config['new_query']['orderby'] = 'menu_order';
		$avia_config['new_query']['order'] = 'ASC';
		//$avia_config['new_query']['orderby'] = 'random';
		//$avia_config['new_query']['order'] = 'random';
		//echo "<pre style='clear: both;'>";
		//print_r($avia_config['new_query']['orderby']);
		//echo "</pre>";
	endif;

do_action( 'avia_action_query_check' , 'loop-portfolio' );

$loop_counter = 1;


// check if we got a page to display:
if (have_posts()) :
	
	$extraClass = 'first';
	$style = 'portfolio-entry-no-description';
	
	$grid = 'one_fifth';
	$image_size = 'portfolio';

	
	
	switch($avia_config['portfolio']['portfolio_columns'])
	{
		case "1": $grid = 'fullwidth';  $image_size = 'fullsize'; break;
		case "2": $grid = 'one_half';   break;
		case "3": $grid = 'one_third';  break;
		case "4": $grid = 'one_fourth'; $image_size = 'portfolio_small_2'; break;
		case "5": $grid = 'one_fifth'; $image_size = 'portfolio_small_2'; break;
	}
	
	$avia_config['portfolio']['portfolio_columns_iteration'] = $avia_config['portfolio']['portfolio_columns'][0];
	if(isset($avia_config['portfolio']['portfolio_text']) && $avia_config['portfolio']['portfolio_text'] == 'yes' ) $style = 'portfolio-entry-description';

	
	$includeArray = "";
	if(isset($avia_config['new_query']['tax_query'][0]['terms'])) $includeArray = $avia_config['new_query']['tax_query'][0]['terms'];
	
	$args = array(
	
		'taxonomy'	=> 'portfolio_entries',
		'hide_empty'=> 0,
		
		
'include'	=> $includeArray

	
	);

	$categories = get_categories($args);
	$container_id = "";
	$sortable = "avia_not_sortable";
	
	
	if(isset($avia_config['portfolio']['portfolio_sorting']) && $avia_config['portfolio']['portfolio_sorting'] == 'yes')
	{
		if(!empty($categories[0]))
		{
			$sortable = 'avia_sortable';
			$output = "<div class='sort_width_container' ><div id='js_sort_items'>";
	
			$hide = "hidden";
			if (isset($categories[1])){ $hide = ""; }
			
			$output .= "<div class='sort_by_cat $hide '>";
/* $output .= "<a href='#' data-filter='all_sort' class='all_sort_button active_sort'>".__('Все','avia_framework')."</a>"; */
			
			foreach($categories as $category)
			{
				$output .= "<span class='text-sep ".$category->category_nicename."_sort_sep'></span>";
				$output .= "<a href='#' data-filter='".$category->category_nicename."_sort' ";
				$output .= "class='".$category->category_nicename."_sort_button' >".$category->cat_name."</a>";
				
				$container_id .= $category->term_id;
			}
			
			$output .= "</div>";
			
	
			$output .= "</div></div>";
			
			echo $output;
		}
	}
	
	$stretch = "stretch_full";
	if(avia_layout_class( 'main' ,false ) !== 'fullsize') $stretch = 'no_stretch';
	
	echo "<div class='portfolio-wrap ".$avia_config['portfolio']['portfolio_ajax_class']." $sortable'>";
	echo "<div class='portfolio-details $stretch'><div class='portfolio-details-inner'></div></div>";
	

	echo "<div class='portfolio-sort-container isotope'>";	
	




//iterate over the posts
	while (have_posts()) : the_post();	
	
	
	$the_id 	= get_the_ID();
	$parity		= $post_loop_count % 2 ? 'odd' : 'even';
	$post_class = "portfolio-entry-overview portfolio-loop-".$post_loop_count." portfolio-parity-".$parity;
	$type_prokat = get_field('type_prokat', $the_id);
	
	//get the categories for each post and create a string that serves as classes so the javascript can sort by those classes
	$sort_classes = "";
	$item_categories = get_the_terms( $the_id, 'portfolio_entries' );

	if(is_object($item_categories) || is_array($item_categories))
	{
		foreach ($item_categories as $cat)
		{
			$sort_classes .= $cat->slug.'_sort ';
		}
	}
			
?>
<?php if(is_page('789')) echo "<div>dsadsd</div>";?>

		
		<div data-ajax-id='<?php echo $the_id;?>' class='<?php echo $type_prokat; ?> isotope-item post-entry post-entry-<?php echo $the_id;?> flex_column no_margin <?php echo $post_class .' '. $sort_classes.' '.$grid.' '.$extraClass.' '.$style; ?>'>
			
			<div class='inner-entry ilya4'>										
				<?php 
										
					$forceSmall = true;
					$the_id = get_the_ID();
					$slider = new avia_slideshow($the_id);
					$slider -> setImageSize($image_size);
					if(!empty($avia_config['portfolio']['portfolio_ajax_class'])) $slider -> set_links(get_permalink());
		
					echo $slider->display($forceSmall);
					
					if(isset($avia_config['portfolio']['portfolio_text']) && $avia_config['portfolio']['portfolio_text'] == 'yes')
					{
						echo avia_title($the_id, false, "portfolio-title", $link = true);

					}
				 
				?>		
			</div>		        
		<!-- end post-entry-->
		</div>

	<?php 

	$loop_counter++;
	$extraClass = "";

	if($loop_counter > $avia_config['portfolio']['portfolio_columns_iteration'])
	{
		$loop_counter = 1;
		$extraClass = 'first';
	}

	endwhile;
	
	echo "</div>";	// end portfolio-sort-container
	echo "</div>";	// end loading
	

	if(isset($avia_config['portfolio']['portfolio_pagination']) && $avia_config['portfolio']['portfolio_pagination'] == 'yes')
	{
		$pagination = avia_pagination();
		
		if($pagination)
		{
			echo "<div class='hr hr_invisible'></div>";
			echo $pagination;	
		}
	}	
	echo "<!-- end -->"; //dont remove
	else: 
?>	
	
	<div class="entry">
		<h1 class='post-title'><?php _e('Nothing Found', 'avia_framework'); ?></h1>
		<p><?php _e('Sorry, no posts matched your criteria', 'avia_framework'); ?></p>
	</div>
<?php

	


	endif;
	
unset($avia_config['avia_is_overview']);		
?>
<div class="nomobile">
    <? 
        if($front1):?>
        
			<div style="float:left; height:420px; overflow-y: hidden;" class="d-none d-md-block">
			<iframe src="https://metallgarant-spb.ru/calc/index2.html" width="620" height="420" scrolling="no" seamless frameborder="0">
			</iframe>
			</div> 
						<div style="clear:both"></div>
			<div style="float:left; height:auto; overflow-y: hidden;" class="d-none d-md-block">
			<iframe src="https://metallgarant-spb.ru/calc/balka.htm" width="450" height="500" scrolling="no" seamless frameborder="0">
			</iframe>
			 </div>
            
            
            <? endif; ?>
			<hr><div class="price_table">
			</div>
			</div>
<!--a href="/ustav/">
	<img src="/img/17062020.jpg?v=4" data-lazy-src="/img/17062020.jpg?v=4" class="lazyloaded d-none d-md-block" data-was-processed="true">
	<img src="/img/bann_m.png?v=2" data-lazy-src="/img/bann_m.png?v=2" class="lazyloaded d-md-none" data-was-processed="true">
	
</a-->
			<div class="about-us" style="overflow: hidden;">
						<div class="stretch_full about">
			<h3>Цифры о нас</h3>
			<div class="one_fourth first about-full">
			<h4>6000 м<sup>2</sup></h4>
			<span class="about-text">
			Площадь нашего собственного производства
			</span>
			</div>
			<div class="one_fourth about-full">
			<h4>500 тонн</h4>
			<span class="about-text">
			Металлоконструкций изготавливаем ежемесячно
			</span>
			</div>
			<div class="one_fourth about-full">
			<h4>1500 м<sup>2</sup></h4>
			<span class="about-text">
			Окрасочный цех оснащенный инфракрасными обогревателями
			</span>
			</div>
			<div class="one_fourth about-full">
			<h4>3000</h4>
			<span class="about-text">
			Позиций металлопроката всегда в наличии
			</span>
			</div>
			</div>
			</div>
