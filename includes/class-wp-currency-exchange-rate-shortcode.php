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
class Wp_Currency_Exchange_Rate_Shortcode {

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
		$this->init_shortcodes();

		// Let 3rd party to remove the hooks, shortcodes and widgets.
		do_action( 'wpcer_shortcode_unhook', $this );
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
	 * Intialize shortcodes.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function init_shortcodes() {
		add_shortcode( 'wpcer', array( $this, 'display_content' ) );
	}

	/**
	 * Display the shortcode content.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param Array  $attributes   Attributes passed to shortcode.
	 * @param String $content      Content passed to the shortcode.
	 */
	public function display_content( $attributes, $content ) {
		// If dashboard, don't display the content.
		if ( is_blog_admin() ) {
			return;
		}

		// Get currencies codes and names.
		$currencies = Wp_Currency_Exchange_Rate_Functions::get_currency_codes_and_names();
		$currencies = apply_filters( 'wper_shortcode_currencies', $currencies );

		// Get the currencies code.
		$base_currency       = get_option( 'wpcer_base_currency' );
		$conversion_currency = get_option( 'wpcer_conversion_currency' );

		// Set default values if not present.
		$base_currency       = ( false === $base_currency ) ? 'EUR' : $base_currency;
		$conversion_currency = ( false === $conversion_currency ) ? 'USD' : $conversion_currency;

		// Get the exchange rates with base_currency.
		$conversion_rate = Wp_Currency_Exchange_Rate_Functions::get_conversion_rate( $base_currency, $conversion_currency );

		// Get the exchange rate conversion date.
		$conversion_date = Wp_Currency_Exchange_Rate_Functions::get_conversion_date( $base_currency, $conversion_currency );

		// Get the number of decimals.
		$number_of_decimals = get_option( 'wpcer_number_of_decimals' );
		$number_of_decimals = ( false === $number_of_decimals ) ? 2 : $number_of_decimals;

		// Get the conversion date & fromat it.
		$conversion_date = Wp_Currency_Exchange_Rate_Functions::get_conversion_date( $base_currency, $base_currency );
		$timestamp       = strtotime( $conversion_date );
		$conversion_date = date_i18n( 'F j, Y', $timestamp );

		// Hook before the display of shortcode.
		do_action( 'wpcer_shortcode_before', $currencies, $base_currency, $conversion_currency );

		require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/wp-currency-exchange-rate-public-display.php';

		// Hook after the display of shortcode.
		do_action( 'wpcer_shortcode_after', $currencies, $base_currency, $conversion_currency );
	}
}
