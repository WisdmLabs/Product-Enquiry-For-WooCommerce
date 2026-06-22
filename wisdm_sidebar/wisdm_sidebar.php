<?php
/**
 * WisdmLabs Sidebar
 *
 * @package ProductEnquiryForWooCommerce
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Create WisdmLabs sidebar.
 *
 * @param string $plugin_name     Plugin name.
 * @param string $wdm_plugin_slug Plugin slug.
 */
function pew_create_wisdm_sidebar( $plugin_name, $wdm_plugin_slug ) {
	wp_enqueue_script(
		'wdm_banner_fade_script',
		plugins_url( 'js/bjqs-1.3.min.js', __FILE__ ),
		array( 'jquery' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'js/bjqs-1.3.min.js' ),
		true
	);

	wp_enqueue_style(
		'wisdm_sidebar_css',
		plugins_url( 'wisdm_sidebar.css', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . 'wisdm_sidebar.css' )
	);

	wp_enqueue_script(
		'wdm_apprise_script',
		plugins_url( 'wdm_apprise_lib/apprise-1.5.full.js', __FILE__ ),
		array( 'jquery' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'wdm_apprise_lib/apprise-1.5.full.js' ),
		true
	);

	wp_enqueue_style(
		'wdm_apprise_style',
		plugins_url( 'wdm_apprise_lib/apprise.css', __FILE__ ),
		array(),
		filemtime( plugin_dir_path( __FILE__ ) . 'wdm_apprise_lib/apprise.css' )
	);
	?>

	<!--main starts-->
	<div id="wisdm_main_content">

		<!--container starts-->
		<div id="wisdm_container">
			<p>This plugin is brought to you by</p>

			<!--logo starts-->
			<a href="https://wisdmlabs.com" target="_blank"><div id="wdm-logo"></div></a> <!--logo ends-->

			<div class="hr"></div>

			<p>Rate this plugin</p>
			<a href="<?php echo esc_url( 'https://wordpress.org/support/view/plugin-reviews/' . $wdm_plugin_slug ); ?>" target="_blank"><div id="rating-stars"></div></a>

			<div class="hr"></div>

			<ul id="left-list">
				<li><a href="https://profiles.wordpress.org/WisdmLabs/" target="_blank">More Plugins</a></li>
				<li><a href="https://wisdmlabs.com" target="_blank">At WisdmLabs</a></li>
			</ul>

			<ul id="right-list">
				<li><a href="<?php echo esc_url( 'https://wordpress.org/support/plugin/' . $wdm_plugin_slug ); ?>" target="_blank">Support</a></li>
				<li><a href="https://wisdmlabs.com/services/" target="_blank">Services</a></li>
			</ul>

			<div class="clear"></div>
			<div class="hr"></div>

			<p id="text-left-align">Help improve this plugin by donating</p>
			<div id="wdm-donate">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_donations">
					<input type="hidden" name="business" value="info@wisdmlabs.com">
					<input type="hidden" name="lc" value="US">
					<input type="hidden" name="item_name" value="WisdmLabs Plugin Donation">
					<input type="hidden" name="no_note" value="0">
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
					<input type="image" src="<?php echo esc_url( plugins_url( 'images/paypal-donate.png', __FILE__ ) ); ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				</form>
			</div>

			<div class="clear"></div>
			<div class="hr"></div>

			<div id="ad">
				<!--  Outer wrapper for presentation only, this can be anything you like -->
				<div id="banner-fade">

					<!-- start Basic Jquery Slider -->
					<ul class="bjqs">
						<li><img src="<?php echo esc_url( plugins_url( 'images/wp-plugin-specialists.jpg', __FILE__ ) ); ?>"></li>
						<li><img src="<?php echo esc_url( plugins_url( 'images/api-programming.jpg', __FILE__ ) ); ?>"></li>
						<li><img src="<?php echo esc_url( plugins_url( 'images/eCommerce-solutions.jpg', __FILE__ ) ); ?>"></li>
						<li><img src="<?php echo esc_url( plugins_url( 'images/responsive-design.jpg', __FILE__ ) ); ?>"></li>
					</ul>

					<!-- end Basic jQuery Slider -->

				</div>
				<!-- End outer wrapper -->
			</div> <!--ad ends-->

			<div class="hr"></div>

			<p> <a id="enquiry-form"> Make Custom Development Enquiry </a> </p>

			<form id="cde-form" method="post" action="">
				<input type="text" name="cde-full-name" id="cde-full-name" placeholder="Full Name" class="required" />
				<input type="email" name="cde-email" id="cde-email" placeholder="Email" class="required email" />
				<input type="text" name="cde-site-url" id="cde-site-url" placeholder="Site URL" class="url" value="<?php echo esc_url( get_bloginfo( 'wpurl' ) ); ?>" />

				<textarea id="cde-message" name="cde-message" placeholder="Message" class="required" ></textarea>
				<input type="submit" id="cde-submit" name="cde-submit" value="Send" />
				<?php wp_nonce_field( 'wdm-wpi-validation-nonce', 'save_settings_nonce' ); ?>
			</form>

		</div> <!--container ends-->
	</div> <!--main ends-->

	<script type="text/javascript">

		jQuery(document).ready(function(){

			jQuery("#cde-form").hide();

			jQuery("#enquiry-form").click(function () {
				jQuery('#cde-form').slideToggle();
				jQuery('html, body').animate({scrollTop:jQuery(document).height()}, 'slow');
				return false;
			});
		});
	</script>

	<script class="secret-source">
		jQuery(document).ready(function($) {

			$('#banner-fade').bjqs({
				height        : 152,
				width         : 220,
				automatic     : true,
				animtype      : 'fade',
				animduration  : 1250,
				animspeed     : 3000,
				responsive    : true,
				showcontrols  : false,
				showmarkers   : false,
				centermarkers : true
			});

		});
	</script>

	<?php
	wp_enqueue_script(
		'wdm_cde_validation',
		plugins_url( 'js/wdm-validate.js', __FILE__ ),
		array( 'jquery' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'js/wdm-validate.js' ),
		true
	);
	?>

	<script type='text/javascript'>
		jQuery(document).ready(function() {

			jQuery('#cde-submit').click(
				function() {
					if ( jQuery('#cde-form').valid() == true ) {
						jQuery('#cde-submit').val('Sending ...');
					} else {
						jQuery('#cde-submit').val('Send');
					}
				}
			);
		});
	</script>

	<?php
	if ( ( isset( $_POST['save_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_settings_nonce'] ) ), 'wdm-wpi-validation-nonce' ) ) || isset( $_POST['cde-submit'] ) ) {
		$pew_to      = 'support@wisdmlabs.com';
		$pew_site_url = '';
		if ( ! empty( $_POST['cde-site-url'] ) ) {
			$pew_site_url_value = esc_url_raw( wp_unslash( $_POST['cde-site-url'] ) );
			$pew_site_url       = '<a href="' . $pew_site_url_value . '"' . $pew_site_url_value . '></a>';
		} else {
			$pew_site_url = 'Not specified';
		}
		$pew_user_name     = isset( $_POST['cde-full-name'] ) ? sanitize_text_field( wp_unslash( $_POST['cde-full-name'] ) ) : 'Not specified';
		$pew_user_email    = isset( $_POST['cde-email'] ) ? sanitize_email( wp_unslash( $_POST['cde-email'] ) ) : 'Not specified';
		$pew_enquiry_msg   = isset( $_POST['cde-message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['cde-message'] ) ) : 'Not specified';
		$pew_subject       = 'CDE for ' . $plugin_name;

		$pew_message  = '';
		$pew_message .= '<strong>Name:</strong> ' . $pew_user_name . '<br />';
		$pew_message .= '<strong>Email:</strong> ' . $pew_user_email . '<br />';
		$pew_message .= '<strong>Website URL:</strong> ' . $pew_site_url . '<br />';
		$pew_message .= '<strong>Referring Plugin:</strong> ' . $plugin_name . '<br /><br />';
		$pew_message .= '<strong>Enquiry message:</strong><br />' . $pew_enquiry_msg;

		add_filter( 'wp_mail_from', 'pew_wdm_mail_from' );
		add_filter( 'wp_mail_from_name', 'pew_wdm_mail_from_name' );
		add_filter( 'wp_mail_content_type', 'pew_cde_set_contenttype' );

		if ( wp_mail( $pew_to, $pew_subject, $pew_message, '', '' ) ) {
			echo '<script type="text/javascript">
				jQuery(document).ready(
					function() {
						apprise("Thank you for your enquiry. We\'ll get back to you soon. <br /><br /> <div class=\'wdm_cheers\' style=\'float:left;\'> Cheers! <br /> WisdmLabs Team </div>");
					}
				);
			</script>';
		} else {
			echo '<script type="text/javascript">
				jQuery(document).ready(
					function() {
						apprise("Sorry, Your enquiry could not be sent.");
					}
				);
			</script>';
		}
		remove_filter( 'wp_mail_from', 'pew_wdm_mail_from' );
		remove_filter( 'wp_mail_from_name', 'pew_wdm_mail_from_name' );
		remove_filter( 'wp_mail_content_type', 'pew_cde_set_contenttype' );
	}
}

/**
 * Set email content type.
 *
 * @return string Content type.
 */
function pew_cde_set_contenttype() {
	return 'text/html';
}

/**
 * Set email from address.
 *
 * @param string $email From email.
 * @return string From email.
 */
function pew_wdm_mail_from( $email ) {
	$pew_email = '';
	if (
		isset( $_POST['save_settings_nonce'] ) &&
		wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_settings_nonce'] ) ), 'wdm-wpi-validation-nonce' ) &&
		isset( $_POST['cde-email'] )
	) {
		$pew_email = sanitize_email( wp_unslash( $_POST['cde-email'] ) );
	}
	return $pew_email;
}

/**
 * Set email from name.
 *
 * @param string $name From name.
 * @return string From name.
 */
function pew_wdm_mail_from_name( $name ) {
	$pew_name = '';
	if (
		isset( $_POST['save_settings_nonce'] ) &&
		wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['save_settings_nonce'] ) ), 'wdm-wpi-validation-nonce' ) &&
		isset( $_POST['cde-full-name'] )
	) {
		$pew_name = sanitize_text_field( wp_unslash( $_POST['cde-full-name'] ) );
	}
	return $pew_name;
}
