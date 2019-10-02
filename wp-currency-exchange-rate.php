<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sagartamang.com.np
 * @since             1.0.0
 * @package           Wp_Currency_Exchange_Rate
 *
 * @wordpress-plugin
 * Plugin Name:       WP Currency Exchange Rate
 * Plugin URI:        https://pluginurl.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Sagar Bahadur Tamang
 * Author URI:        https://sagartamang.com.np
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-currency-exchange-rate
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

if ( ! defined( 'WP_CURRENCY_EXCHANGE_RATE_VERSION' ) ) {
	define( 'WP_CURRENCY_EXCHANGE_RATE_VERSION', '1.0.0' );
}
if ( ! defined( 'WP_CURRENCY_EXCHANGE_RATE_PLUGIN_NAME' ) ) {
	define( 'WP_CURRENCY_EXCHANGE_RATE_PLUGIN_NAME', 'wp-currency-exchange-rate' );
}
if ( ! defined( 'WP_CURRENCY_EXCHANGE_RATE_PLUGIN_FILE' ) ) {
	define( 'WP_CURRENCY_EXCHANGE_RATE_PLUGIN_FILE', __FILE__ );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-currency-exchange-rate-activator.php
 */
function activate_wp_currency_exchange_rate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-currency-exchange-rate-activator.php';
	Wp_Currency_Exchange_Rate_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-currency-exchange-rate-deactivator.php
 */
function deactivate_wp_currency_exchange_rate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-currency-exchange-rate-deactivator.php';
	Wp_Currency_Exchange_Rate_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_currency_exchange_rate' );
register_deactivation_hook( __FILE__, 'deactivate_wp_currency_exchange_rate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-currency-exchange-rate.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_currency_exchange_rate() {

	$plugin = new Wp_Currency_Exchange_Rate();
	$plugin->run();

}
run_wp_currency_exchange_rate();
