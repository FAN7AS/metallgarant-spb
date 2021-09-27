jQuery(document).ready(function() {
	jQuery('.wp_insert_notice').click(function() {		
		jQuery.post(
			jQuery('#wp_insert_admin_notice_ajax').val(), {
				'action': 'wp_insert_admin_notice_dismiss',
				'wp_insert_admin_notice_nonce': jQuery('#wp_insert_admin_notice_nonce').val(),
			}, function(response) { }
		);
	});
});