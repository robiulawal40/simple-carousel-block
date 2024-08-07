<?php
/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Searcheo_Tracker
 * @subpackage Searcheo_Tracker/includes
 * @author     Your Name <email@example.com>
 */
if ( ! class_exists( 'CCOP_i18n' ) ) :
	class CCOP_i18n {

		public function __construct() {

			if ( current_action() == 'plugins_loaded' ) {
				$this->load_plugin_textdomain();
			} else {
				add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );
			}
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since    1.0.0
		 */
		public function load_plugin_textdomain() {

			load_plugin_textdomain(
				'ccop',
				false,
				dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
			);

		}
	}

	// $plugin_i18n = new CCOP_i18n();
	// add_action( 'plugins_loaded', array( $plugin_i18n, 'load_plugin_textdomain' ) );
endif;