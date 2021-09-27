<?php
if(get_the_ID()!=707){
// var_dump(get_the_ID());
//if($_GET['test']!=1){
	$_sid = get_the_ID();
	// var_dump(get_post($_sid)->post_parent); 
	if(get_post($_sid)->post_parent==707){
		include('loop-portfolio-single-profnastil-sub.php');
	} else {
// 5062,5052,5076,5078,5077, 5021
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
		<div class="twelve units alpha min_height_1">
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
						echo " <a href='". get_permalink($post_parent -> ID)."'>".$post_parent_title."</a> - " . $title_this_post ;
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
					echo "<a href='/'>Главная</a> - <a href='/'>".
					$mycat -> name."</a> - <a href='".get_permalink($post_parent -> ID)."'>".$post_parent_title."</a> - " . $title_this_post ;
					endif;
				endif;
			endif;
			?>


</div>
 <div class="fullcont">
 			<div class="first" style="text-align: center;">
			<h1 style="font-size: 18px; font-family: Roboto, HelveticaNeue, Helvetica Neue, Helvetica, Arial, sans-serif; font-weight: bold; text-align: center; margin:10px 0;  display: inline-block">
            <?php the_title() ?></h1></div>
			<div class="imgtxt">
<!--div class="two_fifth first imgcontent">
<?php if($slider->slidecount) echo /*$slider->display()*/ ""; ?>
<?php
$attr =  array(
	'class'	=> "alignleft",
);
 echo get_the_post_thumbnail( $post -> ID, array(300, 300), $attr ); 
?>
</div-->
<div class="imgtxt">
<div class="three_fifth no_margin" style="width: 100%;">
<span class="forma-vid">Оставьте заявку на расчет стоимости и получите ваш расчёт сегодня и первоочередную доставку.</span>
</div>
<div class="three_fifth formcontent no_margin">		
<?php echo do_shortcode('[contact-form-7 id="5209" title="на страницах"]'); ?>
</div>
<div class="three_fifth formcontent no_margin">
<!--span class="forma-vid2 content">*при оплате до 13.00 текущего дня</span-->
</div>
</div>
</div>
</div>
<hr>
        	<? the_content(__('Посмотреть цены','avia_framework').'<span class="more-link-arrow"> &rarr;</span>'); ?>	
			<? if( has_term( 'prokat', 'portfolio_entries' ) ) { ?>	      
            
    
			<!-- calc -->

			<hr class="dot">	
			<div class="price_table entry-content two_third" style="z-index: 1; ">
<?php
			$meta = avia_portfolio_meta(get_the_ID());
			if($meta)
			{
				echo $meta;
				echo avia_advanced_hr(false, 'small');
			}
			$price_id = avia_post_meta($id, 'price');
			//$get_table = tablepress_get_table("id=$price_id first_column_th=false table_head=false" );
			$get_table = tablepress_get_table(array(
				"id"=> $price_id,
			//	'column_widths'=> "30%|20%|20%",
			//	'use_datatables' => true,
			//	'table_head' => true,
			//	'datatables_sort' => true,
			//	'datatables_scrollx' => '500px',
			//	'datatables_scrolly' => '500px',
				));
			$pos      = strripos($get_table, "not found");
			
			if($pos > 0 || $price_id == 1):
			else:
				tablepress_print_table( array(
				"id"=> $price_id,
			//	'column_widths'=> "30%|20%|20%",
			//	'use_datatables' => true,
			//	'table_head' => true,
			//	'datatables_columns' => '[{data: columnNames[i], title: columnNames[i]}]',
			//	'datatables_scrollx' => '500px',
			//	'datatables_scrolly' => '500px',
				) );
			endif;
			
			/*the_content(__('Посмотреть цены','avia_framework').'<span class="more-link-arrow"> &rarr;</span>');*/
			if(has_tag() && is_single())
			{
				echo '<span class="text-sep">/</span><span class="blog-tags minor-meta">';
				echo the_tags('<strong>'.__('Tags: ','avia_framework').'</strong><span>');
				echo '</span></span>';
			}
			?></div>
			
					<div class="one_third first calccont">
					<? if($post->ID == 1448 || $post->ID == 1224 || $post->ID == 1218 || $post->ID == 1381 || $post->ID == 1379): ?>
			
				<div class="calc-container">
					<div class="calc-title">Калькулятор стального металлопроката</div>
					<form>
						<div>
							<select name="form_prokat" id="type">
								<option selected value="1">Труба круглая</option>
								<option value="2">Труба профильная</option>
								<option value="3">Лист</option>
								<option value="4">Плита</option>
								<option value="5">Лента</option>
								<option value="6">Шина / Полоса</option>
								<option value="7">Круг / Пруток</option>
								<option value="8">Квадрат</option>
								<option value="10">Шестигранник</option>
								<option value="11">Уголок</option>
								<option value="12">Швеллер</option>
								<option value="13">Проволока</option>
							</select>
						</div>
						<div class="calc-content">
						<!--Труба круглая-->
							<div class="tube">
								<p><label for="outer-diametr-tube">Внешинй диаметр, мм</label></p>
								<p><input type="text" value="" id="outer-diametr-tube"></p>
								<p><label for="wall-thickness-tube">Толщина трубки, мм</label></p>
								<p><input type="text" value="" id="wall-thickness-tube"></p>
								<p><label for="length-tube">Длина трубки, мм</label></p>
								<p><input type="text" value="" id="length-tube"></p>
								<p><img src="/wp-content/themes/coherence/images/truba.png" alt="" style="width: 156px !important;"></p>
							</div>
							<!--конец труба круглая-->
							<!--Труба профильная-->
							<div class="tube-profile">
								<p><label for="height-tube">Высота трубки, мм</label></p>
								<p><input type="text" value="" id="height-tube"></p>
								<p><label for="width-tube">Ширина трубки, мм</label></p>
								<p><input type="text" value="" id="width-tube"></p>
								<p><label for="wall-thickness-tube-pr">Толщина трубки, мм</label></p>
								<p><input type="text" value="" id="wall-thickness-tube-pr"></p>
								<p><label for="length-tube">Длина трубки, мм</label></p>
								<p><input type="text" value="" id="length-tube-pr"></p>
								<p><img src="/wp-content/themes/coherence/images/truba-pr.png" alt="" width="150"></p>
							</div>
							<!--конец труба профильная-->
							<!-- Лист -->
							<div class="list">
								<p><label for="width-list">Ширина листа, мм</label></p>
								<p><input type="text" value="" id="width-list"></p>
								<p><label for="thickness-list">Толщина листа, мм</label></p>
								<p><input type="text" value="" id="thickness-list"></p>
								<p><label for="lenght-list">Длина листа, мм</label></p>
								<p><input type="text" value="" id="lenght-list"></p>
								<p><label for="count-list">Количество листов, шт</label></p>
								<p><input type="text" value="" id="count-list"></p>
								<p>Площадь листа, м2</p>
								<p><input type="text" value="" id="square-list"></p>
							</div>
							<!--конец лист-->
							<!-- Плита -->
							<div class="plita">
								<p><label for="width-plita">Ширина плиты, мм</label></p>
								<p><input type="text" value="" id="width-plita"></p>
								<p><label for="thickness-plita">Толщина плиты, мм</label></p>
								<p><input type="text" value="" id="thickness-plita"></p>
								<p><label for="lenght-plita">Длина плиты, мм</label></p>
								<p><input type="text" value="" id="lenght-plita"></p>
								<p><label for="count-plita">Количество плит, шт</label></p>
								<p><input type="text" value="" id="count-plita"></p>
								<p>Площадь плиты, м2</p>
								<p><input type="text" value="" id="square-plita"></p>
							</div>
							<!--конец плиты-->
							<div class="lenta">
								<p><label for="width-lenta">Ширина ленты, мм</label></p>
								<p><input type="text" value="" id="width-lenta"></p>
								<p><label for="thickness-lenta">Толщина ленты, мм</label></p>
								<p><input type="text" value="" id="thickness-lenta"></p>
								<p><label for="lenght-lenta">Длина ленты, мм</label></p>
								<p><input type="text" value="" id="lenght-lenta"></p>
								<p>Площадь ленты, м2</p>
								<p><input type="text" value="" id="square-lenta"></p>
							</div>
							<!--конец плиты-->
							<!--шины-->
							<div class="shina">
								<p><label for="width-shina">Ширина шины, мм</label></p>
								<p><input type="text" value="" id="width-shina"></p>
								<p><label for="thickness-shina">Толщина шины, мм</label></p>
								<p><input type="text" value="" id="thickness-shina"></p>
								<p><label for="lenght-shina">Длина шины, мм</label></p>
								<p><input type="text" value="" id="lenght-shina"></p>
							</div>
							<!--конец шины-->
							<!-- пруток-->
							<div class="prutok">
								<p><label for="diametr-prutok">Диаметр прутка, мм</label></p>
								<p><input type="text" value="" id="diametr-prutok"></p>
								<p><label for="lenght-prutok">Длина прутка, мм</label></p>
								<p><input type="text" value="" id="lenght-prutok"></p>
							</div>
							<!--конец пруток-->
							<!-- квадрат-->
							<div class="kvadrat">
								<p><label for="side-kvadrat">Сторона прутка, мм</label></p>
								<p><input type="text" value="" id="side-kvadrat"></p>
								<p><label for="lenght-kvadrat">Длина квадрата, мм</label></p>
								<p><input type="text" value="" id="lenght-kvadrat"></p>
							</div>
							<!--конец квадрат-->
							<!-- шестигранник-->
							<div class="six">
								<p><label for="diametr-six">Номер (Диаметр) шестигранника, мм</label></p>
								<p><input type="text" value="" id="diametr-six"></p>
								<p><label for="lenght-six">Длина шестигранника, мм</label></p>
								<p><input type="text" value="" id="lenght-six"></p>
							</div>
							<!--конец шестигранник-->
							<!-- уголок -->
							<div class="ugolok">
								<p><label for="width-ugolok">Ширина уголка, мм</label></p>
								<p><input type="text" value="" id="width-ugolok"></p>
								<p><label for="height-ugolok">Высота уголка, мм</label></p>
								<p><input type="text" value="" id="height-ugolok"></p>
								<p><label for="thickness-ugolok">Толщина уголка, мм</label></p>
								<p><input type="text" value="" id="thickness-ugolok"></p>
								<p><label for="lenght-ugolok">Длина уголка, мм</label></p>
								<p><input type="text" value="" id="lenght-ugolok"></p>
							</div>
							<!--конец уголок -->
							<!-- швеллер -->
							<div class="shveller">
								<p><label for="width-shveller">Ширина швеллера, мм</label></p>
								<p><input type="text" value="" id="width-shveller"></p>
								<p><label for="height-shveller">Высота швеллера, мм</label></p>
								<p><input type="text" value="" id="height-shveller"></p>
								<p><label for="thickness-shveller">Толщина швеллера, мм</label></p>
								<p><input type="text" value="" id="thickness-shveller"></p>
								<p><label for="lenght-shveller">Длина швеллера, мм</label></p>
								<p><input type="text" value="" id="lenght-shveller"></p>
							</div>
							<!--конец швеллер -->
							<!-- проволока-->
							<div class="provoloka">
								<p><label for="diametr-provoloka">Диаметр проволоки, мм</label></p>
								<p><input type="text" value="" id="diametr-provoloka"></p>
								<p><label for="lenght-provoloka">Длина проволоки, мм</label></p>
								<p><input type="text" value="" id="lenght-provoloka"></p>
							</div>
							<!--конец проволоки-->
							<div>
								<table class="bg-yellow">
									<tr>
										<td >Вес:</td>
										<td><input type="text" value="0.00" id="weight"></td>
										<td>, кг</td>
									</tr>
								</table>
							</div>
						</div>
					</form>
				</div>
				<? endif; ?>
				<!-- end bests -->
			<?php #echo avia_title(false, false, ""); ?>
						

			<!-- вывод калькулятора -->
			<div class="calc-container">
				<div class="calc-title">Калькулятор стального металлопроката</div>
				<form>
					<p>
						<select name="form_prokat" id="type">
							<option selected="" value="1">Труба круглая</option>
							<option value="2">Труба профильная</option>
							<option value="3">Лист</option>
							<option value="4">Плита</option>
							<option value="5">Лента</option>
							<option value="6">Шина / Полоса</option>
							<option value="7">Круг / Пруток</option>
							<option value="8">Квадрат</option>
							<option value="10">Шестигранник</option>
							<option value="11">Уголок</option>
							<option value="12">Швеллер</option>
							<option value="13">Проволока</option>
						</select>
					</p>
						<div class="calc-content">
						 
						<div class="tube">
							<p><label for="outer-diametr-tube">Внешинй диаметр, мм</label></p>
							<p><input value="" id="outer-diametr-tube" type="text"></p>
							<p><label for="wall-thickness-tube">Толщина трубки, мм</label></p>
							<p><input value="" id="wall-thickness-tube" type="text"></p>
							<p><label for="length-tube">Длина трубки, мм</label></p>
							<p><input value="" id="length-tube" type="text"></p>
							<p><img src="/wp-content/themes/coherence/images/truba.png" alt=""></p>
						</div>
						 
						 
						<div class="tube-profile">
							<p><label for="height-tube">Высота трубки, мм</label></p>
							<p><input value="" id="height-tube" type="text"></p>
							<p><label for="width-tube">Ширина трубки, мм</label></p>
							<p><input value="" id="width-tube" type="text"></p>
							<p><label for="wall-thickness-tube-pr">Толщина трубки, мм</label></p>
							<p><input value="" id="wall-thickness-tube-pr" type="text"></p>
							<p><label for="length-tube">Длина трубки, мм</label></p>
							<p><input value="" id="length-tube-pr" type="text"></p>
							<p><img src="/wp-content/themes/coherence/images/truba-pr.png" alt="" width="150"></p>
						</div>
						 
						 
						<div class="list">
							<p><label for="width-list">Ширина листа, мм</label></p>
							<p><input value="" id="width-list" type="text"></p>
							<p><label for="thickness-list">Толщина листа, мм</label></p>
							<p><input value="" id="thickness-list" type="text"></p>
							<p><label for="lenght-list">Длина листа, мм</label></p>
							<p><input value="" id="lenght-list" type="text"></p>
							<p><label for="count-list">Количество листов, шт</label></p>
							<p><input value="" id="count-list" type="text"></p>
							<p>Площадь листа, м2</p>
							<p><input value="" id="square-list" type="text"></p>
						</div>
						 
						 
						<div class="plita">
							<p><label for="width-plita">Ширина плиты, мм</label></p>
							<p><input value="" id="width-plita" type="text"></p>
							<p><label for="thickness-plita">Толщина плиты, мм</label></p>
							<p><input value="" id="thickness-plita" type="text"></p>
							<p><label for="lenght-plita">Длина плиты, мм</label></p>
							<p><input value="" id="lenght-plita" type="text"></p>
							<p><label for="count-plita">Количество плит, шт</label></p>
							<p><input value="" id="count-plita" type="text"></p>
							<p>Площадь плиты, м2</p>
							<p><input value="" id="square-plita" type="text"></p>
						</div>
						 
						<div class="lenta">
							<p><label for="width-lenta">Ширина ленты, мм</label></p>
							<p><input value="" id="width-lenta" type="text"></p>
							<p><label for="thickness-lenta">Толщина ленты, мм</label></p>
							<p><input value="" id="thickness-lenta" type="text"></p>
							<p><label for="lenght-lenta">Длина ленты, мм</label></p>
							<p><input value="" id="lenght-lenta" type="text"></p>
							<p>Площадь ленты, м2</p>
							<p><input value="" id="square-lenta" type="text"></p>
						</div>
						 
						 
						<div class="shina">
							<p><label for="width-shina">Ширина шины, мм</label></p>
							<p><input value="" id="width-shina" type="text"></p>
							<p><label for="thickness-shina">Толщина шины, мм</label></p>
							<p><input value="" id="thickness-shina" type="text"></p>
							<p><label for="lenght-shina">Длина шины, мм</label></p>
							<p><input value="" id="lenght-shina" type="text"></p>
						</div>
						 
						 
						<div class="prutok">
							<p><label for="diametr-prutok">Диаметр прутка, мм</label></p>
							<p><input value="" id="diametr-prutok" type="text"></p>
							<p><label for="lenght-prutok">Длина прутка, мм</label></p>
							<p><input value="" id="lenght-prutok" type="text"></p>
						</div>
						 
						 
						<div class="kvadrat">
							<p><label for="side-kvadrat">Сторона прутка, мм</label></p>
							<p><input value="" id="side-kvadrat" type="text"></p>
							<p><label for="lenght-kvadrat">Длина квадрата, мм</label></p>
							<p><input value="" id="lenght-kvadrat" type="text"></p>
						</div>
						 
						 
						<div class="six">
							<p><label for="diametr-six">Номер (Диаметр) шестигранника, мм</label></p>
							<p><input value="" id="diametr-six" type="text"></p>
							<p><label for="lenght-six">Длина шестигранника, мм</label></p>
							<p><input value="" id="lenght-six" type="text"></p>
						</div>
						 
						 
						<div class="ugolok">
							<p><label for="width-ugolok">Ширина уголка, мм</label></p>
							<p><input value="" id="width-ugolok" type="text"></p>
							<p><label for="height-ugolok">Высота уголка, мм</label></p>
							<p><input value="" id="height-ugolok" type="text"></p>
							<p><label for="thickness-ugolok">Толщина уголка, мм</label></p>
							<p><input value="" id="thickness-ugolok" type="text"></p>
							<p><label for="lenght-ugolok">Длина уголка, мм</label></p>
							<p><input value="" id="lenght-ugolok" type="text"></p>
						</div>
						 
						 
						<div class="shveller">
							<p><label for="width-shveller">Ширина швеллера, мм</label></p>
							<p><input value="" id="width-shveller" type="text"></p>
							<p><label for="height-shveller">Высота швеллера, мм</label></p>
							<p><input value="" id="height-shveller" type="text"></p>
							<p><label for="thickness-shveller">Толщина швеллера, мм</label></p>
							<p><input value="" id="thickness-shveller" type="text"></p>
							<p><label for="lenght-shveller">Длина швеллера, мм</label></p>
							<p><input value="" id="lenght-shveller" type="text"></p>
						</div>
						 
						 
						<div class="provoloka">
							<p><label for="diametr-provoloka">Диаметр проволоки, мм</label></p>
							<p><input value="" id="diametr-provoloka" type="text"></p>
							<p><label for="lenght-provoloka">Длина проволоки, мм</label></p>
							<p><input value="" id="lenght-provoloka" type="text"></p>
						</div>
						 
						<p>
						</p>
						<table class="bg-yellow">
							<tbody>
								<tr>
									<td>Вес:</td>
									<td><input value="0.00" id="weight" type="text"></td>
									<td>, кг</td>
								</tr>
							</tbody>
						</table>
						<p></p>
					</div>
				</form>
			</div>
			

			<!-- вывод калькулятора -->



			<!--<span class='date-container minor-meta meta-color'><?php echo get_the_date(); ?></span>-->
			
		</div>
		<!-- /calc -->
		<? } ?>
        
		<span style="display:none;"><a href="#order_form_pop" id="link_order" class="fancybox-inline">Заказать</a></span>
 <div style="display:none" class="fancybox-hidden">
 <div id="order_form_pop">                
  <?php echo do_shortcode('[contact-form-7 id="3884" title="Заказ товара"]'); ?>
 </div>
 </div>
 <style type="text/css">
 	.tablepress{
 		width: 100%!important;
 	}
 	.dataTables_wrapper .tablepress{
 		width: 100%!important;
 	}
 	.dataTables_scrollHeadInner{
 		width: 100%!important;
 	}

 	.dataTables_scrollHeadInner thead .column-1{
 		width: 30%!important;
 	}
  	.dataTables_scrollHeadInner thead .column-2{
 		width: 16%!important;
 	}
  	.dataTables_scrollHeadInner thead .column-3{
 		width: 15%!important;
 	}
  	.dataTables_scrollHeadInner thead .column-4{
		width: 18.5%!important;
 	}


  	.dataTables_scrollBody tbody .column-1{
 		width: 30%!important;
 	}
  	.dataTables_scrollBody tbody .column-2{
 		width: 16%!important;
 	}
  	.dataTables_scrollBody tbody .column-3{
 		width: 15%!important;
 	}
 	@media (max-width: 990px){
	  	.dataTables_scrollBody tbody .column-2{
	 		width: 20%!important;
	 	}
	  	.dataTables_scrollBody tbody .column-3{
	 		width: 14%!important;
	 	}
 	}
 	@media (max-width: 768px){
	  	.tablepress thead th{
			font-size: 9px;
	  	}
	  	.dataTables_scrollHeadInner thead .column-2 {
    		width: 19.5%!important;
		}
 	}
  	@media (max-width: 480px){
  		.dataTables_scroll{
  			overflow: scroll;
  		}
  		.dataTables_scrollHead{
  			width: 500px!important;
  		}
  		.dataTables_scrollBody{
  			width: 500px!important;
  		}
 	}

 </style>
<script type="text/javascript">
window.onload=function() {
	$('.price_table').insertAfter('.post-entry');
$('.price_table tbody tr').append("<td><input type='number' placeholder='Количество'/> <a href='#order_form_pop' class='order fancybox-inline' onclick='test();'>Заказать</a></td>");
$('.price_table thead tr').append("<th class='column-4' style='text-align:left;white-space: nowrap;'>Количество</th><th class='column-5' style='text-align:left;white-space: nowrap;'>Заказ</th>");	
//$('.price_table .dataTables_scrollBody thead tr').append("<th style='text-align:center;height:0;padding:0;border:none;'><div style='height:0; overflow:hidden;'></div></th>");	

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
		<!-- </div> ilvel-->

	<!--end post-entry-->
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
<?php
}
} else include('loop-portfolio-single-profnastil.php');
?>
