<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_VC_Contact' ) ) {

	class RDTheme_VC_Contact extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Contact", 'eikra-core' );
			$this->base = 'eikra-vc-contact';
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
						__( "Style 1", 'eikra-core' ) => 'style1',
						__( "Style 2", 'eikra-core' ) => 'style2',
					),
				),
				array(
					"type" => "textarea",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Address", 'eikra-core' ),
					"param_name" => "address",
					"value" => "PO Box 1212, California, US",
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Email", 'eikra-core' ),
					"param_name" => "email",
					"value" => "example@example.com",
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Phone", 'eikra-core' ),
					"param_name" => "phone",
					"value" => "+61 1111 3333",
				),
				array(
					"type"        => "dropdown",
					"holder"      => "div",
					"class" 	  => "",
					"heading"     => __( "Social Links Display", 'eikra-core' ),
					"param_name"  => "socials",				
					'description' => __( 'Social Links which are already set in Theme Options', 'eikra-core' ),
					'value' => array(
						__( "Enabled", 'eikra-core' )  => 'true',
						__( "Disabled", 'eikra-core' ) => 'false',
					),
				),
				array(
					'type' 		 => 'css_editor',
					'heading' 	 => __( 'Css', 'eikra-core' ),
					'param_name' => 'css',
					'group' 	 => __( 'Design options', 'eikra-core' )
				),
			);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'style'   => 'style1',
				'address' => 'PO Box 1212, California, US',
				'email'   => 'example@example.com',
				'phone'   => '+61 1111 3333',
				'socials' => 'true',
				'css'     => '',
				), $atts ) );

			switch ( $style ) {
				case 'style2':
				$template = 'contact-2';
				break;
				default:
				$template = 'contact-1';
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Contact;