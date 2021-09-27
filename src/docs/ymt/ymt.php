<?php
//header('Content-type: text/plain; charset=utf-8');
//ini_set("display_errors", "1");
//error_reporting(E_ALL);

include 'fsYaMarket.php';
include 'mysqli.php';
include '../wp-config.php';
//ini_set("display_errors", "1");
//error_reporting(E_ALL);

$sHost = DB_HOST;
$sUser = DB_USER;
$sPwd = DB_PASSWORD;
$sDb = DB_NAME;

define('DBG_LOCAL', getenv('USERNAME') == 'loki'); //debug in local comp
if (DBG_LOCAL) {
	$sHost = 'localhost';
	$sUser = 'mysql';
	$sPwd = 'mysql';
	$sDb = 'ymt';
}

$db = new Sql($sHost, $sUser, $sPwd, $sDb);
if ($db->connect_errno) {
	die('Ошибка соединения: ' . $Db->connect_errno);
}

$db->q("SET character_set_database=utf8");
$db->q("SET character_set_client=utf8");
$db->q('SET NAMES "UTF8"');

$shopName = 'metallgarant';
$companyName = 'metallgarant';
$siteURL = 'https://' . $_SERVER['HTTP_HOST'];

$market = new YandexMarket($shopName, $companyName, $siteURL);

$market->addCurr('RUR', 1);
$market->addCurr('USD', 'CBRF');

$aCat = array();
//$q = 'SELECT * FROM wp_terms WHERE term_id IN(SELECT term_id FROM wp_term_taxonomy WHERE taxonomy="wpsc_product_category")'; //wpsc_product_category
//$q = "select * from wp_posts WHERE ID=8186 OR post_parent=8186 AND post_type='page'";
$q = "select * from wp_posts WHERE ID IN(707,8378)AND (post_type='page' OR post_type='portfolio' )";
$aCat0 = $db->a($q, 'ID');
foreach ($aCat0 as $v) {
	$market->addCat($v['post_title'], $v['ID']);
	$aCat[$v['ID']] = $v['post_name'];
}
//print_r($aCat);
$ids = implode(',', array_keys($aCat));

$sTbl = $db->val("SELECT option_value FROM wp_options WHERE option_name='tablepress_tables'");
$aTbl = json_decode($sTbl, TRUE); //var_export($aTbl );
$aTblId = $aTbl['table_post'];

$q = 'SELECT * FROM wp_posts as p WHERE p.post_parent IN('.$ids.') AND p.post_status="publish"  
	AND (post_type="page" OR post_type="portfolio" )';
$r = $db->q($q);

while ($entry = $r->fetch_assoc()) {
  $id = $entry['ID'];
  $idParent =  $entry['post_parent'] ;

  //meta_key="_price"
  //$aTbl = $db->row("SELECT * FROM wp_posts")



	$bAvailable = 1;
	$iPrice = 0;
	$idTbl = getTblId($entry['post_content']); 
	if($idTbl) {
		$idP = $aTblId[$idTbl];
		$aP = $db->row("SELECT * FROM wp_posts WHERE ID=$idP"); //var_export($aP);
		if(!empty($aP['post_content'])) {
			$aPrice = json_decode($aP['post_content']);

			if(!empty($aPrice[1][3]) && !empty($aPrice[0][3]) && strpos($aPrice[0][3], 'ена/м')) {
				$iPrice = preg_replace('/[^\d.]/i', '', $aPrice[1][3]);
			}
			//var_export( json_decode($aP['post_content']));
		}
	}


	//https://metallgarant-spb.ru/krovelnye-materialy/metallocherepeca/monterrey/
	$url = 'https://metallgarant-spb.ru/krovelnye-materialy/'.$aCat[$idParent].'/'.$entry['post_name'].'/';
	if($idParent == 707) $url = 'https://metallgarant-spb.ru/product/profnastil/'.$entry['post_name'].'/';

	$offer = new OfferYmt($id, $bAvailable);
	$offer->setUrl($url);

	$offer->setRequired($iPrice, 'RUR', $idParent, $entry['post_title']);

	//_amt_description _variation_description
	$sDesc = $entry['post_content'];
	//$sDesc = strip_tags($sDesc);


	$sDesc = html_entity_decode(strip_tags(str_replace('&nbsp;', ' ', $sDesc)));
	// Удаление [...]
	$sDesc = preg_replace("/(.*?)\[.*?\]\s?(.*?)/is", '\\1\\3', $sDesc);
	$sDesc = str_replace('show_banner();', '', $sDesc);
	$offer->setElem('description', $sDesc);

	$suImg = getImgSrc($entry['post_content']);

	if ($suImg ) {
		$offer->setElem('picture', $suImg);
	}

	

	$do = 1;
	$sStop ='proizvodstvo,kupit,krovelnyiy-profnastil,profnastil/pod-,dlya-zabora,/dvuhstoronniy-profnastil,figurnyy-profnastil/';
	$sStop .= ',universalnyiy-profnastil,nesushhiy-profnastil,profnastil-stenovoy,/dobornye-jelementy,soputstvujushhie-tovary';
	$sStop .= ',stolbiki-i-lagi,stil/polimernyj/,profnastil/metallocherepeca/,profnastil/ocinkovannyj';
	$aStopUrl = explode(',', $sStop);
	foreach($aStopUrl as $vUrl) if($vUrl && strpos($url, $vUrl)) $do=0;

	if($do) $market->addOffer($offer->save());


	//break;
}
//dbg2f($aZoo);
$xml = $market->save();

/* $view = new Zend_View(array('basePath'=>APPLICATION_PATH.'/views'));
$view->xml = $xml;
$this->render('/yamarket/view') ;*/
header('Content-type:application/xml');
//$xml = iconv('utf-8', 'cp1251//TRANSLIT', $xml);//cp1251//TRANSLIT
//$xml = mb_convert_encoding($xml, "windows-1251", "utf-8");
//file_put_contents('ymt.xml', $xml);
echo $xml;

function getImgSrc($s){
	$pattern = '/src="([^"]*)"/i';

	if(preg_match_all(  $pattern , $s, $matches)) {
		if(!empty($matches[1][0])) return $matches[1][0];

	}
	return 0;

}
function getTblId($s){
	$pattern = '~\[table id=[0-9]{1,5} /\]~';

	if(preg_match_all(  $pattern , $s, $matches)) {
		//var_export($matches);
		if(!empty($matches[0][0])){ 
			$id = preg_replace('/[^\d]/i', '', $matches[0][0]);
			return $id;
		} 

	}
	return 0;
}
function dbg2f($message, $label = null) {
	$sf = 'dbg2f.log';
	$s = date('Y-m-d H:i:s');
	$s .= $label ? $label . ': ' : '';
	$s .= print_r($message, true);
	file_put_contents($sf, $s . "\n\n", FILE_APPEND);
}
function mbCutString($str, $length = 1500, $encoding = 'UTF-8') {
	if (mb_strlen($str, $encoding) <= $length) {
		return $str;
	}

	$tmp = mb_substr($str, 0, $length, $encoding);
	return mb_substr($tmp, 0, mb_strripos($tmp, '.', 0, $encoding), $encoding);
}