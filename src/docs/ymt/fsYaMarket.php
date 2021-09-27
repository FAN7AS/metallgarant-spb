<?php
class YandexMarket {
  /**
   * Валидный yml генератор для Яндекс Маркет
   * @version 0.43  Date: 02.04.2018
   * @author: fStrange
   * @url: http://fstrange.ru/coder/php/yml-script-yandex-market.html
   */

  protected
    $name = '',
    $company = '',
    $url = '',
    $date = '',
    $rootElem = '',
    $shopElem = '',
    $uxStart =0,
    $aOffer = array(),
    $aCurr = array(), //валюты
    $aCat = array(), //категории
    $aDbg = array(); //debug

  public function __construct($name = '', $company = '', $url = '') {
    $this->uxStart = time();
    $this->name = self::filterElem($name);
    $this->company = self::filterElem($company);
    $this->url = $url;
    $this->date = date("Y-m-d H:i");
    $this->rootElem = "<?xml version='1.0' encoding='utf-8'?>
    		<!DOCTYPE yml_catalog SYSTEM 'shops.dtd'>
    		<!-- This YML generated with Yandex Market 0.4 (http://fstrange.ru/coder/php/yml-script-yandex-market.html)-->
    <yml_catalog date='{$this->date}'>\r\n%s\r\n</yml_catalog>";
    $this->shopElem =
      "<shop>\r\n<name>{$this->name}</name>
        <company>$this->company</company>
        <url>{$this->url}</url>
        <currencies>\r\n%s\r\n</currencies>
        <categories>\r\n%s\r\n</categories>
        <offers>\r\n%s\r\n</offers>
        </shop>\r\n
        <!-- Debug info \r\n%s \r\n-->";

  }

  /*
   * setCurr('RUR', 1);
   * setCurr('USD', 'CBRF');
   */
  public function addCurr($id, $rate, $plus = null) {
    $this->aCurr[] = "<currency ".self::setAttr(array('id'=>$id, 'rate' => $rate, 'plus'=>$plus)). " />";
  }

  public function addCat($sName, $id, $pid=0) {
    $sPid = $pid ? "parentId=\"$pid\"" : '';
    $this->aCat[] = "<category id=\"$id\" $sPid>".self::filterElem($sName)."</category>";
  }

  public function addOffer($sOffer){
    $this->aOffer[] = $sOffer;
  }

  public function addDbg($sInfo, $sTitle = ''){
    if(is_array($sInfo)) $sInfo = print_r($sInfo, true);
    $this->aDbg[] = $sTitle ? $sTitle.':'.$sInfo : $sInfo;
  }



  public function save() {
    $this->addDbg(count($this->aCat), 'this->aCat');
    $this->addDbg(count($this->aOffer), 'this->aOffer');
    $this->addDbg(time() - $this->uxStart, 'time sec.');
    $this->shopElem = sprintf($this->shopElem, implode("\n", $this->aCurr), implode("\n", $this->aCat), implode("\n", $this->aOffer), implode("\n", $this->aDbg));
    return sprintf($this->rootElem, $this->shopElem);
  }


  public function setOffer($id, $sType){

  }

  public static function setXmlNode($k, $v){
    return "<$k>$v</$k>";
  }
  public static function setAttr($a) {
    $s = '';

    //удалить пустые элементы массива
    $array_empty = array(null);
    $a = array_diff($a, $array_empty);

    foreach ($a as $k => $v) {
      $s .= "$k=\"$v\" ";
    }
    return trim($s);
  }

  public static function filterElem($s) {
    $a['&nbsp;'] = ' ';
    $a['&ndash;'] = ' ';
    $a['&raquo;'] = ' ';
    $a['&laquo;'] = ' ';
    $a['&ldquo;'] = ' ';
    $a['&rdquo;'] = ' ';
    $a['&bull;'] = ' ';
    $a['&oacute;'] = ' ';
    $a['&plusmn;'] = ' ';
    $s = str_replace(array_keys($a), array_values($a), $s);
    $s = strip_tags($s);
    $s = htmlspecialchars_decode($s);

    $a['"'] = '&quot;';
    $a['&'] = '&amp;';
    $a['>'] = '&gt;';
    $a['<'] = '&lt;';
    $a["'"] = '&apos;';
    $s = str_replace(array_keys($a), array_values($a), $s);

    return $s;
  }
}

/*
 * $offer = new OfferYmt($id);
 * $offer->setUrl('http://ghghg.ghghg.ru/url/');
 * $offer->setRequired($price, $currencyId, $categoryId, $vendor, $model);
 */
class OfferYmt {
  //http://partner.market.yandex.ru/legal/tt/#id1164057815703
  //offer DTD type
  protected
    $sDtdElem =  'url?, buyurl?, price, wprice?, currencyId, xCategory?, categoryId+,picture?, store?, pickup?, delivery?, deliveryIncluded?,
                local_delivery_cost?, orderingTime,
                typePrefix?, name, vendor?, vendorCode?, model,
                aliases?, additional*, description?, sales_notes?, promo?,
                manufacturer_warranty?, country_of_origin?, downloadable?, adult?,
                barcode*, param*',
    $aOffer = array(),
    $aElems = array(),
    $aParams = array(),
    $aSort = array(),
    $sOfferElem = '';

  public function __construct($id, $available=1, $group_id=null) { //$bid=null, $cid=null,
    $a = array('available'=>$available? 'true' : 'false' ,'group_id'=>$group_id);
    //$this->sOfferElem = "<offer id=\"$id\" type=\"vendor.model\" ";
    $this->sOfferElem = "<offer id=\"$id\" ";
    $this->sOfferElem .= YandexMarket::setAttr($a);
    $this->sOfferElem .= ">\r\n%s\r\n</offer>";


    //$this->aElems = explode(',', $this->sDtdElem);
    //$this->aElems = array_map(array($this, '_cbTrim'), $this->aElems);
    $a0 = explode(',', $this->sDtdElem);
    array_walk($a0, '_cbYmTrim');

    $this->aSort = $a0;

    /*
     * сформировали массив элементов в правильной последовательности описанной в DTD
     * для Яндекс Маркета это важно!!!!
     */
    $this->aElems = array_fill_keys($a0, null);
    //dbg($this->aElems,'fill');
  }

  public function setRequired($price, $currencyId, $categoryId, $name){
    $this->setElem('price', $price);
    $this->setElem('currencyId', $currencyId);
    $this->setElem('categoryId', $categoryId);

    $this->setElem('name', $name);
  }

  public function setUrl($s){ $this->aElems['url'] = $s;}

  public function setElem($sName, $sTitle){
    $this->aElems[$sName] = YandexMarket::filterElem($sTitle);
  }
  public function setParam($name, $title, $unit=''){
    if($unit) $param = 'name="'.$name.'" unit="'.$unit.'"'; else $param='name="'.$name.'"';
    $this->aParams[$param] =$title;
  }

  public function save(){
    $s = '';
    foreach($this->aElems as $k=>$v) if(!is_null($v)) $s .= YandexMarket::setXmlNode($k,$v)."\n";

    foreach($this->aParams as $k=>$v) if(!is_null($v)) $s .= '<param '.$k.'>'.$v.'</param>'."\n";

    $this->sOfferElem = sprintf($this->sOfferElem, $s);
    return $this->sOfferElem;
  }
  private function _cbTrim(&$s) { $s = trim($s, "+?* \r\n\t");}

}

function _cbYmTrim(&$s) { $s = trim($s, "+?* \r\n\t");}
function szYmtUrl($su){
  $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D','+');
  $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]", "%20");
  return str_replace($entities, $replacements, urlencode($su));
}