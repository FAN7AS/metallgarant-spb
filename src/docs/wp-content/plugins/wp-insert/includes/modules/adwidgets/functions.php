<?php 
/* Begin Add New Adwidget Content */
add_action('wp_ajax_wp_insert_adwidgets_new_form_get_content', 'wp_insert_adwidgets_new_form_get_content');
function wp_insert_adwidgets_new_form_get_content() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');
	wp_insert_adwidgets_form_get_content(uniqid());
	die();
}
/* End Add New Adwidget Content */

/* Begin Edit Adwidget Content */
add_action('wp_ajax_wp_insert_adwidgets_existing_form_get_content', 'wp_insert_adwidgets_existing_form_get_content');
function wp_insert_adwidgets_existing_form_get_content() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');
	if(isset($_POST['wp_insert_adwidgets_identifier'])) {
		wp_insert_adwidgets_form_get_content($_POST['wp_insert_adwidgets_identifier']);
	}
	die();
}

add_action('wp_ajax_wp_insert_adwidgets_existing_form_save_action', 'wp_insert_adwidgets_existing_form_save_action');
function wp_insert_adwidgets_existing_form_save_action() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');	
	if(isset($_POST['wp_insert_adwidgets_identifier'])) {
		wp_insert_adwidgets_form_save_action($_POST['wp_insert_adwidgets_identifier']);
	}
	die();
}
/* End Edit Adwidget Content */

/* Begin Delete Adwidget Content */
add_action('wp_ajax_wp_insert_adwidgets_remove', 'wp_insert_adwidgets_remove');
function wp_insert_adwidgets_remove() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');
	if(isset($_POST['wp_insert_adwidgets_identifier'])) {
		$adwidgets = get_option('wp_insert_adwidgets');
		unset($adwidgets[$_POST['wp_insert_adwidgets_identifier']]);
		update_option('wp_insert_adwidgets', $adwidgets);
	}
	die();
}
/* End Delete Adwidget Content */

/* Begin Shared UI Functions */
function wp_insert_adwidgets_form_get_content($identifier) {
	$adwidgets = get_option('wp_insert_adwidgets');
	echo '<div class="wp_insert_popup_content_wrapper">';
		$control = new smartlogixControls(array('optionIdentifier' => 'wp_insert_adwidgets['.$identifier.']', 'values' => $adwidgets[$identifier]));
		$control->add_control(array('type' => 'ipCheckbox', 'className' => 'wp_insert_adwidgets_status', 'optionName' => 'status'));
		$control->add_control(array('type' => 'hidden', 'className' => 'wp_insert_adwidgets_identifier', 'optionName' => 'identifier', 'value' => $identifier));
		echo $control->HTML;
		$control->clear_controls();
		echo '<div id="wp_insert_adwidgets_'.$identifier.'_accordion">';
			echo '<h3>Ad Code</h3>';
			echo '<div>';
				$abtestingMode = get_option('wp_insert_abtesting_mode');
				$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'primary_ad_code'));
				$control->create_section('Ad Code (Primary Network)');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'secondary_ad_code'));
				$control->create_section('Ad Code (Secondary Network)');
				if($abtestingMode != '2' && $abtestingMode != '3') {	
					$control->set_HTML('<div style="display: none;">'.$control->HTML.'</div>');
				}
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'tertiary_ad_code'));
				$control->create_section('Ad Code (Tertiary Network)');
				if($abtestingMode != '3') {	
					$control->set_HTML('<div style="display: none;">'.$control->HTML.'</div>');
				}
				echo $control->HTML;
				$control->clear_controls();
			echo '</div>';
			echo '<h3>Rules</h3>';
			echo '<div>';
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_loggedin'));
				$control->create_section('Logged in Users');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_mobile_devices'));
				$control->create_section('Mobile Devices');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_404'));
				$control->create_section('404 Pages');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_home'));
				$control->create_section('Home');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_archives'));
				$control->create_section('Archives');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_search'));
				$control->create_section('Search Results');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_page'));
				$control->add_control(array('type' => 'pages-chosen-multiselect', 'label' => 'Exceptions', 'optionName' => 'rules_page_exceptions'));
				$control->create_section('Single Pages');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_categories'));
				$control->add_control(array('type' => 'categories-chosen-multiselect', 'label' => 'Exceptions', 'optionName' => 'rules_categories_exceptions'));
				$control->create_section('Category Archives');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();				
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_post'));
				$control->add_control(array('type' => 'posts-chosen-multiselect', 'label' => 'Exceptions', 'optionName' => 'rules_post_exceptions'));
				$control->add_control(array('type' => 'categories-chosen-multiselect', 'label' => 'Category Exceptions', 'optionName' => 'rules_post_categories_exceptions'));
				$control->create_section('Single Posts');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				
			echo '</div>';
			echo '<h3>Geo Targeting</h3>';
			echo '<div>';
				echo '<p>';
					echo 'A Geo Targeted Ads have a higher priority than Ads configured via Multiple Ad Networks / A-B Testing.<br />';
					echo 'If a Geo Targeting match is found all other Ads (Primary, Secondary and Tertiary Networks) will be ignored.';
				echo '</p>';
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Countries', 'optionName' => 'geo_group1_countries', 'options' => wp_insert_get_countries()));
				$control->add_control(array('type' => 'textarea', 'label' => 'Ad Code', 'style' => 'height: 220px;', 'optionName' => 'geo_group1_adcode'));
				$control->create_section('Group 1');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Countries', 'optionName' => 'geo_group2_countries', 'options' => wp_insert_get_countries()));
				$control->add_control(array('type' => 'textarea', 'label' => 'Ad Code', 'style' => 'height: 220px;', 'optionName' => 'geo_group2_adcode'));
				$control->create_section('Group 2');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				echo '<p>';
					echo 'This feature uses the Free Geo ip service from <a href="http://freegeoip.net/">freegeoip.net</a>, if you find this feature useful please consider donating to the project at <a href="http://freegeoip.net/">freegeoip.net</a>';
				echo '</p>';
			echo '</div>';
			echo '<h3>Styles</h3>';
			echo '<div>';
				$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'styles'));
				$control->create_section('Styles');
				echo $control->HTML;
				$control->clear_controls();
			echo '</div>';
			echo '<h3>Notes</h3>';
			echo '<div>';
				$control->add_control(array('type' => 'text', 'optionName' => 'title', 'helpText' => 'The title is used to identify your Ad Widget easily in future.  A Random Title will be assigned to your Ad widget by default.', 'value' => ((isset($adwidgets[$identifier]['title']))?$adwidgets[$identifier]['title']:$identifier)));
				$control->create_section('Title');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'notes'));
				$control->create_section('Notes');
				echo $control->HTML;
				$control->clear_controls();
			echo '</div>';
		echo '</div>';
		echo '<script type="text/javascript">';
			echo $control->JS;
			echo 'jQuery("#wp_insert_adwidgets_'.$identifier.'_accordion").accordion({ icons: { header: "ui-icon-circle-arrow-e", activeHeader: "ui-icon-circle-arrow-s" }, heightStyle: "auto" });';
		echo '</script>';
	echo '</div>';
}

function wp_insert_adwidgets_form_save_action($identifier) {
	$adwidgets = get_option('wp_insert_adwidgets');
	$adwidgets[$identifier]['identifier'] = ((isset($_POST['wp_insert_adwidgets_identifier']))?$_POST['wp_insert_adwidgets_identifier']:'');
	$adwidgets[$identifier]['status'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_status']) && ($_POST['wp_insert_adwidgets_'.$identifier.'_status'] == 'true'))?'1':'');
	
	$adwidgets[$identifier]['primary_ad_code'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_primary_ad_code']))?$_POST['wp_insert_adwidgets_'.$identifier.'_primary_ad_code']:'');
	$adwidgets[$identifier]['secondary_ad_code'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_secondary_ad_code']))?$_POST['wp_insert_adwidgets_'.$identifier.'_secondary_ad_code']:'');
	$adwidgets[$identifier]['tertiary_ad_code'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_tertiary_ad_code']))?$_POST['wp_insert_adwidgets_'.$identifier.'_tertiary_ad_code']:'');
	
	$adwidgets[$identifier]['rules_exclude_loggedin'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_loggedin']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_loggedin']:'');
	$adwidgets[$identifier]['rules_exclude_mobile_devices'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_mobile_devices']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_mobile_devices']:'');
	$adwidgets[$identifier]['rules_exclude_404'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_404']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_404']:'');
	$adwidgets[$identifier]['rules_exclude_home'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_home']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_home']:'');
	$adwidgets[$identifier]['rules_exclude_archives'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_archives']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_archives']:'');
	$adwidgets[$identifier]['rules_exclude_search'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_search']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_search']:'');
	$adwidgets[$identifier]['rules_exclude_page'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_page']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_page']:'');
	$adwidgets[$identifier]['rules_page_exceptions'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_page_exceptions']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_page_exceptions']:'');
	$adwidgets[$identifier]['rules_exclude_post'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_post']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_post']:'');
	$adwidgets[$identifier]['rules_post_exceptions'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_post_exceptions']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_post_exceptions']:'');
	$adwidgets[$identifier]['rules_post_categories_exceptions'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_post_categories_exceptions']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_post_categories_exceptions']:'');
	$adwidgets[$identifier]['rules_exclude_categories'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_categories']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_exclude_categories']:'');
	$adwidgets[$identifier]['rules_categories_exceptions'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_rules_categories_exceptions']))?$_POST['wp_insert_adwidgets_'.$identifier.'_rules_categories_exceptions']:'');
	
	$adwidgets[$identifier]['geo_group1_countries'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_geo_group1_countries']))?$_POST['wp_insert_adwidgets_'.$identifier.'_geo_group1_countries']:'');
	$adwidgets[$identifier]['geo_group1_adcode'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_geo_group1_adcode']))?$_POST['wp_insert_adwidgets_'.$identifier.'_geo_group1_adcode']:'');
	$adwidgets[$identifier]['geo_group2_countries'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_geo_group2_countries']))?$_POST['wp_insert_adwidgets_'.$identifier.'_geo_group2_countries']:'');
	$adwidgets[$identifier]['geo_group2_adcode'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_geo_group2_adcode']))?$_POST['wp_insert_adwidgets_'.$identifier.'_geo_group2_adcode']:'');
	
	$adwidgets[$identifier]['styles'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_styles']))?$_POST['wp_insert_adwidgets_'.$identifier.'_styles']:'');
	
	$adwidgets[$identifier]['title'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_title']))?$_POST['wp_insert_adwidgets_'.$identifier.'_title']:'');
	$adwidgets[$identifier]['notes'] = ((isset($_POST['wp_insert_adwidgets_'.$identifier.'_notes']))?$_POST['wp_insert_adwidgets_'.$identifier.'_notes']:'');
	update_option('wp_insert_adwidgets', $adwidgets);
}
/* End Shared UI Functions */

/* Begin Ad Widget Insertion */
add_action('widgets_init', create_function('', 'register_widget("wpInsertAdWidget");'));
class wpInsertAdWidget extends WP_Widget {
	public function __construct() {
		parent::__construct('wp_insert_ad_widget', 'Wp-Insert Ad Widget', array('description' => 'Wp-Insert Ad Widget'));
	}

	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$adwidgets = get_option('wp_insert_adwidgets');
		if(wp_insert_get_ad_status($adwidgets[$instance['instance']])) {
			echo $before_widget;
			if(!empty($title)) { echo $before_title.$title.$after_title; }			
			echo '<div class="wpInsert wpInsertAdWidget"'.(($adwidgets[$instance['instance']]['styles'] != '')?' style="'.$adwidgets[$instance['instance']]['styles'].'"':'').'>'.wp_insert_get_geotargeted_adcode($adwidgets[$instance['instance']]).'</div>';
			echo $after_widget;
		}
	}

	public function update($new_opts, $old_opts) {
		$opts = array();
		$opts['title'] = $new_opts['title'];
		$opts['instance'] = $new_opts['instance'];
		return $opts;
	}

	public function form($instance) {
		$adwidgets = get_option('wp_insert_adwidgets');
		echo '<p>';
			echo '<label for="'.$this->get_field_id('title').'">Title:</label>';
			echo '<input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$instance['title'].'" />';
		echo '</p>';
		echo '<p>';
			if(is_array($adwidgets) && (count($adwidgets) > 0)) {
				echo '<label for="'.$this->get_field_id('instance').'">Select Ad-Widget:</label>';
				echo '<select class="widefat" id="'.$this->get_field_id('instance').'" name="'.$this->get_field_name('instance').'">';
					foreach($adwidgets as $adwidget) {
						echo '<option value="'.$adwidget['identifier'].'" '.selected($adwidget['identifier'], $instance['instance'], false).'>Ad Widget : '.$adwidget['title'].'</option>';
					}
				echo '</select>';
			} else {
				echo 'Please <a href="'.admin_url('admin.php?page=wp-insert').'">Configure an Ad-Widget</a> to Proceed.';
				echo '<input class="widefat" id="'.$this->get_field_id('instance').'" name="'.$this->get_field_name('instance').'" type="hidden" value="" />';
			}
		echo '</p>';
	}
}
/* End Ad Widget Insertion */
?>