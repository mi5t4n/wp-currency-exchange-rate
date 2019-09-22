(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	function getConversionRate(baseCurrency, conversionCurrency) {
		// If the base and conversion currency is same, return 1.
		if (baseCurrency === conversionCurrency) {
			return 1;
		}

		// Get rates.
		var rates = wpcer.rates;

		// If the exchange rate base currency is supplied base currency,
		// lookup to convert the base currency to conversion currenny.
		if ( typeof rates['base'][ conversionCurrency ] !== undefined && baseCurrency === rates['base'] ) {
			return rates['rates'][ conversionCurrency ];
		}

		// If the exchange rate base currency is not supplied base currency,
		// compute the conversion rate.
		if ( typeof rates['base'][conversionCurrency] !== undefined && typeof rates['base'][baseCurrency] !== undefined && baseCurrency !== rates['base'] ) {
			var baseCurrencyFloat       = parseFloat( rates['rates'][ baseCurrency ] );
			var conversionCurrencyFloat = parseFloat( rates['rates'][ conversionCurrency ] );
			var computedRate            = ( 1.0 / baseCurrencyFloat ) * conversionCurrencyFloat;
			return computedRate;
		}

		// Return null for failsafe.
		return null;
	}

	/**
	 * Round off function.
	 *
	 * @param {float} num Number
	 * @param {int} decimal Number of decimal place to round off.
	 */
	function roundOff( num, decimal) {
		return Math.round( num * Math.pow(10, decimal ) ) / Math.pow( 10, decimal );
	}

	$(document).ready(function(){
		/**
		 * Update the conversion currency amount when the base currency amount is changed.
		 */
		$('#wpcer-base-currency-amount').bind('keyup change', function(){
			debugger;
			var baseCurrencyAmount = $('#wpcer-base-currency-amount').val();
			var baseCurrency       = $('#wpcer-base-currency-list option:selected').val();
			var conversionCurrency = $('#wpcer-conversion-currency-list option:selected').val();

			// Get number of decimals.
			var numberOfDecimals = parseFloat( wpcer.numberOfDecimals );

			// Get conversion rate.
			var conversionRate = getConversionRate( baseCurrency, conversionCurrency );
			    conversionRate = roundOff( conversionRate, numberOfDecimals );

			// Calculate the conversion currency amount.
			var conversionCurrencyAmount = conversionRate * baseCurrencyAmount;
			conversionCurrencyAmount = roundOff(conversionCurrencyAmount, numberOfDecimals);

			// Set the conversion currency amount.
			$('#wpcer-conversion-currency-amount').val(conversionCurrencyAmount );
			
		});
	
		/**
		 * Update the base currency amount when the conversion currency amount is changed.
		 */
		$('#wpcer-conversion-currency-amount').bind('keyup change', function(event){
			var conversionCurrencyAmount = $('#wpcer-conversion-currency-amount').val();
			var baseCurrency             = $('#wpcer-base-currency-list option:selected').val();
			var conversionCurrency       = $('#wpcer-conversion-currency-list option:selected').val();

			// Get number of decimals.
			var numberOfDecimals = parseFloat( wpcer.numberOfDecimals );

			// Get conversion rate.
			var conversionRate           = getConversionRate( conversionCurrency, baseCurrency );
			    conversionRate           = roundOff(conversionRate, numberOfDecimals);

			// Calculate the conversion currency amount.
			var baseCurrencyAmount = conversionRate * conversionCurrencyAmount;
			baseCurrencyAmount = roundOff( baseCurrencyAmount, numberOfDecimals );

			// Set the conversion currency amount.
			$('#wpcer-base-currency-amount').val(baseCurrencyAmount );
		});

		/**
		 * Calculate the currencies amount when the currencies are changesd
		 */
		$('#wpcer-base-currency-list').change(currenciesChange);
		$('#wpcer-conversion-currency-list').change(currenciesChange);

		/**
		 * Update currencies fields.
		 * @param {Event} event JavaScript event.
		 */
		function currenciesChange(event) {
			var baseCurrencyAmount       = $('#wpcer-base-currency-amount').val();
			var conversionCurrencyAmount = $('#wpcer-conversion-currency-amount').val();
			var baseCurrency             = $('#wpcer-base-currency-list option:selected').val();
			var conversionCurrency       = $('#wpcer-conversion-currency-list option:selected').val();

			// Get number of decimals.
			var numberOfDecimals = parseFloat( wpcer.numberOfDecimals );

			// Get conversion rate.
			var conversionRate = getConversionRate( baseCurrency, conversionCurrency );
			    conversionRate = roundOff(conversionRate, numberOfDecimals)

			// Update the default displayed.
			$('#wpcer-base-currency-code').html(baseCurrency);
			$('#wpcer-conversion-currency-code').html(conversionCurrency);
			$('#wpcer-conversion-currency-rate').html(conversionRate);

			// Trigger event manually update the input fields.
			$('#wpcer-base-currency-amount').trigger('change');			
		}
	});
	
})( jQuery );
