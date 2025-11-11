<?php
/**
 * Autoloader.
 *
 * @package Autoloader
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Autoloader class.
 */
class PE_Autoloader {
	/**
	 * Path to the includes directory.
	 *
	 * @var string
	 */
	private $include_path = '';

	/**
	 * Path to the public directory.
	 *
	 * @var string
	 */
	private $public_path = '';
	/**
	 * Path to the admin directory.
	 *
	 * @var string
	 */
	private $admin_path = '';
	/**
	 * The Constructor.
	 */
	public function __construct() {
		if ( function_exists( '__autoload' ) ) {
			spl_autoload_register( '__autoload' );
		}

		spl_autoload_register( array( $this, 'autoload' ) );

		$this->include_path = WDM_PE_PLUGIN_PATH . 'includes/';
		$this->public_path  = WDM_PE_PLUGIN_PATH . 'public/';
		$this->admin_path   = WDM_PE_PLUGIN_PATH . 'admin/';
	}
	/**
	 * Take a class name and turn it into a file name.
	 *
	 * @param  string $class Class name.
	 * @return string
	 */
	private function get_file_name_from_class( $class ) {
		return 'class-' . str_replace( '_', '-', $class ) . '.php';
	}

	/**
	 * Include a class file.
	 *
	 * @param  string $path File path.
	 * @return bool Successful or not.
	 */
	private function load_file( $path ) {
		if ( $path && is_readable( $path ) ) {
			include_once $path;
			return true;
		}
		return false;
	}
	/**
	 * Auto-load classes on demand to reduce memory consumption.
	 *
	 * @param string $class Class name.
	 */
	public function autoload( $class ) {
		$class = strtolower( $class );

		$include_path = $this->include_path;

		if ( 0 !== strpos( $class, 'pe_' ) ) {
			return;
		}

		$file = $this->get_file_name_from_class( $class );
		$path = '';

		if ( 0 === strpos( $class, 'pe_admin' ) ) {
			$path = $this->admin_path;
		} elseif ( 0 === strpos( $class, 'pe_public' ) ) {
			$path = $this->public_path;
		} elseif ( 0 === strpos( $class, 'pe_includes' ) ) {
			$path = $this->include_path;
		}
		if ( empty( $path ) || ! $this->load_file( $path . $file ) ) {
			$this->load_file( $path . $file );
		}
	}
}

new PE_Autoloader();
