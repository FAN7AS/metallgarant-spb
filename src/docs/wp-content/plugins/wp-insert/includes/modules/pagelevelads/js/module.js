jQuery(document).ready(function() {
	wp_insert_click_handler(
		'wp_insert_pagelevelads_new',
		'Page-Level Ad : Add New',
		jQuery("body").width() * 0.8,
		jQuery("body").height() * 0.8,
		function() {
			jQuery('.wp_insert_pagelevelads_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
		},
		function() {
			var identifier = jQuery(".wp_insert_pagelevelads_identifier").val();
			var pageleveladLink = jQuery("<a></a>");
			pageleveladLink.attr("id", "wp_insert_pagelevelads_"+identifier);
			pageleveladLink.attr("href", "javascript:;");
			pageleveladLink.attr("onClick", "wp_insert_pagelevelads_click_handler(\'"+identifier+"\', \'"+jQuery("#wp_insert_pagelevelads_"+identifier+"_title").val()+"\')");
			pageleveladLink.html("Page-Level Ad : "+jQuery("#wp_insert_pagelevelads_"+identifier+"_title").val());
			var deleteButton = jQuery("<span></span>");
			deleteButton.attr("class", "dashicons dashicons-dismiss wp_insert_delete_icon");
			deleteButton.attr("onClick", "wp_insert_pagelevelads_remove(\'"+identifier+"\')");
			jQuery("#wp_insert_pagelevelads_new").parent().before(jQuery("<p></p>").append(pageleveladLink, deleteButton));
			wp_insert_pagelevelads_update(identifier);
		},
		function() { }
	);
});

function wp_insert_pagelevelads_click_handler(identifier, title) {
	jQuery('<div id="wp_insert_pagelevelads_'+identifier+'_dialog"></div>').html('<div class="wp_insert_ajaxloader"></div>').dialog({
		'modal': true,
		'resizable': false,
		'width': jQuery("body").width() * 0.8,
		'maxWidth': jQuery("body").width() * 0.8,
		'maxHeight': jQuery("body").height() * 0.9,
		'title': 'Page-Level Ad : '+title,
		position: { my: 'center', at: 'center', of: window },
		open: function (event, ui) {
			jQuery('.ui-dialog').css({'z-index': 999999, 'max-width': '90%'});
			jQuery('.ui-widget-overlay').css({'z-index': 999998, 'opacity': 0.8, 'background': '#000000'});
			jQuery('.ui-dialog-buttonpane button:contains("Update")').button('disable');
			jQuery.post(
				jQuery('#wp_insert_admin_ajax').val(), {
					'action': 'wp_insert_pagelevelads_existing_form_get_content',
					'wp_insert_pagelevelads_identifier': identifier,
					'wp_insert_nonce': jQuery('#wp_insert_nonce').val()
				}, function(response) {
					jQuery('.wp_insert_ajaxloader').hide();
					jQuery('.ui-dialog-content').html(response);
					jQuery('.ui-accordion .ui-accordion-content').css('max-height', (jQuery("body").height() * 0.45));
					jQuery('.ui-dialog-buttonpane button:contains("Update")').button('enable');
					jQuery('.wp_insert_pagelevelads_status').parent().css({'display': 'inline-block', 'margin': '5px 0 0'}).prependTo('.ui-dialog-buttonpane');
					jQuery('.ui-dialog').css({'position': 'fixed'});
					jQuery('#wp_insert_pagelevelads_'+identifier+'_dialog').delay(500).dialog({position: { my: 'center', at: 'center', of: window }});
				}			
			);
		},
		buttons: {
			'Update': function() {
				jQuery("#wp_insert_pagelevelads_"+identifier).html("Page-Level Ad : "+jQuery("#wp_insert_pagelevelads_"+identifier+"_title").val());
				jQuery("#wp_insert_pagelevelads_"+identifier).attr("onClick", "wp_insert_pagelevelads_click_handler(\'"+identifier+"\', \'"+jQuery("#wp_insert_pagelevelads_"+identifier+"_title").val()+"\')");
				wp_insert_pagelevelads_update(identifier);
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

function wp_insert_pagelevelads_update(identifier) {
	args = {};
	args['action'] = 'wp_insert_pagelevelads_existing_form_save_action';
	args['wp_insert_nonce'] = jQuery('#wp_insert_nonce').val();
	args['wp_insert_pagelevelads_identifier'] = identifier;
	args['wp_insert_pagelevelads_'+identifier+'_status'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_status').prop('checked');
	
	args['wp_insert_pagelevelads_'+identifier+'_title'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_title').val();
	
	args['wp_insert_pagelevelads_'+identifier+'_primary_ad_code'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_primary_ad_code').val();
	args['wp_insert_pagelevelads_'+identifier+'_secondary_ad_code'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_secondary_ad_code').val();
	args['wp_insert_pagelevelads_'+identifier+'_tertiary_ad_code'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_tertiary_ad_code').val();
	
	args['wp_insert_pagelevelads_'+identifier+'_rules_exclude_loggedin'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_exclude_loggedin').prop('checked');
	args['wp_insert_pagelevelads_'+identifier+'_rules_exclude_mobile_devices'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_exclude_mobile_devices').prop('checked');
	args['wp_insert_pagelevelads_'+identifier+'_rules_exclude_404'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_exclude_404').prop('checked');
	args['wp_insert_pagelevelads_'+identifier+'_rules_exclude_home'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_exclude_home').prop('checked');
	args['wp_insert_pagelevelads_'+identifier+'_rules_exclude_archives'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_exclude_archives').prop('checked');
	args['wp_insert_pagelevelads_'+identifier+'_rules_exclude_search'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_exclude_search').prop('checked');
	args['wp_insert_pagelevelads_'+identifier+'_rules_exclude_page'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_exclude_page').prop('checked');
	args['wp_insert_pagelevelads_'+identifier+'_rules_page_exceptions'] = jQuery.map(jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_page_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_pagelevelads_'+identifier+'_rules_exclude_post'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_exclude_post').prop('checked');
	args['wp_insert_pagelevelads_'+identifier+'_rules_post_exceptions'] = jQuery.map(jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_post_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_pagelevelads_'+identifier+'_rules_post_categories_exceptions'] = jQuery.map(jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_post_categories_exceptions :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_pagelevelads_'+identifier+'_rules_exclude_categories'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_exclude_categories').prop('checked');
	args['wp_insert_pagelevelads_'+identifier+'_rules_categories_exceptions'] = jQuery.map(jQuery('#wp_insert_pagelevelads_'+identifier+'_rules_categories_exceptions :selected'), function(e) { return jQuery(e).val(); });
	
	args['wp_insert_pagelevelads_'+identifier+'_geo_group1_countries'] = jQuery.map(jQuery('#wp_insert_pagelevelads_'+identifier+'_geo_group1_countries :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_pagelevelads_'+identifier+'_geo_group1_adcode'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_geo_group1_adcode').val();
	args['wp_insert_pagelevelads_'+identifier+'_geo_group2_countries'] = jQuery.map(jQuery('#wp_insert_pagelevelads_'+identifier+'_geo_group2_countries :selected'), function(e) { return jQuery(e).val(); });
	args['wp_insert_pagelevelads_'+identifier+'_geo_group2_adcode'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_geo_group2_adcode').val();
	
	args['wp_insert_pagelevelads_'+identifier+'_styles'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_styles').val();
	
	args['wp_insert_pagelevelads_'+identifier+'_notes'] = jQuery('#wp_insert_pagelevelads_'+identifier+'_notes').val();
	
	jQuery.post(
		jQuery('#wp_insert_admin_ajax').val(), args, function(response) { }
	);
}

function wp_insert_pagelevelads_remove(identifier) {
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
				jQuery("#wp_insert_pagelevelads_"+identifier).parent().remove();
				jQuery.post(
					jQuery('#wp_insert_admin_ajax').val(), {
						'action': 'wp_insert_pagelevelads_remove',
						'wp_insert_pagelevelads_identifier': identifier,
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