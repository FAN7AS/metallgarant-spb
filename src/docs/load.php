<?php
$root = dirname(__FILE__);
$request = $_SERVER['REQUEST_URI'];
$filename = basename($request);
$path = $root.'/'.$request;
 
if (file_exists($path)) {
    if (ob_get_level()) {
        ob_end_clean();
    }
    header("Content-Type: application/pdf; charset=UTF-8");
    header("Content-Length: ".filesize($path));
    header("Content-Disposition: attachment; filename=\"{$filename}\"");
    header("Content-Transfer-Encoding: binary");
    header("Cache-Control: must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    readfile($path);
}
?>