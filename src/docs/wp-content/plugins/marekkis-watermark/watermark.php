<?php
/*
Plugin Name: Marekkis Watermark-Plugin
Plugin URI: http://www.wp-watermark.com
Description: Insert a Watermark in your Pictures
Author: Dr. Marek Malcherek
Version: 0.9.4
License: GPL2
Author URI: http://www.malcherek.de
*/

/*  Copyright 2006  Dr. Marek Malcherek  (email : contact@wp-watermark.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

define("WM_AKT_VERSION","0.9.4");
define("WM_PLUGIN_PATH", plugin_dir_path(__FILE__));

function mm_watermark_menu() {
  if (function_exists('add_options_page')) {
	global $wp_version;
	if ( $wp_version < 2 ) $capability=8; else $capability='manage_options';
    add_options_page('Watermark', 'Watermark', $capability, 'marekkis-watermark/index.php');
    add_options_page('Watermark-Dir', 'Watermark-Dir', $capability, 'marekkis-watermark/wm_dir.php');
  }
 }

include_once("wm_functions.php");
add_action('admin_menu', 'mm_watermark_menu');

?>
