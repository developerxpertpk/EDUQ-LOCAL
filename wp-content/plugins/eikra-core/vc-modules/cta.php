<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_VC_CTA' ) ) {

	class RDTheme_VC_CTA extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Call To Action", 'eikra-core' );
			$this->base = 'eikra-vc-cta';
			$this->translate = array(
				'title'      => __( "Join 29,12,093 Students.", 'eikra-core' ),
				'buttontext' => __( "JOIN NOW", 'eikra-core' ),
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
					),
				),
				array(
					"type"		  => "attach_image",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Image", 'eikra-core' ),
					"param_name"  => "image",
					'description' => __( "For best match, upload an image of 819x300 px size" , 'eikra-core' ),
				),
				array(
					"type" 		  => "textarea_raw_html",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading"     => __( "Title", 'eikra-core' ),
					"param_name"  => "title",
					"value"       => base64_encode( $this->translate['title'] ),
					"rows"        => "1",
				),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Button Text", 'eikra-core' ),
					"param_name"  => "buttontext",
					"value" 	  => $this->translate['buttontext'],
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Button URL", 'eikra-core' ),
					"param_name"  => "buttonurl",
				),
				array(
					"type"        => "checkbox",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Open Link in New Tab", 'eikra-core' ),
					"param_name"  => "newtab",
				),
				array(
					'type'        => 'css_editor',
					'heading'     => __( 'Css', 'eikra-core' ),
					'param_name'  => 'css',
					'group'       => __( 'Design options', 'eikra-core' ),
					),
			);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'style'      => 'style1',
				'image'      => '',
				'title'      => base64_encode( $this->translate['title'] ),
				'buttontext' => $this->translate['buttontext'],
				'buttonurl'  => '',
				'newtab'     => '',
				'css'        => '',
				), $atts ) );

			$template = 'cta';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_CTA;