<?php
/**
 * PE class for newsletter
 *
 * @package  PEFree
 * @version  3.0.0
 */

if ( ! defined( 'WDM_PE_PLUGIN_PATH' ) ) {
	exit;
}
/**
 * Class.
 */
class PE_Admin_Newsletter_Subcribe {


	/**
	 *   Constructor which will involve all hooks
	 */
	public function __construct() {
		add_action( 'wp_ajax_wdm_pe_action', array( $this, 'send_newsletter_mail' ) );
	}
	/**
	 * Initaize the classes.
	 */
	public static function init() {
		new PE_Admin_Newsletter_Subcribe();
	}
	/**
	 * [generateForm description]
	 */
	public static function generate_form() {
		wp_enqueue_script( 'wdm-subme-js' );
		require WDM_PE_PLUGIN_PATH . 'templates/newsletter-subscribe-form.php';
		wp_enqueue_style( 'wdm-subme-style' );
	}
	/**
	 * Ajaxcallback.
	 */
	public function send_newsletter_mail() {
		if ( isset( $_POST['wdm_pe_subscriber'] ) && wp_verify_nonce( sanitize_text_field( $_POST['wdm_pe_subscriber'] ), 'wdm_pe_subscriber' ) ) {
			global $wpdb; // this is how you get access to the database.
			$email                     = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
			$id                        = isset( $_POST['id'] ) ? (int) $_POST['id'] : '';
			$updates                   = isset( $_POST['updates'] ) ? sanitize_text_field( wp_unslash( $_POST['updates'] ) ) : '';
			$subscribes_message        = '';
			$subscribes_message_client = '';

			if ( 'true' === $updates ) {
				$subscribes_message        = __( 'And Congrats! They have subscribed to your newsletter too!', 'product-enquiry-for-woocommerce' );
				$subscribes_message_client = __( "We'll keep you updated with the latest developments.", 'product-enquiry-for-woocommerce' );
			}
			/* translators: search term, abc */
			$message = sprintf( __( 'Hi,A feature request has been made for Product enquiry free, by %1$s .Requested Feature: %2$s %3$s Thanks and Regards,This is an automated mail, sent by WisdmLabs', 'product-enquiry-for-woocommerce' ), $email, $id, $subscribes_message );
			/* translators: search term, abc */
			$message_client = sprintf( __( "Hi there, \n\nThank you for requesting the %s feature for Product Enquiry for WooCommerce.We will keep you updated with the latest developments. \n\nThanks and Regards,\nWisdmLabs", 'product-enquiry-for-woocommerce' ), $id );

			wp_mail( 'support@wisdmlabs.com', 'PE Feature Request', $message );
			// mail for client.
			$client_header[] = 'From: WisdmLabs <donotreply@wisdmlabs.com>';
			wp_mail( $email, __( 'Your Feature Request Has Been Sent!', 'product-enquiry-for-woocommerce' ), $message_client, $client_header );
			echo esc_attr( '.' . $id );
		}
		die(); // this is required to terminate immediately and return a proper response.
	}
}
