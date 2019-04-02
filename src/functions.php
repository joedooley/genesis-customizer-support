<?php
/**
 * Helper functions
 *
 * @package     DevDesigns\GenesisCustomizerSupport
 * @author      Developing Designs
 * @since       1.0.0
 */

namespace DevDesigns\GenesisCustomizerSupport\Helpers;



/**
 * Checks PHP version and if composer was installed.
 *
 * @since 1.0.0
 */
function init (): void {
	phpVersionCheck();
	composerCheck();
}


/**
 * Ensure compatible version of PHP is used.
 *
 * @since 1.0.0
 */
function phpVersionCheck (): void {
	if ( version_compare( '7.2', PHP_VERSION, '>=' ) ) {
		pluginError(
			__( 'The Genesis Customizer Support plugin has a minimum PHP version requirement of 7.2.', GCS_HANDLE ),
			__( 'Invalid PHP version &rsaquo; Current version: ' . PHP_VERSION, GCS_HANDLE )
		);
	}
}


/**
 * Require Composer autoloader.
 *
 * @since 1.0.0
 */
function composerCheck (): void {
	if ( ! file_exists( GCS_DIR. '/vendor/autoload.php' ) ) {
		pluginError(
			__( 'You must run <code>composer install</code> from the root plugin directory.', GCS_HANDLE ),
			__( 'Autoloader was not found', GCS_HANDLE )
		);
	}
}


/**
 * Helper function for prettying up errors
 *
 * @since 1.0.0
 *
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
function pluginError( $message, $subtitle = '', $title = '' ): void {
	$githubUrl = 'https://github.com/joedooley/genesis-customizer-support/';
	$title = $title ? : __( 'Genesis Customizer Support &rsaquo; Error', GCS_HANDLE );
	$footer = "Check out <a href='{$githubUrl}' target='blank'>GitHub</a> for more information or to <a href='{$githubUrl}/issues' target='blank'>report a bug</a></a>.";
	$message = "<h1>{$title}<br><small>{$subtitle}</small></h1><h4 style='font-weight: normal;'>{$message}</h4><h5>{$footer}</h5>";

	wp_die( $message, $title );
}

