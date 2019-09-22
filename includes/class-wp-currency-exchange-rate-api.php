<?php
/**
 * Shortcodes.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/includes
 */

/**
 * Shortcodes
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/includes
 * @author     Sagar Bahadur Tamang <mi5t4n@gmail.com>
 */
class Wp_Currency_Exchange_Rate_Api {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Holds the class istance.
	 *
	 * @since     1.0.0
	 * @access    private
	 * @var       Wp_Currency_Exchange_Rate_Api Holds the class istance.
	 */
	private static $instance = null;

	/**
	 * API Base URL.
	 *
	 * @since 1.0.0
	 * @var $api_base_url API base URL>
	 */
	public static $api_base_url = 'https://api.exchangeratesapi.io';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		// Initialization.
		$this->init();

	}

	/**
	 * Initialization.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function init() {
		$this->init_hooks();

		// Let 3rd party to remove the hooks, shortcodes and widgets.
		do_action( 'wpcer_api_unhook', $this );
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function init_hooks() {

	}

	/**
	 * Get the instance of the class.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new Wp_Currency_Exchange_Rate_Api( WP_CURRENCY_EXCHANGE_RATE_PLUGIN_NAME, WP_CURRENCY_EXCHANGE_RATE_VERSION );
		}

		return self::$instance;
	}

	/**
	 * Get latest foreign exchange reference rates.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $currency_code Base Currency code. (e.g. USD).
	 * @param bool   $fetch         Fetches new data bypassing cache.
	 *
	 * @return Array|null Array of latest exchange rates, otherwise null on no data.
	 */
	public function get_latest_exchange_rates( $currency_code = 'EUR', $fetch = false ) {
		$url = self::$api_base_url . "/latest?base={$currency_code}";

		// Transinet key for rates.
		$transient_rates_key = 'wpcer_exchange_rates';

		// Check rates in database if the fetch is false.
		if ( false === $fetch ) {
			$rates = get_transient( $transient_rates_key );

			// If the rates are in cache, return it.
			if ( false !== $rates ) {
				return $rates;
			}
		}

		// Get the rates, if the rates are not present in cache and fetch is true.
		$rates = $this->get_data( $url );

		// Bail early if the rates is not found.
		if ( null === $rates ) {
			return null;
		}

		// Save the rates in the transient.
		set_transient( $transient_rates_key, $rates, Wp_Currency_Exchange_Rate_Functions::get_fetch_interval() );

		return $rates;
	}

	/**
	 * Get currency codes.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_currency_codes() {
		// Get the latest exchange rates.
		$rates = $this->get_latest_exchange_rates();

		// Get the currencies codes.
		$currencies_code = array_keys( $rates['rates'] );

		// Append the base currency code.
		array_push( $currencies_code, $rates['base'] );

		return $currencies_code;

	}

	/**
	 * Fetch, validate and decode the data.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param string $url URL to request.
	 *
	 * @return Array|null Array of data, otherwise null on no data.
	 */
	private function get_data( $url ) {

		// Get the data.
		$response = wp_remote_get( $url );

		// Bail early if error.
		if ( is_wp_error( $response ) ) {
			return null;
		}

		// Bail early if the response is not 200 OK.
		if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return null;
		}

		// Decode the data to associate array.
		$json_data = json_decode( wp_remote_retrieve_body( $response ), true );

		return $json_data;
	}

}
