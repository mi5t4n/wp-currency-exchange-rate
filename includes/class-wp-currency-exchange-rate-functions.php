<?php
/**
 * This class contains useful functions.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate_Functions
 * @subpackage Wp_Currency_Exchange_Rate_Functions/includes
 */

/**
 * This class contains useful functions.
 *
 * @since      1.0.0
 * @package    Wp_Currency_Exchange_Rate_Functions
 * @subpackage Wp_Currency_Exchange_Rate_Functions/includes
 * @author     Sagar Bahadur Tamang <mi5t4n@gmail.com>
 */
class Wp_Currency_Exchange_Rate_Functions {

	/**
	 * API Base URL.
	 *
	 * @since 1.0.0
	 * @var $api_base_url API base URL>
	 */
	public static $api_base_url = 'https://api.exchangeratesapi.io/';

	/**
	 * Converts WordPress time constants to words.
	 *
	 * @since 1.0.0
	 *
	 * @param int $wp_time WordPress time constants.
	 */
	public static function wp_time_constant_to_words( $wp_time ) {
		switch ( $wp_time ) {
			case MINUTE_IN_SECONDS:
				return 'Minutes';
			case HOUR_IN_SECONDS:
				return 'Hours';
			case DAY_IN_SECONDS:
				return 'Days';
			case WEEK_IN_SECONDS:
				return 'Weeks';
			case MONTH_IN_SECONDS:
				return 'Months';
			case YEAR_IN_SECONDS:
				return 'Years';
			default:
				return 'Minutes';
		}
	}

	/**
	 * Get the list of currencies code.
	 *
	 * @since 1.0.0
	 */
	public static function get_currencies_code() {
		// Make the request.
		$response = wp_remote_get( self::$api_base_url . 'latest' );

		// Bail early if error.
		if ( is_wp_error( $response ) ) {
			return false;
		}

		// Bail early if the response is not 200 OK.
		if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return false;
		}

		// Get the data.
		$json_data = json_decode( wp_remote_retrieve_body( $response ) );

		// Get the rates object and convert it to array.
		$rates = (array) $json_data->rates;

		// Get the currencis code.
		$currency_codes = array_keys( $rates );

		return $currency_codes;
	}
}
