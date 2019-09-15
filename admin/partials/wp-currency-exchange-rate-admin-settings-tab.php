<?php
/**
 * Settings tab content.
 */
?>
<table class="form-table">
	<tbody>
		<!-- Base Currency -->
		<tr>
			<th scope="row">
				<label for="wpcer_base_currency">
					<?php esc_html_e( 'Base Currency', '' ); ?>
				</label>
			</th>
			<td>
				<select name="wpcer_base_currency">
				<?php foreach ( $currencies_code as $currency_code ) : ?>
					<option value="<?php esc_attr_e( $currency_code ); ?>" <?php selected( $currency_code, $wpcer_base_currency ); ?>>
						<?php esc_html_e( $currency_code ); ?>
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
					<?php esc_html_e( 'Conversion Currency', '' ); ?>
				</label>
			</th>
			<td>
				<select name="wpcer_conversion_currency">
				<?php foreach ( $currencies_code as $currency_code ) : ?>
					<option value="<?php esc_attr_e( $currency_code ); ?>" <?php selected( $currency_code, $wpcer_conversion_currency ); ?>>
						<?php esc_html_e( $currency_code ); ?>
					</option>
				<?php endforeach; ?>					
				</select>
			</td>
		</tr>
		<!-- ./ Conversion Currency -->

		<!-- Fetch Interval -->
		<tr>
			<th scope="row">
				<label for="fetch_interval">
					<?php esc_html_e( 'Fetch Interval', '' ); ?>
				</label>
			</th>

			<td>
				<input type="number"
					name="wpcer_fetch_interval_num"
					id ="wpcer_fetch_interval_num" 
					value="<?php echo esc_attr( $wpcer_fetch_interval_num ); ?>" />

				<select name="wpcer_fetch_interval_unit">
					<option value="<?php echo esc_attr( HOUR_IN_SECONDS ); ?>" <?php selected( HOUR_IN_SECONDS, $wpcer_fetch_interval_unit ); ?>>
						<?php esc_html_e( 'Hours', '' ); ?>
					</option>
					<option value="<?php echo esc_attr( DAY_IN_SECONDS ); ?>" <?php selected( DAY_IN_SECONDS, $wpcer_fetch_interval_unit ); ?>>
						<?php esc_html_e( 'Days', '' ); ?>
					</option>
					<option value="<?php echo esc_attr( WEEK_IN_SECONDS ); ?>" <?php selected( WEEK_IN_SECONDS, $wpcer_fetch_interval_unit ); ?>>
						<?php esc_html_e( 'Weeks', '' ); ?>
					</option>
					<option value="<?php echo esc_attr( MONTH_IN_SECONDS ); ?>" <?php selected( MONTH_IN_SECONDS, $wpcer_fetch_interval_unit ); ?>>
						<?php esc_html_e( 'Months', '' ); ?>
					</option>
					<option value="<?php echo esc_attr( YEAR_IN_SECONDS ); ?>" <?php selected( YEAR_IN_SECONDS, $wpcer_fetch_interval_unit ); ?>>
						<?php esc_html_e( 'Years', '' ); ?>
					</option>
				</select>

				<button type="button" class="button">Fetch new rates</button>
			</td>
		</tr>
		<!-- ./ Fetch Interval -->
	</tbody>
</table>