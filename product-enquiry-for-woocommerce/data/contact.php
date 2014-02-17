<?php

/*
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
 */

//date_default_timezone_set('America/Los_Angeles');

if(isset($_POST['wdm_form_dataset']))
{
	$form_data = $_POST['wdm_form_dataset'];
}

if(isset($_POST['wdm_admin_email']))
{
	$to_adm = $_POST['wdm_admin_email'];
}

if(isset($_POST['wdm_site_name']))
{
	$site_name = $_POST['wdm_site_name'];
}

// User settings
if (!empty($form_data['user_email']))
	$to = $form_data['user_email'];
else
	$to = $to_adm;
	
if (!empty($form_data['default_sub']))
	$subject = $form_data['default_sub'];
else
	$subject = "Enquiry for a product from ".$site_name;

	
 //Include extra form fields and/or submitter data?
 //false = do not include
 
$extra = array(
	"form_subject"	=> true,
	"form_cc"	=> ($form_data['enable_send_mail_copy'] == 1) ? true : false,
	"ip"		=> false,
	"user_agent"	=> false
);

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the contact form HTML
	$output = "<div style='display:none'>
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

	if ($extra["form_subject"]) {
		$output .= "
			<label for='contact-subject'>Subject:</label>
			<input type='text' id='contact-subject' class='contact-input' name='subject' value='' tabindex='1003' />";
	}
	
	$output .= "<input type='hidden' id='wdm_product_url' class='contact-input' name='wdm_product_url' value='' />";
	
	$output .= "<input type='hidden' id='wdm_form_mail_to' class='contact-input' name='wdm_form_mail_to' value='' />";
	
	$output .= "<input type='hidden' id='wdm_form_def_sub' class='contact-input' name='wdm_form_def_sub' value='' />";
	
	$output .= "<input type='hidden' id='wdm_website_name' class='contact-input' name='wdm_website_name' value='' />";
	
	$output .= "
			<label for='contact-message'>*Enquiry:</label>
			<textarea id='contact-message' class='contact-input' name='message' cols='40' rows='4' tabindex='1004'></textarea>
			<br/>";

	if ($extra["form_cc"]) {
		$output .= "
			<label>&nbsp;</label>
			<input type='checkbox' id='contact-cc' name='cc' value='1' tabindex='1005' /> <span class='contact-cc'>Send me a copy</span>
			<br/>";
	}

	$output .= "
			<label>&nbsp;</label>
			<button type='submit' class='contact-send contact-button' tabindex='1006'>Send</button>
			<button type='submit' class='contact-cancel contact-button simplemodal-close' tabindex='1007'>Cancel</button>
			<br/>
			<input type='hidden' name='token' value='" . smcf_token($to) . "'/>
		</form>
	</div>
	<div class='contact-bottom'><a href='http://wisdmlabs.com' target='_blank'>Powered by WisdmLabs</a></div>
</div>";
 
 echo $output;
 
 $to = base64_encode($to);
 $subject = base64_encode($subject);
 $site_name = base64_encode($site_name);
 
  echo '<script type="text/javascript">
 jQuery(document).ready(
		function()
		{
			jQuery("#wdm_form_mail_to").val("'.$to.'");
			jQuery("#wdm_form_def_sub").val("'.$subject.'");
			jQuery("#wdm_website_name").val("'.$site_name.'");
			
		}
		);
 </script>';
 	
}
else if ($action == "send") {
	// Send the email
	$name = isset($_POST["name"]) ? $_POST["name"] : "";
	$email = isset($_POST["email"]) ? $_POST["email"] : "";
	$subject = isset($_POST["wdm_form_def_sub"]) ? $_POST["wdm_form_def_sub"] : "";
	$subject = base64_decode($subject);
	$subject = !empty($_POST["subject"]) ? $_POST["subject"] : $subject;
	$product_url = isset($_POST["wdm_product_url"]) ? $_POST["wdm_product_url"] : "";
	$product_name = isset($_POST["wdm_product_name"]) ? $_POST["wdm_product_name"] : "";
	$message = isset($_POST["message"]) ? $_POST["message"] : "";
	$cc = isset($_POST["cc"]) ? $_POST["cc"] : "";
	$token = isset($_POST["token"]) ? $_POST["token"] : "";
	$to = isset($_POST["wdm_form_mail_to"]) ? $_POST["wdm_form_mail_to"] : "";
	$to = base64_decode($to);
	$site_name = isset($_POST["wdm_website_name"]) ? $_POST["wdm_website_name"] : "";
	$site_name = base64_decode($site_name);
	
	// make sure the token matches
	if ($token === smcf_token($to)) {
		smcf_send($name, $email, $subject, $product_url, $product_name, $site_name, $message, $cc);
		echo "Your enquiry sent successfully. We will get back to you soon.";
	}
	else {
		echo "Unfortunately, your enquiry could not be verified.";
	}
}

function smcf_token($s) {
	return md5("smcf-" . $s . date("WY"));
}

// Validate and send email
function smcf_send($name, $email, $subject, $product_url, $product_name, $site_name, $message, $cc) {
	global $to, $extra;

	// Filter and validate fields
	$name = smcf_filter($name);
	$subject = smcf_filter($subject);
	$email = smcf_filter($email);
	if (!smcf_validate_email($email)) {
		$subject .= " - invalid email";
		$message .= "\n\nBad email: $email";
		$email = $to;
		$cc = 0; // do not CC "sender"
	}

	// Add additional info to the message
	if ($extra["ip"]) {
		$message .= "\n\nIP: " . $_SERVER["REMOTE_ADDR"];
	}
	if ($extra["user_agent"]) {
		$message .= "\n\nUSER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
	}

	// Set and wordwrap message body
	$body = "Product Enquiry from <strong>". $site_name . "</strong> <br /><br />";
	$body .= "<strong>Product Name:</strong> '". $product_name ."'<br /><br />";
	$body .= "<strong>Product URL:</strong> ". $product_url ."<br /><br />";
	$body .= "<strong>Customer Name:</strong> ". $name ."<br /><br />";
	$body .= "<strong>Message:</strong> <br />". $message;
	$body = wordwrap($body, 100);

	// Build header
	$headers = "From: $email\n";
	if ($cc == 1) {
		$headers .= "Cc: $email\n";
	}
	$headers .= "X-Mailer: PHP/SimpleModalContactForm";

	// UTF-8
	if (function_exists('mb_encode_mimeheader')) {
		$subject = mb_encode_mimeheader($subject, "UTF-8", "B", "\n");
	}
	else {
		// you need to enable mb_encode_mimeheader or risk 
		// getting emails that are not UTF-8 encoded
	}
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=utf-8\n";
	$headers .= "Content-Transfer-Encoding: quoted-printable\n";

	// Send email
	@mail($to, $subject, $body, $headers) or 
		die("Unfortunately, a server issue prevented delivery of your message.");
}

// Remove any un-safe values to prevent email injection
function smcf_filter($value) {
	$pattern = array("/\n/","/\r/","/content-type:/i","/to:/i", "/from:/i", "/cc:/i");
	$value = preg_replace($pattern, "", $value);
	return $value;
}

// Validate email address format in case client-side validation "fails"
function smcf_validate_email($email) {
	$at = strrpos($email, "@");

	// Make sure the at (@) sybmol exists and  
	// it is not the first or last character
	if ($at && ($at < 1 || ($at + 1) == strlen($email)))
		return false;

	// Make sure there aren't multiple periods together
	if (preg_match("/(\.{2,})/", $email))
		return false;

	// Break up the local and domain portions
	$local = substr($email, 0, $at);
	$domain = substr($email, $at + 1);


	// Check lengths
	$locLen = strlen($local);
	$domLen = strlen($domain);
	if ($locLen < 1 || $locLen > 64 || $domLen < 4 || $domLen > 255)
		return false;

	// Make sure local and domain don't start with or end with a period
	if (preg_match("/(^\.|\.$)/", $local) || preg_match("/(^\.|\.$)/", $domain))
		return false;

	// Check for quoted-string addresses
	// Since almost anything is allowed in a quoted-string address,
	// we're just going to let them go through
	if (!preg_match('/^"(.+)"$/', $local)) {
		// It's a dot-string address...check for valid characters
		if (!preg_match('/^[-a-zA-Z0-9!#$%*\/?|^{}`~&\'+=_\.]*$/', $local))
			return false;
	}

	// Make sure domain contains only valid characters and at least one period
	if (!preg_match("/^[-a-zA-Z0-9\.]*$/", $domain) || !strpos($domain, "."))
		return false;	

	return true;
}

exit;

?>
