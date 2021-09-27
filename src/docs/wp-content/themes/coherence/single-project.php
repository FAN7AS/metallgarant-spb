<?php 
global $avia_config;
do_action( 'avia_action_template_check' , 'single' );
get_header(); 
?>
<div class='container_wrap <?php avia_layout_class( 'main' ); ?>' id='main'>
<div class='container template-blog template-single-blog'>
<div>

<?php
$batya = get_post_ancestors( $post->ID );
//print_r($batya[0]);
if ($batya[0]) {
	$batya_post = get_post($batya[0]);
	echo '<a href="';
	echo $batya_post->post_name;
	echo '/">Все файлы этого заказа</a><br>';

	//print_r($batya_post->post_name);
}


$childrens = get_children( [
	'post_parent' => $post->ID,
	'post_type'   => 'any', 
	'numberposts' => -1,
	'order' => 'ASC',
	'post_status' => 'any'
] );

if( $childrens ){
	//print_r($childrens);
	foreach( $childrens as $children ){
		//print_r($children);
		//$filelink = $children->post_name;
		echo '<a href="';
		echo $children->post_name;
		echo '">';
		echo $children->post_title;
		echo '</a><br>';
	}
}


 while ( have_posts() ) { the_post(); the_content(); }




  ?>



<br />
<!--div class="pdflinklist">
	<a href="?zakaz=158&pdf=1636-КМД-11101.pdf">1636-КМД-11101.pdf</a>
</div-->

<?php 

if($_GET[zakaz] and $_GET[pdf]) {
	$zakaz = $_GET[zakaz];
	$pdf = $_GET[pdf];

	echo '<a href="/project/';
	echo $post->post_name;
	echo '/">Показать все файлы проекта</a>';



	echo '<embed src="/file/project/';
	echo $zakaz;
	echo "/";
	echo $pdf;
	echo '" class="projectpdf" />';
	echo '<style type="text/css">.pdflinklist{display: none;}</style>';
}



?>
<br />
<br />

</div>

</div>
</div>
<style type="text/css">
.projectpdf {
 	width: 100%;
 	height: 1000px;
}

</style>
<?php get_footer(); ?>