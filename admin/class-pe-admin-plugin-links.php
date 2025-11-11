<?php
/**
 * PE plugin links class
 *
 * @package  PEFree/pluginLinks
 * @version  3.0.0
 */

if ( ! class_exists( 'PE_Admin_Plugin_Links' ) ) {

	/**
	 * This class contains the links to be added in a plugin
	 *
	 * @since 3.0.0
	 */
	class PE_Admin_Plugin_Links {
		/**
		 * A link to the plugin documentation
		 *
		 * @var string - documentation URL
		 */
		private static $docs = 'https://wisdmlabs.com/docs/';

		/**
		 * A link to the plugin support page
		 *
		 * @var string - support page URL
		 */
		private static $support = 'https://wisdmlabs.com/contact-us/';

		/**
		 * A method to add a setting link beside deactivate link.
		 *
		 * @param array $links Array of lins.
		 * @return array Array of links.
		 */
		public static function plugin_action_links( $links ) {
			$links = array_merge(
				array(
					'<a href="' . esc_url( admin_url( 'admin.php?page=product-enquiry-for-woocommerce' ) ) . '">' . __( 'Settings', 'product-enquiry-for-woocommerce' ) . '</a>',
				),
				$links
			);

			return $links;
		}


		/**
		 * This method will add extra links to the plugins listion on the wp-admin plugins page. we are adding documentation page, support page.
		 *
		 * @param array  $links Plugin links.
		 * @param object $file Plugin file.
		 * @return array - updated list of row meta links
		 */
		public static function plugin_row_meta( $links, $file ) {
			$plugin_base_name = plugin_basename( WDM_PE_PLUGIN );

			if ( $plugin_base_name === $file ) {

				$row_meta = array(
					'support' => '<a href="' . esc_url( self::$support ) . '" aria-label="' . esc_attr__( 'Support', 'product-enquiry-for-woocommerce' ) . '">' . esc_html__( 'Support', 'product-enquiry-for-woocommerce' ) . '</a>',
				);
				return array_merge( $links, $row_meta );
			}
			return (array) $links;
		}
	}
}
