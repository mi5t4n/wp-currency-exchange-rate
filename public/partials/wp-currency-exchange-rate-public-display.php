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
<div class="wpcer-card">
	<div class="wpcer-container">
		<div class="wpcer-base-currency">
			<span>1<span>
			<span id="wpcer-base-currency-code"><?php echo esc_html( $base_currency ); ?><span>
		</div>

		<div class="wpcer-conversion-currency">
			<span id="wpcer-conversion-currency-rate">
				<?php echo esc_html( round( $conversion_rate, $number_of_decimals ) ); ?>
			</span>
			<span id="wpcer-conversion-currency-code"><?php echo esc_html( $conversion_currency ); ?><span>
		</div>

		<div class="wpcer-datetime">
			<?php echo esc_html( $conversion_date ); ?>			
		</div>

		<div class="wpcer-form">
			<div class="wpcer-form-group">
				<input type="number" value="1" 
					class="wpcer-base-currency-amount"
					id="wpcer-base-currency-amount" />
				<select name="wpcer-base-currency" id="wpcer-base-currency-list">
				<?php foreach ( $currencies as $currency_code => $currency_name ) : ?>
					<option value="<?php echo esc_attr( $currency_code ); ?>" <?php selected( $base_currency, $currency_code ); ?>>
						<?php echo esc_html( $currency_name ); ?>
					</option>
				<?php endforeach; ?>
				</select>
			</div>

			<div class="wpcer-form-group">
				<input type="number" value="<?php echo esc_attr( round( $conversion_rate, $number_of_decimals ) ); ?>"
					class="wpcer-conversion-currency-amount"
					id="wpcer-conversion-currency-amount" />
				<select name="wpcer-conversion-currency" id="wpcer-conversion-currency-list">
				<?php foreach ( $currencies as $currency_code => $currency_name ) : ?>
					<option value="<?php echo esc_attr( $currency_code ); ?>" <?php selected( $conversion_currency, $currency_code ); ?>>
						<?php echo esc_html( $currency_name ); ?>
					</option>
				<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
</div>
<?php
