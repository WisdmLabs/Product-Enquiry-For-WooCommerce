<?php
/**
 * PE Public
 *
 * @package  PEFree/Public
 * @version  3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * PE_Public class.
 */
class PE_Public {
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
	 * Constructor.
	 */
	public function __construct() {
		$this->includes();
		add_action( 'init', array( $this, 'init' ), 0 );
	}

	/**
	 * Includes file for frontend use.
	 */
	public function includes() {

		include_once WDM_PE_PLUGIN_PATH . '/public/public-functions.php';
	}
	/**
	 * Initialize frontend classes
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'reg_scripts_style' ) );
		add_action( 'wp_footer', array( $this, 'add_helpscout_beacon' ) );
		PE_Public_Enquiry_Button::instance();
	}
	/**
	 * [reg_scripts_style description]
	 */
	public function reg_scripts_style() {
		wp_register_style( 'wdm-juery-css', WDM_PE_PLUGIN_URL . 'assets/public/css/wdm-jquery-ui.css', array(), PEFREE_VERSION );
		wp_register_script( 'wdm-validate', WDM_PE_PLUGIN_URL . 'assets/common/js/wdm_jquery.validate.min.js', array(), PEFREE_VERSION, true );
		wp_register_script( 'wdm-contact', WDM_PE_PLUGIN_URL . 'assets/public/js/enquiry_validate.js', array( 'jquery' ), PEFREE_VERSION, true );
	}

	/**
	 * Add HelpScout Beacon code to footer.
	 */
	public function add_helpscout_beacon() {
		?>
		<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
		<script type="text/javascript">window.Beacon('init', 'fea56c43-0d44-4a4e-9715-1b1f20d6dcdf')</script>
		<?php
	}
}
