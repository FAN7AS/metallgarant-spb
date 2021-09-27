<?php 
global $avia_config;
do_action( 'avia_action_template_check' , 'single' );
get_header(); 
?>
<div class='container_wrap <?php avia_layout_class( 'main' ); ?>' id='main'>
<div class='container template-blog template-single-blog'>
<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
<?php if ( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
</div>
<div class='content units <?php avia_layout_class( 'content' ); ?>'>
<h1><?php the_title(); ?></h1>
<?php while ( have_posts() ) { the_post(); the_content(); } ?>
<?php previous_post_link(); ?><br />
<?php next_post_link(); ?>
<br />
<br />
<?php get_template_part( 'includes/related-posts'); ?>


</div>
<?php 
//$avia_config['currently_viewing'] = "blog";
//get_sidebar();
//echo avia_post_nav();
?>


<div class="four units entry-content" style="border: none;">
			<img src="http://metallgarant-spb.ru/wp-content/uploads/2018/02/skuvshe.jpg" alt="" style="margin: 30px 0 0; width: 290px !important; cursor: pointer;" class="java_link2" onclick="window.location.href = '/metalloprokat-v-kredit/'">
			<!-- bests -->
							<!-- end bests -->
            <!-- код вывода дочерних страниц -->
			<?php 
			  if($post->post_parent) 
				$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0&post_type=portfolio");  
			  else
				$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&post_type=portfolio");

			  if ($children) { ?>  
				<div class="for-childrens" >
				  <ul>  
					<?php echo $children; ?>  
				  </ul>
				</div>
			<?php } ?> 
			<!-- /код вывода дочерних страниц -->				

			<!-- вывод калькулятора -->
			<div class="calc-container">
				<div class="calc-title">Калькулятор стального металлопроката</div>
				<form lpformnum="46">
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
							<p><label for="outer-diametr-tube">Внешний диаметр, мм</label></p>
							<p><input style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-position: right center;" value="" id="outer-diametr-tube" type="text"></p>
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



			<!--<span class='date-container minor-meta meta-color'>Май 29, 2013</span>-->
			

			<div class="blog-inner-meta extralight-border">
				<!--<div class='post-meta-infos'>
				<div class="like-count minor-meta"><a data-post_id='1409' data-json='http://api.facebook.com/restserver.php?method=links.getStats&urls=http%3A%2F%2Fmetallgarant-spb.ru%2Fproduct%2Fgnutyiy-shveller%2F' class='avia_social_link avia_facebook_likes' href='http://www.facebook.com/sharer/sharer.php?t=%D0%93%D0%BD%D1%83%D1%82%D1%8B%D0%B9+%D1%88%D0%B2%D0%B5%D0%BB%D0%BB%D0%B5%D1%80&amp;u=http%3A%2F%2Fmetallgarant-spb.ru%2Fproduct%2Fgnutyiy-shveller%2F'><span class='avia_count'>0</span> Likes</a><div class="avia-facebook-like"><div class="fb-like" data-href="http%3A%2F%2Fmetallgarant-spb.ru%2Fproduct%2Fgnutyiy-shveller%2F" data-send="false" data-layout="box_count" data-width="250" data-show-faces="false" data-font="arial"></div></div></div><span class="text-sep like-count-sep">/</span><span class="tweets-count minor-meta"><a data-post_id='1409' data-json='http://urls.api.twitter.com/1/urls/count.json?url=http%3A%2F%2Fmetallgarant-spb.ru%2Fproduct%2Fgnutyiy-shveller%2F' class='avia_social_link avia_retweet_link' href='https://twitter.com/intent/tweet?text=%D0%93%D0%BD%D1%83%D1%82%D1%8B%D0%B9+%D1%88%D0%B2%D0%B5%D0%BB%D0%BB%D0%B5%D1%80&amp;url=http%3A%2F%2Fmetallgarant-spb.ru%2F%3Fp%3D1409'><span class='avia_count'></span> Tweets</a></span><span class="text-sep tweets-count-sep">/</span><span class="blog-categories minor-meta">posted in <a href="http://metallgarant-spb.ru/portfolio_entries/prokat/" rel="tag">Металлопрокат</a> </span>				</div>-->	
			</div>
		</div>



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
		width: 24.5%!important;
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
 		.dataTables_scrollHeadInner thead .column-2{
 			width: 19%!important;
 		}
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
		.dataTables_scrollHeadInner thead .column-4 {
    		width: 23%!important;
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
<?php get_footer(); ?>