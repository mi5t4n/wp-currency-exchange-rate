<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/public
 * @author     Sagar Bahadur Tamang <mi5t4n@gmail.com>
 */
class Wp_Currency_Exchange_Rate_Public {

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
	 * @param    string $plugin_name  The name of the plugin.
	 * @param    string $version      The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Currency_Exchange_Rate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Currency_Exchange_Rate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-currency-exchange-rate-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Currency_Exchange_Rate_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Currency_Exchange_Rate_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// Get rates.
		$rates = Wp_Currency_Exchange_Rate_Functions::get_exchange_rates();

		// Get number of decimals.
		$number_of_decimals = Wp_Currency_Exchange_Rate_Functions::get_number_of_decimals();

		// Register the public JS.
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-currency-exchange-rate-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script(
			$this->plugin_name,
			'wpcer',
			array(
				'rates'            => $rates,
				'numberOfDecimals' => $number_of_decimals,
			)
		);
		wp_enqueue_script( $this->plugin_name );

	}

}
