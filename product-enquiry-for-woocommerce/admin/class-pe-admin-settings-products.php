<?php
/**
 * This class creates setting page functionality for Product enquiry
 *
 * @package PE/Admin
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class for PEFree Settings page.
 */
class PE_Admin_Settings_Products {
	/**
	 * The single instance of the class.
	 *
	 * @var pe_instance
	 */
	protected static $instance = null;
	/**
	 * __constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'pefree_menu_page' ) );
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
	 * Adds PFREE settings menu page.
	 *
	 * @return void
	 */
	public function pefree_menu_page() {
		// Fine original icon here. WDM_PE_PLUGIN_URL . 'assets/admin/img/pep-icon.svg'
		$pep_menu_icon = 'PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyNyAzNSIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4NCjxwYXRoIGQ9Ik0xMy43NzM4IDYuMTkyMDdDMTMuODgzMyA2LjIwMzE5IDEzLjk4MTkgNi4yMTQzMiAxNC4wOTE0IDYuMjM2NTdDMTUuNzQ1MSAzLjg1NTYzIDE3LjE1NzggMS44MTk2IDE3LjE1NzggMS44MDg0N0MxNS4zNTA4IDAuOTk2MjgzIDEzLjI3IDAuNzUxNTE0IDExLjIwMDEgMS4yNjMzQzcuMTY5OTIgMi4yNDIzOCA0LjI3ODY4IDUuNzkxNTMgNC4wNDg2OSA5Ljk1MjYxQzQuMDI2NzkgMTAuMjc1MyA0LjI3ODY4IDEwLjU0MjMgNC41ODUzMiAxMC41NDIzSDguNzAzMTVDOC45MjIxOSA3LjkxNjU4IDExLjIwMDEgNS45Njk1NSAxMy43NzM4IDYuMTkyMDdaIiBmaWxsPSIjOEM4QzhDIi8+DQo8cGF0aCBkPSJNMi4wNzczOSAyOS4xNzgxTDEzLjA0IDI0LjQwNTFMMjUuOTMwMSAyOC4zMjE0TDE2LjM4MDMgMzQuODc0NkwyLjA3NzM5IDI5LjE3ODFaIiBmaWxsPSIjOEM4QzhDIi8+DQo8cGF0aCBkPSJNMi4wNzczOSAyNy43NDI5TDEzLjM1NzYgMjIuMTM1NEwyNS45MzAxIDI4LjMyMTRMMTYuODA3NCAzNC40Mjk1TDIuMDc3MzkgMjcuNzQyOVoiIGZpbGw9IiM5QkEwQTYiLz4NCjxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBkPSJNMTMuMzU2NSAyMS41ODEzTDI2LjkyMDQgMjguMjU1MUwxNi44NTI4IDM0Ljk5NThMMC45MjA0MSAyNy43NjM0TDEzLjM1NjUgMjEuNTgxM1pNMTMuMzU4NyAyMi42ODk2TDMuMjM0MzkgMjcuNzIyNEwxNi43NjIgMzMuODYzMkwyNC45Mzk5IDI4LjM4NzhMMTMuMzU4NyAyMi42ODk2WiIgZmlsbD0iI0NGQ0ZDRSIvPg0KPHBhdGggZD0iTTQuNDk3NzMgMTAuNjUzNUw1LjA1NjI2IDEwLjc4NzFDNS4wNTYyNiAxMC43ODcxIDUuOTc2MiAtMC42ODM3MTUgMTcuMTQ2OSAxLjY2Mzg0TDEwLjc4NCAxLjUwODA4TDcuMTY5OTQgMy42MjJMNS42MjU3NSA1Ljc2OTI5TDQuMTkxMDggMTAuMDc1QzQuMTAzNDcgMTAuMzE5OCA0LjI0NTg0IDEwLjU4NjggNC40OTc3MyAxMC42NTM1WiIgZmlsbD0iIzhDOEM4QyIvPg0KPHBhdGggZD0iTTIzLjQ5ODkgOC41Mjg0OUMyMi4yOTQyIDMuNDMyODQgMTcuMjU2NCAwLjI4NDIxNiAxMi4yMjk2IDEuNTA4MDZDOC4wMTMyIDIuNTMxNjQgNS4wNDUyOSA2LjM3MDA3IDUuMDY3MiAxMC43ODdIOS4yMzk3OUM5LjUxMzU4IDEwLjc4NyA5Ljc1NDUxIDEwLjU4NjggOS43OTgzMiAxMC4zMTk4QzEwLjIzNjQgNy45Mzg4MiAxMi4zODI5IDYuMjM2NTYgMTQuODAzMiA2LjQ0Nzk1QzE3LjM4NzggNi42NzA0NyAxOS4yOTM0IDguOTczNTIgMTkuMDc0NCAxMS41OTkyQzE4Ljk3NTggMTIuMTExIDE4Ljc3ODcgMTIuNjExNyAxOC41MTU5IDEzLjA2NzhDMTcuNTc0IDE0LjcyNTYgMTUuNzg4OSAxNS43NDkyIDE0LjAwMzggMTYuMjI3NkwxMi4yMjk2IDE2LjU4MzZDMTIuMTQyIDE2LjYwNTkgMTIuMDY1MyAxNi42ODM4IDEyLjA2NTMgMTYuNzgzOVYxNy42NTE3VjE3LjcyOTZWMjIuNjY5NUgxNi43NDE3VjE5Ljk2NTlDMjEuNjkxOCAxOC42NTMgMjQuNjkyNiAxMy41Njg1IDIzLjQ5ODkgOC41Mjg0OVoiIGZpbGw9IiM5OTlFQTMiLz4NCjxwYXRoIGQ9Ik01LjYxNDggNy41MjcxNUw0LjUwODY4IDcuNTE2MDJDNC41MDg2OCA3LjUxNjAyIDQuMTI1MzcgOC41ODQxMSA0LjA0ODcxIDEwLjAzMDVDNC4wMzc3NiAxMC4zMTk3IDQuMjIzOTMgMTAuNTg2OCA0LjUwODY4IDEwLjY1MzVMNS4wNjcyMSAxMC43ODdDNS4wNjcyMSAxMC43ODcgNS41MjcxOCA3Ljk4MzMxIDUuNjE0OCA3LjUyNzE1WiIgZmlsbD0iIzQzNDM0MyIvPg0KPHBhdGggZD0iTTEwLjk3MDIgMTYuNTA1N1YyMS45MTI5QzEwLjk3MDIgMjEuOTU3NCAxMC45OTIxIDIyLjAwMTkgMTEuMDI0OSAyMi4wMjQyTDExLjg5MDEgMjIuNTQ3MUMxMS45NjY4IDIyLjU5MTYgMTIuMDc2MyAyMi41MzYgMTIuMDc2MyAyMi40NDdMMTIuMTUyOSAxNi43MjgzQzEyLjE1MjkgMTYuNjcyNiAxMi4yMjk2IDE2LjYxNyAxMi4xNzQ5IDE2LjYwNTlMMTEuMTEyNSAxNi40MDU2QzExLjAzNTkgMTYuMzcyMiAxMC45NzAyIDE2LjQyNzkgMTAuOTcwMiAxNi41MDU3WiIgZmlsbD0iIzhDOEM4QyIvPg0KPHBhdGggZD0iTTEwLjk3MDIgMjEuODEyOFYyNS4zMzk3TDEyLjA3NjMgMjUuNzYyNVYyMS45Nzk3TDEwLjk3MDIgMjEuODEyOFoiIGZpbGw9IiM0MzQzNDMiLz4NCjxwYXRoIGQ9Ik01LjYxNDc4IDcuNTI3MTZDNS42MTQ3OCA3LjUyNzE2IDYuMDQxODkgNi4zMTQ0NCA2LjM1OTQ5IDUuOTEzOTFMMTAuOTM3MyA3Ljk5NDQ1QzEwLjkzNzMgNy45OTQ0NSAxMC43NjIxIDguMTgzNTkgMTAuMTU5NyA5LjIwNzE3TDUuNjE0NzggNy41MjcxNloiIGZpbGw9IndoaXRlIi8+DQo8cGF0aCBkPSJNNS42MTQ3OSA3LjUyNzE4TDQuNTA4NjcgNy41MTYwNUM0LjUwODY3IDcuNTE2MDUgNC42MDcyMyA3LjAyNjUxIDUuMTMyOTEgNi4wMjUxOUw2LjM3MDQ1IDUuOTAyOEM2LjM3MDQ1IDUuOTEzOTMgNi4xNDA0NyA2LjA5MTk0IDUuNjE0NzkgNy41MjcxOFoiIGZpbGw9IiNFMkUyRTIiLz4NCjxwYXRoIGQ9Ik0xMS4wNzk3IDE2LjQwNTZDMTEuMDY4NyAxNi40MDU2IDExLjA2ODcgMTYuMzgzNCAxMS4wNzk3IDE2LjM4MzRDMTEuODc5MSAxNi40MDU2IDE3LjY5NDUgMTYuMzk0NSAxOC44NTU0IDExLjcxMDVDMTkuMDE5NiAxMS4wNTQxIDE5LjEwNzIgOS41NzQzMyAxNy45MDI2IDguMDA1NThDMTcuOTAyNiA4LjAwNTU4IDE5LjMyNjMgOS42MDc3MSAxOS4zMTUzIDExLjQ0MzVDMTkuMzA0NCAxMy4xNzkxIDE3Ljk5MDIgMTUuNjkzNiAxNC42OTM3IDE2LjMxNjZDMTMuOTA1MiAxNi40NjEyIDEzLjEyNzYgMTYuNjM5MyAxMi4wODcyIDE2LjYxN0wxMS4wNzk3IDE2LjQwNTZaIiBmaWxsPSIjOEM4QzhDIi8+DQo8cGF0aCBkPSJNMTYuNzUyNiAyMi4wMDJIMTIuMDc2M1YyNS43NjI1SDE2Ljc1MjZWMjIuMDAyWiIgZmlsbD0iIzVFNUY1RiIvPg0KPHBhdGggZD0iTTEyLjA3NjMgMjUuNzYyNUwxNC4wMDM4IDMwLjExMjdDMTQuMDM2NiAzMC4yMTI5IDE0LjE3OSAzMC4yMTI4IDE0LjIxMTkgMzAuMTAxNkwxNi43NDE3IDI1Ljc1MTRIMTIuMDc2M1YyNS43NjI1WiIgZmlsbD0iIzVFNUY1RiIvPg0KPHBhdGggZD0iTTEyLjA3NjMgMjUuNzYyNUwxNC4wMDM4IDMwLjExMjdMMTAuOTcwMiAyNS4zMzk3TDEyLjA3NjMgMjUuNzYyNVoiIGZpbGw9IiMzNTM1MzUiLz4NCjxwYXRoIGQ9Ik01LjYxNDc4IDcuNTI3MTZMMTAuMTU5NyA5LjE5NjA0QzEwLjE1OTcgOS4xOTYwNCA5LjkyOTc0IDkuNjg1NTggOS43OTgzMiAxMC4zMDg2QzkuNzQzNTYgMTAuNTg2OCA5LjUxMzU4IDEwLjc3NTkgOS4yMzk3OSAxMC43NzU5SDUuMDY3MkM1LjA2NzIgMTAuNzg3IDUuMzYyODkgOC4yOTQ4NSA1LjYxNDc4IDcuNTI3MTZaIiBmaWxsPSIjNUU1RjVGIi8+DQo8L3N2Zz4NCg==';

		add_menu_page( __( 'Product Enquiry', 'product-enquiry-for-woocommerce' ), __( 'Product Enquiry', 'product-enquiry-for-woocommerce' ), 'manage_options', 'product-enquiry-for-woocommerce', array( $this, 'add_ask_product_settings' ), 'data:image/svg+xml;base64,' . $pep_menu_icon, 59 );
	}
	/**
	 * Function to addproduct settings to admin menu this is callback method called on add_menu_page method.
	 */
	public function add_ask_product_settings() {

		wp_enqueue_script( 'wdm_wpi_validation' );
		$nonce = wp_create_nonce( 'wdm-wpi-validation-nonce' );
		wp_localize_script( 'wdm_wpi_validation', 'wdm_wpi_validation_nonce', array( 'nonce' => $nonce ) );
		wp_enqueue_script( 'postbox' );
		?>
		<div class="wrap wdm_leftwrap">
			<?php
			if ( isset( $_POST['save_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( $_POST['save_settings_nonce'] ), 'wdm-wpi-validation-nonce' ) && isset( $_GET['tab'] ) ) {
				$active_tab = sanitize_text_field( $_GET['tab'] );
			} else {
				$active_tab = 'form';
			}

			$dashboard_tabs = array(
				'form'             => array(
					'title' => __( 'Enquiry Settings', 'product-enquiry-for-woocommerce' ),
					'class' => 'enquiry-settings-tab',
				),
				'quotation'        => array(
					'title' => __( 'Quotation', 'product-enquiry-for-woocommerce' ),
					'class' => 'quotation-tab',
				),
				'entry'            => array(
					'title' => __( 'Enquiry Details', 'product-enquiry-for-woocommerce' ),
					'class' => 'enquiry-details-tab',
				),
				'other_extensions' => array(
					'title' => __( 'Other Extensions', 'product-enquiry-for-woocommerce' ),
					'class' => 'other-extensions-tab',
				),
			);
			$dashboard_tabs = apply_filters( 'product_enquiry_dashboard_tab_titles', $dashboard_tabs );
			?>
		<h2 class="nav-tab-wrapper">  
			<?php
			foreach ( $dashboard_tabs as $single_tab_slug => $single_tab_title ) {
				/* translators: sup HTML tag */
				$sup_pro = ( 'quotation' === $single_tab_slug ) || ( 'entry' === $single_tab_slug ) ? sprintf( __( '%1$s PRO %2$s', 'product-enquiry-for-woocommerce' ), '<sup>', '</sup>' ) : '';
				?>
				<a href="admin.php?page=product-enquiry-for-woocommerce&tab=<?php echo esc_attr( $single_tab_slug ); ?>" class="nav-tab <?php echo esc_attr( $active_tab === $single_tab_slug ? 'nav-tab-active' : '' ); ?> <?php echo esc_attr( $single_tab_title['class'] ); ?>">
					<?php
						echo esc_html( $single_tab_title['title'] );
						echo wp_kses_post( $sup_pro );
					?>
				</a>
			<?php } ?>
			<a href="admin.php?page=product-enquiry-for-woocommerce&tab=premium" class="premium nav-tab <?php echo esc_attr( ( 'premium' === $active_tab ) ? 'nav-tab-active' : '' ); ?>"><?php esc_attr_e( 'Premium Version', 'product-enquiry-for-woocommerce' ); ?></a>
		</h2>  
			<?php
			if ( 'entry' === $active_tab ) {
				$form_tab = PE_Admin_Settings_Enquiry_Details_Tab::instance();
				$form_tab->entry_tab_functionality_helper();
			} elseif ( 'other_extensions' === $active_tab ) {
				$form_tab = PE_Admin_Settings_Other_Extensions_Tab::instance();
				$form_tab->other_extensions_tab_functionality_helper();
			} elseif ( 'premium' === $active_tab ) {
				$form_tab = PE_Admin_Settings_Premium_Tab::instance();
				$form_tab->premium_tab_functionality_helper();

			} elseif ( 'form' === $active_tab ) {
				render_pro_banner();
				$form_tab = PE_Admin_Settings_Form_Tab::instance();
				$form_tab->form_tab_functionality_helper();
			} elseif ( 'quotation' === $active_tab ) {
				render_pro_banner();
				$form_tab = PE_Admin_Settings_Quotation_Tab::instance();
				$form_tab->quotation_tab_functionality_helper();
			}
			do_action( 'product_enquiry_tab_content', $active_tab );
			?>
		</div>
		<?php
		PE_Admin_Newsletter_Subcribe::generate_form();
		// add styles for settings page.
		wp_enqueue_style( 'wdm-admin-css', WDM_PE_PLUGIN_URL . 'assets/admin/css/wpi_admin.css', array(), PEFREE_VERSION );
	}
}
