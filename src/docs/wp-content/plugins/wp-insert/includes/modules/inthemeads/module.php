<?php
require_once(dirname(__FILE__).'/functions.php');

/* Begin Add Assets */
/*add_action('wp_insert_modules_css', 'wp_insert_module_inthemeads_css', 0);
function wp_insert_module_inthemeads_css() {
	wp_register_style('wp-insert-module-inthemeads-css', WP_INSERT_URL.'includes/modules/inthemeads/css/module.css', array('wp-insert-css'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_style('wp-insert-module-inthemeads-css');
}*/

add_action('wp_insert_modules_js', 'wp_insert_module_inthemeads_js', 0);
function wp_insert_module_inthemeads_js() {
	wp_register_script('wp-insert-module-inthemeads-js', WP_INSERT_URL.'includes/modules/inthemeads/js/module.js', array('wp-insert-js'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_script('wp-insert-module-inthemeads-js');
}
/* End Add Assets */

/* Begin Add Card in Admin Panel */
add_action('wp_insert_plugin_card', 'wp_insert_inthemeads_plugin_card', 60);
function wp_insert_inthemeads_plugin_card() {
	echo '<div class="plugin-card">';
		echo '<div class="plugin-card-top">';
			echo '<h4>In-Theme Ads</h4>';
			echo '<p>Ads embedded directly inside theme files (Advanced Users Only).</p>';
		echo '</div>';
		echo '<div class="plugin-card-bottom">';
			$inthemeads = get_option('wp_insert_inthemeads');
			if(isset($inthemeads) && is_array($inthemeads)) {
				foreach($inthemeads as $key => $value) {
					echo '<p>';
						echo '<a id="wp_insert_inthemeads_'.$key.'" href="javascript:;" onclick="wp_insert_inthemeads_click_handler(\''.$key.'\', \''.$value['title'].'\')">In-Theme Ad : '.$value['title'].'</a>';
						echo '<span class="dashicons dashicons-dismiss wp_insert_delete_icon" onclick="wp_insert_inthemeads_remove(\''.$key.'\')"></span>';
					echo '</p>';
				}
			}				
			echo '<p style="text-align: center; padding: 20px 0 10px;"><a id="wp_insert_inthemeads_new" href="#" class="button-secondary">Add New In-Theme Ad</a></p>';
		echo '</div>';
	echo '</div>';
}
/* End Add Card in Admin Panel */
?>