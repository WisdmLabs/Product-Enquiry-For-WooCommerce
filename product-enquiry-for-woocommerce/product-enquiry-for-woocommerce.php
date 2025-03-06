<?php
/**
 * Plugin Name: Product Enquiry for WooCommerce
 * Description: Allows prospective customers or visitors to make enquiry about a product, right from within the product page.
 * Version: 3.1.9
 * Author: WisdmLabs
 * Author URI: https://wisdmlabs.com
 * Plugin URI: https://wordpress.org/plugins/product-enquiry-for-woocommerce
 * License: GPL2
 * Text Domain: product-enquiry-for-woocommerce
 * Domain Path: /languages/
 * WP requires at least: 5.3
 * WP tested up to: 6.6.1
 * WC requires at least: 4.0
 * WC tested up to: 9.1.4
 *
 * @package  PEFree
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'PEFREE_VERSION', '3.1.9' );
define( 'WDM_PE_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WDM_PE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WDM_PE_PLUGIN', __FILE__ );
define( 'WDM_PE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

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
