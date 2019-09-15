<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div>
	<div>
		<label><?php esc_html_e( 'Base Currency', '' ); ?></label>
		<span><?php echo esc_html( $base_currency ); ?></span>
	</div>

	<div>
		<label><?php esc_html_e( 'Conversion Currency', '' ); ?></label>
		<span><?php echo esc_html( $conversion_currency ); ?></span>
	</div>
</div>
