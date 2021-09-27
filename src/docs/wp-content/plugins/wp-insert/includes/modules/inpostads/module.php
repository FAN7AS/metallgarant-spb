<?php
require_once(dirname(__FILE__).'/functions.php');

/* Begin Add Assets */
/*add_action('wp_insert_modules_css', 'wp_insert_module_inpostads_css', 0);
function wp_insert_module_inpostads_css() {
	wp_register_style('wp-insert-module-inpostads-css', WP_INSERT_URL.'includes/modules/inpostads/css/module.css', array('wp-insert-css'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_style('wp-insert-module-inpostads-css');
}*/

add_action('wp_insert_modules_js', 'wp_insert_module_inpostads_js', 0);
function wp_insert_module_inpostads_js() {
	wp_register_script('wp-insert-module-inpostads-js', WP_INSERT_URL.'includes/modules/inpostads/js/module.js', array('wp-insert-js'), WP_INSERT_VERSION.((WP_INSERT_DEBUG)?rand(0,9999):''));
	wp_enqueue_script('wp-insert-module-inpostads-js');
}
/* End Add Assets */

/* Begin Add Card in Admin Panel */
add_action('wp_insert_plugin_card', 'wp_insert_inpostads_plugin_card', 20);
function wp_insert_inpostads_plugin_card() {
	echo '<div class="plugin-card">';
		echo '<div class="plugin-card-top">';
			echo '<h4>In-Post Ads</h4>';
			echo '<p>Ads shown within the post content.<br />You can choose different locations to insert ads from Above /  Below / Inside / Middle Of / To the Left / To the Right of post content</p>';
		echo '</div>';
		echo '<div class="plugin-card-bottom">';
			$inpostads = get_option('wp_insert_inpostads');
			if(isset($inpostads) && is_array($inpostads)) {
				foreach($inpostads as $key => $value) {
					echo '<p>';
						if(!isset($value['title']) || ($value['title'] == '')) {
							switch($key) {
								case 'above':
									$value['title'] = 'Above Post Content';
									break;
								case 'middle':
									$value['title'] = 'Middle of Post Content';
									break;
								case 'below':
									$value['title'] = 'Below Post Content';
									break;
								case 'left':
									$value['title'] = 'To the Left of Post Content';
									break;
								case 'right':
									$value['title'] = 'To the Right of Post Content';
									break;
							}
						}
						echo '<a id="wp_insert_inpostads_'.$key.'" href="javascript:;" onclick="wp_insert_inpostads_click_handler(\''.$key.'\', \''.$value['title'].'\')">In-Post Ad : '.$value['title'].'</a>';
						echo '<span class="dashicons dashicons-dismiss wp_insert_delete_icon" onclick="wp_insert_inpostads_remove(\''.$key.'\')"></span>';
					echo '</p>';
				}
			}				
			echo '<p style="text-align: center; padding: 20px 0 10px;"><a id="wp_insert_inpostads_new" href="#" class="button-secondary">Add New In-Post Ad</a></p>';
		echo '</div>';
	echo '</div>';
}
/* End Add Card in Admin Panel */
?>