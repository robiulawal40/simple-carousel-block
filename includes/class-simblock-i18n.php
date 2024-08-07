<?php
if ( ! class_exists( 'Alpha_I18n' ) ) :
	/**
	 * Define the internationalization functionality.
	 *
	 * Loads and defines the internationalization files for this plugin
	 * so that it is ready for translation.
	 */
	class Alpha_I18n {

		/**
		 * Include all action & hooks.
		 */
		public function __construct() {

			if ( 'plugins_loaded' === current_action() ) {
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
				'alpha',
				false,
				dirname( plugin_basename( __FILE__ ), 2 ) . '/languages/'
			);
		}
	}
endif;
