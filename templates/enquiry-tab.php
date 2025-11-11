<?php
/**
 * Email information
 *
 *  @package  PEFree/template
 */

?>
<form name="ask_product_form" id="ask_product_form" method="POST" action="options.php">
	<?php
	settings_fields( 'wdm_form_options' );
	wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
	wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
	$form_data = Product_Enquiry_For_Woocommerce::pe_settings();
	if ( ! isset( $form_data['pos_radio'] ) ) {
		$form_data['pos_radio'] = 'after_add_cart';
	}
	?>
	<div id="ask_abt_product_panel">
		<?php
		add_meta_box( 'meta-box-email-information', esc_attr( __( 'Emailing Information', 'product-enquiry-for-woocommerce' ) ), 'render_meta_box_markup_email_information', 'product-enquiry-for-woocommerce', 'normal', 'low' );
		add_meta_box( 'meta-box-enq_button_options', esc_attr( __( 'Enquiry Button Options', 'product-enquiry-for-woocommerce' ) ), 'render_meta_box_markup_enq_button_options', 'product-enquiry-for-woocommerce', 'normal', 'low' );

		add_meta_box( 'meta-box-form_options', esc_attr( __( 'Form Options', 'product-enquiry-for-woocommerce' ) ), 'render_meta_box_markup_form_options', 'product-enquiry-for-woocommerce', 'normal', 'low' );

		add_meta_box( 'meta-box-styling_options', esc_attr( __( 'Styling Options', 'product-enquiry-for-woocommerce' ) ), 'render_meta_box_markup_styling_options', 'product-enquiry-for-woocommerce', 'normal', 'low' );

		add_meta_box( 'meta-box-terms-condition_options', esc_attr( __( 'Enquiry Terms and Conditions', 'product-enquiry-for-woocommerce' ) ), 'render_meta_box_markup_terms_and_conditions', 'product-enquiry-for-woocommerce', 'normal', 'low' );
		do_meta_boxes( 'product-enquiry-for-woocommerce', 'normal', '' );
		?>
		<p><input type="submit" class="wdm_wpi_input button-primary" value="Save Changes" id="wdm_ask_button" /></p>
	</div>
</form>
