<?php
/**
 * PEFree Admin
 *
 * @package  PEFREE/Admin
 * @version  3.0.1
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * PEFree Admin class
 */
class PE_Admin_Enquiry_Form_Ajax {

	/**
	 * The single instance of the class.
	 *
	 * @var pe_instance
	 */
	protected static $instance = null;
	/**
	 *
	 * Ensures only one instance is loaded or can be loaded.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	/**
	 * Cunstrecture
	 */
	public function __construct() {
		$this->init();
	}
	/**
	 * Initaize the classes.
	 */
	public function init() {
		add_action( 'wp_ajax_wdm_send', array( $this, 'submit_enquiry_form' ) );
		add_action( 'wp_ajax_nopriv_wdm_send', array( $this, 'submit_enquiry_form' ) );
	}
	/**
	 * Contact email.
	 */
	public function submit_enquiry_form() {
		$form_data  = Product_Enquiry_For_Woocommerce::pe_settings();
		$error_code = -1;

		if ( isset( $form_data['deactivate_nonce'] ) && 1 == $form_data['deactivate_nonce'] ) {
			$nonce = true;
		} else {
			$nonce = check_ajax_referer( 'enquiry_action', 'security', false );
		}

		if ( isset( $_POST['security'] ) && $nonce ) {
			$product_id   = isset( $_POST['wdm_product_id'] ) ? (int) $_POST['wdm_product_id'] : '';
			$product      = wc_get_product( $product_id );
			$name         = isset( $_POST['wdm_name'] ) ? sanitize_text_field( wp_unslash( $_POST['wdm_name'] ) ) : '';
			$to           = isset( $_POST['wdm_emailid'] ) ? sanitize_email( wp_unslash( $_POST['wdm_emailid'] ) ) : '';
			$phone_number = isset( $_POST['wdm_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['wdm_phone'] ) ) : '';
			$subject      = ( isset( $_POST['wdm_subject'] ) && ! empty( $_POST['wdm_subject'] ) ) ? sanitize_text_field( wp_unslash( $_POST['wdm_subject'] ) ) : $form_data['default_sub'];
			$message      = isset( $_POST['wdm_enquiry'] ) ? sanitize_textarea_field(
				wp_unslash( $_POST['wdm_enquiry'] )
			) : '';
			$cc           = isset( $_POST['wdm_cc'] ) ? absint( wp_unslash( $_POST['wdm_cc'] ) ) : '';
			$product_name = isset( $_POST['wdm_product_name'] ) ? sanitize_text_field( wp_unslash( $_POST['wdm_product_name'] ) ) : '';
			$product_url  = isset( $_POST['wdm_product_url'] ) ? esc_url_raw( wp_unslash( $_POST['wdm_product_url'] ) ) : '';
			$variation_id = isset( $_POST['wdm_variation_id'] ) ? (int) $_POST['wdm_variation_id'] : '';
			$admin_email  = get_option( 'admin_email' );

			$site_name          = get_bloginfo( 'name' );
			$recipient_emails   = array();
			$recipient_email    = array();
			$enabled_terms_cond = is_terms_cond_enabled();
			$prod_sku           = $product->get_sku();
			$author_email       = '';
			if ( ! empty( $prod_sku ) ) {
				$p_sku_text = " (SKU: $prod_sku) ";
			} else {
				$p_sku_text = " (ID: #$product_id) ";
			}
			// Variation info.
			if ( $variation_id ) {
				$variation = wc_get_product( $variation_id );
				$var_name  = $variation->get_formatted_name();
			}

			if ( '' !== $form_data['user_email'] ) {
				$recipient_email = explode( ',', $form_data['user_email'] );
				$recipient_email = array_map( 'trim', $recipient_email );
			}
			foreach ( $recipient_email as $single_email ) {
				array_push( $recipient_emails, $single_email );
			}
			if ( ! empty( $form_data['send_mail_to_admin'] ) ) {
				array_push( $recipient_emails, $admin_email );
			}

			if ( ! empty( $form_data['send_mail_to_author'] ) ) {
				$author_email = isset( $_POST['uemail'] ) ? sanitize_email( wp_unslash( $_POST['uemail'] ) ) : '';
			}

			$headers = "Reply-To: $to \n";

			/**
			 * Filter to decide whether to encode enquiry subject line.
			 *
			 * @since 3.1.5
			 *
			 * @param  bool  True if subject should be encoded, false otherwise. Default false.
			 */
			if ( function_exists( 'mb_encode_mimeheader' ) && apply_filters( 'pe_encode_email_subject', false ) ) {
				// UTF-8.
				$subject = mb_encode_mimeheader( $subject, 'UTF-8', 'B', "\n" );
			}

			$headers .= "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=utf-8\n";
			$body     = '';
			$body     = apply_filters( 'pe_enquire_body_before', $body );

			$body .= __( 'Product Enquiry from', 'product-enquiry-for-woocommerce' ) . ' <strong>' . $site_name . '</strong> <br /><br />';
			$body .= '<strong>' . __( 'Product Name:', 'product-enquiry-for-woocommerce' ) . '</strong> ' . $product_name . '<br /><br />';

			if ( $variation_id ) {
				$body .= '<strong>' . __( 'Variation Name:', 'product-enquiry-for-woocommerce' ) . '</strong> ' . $var_name . '<br /><br />';
			}

			$body .= '<strong>' . __( 'Product URL:', 'product-enquiry-for-woocommerce' ) . '</strong> <a href="' . esc_url( $product_url ) . '">' . esc_url( $product_url ) . '</a><br /><br />';
			$body .= '<strong>' . __( 'Customer Name:', 'product-enquiry-for-woocommerce' ) . '</strong> ' . esc_html( $name ) . '<br /><br />';
			$body .= '<strong>' . __( 'Customer Email:', 'product-enquiry-for-woocommerce' ) . '</strong> ' . esc_html( $to ) . '<br /><br />';
			if ( isset( $form_data['enable_telephone_no_txtbox'] ) && 1 === (int) $form_data['enable_telephone_no_txtbox'] && ! empty( $phone_number ) ) {
				$body .= '<strong>' . __( 'Customer Phone Number:', 'product-enquiry-for-woocommerce' ) . '</strong> ' . $phone_number . '<br /><br />';
			}
			$body .= '<strong>' . __( 'Message:', 'product-enquiry-for-woocommerce' ) . '</strong> <br />' . wpautop( $message ) . '<br /><br />';

			if ( ! empty( $enabled_terms_cond ) ) {
				/* translators: search term */
				$body .= '<br /><br />' . sprintf( __( '%s accepted the enquiry terms and conditions', 'product-enquiry-for-woocommerce' ), $to );
			}
			$body = apply_filters( 'pe_enquire_body_after', $body );

			$admin_mail_body = $body;
			$pep_pro_link    = esc_url( 'https://wisdmlabs.com/woocommerce-quotation-and-inquiry/?utm_source=pefreepremiumtab&utm_medium=pefreepremiumtab&utm_campaign=pefreepremiumtab&utm_term=pefreepremiumtab&utm_content=pefreepremiumtab' );
			/* translators: search term, abc */
			$link_statement = sprintf( __( '%1$s Learn More %2$s', 'product-enquiry-for-woocommerce' ), "<a href='$pep_pro_link'>", '</a>' );
			$premium_mail   = '<br><hr>';
			/* translators: search term, abc */
			$premium_mail .= '<p>' . sprintf( __( 'Checkout %1$s Product Enquiry Pro %2$s for these <b>PREMIUM</b> features', 'product-enquiry-for-woocommerce' ), "<a href='$pep_pro_link'>", '</a>' ) . ': </p>';
			$premium_mail .= '<ul>
						<li> ' . __( 'Request a Quote System: The pro version allows customers to request a quote for your products.', 'product-enquiry-for-woocommerce' ) . '</li>
						<li>' . __( 'Create Quotation: Creating a fresh quotation, right from the dashboard takes only a few clicks.', 'product-enquiry-for-woocommerce' ) . '</li>
						<li>' . __( 'Multiproduct Enquiry: Allow customers to add multiple products to the "Enquiry Cart" and send their queries on a product level in a single enquiry.', 'product-enquiry-for-woocommerce' ) . '</li>
						<li>' . __( 'Compatibility with the latest versions of WordPress and WooCommerce at all times.', 'product-enquiry-for-woocommerce' ) . '</li>
						<li>' . __( 'And much more...', 'product-enquiry-for-woocommerce' ) . '</li>
				</ul>';

			$premium_mail    .= $link_statement;
			$admin_mail_body .= $premium_mail;
			$admin_mail_body  = wordwrap( $admin_mail_body, 100 );
			$send_mail        = false;
			$recipient_emails = apply_filters( 'pefree_recipient_emails', array_unique( $recipient_emails ) );

			foreach ( $recipient_emails as $recipient_email ) {
				$send_mail = wp_mail( $recipient_email, $subject, $admin_mail_body, $headers );
			}
			if ( ! empty( $form_data['send_mail_to_author'] ) && isset( $author_email ) && ! in_array( $author_email, $recipient_emails, true ) ) {
				wp_mail( $author_email, $subject, $body, $headers );
			}
			if ( $send_mail ) {
				if ( 0 < $cc ) {
					$hh = wp_mail( $to, $subject, wordwrap( $body, 100 ), $headers );
				}

				/**
				 * The action hook is fired if the enquiry is sent successfully.
				 *
				 * @param int $product_id   Product Id for which enquiry has been made.
				 * @param int variation_id  Variation Id for which enquiry has been made. This could be empty if the                                product type is simple or variation is not selected.
				 * @param string $name      Customer name.
				 * @param string $to        Customer email address.
				 * @param string $phone_number Customer phone number.
				 * @param string $subject   Email Subject.
				 * @param string $message   Enquiry Message.
				 * @param string $author_email Product author email address.
				 * @param array  $_POST     POST data.
				 */
				do_action( 'pefree_product_enquiry_sent_success', $product_id, $variation_id, $name, $to, $phone_number, $subject, $message, $author_email, $_POST );

				echo esc_attr( apply_filters( 'pefree_enquiry_sent_message', __( 'Enquiry was sent successfully', 'product-enquiry-for-woocommerce' ) ) );
			} else {
				$error_code = -2;
				/**
				 * The action hook is executed if there is any server issue while delivering the email.
				 *
				 * @param int $error_code   If error code is -1, the user is unauthorized.
				 *                          If error code is -2, server issue while delivering the email.
				 */
				do_action( 'pe_product_enquiry_sent_error', $error_code );

				esc_attr_e( 'Unfortunately, a server issue prevented delivery of your message.', 'product-enquiry-for-woocommerce' );
			}
			die();
		}
		/**
		 * The action hook is executed if user is unauthorized.
		 *
		 * @param int $error_code   If error code is -1, the user is unauthorized.
		 *                          If error code is -2, server issue while delivering the email.
		 */
		do_action( 'pe_product_enquiry_sent_error', $error_code );

		die( esc_attr( __( 'Unauthorized access.', 'product-enquiry-for-woocommerce' ) ) );
	}
}
