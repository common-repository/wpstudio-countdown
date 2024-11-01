<?php
/**
 * This file creates the Countdown widget.
 *
 * @package Genesis Countdown
 * @subpackage Widget
 *
 * @since 1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {

	die( 'Sorry, you are not allowed to access this page directly.' );

}

/**
 * Register Widget.
 */
function gcd_init_widget() {

	register_widget( 'Gcd_Widget' );

}
add_action( 'widgets_init', 'gcd_init_widget' );

/**
 * GTS Widget Class.
 */
class Gcd_Widget extends WP_Widget {

	/**
	 * Construct Class.
	 */
	public function __construct() {

		parent::__construct(
			'Gcd_Widget',
			__( 'Countdown', 'wpstudio-countdown' ),
			array(
				'description' => __( 'Displays countdown', 'wpstudio-countdown' ),
				'classname'   => 'gcd-countdown',
			)
		);

	}

	/**
	 * Widget.
	 *
	 * @param  array  $args Widget args.
	 * @param  string $instance This widget.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {

			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];

		}

		include dirname( __FILE__ ) . '/gcd-frontend.php';

		echo '</div></section>';

	}

	/**
	 * Widget Form
	 *
	 * @param  array $instance Form settings.
	 */
	public function form( $instance ) {

		global $gcd_title;

		if ( isset( $instance['title'] ) ) {

			$gcd_title = $instance['title'];

		}

		echo '<p>';
		echo '<label for="' . $this->get_field_id( 'title' ) . '">' . _e( 'Title:' ) . '</label>';
		echo '<input class="widefat" id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . 'type="text" value="' . esc_attr( $gcd_title ) . '">';
		echo '</p>';

	}

	/**
	 * Save settings.
	 *
	 * @param  array $new_instance Array of widget settings.
	 * @param  array $old_instance Array of old widget settings.
	 * @return array               Array of new widget settings.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance          = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;

	}
}
