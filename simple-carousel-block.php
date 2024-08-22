<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Carousel Block
 * Plugin URI:        https://github.com/robiulawal40/
 * Description:       This plugin will carousel block in your WordPress website.
 * Version:           1.0.0
 * Author:            Robiul Awal
 * Author URI:        https://www.linkedin.com/company/wp-codezen
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       simblock
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! defined( 'SIMBLOCK_PLUGIN_FILE' ) ) {
	define( 'SIMBLOCK_PLUGIN_FILE', __FILE__ );
}

// Include the main Simple_Carousel_Blocks_Final class.
if ( ! class_exists( 'Simple_Carousel_Blocks_Final', false ) ) {
	include_once dirname( SIMBLOCK_PLUGIN_FILE ) . '/includes/class-simple-carousel-block.php';
}

/**
 * Initialization of the plugin.
 *
 * @return object
 */
function Simple_Carousel_Block_init() {
	return Simple_Carousel_Blocks_Final::instance();
}
// add_action( 'plugins_loaded', 'Simple_Carousel_Block_init' );

$GLOBALS['simblock'] = Simple_Carousel_Block_init();
new Simblock_I18n();

function simple_carousel_blocks_register_blocks() {
	//register_block_type( __DIR__ . '/build/logo-carousel' );
	register_block_type( __DIR__ . '/build/logo-slider' );
}
add_action( 'init', 'simple_carousel_blocks_register_blocks' );
