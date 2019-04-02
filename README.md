# Genesis Customizer Support
Adds customizer support to your Genesis child theme.


## Installation
1. Install plugin with composer or git:
	1. `composer require devdesigns/genesis-customizer-support`
	1. `git clone git@github.com:joedooley/genesis-customizer-support.git`
1. Activate plugin with WP CLI or from within WordPress dashboard.
	1. `wp plugin activate genesis-customizer-support`
1. Enable theme support for genesis-customizer-support by adding the following
snippet to your child theme's `functions.php` file.
	1. `add_theme_support( 'genesis-customizer-support' );`


## Notes
- Minimum PHP version is 7.2.


## Roadmap
- Switch to a config based system. This keeps control and settings configurations outside
of the Register class.
- Add additional Customizer controls.
- Configure Live Preview.
- Possibly add to WordPress Plugin repository(Based on demand). Users can install via github, wp-cli,
and composer already.
