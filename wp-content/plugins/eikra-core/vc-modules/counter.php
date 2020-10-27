<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_VC_Counter' ) ) {

	class RDTheme_VC_Counter extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Counter", 'eikra-core' );
			$this->base = 'eikra-vc-counter';
			$this->translate = array(
				'title'   => __( "PROFESSIONAL TEACHER", 'eikra-core' ),
			);
			parent::__construct();
		}

		public function load_scripts(){
			wp_enqueue_script( 'waypoints' );
			wp_enqueue_script( 'counterup' );
		}

		public function fields(){
			$fields = array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Counter Number", 'eikra-core' ),
					"param_name" => "counter_number",
					"value" => '50',
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", 'eikra-core' ),
					"param_name" => "title",
					"value" => $this->translate['title'],
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Counter Color", "eikra-core" ),
					"param_name" => "counter_color",
					"value" => '',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Counter Bottom Line Color", "eikra-core" ),
					"param_name" => "bottom_color",
					"value" => '',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title color", "eikra-core" ),
					"param_name" => "title_color",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Counter Font Size", 'eikra-core' ),
					"param_name" => "counter_size",
					'value' => '',
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Font Size", 'eikra-core' ),
					"param_name" => "title_size",
					'value' => '',
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Counter Speed", 'eikra-core' ),
					"param_name" => "speed",
					"value" => '5000',
					'description' => __( 'The total duration of the count animation in milisecond eg. 5000', 'eikra-core' ),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Counter Steps", 'eikra-core' ),
					"param_name" => "steps",
					"value" => '10',
					'description' => __( 'Counter steps eg. 10', 'eikra-core' ),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Width", 'eikra-core' ),
					"param_name" => "maxwidth",
					'description' => __( 'Maximum width in px. Keep this field empty if you want full width', 'eikra-core' ),
				),
				array(
					'type' => 'css_editor',
					'heading' => __( 'Css', 'eikra-core' ),
					'param_name' => 'css',
					'group' => __( 'Design options', 'eikra-core' ),
				),
			);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'counter_number' => '50',
				'title'			 => $this->translate['title'],
				'counter_color'	 => '',
				'bottom_color'   => '',
				'title_color'	 => '',
				'counter_size'   => '',
				'title_size'     => '',
				'speed'          => '5000',
				'steps'          => '10',
				'maxwidth'	     => '',
				'css'            => '',
				), $atts ) );

			// validation
			$speed   = intval( $speed );
			$steps   = intval( $steps );

			$number          = intval( $counter_number );
			$text            = explode( $number, $counter_number );
			$counter_number  = $number;
			$counter_text    = !empty( $text[1] ) ? $text[1] : '';

			$this->load_scripts();

			$template = 'counter';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Counter;