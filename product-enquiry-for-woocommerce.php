<?php
/**
 * Plugin Name: Product Enquiry for WooCommerce
 * Description: Allows prospective customers or visitors to make enquiry about a product, right from within the product page.
 * Version: 3.2.5.2
 * Author: WisdmLabs
 * Author URI: https://wisdmlabs.com
 * Plugin URI: https://wordpress.org/plugins/product-enquiry-for-woocommerce
 * License: GPL2
 * Text Domain: product-enquiry-for-woocommerce
 * Domain Path: /languages/
 * WP requires at least: 5.3
 * WP tested up to: 6.9
 * WC requires at least: 4.0
 * WC tested up to: 10.4.3
 *
 * @package  PEFree
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'PEFREE_VERSION', '3.2.5.2' );
define( 'WDM_PE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WDM_PE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WDM_PE_PLUGIN', __FILE__ );
define( 'WDM_PE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

/**
 * Activation hook to show promotional banner.
 */
register_activation_hook( __FILE__, 'wdm_pefree_activation' );
/**
 * Function to run on plugin activation.
 */
function wdm_pefree_activation() {
	// Clear dismissed flag on activation so popup shows again
	delete_option( 'wdm_pefree_activation_banner_dismissed' );
	// Set transient to show promotional banner for 7 days after activation.
	set_transient( 'wdm_pefree_show_activation_banner', true, 7 * DAY_IN_SECONDS );
	// Also set an option to track activation time
	update_option( 'wdm_pefree_activation_time', current_time( 'timestamp' ) );
	// Set a flag to show popup on next admin page load
	update_option( 'wdm_pefree_show_popup_on_next_load', true );
}

/**
 * Helper function to manually trigger popup for testing.
 * Add ?pefree_reset_popup=1 to any admin URL to reset and show popup.
 */
add_action( 'admin_init', 'wdm_pefree_reset_popup_test' );
function wdm_pefree_reset_popup_test() {
	if ( current_user_can( 'manage_options' ) && isset( $_GET['pefree_reset_popup'] ) && '1' === $_GET['pefree_reset_popup'] ) {
		// Reset dismissed flag
		delete_option( 'wdm_pefree_activation_banner_dismissed' );
		// Set transient
		set_transient( 'wdm_pefree_show_activation_banner', true, 7 * DAY_IN_SECONDS );
		// Set activation time to now
		update_option( 'wdm_pefree_activation_time', current_time( 'timestamp' ) );
		// Set flag to show on next load
		update_option( 'wdm_pefree_show_popup_on_next_load', true );
		// Remove the parameter and redirect
		$redirect_url = remove_query_arg( 'pefree_reset_popup' );
		wp_safe_redirect( $redirect_url );
		exit;
	}
}

add_action( 'plugins_loaded', 'wdm_pefree_init', 11 );
/**
 * Init function to initialize the plugin.
 */
function wdm_pefree_init() {
	// phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	if ( ! class_exists( 'Product_Enquiry_For_Woocommerce', false ) ) {
		include_once WDM_PE_PLUGIN_PATH . '/includes/class-product-enquiry-for-woocommerce.php';

		// Integrating with PhotoSwip
		include_once WDM_PE_PLUGIN_PATH . '/templates/enq-photoswipe-zoom.php';
	}
	Product_Enquiry_For_Woocommerce::instance();
}

// This hook will declear the HPOS compatibility.
add_action( 'before_woocommerce_init', function() {
	if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
		\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
	}
} );
