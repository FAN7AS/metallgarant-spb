<?php
$mmFunktion = isset($_GET['mmFunktion'])?$_GET['mmFunktion']:'';
$mmSize 	= isset($_GET['mmSize'])?$_GET['mmSize']:'';
$mmColor 	= isset($_GET['mmColor'])?$_GET['mmColor']:'';
$mmSColor 	= isset($_GET['mmSColor'])?$_GET['mmSColor']:'';
$mmText 	= isset($_GET['mmText'])?$_GET['mmText']:'';
$mmTyp 		= isset($_GET['mmTyp'])?$_GET['mmTyp']:'';
$mmStempel 	= isset($_GET['mmStempel'])?$_GET['mmStempel']:'';
$mmPage 	= isset($_GET['page'])?$_GET['page']:'';
$mmPos 		= isset($_GET['mmPos'])?$_GET['mmPos']:'';
$mmLinks 	= isset($_GET['mmLinks'])?$_GET['mmLinks']:'';
$mmOben 	= isset($_GET['mmOben'])?$_GET['mmOben']:'';
$mmTransp 	= isset($_GET['mmTransp'])?$_GET['mmTransp']:'';
$mmFont 	= isset($_GET['mmFont'])?$_GET['mmFont']:'';
$mmOrg 		= isset($_GET['mmOrg'])?$_GET['mmOrg']:'';
$mmThu	 	= isset($_GET['mmThu'])?$_GET['mmThu']:'';
$mmGif	 	= isset($_GET['mmGif'])?$_GET['mmGif']:'';
$mmJpg	 	= isset($_GET['mmJpg'])?$_GET['mmJpg']:'';
$mmPng	 	= isset($_GET['mmPng'])?$_GET['mmPng']:'';

$mmSelb 	= isset($_SERVER['PHP_SELF'])?$_SERVER['PHP_SELF']:'';

$sendN 		= "";
$sendY 		= "";
$sendol 	= "";
$sendom 	= "";
$sendor 	= "";
$sendml 	= "";
$sendmm 	= "";
$sendmr 	= "";
$sendul 	= "";
$sendum 	= "";
$sendur 	= "";
$sendf 		= "";
$sendt 		= "";
$sendgif	= "";
$sendjpg	= "";
$sendpng	= "";

//$mmImagePath=(ABSPATH . 'wp-content/plugins/marekkis-watermark');
$mmImagePath=WM_PLUGIN_PATH;
$mmFontPath=$mmImagePath."/fonts";

$wm_save_options="wm_save_options";
$wm_preview_options="wm_preview_options";


$mmFontListe=array();
$mmFontNonExist=TRUE;
if ($handle = opendir($mmFontPath)) {
   while (false !== ($file = readdir($handle))) {
      if(preg_match("/ttf$/i", $file)) {
        array_push($mmFontListe, $file);
        if($mmFont==$file) {
          $mmFontNonExist=FALSE;
        }
      }
   }
   closedir($handle);
   sort($mmFontListe,SORT_STRING);
}

if($mmPos=="") {
  $mmPos="ur";
}
if($mmTyp=="") {
  $mmTyp="f";
}

$mmLinks=intval($mmLinks);
$mmOben=intval($mmOben);

$mmErrorListe=array();

if($mmTyp=="t"){
  if($mmFontNonExist) {
    array_push($mmErrorListe, "font");
  }
  $mmSize=intval($mmSize);
  if($mmSize<1) {
    array_push($mmErrorListe, "size");
  }
  $mmColor=hexdec($mmColor);
  $mmColor=sprintf("%06X",$mmColor);
  $mmTransp=intval($mmTransp);
  if(($mmTransp>100) || ($mmTransp<0)){
    array_push($mmErrorListe, "opaque");
  }
  if($mmSColor!="none") {
    $mmSColor=hexdec($mmSColor);
    $mmSColor=sprintf("%06X",$mmSColor);
  }
}

$wm_value_save[0]=$mmStempel;
$wm_value_save[1]=$mmPos;
$wm_value_save[2]=$mmLinks;
$wm_value_save[3]=$mmOben;
$wm_value_save[4]=$mmTyp;
$wm_value_save[5]=$mmSize;
$wm_value_save[6]=$mmColor;
$wm_value_save[7]=$mmText;
$wm_value_save[8]=$mmSColor;
$wm_value_save[9]=$mmTransp;
$wm_value_save[10]=$mmFont;
$wm_value_save[11]=$mmOrg;
$wm_value_save[12]=$mmThu;
$wm_value_save[13]=$mmGif;
$wm_value_save[14]=$mmJpg;
$wm_value_save[15]=$mmPng;

$mmCounter=0;
if(count($mmErrorListe)>0) {
  print "<div id=\"message\" class=\"updated fade\"><p><strong>Please setup correct following information:</strong></p></div>";
  foreach ($mmErrorListe as $value) {
    print "$value";
    $mmCounter++;
    if($mmCounter<count($mmErrorListe)) {
      print ", ";
    }
  }
  print ".</strong></p></div>";
}

$mmPreviewYN="NOP";
switch($mmFunktion) {
	case 'Save':
		update_option($wm_save_options, $wm_value_save);
		$wm_db_content=get_option($wm_save_options);
		print "<div id=\"message\" class=\"updated fade\"><p><strong>Save current settings</strong></p></div>";
	break;
	case 'Preview':
		update_option("wm_preview_options", $wm_value_save);
		$wm_db_content=get_option($wm_preview_options);
		$mmPreviewYN="Preview";
		print "<div id=\"message\" class=\"updated fade\"><p><strong>Create preview</strong></p></div>";
	break;
	case 'Reset':
		$wm_db_content=get_option($wm_save_options);
		print "<div id=\"message\" class=\"updated fade\"><p><strong>Restore setting</strong></p></div>";
	break;
	default:
		$wm_db_content=get_option($wm_save_options);
	break;
}

switch($wm_db_content[0]){
	case "No":
		$sendN = "selected=\"selected\"";
	break;
	case "Yes":
		$sendY = "selected=\"selected\"";
	break;
}
switch($wm_db_content[4]){
	case "f":$sendf = " checked=\"checked\"";break;
	case "t":$sendt = " checked=\"checked\"";break;
}
switch($wm_db_content[1]){
	case "ol":$sendol = " checked=\"checked\"";break;
	case "om":$sendom = " checked=\"checked\"";break;
	case "or":$sendor = " checked=\"checked\"";break;
	case "ml":$sendml = " checked=\"checked\"";break;
	case "mm":$sendmm = " checked=\"checked\"";break;
	case "mr":$sendmr = " checked=\"checked\"";break;
	case "ul":$sendul = " checked=\"checked\"";break;
	case "um":$sendum = " checked=\"checked\"";break;
	case "ur":$sendur = " checked=\"checked\"";break;
}

$sendof = ( $wm_db_content[11] == 'on' )? "checked":"";
$sendot = ( $wm_db_content[12] == 'on' )? "checked":"";

$sendgif = ( $wm_db_content[13] == 'on' )? "checked":"";
$sendjpg = ( $wm_db_content[14] == 'on' )? "checked":"";
$sendpng = ( $wm_db_content[15] == 'on' )? "checked":"";


$mmLinks=$wm_db_content[2];
$mmOben=$wm_db_content[3];
$mmSize=$wm_db_content[5];
$mmColor=$wm_db_content[6];
$mmText=$wm_db_content[7];
$mmSColor=$wm_db_content[8];
$mmTransp=$wm_db_content[9];
$mmFont=$wm_db_content[10];
$mmOrg=$wm_db_content[11];
$mmThu=$wm_db_content[12];
$mmGif=$wm_db_content[13];
$mmJpg=$wm_db_content[14];
$mmPng=$wm_db_content[15];

$fsbreite="350px";

//get_currentuserinfo();
if (!current_user_can('manage_options')) {
	die ("Sorry, you must be logged in and at least a level 8 user to access admin setup options.");
}

echo '
<div class="wrap">
<h2>Watermark-Plugin '.WM_AKT_VERSION.' - Watermark - Admin Area</h2>
<form name="mmWater" action="'.$mmSelb.'" method="GET">
<center>
<table border="0" padding="10" width="90%">
  <tr align="left">
    <td width="50%">
      <table border="0">
	    <tr>
		  <td>
		    <b>Create Watermark?</b><br>
			<select name="mmStempel"/>
				<option '.$sendY.'>Yes</option>
				<option '.$sendN.'>No</option>
			</select>
	        <hr>
		  </td>
		</tr>
		<tr>
		  <td>
		    <table border="0" width="80%">
			  <tr><td width="50%" valign="top">
		        <b>Position</b><br>
			    <table border="1">
				<tr>
					<td><input type="radio" name="mmPos" value="ol"'.$sendol.'></td>
					<td><input type="radio" name="mmPos" value="om"'.$sendom.'></td>
					<td><input type="radio" name="mmPos" value="or"'.$sendor.'></td>
				</tr>
    			<tr>
					<td><input type="radio" name="mmPos" value="ml"'.$sendml.'></td>
					<td><input type="radio" name="mmPos" value="mm"'.$sendmm.'></td>
					<td><input type="radio" name="mmPos" value="mr"'.$sendmr.'></td>
				</tr>
    			<tr>
					<td><input type="radio" name="mmPos" value="ul"'.$sendul.'></td>
					<td><input type="radio" name="mmPos" value="um"'.$sendum.'></td>
					<td><input type="radio" name="mmPos" value="ur"'.$sendur.'></td>
				</tr>
    		</table>
			</td>
			<td width="50%" valign="top">
			<b>Offset</b><br>
			<table border="0">
				<tr><td>x</td><td><input type="text" name="mmLinks" value="'.$mmLinks.'" size="4"> px</td></tr>
				<tr><td>y</td><td><input type="text" name="mmOben" value="'.$mmOben.'" size="4"> px</td></tr>
			</table>
			</td>
			</tr>
			</table>
			<hr>
		  </td>
		</tr>
		<tr>
		   <td>
		      <b>Type of Watermark</b><br>
		  	  <table border="0">
		    	<tr>
			  		<td><input type="radio" name="mmTyp" value="f"'.$sendf.'></td>
			  		<td>Use file <i>stempel.png</i> as watermark</td>
				</tr>
				<tr><td colspan="2"><hr width="50%"></td></tr>
				<tr>
			  		<td valign="top"><input type="radio" name="mmTyp" value="t"'.$sendt.'></td>
			  		<td>Use text as watermark<br>
					  <table border="0">
						<tr><td>Font:</td><td><select name="mmFont" size="1">';
            foreach ($mmFontListe as $value) {
                print "<option";
                if($mmFont==$value) {
                  echo ' selected="selected"';
				}
                print ">$value</option>";
            }
			echo '</select></td></tr>
            <tr><td>Size:</td><td><input type="text" name="mmSize" value="'.$mmSize.'" size="4" maxlength="2"> px</td></tr>
						<tr><td>Color:</td><td><input type="text" name="mmColor" value="'.$mmColor.'" size="6" maxlength="6"> (hex w/o #)</td></tr>
						<tr><td valign="top">Text:</td><td><textarea name="mmText" cols="20" rows="5">'.$mmText.'</textarea></td></tr>
				    <tr><td>Opaque:</td><td><input type="text" name="mmTransp" value="'.$mmTransp.'" size="3" maxlength="3"> % </td></tr>
				    <tr><td>Shadow:</td><td colspan="3"><input type="text" name="mmSColor" value="'.$mmSColor.'" size="6" maxlength="6"> (hex w/o # - <b>none</b> for no shadow)</td></tr>
					  </table>
					</td>
				</tr>
			  </table>
			</td>
		  </tr>
		</table>
	  </td>
	  <td valign="top" width="50%">
	  <b>Preview</b><br>
	<p align="center">
    <img src="../wp-content/plugins/marekkis-watermark/show_preview.php?PicType='.$mmPreviewYN.'"></p>
	<table border="0">
	<tr>
	<td><p>Watermark orginal image?:</p></td>
	<td><input type="checkbox" name="mmOrg" '.$sendof.'></td>
	</tr>
	<tr>
	<td><p>Watermark resized images?:</p></td>
	<td><input type="checkbox" name="mmThu" '.$sendot.'></td>
	</tr>
	<tr><td colspan="2"><hr></td></tr>
	<tr><td colspan="2"><b>Watermark file type:</b></td></tr>
	<tr>
	<td align="center">GIF</td>
	<td><input type="checkbox" name="mmGif" '.$sendgif.'></td>
	</tr>
	<tr>
	<td align="center">JPG</td>
	<td><input type="checkbox" name="mmJpg" '.$sendjpg.'></td>
	</tr>
	<tr>
	<td align="center">PNG</td>
	<td><input type="checkbox" name="mmPng" '.$sendpng.'></td>
	</tr>
	</table>
	  </td>
	</tr>
	<tr>
	  <td colspan="2" align="center">
 	 	   <input type="hidden" name="page" value="'.$mmPage.'">
		   <input type="submit" name="mmFunktion" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type="submit" name="mmFunktion" value="Preview">&nbsp;&nbsp;&nbsp;&nbsp;
		   <input type="submit" name="mmFunktion" value="Reset">
	  </td>
	</tr>
</table>
</form>
</center>
</div>';
?>
