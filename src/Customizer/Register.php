<?php
/**
 * Register settings and controls within the Customizer.
 *
 * @package     DevDesigns\GenesisCustomizerSupport
 * @author      Developing Designs
 * @since       1.0.0
 */

namespace DevDesigns\GenesisCustomizerSupport\Customizer;

use WP_Customize_Manager;
use WP_Customize_Color_Control;



class Register implements RegisterInterface {
	/**
	 * @var \WP_Customize_Manager
	 */
	private $wpCustomize;


	/**
	 * Register constructor.
	 *
	 * @param \WP_Customize_Manager $wpCustomize
	 */
	public function __construct( WP_Customize_Manager $wpCustomize ) {
		$this->wpCustomize = $wpCustomize;
	}


	/**
	 * Register customizer settings.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function register(): void {
		$this->addSettings();
		$this->addControls();
	}


	/**
	 * Add customizer settings.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function addSettings(): void {
		$this->addSetting( 'gcs_link_color', [
			'default'           => self::defaultLinkColor(),
			'sanitize_callback' => 'sanitize_hex_color',
		] );

		$this->addSetting( 'gcs_accent_color', [
			'default'           => self::defaultAccentColor(),
			'sanitize_callback' => 'sanitize_hex_color',
		] );

		$this->addSetting( 'gcs_logo_width', [
			'default'           => 350,
			'sanitize_callback' => 'absint',
		] );
	}


	/**
	 * Add customizer controls.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function addControls(): void {
		$this->addControl( 'gcs_link_color', [
			'description' => __( 'Change the color of post info links, hover color of linked titles, hover color of menu items, and more.', 'genesis-customize-support' ),
			'label'       => __( 'Link Color', 'genesis-customize-support' ),
			'section'     => 'colors',
			'settings'    => 'gcs_link_color',
		] );

		$this->addControl( 'gcs_accent_color', [
			'description' => __( 'Change the default hovers color for button.', 'genesis-customize-support' ),
			'label'       => __( 'Accent Color', 'genesis-customize-support' ),
			'section'     => 'colors',
			'settings'    => 'gcs_accent_color',
		] );

		$this->addControl( 'gcs_logo_width', [
			'label'       => __( 'Logo Width', 'genesis-customize-support' ),
			'description' => __( 'The maximum width of the logo in pixels.', 'genesis-customize-support' ),
			'priority'    => 9,
			'section'     => 'title_tagline',
			'settings'    => 'gcs_logo_width',
			'type'        => 'number',
			'input_attrs' => [
				'min' => 100,
			],
		] );
	}


	/**
	 * Add customizer setting.
	 *
	 * @since  1.0.0
	 *
	 * @param string $id
	 * @param array $config
	 */
	private function addSetting ( string $id, array $config ): void {
		$this->wpCustomize->add_setting( $id, $config );
	}


	/**
	 * Add customizer control.
	 *
	 * @since  1.0.0
	 *
	 * @param string $id
	 * @param array $config
	 */
	private function addControl( string $id, array $config ): void {
		$this->wpCustomize->add_control( $this->createControl( $id, $config ) );
	}


	/**
	 * Add customizer control.
	 *
	 * @since  1.0.0
	 *
	 * @param string $id
	 * @param array $config
	 */
	private function createControl( string $id, array $config ): WP_Customize_Color_Control {
		return new WP_Customize_Color_Control(
			$this->wpCustomize,
			$id,
			$config
		);
	}


	public static function defaultLinkColor(): string {
		return '#0073e5';
	}


	public static function defaultAccentColor(): string {
		return '#0073e5';
	}
}
