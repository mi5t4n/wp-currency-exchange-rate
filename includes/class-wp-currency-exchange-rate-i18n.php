<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/includes
 * @author     Sagar Bahadur Tamang <mi5t4n@gmail.com>
 */
class Wp_Currency_Exchange_Rate_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-currency-exchange-rate',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
