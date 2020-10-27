<?php
/**
 * @author  RadiusTheme
 * @since   2.2
 * @version 2.2
 */

if ( ! class_exists( 'RDTheme_Information_Widget' ) ){
	class RDTheme_Information_Widget extends WP_Widget {
		public function __construct() {
			parent::__construct(
            'rdtheme_info', // Base ID
            esc_html__( 'Eikra: Information', 'eikra-core' ), // Name
            array( 'description' => esc_html__( 'Eikra: Information Widget', 'eikra-core' ) 
            	) );
		}

		public function widget( $args, $instance ){
			echo wp_kses_post( $args['before_widget'] );
			if ( ! empty( $instance['title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
			}
			?>
			<ul>
				<?php 
				if( !empty( $instance['address'] ) ){
					?><li><i class="fa fa-paper-plane-o" aria-hidden="true"></i><?php echo wp_kses_post( $instance['address'] ); ?></li><?php
				}
				if( !empty( $instance['phone'] ) ){
					?><li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo esc_attr( $instance['phone'] ); ?>"><?php echo esc_html( $instance['phone'] ); ?></a></li><?php
				}
				if( !empty( $instance['phone2'] ) ){
					?><li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo esc_attr( $instance['phone2'] ); ?>"><?php echo esc_html( $instance['phone2'] ); ?></a></li><?php
				}
				if( !empty( $instance['email'] ) ){
					?><li><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:<?php echo esc_attr( $instance['email'] ); ?>"><?php echo esc_html( $instance['email'] ); ?></a></li><?php
				}
				if( !empty( $instance['fax'] ) ){
					?><li><i class="fa fa-fax" aria-hidden="true"></i> <?php echo esc_html( $instance['fax'] ); ?></li><?php
				}
				?>
			</ul>

			<?php
			echo wp_kses_post( $args['after_widget'] );
		}

		public function update( $new_instance, $old_instance ){
			$instance              = array();
			$instance['title']     = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
			$instance['address']   = ( ! empty( $new_instance['address'] ) ) ? wp_kses_post( $new_instance['address'] ) : '';
			$instance['phone']     = ( ! empty( $new_instance['phone'] ) ) ? sanitize_text_field( $new_instance['phone'] ) : '';
			$instance['phone2']    = ( ! empty( $new_instance['phone2'] ) ) ? sanitize_text_field( $new_instance['phone2'] ) : '';
			$instance['email']     = ( ! empty( $new_instance['email'] ) ) ? sanitize_email( $new_instance['email'] ) : '';
			$instance['fax']       = ( ! empty( $new_instance['fax'] ) ) ? sanitize_text_field( $new_instance['fax'] ) : '';
			return $instance;
		}

		public function form( $instance ){
			$defaults = array(
				'title'   => esc_html__( 'Information' , 'eikra-core' ),
				'address' => '',
				'phone'   => '',
				'phone2'  => '',
				'email'   => '',
				'fax'     => ''
			);
			$instance = wp_parse_args( (array) $instance, $defaults );

			$fields = array(
				'title'     => array(
					'label' => esc_html__( 'Title', 'eikra-core' ),
					'type'  => 'text',
				),
				'address'   => array(
					'label' => esc_html__( 'Address', 'eikra-core' ),
					'type'  => 'textarea',
				),
				'phone'     => array(
					'label' => esc_html__( 'Phone 1', 'eikra-core' ),
					'type'  => 'text',
				),
				'phone2'    => array(
					'label' => esc_html__( 'Phone 2', 'eikra-core' ),
					'type'  => 'text',
				),
				'email'     => array(
					'label' => esc_html__( 'Email', 'eikra-core' ),
					'type'  => 'text',
				),
				'fax'       => array(
					'label' => esc_html__( 'Fax', 'eikra-core' ),
					'type'  => 'text',
				)
			);

			RT_Widget_Fields::display( $fields, $instance, $this );
		}
	}
}