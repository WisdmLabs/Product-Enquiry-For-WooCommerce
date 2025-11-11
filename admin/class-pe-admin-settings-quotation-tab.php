<?php
/**
 * This class creates Quotation setting page for Product enquiry.
 *
 * @package PE/Admin
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'PE_Admin_Settings_Quotation_Tab' ) ) {
	/**
	 * Class for Quotation PEFree Settings page.
	 */
	class PE_Admin_Settings_Quotation_Tab {
		/**
		 * __constructor
		 */
		public function __construct() {
		}

		/**
		 * The single instance of the class.
		 *
		 * @var instance
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
		 * This function is used to display content on Quotation tab.
		 */
		public function quotation_tab_functionality_helper() {
			wp_enqueue_style( 'woocommerce_admin_styles' );
			wp_enqueue_script( 'wdm-settings' );
			wp_enqueue_script( 'jquery-tiptip' );

			require WDM_PE_PLUGIN_PATH . 'templates/quotation-tab.php';
		}
	}
}
