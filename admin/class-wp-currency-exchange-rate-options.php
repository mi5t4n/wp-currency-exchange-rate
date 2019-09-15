<?php
/**
 * The options page.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate_Options
 * @subpackage Wp_Currency_Exchange_Rate_Options/admin
 */

/**
 * The options page.
 *
 * @package    Wp_Currency_Exchange_Rate_Options
 * @subpackage Wp_Currency_Exchange_Rate_Options/admin
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
	 */
	private function init() {
		$this->tabs = array(
			'settings' => __( 'Settings', '' ),
			'usage'    => __( 'Usage', '' ),
		);

		$this->init_hooks();
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
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
	 */
	public function settings_page_tab_content() {
		// Get settings.
		$currencies_code           = get_option( 'wpcer_currencies_code' );
		$wpcer_base_currency       = get_option( 'wpcer_base_currency' );
		$wpcer_conversion_currency = get_option( 'wpcer_conversion_currency' );
		$wpcer_fetch_interval_num  = get_option( 'wpcer_fetch_interval_num' );
		$wpcer_fetch_interval_unit = get_option( 'wpcer_fetch_interval_unit' );

		$tab_selected = isset( $_GET['tab'] ) ? $_GET['tab'] : 'settings';

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
	 */
	public function setttings_init() {
		register_setting( 'wpcer', 'wpcer_base_currency' );
		register_setting( 'wpcer', 'wpcer_conversion_currency' );
		register_setting( 'wpcer', 'wpcer_fetch_interval_num' );
		register_setting( 'wpcer', 'wpcer_fetch_interval_unit' );
	}
}
