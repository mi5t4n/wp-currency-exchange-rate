<?php
/**
 * This class contains useful functions.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/includes
 */

/**
 * This class contains useful functions.
 *
 * @since      1.0.0
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/includes
 * @author     Sagar Bahadur Tamang <mi5t4n@gmail.com>
 */
class Wp_Currency_Exchange_Rate_Functions {

	/**
	 * Get currency codes and names.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return Array Currency codes and names.
	 */
	public static function get_currency_codes_and_names() {
		return array(
			'CAD' => __( 'Canadian Dollar', '' ),
			'HKD' => __( 'Hong Kong Dollar', '' ),
			'ISK' => __( 'Iceland Krona', '' ),
			'PHP' => __( 'Philippine Peso', '' ),
			'DKK' => __( 'Danish Krone', '' ),
			'HUF' => __( 'Forint', '' ),
			'CZK' => __( 'Czech Koruna', '' ),
			'AUD' => __( 'Australian Dollar', '' ),
			'RON' => __( 'Leu', '' ),
			'SEK' => __( 'Swedish Krona', '' ),
			'IDR' => __( 'Rupiah', '' ),
			'INR' => __( 'Indian Rupee', '' ),
			'BRL' => __( 'Brazilian Real', '' ),
			'RUB' => __( 'Russian Ruble', '' ),
			'HRK' => __( 'Croatian Kuna', '' ),
			'JPY' => __( 'Yen', '' ),
			'THB' => __( 'THB', '' ),
			'CHF' => __( 'Swiss Franc', '' ),
			'SGD' => __( 'Singapore Dollar', '' ),
			'PLN' => __( 'PZloty', '' ),
			'BGN' => __( 'Bulgarian Lev', '' ),
			'TRY' => __( 'Turkish Lira', '' ),
			'CNY' => __( 'Yuan', '' ),
			'NOK' => __( 'Norwegian Krone', '' ),
			'NZD' => __( 'New Zealand Dollar', '' ),
			'ZAR' => __( 'Rand', '' ),
			'USD' => __( 'US Dollar', '' ),
			'MXN' => __( 'Mexican Peso', '' ),
			'ILS' => __( 'New Israeli Shekel', '' ),
			'GBP' => __( 'Pound Sterling', '' ),
			'KRW' => __( 'South Korean Won', '' ),
			'MYR' => __( 'Malaysian Ringgit', '' ),
			'EUR' => __( 'Euro', '' ),
		);
	}
	/**
	 * Converts WordPress time constants to words.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
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
	 * Get currency codes.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return Array Currency codes.
	 */
	public static function get_currency_codes() {
		return array_keys( self::get_currency_codes_and_names() );
	}

	/**
	 * Get name of the curreny from currency code.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @param string $currency_code Currency code.
	 * @return string Currency name.
	 */
	public static function get_currency_name_from_code( $currency_code ) {

		// Get currency codes and names.
		$currency_codes_names = self::get_currency_codes_and_names();

		if ( isset( $currency_codes_names[ $currency_code ] ) ) {
			return $currency_codes_names[ $currency_code ];
		}
	}

	/**
	 * Get currency names.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return Array Currency names.
	 */
	public static function get_currency_names() {
		return array_values( self::get_currency_codes_and_names() );
	}

	/**
	 * Get fetch interval.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return int Fetch interval.
	 */
	public static function get_fetch_interval() {
		// Get the fetch interval number and units.
		$fetch_interval_num  = get_option( 'wpcer_fetch_interval_num' );
		$fetch_interval_unit = get_option( 'wpcer_fetch_interval_unit' );

		// Set default values if not present.
		$fetch_interval_num  = ( false === $fetch_interval_num ) ? 1 : $fetch_interval_num;
		$fetch_interval_unit = ( false === $fetch_interval_num ) ? HOUR_IN_SECONDS : $fetch_interval_unit;

		// Calculate the fetch interval.
		$fetch_interval = floatval( $fetch_interval_num ) * floatval( $fetch_interval_unit );
		$fetch_interval = intval( $fetch_interval );

		return intval( $fetch_interval );
	}

	/**
	 * Get latest exchagne rates.
	 *
	 * @param string $base_currency Base currency the rates based upon.
	 * @return Array Return exchange rates.
	 */
	public static function get_exchange_rates( $base_currency = 'EUR' ) {
		$api = Wp_Currency_Exchange_Rate_Api::get_instance( WP_CURRENCY_EXCHANGE_RATE_PLUGIN_NAME, WP_CURRENCY_EXCHANGE_RATE_VERSION );

		// Get reates.
		$rates = $api->get_latest_exchange_rates( $base_currency );

		return $rates;
	}

	/**
	 * Get converion rate between base currency and conversion currency.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @param string $base_currency         Base currency.
	 * @param string $conversion_currency   Conversion currency.
	 * @return double Conversion rate between base currency and conversion currency.
	 */
	public static function get_conversion_rate( $base_currency, $conversion_currency ) {
		// If base currency and conversion currency is same, return 1.
		if ( $base_currency === $conversion_currency ) {
			return 1;
		}

		// Get rates.
		$rates = self::get_exchange_rates( $base_currency );

		// If the exchange rate base currency is supplied base currency,
		// lookup to convert the base currency to conversion currenny.
		if ( isset( $rates['rates'][ $conversion_currency ] ) && $base_currency === $rates['base'] ) {
			return $rates['rates'][ $conversion_currency ];
		}

		// If the exchange rate base currency is not supplied base currency,
		// compute the conversion rate.
		if ( isset( $rates['rates'][ $conversion_currency ], $rates['rates'][ $base_currency ] ) && $base_currency !== $rates['base'] ) {
			$base_currency_float       = floatval( $rates['rates'][ $base_currency ] );
			$conversion_currency_float = floatval( $rates['rates'][ $conversion_currency ] );
			$computed_rate             = ( 1.0 / $base_currency_float ) * $conversion_currency_float;
			return $computed_rate;
		}

		// Return null for failsafe.
		return null;
	}

	/**
	 * Get the conversion rate date.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @param string $base_currency         Base currency.
	 * @param string $conversion_currency   Conversion currency.
	 *
	 * @return string Conversion date.
	 */
	public static function get_conversion_date( $base_currency, $conversion_currency ) {
		// Get rates.
		$rates = self::get_exchange_rates( $base_currency );

		// Get date.
		$date = $rates['date'];

		return $date;
	}

	/**
	 * Get the number of decimals.
	 *
	 * @return int Number of decimals.
	 */
	public static function get_number_of_decimals() {
		// Get the number of decimals.
		$number_of_decimals = get_option( 'wpcer_number_of_decimals' );

		// Set the default if not present.
		$number_of_decimals = ( false === $number_of_decimals ) ? 2 : $number_of_decimals;

		return intval( $number_of_decimals );
	}

	/**
	 * Get base currency.
	 *
	 * @return string Base currency.
	 */
	public static function get_base_currency() {
		// Get base currency.
		$base_currency = get_option( 'wpcer_base_currency' );

		// Set the default if no present.
		$base_currency = ( false === $base_currency ) ? 'EUR' : $base_currency;

		return $base_currency;
	}

	/**
	 * Get conversion currency.
	 *
	 * @return string Conversion currency.
	 */
	public static function get_conversion_currency() {
		// Get base currency.
		$conversion_currency = get_option( 'wpcer_conversion_currency' );

		// Set the default if no present.
		$conversion_currency = ( false === $conversion_currency ) ? 'USD' : $conversion_currency;

		return $conversion_currency;
	}

	/**
	 * Get fetch interval num.
	 *
	 * @return float Fetch interval num.
	 */
	public static function get_fetch_interval_num() {
		// Get base currency.
		$fetch_interval_num = get_option( 'wpcer_fetch_interval_num' );

		// Set the default if no present.
		$fetch_interval_num = ( false === $fetch_interval_num ) ? 1 : $fetch_interval_num;

		return $fetch_interval_num;
	}

	/**
	 * Get fetch interval unit.
	 *
	 * @return int Fetch interval unit.
	 */
	public static function get_fetch_interval_unit() {
		// Get base currency.
		$fetch_interval_unit = get_option( 'wpcer_fetch_interval_unit' );

		// Set the default if no present.
		$fetch_interval_unit = ( false === $fetch_interval_unit ) ? HOUR_IN_SECONDS : $fetch_interval_unit;

		return intval( $fetch_interval_unit );
	}

}
