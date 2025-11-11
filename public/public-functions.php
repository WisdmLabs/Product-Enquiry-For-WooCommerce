<?php
/**
 * PEFree Public Functions
 *
 * @package  PEFree/public
 * @version  3.0.0
 */

/**
 * Get terms and condotions.
 */
function get_terms_conditions_text() {
	$terms_conditions_text = get_privacy_policy_text();
	return replace_policy_page_link_placeholders( $terms_conditions_text );
}
/**
 * Get Privacy policy.
 */
function get_privacy_policy_text() {
	$settings = Product_Enquiry_For_Woocommerce::pe_settings();
	$text     = isset( $settings['enquiry_privacy_policy_text'] ) && ! ( empty( $settings['enquiry_privacy_policy_text'] ) ) ? $settings['enquiry_privacy_policy_text'] : default_terms_cond_text();

	return trim( apply_filters( 'get_privacy_policy_text', $text ) );
}
/**
 * Privacy policy link placeholder
 *
 * @param  [type] $text text.
 */
function replace_policy_page_link_placeholders( $text ) {
	$privacy_page_id = privacy_policy_page_id();
	$privacy_link    = $privacy_page_id ? '<a href="' . esc_url( get_permalink( $privacy_page_id ) ) . '" class="pe-privacy-policy-link" target="_blank">' . __( 'privacy policy', 'product-enquiry-for-woocommerce' ) . '</a>' : __( 'privacy policy', 'product-enquiry-for-woocommerce' );

	$find_replace = array(
		'[privacy_policy]' => $privacy_link,
	);

	return str_replace( array_keys( $find_replace ), array_values( $find_replace ), $text );
}
/**
 * Privacy policy page id.
 */
function privacy_policy_page_id() {
	$page_id = get_option( 'wp_page_for_privacy_policy', 0 );
	return apply_filters( 'privacy_policy_page_id', 0 < $page_id ? absint( $page_id ) : 0 );
}

/**
 * Function for url to domain.
 *
 * @param  string $site_url  use of site.
 */
function url_to_domain( $site_url ) {
	// $host = @parse_url( $site_url, PHP_URL_HOST );
	$host = wp_parse_url( $site_url );

	// If the URL can't be parsed, use the original URL
	// Change to "return false" if you don't want that.
	if ( ! $host ) {
		$host = $site_url;
	}
	$host = $host['host'];
	// The "www." prefix isn't really needed if you're just using
	// this to display the domain to the user.
	if ( 'www.' === substr( $host, 0, 4 ) ) {
		$host = substr( $host, 4 );
	}

	// You might also want to limit the length if screen space is limited.
	if ( strlen( $host ) > 50 ) {
		$host = substr( $host, 0, 47 ) . '...';
	}

	return $host;
}
