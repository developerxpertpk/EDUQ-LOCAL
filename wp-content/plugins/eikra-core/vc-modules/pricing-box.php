<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_VC_Pricing_Box' ) ) {

	class RDTheme_VC_Pricing_Box extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Pricing Box", 'eikra-core' );
			$this->base = 'eikra-vc-pricing';
			$this->translate = array(
				'title'   => __( "STANDARD", 'eikra-core' ),
				'btntext' => __( "BUY NOW", 'eikra-core' ),
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
						__( 'Style 3', 'eikra-core' ) => 'style3'
					),
				),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Background Color", 'eikra-core' ),
					"param_name" => "bgcolor",
					'value' => "",
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
					"heading" => __( "Currency Symbol", 'eikra-core' ),
					"param_name" => "currency",
					"value" => '$',
					"description" => __( "Currency sign eg. $", 'eikra-core' ),
					'dependency' => array(
						'element' => 'style',
						'value' => array( 'style3' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Price", 'eikra-core' ),
					"param_name" => "price",
					"value" => '$56',
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Unit Name", 'eikra-core' ),
					"param_name" => "unit",
					"value" => 'mo',
					"description" => __( "eg. month or year. Keep empty if you don't want to show unit", 'eikra-core' ),
				),
				array(
					"type" => "textarea",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Features", 'eikra-core' ),
					"param_name" => "features",
					"value" => "",
					"description" => __( "One line per feature. Put BLANK keyword if you want blank line. eg.<br/>Access to all courses<br/>Certificate after completion<br/>BLANK", 'eikra-core' ),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Text", 'eikra-core' ),
					"param_name" => "btntext",
					"value" => $this->translate['btntext'],
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button URL", 'eikra-core' ),
					"param_name" => "btnurl",
					"value" => "",
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Display as Featured", 'eikra-core' ),
					"param_name" => "featured",
					"value" => array(
						__( "Disabled", "eikra-core" ) => 'false',
						__( "Enabled", "eikra-core" )  => 'true',
					),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style3' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Maximum width", 'eikra-core' ),
					"param_name" => "maxwidth",
					"value" => "",
					"description" => __( "Maximum width in px. Keep empty if you want full width. eg. 300", 'eikra-core' ),
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

		private function validate( $str ){
			$str = trim( $str );
			// replace BLANK keyword
			if ( strtolower( $str ) == 'blank'  ) {
				return '&nbsp;';
			}
			return $str;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'style'	    => 'style1',
				'bgcolor'  	=> '',
				'title'    	=> $this->translate['title'],
				'currency'	=> '$',
				'price'    	=> '$56',		
				'unit'     	=> 'mo',
				'features' 	=> '',
				'btntext'  	=> $this->translate['btntext'],
				'btnurl'   	=> '',
				'featured' 	=> 'false',
				'maxwidth' 	=> '',
				'css'      	=> '',
				), $atts ) );

			$maxwidth = (int) $maxwidth;

			$features = strip_tags( $features ); // remove tags
			$features = preg_split( "/\R/", $features ); // string to array
			$features = array_map( array( $this, 'validate' ), $features ); // validate
			
			switch ( $style ) {
				case 'style1':
				$template = 'pricing-box-1';
				break;
				case 'style2':
				$template = 'pricing-box-2';
				break;
				case 'style3':
				$template = 'pricing-box-3';
				break;
				default:
				$template = 'pricing-box-1';
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Pricing_Box;