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
class PE_Admin_Settings_Other_Extensions_Tab {
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
	 * This function is used to display content on tab hireus_tab.
	 */
	public function other_extensions_tab_functionality_helper() {
		require WDM_PE_PLUGIN_PATH . 'templates/other-extensions-tab.php';
	}
}
