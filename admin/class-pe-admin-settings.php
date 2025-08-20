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
class PE_Admin_Settings {
	/**
	 * $pfree_settings
	 *
	 * @var null
	 */
	public static $pfree_settings = null;
	/**
	 * The single instance of the class.
	 *
	 * @var pe_instance
	 */
	protected static $instance = null;
	/**
	 * __constructor
	 */
	public function __construct() {
		$this->hooks();
		PE_Admin_Settings_Products::instance();
	}
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
	 * [hooks description]
	 */
	public function hooks() {
		add_action( 'admin_init', array( $this, 'message_product_enquiry_pro' ) );
		add_action( 'wp_ajax_pe_notice_dismiss', array( $this, 'pe_notice_dismissed' ) );
		add_action( 'admin_notices', array( $this, 'privacy_admin_notice' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( WDM_PE_PLUGIN ), 'PE_Admin_Plugin_Links::plugin_action_links' );
		add_filter( 'plugin_row_meta', 'PE_Admin_Plugin_Links::plugin_row_meta', 10, 2 );
	}
	/**
	 * Display notice to admin about user data collection.
	 */
	public function privacy_admin_notice() {

		if ( ! current_user_can( 'manage_options' ) || get_option( 'wdm_privacy_notice_dismissed', false ) ) {
			return;
		}

		?>
		<div class="wdm-privacy-notice notice notice-info is-dismissible" data-notice-id="wdm_privacy_notice_dismissed">
			<p>
				<?php esc_attr_e( 'Dear User,', 'product-enquiry-for-woocommerce' ); ?><br>
				<?php
					esc_attr_e( 'This is to inform you that WisdmLabs does not collect any user data. The data that is sent directly to your inbox after filling the enquiry form is your sole responsibility and we urge you to update the privacy policy of your websites.', 'product-enquiry-for-woocommerce' )
				?>
				<br>
				<?php esc_attr_e( 'Regards,', 'product-enquiry-for-woocommerce' ); ?><br>
				<?php esc_attr_e( 'WisdmLabs', 'product-enquiry-for-woocommerce' ); ?>
			</p>
		</div>
		<?php

		wp_enqueue_script( 'wdm-admin-notice-js' );
		$nonce = wp_create_nonce( 'wdm-dismiss-notice' );
		wp_localize_script( 'wdm-admin-notice-js', 'wdm_admin_notice', array( 'nonce' => $nonce ) );
	}
	/**
	 * Message displaying about pro product deactivate.
	 */
	public function message_product_enquiry_pro() {
		if ( is_plugin_active( 'product-enquiry-pro/product_enquiry_pro.php' ) ) {
			echo esc_attr( "<div class='error'><p>" . __( 'Product Enquiry Pro plugin is active. Please deactivate in order to install Product Enquiry Free', 'product-enquiry-for-woocommerce' ) . '</p></div>' );
		}
	}

	/**
	 * Dissmiss admin notce.
	 */
	public function pe_notice_dismissed() {
		if ( isset( $_POST['notice_nonce'] ) && wp_verify_nonce( sanitize_text_field( $_POST['notice_nonce'] ), 'wdm-dismiss-notice' ) ) {
			$notice_id = isset( $_POST['notice_id'] ) ? wp_unslash( sanitize_text_field( $_POST['notice_id'] ) ) : '';

			if ( empty( $notice_id ) ) {
				return;
			}
			update_option( 'wdm_privacy_notice_dismissed', 1 );
		}
		die( 1 );
	}
}
