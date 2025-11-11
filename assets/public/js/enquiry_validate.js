jQuery(
	function($) {
		// Prevent native HTML5 pattern parsing from breaking on invalid/legacy patterns
		// Remove any pattern attributes possibly injected by other code and disable native validation early
		$( '#enquiry-form' ).attr( 'novalidate', 'novalidate' );
		$( '#enquiry-form [name="wdm_customer_name"], #enquiry-form [name="wdm_customer_email"], #enquiry-form [name="wdm_txtphone"]' ).removeAttr( 'pattern' );

		dialog = $( "#contact-form" ).dialog(
			{
				autoOpen:       false,
				closeText:      "",
				height:         'auto',
				maxHeight:      570,
				width:          'auto',
				dialogClass:    "modal-enquiry-form",
				// maxWidth: $(window).width() - 180,
				modal:          true,
				fluid:          true,
				resizable:      false,
				//draggable: false,
				//opacity:0.75,
				show: function() {$( this ).fadeIn( 300 );},
				hide:function() {$( this ).fadeOut( 300 );},
			}
		);
		$( "#enquiry .contact.pe-show-enq-modal" ).click(
			function(e) {
				e.preventDefault();
				dialog.dialog( "open" );
				//  $("#contact-form").closest(".ui-dialog").css("position","fixed");
			}
		);
		$( "#cancel" ).click(
			function() {
				dialog.dialog( "close" );
			}
		);

		// Initialize validation and instant feedback on page load
		jQuery.validator.addMethod(
			"validatePhone",
			function(value, element){
				if ('0' == value.trim().length) {
					return true;
				}
				var validation = new RegExp( '^[0-9(). \\-+]{1,20}$' );
				return validation.test( value );
			}
		);
		// Allow letters, spaces, apostrophes and hyphens; enforce min length 2
		$.validator.addMethod(
			"validateName",
			function(value) {
				if ( typeof value !== 'string' ) {
					return false;
				}
				var trimmed = value.trim();
				if ( trimmed.length === 0 ) {
					return false;
				}
				return /^[A-Za-z '\\-]{2,}$/.test( trimmed );
			}
		);
		$.validator.addMethod(
			"email",
			function(value) {
				var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				return regex.test( value );
			}
		);
		$( '#enquiry-form' ).validate(
			{
				errorElement: "div",
				onkeyup: function(element) { $(element).valid(); },
				onfocusout: function(element) { $(element).valid(); },
				onclick: function(element) { $(element).valid(); },
				rules:
				{
					wdm_customer_name:{
						required: true,
						validateName: true,
					},
					wdm_customer_email:{
						required:true,
						email:true
					},
					wdm_txtphone: {
						validatePhone: true,
					},
					wdm_enquiry:{
						required: true,
						minlength:10,
					},
					enable_terms_conditions: {
						required: function() {
							return $("#terms-cond-cb").length > 0;
						}
					}
				},

				messages:{
					wdm_customer_name:{
						required: object_name.wdm_customer_name,
						validateName: ( typeof object_name.wdm_customer_name_invalid !== 'undefined' ? object_name.wdm_customer_name_invalid : 'Please enter a valid name.' )
					},
					wdm_customer_email:object_name.wdm_customer_email,
					wdm_txtphone: {
						required: object_name.wdm_txtphone_required,
						validatePhone: object_name.wdm_txtphone_invalid,
					},
					wdm_enquiry:object_name.wdm_enquiry,
					enable_terms_conditions: {
						required: $("#terms-cond-cb").data('msg-required') || 'Please accept the terms and conditions.'
					}
				},
				errorPlacement: function(error, element) {
					element.closest( 'div' ).append( error );
				},
				submitHandler:function(form) {
					var name         = $( "[name='wdm_customer_name']" ).val();
					var emailid      = $( "[name='wdm_customer_email']" ).val();
					var phone_number = $( "[name='wdm_txtphone']" ).val();
					var subject      = $( "[name='wdm_subject']" ).val();
					var enquiry      = $( "[name='wdm_enquiry']" ).val();
					var cc           = $( "[name='cc']" ).is( ':checked' ) ? 1 : 0;
					var product_name = $( "[name='wdm_product_name']" ).val();
					var product_url  = window.location.href;
					var security     = $( "[name='product_enquiry']" ).val();
					var authoremail  = $( '#author_email' ).val();
					var product_id   = $( "[name='wdm_product_id']" ).val();
					var variation_id = $( 'input.variation_id' ).val();
					dialog.dialog( "close" );

					$( "#loading" ).dialog(
						{
							create: function( event, ui ) {
								var dialog = $( this ).closest( ".ui-dialog" );
								dialog.find( ".ui-dialog-titlebar" ).remove();
							},
							resizable: false,
							width:'auto',
							height:'auto',
							modal: true,
							//draggable: false
						}
					);

					$.ajax(
						{
							url: object_name.ajaxurl,
							type:'POST',
							data: {action:'wdm_send',security:security,wdm_name:name,wdm_emailid:emailid,wdm_subject:subject, wdm_phone: phone_number, wdm_enquiry:enquiry,wdm_cc:cc,wdm_product_name:product_name,wdm_product_url:product_url,uemail:authoremail, wdm_product_id: product_id, wdm_variation_id: variation_id},
							success: function(response) {
								let ok_btn_text = object_name.ok_text;
								$( "#loading" ).dialog( "close" );
								$( "#pe-enquiry-result" ).text( response );
								$( "#pe-enquiry-result" ).dialog(
									{
										create: function( event, ui ) {
											var dialog = $( this ).closest( ".ui-dialog" );
											dialog.find( ".ui-dialog-titlebar" ).remove();
										},
										resizable: false,
										width:'auto',
										height:'auto',
										modal: true,
										buttons:
										[
											{
												text: ok_btn_text,
												'class': 'pe-successful-enq-ok-btn button alt', 
												click: function() {
													$( this ).dialog( "close" );
												}
											}
										]
									}
								);
							}
						}
					);
					form.reset();
				}
			}
		);

		// Debounced input event for immediate feedback
		var debounce = function(fn, delay) {
			var timeoutId;
			return function() {
				var self = this, args = arguments;
				clearTimeout(timeoutId);
				timeoutId = setTimeout(function(){ fn.apply(self, args); }, delay);
			};
		};
		$(document).on('input', '#enquiry-form input, #enquiry-form textarea, #enquiry-form select', debounce(function(){
			$(this).valid();
		}, 120));
		$( ".ui-dialog" ).addClass( "wdm-enquiry-modal" );

		if ($( '#enquiry-form' ).length) {
			jQuery( document ).keyup(
				function(e) {
					if (e.keyCode === 27) {
						dialog.dialog( "close" );
					}
				}
			);
		}

		$( '#enquiry-form, .ptl' ).focus(
			function(){
				$( "#enquiry-form .ptl" ).each(
					function(){
						if ( ! $( this ).val() == '') {
							$( this ).parents( '.wdm-pef-form-row' ).addClass( 'focused' );
						} else {
							$( this ).parents( '.wdm-pef-form-row' ).removeClass( 'focused' );
						}
					}
				);

				$( this ).parents( '.wdm-pef-form-row' ).addClass( 'focused' );
			}
		)

	}
);
