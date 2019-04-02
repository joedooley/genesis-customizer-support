<?php
/**
 * Enqueue webpack compiled js and css.
 *
 * @package     DevDesigns\GenesisCustomizerSupport
 * @author      Developing Designs
 * @since       1.0.0
 */

namespace DevDesigns\GenesisCustomizerSupport\Customizer;



class Enqueue {
	/**
	 * Enqueue stylesheet and inline styles.
	 *
	 * @since 1.0.0
	 */
	public static function enqueue (): void {
		self::styles();
	}


	/**
	 * Adds inline CSS to main plugin stylesheet.
	 *
	 * @since 1.0.0
	 */
	private static function styles(): void {
		$handle = GCS_HANDLE . '/main.css';

		wp_enqueue_style(
			$handle,
			GCS_URL . 'dist/styles/main.css',
			[],
			GCS_VERSION
		);

		wp_add_inline_style( $handle, self::inlineCss() );
	}


	/**
	 * Create dynamic inline CSS for customizer settings.
	 *
	 * @since  1.0.0
	 *
	 * @return string
	 */
	private static function inlineCss (): string {
		$css = '';
		$color_link = get_theme_mod( 'gcs_link_color', Register::defaultLinkColor() );
		$color_accent = get_theme_mod( 'gcs_accent_color', Register::defaultAccentColor() );
		$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );

		if ( $logo ) {
			$logo_height = absint( $logo[2] );
			$logo_max_width = get_theme_mod( 'gcs_logo_width', 350 );
			$logo_width = absint( $logo[1] );
			$logo_ratio = $logo_width / max( $logo_height, 1 );
			$logo_effective_height = min( $logo_width, $logo_max_width ) / max( $logo_ratio, 1 );
			$logo_padding = max( 0, ( 60 - $logo_effective_height ) / 2 );
		}

		$css .= ( Register::defaultLinkColor() !== $color_link ) ? sprintf(
			'
					a,
					.entry-title a:focus,
					.entry-title a:hover,
					.genesis-nav-menu a:focus,
					.genesis-nav-menu a:hover,
					.genesis-nav-menu .current-menu-item > a,
					.genesis-nav-menu .sub-menu .current-menu-item > a:focus,
					.genesis-nav-menu .sub-menu .current-menu-item > a:hover,
					.menu-toggle:focus,
					.menu-toggle:hover,
					.sub-menu-toggle:focus,
					.sub-menu-toggle:hover {
						color: %s;
					}
					', $color_link
		) : '';

		$css .= ( Register::defaultAccentColor() !== $color_accent ) ? sprintf(
			'
					button:focus,
					button:hover,
					input[type="button"]:focus,
					input[type="button"]:hover,
					input[type="reset"]:focus,
					input[type="reset"]:hover,
					input[type="submit"]:focus,
					input[type="submit"]:hover,
					input[type="reset"]:focus,
					input[type="reset"]:hover,
					input[type="submit"]:focus,
					input[type="submit"]:hover,
					.site-container div.wpforms-container-full .wpforms-form input[type="submit"]:focus,
					.site-container div.wpforms-container-full .wpforms-form input[type="submit"]:hover,
					.site-container div.wpforms-container-full .wpforms-form button[type="submit"]:focus,
					.site-container div.wpforms-container-full .wpforms-form button[type="submit"]:hover,
					.button:focus,
					.button:hover {
						background-color: %1$s;
						color: %2$s;
					}
					@media only screen and (min-width: 960px) {
						.genesis-nav-menu > .menu-highlight > a:hover,
						.genesis-nav-menu > .menu-highlight > a:focus,
						.genesis-nav-menu > .menu-highlight.current-menu-item > a {
							background-color: %1$s;
							color: %2$s;
						}
					}
					', $color_accent, self::colorContrast( $color_accent )
		) : '';

		$css .= ( has_custom_logo() && ( 200 <= $logo_effective_height ) ) ?
				'
				.site-header {
					position: static;
				}
				'
		: '';

		$css .= ( has_custom_logo() && ( 350 !== $logo_max_width ) ) ? sprintf(
		'
				.wp-custom-logo .site-container .title-area {
					max-width: %spx;
				}
				', $logo_max_width
		) : '';

		$css .= ( has_custom_logo() && ( 600 <= $logo_max_width ) ) ?
				'
				.wp-custom-logo .title-area,
				.wp-custom-logo .menu-toggle,
				.wp-custom-logo .nav-primary {
					float: none;
				}
				.wp-custom-logo .title-area {
					margin: 0 auto;
					text-align: center;
				}
				@media only screen and (min-width: 960px) {
					.wp-custom-logo .nav-primary {
						text-align: center;
					}
					.wp-custom-logo .nav-primary .sub-menu {
						text-align: left;
					}
				}
				'
		: '';

		$css .= ( has_custom_logo() && $logo_padding && ( 1 < $logo_effective_height ) ) ? sprintf(
		'
				.wp-custom-logo .title-area {
					padding-top: %spx;
				}
				', $logo_padding + 5
		) : '';

		return $css;
	}


	/**
	 * Calculates if white or gray would contrast more with the provided color.
	 *
	 * @since  1.0.0
	 *
	 * @param  string $color A color in hex format.
	 */
	public static function colorContrast( string $color ): string {
		$hexcolor = str_replace( '#', '', $color );
		$red = hexdec( substr( $hexcolor, 0, 2 ) );
		$green = hexdec( substr( $hexcolor, 2, 2 ) );
		$blue = hexdec( substr( $hexcolor, 4, 2 ) );

		$luminosity = ( ( $red * 0.2126 ) + ( $green * 0.7152 ) + ( $blue * 0.0722 ) );

		return ( $luminosity > 128 ) ? '#333333' : '#ffffff';
	}
}
