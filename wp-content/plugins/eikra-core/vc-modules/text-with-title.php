<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.0
 */

if ( !class_exists( 'RDTheme_VC_Text_Title' ) ) {

	class RDTheme_VC_Text_Title extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Text With Title", 'eikra-core' );
			$this->base = 'eikra-vc-text-title';
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
						__( 'Style 4', 'eikra-core' ) => 'style4',
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
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", 'eikra-core' ),
					"param_name" => "content",
					"value" => "Tmply dummy text of the printing and typesetting indust Lorem Ipsum has been theindustry's standard dummy text ever since simply dummy text of the printing and etypesetting industry. Lorem Ipsum has been the induststandard dummy text ever since en an unknown printer took a galley of type scrambledmaining.",
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Text", 'eikra-core' ),
					"param_name" => "button_text",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button URL", 'eikra-core' ),
					"param_name" => "button_url",
					"value" => '',
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Width", 'eikra-core' ),
					"param_name" => "width",
					'description' => __( "Content maximum width in px eg 540. Keep this field empty if you want full width", 'eikra-core' ),
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
				'style'       => 'style1',
				'title'       => $this->translate['title'],
				'button_text' => '',
				'button_url'  => '',
				'width'       => '',
				'css'         => '',
				), $atts ) );

			$width = intval( $width );

			$template = 'text-with-title';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Text_Title;