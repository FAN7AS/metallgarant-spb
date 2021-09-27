<?php
/* Begin Add New In-Post Ads Content */
add_action('wp_ajax_wp_insert_inpostads_new_form_get_content', 'wp_insert_inpostads_new_form_get_content');
function wp_insert_inpostads_new_form_get_content() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');
	wp_insert_inpostads_form_get_content(uniqid());
	die();
}
/* End Add New In-Post Ads Content */

/* Begin Edit In-Post Ads Content */
add_action('wp_ajax_wp_insert_inpostads_existing_form_get_content', 'wp_insert_inpostads_existing_form_get_content');
function wp_insert_inpostads_existing_form_get_content() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');
	if(isset($_POST['wp_insert_inpostads_identifier'])) {
		wp_insert_inpostads_form_get_content($_POST['wp_insert_inpostads_identifier']);
	}
	die();
}

add_action('wp_ajax_wp_insert_inpostads_existing_form_save_action', 'wp_insert_inpostads_existing_form_save_action');
function wp_insert_inpostads_existing_form_save_action() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');	
	if(isset($_POST['wp_insert_inpostads_identifier'])) {
		wp_insert_inpostads_form_save_action($_POST['wp_insert_inpostads_identifier']);
	}
	die();
}
/* End Edit In-Post Ads Content */

/* Begin Delete In-Post Ads Content */
add_action('wp_ajax_wp_insert_inpostads_remove', 'wp_insert_inpostads_remove');
function wp_insert_inpostads_remove() {
	check_ajax_referer('wp-insert', 'wp_insert_nonce');
	if(isset($_POST['wp_insert_inpostads_identifier'])) {
		$inpostads = get_option('wp_insert_inpostads');
		unset($inpostads[$_POST['wp_insert_inpostads_identifier']]);
		update_option('wp_insert_inpostads', $inpostads);
	}
	die();
}
/* End Delete In-Post Ads Content */

/* Begin Shared UI Functions */
function wp_insert_inpostads_form_get_content($identifier) {
	$inpostads = get_option('wp_insert_inpostads');
	echo '<div class="wp_insert_popup_content_wrapper">';
		$control = new smartlogixControls(array('optionIdentifier' => 'wp_insert_inpostads['.$identifier.']', 'values' => $inpostads[$identifier]));
		$control->add_control(array('type' => 'ipCheckbox', 'className' => 'wp_insert_inpostads_status', 'optionName' => 'status'));
		$control->add_control(array('type' => 'hidden', 'className' => 'wp_insert_inpostads_identifier', 'optionName' => 'identifier', 'value' => $identifier));
		echo $control->HTML;
		$control->clear_controls();
		echo '<div id="wp_insert_inpostads_'.$identifier.'_accordion">';
			echo '<h3>Location</h3>';
			echo '<div>';
				$paragraphPositioningOptions = array(
					array('text' => '1st', 'value' => '1'),
					array('text' => '2nd', 'value' => '2'),
					array('text' => '3rd', 'value' => '3'),
					array('text' => '4th', 'value' => '4'),
					array('text' => '5th', 'value' => '5'),
					array('text' => '6th', 'value' => '6'),
					array('text' => '7th', 'value' => '7'),
					array('text' => '8th', 'value' => '8'),
					array('text' => '9th', 'value' => '9'),
					array('text' => '10th', 'value' => '10'),
				);
				$control->add_control(array('type' => 'select', 'className' => 'input', 'style' => 'display: inline;', 'useParagraph' => false, 'optionName' => 'paragraphtopposition', 'options' => $paragraphPositioningOptions));
				$nthParagraphTopControl = $control->HTML;
				$control->clear_controls();
				$control->add_control(array('type' => 'select', 'className' => 'input', 'style' => 'display: inline;', 'useParagraph' => false, 'optionName' => 'paragraphbottomposition', 'options' => $paragraphPositioningOptions));
				$nthParagraphBottomControl = $control->HTML;
				$control->clear_controls();
				
				if(!isset($inpostads[$identifier]['location'])) {
					switch($identifier) {
						case 'above':
							$inpostads[$identifier]['location'] = 'above';
							break;
						case 'middle':
							$inpostads[$identifier]['location'] = 'middle';
							break;
						case 'below':
							$inpostads[$identifier]['location'] = 'below';
							break;
						case 'left':
							$inpostads[$identifier]['location'] = 'left';
							break;
						case 'right':
							$inpostads[$identifier]['location'] = 'right';
							break;
						default:
							$inpostads[$identifier]['location'] = 'above';
							break;
					}
				}
				$locations = array(
					array('text' => 'Above Post Content', 'value' => 'above'),
					array('text' => 'Middle of Post Content', 'value' => 'middle'),
					array('text' => 'Below Post Content', 'value' => 'below'),
					array('text' => 'To the Left of Post Content', 'value' => 'left'),
					array('text' => 'To the Right of Post Content', 'value' => 'right'),
					array('text' => 'After '.$nthParagraphTopControl.' Paragraph in Post Content (From the Top)', 'value' => 'paragraphtop'),
					array('text' => 'After '.$nthParagraphBottomControl.' Paragraph in Post Content (From the Bottom)', 'value' => 'paragraphbottom'),
				);
				$control->add_control(array('type' => 'radio-group', 'style' => 'line-height: 40px; margin-top: 3px;', 'optionName' => 'location', 'options' => $locations, 'value' => $inpostads[$identifier]['location']));
				$control->create_section('Location');
				echo $control->HTML;
				$control->clear_controls();
			echo '</div>';
			echo '<h3>Ad Code</h3>';
			echo '<div>';
				$abtestingMode = get_option('wp_insert_abtesting_mode');				
				$adTypes = array(
					array('text' => 'Use Generic / Custom Ad Code', 'value' => 'generic'),
					array('text' => 'vi stories', 'value' => 'vicode'),
				);
				$control->add_control(array('type' => 'select', 'label' => 'Ad Type', 'optionName' => 'primary_ad_code_type', 'options' => $adTypes));
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'textarea', 'style' => 'height: 220px;', 'optionName' => 'primary_ad_code'));
				$control->create_section('<span id="primary_ad_code_type_generic" class="isSelectedIndicator"></span><span class="isSelectedIndicatorText">Generic / Custom Ad Code (Primary Network)</span>');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$IsVILoggedin = wp_insert_vi_api_is_loggedin();
				$isJSTagGenerated = ((wp_insert_vi_api_get_vi_code() === false)?false:true);
				$isVIDisabled = false;
				$viMessage = '';
				if(!$IsVILoggedin && !$isJSTagGenerated) {
					$isVIDisabled = true;
					$viMessage = '<p>Introducing <b>vi stories</b> – the video content and advertising player.</p>';
					$viMessage .= '<p>Before you can use <b>vi stories</b>, you must configure it. Once you’ve signed up, in the <i>video intelligence</i> panel, click <i>Sign in</i> then click <i>Configure</i></p>';
				} else if($IsVILoggedin && !$isJSTagGenerated) {
					$isVIDisabled = true;
					$viMessage .= '<p>Before you can use <b>vi stories</b>, you must configure it. In the <i>video intelligence</i> panel, click <i>Configure</i></p>';
					//$viMessage .= '<p><a id="wp_insert_inpostads_vi_customize_adcode" href="javascript:;" class="button button-primary aligncenter">Configure vi Code</a></p>'; /*Button being temporarily removed to avoid confusion for users*/
				} else if(!$IsVILoggedin && $isJSTagGenerated) {
					$isVIDisabled = false;
					$viMessage = '<p>Before you can use <b>vi stories</b>, you must configure it. Once you’ve signed up, in the <i>video intelligence</i> panel, click <i>Sign in</i> then click <i>Configure</i></p>';
				} else {
					$isVIDisabled = false;
					$viMessage = wp_insert_vi_customize_adcode_get_settings();
					$viMessage .= '<p>To configure <b>vi stories</b>, go to the <i>video intelligence</i> panel, click <i>Configure</i></p>';
					//$viMessage .= '<p><a id="wp_insert_inpostads_vi_customize_adcode" href="javascript:;" class="button button-primary aligncenter">Configure vi Code</a></p>'; /*Button being temporarily removed to avoid confusion for users*/
				}
				
				$control->HTML .= $viMessage;
				$control->create_section('<span id="primary_ad_code_type_vicode" class="isSelectedIndicator '.(($isVIDisabled)?'disabled':'').'"></span><span class="isSelectedIndicatorText">vi stories (Primary Network)</span>');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
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
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_home'));
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Instances', 'optionName' => 'rules_home_instances', 'options' => $instances));
				$control->create_section('Home');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_archives'));
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Instances', 'optionName' => 'rules_archives_instances', 'options' => $instances));
				$control->create_section('Archives');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_search'));
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Instances', 'optionName' => 'rules_search_instances', 'options' => $instances));
				$control->create_section('Search Results');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_page'));
				$control->add_control(array('type' => 'pages-chosen-multiselect', 'label' => 'Exceptions', 'optionName' => 'rules_page_exceptions'));
				$control->create_section('Single Pages');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div><div style="clear: both;"></div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_post'));
				$control->add_control(array('type' => 'posts-chosen-multiselect', 'label' => 'Exceptions', 'optionName' => 'rules_post_exceptions'));
				$control->add_control(array('type' => 'categories-chosen-multiselect', 'label' => 'Category Exceptions', 'optionName' => 'rules_post_categories_exceptions'));
				$control->create_section('Single Posts');
				$control->set_HTML('<div class="wp_insert_rule_block">'.$control->HTML.'</div>');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'checkbox-button', 'label' => 'Status : Show Ads', 'checkedLabel' => 'Status : Hide Ads', 'uncheckedLabel' => 'Status : Show Ads', 'optionName' => 'rules_exclude_categories'));
				$control->add_control(array('type' => 'choosen-multiselect', 'label' => 'Instances', 'optionName' => 'rules_categories_instances', 'options' => $instances));
				$control->add_control(array('type' => 'categories-chosen-multiselect', 'label' => 'Exceptions', 'optionName' => 'rules_categories_exceptions'));
				$control->create_section('Category Archives');
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
				if(!isset($inpostads[$identifier]['title']) || ($inpostads[$identifier]['title'] == '')) {
					switch($identifier) {
						case 'above':
							$inpostads[$identifier]['title'] = 'Above Post Content';
							break;
						case 'middle':
							$inpostads[$identifier]['title'] = 'Middle of Post Content';
							break;
						case 'below':
							$inpostads[$identifier]['title'] = 'Below Post Content';
							break;
						case 'left':
							$inpostads[$identifier]['title'] = 'To the Left of Post Content';
							break;
						case 'right':
							$inpostads[$identifier]['title'] = 'To the Right of Post Content';
							break;
						default:
							$inpostads[$identifier]['title'] = $identifier;
							break;
					}
				}
				$control->add_control(array('type' => 'text', 'optionName' => 'title', 'helpText' => 'The title is used to identify your Ad Widget easily in future.  A Random Title will be assigned to your Ad widget by default.', 'value' => $inpostads[$identifier]['title']));
				$control->create_section('Title');
				echo $control->HTML;
				$control->clear_controls();
				
				$control->add_control(array('type' => 'textarea', 'optionName' => 'notes', 'style' => 'height: 220px;'));
				$control->create_section('Notes');
				echo $control->HTML;
				$control->clear_controls();
			echo '</div>';
			echo '<h3 class="wp_insert_inpostads_location_middle_panel">Positioning</h3>';
			echo '<div>';
				$control->add_control(array('type' => 'text', 'label' => 'Minimum Character Count', 'optionName' => 'minimum_character_count', 'helpText' => 'Show the ad only if the Content meets the minimum character count. If this parameter is set to 0 (or empty) minimum character count check will be deactivated.'));
				$control->add_control(array('type' => 'text', 'label' => 'Paragraph Buffer Count', 'optionName' => 'paragraph_buffer_count', 'helpText' => 'Shows the ad after X number of Paragraphs. If this parameter is set to 0 (or empty) the ad will appear in the middle of the content.'));
				$control->create_section('Positioning');
				echo $control->HTML;
				$control->clear_controls();
			echo '</div>';
		echo '</div>';
		echo '<script type="text/javascript">';
			echo $control->JS;
			echo 'jQuery("#wp_insert_inpostads_'.$identifier.'_accordion").accordion({ icons: { header: "ui-icon-circle-arrow-e", activeHeader: "ui-icon-circle-arrow-s" }, heightStyle: "auto" });';
			echo 'wp_insert_inpostads_primary_ad_code_type_change("'.$identifier.'");';
			echo 'wp_insert_inpostads_primary_ad_code_location_change_action("'.$identifier.'");';
			echo 'wp_insert_inpostads_vi_customize_adcode();';
		echo '</script>';
	echo '</div>';
}

function wp_insert_inpostads_form_save_action($identifier) {
	$inpostads = get_option('wp_insert_inpostads');
	$inpostads[$identifier]['identifier'] = ((isset($_POST['wp_insert_inpostads_identifier']))?$_POST['wp_insert_inpostads_identifier']:'');
	$inpostads[$identifier]['status'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_status']) && ($_POST['wp_insert_inpostads_'.$identifier.'_status'] == 'true'))?'1':'');
	
	$inpostads[$identifier]['location'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_location']))?$_POST['wp_insert_inpostads_'.$identifier.'_location']:'');
	$inpostads[$identifier]['paragraphtopposition'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_paragraphtopposition']))?$_POST['wp_insert_inpostads_'.$identifier.'_paragraphtopposition']:'');
	$inpostads[$identifier]['paragraphbottomposition'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_paragraphbottomposition']))?$_POST['wp_insert_inpostads_'.$identifier.'_paragraphbottomposition']:'');
	
	$inpostads[$identifier]['primary_ad_code_type'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_primary_ad_code_type']))?$_POST['wp_insert_inpostads_'.$identifier.'_primary_ad_code_type']:'');
	$inpostads[$identifier]['primary_ad_code'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_primary_ad_code']))?$_POST['wp_insert_inpostads_'.$identifier.'_primary_ad_code']:'');
	$inpostads[$identifier]['secondary_ad_code'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_secondary_ad_code']))?$_POST['wp_insert_inpostads_'.$identifier.'_secondary_ad_code']:'');
	$inpostads[$identifier]['tertiary_ad_code'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_tertiary_ad_code']))?$_POST['wp_insert_inpostads_'.$identifier.'_tertiary_ad_code']:'');
	
	$inpostads[$identifier]['rules_exclude_loggedin'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_loggedin']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_loggedin']:'');
	$inpostads[$identifier]['rules_exclude_mobile_devices'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_mobile_devices']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_mobile_devices']:'');
	$inpostads[$identifier]['rules_exclude_404'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_404']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_404']:'');
	$inpostads[$identifier]['rules_exclude_home'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_home']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_home']:'');
	$inpostads[$identifier]['rules_exclude_archives'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_archives']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_archives']:'');
	$inpostads[$identifier]['rules_exclude_search'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_search']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_search']:'');
	$inpostads[$identifier]['rules_exclude_page'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_page']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_page']:'');
	$inpostads[$identifier]['rules_page_exceptions'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_page_exceptions']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_page_exceptions']:'');
	$inpostads[$identifier]['rules_exclude_post'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_post']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_post']:'');
	$inpostads[$identifier]['rules_post_exceptions'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_post_exceptions']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_post_exceptions']:'');
	$inpostads[$identifier]['rules_post_categories_exceptions'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_post_categories_exceptions']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_post_categories_exceptions']:'');
	$inpostads[$identifier]['rules_exclude_categories'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_categories']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_exclude_categories']:'');
	$inpostads[$identifier]['rules_categories_exceptions'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_rules_categories_exceptions']))?$_POST['wp_insert_inpostads_'.$identifier.'_rules_categories_exceptions']:'');
	
	$inpostads[$identifier]['geo_group1_countries'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_geo_group1_countries']))?$_POST['wp_insert_inpostads_'.$identifier.'_geo_group1_countries']:'');
	$inpostads[$identifier]['geo_group1_adcode'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_geo_group1_adcode']))?$_POST['wp_insert_inpostads_'.$identifier.'_geo_group1_adcode']:'');
	$inpostads[$identifier]['geo_group2_countries'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_geo_group2_countries']))?$_POST['wp_insert_inpostads_'.$identifier.'_geo_group2_countries']:'');
	$inpostads[$identifier]['geo_group2_adcode'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_geo_group2_adcode']))?$_POST['wp_insert_inpostads_'.$identifier.'_geo_group2_adcode']:'');
	
	$inpostads[$identifier]['styles'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_styles']))?$_POST['wp_insert_inpostads_'.$identifier.'_styles']:'');
	
	$inpostads[$identifier]['title'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_title']))?$_POST['wp_insert_inpostads_'.$identifier.'_title']:'');
	$inpostads[$identifier]['notes'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_notes']))?$_POST['wp_insert_inpostads_'.$identifier.'_notes']:'');

	$inpostads[$identifier]['minimum_character_count'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_minimum_character_count']))?$_POST['wp_insert_inpostads_'.$identifier.'_minimum_character_count']:'');
	$inpostads[$identifier]['paragraph_buffer_count'] = ((isset($_POST['wp_insert_inpostads_'.$identifier.'_paragraph_buffer_count']))?$_POST['wp_insert_inpostads_'.$identifier.'_paragraph_buffer_count']:'');
	
	update_option('wp_insert_inpostads', $inpostads);
}
/* End Shared UI Functions */

/* Begin In-Post Ads Ad Insertion */
add_filter('the_content', 'wp_insert_inpostads_the_content', 100);
function wp_insert_inpostads_the_content($content) {
	if(function_exists('is_amp_endpoint') && is_amp_endpoint()) {
		return $content;
	} else if(!is_feed() && is_main_query()) { 
		$inpostads = get_option('wp_insert_inpostads');
		if(isset($inpostads) && is_array($inpostads)) {
			$paragraphCount = wp_insert_inpostads_get_paragraph_count($content);
			foreach($inpostads as $key => $inpostad) {
				if(!isset($inpostad['location'])) { //Get the location value from the key for old users who doesnt have a location saved.
					switch($key) {
						case 'above':
							$inpostad['location'] = 'above';
							break;
						case 'middle':
							$inpostad['location'] = 'middle';
							break;
						case 'below':
							$inpostad['location'] = 'below';
							break;
						case 'left':
							$inpostad['location'] = 'left';
							break;
						case 'right':
							$inpostad['location'] = 'right';
							break;
						default:
							$inpostad['location'] = 'above';
							break;
					}
				}
				
				if(wp_insert_get_ad_status($inpostad)) {
					switch($inpostad['location']) {
						case 'above':							
							$content = '<div class="wpInsert wpInsertInPostAd wpInsertAbove"'.(($inpostad['styles'] != '')?' style="'.$inpostad['styles'].'"':'').'>'.wp_insert_get_geotargeted_adcode($inpostad).'</div>'.$content;
							break;
						case 'middle':
							if($paragraphCount > 1) {
								if(($inpostad['paragraph_buffer_count'] == 0) || ($inpostad['paragraph_buffer_count'] == '')) {
									$position = wp_insert_inpostads_get_insertion_position('/p>', $content, round($paragraphCount / 2));
								} else {			
									$position = wp_insert_inpostads_get_insertion_position('/p>', $content, $inpostad['paragraph_buffer_count']);
								}
								if($position) {
									if(($inpostad['minimum_character_count'] == 0) || ($inpostad['minimum_character_count'] == '')) {
										$content = substr_replace($content, '/p>'.'<div class="wpInsert wpInsertInPostAd wpInsertMiddle"'.(($inpostad['styles'] != '')?' style="'.$inpostad['styles'].'"':'').'>'.wp_insert_get_geotargeted_adcode($inpostad).'</div>', $position, 3);
									} else {
										if(strlen(strip_tags($content)) > $inpostad['minimum_character_count']) {
											$content = substr_replace($content, '/p>'.'<div class="wpInsert wpInsertInPostAd wpInsertMiddle"'.(($inpostad['styles'] != '')?' style="'.$inpostad['styles'].'"':'').'>'.wp_insert_get_geotargeted_adcode($inpostad).'</div>', $position, 3);
										}
									}
								}
							}
							break;
						case 'below':
							$content = $content.'<div class="wpInsert wpInsertInPostAd wpInsertBelow"'.(($inpostad['styles'] != '')?' style="'.$inpostad['styles'].'"':'').'>'.wp_insert_get_geotargeted_adcode($inpostad).'</div>';
							break;
						case 'left':
							$content = '<div class="wpInsert wpInsertInPostAd wpInsertLeft" style="float: left; '.(($inpostad['styles'] != '')?$inpostad['styles']:'').'">'.wp_insert_get_geotargeted_adcode($inpostad).'</div>'.$content;
							break;
						case 'right':
							$content = '<div class="wpInsert wpInsertInPostAd wpInsertRight" style="float: right; '.(($inpostad['styles'] != '')?$inpostad['styles']:'').'">'.wp_insert_get_geotargeted_adcode($inpostad).'</div>'.$content;
							break;
						case 'paragraphtop':
							if($paragraphCount > 1) {
								$position = wp_insert_inpostads_get_insertion_position('/p>', $content, $inpostad['paragraphtopposition']);
								if($position) {
									$content = substr_replace($content, '/p>'.'<div class="wpInsert wpInsertInPostAd wpInsertMiddle"'.(($inpostad['styles'] != '')?' style="'.$inpostad['styles'].'"':'').'>'.wp_insert_get_geotargeted_adcode($inpostad).'</div>', $position, 3);
								}
							}
							break;
						case 'paragraphbottom':
							if($paragraphCount > 1) {
								$paragraphbottomposition = ($paragraphCount - (int)$inpostad['paragraphbottomposition']);
								if(($paragraphbottomposition > 0) && ($paragraphbottomposition < $paragraphCount)) {
									$position = wp_insert_inpostads_get_insertion_position('/p>', $content, $paragraphbottomposition);
									if($position) {
										$content = substr_replace($content, '/p>'.'<div class="wpInsert wpInsertInPostAd wpInsertMiddle"'.(($inpostad['styles'] != '')?' style="'.$inpostad['styles'].'"':'').'>'.wp_insert_get_geotargeted_adcode($inpostad).'</div>', $position, 3);
									}
								}
							}
							break;
					}
				}
			}
		}
	}
	return $content;
}

function wp_insert_inpostads_get_paragraph_count($content) {
	$paragraphs = explode('/p>', $content);
	$paragraphCount = 0;
	if(is_array($paragraphs)) {
		foreach($paragraphs as $paragraph) {
			if(strlen($paragraph) > 1) {
				$paragraphCount++;
			}
		}
	}
	return $paragraphCount;
}

function wp_insert_inpostads_get_insertion_position($search, $string, $offset) {
    $arr = explode($search, $string);
    switch($offset) {
        case $offset == 0:
			return false;
			break;
        case $offset > max(array_keys($arr)):
			return false;
			break;
        default:
			return strlen(implode($search, array_slice($arr, 0, $offset)));
			break;
    }
}
/* End In-Post Ads Ad Insertion */
?>