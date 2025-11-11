<?php
/**
 * PEFree Admin
 *
 * @package  PEFREE/Admin
 * @version  3.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * PEFree Admin class
 */
class PE_Admin {
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
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'includes' ) );
		add_action( 'init', array( $this, 'init' ), 0 );
		add_action( 'admin_init', array( $this, 'reg_form_settings' ) );
	}
	/**
	 * File Includes.
	 */
	public function includes() {
		add_action( 'admin_enqueue_scripts', array( $this, 'reg_scripts_sheets' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'reg_styles_sheets' ) );
		include_once WDM_PE_PLUGIN_PATH . '/admin/admin-functions.php';
	}
	/**
	 * Initaize the classes.
	 */
	public function init() {
		PE_Admin_Settings::instance();
		PE_Admin_Newsletter_Subcribe::init();
		PE_Admin_Enquiry_Form_Ajax::instance();
	}
	/**
	 * Funtion to register form settings.
	 */
	public function reg_form_settings() {
		// register plugin settings.
		register_setting( 'wdm_form_options', 'wdm_form_data', array( 'sanitize_callback' => array( $this, 'sanitize_settings' ) ) );
	}

	/**
	 * Sanitize settings before saving to WordPress.
	 */
	public function sanitize_settings( $new_value ) {
		// Setting names which should be trimmed.
		$setting_names = array(
			'user_email',
			'default_sub',
			'custom_label',
			'enquiry_privacy_policy_text',
			'user_custom_css',
		);

		foreach ( $setting_names as $setting_name ) {
			$new_value[ $setting_name ] = normalize_whitespace( $new_value[ $setting_name ] );
			if ( 'user_custom_css' == $setting_name ) {
				// $new_value[ $setting_name ] = wp_strip_all_tags( $new_value[ $setting_name ] );
				$new_value[ $setting_name ] = filter_var($new_value[ $setting_name ], FILTER_SANITIZE_STRING);
			}
		}

		return $new_value;
	}

	/**
	 * To register stylesheets
	 */
	public function reg_styles_sheets() {
		wp_register_style( 'premium-style', WDM_PE_PLUGIN_URL . 'assets/admin/css/style.css', array(), PEFREE_VERSION );
		wp_register_style( 'premium-fontstyle', WDM_PE_PLUGIN_URL . 'assets/admin/css/font.css', array(), PEFREE_VERSION );
		wp_register_style( 'pefree-upsell', WDM_PE_PLUGIN_URL . 'assets/admin/css/upsell.css', array(), PEFREE_VERSION );
		wp_register_style( 'pefree-activation-popup', WDM_PE_PLUGIN_URL . 'assets/admin/css/activation-popup.css', array(), PEFREE_VERSION );
	}
	/**
	 * To register stylesheets
	 */
	public function reg_scripts_sheets() {
		$prefix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '/dist';
		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		wp_register_script( 'wdm-admin-notice-js', WDM_PE_PLUGIN_URL . 'assets/admin/js/notice.js', array( 'jquery' ), filemtime( WDM_PE_PLUGIN_PATH . 'assets/admin/js/notice.js' ), false );
		wp_register_script( 'wdm_wpi_validation', WDM_PE_PLUGIN_URL . 'assets/common/js/wdm_jquery.validate.min.js', array( 'jquery' ), filemtime( WDM_PE_PLUGIN_PATH . 'assets/common/js/wdm_jquery.validate.min.js' ), true );
		wp_register_script( 'viewportChecker-min', WDM_PE_PLUGIN_URL . 'assets/admin/js/jquery.viewportChecker.min.js', array( 'jquery' ), filemtime( WDM_PE_PLUGIN_PATH . 'assets/admin/js/jquery.viewportChecker.min.js' ), true );
		wp_register_script( 'debouncedResize', WDM_PE_PLUGIN_URL . 'assets/admin/js/jquery.debouncedresize.js', array( 'jquery' ), filemtime( WDM_PE_PLUGIN_PATH . 'assets/admin/js/jquery.debouncedresize.js' ), true );
		wp_register_script( 'wdm-pe-main', WDM_PE_PLUGIN_URL . 'assets/admin/js' . $prefix . '/main' . $suffix . '.js', array( 'jquery' ), filemtime( WDM_PE_PLUGIN_PATH . 'assets/admin/js' . $prefix . '/main' . $suffix . '.js' ), true );
		wp_register_script( 'wdm-settings', WDM_PE_PLUGIN_URL . 'assets/admin/js' . $prefix . '/settings' . $suffix . '.js', array( 'jquery' ), filemtime( WDM_PE_PLUGIN_PATH . 'assets/admin/js' . $prefix . '/settings' . $suffix . '.js' ), false );
		wp_register_script( 'wdm-subme-js', WDM_PE_PLUGIN_URL . 'assets/admin/js' . $prefix . '/wdm_subme' . $suffix . '.js', array( 'jquery' ), filemtime( WDM_PE_PLUGIN_PATH . 'assets/admin/js' . $prefix . '/wdm_subme' . $suffix . '.js' ), true );
		wp_register_script( 'pefree-upsell', WDM_PE_PLUGIN_URL . 'assets/admin/js/upsell.js', array( 'jquery' ), filemtime( WDM_PE_PLUGIN_PATH . 'assets/admin/js/upsell.js' ), true );
		wp_register_script( 'pefree-activation-popup', WDM_PE_PLUGIN_URL . 'assets/admin/js/activation-popup.js', array( 'jquery' ), filemtime( WDM_PE_PLUGIN_PATH . 'assets/admin/js/activation-popup.js' ), false );
	}
}
