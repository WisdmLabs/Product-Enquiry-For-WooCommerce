jQuery( document ).ready(
	function(){
		jQuery( '#wdm_subme_submit' ).on(
			'click',
			function(e){
				jQuery( '#wdm_subme_error' ).css( 'display','none' );
				jQuery( '#wdm_subme_email_field' ).css( 'border-color','#AAAAAA' );
				e.preventDefault();
				if ( ! isEmail( jQuery( '#wdm_subme_email_field' ).val() )) {
					alert( 'Enter valid email.' );
					return false;
				}
				jQuery.post(
					"https://subscribe.wisdmlabs.com/sub.php",
					{
						"wdmemail":jQuery( '#wdm_subme_email_field' ).val(),
						"wdmtsil": '9B9D3854B3CA645E1505629F5680BABE',
						"wdmhoney":jQuery( '#wdm_honeypot' ).val(),
						"wdmagree":(jQuery( 'input[name="wdm-agree"]' ).is( ':checked' )) ? 1 : 0,
						"nonce"   : jQuery( '#wdm_pe_subscriber' ).val(),
					}
				).done(
					function(data) {
						if ( data == '0' ) {
							jQuery( '#enter-email-label' ).remove();
							jQuery( '#wdm_agree_span' ).remove();
							jQuery( '#wdm_subme_submit' ).text( 'Sweet! Check your inbox now' );
							jQuery( '#wdm_subme_submit' ).css( {'cursor':'inherit'} );
						} else if ( data == '1' ) {
							jQuery( '#enter-email-label' ).remove();
							jQuery( '#wdm_agree_span' ).remove();
							jQuery( '#wdm_subme_submit' ).text( 'You are already subscribed!' );
							jQuery( '#wdm_subme_submit' ).css( {'cursor':'inherit'} );
						} else if ( data == '3' ) {
							jQuery( '#wdm_subme_error' ).text( 'Invalid Email!' );
							jQuery( '#wdm_subme_email_field' ).css( 'border-color','red' );
							jQuery( '#wdm_subme_error' ).css( 'display','block' );
						} else {
							jQuery( '#wdm_subme_email_field' ).css( 'border-color','red' );
							jQuery( '#wdm_subme_error' ).text( 'Error! try again later.' );
							jQuery( '#wdm_subme_error' ).css( 'display','block' );
						}
						jQuery( "#wdm-subme-form" ).trigger( 'reset' );
						jQuery( '#wdm_subme_submit' ).attr( "disabled",true );
						// alert( "second success" );
					}
				)
				.fail(
					function() {
						jQuery( "#wdm-subme-form" ).trigger( 'reset' );
						jQuery( '#wdm_subme_submit' ).attr( "disabled",true );
						jQuery( '#wdm_subme_email_field' ).css( 'border-color','red' );
						jQuery( '#wdm_subme_error' ).text( 'Error! try again later.' );
						jQuery( '#wdm_subme_error' ).css( 'display','block' );
					}
				);
			}
		);

		// jQuery( window ).resize(function() {
		//   if(jQuery(window).width() > 901){
		//   	jQuery('#wdm_subme_email_field').attr("placeholder", "Enter your email and get 20% discount on our premium products");
		//   }else{
		//   	jQuery('#wdm_subme_email_field').attr("placeholder", "Enter your email & get 20% off on products");
		//   }
		// });

		jQuery( 'input[name="wdm-agree"]' ).change(
			function(e){
				jQuery( '#wdm_subme_submit' ).toggleClass( 'disabled_button' );
				jQuery( '#wdm_subme_submit' ).attr( 'title',( (jQuery( this ).prop( 'checked' ) == true) ? '' : 'Please opt-in for email subscription') );
				jQuery( '#wdm_subme_submit' ).attr( "disabled", ! (jQuery( this ).prop( 'checked' )) );
			}
		);
		function isEmail(email) {
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return regex.test( email );
		}
	}
);

jQuery( window ).load(
	function(){
		if (jQuery( window ).width() > 901) {
			jQuery( '#wdm_subme_email_field' ).attr( "placeholder", "Enter your email and get 20% discount on our premium products" );
		} else {
			jQuery( '#wdm_subme_email_field' ).attr( "placeholder", "Enter your email & get 20% off on products" );
		}
	}
);
