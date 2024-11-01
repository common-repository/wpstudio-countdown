<?php
/**
 * This file adds the options to the Admin.
 *
 * @package Genesis Countdown
 * @subpackage Admin
 *
 * @since 1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Sorry, you are not allowed to access this page directly.' );
}

/**
 * Register a metabox and default settings for the Genesis Simple Logo.
 *
 * @package Genesis\Admin
 */
class Gcd_Settings extends Genesis_Admin_Boxes {

	/**
	 * Create an archive settings admin menu item and settings page.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$settings_field   = 'gcd-settings';
		$page_id          = 'genesis-countdown';
		$menu_ops         = array(
			'submenu' => array(
				'parent_slug' => 'genesis',
				'page_title'  => __( 'Genesis Countdown Settings', 'wpstudio-countdown' ),
				'menu_title'  => __( 'Countdown', 'wpstudio-countdown' ),
			),
		);
		$page_ops         = array(); // use defaults.
		$center           = current_theme_supports( 'genesis-responsive-viewport' ) ? 'mobile' : 'never';
		$default_settings = apply_filters(
			'gcd_settings_defaults',
			array(
				'gcd_date' => '',
				'gcd_hour' => '00',
				'gcd_min'  => '00',
				'gcd_sec'  => '00',
			)
		);
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );
		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitizer_filters' ) );
	}

	/**
	 * Register each of the settings with a sanitization filter type.
	 *
	 * @since 1.0.0
	 * @uses genesis_add_option_filter() Assign filter to array of settings.
	 * @see \Genesis_Settings_Sanitizer::add_filter()
	 */
	public function sanitizer_filters() {
		genesis_add_option_filter(
			'no_html',
			$this->settings_field,
			array(
				'gcd_date',
				'gcd_subtitle',
				'gcd_button_text',
				'gcd_button_link',
			)
		);
	}

	/**
	 * Register Metabox for the Genesis Simple Logo.
	 *
	 * @uses  add_meta_box()
	 * @since 1.0.0
	 */
	public function metaboxes() {
		add_meta_box( 'genesis-theme-settings-version', __( 'Plugin Information', 'wpstudio-countdown' ), array( $this, 'info_box' ), $this->pagehook, 'main', 'high' );
		add_meta_box( 'gcd-settings', __( 'Plugin Settings', 'wpstudio-countdown' ), array( $this, 'gcd_settings' ), $this->pagehook, 'main', 'high' );
	}

	/**
	 * Create Metabox which links to and explains the WordPress customizer.
	 *
	 * @uses  wp_customize_url()
	 * @since 1.0.0
	 */
	public function info_box() {

		echo '<ul>
		<li><strong style="width: 180px; margin: 0 40px 20px 0; display: inline-block; font-weight: 600;">' . __( 'Developed By:', 'wpstudio-countdown' ) . '</strong> <a href="https://www.wpstud.io" target="_blank">WPStudio</a></li>
		<li><strong style="width: 180px; margin: 0 40px 20px 0; display: inline-block; font-weight: 600;">' . __( 'Follow on twitter:', 'wpstudio-countdown' ) . '</strong> <a href="https://twitter.com/wpstudiowp">https://twitter.com/wpstudiowp</a></li>
		<li><strong style="width: 180px; margin: 0 40px 20px 0; display: inline-block; font-weight: 600;">' . __( 'Follow on facebook:', 'wpstudio-countdown' ) . '</strong> <a href="https://www.facebook.com/wpstudiowp">https://www.facebook.com/wpstudiowp</a></li>
		<li><strong style="width: 180px; margin: 0 40px 20px 0; display: inline-block; font-weight: 600;">' . __( 'Contact:', 'wpstudio-countdown' ) . '</strong> <a href="mailto:info@wpstud.io">info@wpstud.io</a></li>
		</ul>';

	}

	/**
	 * Display Settings.
	 */
	public function gcd_settings() {

		?>

		<p>
			<label style="width: 180px; margin: 0 40px 0 0; font-weight: bold; display: inline-block;" for="<?php echo $this->get_field_id( 'gcd_css' ); ?>"><?php _e( 'Load plugin styling?', 'wpstudio-countdown' ); ?></label>
			<input type = "checkbox" name="<?php echo $this->get_field_name( 'gcd_css' ); ?>" id="<?php echo $this->get_field_id( 'gow_css' ); ?>" value="1"<?php checked( $this->get_field_value( 'gcd_css' ) ); ?> />
		</p>

		<p>
			<label style="width: 180px; margin: 0 40px 0 0; font-weight: bold; display: inline-block;" for="<?php echo $this->get_field_id( 'gcd_date' ); ?>"><?php _e( 'Target date (YY-MM-DD)', 'wpstudio-countdown' ); ?>
			</label>

			<input type=text" style="width: 132px;"" type="text" data-default-color="#ffffff" name="<?php echo $this->get_field_name( 'gcd_date' ); ?>" id="MyDate" value="<?php echo $this->get_field_value( 'gcd_date' ); ?>" />
		</p>
		<p>
			<label style="width: 180px; margin: 0 40px 0 0; font-weight: bold; display: inline-block;" for="<?php echo $this->get_field_id( 'gcd_time' ); ?>"><?php _e( 'Target time (HH:MM:SS)', 'wpstudio-countdown' ); ?>
			</label>

			<input type=text" style="width: 40px;"" type="text" data-default-color="#ffffff" name="<?php echo $this->get_field_name( 'gcd_hour' ); ?>" id="MyDate" value="<?php echo $this->get_field_value( 'gcd_hour' ); ?>" />
			<input type=text" style="width: 40px;"" type="text" data-default-color="#ffffff" name="<?php echo $this->get_field_name( 'gcd_min' ); ?>" id="MyDate" value="<?php echo $this->get_field_value( 'gcd_min' ); ?>" />
			<input type=text" style="width: 40px;"" type="text" data-default-color="#ffffff" name="<?php echo $this->get_field_name( 'gcd_sec' ); ?>" id="MyDate" value="<?php echo $this->get_field_value( 'gcd_sec' ); ?>" />
		</p>
		<p>
			<label style="width: 180px; margin: 0 40px 0 0; font-weight: bold; display: inline-block;" for="<?php echo $this->get_field_id( 'gcd_subtitle' ); ?>"><?php _e( 'Set subtitle', 'wpstudio-countdown' ); ?>
			</label>

			<input type=text" style="width: 630px;"" type="text" data-default-color="#ffffff" name="<?php echo $this->get_field_name( 'gcd_subtitle' ); ?>" id="MyDate" value="<?php echo $this->get_field_value( 'gcd_subtitle' ); ?>" />
		</p>
		<p>
			<label style="width: 180px; margin: 0 40px 0 0; font-weight: bold; display: inline-block;" for="<?php echo $this->get_field_id( 'gcd_subtitle' ); ?>"><?php _e( 'Set Button text', 'wpstudio-countdown' ); ?>
			</label>

			<input type=text" style="width: 630px;"" type="text" data-default-color="#ffffff" name="<?php echo $this->get_field_name( 'gcd_button_text' ); ?>" id="MyDate" value="<?php echo $this->get_field_value( 'gcd_button_text' ); ?>" />
		</p>
		<p>
			<label style="width: 180px; margin: 0 40px 0 0; font-weight: bold; display: inline-block;" for="<?php echo $this->get_field_id( 'gcd_button_link' ); ?>"><?php _e( 'Set Button link', 'wpstudio-countdown' ); ?>
			</label>

			<input type=text" style="width: 630px;"" type="text" data-default-color="#ffffff" name="<?php echo $this->get_field_name( 'gcd_button_link' ); ?>" id="MyDate" value="<?php echo $this->get_field_value( 'gcd_button_link' ); ?>" />
		</p>

		<?php
	}

}
