<?php
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( 'Alpha_Blocks_Final' ) ) :

	final class Alpha_Blocks_Final {

		/**
		 * Just a instance.
		 *
		 * @var mixed
		 */
		private static $instance;

		/**
		 * Just a text_domain.
		 *
		 * @var mixed
		 */
		public $text_domain;

		/**
		 * Will create instance for the whole plugins.
		 *
		 * @return Object
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new Alpha_Blocks_Final();
			}
			return self::$instance;
		}

		/*
		 * Cloning is forbidden.
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'nvce' ), '1.0' );
		}

		/*
		 * Unserializing instances of this class is forbidden.
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'nvce' ), '1.0' );
		}

		/*
		 * Plugin constructor
		 */
		function __construct() {

			$this->text_domain = 'Alpha';
			$this->set_constants();
			$this->includes();
		}

		/*
		 * Setting the plugin  constant
		 */
		public function set_constants() {

			if ( ! defined( 'ALPHA_VERSION' ) ) {
				define( 'ALPHA_VERSION', '1.0.0' );
			}
			if ( ! defined( 'ALPHA_DOMAIN' ) ) {
				define( 'ALPHA_DOMAIN', 'alpha' );
			}
			if ( ! defined( 'ALPHA_NAME' ) ) {
				define( 'ALPHA_NAME', 'Alpha Blocks' );
			}
			if ( ! defined( 'ALPHADIR' ) ) {
				define( 'ALPHADIR', plugin_dir_path( __FILE__ ) );
			}
			if ( ! defined( 'ALPHABASENAME' ) ) {
				define( 'ALPHABASENAME', plugin_basename( __FILE__ ) );
			}
			if ( ! defined( 'ALPHAURL' ) ) {
				define( 'ALPHAURL', plugin_dir_url( __FILE__ ) );
			}
			if ( ! defined( 'ALPHADEV' ) ) {
				define( 'ALPHADEV', true );
			}
			if ( ! defined( 'ALPHA_IMAGES' ) ) {
				define( 'ALPHA_IMAGES', '_ALPHA_att' );
			}
		}

		/*
		 * Plugin include files
		 */
		public function includes() {

			include_once dirname( ALPHA_PLUGIN_FILE ) . '/includes/functions.php';

			spl_autoload_register(
				function ( $class_name ) {

					if ( false !== strpos( $class_name, $this->text_domain ) ) {

						$classes_dir = realpath( plugin_dir_path( ALPHA_PLUGIN_FILE ) ) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;

						$class_file = str_replace( '_', '-', strtolower( 'class-' . $class_name ) ) . '.php';
						require_once $classes_dir . $class_file;
					}
				}
			);
		}
	}
endif;
