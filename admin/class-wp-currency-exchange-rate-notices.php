<?php
/**
 * The class for handling admin notices.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/admin
 */

/**
 * The options page.
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/admin
 * @author     Sagar Bahadur Tamang <mi5t4n@gmail.com>
 */
class Wp_Currency_Exchange_Rate_Notices {

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

		// Allow 3rd party to remove hooks, widgets and shortcodes.
		do_action( 'wpcer_notices_unhook', $this );
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function init_hooks() {
		add_action( 'admin_notices', array( $this, 'display_notices' ) );
	}

	/**
	 * Display admin notices.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function display_notices() {
		$this->display_exchange_rates_notice();
	}

	/**
	 * Display notice if currencies are not found.
	 */
	private function display_exchange_rates_notice() {
		// Get the exchange rates.
		$rates = Wp_Currency_Exchange_Rate_Functions::get_exchange_rates();

		$message = __( 'Currencies exchange rates are not set. Please go to the settings and get the latest exchange rates.', '' );
		$message = apply_filters( 'wpcer_exchange_rates_not_set', $message );

		// Display currencies code are not found.
		if ( ! is_array( $rates ) ) {
			echo '<div class="notice notice-error is-dismissible">';
			echo '<p> ' . sprintf( '<b>WP Currency Exchange Rate:</b> %s', esc_html( $message ) ) . '</p>';
			echo '</div>';
		}
	}
}
