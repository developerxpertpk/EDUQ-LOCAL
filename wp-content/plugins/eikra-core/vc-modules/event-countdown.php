<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.7
 */

if ( !class_exists( 'RDTheme_VC_Event_Countdown' ) ) {

	class RDTheme_VC_Event_Countdown extends RDTheme_VC_Modules {
		
		public $event_id;

		public function __construct(){
			$this->name = __( "Eikra: Event Countdown", 'eikra-core' );
			$this->base = 'eikra-vc-event-countdown';
			$this->translate = array(
				'buttontext' => __( "JOIN WITH US", 'eikra-core' ),
			);
			parent::__construct();
		}

		public function load_scripts(){	
			wp_enqueue_script( 'js-countdown' );
		}
		
		public function fields(){	
			
			$args = array(
				'post_type'           => 'ac_event',
				'posts_per_page'      => -1,
				'suppress_filters'    => false,
				'ignore_sticky_posts' => 1,
			);

			$posts_array = get_posts( $args );

			if( !empty( $posts_array ) ){
				foreach ( $posts_array as $post ) {
					$post_dropdown[$post->post_title] = $post->ID;					
				}
				$this->event_id = $posts_array[0]->ID;
			}
			else {
				$post_dropdown = $this->event_id = '';
			}

			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Style", 'eikra-core' ),
					"param_name" => "style",
					'value' => array(
						__( "Light Background", 'eikra-core' )  => 'light',
						__( "Dark Background", 'eikra-core' )   => 'dark',
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Event", 'eikra-core' ),
					"param_name" => "id",
					'value' => $post_dropdown,
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Type", 'eikra-core' ),
					"param_name" => "title_type",
					'value' => array(
						__( "Same as Event", 'eikra-core' ) => 'event',
						__( "Custom Title", 'eikra-core' )  => 'custom',
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Custom Title", 'eikra-core' ),
					"param_name" => "title",
					"value" => '',
					'dependency' => array(
						'element' => 'title_type',
						'value'   => array( 'custom' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Text", 'eikra-core' ),
					"param_name" => "btntxt",
					"value" => $this->translate['buttontext'],
				),
				array(
					'type' => 'css_editor',
					'heading' => __( 'Css', 'eikra-core' ),
					'param_name' => 'css',
					'group' => __( 'Design options', 'eikra-core' )
				),
			);
			return $fields;
		}
		
		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(	
				'style'      => 'light',
				'id'         => $this->event_id,
				'title_type' => 'event',
				'title'      => '',
				'btntxt'     => $this->translate['buttontext'],
				'css'        => '',
				), $atts ) );
			
			$this->load_scripts();
			$template = 'event-countdown';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Event_Countdown;