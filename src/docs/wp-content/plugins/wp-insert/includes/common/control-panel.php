<?php 
add_action('admin_menu', 'wp_insert_admin_menu');
function wp_insert_admin_menu() {
	add_menu_page('Wp Insert', 'Wp Insert', 'manage_options', 'wp-insert', 'wp_insert_admin_page', WP_INSERT_URL.'/includes/assets/images/icon.png');
}

add_action('admin_enqueue_scripts', 'wp_insert_admin_enqueue_scripts');
function wp_insert_admin_enqueue_scripts($page) {
	wp_register_script('wp-insert-global-js', WP_INSERT_URL.'includes/assets/js/wp-insert-global.js', array('jquery'), WP_INSERT_VERSION);
	wp_enqueue_script('wp-insert-global-js');
	if($page == 'toplevel_page_wp-insert') {
		wp_register_style('wp-insert-css', WP_INSERT_URL.'includes/assets/css/wp-insert.css', array(), WP_INSERT_VERSION.rand(0,9999));
		wp_enqueue_style('wp-insert-css');
		wp_register_style('wp-insert-jquery-ui', 'https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css', array(), WP_INSERT_VERSION);
		wp_enqueue_style('wp-insert-jquery-ui');
		wp_register_script('wp-insert-js', WP_INSERT_URL.'includes/assets/js/wp-insert.js', array('jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'jquery-ui-dialog'), WP_INSERT_VERSION.rand(0,9999));
		wp_enqueue_script('wp-insert-js');
		wp_register_script('chart-js', WP_INSERT_URL.'includes/assets/js/Chart.bundle.min.js', array('jquery'), WP_INSERT_VERSION);
		wp_enqueue_script('chart-js');
		do_action('wp_insert_modules_css');
		do_action('wp_insert_modules_js');
		smartlogixControls::enqueue_assets(WP_INSERT_URL.'includes/controls', WP_INSERT_VERSION);
		wp_enqueue_script('editor');
        wp_enqueue_script('quicktags');
		wp_enqueue_style('buttons');
	}
}

function wp_insert_admin_page() { ?>
    <div class="wrap wp-insert">
		<h2 id="wp_insert_title" style="display: none;"></h2>
		<div class="wp-list-table widefat plugin-install">
			<?php do_action('wp_insert_plugin_card'); ?>			
			<input type="hidden" id="wp_insert_admin_ajax" name="wp_insert_admin_ajax" value="<?php echo admin_url('admin-ajax.php'); ?>" />
			<input type="hidden" id="wp_insert_nonce" name="wp_insert_nonce" value="<?php echo wp_create_nonce('wp-insert'); ?>" />
		</div>
	</div>
<?php
}

/* Begin Add Card in Admin Panel */
add_action('wp_insert_plugin_card', 'wp_insert_title_plugin_card', 0);
function wp_insert_title_plugin_card() {
	echo '<div class="plugin-card">';
		echo '<div class="plugin-card-top">';
			echo '<a id="wpInsertLogo" href="http://www.wp-insert.smartlogix.co.in"><img src="'.WP_INSERT_URL.'/includes/assets/images/header-banner.png?'.WP_INSERT_VERSION.'" /></a>';
		echo '</div>';
		echo '<div class="plugin-card-bottom">';
			echo '<div id="wpInsertMeta">';
				echo '<p><b>Donate :</b><br /><a target="_blank" href="http://wpinsert.smartlogix.co.in/support/">Click Here</a> to Donate and Promote further development of this plugin.</p>';
				echo '<p><b>Like Us :</b><br /><a target="_blank" href="https://www.facebook.com/SmartLogix/">Click here</a> to like and support us on Facebook</p>';
				echo '<p><b>Rate and Review :</b><br />If you find this plugin useful do leave a honest <a target="_blank" href="http://wordpress.org/plugins/wp-insert">RATING</a> and <a target="_blank" href="https://wordpress.org/support/view/plugin-reviews/wp-insert#postform">REVIEW</a><br /><span style="font-size: 15px; font-weight: 600;">You spending a few minutes to let us know your appreciation for the project will motivate us further in improving the plugin and adding new features.</span></p>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}
/* End Add Card in Admin Panel */

/* Begin Admin Notice */
add_action('admin_notices', 'wp_insert_admin_notices');
function wp_insert_admin_notices() {	
	if(current_user_can('manage_options')) {
		$userId = get_current_user_id();
		if(!get_user_meta($userId, 'wp_insert_'.WP_INSERT_VERSION.'_admin_notice_dismissed', true)) {
			echo '<div class="notice notice-success wp_insert_notice is-dismissible" style="padding: 15px;">';
				echo '<div style="float: left; max-width: 875px; font-size: 14px; font-family: Arial; line-height: 18px; color: #232323;">';
					echo '<p>Thank you for updating <b>Wp-Insert</b>.</p>';
					echo '<p>This update features <b>vi stories</b> from <a href="https://www.vi.ai/">video intelligence</a> - a video player that supplies both content and video advertising. Watch a <a href="http://demo.vi.ai/ViewsterBlog_Nintendo.html">demo</a>.</p>';
					echo '<p>Read the <a href="https://www.vi.ai/frequently-asked-questions-vi-stories-for-wordpress/?utm_source=WordPress&utm_medium=Plugin%20FAQ&utm_campaign=WP%20Insert">FAQ</a>.</p>';
				echo '</div>';
				echo '<img style="float: right; margin-right: 20px; margin-top: 13px;" src="'.WP_INSERT_URL.'includes/assets/images/vi-big-logo.png?'.WP_INSERT_VERSION.'" />';
				echo '<div class="clear"></div>';
				echo '<input type="hidden" id="wp_insert_admin_notice_nonce" name="wp_insert_admin_notice_nonce" value="'.wp_create_nonce('wp-insert-admin-notice').'" />';
				echo '<input type="hidden" id="wp_insert_admin_notice_ajax" name="wp_insert_admin_notice_ajax" value="'.admin_url('admin-ajax.php').'" />';
			echo '</div>';
		}
	}
}

add_action('wp_ajax_wp_insert_admin_notice_dismiss', 'wp_insert_admin_notice_dismiss');
function wp_insert_admin_notice_dismiss() {
	check_ajax_referer('wp-insert-admin-notice', 'wp_insert_admin_notice_nonce');	
	$userId = get_current_user_id();
	update_user_meta($userId, 'wp_insert_'.WP_INSERT_VERSION.'_admin_notice_dismissed', 'true');
	die();
}
/* End Admin Notice */
?>