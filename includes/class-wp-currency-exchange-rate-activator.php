<?php
/**
 * Fired during plugin activation
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/includes
 * @author     Sagar Bahadur Tamang <mi5t4n@gmail.com>
 */
class Wp_Currency_Exchange_Rate_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// Get plugin version in database.
		$version = get_option( 'wp_currency_exchange_rate' );

		// If not present, set the plugin version ind database.
		if ( false === $version ) {
			update_option( 'wp_currency_exchange_rate', WP_CURRENCY_EXCHANGE_RATE_VERSION, true );
		}

		// Get the currencies code.
		$currencies_code = Wp_Currency_Exchange_Rate_Functions::get_currencies_code();

		// Save the currencies code.
		update_option( 'wpcer_currencies_code', $currencies_code );

	}

}
