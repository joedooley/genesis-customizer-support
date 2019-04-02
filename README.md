# Genesis Customizer Support
Adds customizer support to your Genesis child theme.

## Installation

1. Clone plugin to `wp-content/plugins`.
	1. `git clone git@github.com:joedooley/genesis-customizer-support.git`
1. Activate plugin from within WordPress dashboard or with WP CLI by running
`wp plugin activate genesis-customizer-support`
1. Once the plugin is activated you can enable Customizer support by adding a
a new theme support to your child themes functions.php.
	1. `add_theme_support( 'genesis-customizer-support' );`
	1. Plugin may not work properly if this is added after the 
	`genesis_setup` hook runs.

## Notes
- Minimum PHP version is 7.2.
