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
	 * Activation popup data to be output in footer.
	 *
	 * @var array
	 */
	private $activation_popup_data = null;
	/**
	 * __constructor
	 */
	public function __construct() {
		$this->hooks();
		PE_Admin_Settings_Products::instance();
		// Initialize AI BotKit banner (can be removed by deleting the file).
		if ( file_exists( WDM_PE_PLUGIN_PATH . '/admin/class-pe-admin-ai-botkit-banner.php' ) ) {
			include_once WDM_PE_PLUGIN_PATH . '/admin/class-pe-admin-ai-botkit-banner.php';
			PE_Admin_AI_BotKit_Banner::instance();
		}
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
		// Beacon Icon hook - use admin_footer to ensure script loads properly
		add_action( 'admin_footer', array( $this, 'add_beacon_helpscout_script' ) );
		add_action( 'admin_notices', array( $this, 'privacy_admin_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_activation_popup' ), 999 );
		add_filter( 'plugin_action_links_' . plugin_basename( WDM_PE_PLUGIN ), 'PE_Admin_Plugin_Links::plugin_action_links' );
		add_filter( 'plugin_row_meta', 'PE_Admin_Plugin_Links::plugin_row_meta', 10, 2 );
	}
	
	/**
	 * Add the Helpscout Beacon script on the PE Free settings page only.
	 * Only displays on the settings page, not on any other admin pages or frontend.
	 */
	public function add_beacon_helpscout_script () {
		// Ensure we're in admin area
		if ( ! is_admin() ) {
			return;
		}
		
		// Get current screen
		$screen = get_current_screen();
		if ( ! $screen ) {
			return;
		}
		
		// Only show beacon on PE Free settings page
		// Check both page parameter and screen ID for extra security
		$is_settings_page = false;
		if ( isset( $_GET['page'] ) && 'product-enquiry-for-woocommerce' === $_GET['page'] ) {
			$is_settings_page = true;
		}
		
		// Verify screen ID matches settings page
		if ( $is_settings_page && 'toplevel_page_product-enquiry-for-woocommerce' !== $screen->id ) {
			// Double check - if screen ID doesn't match, don't show
			return;
		}
		
		// Final check - only proceed if we're on the settings page
		if ( ! $is_settings_page ) {
			return;
		}
		
		?>
		<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
		<script type="text/javascript">window.Beacon('init', 'fea56c43-0d44-4a4e-9715-1b1f20d6dcdf')</script>
		<?php
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
	 * Enqueue activation popup scripts and styles.
	 */
	public function enqueue_activation_popup() {
		// Allow developers to disable the activation popup via filter.
		// Usage: add_filter( 'pefree_show_activation_popup', '__return_false' );
		if ( ! apply_filters( 'pefree_show_activation_popup', true ) ) {
			return;
		}

		// Check if banner should be shown and user has permission.
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Get screen info first
		$screen = get_current_screen();
		if ( ! $screen ) {
			return;
		}
		
		// Check if we're on the Product Enquiry settings page
		$is_pe_settings_page = false;
		if ( isset( $_GET['page'] ) && 'product-enquiry-for-woocommerce' === $_GET['page'] ) {
			$is_pe_settings_page = true;
		}
		
		// Check screen ID (WordPress uses 'toplevel_page_' prefix for top-level menu pages)
		$screen_id = $screen->id;
		$is_pe_screen = ( 'toplevel_page_product-enquiry-for-woocommerce' === $screen_id || false !== strpos( $screen_id, 'product-enquiry' ) );
		
		// Show on Product Enquiry settings page, dashboard, or plugins page
		$allowed_screens = array( 'plugins', 'dashboard' );
		$is_allowed_screen = in_array( $screen_id, $allowed_screens, true );
		
		// Only proceed if we're on an allowed screen
		if ( ! $is_pe_settings_page && ! $is_pe_screen && ! $is_allowed_screen ) {
			return;
		}

		// Check if transient is set (plugin was recently activated).
		// Also allow manual trigger via URL parameter for testing: ?pefree_show_popup=1
		$show_popup = get_transient( 'wdm_pefree_show_activation_banner' );
		$manual_trigger = isset( $_GET['pefree_show_popup'] ) && '1' === $_GET['pefree_show_popup'];
		
		// Check if we should show popup on next load (set during activation)
		$show_on_next_load = get_option( 'wdm_pefree_show_popup_on_next_load', false );
		if ( $show_on_next_load ) {
			// Clear the flag
			delete_option( 'wdm_pefree_show_popup_on_next_load' );
			// Set transient
			set_transient( 'wdm_pefree_show_activation_banner', true, 7 * DAY_IN_SECONDS );
			$show_popup = true;
		}
		
		// Fallback: Check if plugin was activated recently (within last hour)
		$activation_time = get_option( 'wdm_pefree_activation_time', 0 );
		$recently_activated = false;
		if ( $activation_time > 0 && ! $show_popup ) {
			$time_since_activation = current_time( 'timestamp' ) - $activation_time;
			// Show popup if activated within last hour
			if ( $time_since_activation < HOUR_IN_SECONDS ) {
				$recently_activated = true;
				// Set transient
				set_transient( 'wdm_pefree_show_activation_banner', true, 7 * DAY_IN_SECONDS );
				$show_popup = true;
			}
		}
		
		// On PE settings page, always show if transient is set (recently activated)
		// Otherwise, check if dismissed
		$dismissed = get_option( 'wdm_pefree_activation_banner_dismissed', false );
		if ( $dismissed && ! $show_popup && ! $manual_trigger && ! $recently_activated ) {
			return;
		}
		
		if ( ! $show_popup && ! $manual_trigger && ! $recently_activated ) {
			return;
		}

		// Prepare data for popup first.
		$img = WDM_PE_PLUGIN_URL . 'assets/admin/img/star.png';
		$rating_text = sprintf( __( 'Rated %s4.8', 'product-enquiry-for-woocommerce' ), '<img src=' . esc_attr( $img ) . ' />' );
		$hp_customers = sprintf( __( 'Trusted by %1$s3180+%2$s happy customers', 'product-enquiry-for-woocommerce' ), '<span class="hp-cust-number"><b>', '</b></span>' );

		$nonce = wp_create_nonce( 'wdm-dismiss-notice' );
		
		// Enqueue popup styles and scripts.
		wp_enqueue_style( 'pefree-activation-popup' );
		wp_enqueue_script( 'pefree-activation-popup' );
		
		// Prepare localization data.
		$localize_data = array(
			'showPopup'     => true,
			'proUrl'        => 'https://wisdmlabs.com/woocommerce-quotation-and-inquiry/?utm_source=pefree_activation&utm_medium=activation_popup&utm_campaign=pefree_activation&utm_term=activation_popup&utm_content=activation_popup',
			'demoUrl'       => 'https://wisdmlabs.com/pep-demo/',
			'ratingText'    => $rating_text,
			'customersText' => $hp_customers,
			'dismissNonce'  => $nonce,
		);
		
		// Store data for output
		$this->activation_popup_data = $localize_data;
		
		// Output data directly when scripts are printed (runs right before scripts)
		add_action( 'admin_print_scripts', array( $this, 'output_activation_popup_data' ), 5 );
		
		// Also try wp_localize_script as backup
		wp_localize_script(
			'pefree-activation-popup',
			'pefreeActivationPopup',
			$localize_data
		);
	}

	/**
	 * Output activation popup data in admin footer.
	 */
	public function output_activation_popup_data() {
		if ( isset( $this->activation_popup_data ) ) {
			?>
			<script type="text/javascript">
			/* <![CDATA[ */
			window.pefreeActivationPopup = <?php echo wp_json_encode( $this->activation_popup_data ); ?>;
			/* ]]> */
			</script>
			<?php
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

			if ( 'wdm_privacy_notice_dismissed' === $notice_id ) {
				update_option( 'wdm_privacy_notice_dismissed', 1 );
			} elseif ( 'wdm_pefree_activation_banner_dismissed' === $notice_id ) {
				update_option( 'wdm_pefree_activation_banner_dismissed', 1 );
				delete_transient( 'wdm_pefree_show_activation_banner' );
			}
		}
		die( 1 );
	}
}
