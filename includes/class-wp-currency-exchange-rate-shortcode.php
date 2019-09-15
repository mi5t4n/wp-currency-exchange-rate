<?php
/**
 * Shortcodes.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate_Shortcode
 * @subpackage Wp_Currency_Exchange_Rate_Shortcode/includes
 */

/**
 * Shortcodes
 *
 * @package    Wp_Currency_Exchange_Rate_Shortcode
 * @subpackage Wp_Currency_Exchange_Rate_Shortcode/includes
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
	 */
	private function init() {
		$this->init_hooks();
		$this->init_shortcodes();

		// Let 3rd party to remove the hooks, shortcodes and widgets.
		do_action( 'wpcer_shortcode', $this );
	}

	/**
	 * Initialize hooks.
	 *
	 * @since 1.0.0
	 */
	private function init_hooks() {

	}

	/**
	 * Intialize shortcodes.
	 *
	 * @since 1.0.0
	 */
	private function init_shortcodes() {
		add_shortcode( 'wpcer_post', array( $this, 'display_content' ) );
	}

	/**
	 * Display the shortcode content.
	 *
	 * @since 1.0.0
	 */
	public function display_content( $attributes, $content ) {
		$post_id = isset( $attributes['id'] ) ? intval( $attributes['id'] ) : null;

		if ( null === $post_id ) {
			echo '<span>Id not found</span>';
		}

		$base_currency       = get_post_meta( $post_id, 'wpcer_base_currency', true );
		$conversion_currency = get_post_meta( $post_id, 'wpcer_conversion_currency', true );

		require plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/wp-currency-exchange-rate-public-display.php';
	}
}
