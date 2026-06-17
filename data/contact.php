<?php
/**
 * SimpleModal Contact Form
 * http://simplemodal.com/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2012 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: contact-dist.php 269 2011-12-17 23:24:14Z emartin24 $
 *
 * @package ProductEnquiryForWooCommerce
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//date_default_timezone_set('America/Los_Angeles');

$pew_form_data = null;
$pew_to_adm    = null;
$pew_site_name = null;

if ( ( isset( $_POST['save_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_settings_nonce'] ) ), 'wdm-wpi-validation-nonce' ) ) || isset( $_POST['wdm_form_dataset'] ) ) {
	$pew_form_data = isset( $_POST['wdm_form_dataset'] ) ? sanitize_text_field( wp_unslash( $_POST['wdm_form_dataset'] ) ) : null;
}

if ( ( isset( $_POST['save_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_settings_nonce'] ) ), 'wdm-wpi-validation-nonce' ) ) || isset( $_POST['wdm_admin_email'] ) ) {
	$pew_to_adm = isset( $_POST['wdm_admin_email'] ) ? sanitize_email( wp_unslash( $_POST['wdm_admin_email'] ) ) : null;
}

if ( ( isset( $_POST['save_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_settings_nonce'] ) ), 'wdm-wpi-validation-nonce' ) ) || isset( $_POST['wdm_site_name'] ) ) {
	$pew_site_name = isset( $_POST['wdm_site_name'] ) ? sanitize_text_field( wp_unslash( $_POST['wdm_site_name'] ) ) : null;
}

// User settings.
$pew_to      = $pew_to_adm;
$pew_subject = '';

if ( ( isset( $_POST['save_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_settings_nonce'] ) ), 'wdm-wpi-validation-nonce' ) ) || ! empty( $pew_form_data['user_email'] ) ) {
	$pew_to = isset( $pew_form_data['user_email'] ) ? sanitize_email( $pew_form_data['user_email'] ) : $pew_to_adm;
}

if ( ( isset( $_POST['save_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_settings_nonce'] ) ), 'wdm-wpi-validation-nonce' ) ) || ! empty( $pew_form_data['default_sub'] ) ) {
	$pew_subject = isset( $pew_form_data['default_sub'] ) ? sanitize_text_field( $pew_form_data['default_sub'] ) : '';
} else {
	$pew_subject = 'Enquiry for a product from ' . $pew_site_name;
}


// Include extra form fields and/or submitter data?
// false = do not include.

$pew_extra = array(
	'form_subject' => true,
	'form_cc'      => ( isset( $pew_form_data['enable_send_mail_copy'] ) && 1 == $pew_form_data['enable_send_mail_copy'] ) ? true : false,
	'ip'           => false,
	'user_agent'   => false,
);

// Process.
$pew_action = '';
if ( ( isset( $_POST['save_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_settings_nonce'] ) ), 'wdm-wpi-validation-nonce' ) ) || isset( $_POST['action'] ) ) {
	$pew_action = isset( $_POST['action'] ) ? sanitize_text_field( wp_unslash( $_POST['action'] ) ) : '';
}

if ( empty( $pew_action ) ) {
	// Send back the contact form HTML.
	$pew_output = "<div style='display:none'>
	<div class='contact-top'></div>
	<div class='contact-content'>
		<h1 class='contact-title'>Product Enquiry:</h1>
		<div class='contact-loading' style='display:none'></div>
		<div class='contact-message' style='display:none'></div>
		<form action='#' style='display:none'>

			<input type='text' id='wdm_product_name' class='contact-input' name='wdm_product_name' value='' readonly=true />
			<label for='contact-name'>*Name:</label>
			<input type='text' id='contact-name' class='contact-input' name='name' tabindex='1001' />
			<label for='contact-email'>*Email:</label>
			<input type='text' id='contact-email' class='contact-input' name='email' tabindex='1002' />";

	if ( $pew_extra['form_subject'] ) {
		$pew_output .= "
			<label for='contact-subject'>Subject:</label>
			<input type='text' id='contact-subject' class='contact-input' name='subject' value='' tabindex='1003' />";
	}

	$pew_output .= "<input type='hidden' id='wdm_product_url' class='contact-input' name='wdm_product_url' value='' />";

	$pew_output .= "<input type='hidden' id='wdm_form_mail_to' class='contact-input' name='wdm_form_mail_to' value='' />";

	$pew_output .= "<input type='hidden' id='wdm_form_def_sub' class='contact-input' name='wdm_form_def_sub' value='' />";

	$pew_output .= "<input type='hidden' id='wdm_website_name' class='contact-input' name='wdm_website_name' value='' />";

	$pew_output .= "
			<label for='contact-message'>*Enquiry:</label>
			<textarea id='contact-message' class='contact-input' name='message' cols='40' rows='4' tabindex='1004'></textarea>
			<br/>";

	if ( $pew_extra['form_cc'] ) {
		$pew_output .= "
			<label>&nbsp;</label>
			<input type='checkbox' id='contact-cc' name='cc' value='1' tabindex='1005' /> <span class='contact-cc'>Send me a copy</span>
			<br/>";
	}

	$pew_output .= "
			<label>&nbsp;</label>
			<button type='submit' class='contact-send contact-button' tabindex='1006'>Send</button>
			<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1007'>Cancel</button>
			<br/>
			<input type='hidden' name='token' value='" . smcf_token( $pew_to ) . "'/>
		</form>
	</div>
	<div class='contact-bottom'><a href='http://wisdmlabs.com' target='_blank'>Powered by WisdmLabs</a></div>
</div>";

	echo esc_html( $pew_output );

	$pew_to_encoded      = base64_encode( $pew_to );
	$pew_subject_encoded = base64_encode( $pew_subject );
	$pew_site_name_enc   = base64_encode( $pew_site_name );

	echo '<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#wdm_form_mail_to").val("' . esc_js( $pew_to_encoded ) . '");
		jQuery("#wdm_form_def_sub").val("' . esc_js( $pew_subject_encoded ) . '");
		jQuery("#wdm_website_name").val("' . esc_js( $pew_site_name_enc ) . '");
	});
	</script>';
} elseif ( 'send' === $pew_action ) {
	// Send the email.
	$pew_name         = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$pew_email        = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$pew_subject_post = isset( $_POST['wdm_form_def_sub'] ) ? sanitize_text_field( wp_unslash( $_POST['wdm_form_def_sub'] ) ) : '';
	$pew_subject_post = base64_decode( $pew_subject_post );
	$pew_subject_post = ! empty( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : $pew_subject_post;
	$pew_product_url  = isset( $_POST['wdm_product_url'] ) ? esc_url_raw( wp_unslash( $_POST['wdm_product_url'] ) ) : '';
	$pew_product_name = isset( $_POST['wdm_product_name'] ) ? sanitize_text_field( wp_unslash( $_POST['wdm_product_name'] ) ) : '';
	$pew_message      = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$pew_cc           = isset( $_POST['cc'] ) ? sanitize_text_field( wp_unslash( $_POST['cc'] ) ) : '';
	$pew_token        = isset( $_POST['token'] ) ? sanitize_text_field( wp_unslash( $_POST['token'] ) ) : '';
	$pew_to_post      = isset( $_POST['wdm_form_mail_to'] ) ? sanitize_text_field( wp_unslash( $_POST['wdm_form_mail_to'] ) ) : '';
	$pew_to_post      = base64_decode( $pew_to_post );
	$pew_site_post    = isset( $_POST['wdm_website_name'] ) ? sanitize_text_field( wp_unslash( $_POST['wdm_website_name'] ) ) : '';
	$pew_site_post    = base64_decode( $pew_site_post );

	// Make sure the token matches.
	if ( $pew_token === smcf_token( $pew_to_post ) ) {
		pew_smcf_send( $pew_name, $pew_email, $pew_subject_post, $pew_product_url, $pew_product_name, $pew_site_post, $pew_message, $pew_cc, $pew_to_post, $pew_extra );
		echo 'Your enquiry sent successfully. We will get back to you soon.';
	} else {
		echo 'Unfortunately, your enquiry could not be verified.';
	}
}

/**
 * Generate token for verification.
 *
 * @param string $s String to generate token from.
 * @return string MD5 hash token.
 */
function smcf_token( $s ) {
	return md5( 'smcf-' . $s . gmdate( 'WY' ) );
}

/**
 * Validate and send email.
 *
 * @param string $name         Sender name.
 * @param string $email        Sender email.
 * @param string $subject      Email subject.
 * @param string $product_url  Product URL.
 * @param string $product_name Product name.
 * @param string $site_name    Site name.
 * @param string $message      Message body.
 * @param string $cc           CC flag.
 * @param string $to           Recipient email.
 * @param array  $extra        Extra options.
 */
function pew_smcf_send( $name, $email, $subject, $product_url, $product_name, $site_name, $message, $cc, $to, $extra ) {
	// Filter and validate fields.
	$name    = pew_smcf_filter( $name );
	$subject = pew_smcf_filter( $subject );
	$email   = pew_smcf_filter( $email );
	if ( ! pew_smcf_validate_email( $email ) ) {
		$subject .= ' - invalid email';
		$message .= "\n\nBad email: $email";
		$email    = $to;
		$cc       = 0; // Do not CC "sender".
	}

	// Add additional info to the message.
	if ( $extra['ip'] ) {
		$message .= "\n\nIP: " . ( isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '' );
	}
	if ( $extra['user_agent'] ) {
		$message .= "\n\nUSER AGENT: " . ( isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) ) : '' );
	}

	// Set and wordwrap message body.
	$body  = "Product Enquiry from <strong>" . $site_name . "</strong> <br /><br />";
	$body .= "<strong>Product Name:</strong> '" . $product_name . "'<br /><br />";
	$body .= "<strong>Product URL:</strong> " . $product_url . "<br /><br />";
	$body .= "<strong>Customer Name:</strong> " . $name . "<br /><br />";
	$body .= "<strong>Message:</strong> <br />" . $message;
	$body  = wordwrap( $body, 100 );

	// Build header.
	$headers = "From: $email\n";
	if ( 1 == $cc ) {
		$headers .= "Cc: $email\n";
	}
	$headers .= 'X-Mailer: PHP/SimpleModalContactForm';

	// UTF-8.
	if ( function_exists( 'mb_encode_mimeheader' ) ) {
		$subject = mb_encode_mimeheader( $subject, 'UTF-8', 'B', "\n" );
	}
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=utf-8\n";
	$headers .= "Content-Transfer-Encoding: quoted-printable\n";

	// Send email.
	// phpcs:ignore WordPress.WP.AlternativeFunctions.mail_mail
	@mail( $to, $subject, $body, $headers ) or
		die( 'Unfortunately, a server issue prevented delivery of your message.' );
}

/**
 * Remove any un-safe values to prevent email injection.
 *
 * @param string $value Value to filter.
 * @return string Filtered value.
 */
function pew_smcf_filter( $value ) {
	$pattern = array( "/\n/", "/\r/", '/content-type:/i', '/to:/i', '/from:/i', '/cc:/i' );
	$value   = preg_replace( $pattern, '', $value );
	return $value;
}

/**
 * Validate email address format.
 *
 * @param string $email Email to validate.
 * @return bool True if valid.
 */
function pew_smcf_validate_email( $email ) {
	$at = strrpos( $email, '@' );

	// Make sure the at (@) symbol exists and
	// it is not the first or last character.
	if ( $at && ( $at < 1 || ( $at + 1 ) == strlen( $email ) ) ) {
		return false;
	}

	// Make sure there aren't multiple periods together.
	if ( preg_match( '/(\.{2,})/', $email ) ) {
		return false;
	}

	// Break up the local and domain portions.
	$local  = substr( $email, 0, $at );
	$domain = substr( $email, $at + 1 );

	// Check lengths.
	$loc_len = strlen( $local );
	$dom_len = strlen( $domain );
	if ( $loc_len < 1 || $loc_len > 64 || $dom_len < 4 || $dom_len > 255 ) {
		return false;
	}

	// Make sure local and domain don't start with or end with a period.
	if ( preg_match( '/(^\.|\.$)/', $local ) || preg_match( '/(^\.|\.$)/', $domain ) ) {
		return false;
	}

	// Check for quoted-string addresses.
	// Since almost anything is allowed in a quoted-string address,
	// we're just going to let them go through.
	if ( ! preg_match( '/^"(.+)"$/', $local ) ) {
		// It's a dot-string address...check for valid characters.
		if ( ! preg_match( '/^[-a-zA-Z0-9!#$%*\/?|^{}`~\'+=_\.]*$/', $local ) ) {
			return false;
		}
	}

	// Make sure domain contains only valid characters and at least one period.
	if ( ! preg_match( '/^[-a-zA-Z0-9\.]*$/', $domain ) || ! strpos( $domain, '.' ) ) {
		return false;
	}

	return true;
}

exit;
