<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/admin/partials
 */
?>

<div class="wrap">
	<?php
	/**
	 * Settings page header.
	 */
	do_action( 'wpcer_settings_page_tabs' );
	?>

	<form method="post" action="options.php">
	<?php
		/**
		 * Nonces, actions and referrers.
		 */
		settings_fields( 'wpcer' );

		/**
		 * Settings tab content.
		 */
		do_action( 'wpcer_settings_page_tab_content' );

		submit_button();
	?>
	</form>
</div>
<?php
