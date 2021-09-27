<?php
require_once(dirname(__FILE__).'/functions.php');

/* Begin Add Assets */
/*add_action('wp_insert_modules_css', 'wp_insert_module_pagelevelads_css', 0);
function wp_insert_module_pagelevelads_css() {
	wp_register_style('wp-insert-module-pagelevelads-css', WP_INSERT_URL.'includes/modules/pagelevelads/css/module.css', array('wp-insert-css'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_style('wp-insert-module-pagelevelads-css');
}*/

add_action('wp_insert_modules_js', 'wp_insert_module_pagelevelads_js', 0);
function wp_insert_module_pagelevelads_js() {
	wp_register_script('wp-insert-module-pagelevelads-js', WP_INSERT_URL.'includes/modules/pagelevelads/js/module.js', array('wp-insert-js'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_script('wp-insert-module-pagelevelads-js');
}
/* End Add Assets */

/* Begin Add Card in Admin Panel */
add_action('wp_insert_plugin_card', 'wp_insert_pagelevelads_plugin_card', 20);
function wp_insert_pagelevelads_plugin_card() {
	echo '<div class="plugin-card">';
		echo '<div class="plugin-card-top">';
			echo '<h4>Page-level Ads</h4>';
			echo '<p>Adsense Page-level ads are shown on your site only at optimal times.<br />Google Provides a testing tool in adsense portal for webadmins to test your Adsense Page-Level Ads.</p>';
		echo '</div>';
		echo '<div class="plugin-card-bottom">';
			$pagelevelads = get_option('wp_insert_pagelevelads');
			if(isset($pagelevelads) && is_array($pagelevelads)) {
				foreach($pagelevelads as $key => $value) {
					echo '<p>';
						echo '<a id="wp_insert_pagelevelads_'.$key.'" href="javascript:;" onclick="wp_insert_pagelevelads_click_handler(\''.$key.'\', \''.$value['title'].'\')">Page-Level Ad : '.$value['title'].'</a>';
						echo '<span class="dashicons dashicons-dismiss wp_insert_delete_icon" onclick="wp_insert_pagelevelads_remove(\''.$key.'\')"></span>';
					echo '</p>';
				}
			}				
			echo '<p style="text-align: center; padding: 20px 0 10px;"><a id="wp_insert_pagelevelads_new" href="#" class="button-secondary">Add New Page-Level Ad</a></p>';
		echo '</div>';
	echo '</div>';
}
/* End Add Card in Admin Panel */
?>