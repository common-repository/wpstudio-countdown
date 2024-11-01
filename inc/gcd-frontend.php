<?php
/**
 * This file displays the countdown on the front end.
 *
 * @package Genesis Countdown
 * @subpackage Frontend
 *
 * @since 1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Sorry, you are not allowed to access this page directly.' );
}

$gcd_date        = genesis_get_option( 'gcd_date', 'gcd-settings' );
$gcd_hour        = genesis_get_option( 'gcd_hour', 'gcd-settings' );
$gcd_min         = genesis_get_option( 'gcd_min', 'gcd-settings' );
$gcd_sec         = genesis_get_option( 'gcd_sec', 'gcd-settings' );
$gdc_cntdwn      = $gcd_date . ' ' . $gcd_hour . ':' . $gcd_min . ':' . $gcd_sec;
$gcd_subtitle    = genesis_get_option( 'gcd_subtitle', 'gcd-settings' );
$gcd_button_text = genesis_get_option( 'gcd_button_text', 'gcd-settings' );
$gcd_button_link = genesis_get_option( 'gcd_button_link', 'gcd-settings' );

// print the subtitle.
if ( ! empty( $gcd_subtitle ) ) {

	echo '<h4 class="subtitle">' . $gcd_subtitle . '</h4>';

}

// print the clock.
echo '<div id="clock"></div>';

// print the cts button.
if ( ! empty( $gcd_button_text ) ) {

	echo '<a class="button" href="' . $gcd_button_link . '">' . $gcd_button_text . '</a>';

}

?>
<script>

	var php_date_var = "<?php echo $gdc_cntdwn; ?>";

	jQuery('#clock').countdown(php_date_var, function(event) {

		var jQuerythis = jQuery(this).html(event.strftime(''

		+ '<div><strong>%D</strong><span class="label">days</span></div>'
		+ '<div><strong>%H</strong><span class="label">hr</span></div>'
		+ '<div><strong>%M</strong><span class="label">min</span></div>'
		+ '<div><strong>%S</strong><span class="label">sec</span></div>'));

	});

</script>
