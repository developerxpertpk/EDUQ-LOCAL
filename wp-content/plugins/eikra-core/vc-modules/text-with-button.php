<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_VC_Text_Button' ) ) {

	class RDTheme_VC_Text_Button extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Text With Button", 'eikra-core' );
			$this->base = 'eikra-vc-text-button';
			$this->translate = array(
				'title'       => __( "Learn a new skill online on your time", 'eikra-core' ),
				'subtitle'    => __( "57,000 Online Courses", 'eikra-core' ),
				'button_text' => __( "START A FREE TRIAL", 'eikra-core' )
			);
			parent::__construct();
		}

		public function fields(){
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
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", 'eikra-core' ),
					"param_name" => "title",
					"value" => $this->translate['title'],
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Subtitle", 'eikra-core' ),
					"param_name" => "subtitle",
					"value" => $this->translate['subtitle'],
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Text", 'eikra-core' ),
					"param_name" => "button_text",
					"value" => $this->translate['button_text'],
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button URL", 'eikra-core' ),
					"param_name" => "button_url",
					"value" => '',
				),
			);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'style'       => 'light',
				'title'       => $this->translate['title'],
				'subtitle'    => $this->translate['subtitle'],
				'button_text' => $this->translate['button_text'],
				'button_url'  => '',
				), $atts ) );

			$template = 'text-with-button';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Text_Button;