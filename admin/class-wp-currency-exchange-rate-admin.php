<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/admin
 * @author     Sagar Bahadur Tamang <mi5t4n@gmail.com>
 */
class Wp_Currency_Exchange_Rate_Admin {

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

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-currency-exchange-rate-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-currency-exchange-rate-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add links under plugin name along with activate and deactivate.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string[] $actions      An array of plugin action links. By default this can include 'activate', 'deactivate', and 'delete'. With Multisite active this can also include 'network_active' and 'network_only' items.
	 * @param string   $plugin_file  Path to the plugin file relative to the plugins directory.
	 * @param Array    $plugin_data  An array of plugin data. See get_plugin_data().
	 * @param string   $context      The plugin context. By default this can include 'all', 'active', 'inactive', 'recently_activated', 'upgrade', 'mustuse', 'dropins', and 'search'.
	 *
	 * @return string[]              Plugin action links.
	 */
	public function plugin_action_links( $actions, $plugin_file, $plugin_data, $context ) {

		// Get plugin file.
		$plugin = plugin_basename( WP_CURRENCY_EXCHANGE_RATE_PLUGIN_FILE );

		// Bail early if the plugin is not Affiliate Engine.
		if ( $plugin !== $plugin_file ) {
			return $actions;
		}

		// Show settings link if the plugin is active.
		if ( is_plugin_active( $plugin ) ) {
			$settings_page_url   = get_admin_url( null, 'options-general.php?page=wpcer-options-page' );
			$actions['settings'] = "<a href=\"{$settings_page_url}\">Settings</a>";
		}

		return $actions;
	}
}
