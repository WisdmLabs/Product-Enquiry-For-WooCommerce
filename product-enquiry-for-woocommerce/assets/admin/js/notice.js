jQuery( document ).ready(
	function () {
		jQuery( document ).on(
			'click',
			'div.wdm-privacy-notice .notice-dismiss',
			function() {
				var notice_id = jQuery( "div.wdm-privacy-notice" ).data( "notice-id" );
				// console.log( notice_id );
				var data = {
					'action': 'pe_notice_dismiss',
					'notice_id': notice_id,
					'notice_nonce': wdm_admin_notice.nonce,
				};

				jQuery.ajax(
					{
						type: 'POST',
						url: ajaxurl,
						data: data
					}
				);
			}
		);
	}
);
