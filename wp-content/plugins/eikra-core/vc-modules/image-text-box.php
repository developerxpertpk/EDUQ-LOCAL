<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_VC_Image_Text_Box' ) ) {

	class RDTheme_VC_Image_Text_Box extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Image Text Box", 'eikra-core' );
			$this->base = 'eikra-vc-image-text-box';
			$this->translate = array(
				'title'    => __( "Web Development", 'eikra-core' ),
				'subtitle' => __( "Over 1125 Courses", 'eikra-core' ),
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
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Image", 'eikra-core' ),
					"param_name" => "image",
					'description' => __( 'Recommended image size<br/>Style-1: 380x150 px<br/>Style-2:350x350 px', 'eikra-core' ),
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
					'dependency' => array(
						'element' => 'style',
						'value' => array( 'style1' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Link (Optional)", 'eikra-core' ),
					"param_name" => "link",
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
				'style'   => 'style1',
				'image'    => '',
				'title'    => $this->translate['title'],
				'subtitle' => $this->translate['subtitle'],
				'link'     => '',
				'css'      => '',
				), $atts ) );

			$template = 'image-text-box';

			switch ( $style ) {
				case 'style2':
				$template = 'image-text-box-2';
				break;

				default:
				$template = 'image-text-box';
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Image_Text_Box;