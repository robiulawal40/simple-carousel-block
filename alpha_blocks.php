<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:       Alpha Blocks
 * Plugin URI:        https://github.com/robiulawal40/
 * Description:       This plugin will create bunch of blocks in your WordPress website.
 * Version:           1.0.0
 * Author:            Robiul Awal
 * Author URI:        https://www.linkedin.com/company/wp-codezen
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       alpha
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! defined( 'ALPHA_PLUGIN_FILE' ) ) {
	define( 'ALPHA_PLUGIN_FILE', __FILE__ );
}

// Include the main Alpha_Blocks_Final class.
if ( ! class_exists( 'Alpha_Blocks_Final', false ) ) {
	include_once dirname( ALPHA_PLUGIN_FILE ) . '/includes/class-alpha-blocks.php';
}

/**
 * Initialization of the plugin.
 *
 * @return object
 */
function Alpha_init() {
	return Alpha_Blocks_Final::instance();
}
// add_action( 'plugins_loaded', 'Alpha_init' );

$GLOBALS['alpha_blocks'] = Alpha_init();

new Alpha_I18n();


function alpha_blocks_register_blocks() {
	register_block_type( __DIR__ . '/build/info-box' );
	// register_block_type( __DIR__ . '/build/accordion' );
	// register_block_type( __DIR__ . '/build/icon' );
}
add_action( 'init', 'alpha_blocks_register_blocks' );
