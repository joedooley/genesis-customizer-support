<?php
/**
 * Plugin Name: Genesis Customizer Support
 * Plugin URI:  https://github.com/joedooley/genesis-customizer-support
 * Description: Adds customizer support to your Genesis child theme by adding
 *              `add_theme_support( 'genesis-customizer-support' )` in your Genesis
 *              child theme setup function.
 * Version:     1.0.0
 * Author:      Developing Designs
 * Author URI:  https://www.developingdesigns.com/
 * Text Domain: genesis-customizer-support
 * Domain Path: /languages
 *
 * @package     DevDesigns\GenesisCustomizerSupport
 * @author      Joe Dooley <hello@developingdesigns.com>
 * @copyright   2019 Joe Dooley, Developing Designs
 * @license     GPL-2.0+
 */

namespace DevDesigns\GenesisCustomizerSupport;

use WP_Customize_Manager;
use DevDesigns\GenesisCustomizerSupport\Customizer\Register;
use function DevDesigns\GenesisCustomizerSupport\Helpers\init;


defined( 'ABSPATH' ) or die();


/**
 * Define plugin constants.
 *
 * @since 1.0.0
 */
define( 'GCS_VERSION', '1.0.0' );
define( 'GCS_URL', plugin_dir_url( __FILE__ ) );
define( 'GCS_DIR', plugin_dir_path( __FILE__ ) );
define( 'GCS_HANDLE', 'genesis-customizer-support' );


/**
 * Require composer autoloader.
 *
 * @since 1.0.0
 */
require_once __DIR__ . '/vendor/autoload.php';


/**
 * Perform runtime checks before we require composer.
 *
 * @since 1.0.0
 */
init();


/*
 * Bootstrap plugin.
 *
 * @since 1.0.0
 */
add_action( 'genesis_setup', function (): void {
	if ( ! current_theme_supports( GCS_HANDLE ) ) {
		return;
	}

	add_action( 'wp_enqueue_scripts', 'DevDesigns\GenesisCustomizerSupport\Customizer\Enqueue::enqueue', 999999 );

	add_action( 'customize_register', function ( WP_Customize_Manager $wpCustomize ) {
		$register = new Register( $wpCustomize );
		$register->register();
	} );
}, 99999 );
