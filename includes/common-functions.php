<?php
/**
 * PEFree Public Functions
 *
 * @package  PEFree/public
 * @version  3.0.0
 */

if ( ! function_exists( 'should_display_terms_cond' ) ) {
	/**
	 * Should Display Terms Conditions.
	 */
	function should_display_terms_cond() {
		return ( ! empty( is_terms_cond_enabled() ) ) ? true : false;
	}
}
if ( ! function_exists( 'is_terms_cond_enabled' ) ) {
	/**
	 * Check Is terms and condition enabled.
	 */
	function is_terms_cond_enabled() {
		$form_data             = Product_Enquiry_For_Woocommerce::pe_settings();
		$is_terms_cond_enabled = isset( $form_data['enable_terms_conditions'] ) ? $form_data['enable_terms_conditions'] : false;
		return apply_filters( 'pe_is_terms_cond_enabled', $is_terms_cond_enabled );
	}
}
if ( ! function_exists( 'default_terms_cond_text' ) ) {
	/**
	 * Default terms and conditions.
	 */
	function default_terms_cond_text() {
		/* translators: search term, abc */
		$text = sprintf( __( 'I allow the Site owner to contact me via email/phone to discuss this enquiry. (If you want to know more about the way this site handles the data, then please go through our %s).', 'product-enquiry-for-woocommerce' ), '[privacy_policy]' );
		return apply_filters( 'default_terms_cond_text', $text );
	}
}
