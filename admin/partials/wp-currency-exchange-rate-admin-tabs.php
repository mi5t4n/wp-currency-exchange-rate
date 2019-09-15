<?php
/**
 * Header for the settings page.
 *
 * @link       https://sagartamang.com.np
 * @since      1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/admin/partials
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div>
	<h1><?php esc_html_e( 'WP Currency Exchange Rate Settings', '' ); ?></h1>
	<h2 class="nav-tab-wrapper">
	<?php
	foreach ( $tabs as $tab_slug => $tab_name ) {
		$class = ( $tab_selected === $tab_slug ) ? ' nav-tab-active' : '';
		printf( '<a class="nav-tab%s" href="?page=wpcer-options-page&tab=%s">%s</a>', esc_attr( $class ), esc_attr( $tab_slug), esc_html( $tab_name ) );
	}
	?>
	</h2>
</div>
<?php
