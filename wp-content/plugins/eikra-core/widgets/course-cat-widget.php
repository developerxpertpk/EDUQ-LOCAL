<?php
/**
 * @author  RadiusTheme
 * @since   2.2
 * @version 2.2
 */

if ( ! class_exists( 'RDTheme_Course_Category_Widget' ) ){
	class RDTheme_Course_Category_Widget extends WP_Widget {
		public function __construct() {
			parent::__construct(
            'rdtheme_course_category', // Base ID
            esc_html__( 'Eikra: Course Category', 'eikra-core' ), // Name
            array( 'description' => esc_html__( 'Eikra: Course Category Widget', 'eikra-core' ) 
        ) );
		}

		public function widget( $args, $instance ){
			echo wp_kses_post( $args['before_widget'] );
			if ( ! empty( $instance['title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
			}

			$cat_args = array(
				'taxonomy'     => 'course_category',
				'orderby'      => 'name',
				'title_li'     => '',
				'show_count'   => ! empty( $instance['count'] ) ? '1' : '0',
				'hierarchical' => ! empty( $instance['hierarchical'] ) ? '1' : '0',
			);
			?>
			<ul>
				<?php wp_list_categories( $cat_args );?>
			</ul>

			<?php
			echo wp_kses_post( $args['after_widget'] );
		}

		public function update( $new_instance, $old_instance ){
			$instance                 = array();
			$instance['title']        = !empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
			$instance['count']        = !empty( $new_instance['count'] ) ? 1 : 0;
			$instance['hierarchical'] = !empty( $new_instance['hierarchical'] ) ? 1 : 0;
			return $instance;
		}

		public function form( $instance ){
			$defaults = array(
				'title'        => esc_html__( 'Course Categories', 'eikra-core' ) ,
				'count'        => '',
				'hierarchical' => '',
			);
			$instance = wp_parse_args( (array) $instance, $defaults );

			$fields = array(
				'title'     => array(
					'label' => esc_html__( 'Title', 'eikra-core' ),
					'type'  => 'text',
				),
				'count'   => array(
					'label' => esc_html__( 'Show post counts', 'eikra-core' ),
					'type'  => 'checkbox',
				),
				'hierarchical' => array(
					'label' => esc_html__( 'Show hierarchy', 'eikra-core' ),
					'type'  => 'checkbox',
				),
			);

			RT_Widget_Fields::display( $fields, $instance, $this );
		}
	}
}