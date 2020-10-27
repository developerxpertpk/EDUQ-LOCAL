<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_VC_Title' ) ) {

	class RDTheme_VC_Title extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Section Title", 'eikra-core' );
			$this->base = 'eikra-vc-title';
			$this->translate = array(
				'title' => __( "Welcome To Eikra", 'eikra-core' ),
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
						__( 'Style 1', 'eikra-core' ) => 'style1',
						__( 'Style 2', 'eikra-core' ) => 'style2',
						__( 'Style 3', 'eikra-core' ) => 'style3',
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
					"type" => "textarea",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Subtitle", 'eikra-core' ),
					"param_name" => "subtitle",
					"value" => "Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been theindustry's standard dummy text ever since the 1500s, when an unknown printer took.",
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title font size", 'eikra-core' ),
					"param_name" => "size",
					"value" => '',
					'description' => __( 'Title font size in px eg. 30', 'eikra-core' ),
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title color", "eikra-core" ),
					"param_name" => "title_color",
					"value" => '',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Subtitle color", "eikra-core" ),
					"param_name" => "subtitle_color",
					"value" => '',
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
				'style'          => 'style1',
				'title'          => $this->translate['title'],
				'subtitle'       => "Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been theindustry's standard dummy text ever since the 1500s, when an unknown printer took.",
				'size'           => '',
				'title_color'    => '',
				'subtitle_color' => '',
				'css'            => '',
				), $atts ) );

			$size = intval( $size );

			$template = 'title';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Title;