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
class PE_Admin_Settings_Enquiry_Details_Tab {
	/**
	 * $pfree_settings
	 *
	 * @var null
	 */
	public static $pfree_settings = null;
	/**
	 * __constructor
	 */
	public function __construct() {
	}
	/**
	 * The single instance of the class.
	 *
	 * @var pe_instance
	 */
	protected static $instance = null;
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
	 * This function is used to display content on tab entry_tab.
	 */
	public function entry_tab_functionality_helper() {
		?>
	<div id='entry_dummy'>
		<div class="layer_parent">
			<div class="pew_upgrade_layer">
				<div class="pew_uptp_cont">
					<p> <?php esc_attr_e( 'This feature is available in the PRO version. Click below to know more.', 'product-enquiry-for-woocommerce' ); ?></p>
					<a class="wdm_view_det_link" href="https://wisdmlabs.com/woocommerce-quotation-and-inquiry/?utm_source=pefreepremiumtab&utm_medium=pefreepremiumtab&utm_campaign=pefreepremiumtab&utm_term=pefreepremiumtab&utm_content=pefreepremiumtab" target="_blank"><?php esc_attr_e( 'View Details', 'product-enquiry-for-woocommerce' ); ?></a>
				</div>
			</div>
			<img src="<?php echo esc_attr( WDM_PE_PLUGIN_URL . 'assets/admin/img/entries.png' ); ?>" style='width:100%;'/>
		</div>
	</div>
		<?php
	}
}
