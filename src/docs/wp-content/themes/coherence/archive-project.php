<?php 
global $avia_config;
do_action( 'avia_action_template_check' , 'single' );
get_header(); 
?>
<div class='container_wrap <?php avia_layout_class( 'main' ); ?>' id='main'>
<div class='container template-blog template-single-blog'>
<div>

	<h3>Введите номер заказа и получите доступ к чертежам</h3>
<form method="get" action="/project/">
	<input type="text"  name="n" value="">
	<input type="submit" value="Найти">
</form>
<br>
<br>

<?php 
//print_r($_GET[n]);
$nnn = $_GET[n];
$proekta = get_page_by_title($nnn, OBJECT, 'project');
if($_GET["n"]) {
	//print_r($proekta);
	if ($proekta->post_name) {
		echo '<a href="/project/';
	echo $proekta->post_name;
	echo '/">';
	echo 'Проектные документы к заказу №';
	echo $proekta->post_title;
	echo '</a>';

	} else {
		echo "<p>Такого заказа нет.</p>";
	}
}



?>
<br>
<br>





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