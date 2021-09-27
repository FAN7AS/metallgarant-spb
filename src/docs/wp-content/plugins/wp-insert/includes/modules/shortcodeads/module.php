<?php
require_once(dirname(__FILE__).'/functions.php');

/* Begin Add Assets */
/*add_action('wp_insert_modules_css', 'wp_insert_module_shortcodeads_css', 0);
function wp_insert_module_shortcodeads_css() {
	wp_register_style('wp-insert-module-shortcodeads-css', WP_INSERT_URL.'includes/modules/shortcodeads/css/module.css', array('wp-insert-css'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_style('wp-insert-module-shortcodeads-css');
}*/

add_action('wp_insert_modules_js', 'wp_insert_module_shortcodeads_js', 0);
function wp_insert_module_shortcodeads_js() {
	wp_register_script('wp-insert-module-shortcodeads-js', WP_INSERT_URL.'includes/modules/shortcodeads/js/module.js', array('wp-insert-js'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_script('wp-insert-module-shortcodeads-js');
}
/* End Add Assets */

/* Begin Add Card in Admin Panel */
add_action('wp_insert_plugin_card', 'wp_insert_shortcodeads_plugin_card', 40);
function wp_insert_shortcodeads_plugin_card() {
	echo '<div class="plugin-card">';
		echo '<div class="plugin-card-top">';
			echo '<h4>Shortcode Ads</h4>';
			echo '<p>Ads embedded directly inside post / page content via shortcodes.</p>';
		echo '</div>';
		echo '<div class="plugin-card-bottom">';
			$shortcodeads = get_option('wp_insert_shortcodeads');
			if(isset($shortcodeads) && is_array($shortcodeads)) {
				foreach($shortcodeads as $key => $value) {
					echo '<p>';
						echo '<a id="wp_insert_shortcodeads_'.$key.'" href="javascript:;" onclick="wp_insert_shortcodeads_click_handler(\''.$key.'\', \''.$value['title'].'\')">Shortcode Ad : '.$value['title'].'</a>';
						echo '<span class="dashicons dashicons-dismiss wp_insert_delete_icon" onclick="wp_insert_shortcodeads_remove(\''.$key.'\')"></span>';
					echo '</p>';
				}
			}				
			echo '<p style="text-align: center; padding: 20px 0 10px;"><a id="wp_insert_shortcodeads_new" href="#" class="button-secondary">Add New Shortcode Ad</a></p>';
		echo '</div>';
	echo '</div>';
}
/* End Add Card in Admin Panel */
?>