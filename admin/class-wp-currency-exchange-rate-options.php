<?php
/**
 * The options page.
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
class Wp_Currency_Exchange_Rate_Options {

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
	 * Tabs.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $tabs The tabs of the settings page.
	 */
	private $tabs;


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
		$this->tabs = array(
			'settings' => __( 'Settings', '' ),
			'usage'    => __( 'Usage', '' ),
		);

		$this->init_hooks();

		// Allow 3rd party to remove hooks, shortcodes and widgets.
		do_action( 'wpcer_options_unhook', $this );
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function init_hooks() {
		// Add options menu.
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );

		add_action( 'admin_init', array( $this, 'setttings_init' ) );

		// Settings page header.
		add_action( 'wpcer_settings_page_tabs', array( $this, 'settings_page_tabs' ) );

		// Settings page body.
		add_action( 'wpcer_settings_page_tab_content', array( $this, 'settings_page_tab_content' ) );
	}

	/**
	 * Display settings tab content.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function settings_page_tab_content() {
		// Get settings.
		$currencies          = Wp_Currency_Exchange_Rate_Functions::get_currency_codes_and_names();
		$base_currency       = Wp_Currency_Exchange_Rate_Functions::get_base_currency();
		$conversion_currency = Wp_Currency_Exchange_Rate_Functions::get_conversion_currency();
		$fetch_interval_num  = Wp_Currency_Exchange_Rate_Functions::get_fetch_interval_num();
		$fetch_interval_unit = Wp_Currency_Exchange_Rate_Functions::get_fetch_interval_unit();
		$number_of_decimals  = Wp_Currency_Exchange_Rate_Functions::get_number_of_decimals();

		// Get the selected tab.
		$tab_selected = isset( $_GET['tab'] ) ? $_GET['tab'] : 'settings';

		// Include the proper tab content.
		if ( 'settings' === $tab_selected ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wp-currency-exchange-rate-admin-settings-tab.php';
		} elseif ( 'usage' === $tab_selected ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wp-currency-exchange-rate-admin-usage-tab.php';
		} else {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wp-currency-exchange-rate-admin-settings-tab.php';
		}
	}

	/**
	 * Display settings page header.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function settings_page_tabs() {
		global $pagenow;

		if ( 'options-general.php' === $pagenow && 'wpcer-options-page' === $_GET['page'] ) {
			$tab_selected = isset( $_GET['tab'] ) ? $_GET['tab'] : 'settings';
		}

		$tabs = apply_filters( 'wpcer_settings_tabs', $this->tabs );

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wp-currency-exchange-rate-admin-tabs.php';
	}
	/**
	 * Add options page.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function add_admin_menu() {
		add_options_page(
			__( 'WP Currency Exchange Rate', '' ),
			__( 'WP Currency Exchange Rate', '' ),
			'administrator',
			'wpcer-options-page',
			array( $this, 'wpcer_options_page' ),
		);
	}

	/**
	 * Display options page.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function wpcer_options_page() {
		global $pagenow;

		if ( 'options-general.php' === $pagenow && 'wpcer-options-page' === $_GET['page'] ) {

			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wp-currency-exchange-rate-admin-display.php';
		}
	}

	/**
	 * Settings form.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function setttings_init() {
		register_setting( 'wpcer', 'wpcer_base_currency' );
		register_setting( 'wpcer', 'wpcer_conversion_currency' );
		register_setting( 'wpcer', 'wpcer_fetch_interval_num' );
		register_setting( 'wpcer', 'wpcer_fetch_interval_unit' );
		register_setting( 'wpcer', 'wpcer_number_of_decimals' );
	}
}
