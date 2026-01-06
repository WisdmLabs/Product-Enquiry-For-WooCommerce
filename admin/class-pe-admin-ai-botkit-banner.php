<?php
/**
 * AI BotKit Promotional Banner
 *
 * This file handles the display and dismissal of the AI BotKit promotional banner.
 * To remove this promotion in the future, simply delete this file and remove
 * the include/hook from class-pe-admin-settings.php
 *
 * @package PE/Admin
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class for AI BotKit Promotional Banner.
 */
class PE_Admin_AI_BotKit_Banner {
	/**
	 * The single instance of the class.
	 *
	 * @var PE_Admin_AI_BotKit_Banner
	 */
	protected static $instance = null;

	/**
	 * Ensures only one instance of class is loaded or can be loaded.
	 *
	 * @return PE_Admin_AI_BotKit_Banner
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->hooks();
	}

	/**
	 * Register hooks
	 */
	public function hooks() {
		add_action( 'admin_notices', array( $this, 'render_ai_botkit_banner' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_banner_assets' ) );
		add_action( 'wp_ajax_pefree_dismiss_ai_banner', array( $this, 'dismiss_banner' ) );
	}

	/**
	 * Enqueue banner CSS and JS assets.
	 */
	public function enqueue_banner_assets() {
		// Only show on admin pages.
		if ( ! is_admin() ) {
			return;
		}

		// Check if banner should be shown.
		if ( ! $this->should_show_banner() ) {
			return;
		}

		// Enqueue styles.
		wp_enqueue_style(
			'pefree-ai-botkit-banner',
			WDM_PE_PLUGIN_URL . 'assets/admin/css/ai-botkit-banner.css',
			array(),
			PEFREE_VERSION
		);

		// Enqueue scripts.
		wp_enqueue_script(
			'pefree-ai-botkit-banner',
			WDM_PE_PLUGIN_URL . 'assets/admin/js/ai-botkit-banner.js',
			array( 'jquery' ),
			PEFREE_VERSION,
			true
		);

		// Localize script with nonce.
		wp_localize_script(
			'pefree-ai-botkit-banner',
			'pefreeAIBanner',
			array(
				'nonce' => wp_create_nonce( 'pefree_dismiss_ai_banner' ),
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	/**
	 * Check if banner should be displayed.
	 *
	 * @return bool
	 */
	private function should_show_banner() {
		// Only show to users who can manage options.
		if ( ! current_user_can( 'manage_options' ) ) {
			return false;
		}

		// Check if user has dismissed the banner.
		$user_id   = get_current_user_id();
		$dismissed = get_user_meta( $user_id, 'pefree_ai_botkit_banner_dismissed', true );
		if ( $dismissed ) {
			return false;
		}

		return true;
	}

	/**
	 * Render the AI BotKit promotional banner on Dashboard.
	 */
	public function render_ai_botkit_banner() {
		// Check if banner should be shown.
		if ( ! $this->should_show_banner() ) {
			return;
		}

		// Get image URLs.
		$logo_url  = WDM_PE_PLUGIN_URL . 'img/aibot/ai-botkit-logo.png';
		$right_url = WDM_PE_PLUGIN_URL . 'img/aibot/ai-botkit-banner.png';
		$cta_url   = 'https://aibotkit.io/ai-chatbot-for-wordpress/?utm_source=Woocommerce+free+plugin&utm_medium=Banner&utm_campaign=Banner+redirect&utm_id=Woocommerce+plugin';
		$nonce     = wp_create_nonce( 'pefree_dismiss_ai_banner' );
		?>
		<div class="notice notice-info mmrm-ai-botkit-banner" data-nonce="<?php echo esc_attr( $nonce ); ?>">
			<button type="button" class="mmrm-ai-banner-close" aria-label="Dismiss banner">&times;</button>
			<div class="mmrm-ai-banner-inner">
				<div class="mmrm-ai-banner-left">
					<div class="mmrm-ai-banner-logo">
						<img src="<?php echo esc_url( $logo_url ); ?>" alt="AI BotKit" />
					</div>
					<div class="mmrm-ai-banner-text">
						<h2>🤖 Turn your <strong>Inquiries</strong> into Sales with <strong>AI</strong></h2>
						<p style="margin-bottom: 15px;">Boost engagement with <strong>AI BotKit</strong> — a free ChatGPT-powered assistant that answers product questions, captures leads, and supports customers <strong>24/7</strong>. Quick setup, fully customizable, built for WordPress.</p>
						<p>
							<a class="button button-primary mmrm-ai-banner-cta" href="<?php echo esc_url( $cta_url ); ?>" target="_blank" rel="noopener noreferrer">✨ Get Free AI Chatbot</a>
						</p>
						<p class="mmrm-ai-banner-trust"><small>Built by <a href="https://wisdmlabs.com" target="_blank" rel="noopener noreferrer">WisdmLabs</a> · Trusted by 10,000+ users</small></p>
					</div>
				</div>
				<div class="mmrm-ai-banner-right">
					<img src="<?php echo esc_url( $right_url ); ?>" alt="AI BotKit Preview" />
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Handle banner dismissal via AJAX.
	 */
	public function dismiss_banner() {
		// Verify nonce.
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'pefree_dismiss_ai_banner' ) ) {
			wp_send_json_error( array( 'message' => __( 'Invalid nonce.', 'product-enquiry-for-woocommerce' ) ) );
		}

		// Check user capability.
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'message' => __( 'Insufficient permissions.', 'product-enquiry-for-woocommerce' ) ) );
		}

		// Save dismissal for current user.
		$user_id = get_current_user_id();
		update_user_meta( $user_id, 'pefree_ai_botkit_banner_dismissed', true );

		wp_send_json_success( array( 'message' => __( 'Banner dismissed.', 'product-enquiry-for-woocommerce' ) ) );
	}
}

