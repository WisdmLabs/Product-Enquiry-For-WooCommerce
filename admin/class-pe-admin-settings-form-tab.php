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
class PE_Admin_Settings_Form_Tab {
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
	 * This function is used to display content on tab form_tab.
	 */
	public function form_tab_functionality_helper() {
		wp_enqueue_script( 'wdm-settings' );
		wp_enqueue_script( 'jquery-tiptip' );
		wp_localize_script(
			'wdm-settings',
			'pe_sett_data',
			array(
				'invalid_email'  => __( 'Please enter valid Email address.', 'product-enquiry-for-woocommerce' ),
				'email_required' => __( 'Email can\'t be blank.', 'product-enquiry-for-woocommerce' ),
			)
		);

		$pro = "<span title='Pro Feature' class='pew_pro_txt'>" . __( '[Available in PRO]', 'product-enquiry-for-woocommerce' ) . '</span>';
		require WDM_PE_PLUGIN_PATH . 'templates/enquiry-tab.php';
	}
}
