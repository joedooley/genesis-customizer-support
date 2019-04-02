<?php
/**
 * Interface for registering new customizer controls and settings.
 *
 * @package  DevDesigns\GenesisCustomizerSupport
 * @since    1.0.0
 * @author   Developing Designs
 * @link     https://www.developingdesigns.com/
 */

namespace DevDesigns\GenesisCustomizerSupport\Customizer;



/**
 * Interface RegisterInterface
 *
 * @since  1.0.0
 */
interface RegisterInterface {
	/**
	 * Register customizer settings.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function register(): void;


	/**
	 * Add customizer settings.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function addSettings(): void;


	/**
	 * Add customizer controls.
	 *
	 * @since  1.0.0
	 *
	 * @return void
	 */
	public function addControls(): void;
}
