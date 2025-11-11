<?php
/**
 * This class creates setting page for Product enquiry
 *
 * @package PE/Admin
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class for PEFree Settings page.
 */
class PE_Admin_Settings_Premium_Tab {
	/**
	 * $pfree_settings
	 *
	 * @var null
	 */
	public static $pfree_settings = null;
	/**
	 * __constructor
	 */
	public function __construct() {
	}
	/**
	 * The single instance of the class.
	 *
	 * @var pe_instance
	 */
	protected static $instance = null;
	/**
	 * Ensures only one instance of class is loaded or can be loaded.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	/**
	 * This function is used to display content on tab premium_tab.
	 */
	public function premium_tab_functionality_helper() {
		wp_enqueue_style( 'premium-style' );
		wp_enqueue_style( 'premium-fontstyle' );
		wp_enqueue_script( 'viewportChecker-min' );
		wp_enqueue_script( 'debouncedResize' );
		wp_enqueue_script( 'wdm-pe-main' );
		require WDM_PE_PLUGIN_PATH . 'templates/premium.php';
	}
}
