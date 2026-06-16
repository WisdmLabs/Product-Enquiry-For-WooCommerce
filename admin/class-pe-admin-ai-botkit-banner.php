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

		// Check if user has dismissed the banner after current activation.
		$user_id         = get_current_user_id();
		$dismissed_time  = (int) get_user_meta( $user_id, 'pefree_ai_botkit_banner_dismissed', true );
		$activation_time = (int) get_option( 'wdm_pefree_activation_time', 0 );

		// If dismissed after activation, don't show.
		if ( $dismissed_time && $dismissed_time >= $activation_time ) {
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

		$cta_url = 'https://aibotkit.io/ai-chatbot-for-wordpress/?utm_source=Woocommerce+free+plugin&utm_medium=Banner&utm_campaign=Banner+redirect&utm_id=Woocommerce+plugin';
		$nonce   = wp_create_nonce( 'pefree_dismiss_ai_banner' );
		?>
		<div class="notice notice-info mmrm-ai-botkit-banner" data-nonce="<?php echo esc_attr( $nonce ); ?>">
			<button type="button" class="mmrm-ai-banner-close" aria-label="Dismiss banner">&times;</button>
			<div class="mmrm-ai-banner-inner">
				<!-- Logo -->
				<div class="mmrm-ai-banner-logo-block">
					<div class="mmrm-ai-banner-logo-icon">🤖</div>
					<div class="mmrm-ai-banner-logo-label">AI Bot Kit</div>
				</div>

				<div class="mmrm-ai-banner-divider"></div>

				<!-- Content -->
				<div class="mmrm-ai-banner-content">
					<div class="mmrm-ai-banner-eyebrow">
						<span class="mmrm-ai-banner-eyebrow-dot"></span>
						New — free with your plugin
					</div>
					<h2 class="mmrm-ai-banner-headline">Your Product Enquiry plugin<br>just got <em>a lot smarter.</em></h2>
					<p class="mmrm-ai-banner-body-text">
						Meet <strong>AI BotKit</strong> — now included free. It answers product questions instantly, captures leads before they leave, and hands off to your enquiry inbox when a human touch is needed.
					</p>
					<div class="mmrm-ai-banner-cta-row">
						<a href="<?php echo esc_url( $cta_url ); ?>" class="mmrm-ai-banner-btn-primary" target="_blank" rel="noopener noreferrer">
							<span class="mmrm-ai-banner-btn-icon">✦</span>
							Set up AI BotKit free
						</a>
						<span class="mmrm-ai-banner-trust-line">No extra cost · <strong>5-minute setup</strong> · Works out of the box</span>
					</div>
				</div>

				<!-- Chat mockup -->
				<div class="mmrm-ai-banner-chat-mock">
					<div class="mmrm-ai-banner-new-badge">New</div>
					<div class="mmrm-ai-banner-chat-widget">
						<div class="mmrm-ai-banner-chat-header">
							<div class="mmrm-ai-banner-chat-header-left">
								<div class="mmrm-ai-banner-chat-avatar">AI</div>
								<div>
									<div class="mmrm-ai-banner-chat-title">Product Assistant</div>
									<div class="mmrm-ai-banner-chat-status">● Online now</div>
								</div>
							</div>
							<div class="mmrm-ai-banner-chat-controls">
								<span>⊕</span>
								<span>×</span>
							</div>
						</div>
						<div class="mmrm-ai-banner-chat-body">
							<div class="mmrm-ai-banner-msg mmrm-ai-banner-msg-user">Does this come in bulk pricing?</div>
							<div class="mmrm-ai-banner-msg mmrm-ai-banner-msg-bot">Yes! Orders over 50 units get 15% off. Want me to send you a quote?</div>
							<div class="mmrm-ai-banner-typing"><span></span><span></span><span></span></div>
						</div>
						<div class="mmrm-ai-banner-chat-input-row">
							<div class="mmrm-ai-banner-chat-input">Type a message…</div>
							<div class="mmrm-ai-banner-send-btn">➤</div>
						</div>
					</div>
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

		// Save dismissal timestamp for current user.
		$user_id = get_current_user_id();
		update_user_meta( $user_id, 'pefree_ai_botkit_banner_dismissed', current_time( 'timestamp' ) );

		wp_send_json_success( array( 'message' => __( 'Banner dismissed.', 'product-enquiry-for-woocommerce' ) ) );
	}
}

