<?php
require_once(dirname(__FILE__).'/functions.php');

/* Begin Add Assets */
/*add_action('wp_insert_modules_css', 'wp_insert_module_adstxt_css', 0);
function wp_insert_module_adstxt_css() {
	wp_register_style('wp-insert-module-adstxt-css', WP_INSERT_URL.'includes/modules/adstxt/css/module.css', array('wp-insert-css'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_style('wp-insert-module-adstxt-css');
}*/

add_action('wp_insert_modules_js', 'wp_insert_module_adstxt_js', 0);
function wp_insert_module_adstxt_js() {
	wp_register_script('wp-insert-module-adstxt-js', WP_INSERT_URL.'includes/modules/adstxt/js/module.js', array('wp-insert-js'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_script('wp-insert-module-adstxt-js');
}
/* End Add Assets */

/* Begin Add Card in Admin Panel */
add_action('wp_insert_plugin_card', 'wp_insert_adstxt_plugin_card', 100);
function wp_insert_adstxt_plugin_card() {
	echo '<div class="plugin-card adstxt-card">';
		echo '<div class="plugin-card-top">';
			echo '<h4>Authorized Digital Sellers / ads.txt</h4>';
			echo '<p>Authorized Digital Sellers, or ads.txt, is an <a href="https://iabtechlab.com/">IAB</a> initiative to improve transparency in programmatic advertising.</p>';
			echo '<p>You can easily manage your ads.txt from within Wp-Insert, providing confidence to brands they are buying authentic publisher inventory, protect you from counterfiet inventory and might even lead to higher monetization for your ad invertory.</p>';
		echo '</div>';
		echo '<div class="plugin-card-bottom">';
			if(wp_insert_adstxt_file_exists()) {
				echo '<a id="wp_insert_adstxt_generate" href="javascript:;" class="button button-primary">Modify ads.txt</a>';
			} else {
				echo '<a id="wp_insert_adstxt_generate" href="javascript:;" class="button button-primary">Generate ads.txt</a>';
			}
		echo '</div>';
	echo '</div>';
}
/* End Add Card in Admin Panel */
?>