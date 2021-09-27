<?php
require_once(dirname(__FILE__).'/functions.php');

/* Begin Add Assets */
/*add_action('wp_insert_modules_css', 'wp_insert_module_adwidgets_css', 0);
function wp_insert_module_adwidgets_css() {
	wp_register_style('wp-insert-module-adwidgets-css', WP_INSERT_URL.'includes/modules/adwidgets/css/module.css', array('wp-insert-css'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_style('wp-insert-module-adwidgets-css');
}*/

add_action('wp_insert_modules_js', 'wp_insert_module_adwidgets_js', 0);
function wp_insert_module_adwidgets_js() {
	wp_register_script('wp-insert-module-adwidgets-js', WP_INSERT_URL.'includes/modules/adwidgets/js/module.js', array('wp-insert-js'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_script('wp-insert-module-adwidgets-js');
}
/* End Add Assets */

/* Begin Add Card in Admin Panel */
add_action('wp_insert_plugin_card', 'wp_insert_adwidgets_plugin_card', 50);
function wp_insert_adwidgets_plugin_card() {
	echo '<div class="plugin-card">';
		echo '<div class="plugin-card-top">';
			echo '<h4>Ad Widgets</h4>';
			echo '<p>Ads shown inside widget enabled areas.</p>';
		echo '</div>';
		echo '<div class="plugin-card-bottom">';
			$adwidgets = get_option('wp_insert_adwidgets');
			if(isset($adwidgets) && is_array($adwidgets)) {
				foreach($adwidgets as $key => $value) {
					echo '<p>';
						echo '<a id="wp_insert_adwidgets_'.$key.'" href="javascript:;" onclick="wp_insert_adwidgets_click_handler(\''.$key.'\', \''.$value['title'].'\')">Ad Widget : '.$value['title'].'</a>';
						echo '<span class="dashicons dashicons-dismiss wp_insert_delete_icon" onclick="wp_insert_adwidgets_remove(\''.$key.'\')"></span>';
					echo '</p>';
				}
			}				
			echo '<p style="text-align: center; padding: 20px 0 10px;"><a id="wp_insert_adwidgets_new" href="#" class="button-secondary">Add New Ad Widget</a></p>';
		echo '</div>';
	echo '</div>';
}
/* End Add Card in Admin Panel */
?>