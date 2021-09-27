jQuery(document).ready(function() {
	wp_insert_click_handler(
		'wp_insert_inpostads_new',
		'In-Post Ad : Add New',
		jQuery("body").width() * 0.8,
		jQuery("body").height() * 0.8,
		function() {
			jQuery('.wp_insert_inpostads_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
		},
		function() {
			var identifier = jQuery(".wp_insert_inpostads_identifier").val();
			var inpostadLink = jQuery("<a></a>");
			inpostadLink.attr("id", "wp_insert_inpostads_"+identifier);
			inpostadLink.attr("href", "javascript:;");
			inpostadLink.attr("onClick", "wp_insert_inpostads_click_handler(\'"+identifier+"\', \'"+jQuery("#wp_insert_inpostads_"+identifier+"_title").val()+"\')");
			inpostadLink.html("In-Post Ad : "+jQuery("#wp_insert_inpostads_"+identifier+"_title").val());
			var deleteButton = jQuery("<span></span>");
			deleteButton.attr("class", "dashicons dashicons-dismiss wp_insert_delete_icon");
			deleteButton.attr("onClick", "wp_insert_inpostads_remove(\'"+identifier+"\')");
			jQuery("#wp_insert_inpostads_new").parent().before(jQuery("<p></p>").append(inpostadLink, deleteButton));
			wp_insert_inpostads_update(identifier);
		},
		function() { }
	);
});

function wp_insert_inpostads_click_handler(identifier, title) {
	jQuery('<div id="wp_insert_inpostads_'+identifier+'_dialog"></div>').html('<div class="wp_insert_ajaxloader"></div>').dialog({
		'modal': true,
		'resizable': false,
		'width': jQuery("body").width() * 0.8,
		'maxWidth': jQuery("body").width() * 0.8,
		'maxHeight': jQuery("body").height() * 0.9,
		'title': 'In-Post Ad : '+title,
		position: { my: 'center', at: 'center', of: window },
		open: function (event, ui) {
			jQuery('.ui-dialog').css({'z-index': 999999, 'max-width': '90%'});
			jQuery('.ui-widget-overlay').css({'z-index': 999998, 'opacity': 0.8, 'background': '#000000'});
			jQuery('.ui-dialog-buttonpane button:contains("Update")').button('disable');
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': 'wp_insert_inpostads_existing_form_get_content',
					'wp_insert_inpostads_identifier': identifier,
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val()
				}, function(response) {
					jQuery('.wp_insert_ajaxloader').hide();
					jQuery('.ui-dialog-content').html(response);
					jQuery('.ui-accordion .ui-accordion-content').css('max-height', (jQuery("body").height() * 0.45));
					jQuery('.ui-dialog-buttonpane button:contains("Update")').button('enable');
					jQuery('.wp_insert_inpostads_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
					jQuery('.ui-dialog').css({'position': 'fixed'});
					jQuery('#wp_insert_inpostads_'+identifier+'_dialog').delay(500).dialog({position: { my: 'center', at: 'center', of: window }});
				}			
			);
		},
		buttons: {
			'Update': function() {
				jQuery("#wp_insert_inpostads_"+identifier).html("In-Post Ad : "+jQuery("#wp_insert_inpostads_"+identifier+"_title").val());
				jQuery("#wp_insert_inpostads_"+identifier).attr("onClick", "wp_insert_inpostads_click_handler(\'"+identifier+"\', \'"+jQuery("#wp_insert_inpostads_"+identifier+"_title").val()+"\')");
				wp_insert_inpostads_update(identifier);
				jQuery(this).dialog('close');
			},
			Cancel: function() {
				jQuery(this).dialog('close');
			}
		},
		close: function() {
			jQuery(this).dialog('destroy');
		}
	});
}

function wp_insert_inpostads_update(identifier) {
	args = {};
	args['action'] = 'wp_insert_inpostads_existing_form_save_action';
	args['wp_insert_nonce'] = jQuery('#wp_insert_nonce').val();
	args['wp_insert_inpostads_identifier'] = identifier;
	args['wp_insert_inpostads_'+identifier+'_status'] = jQuery('#wp_insert_inpostads_'+identifier+'_status').prop('checked');
	
	args['wp_insert_inpostads_'+identifier+'_location'] = jQuery('input[name="wp_insert_inpostads['+identifier+'][location]"]:checked').val();
	args['wp_insert_inpostads_'+identifier+'_paragraphtopposition'] = jQuery('#wp_insert_inpostads_'+identifier+'_paragraphtopposition').val();
	args['wp_insert_inpostads_'+identifier+'_paragraphbottomposition'] = jQuery('#wp_insert_inpostads_'+identifier+'_paragraphbottomposition').val();
	
	args['wp_insert_inpostads_'+identifier+'_primary_ad_code_type'] = jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').val();
	args['wp_insert_inpostads_'+identifier+'_primary_ad_code'] = jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code').val();
	args['wp_insert_inpostads_'+identifier+'_secondary_ad_code'] = jQuery('#wp_insert_inpostads_'+identifier+'_secondary_ad_code').val();
	args['wp_insert_inpostads_'+identifier+'_tertiary_ad_code'] = jQuery('#wp_insert_inpostads_'+identifier+'_tertiary_ad_code').val();
	
	args['wp_insert_inpostads_'+identifier+'_rules_exclude_loggedin'] = jQuery('#wp_insert_inpostads_'+identifier+'_rules_exclude_loggedin').prop('checked');
	args['wp_insert_inpostads_'+identifier+'_rules_exclude_mobile_devices'] = jQuery('#wp_insert_inpostads_'+identifier+'_rules_exclude_mobile_devices').prop('checked');
	args['wp_insert_inpostads_'+identifier+'_rules_exclude_404'] = jQuery('#wp_insert_inpostads_'+identifier+'_rules_exclude_404').prop('checked');
	args['wp_insert_inpostads_'+identifier+'_rules_exclude_home'] = jQuery('#wp_insert_inpostads_'+identifier+'_rules_exclude_home').prop('checked');
	args['wp_insert_inpostads_'+identifier+'_rules_exclude_archives'] = jQuery('#wp_insert_inpostads_'+identifier+'_rules_exclude_archives').prop('checked');
	args['wp_insert_inpostads_'+identifier+'_rules_exclude_search'] = jQuery('#wp_insert_inpostads_'+identifier+'_rules_exclude_search').prop('checked');
	args['wp_insert_inpostads_'+identifier+'_rules_exclude_page'] = jQuery('#wp_insert_inpostads_'+identifier+'_rules_exclude_page').prop('checked');
	args['wp_insert_inpostads_'+identifier+'_rules_page_exceptions'] = jQuery.map(jQuery('#wp_insert_inpostads_'+identifier+'_rules_page_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_inpostads_'+identifier+'_rules_exclude_post'] = jQuery('#wp_insert_inpostads_'+identifier+'_rules_exclude_post').prop('checked');
	args['wp_insert_inpostads_'+identifier+'_rules_post_exceptions'] = jQuery.map(jQuery('#wp_insert_inpostads_'+identifier+'_rules_post_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_inpostads_'+identifier+'_rules_post_categories_exceptions'] = jQuery.map(jQuery('#wp_insert_inpostads_'+identifier+'_rules_post_categories_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_inpostads_'+identifier+'_rules_exclude_categories'] = jQuery('#wp_insert_inpostads_'+identifier+'_rules_exclude_categories').prop('checked');
	args['wp_insert_inpostads_'+identifier+'_rules_categories_exceptions'] = jQuery.map(jQuery('#wp_insert_inpostads_'+identifier+'_rules_categories_exceptions :selected'), function(e) { return jQuery(e).val(); });
	
	args['wp_insert_inpostads_'+identifier+'_geo_group1_countries'] = jQuery.map(jQuery('#wp_insert_inpostads_'+identifier+'_geo_group1_countries :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_inpostads_'+identifier+'_geo_group1_adcode'] = jQuery('#wp_insert_inpostads_'+identifier+'_geo_group1_adcode').val();
	args['wp_insert_inpostads_'+identifier+'_geo_group2_countries'] = jQuery.map(jQuery('#wp_insert_inpostads_'+identifier+'_geo_group2_countries :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_inpostads_'+identifier+'_geo_group2_adcode'] = jQuery('#wp_insert_inpostads_'+identifier+'_geo_group2_adcode').val();
	
	args['wp_insert_inpostads_'+identifier+'_title'] = jQuery('#wp_insert_inpostads_'+identifier+'_title').val();
	args['wp_insert_inpostads_'+identifier+'_styles'] = jQuery('#wp_insert_inpostads_'+identifier+'_styles').val();
	
	args['wp_insert_inpostads_'+identifier+'_notes'] = jQuery('#wp_insert_inpostads_'+identifier+'_notes').val();

	args['wp_insert_inpostads_'+identifier+'_minimum_character_count'] = jQuery('#wp_insert_inpostads_'+identifier+'_minimum_character_count').val();
	args['wp_insert_inpostads_'+identifier+'_paragraph_buffer_count'] = jQuery('#wp_insert_inpostads_'+identifier+'_paragraph_buffer_count').val();

	jQuery.post(
		jQuery('#wp_insert_admin_ajax').val(), args, function(response) { }
	);
}

function wp_insert_inpostads_remove(identifier) {
	jQuery("<p>Are you Sure you want to remove this Ad Unit?</p>").dialog({
		'modal': true,
		'resizable': false,
		'title': 'Deletion Confirmation',
		position: { my: 'center', at: 'center', of: window },
		open: function (event, ui) {
			jQuery('.ui-dialog').css({'z-index': 999999, 'max-width': '90%'});
			jQuery('.ui-widget-overlay').css({'z-index': 999998, 'opacity': 0.8, 'background': '#000000'});
		},
		buttons : {
			'Confirm': function() {
				jQuery("#wp_insert_inpostads_"+identifier).parent().remove();
				jQuery.post(
					jQuery('#wp_insert_admin_ajax').val(), {
						'action': 'wp_insert_inpostads_remove',
						'wp_insert_inpostads_identifier': identifier,
						'wp_insert_nonce': jQuery('#wp_insert_nonce').val()
					}, function(response) {
					}			
				);
				jQuery(this).dialog("close");
			},
			'Cancel': function() {
				jQuery(this).dialog("close");
			}
		},
		close: function() {
			jQuery(this).dialog('destroy');
		}
	});
}

function wp_insert_inpostads_primary_ad_code_location_change_action(identifier) {
	jQuery('input[name="wp_insert_inpostads['+identifier+'][location]"]').click(function() {
		var location = jQuery('input[name="wp_insert_inpostads['+identifier+'][location]"]:checked').val();
		if((location == 'above') || (location == 'middle') || (location == 'paragraphtop')) {
			jQuery('#primary_ad_code_type_vicode').parent().parent().parent().show();
			jQuery('#primary_ad_code_type_generic').show();
			jQuery('#primary_ad_code_type_generic').parent().find('.isSelectedIndicatorText').html('Generic / Custom Ad Code (Primary Network)');
			jQuery('#primary_ad_code_type_generic').parent().parent().parent().css({'width': 'calc(50% - 40px)', 'margin': '0 20px 5px', 'float': 'left'});
			//jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').val('generic');
		} else {
			jQuery('#primary_ad_code_type_vicode').parent().parent().parent().hide();
			jQuery('#primary_ad_code_type_generic').hide();
			jQuery('#primary_ad_code_type_generic').parent().find('.isSelectedIndicatorText').html('Ad Code (Primary Network)');
			jQuery('#primary_ad_code_type_generic').parent().parent().parent().css({'width': '100%', 'margin': '15px 0', 'float': 'none'});
			jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').val('generic');
		}
		
		if(location == 'middle') {
			jQuery('.wp_insert_inpostads_location_middle_panel').show();
		} else {
			jQuery('.wp_insert_inpostads_location_middle_panel').hide();
		}
	});
	var location = jQuery('input[name="wp_insert_inpostads['+identifier+'][location]"]:checked').val();
	if((location == 'above') || (location == 'middle') || (location == 'paragraphtop')) {
		jQuery('#primary_ad_code_type_vicode').parent().parent().parent().show();
		jQuery('#primary_ad_code_type_generic').show();
		jQuery('#primary_ad_code_type_generic').parent().find('.isSelectedIndicatorText').html('Generic / Custom Ad Code (Primary Network)');
		jQuery('#primary_ad_code_type_generic').parent().parent().parent().css({'width': 'calc(50% - 40px)', 'margin': '0 20px 5px', 'float': 'left'});
		//jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').val('generic');
	} else {
		jQuery('#primary_ad_code_type_vicode').parent().parent().parent().hide();
		jQuery('#primary_ad_code_type_generic').hide();
		jQuery('#primary_ad_code_type_generic').parent().find('.isSelectedIndicatorText').html('Ad Code (Primary Network)');
		jQuery('#primary_ad_code_type_generic').parent().parent().parent().css({'width': '100%', 'margin': '15px 0', 'float': 'none'});
		jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').val('generic');
	}
	
	if(location == 'middle') {
		jQuery('.wp_insert_inpostads_location_middle_panel').show();
	} else {
		jQuery('.wp_insert_inpostads_location_middle_panel').hide();
	}
}

function wp_insert_inpostads_primary_ad_code_type_change(identifier) {
	jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').parent().hide();
	jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').change(function() {
		jQuery('.isSelectedIndicator').removeClass('active');
		jQuery('#primary_ad_code_type_'+jQuery(this).val()).addClass('active');
	});
	jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').change();
	
	jQuery('#primary_ad_code_type_generic').click(function() {
		jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').val('generic');
		jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').change();
	});
	jQuery('#primary_ad_code_type_generic').parent().click(function() {
		jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').val('generic');
		jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').change();
	});
	
	jQuery('#primary_ad_code_type_vicode').click(function() {
		if(!jQuery('#primary_ad_code_type_vicode').hasClass('disabled')) {
			jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').val('vicode');
			jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').change();
		}
	});
	jQuery('#primary_ad_code_type_vicode').parent().click(function() {
		if(!jQuery('#primary_ad_code_type_vicode').hasClass('disabled')) {
			jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').val('vicode');
			jQuery('#wp_insert_inpostads_'+identifier+'_primary_ad_code_type').change();
		}
	});
}

function wp_insert_inpostads_vi_customize_adcode() {
	jQuery('#wp_insert_inpostads_vi_customize_adcode').click(function() {
		jQuery('.ui-dialog-titlebar').find('button').last().button('enable').click();
		jQuery('#wp_insert_vi_customize_adcode').click();
	});
}