<?php
/**
 * PEFree Admin Functions
 *
 * @package  PEFree/admin
 * @version  3.0.0
 */

/**
 * Render_meta_box_markup_email_information display metabox content
 */
function render_meta_box_markup_email_information() {
	require WDM_PE_PLUGIN_PATH . 'templates/email-information.php';
}

/**
 * Render_meta_box_markup_enq_button_options display metabox content
 */
function render_meta_box_markup_enq_button_options() {
	require WDM_PE_PLUGIN_PATH . 'templates/enq-button-options.php';
}

/**
 * Render_meta_box_markup_form options display metabox content
 */
function render_meta_box_markup_form_options() {
	require WDM_PE_PLUGIN_PATH . 'templates/form-options.php';
}
/**
 * Render_meta_box_markup_styling options display metabox content
 */
function render_meta_box_markup_styling_options() {
	require WDM_PE_PLUGIN_PATH . 'templates/styling-options.php';
}

/**
 * Render_meta_box_markup_terms_and_conditions display metabox content
 */
function render_meta_box_markup_terms_and_conditions() {
	require WDM_PE_PLUGIN_PATH . 'templates/terms-condition-options.php';
}

/**
 * Display PDF settings metabox content
 */
function render_meta_box_markup_pdf_options() {
	require WDM_PE_PLUGIN_PATH . 'templates/pdf-options.php';
}

/**
 * Display Quotation approval/ rejection settings metabox content
 */
function render_meta_box_markup_quote_approval_rej_options() {
	require WDM_PE_PLUGIN_PATH . 'templates/quote-approval-rejection-options.php';
}

/**
 * Add Custom Form Builder GIF.
 */
function render_meta_box_custom_form_builder_gif() {
	require WDM_PE_PLUGIN_PATH . 'templates/custom-form-builder-gif.php';
}

/**
 * Enqueue stylesheet for PRO banner.
 * Include template file for PRO banner.
 */
function render_pro_banner() {
	wp_enqueue_style( 'wdm-admin-pro-banner-css', WDM_PE_PLUGIN_URL . 'assets/admin/css/pro-banner.css', array(), filemtime( WDM_PE_PLUGIN_PATH . 'assets/admin/css/pro-banner.css' ) );
	require WDM_PE_PLUGIN_PATH . 'templates/pro-banner.php';
}

/**
 * This function is used to display helptip.
 *
 * @param string $help_tip  Helptip text to be displayed for the settings.
 *
 * @return string Return HTML string helptip.
 */
function pe_help_tip( $help_tip ) {
	$woo_version = WC_VERSION;
	$woo_version = floatval( $woo_version );
	$value       = '';
	if ( $woo_version < 2.5 ) {
		$value = '<img class="help_tip" data-tip="' . esc_attr( $help_tip ) . '" src="' . WC()->plugin_url() . '/assets/images/help.png" height="16" width="16" />';
	} else {
		$value = \wc_help_tip( $help_tip );
	}

	return $value;
}
