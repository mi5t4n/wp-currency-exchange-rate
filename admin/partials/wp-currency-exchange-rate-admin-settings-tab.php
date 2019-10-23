<?php
/**
 * Settings tab content.
 *
 * @since 1.0.0
 *
 * @package    Wp_Currency_Exchange_Rate
 * @subpackage Wp_Currency_Exchange_Rate/admin
 */

?>
<table class="form-table">
	<tbody>
		<!-- Base Currency -->
		<tr>
			<th scope="row">
				<label for="wpcer_base_currency">
					<?php esc_html_e( 'Base Currency', 'wp-currency-exchange-rate' ); ?>
				</label>
			</th>
			<td>
				<select name="wpcer_base_currency">
				<?php foreach ( $currencies as $currency_code => $currency_name ) : ?>
					<option value="<?php echo esc_attr( $currency_code ); ?>" <?php selected( $currency_code, $base_currency ); ?>>
						<?php echo esc_html( "$currency_name ($currency_code)" ); ?>
					</option>
				<?php endforeach; ?>
				</select>
			</td>
		</tr>
		<!-- ./ Base Currency -->

		<!-- Conversion Currency -->
		<tr>
			<th scope="row">
				<label for="wpcer_conversion_currency">
					<?php esc_html_e( 'Conversion Currency', 'wp-currency-exchange-rate' ); ?>
				</label>
			</th>
			<td>
				<select name="wpcer_conversion_currency">
				<?php foreach ( $currencies as $currency_code => $currency_name ) : ?>
					<option value="<?php echo esc_attr( $currency_code ); ?>" <?php selected( $currency_code, $conversion_currency ); ?>>
						<?php echo esc_attr( "$currency_name ($currency_code)" ); ?>
					</option>
				<?php endforeach; ?>					
				</select>
			</td>
		</tr>
		<!-- ./ Conversion Currency -->

		<!-- Number of decimals -->
		<tr>
			<th scope="row">
				<label for="wpcer-number-of-decimals">
					<?php esc_html_e( 'Number of decimals', 'wp-currency-exchange-rate' ); ?>
				</label>
			</th>

			<td>
				<input type="number"
					name="wpcer_number_of_decimals"
					id="wpcer-number-of-decimals"
					value= "<?php echo esc_attr( $number_of_decimals ); ?>" />
			</td>
		</tr>
		<!-- ./ Number of decimals -->

		<!-- Fetch Interval -->
		<tr>
			<th scope="row">
				<label for="wpcer-fetch-interval-num">
					<?php esc_html_e( 'Fetch Interval', 'wp-currency-exchange-rate' ); ?>
				</label>
			</th>

			<td>
				<input type="number"
					name="wpcer_fetch_interval_num"
					id ="wpcer-fetch-interval-num" 
					value="<?php echo esc_attr( $fetch_interval_num ); ?>" />

				<select name="wpcer_fetch_interval_unit">
					<option value="<?php echo esc_attr( HOUR_IN_SECONDS ); ?>" <?php selected( HOUR_IN_SECONDS, $fetch_interval_unit ); ?>>
						<?php esc_html_e( 'Hours', 'wp-currency-exchange-rate' ); ?>
					</option>
					<option value="<?php echo esc_attr( DAY_IN_SECONDS ); ?>" <?php selected( DAY_IN_SECONDS, $fetch_interval_unit ); ?>>
						<?php esc_html_e( 'Days', 'wp-currency-exchange-rate' ); ?>
					</option>
					<option value="<?php echo esc_attr( WEEK_IN_SECONDS ); ?>" <?php selected( WEEK_IN_SECONDS, $fetch_interval_unit ); ?>>
						<?php esc_html_e( 'Weeks', 'wp-currency-exchange-rate' ); ?>
					</option>
					<option value="<?php echo esc_attr( MONTH_IN_SECONDS ); ?>" <?php selected( MONTH_IN_SECONDS, $fetch_interval_unit ); ?>>
						<?php esc_html_e( 'Months', 'wp-currency-exchange-rate' ); ?>
					</option>
					<option value="<?php echo esc_attr( YEAR_IN_SECONDS ); ?>" <?php selected( YEAR_IN_SECONDS, $fetch_interval_unit ); ?>>
						<?php esc_html_e( 'Years', 'wp-currency-exchange-rate' ); ?>
					</option>
				</select>

				<button type="button" class="button">Fetch new rates</button>
			</td>
		</tr>
		<!-- ./ Fetch Interval -->
	</tbody>
</table>
<?php
