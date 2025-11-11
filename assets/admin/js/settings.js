jQuery( document ).ready(
	function ($) {
		// Sets interval...what is transition slide speed?
		/*jQuery('#myCarousel').carousel({
		interval: 80000000000
		});*/

		// To toggle metaboxes(opem closed).
		$( ".if-js-closed" ).removeClass( "if-js-closed" ).addClass( "closed" );
		postboxes.add_postbox_toggles( 'Product Enquiry for WooCommerce' );

		// This is for hide or show manual css option
		$( "#ask_product_form" ).validate();
		if ($( "#manual_css" ).is( ':checked' )) {
			$( "#Other_Settings" ).show();
		} else {
			$( "#Other_Settings" ).hide();
		}
		$( "#theme_css" ).click( function(){$( "#Other_Settings" ).hide();} );
		$( "#manual_css" ).click( function(){$( "#Other_Settings" ).show();} );

		jQuery( "#ask_product_form" ).submit(
			function ( e ) {
				let error    = 0;
				let email    = jQuery( '#wdm_user_email' ).val();
				let em_regex = /^(\s)*(([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+)((\s)*,(\s)*(([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+)(\s)*(,)*)*(\s)*$/;

				jQuery( '.pe-admin-required-text' ).each(
					function() {
						let flag = checkRequiredFields( jQuery( this ) );
						if (1 == flag) {
							error = 1;
						}
					}
				);

				if ( '' != email && ! em_regex.test( email ) ) {
					jQuery( '.email-invalid-error' ).addClass( 'show' );
					error = 1;
				} else {
					jQuery( '.email-invalid-error' ).removeClass( 'show' );
				}

				if ( error == 1 ) {
					return false;
				}
			}
		);

		jQuery( '.pe-admin-required-text' ).change(
			function(){
				let $field = $( this );
				checkRequiredFields( $field );
			}
		);

		jQuery( '#enable_telephone_no_txtbox' ).click(
			function () {
				if ( jQuery( this ).is( ':checked' ) ) {
					jQuery( '#make_phone_mandatory_chkbox' ).closest( 'tr' ).show();
				} else {
					jQuery( '#make_phone_mandatory_chkbox' ).closest( 'tr' ).hide();
				}
			}
		);
		if ( jQuery( '#enable_telephone_no_txtbox' ).is( ':checked' ) ) {
			jQuery( '#make_phone_mandatory_chkbox' ).closest( 'tr' ).show();
		} else {
			jQuery( '#make_phone_mandatory_chkbox' ).closest( 'tr' ).hide();
		}

		if (jQuery( '.terms-cond-checkbox' ).is( ':checked' )) {
			jQuery( '#enquiry_privacy_policy_text' ).closest( 'tr' ).show();
		} else {
			jQuery( '#enquiry_privacy_policy_text' ).closest( 'tr' ).hide();
		}

		// When any checkbox on the setting page is changed, find out next hidden field and set it to 1 or 0
		jQuery( '.wdm_wpi_checkbox' ).change(
			function () {
				let $field           = jQuery( this );
				let $nextHiddenField = $field.next( "input[type='hidden']" );
				if ( $field.is( ':checked' ) ) {
					if ( $field.hasClass( 'terms-cond-checkbox' ) ) {
						jQuery( '#enquiry_privacy_policy_text' ).closest( 'tr' ).show();
					}
					$nextHiddenField.val( '1' );
				} else {
					if ( $field.hasClass( 'terms-cond-checkbox' ) ) {
						jQuery( '#enquiry_privacy_policy_text' ).closest( 'tr' ).hide();
					}
					$nextHiddenField.val( '0' );
				}
			}
		);

		// Trigger WooCommerce Tooltips. This is used to trigger tooltips added by function \wc_help_tip
		var tiptip_args = {
			'attribute': 'data-tip',
			'fadeIn': 50,
			'fadeOut': 50,
			'delay': 200
		};
		jQuery( '.tips, .help_tip, .woocommerce-help-tip' ).tipTip( tiptip_args );

		function checkRequiredFields($field)
		{
			let error = 0; // 0 = no error, 1 = error

			jQuery( '.email-invalid-error' ).removeClass( 'show' );
			if ($field.is( ":visible" ) && $field.val().length < 1) {
				$field.closest( '.forminp-text' ).find( '.pe-admin-field-req-error' ).addClass( 'show' );
				error = 1;
			} else {
				$field.closest( '.forminp-text' ).find( '.pe-admin-field-req-error' ).removeClass( 'show' );
				error = 0;
			}
			return error;
		}
	}
);
