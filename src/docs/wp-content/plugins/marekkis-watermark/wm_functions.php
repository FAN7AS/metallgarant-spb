<?php

function MM_CheckFile_WM($checkfile) {
	list($tmpaa, $tmpab, $tmpac)=split("\.",$checkfile,3);
	if((empty($tmpab)) || ($tmpac!="")) return false;
	switch($tmpab) {
		case "Gif"	:
		case "GIF"	:
		case "gif" 	: return 'gif';
		case "jpeg"	:
		case "Jpeg"	:
		case "JPEG"	:
		case "JPG"	:
		case "Jpg"	:
		case "jpg"	: return 'jpg';
		case "PNG"	:
		case "Png"	:
		case "png"	: return 'png';
		default		: return false;
	}
}

function mm_create_text($wm_create_array,$mmFont){
  	$mmRot=hexdec(substr($wm_create_array[6], 0, 2));
	$mmGruen=hexdec(substr($wm_create_array[6], 2, 2));
	$mmBlau=hexdec(substr($wm_create_array[6], 4, 2));
	$sizeLogo = ImageTTFBBox($wm_create_array[5], 0, $mmFont, $wm_create_array[7]);
	$LogoBreite = abs($sizeLogo[2]) + abs($sizeLogo[0]);
	$LogoHoehe = abs($sizeLogo[7]) + abs($sizeLogo[1]);
	$imageLogo = ImageCreateTrueColor(abs($sizeLogo[2]) + abs($sizeLogo[0]), abs($sizeLogo[7]) + abs($sizeLogo[1]));
	ImageSaveAlpha($imageLogo, true);
	ImageAlphaBlending($imageLogo, false);
	$bgLogo = imagecolorallocatealpha($imageLogo, 255, 255, 255, 127);
	imagefill($imageLogo, 0, 0, $bgLogo);
	$mmTransp=127-($wm_create_array[9]*1.27);
	$schriftLogo=imagecolorallocatealpha($imageLogo, $mmRot, $mmGruen, $mmBlau, $mmTransp);
  	imagettftext($imageLogo, $wm_create_array[5], 0, 0, abs($sizeLogo[5]), $schriftLogo, $mmFont, $wm_create_array[7]);
  return($imageLogo);
}

function MM_Execute_WM($file,$mmPreview){
$mmImagePath=(ABSPATH.'wp-content/plugins/marekkis-watermark');
$mmFontPath=$mmImagePath."/fonts";
	switch($mmPreview) {
		case 'Preview':
	    	$photoImage=ImageCreateFromJpeg("$mmImagePath/photo.jpg");
			$wm_value_content=get_option("wm_preview_options");
		break;
		case 'NOP':
	    	$photoImage=ImageCreateFromJpeg("$mmImagePath/photo.jpg");
	 	  	$wm_value_content=get_option("wm_save_options");
	 	break;
	  	default:
			$mmImagePath=(ABSPATH.'wp-content/plugins/marekkis-watermark');
			if (function_exists('exif_imagetype')) {
			   	switch(exif_imagetype($file)) {
			 		case 1: $photoImage = imagecreatefromgif($file);break;
		       		case 2: $photoImage = imagecreatefromjpeg($file);break;
		       		case 3: $photoImage = imagecreatefrompng($file);break;
		     		default : return false;
			   	}
			}
			else {
				switch(MM_CheckFile_WM($file)) {
			 		case "gif": $photoImage = imagecreatefromgif($file);break;
		       		case "jpg": $photoImage = imagecreatefromjpeg($file);break;
		       		case "png": $photoImage = imagecreatefrompng($file);break;
		     		default : return false;
				}
			}
			$wm_value_content=get_option("wm_save_options");
		break;
	}
	$mmFont=$mmFontPath."/".$wm_value_content[10];
	if($wm_value_content[0]=="Yes") {
		ImageAlphaBlending($photoImage, true);
		if($wm_value_content[4]=="t"){
    		$imageLogo=mm_create_text($wm_value_content,$mmFont);
    	}
		else {
			$imageLogo=ImageCreateFromPNG("$mmImagePath/stempel.png");
		}
		$LogoBreite = ImageSX($imageLogo);
		$LogoHoehe = ImageSY($imageLogo);
		$ImageBreite = ImageSX($photoImage);
		$ImageHoehe = ImageSY($photoImage);

		$mypos=preg_split('//',$wm_value_content[1]);
		switch($mypos[1]){
			case 'o':$aoben=0+$wm_value_content[3];break;
			case 'm':$aoben=$ImageHoehe/2-$LogoHoehe/2;break;
			case 'u':$aoben=$ImageHoehe-$LogoHoehe-$wm_value_content[3];break;
		}
		switch($mypos[2]){
			case 'l':$alinks=0+$wm_value_content[2];break;
			case 'm':$alinks=$ImageBreite/2-$LogoBreite/2;break;
			case 'r':$alinks=$ImageBreite-$LogoBreite-$wm_value_content[2];break;
		}
		if(($wm_value_content[8]!="none") && ($wm_value_content[4]=="t")){
			$wm_value_content[6]=$wm_value_content[8];
			$imageShadow=mm_create_text($wm_value_content,$mmFont);
	   		ImageCopy($photoImage, $imageShadow, ($alinks+2), ($aoben+2), 0, 0, $LogoBreite, $LogoHoehe);
		}
		ImageCopy($photoImage, $imageLogo, $alinks, $aoben, 0, 0, $LogoBreite, $LogoHoehe);
	}
	if(($mmPreview == "Preview") || ($mmPreview == "NOP")){
		header("Content-type: image/jpeg");
		ImageJPEG($photoImage,NULL,100);
	}
	else {
		if (function_exists('exif_imagetype')) {
			switch(exif_imagetype($file)) {
		        case 2: ImageJPEG($photoImage,$file,100);break;
				case 1: if (function_exists("imagegif")) {
							ImageGif($photoImage,$file);
						}
						else {
							ImageJPEG($photoImage,$file,100);
	    					$filename=str_replace('gif','jpg',$filename);
	    				}
						break;
		        case 3: ImagePNG($photoImage,$file);break;
			}
		}
		else {
			switch(MM_CheckFile_WM($file)) {
		        case "jpg": ImageJPEG($photoImage,$file,100);break;
				case "gif": if (function_exists("imagegif")) {
								ImageGif($photoImage,$file);
							}
							else {
								ImageJPEG($photoImage,$file,100);
	    						$filename=str_replace('gif','jpg',$filename);
	    					}
							break;
		        case "png": ImagePNG($photoImage,$file);break;
			}
		}
	}
	ImageDestroy($photoImage);
  	ImageDestroy($imageLogo);
}


function mm_watermark_form() {

	$wm_value_content=get_option("wm_save_options");
	switch($wm_db_content[0]){
		case "No":
			$sendN = "selected=\"selected\"";
		break;
		case "Yes":
			$sendY = "selected=\"selected\"";
		break;
	}
	echo '
			<fieldset id="mmMakeWatermark">
				<legend>Create watermark?</legend>
				<div>
					<select id="createWM" name="mmLast" value="'.$wm_db_content[0].'" />
						<option '.$sendY.'>Yes</option>
						<option '.$sendN.'>No</option>
					</select>
				</div>
			</fieldset>';
	return createWM;
}

add_filter('wp_generate_attachment_metadata', 'mm_applyWatermark');
function mm_applyWatermark($data) {
	$udir = wp_upload_dir();
	$wm_db_content=get_option("wm_save_options");
	$mm_wm_file= $udir['basedir']."/".$data['file'];
	$mm_applyWatermarkExecute = false;
		
	if (function_exists('exif_imagetype')) {
		if ( (exif_imagetype($mm_wm_file) == 1 && $wm_db_content[13] == 'on') ||
			 (exif_imagetype($mm_wm_file) == 2 && $wm_db_content[14] == 'on') ||	
			 (exif_imagetype($mm_wm_file) == 3 && $wm_db_content[15] == 'on') ) {
			$mm_applyWatermarkExecute = true;	 
		}
		else {
			$mm_applyWatermarkExecute = false;	 
		}
	}
	else {
		if ( (MM_CheckFile_WM($mm_wm_file) == 'gif' && $wm_db_content[13] == 'on') ||
			 (MM_CheckFile_WM($mm_wm_file) == 'jpg' && $wm_db_content[14] == 'on') ||	
			 (MM_CheckFile_WM($mm_wm_file) == 'png' && $wm_db_content[15] == 'on') ) {
 			$mm_applyWatermarkExecute = true;	 
		}
		else {
			$mm_applyWatermarkExecute = false;	 
		}
	}
	if ( $mm_applyWatermarkExecute ) {
		if ($wm_db_content[12] == 'on') {
			// Thumbnails
			foreach ($data['sizes'] as $datas) {
				MM_Execute_WM($udir['path']."/".$datas['file'],'');
			}
		}		
		if ($wm_db_content[11] == 'on') {
			// Original image
			MM_Execute_WM($udir['basedir']."/".$data['file'],'');
		}
	}
	return $data;
}

?>
