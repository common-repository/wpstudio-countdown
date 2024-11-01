<?php
/**
 * Plugin Name: Genesis Countdown
 * Plugin URI: http://wpstud.io/plugins
 * Description: The Genesis Countdown is a simple-to-use plugin for adding a Countdown to your Genesis Theme, using a widget.
 * Version: 1.2
 * Author: Frank Schrijvers
 * Author URI: http://www.wpstud.io
 * Text Domain: wpstudio-countdown
 * License: GPLv2
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'init', 'wps_gcd_load_plugin_textdomain' );
/**
 * Callback on the `plugins_loaded` hook.
 * Loads the plugin text domain via load_plugin_textdomain()
 *
 * @uses load_plugin_textdomain()
 * @since 1.0.0
 *
 * @access public
 * @return void
 */
function wps_gcd_load_plugin_textdomain() {
	load_plugin_textdomain( 'wpstudio-countdown', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

require_once ABSPATH . 'wp-admin/includes/plugin.php';


/**
 * Enqueue scripts and styles.
 */
function wps_gcd_load_scripts() {

	wp_enqueue_script( 'countdown', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.countdown.min.js', array( 'jquery' ) );

}
add_action( 'wp_enqueue_scripts', 'wps_gcd_load_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function wps_gcd_load_admin_scripts() {

	wp_enqueue_script( 'init-datepicker', plugin_dir_url( __FILE__ ) . 'assets/js/init-datepicker.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_style( 'jquery-style', plugin_dir_url( __FILE__ ) . 'assets/css/jquery-ui.css', array(), '.1.8.2' );

}
add_action( 'admin_enqueue_scripts', 'wps_gcd_load_admin_scripts', 99 );

/**
 * Load required files.
 */
function wps_gcd_init() {

	require dirname( __FILE__ ) . '/inc/class-gcd-settings.php';
	include dirname( __FILE__ ) . '/inc/class-gcd-widget.php';
	new Gcd_Settings();

}
add_action( 'genesis_setup', 'wps_gcd_init' );

/**
 * Enqueue scripts and styles.
 */
function scripts_and_styles() {

	if ( genesis_get_option( 'gcd_css', 'gcd-settings' ) == 1 ) {
		wp_enqueue_style( 'wpstudio-gow-style', plugin_dir_url( __FILE__ ) . 'assets/css/gcd-front-style.css', array(), '.1.0' );
	}

}
add_action( 'wp_enqueue_scripts', 'scripts_and_styles' );
