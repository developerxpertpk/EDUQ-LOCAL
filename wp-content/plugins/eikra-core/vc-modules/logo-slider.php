<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.2
 */

if ( !class_exists( 'RDTheme_VC_Logo_Slider' ) ) {

	class RDTheme_VC_Logo_Slider extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Logo Slider", 'eikra-core' );
			$this->base = 'eikra-vc-logo';
			$this->translate = array(
				'title' => __( "Featured Courses", 'eikra-core' ),
				'cols'  => array( 
					__( '1 col', 'eikra-core' ) => '12',
					__( '2 col', 'eikra-core' ) => '6',
					__( '3 col', 'eikra-core' ) => '4',
					__( '4 col', 'eikra-core' ) => '3',
					__( '6 col', 'eikra-core' ) => '2',
				),
			);
			parent::__construct();
		}
		
		public function load_scripts(){	
			wp_enqueue_style( 'owl-carousel' );
			wp_enqueue_style( 'owl-theme-default' );
			wp_enqueue_script( 'owl-carousel' );
			wp_enqueue_style( 'course-review' );
		}

		public function fields(){
			$fields = array(
				array(
					'type' => 'param_group',
					'value' => '',
					'param_name' => 'logos',
					"heading" => __( "Add as many as logo images you want. All images must be in the same size. Recommended image size is 270x130 px.", 'eikra-core' ),
					'params' => array(
						array(
							"type"		 => "attach_image",
							"holder" 	 => "div",
							"class" 	 => "",
							"heading" 	 => __( "Image", 'eikra-core' ),
							"param_name" => "image",
						),
						array(
							"type"       => "textfield",
							"holder"     => "div",
							"class"      => "",
							"heading"    => __( "URL(optional)", 'eikra-core' ),
							"param_name" => "url",
						),
					)
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'eikra-core' ),
					"param_name" => "col_lg",
					"value" => $this->translate['cols'],
					"std" => "3",
					"group" => __( "Layout", 'eikra-core' ),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'eikra-core' ),
					"param_name" => "col_md",
					"value" => $this->translate['cols'],
					"std" => "3",
					"group" => __( "Layout", 'eikra-core' ),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'eikra-core' ),
					"param_name" => "col_sm",
					"value" => $this->translate['cols'],
					"std" => "3",
					"group" => __( "Layout", 'eikra-core' ),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'eikra-core' ),
					"param_name" => "col_xs",
					"value" => $this->translate['cols'],
					"std" => "4",
					"group" => __( "Layout", 'eikra-core' ),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'eikra-core' ),
					"param_name" => "col_mobile",
					"value" => $this->translate['cols'],
					"std"   => "6",
					"group" => __( "Layout", 'eikra-core' ),
				),
				// Slider options
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay", 'eikra-core' ),
					"param_name" => "slider_autoplay",
					"value" => array( 
						__( "Enabled", "eikra-core" )  => 'true',
						__( "Disabled", "eikra-core" ) => 'false',
					),
					"description" => __( "Enabled or disabled autoplay. Default: Enabled", 'eikra-core' ),
					"group" => __( "Slider Options", 'eikra-core' ),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Stop on Hover", 'eikra-core' ),
					"param_name" => "slider_stop_on_hover",
					"value" => array( 
						__( "Enabled", "eikra-core" )  => 'true',
						__( "Disabled", "eikra-core" ) => 'false',
					),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
					),
					"description" => __( "Stop autoplay on mouse hover. Default: Enabled", 'eikra-core' ),
					"group" => __( "Slider Options", 'eikra-core' ),
				),
				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Interval", 'eikra-core' ),
					"param_name"  => "slider_interval",
					"value" 	  => array( 
						__( "5 Seconds", "eikra-core" )  => '5000',
						__( "4 Seconds", "eikra-core" )  => '4000',
						__( "3 Seconds", "eikra-core" )  => '3000',
						__( "2 Seconds", "eikra-core" )  => '4000',
						__( "1 Seconds", "eikra-core" )  => '1000',
					),
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
					),
					"description" => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'eikra-core' ),
					"group" 	  => __( "Slider Options", 'eikra-core' ),
				),
				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Slide Speed", 'eikra-core' ),
					"param_name"  => "slider_autoplay_speed",
					"value" 	  => 200,
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
					),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'eikra-core' ),
					"group" 	  => __( "Slider Options", 'eikra-core' ),
				),	
				array(
					"type" 		 => "dropdown",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Loop", 'eikra-core' ),
					"param_name" => "slider_loop",
					"value" 	 => array( 
						__( "Enabled", "eikra-core" )  => 'true',
						__( "Disabled", "eikra-core" ) => 'false',
					),
					"description"=> __( "Loop to first item. Default: Enabled", 'eikra-core' ),
					"group" 	 => __( "Slider Options", 'eikra-core' ),
				),

				// Misc
				array(
					"type"        => "checkbox",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Open Link in Same Window", 'eikra-core' ),
					"param_name"  => "sametab",
					"group" 	  => __( "Misc", 'eikra-core' ),
				),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(			
				'logos'                   => '',
				'sametab'                 => '',
				'col_lg'                  => '3',
				'col_md'                  => '3',
				'col_sm'                  => '3',
				'col_xs'                  => '4',
				'col_mobile'              => '6',
				'slider_autoplay'         => 'true',
				'slider_stop_on_hover'    => 'true',
				'slider_interval'         => '5000',
				'slider_autoplay_speed'   => '200',
				'slider_loop'             => 'true',
				), $atts ) );

			$owl_data = array( 
				'nav'                => false,
				'dots'               => false,
				'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
				'autoplayTimeout'    => $slider_interval,
				'autoplaySpeed'      => $slider_autoplay_speed,
				'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
				'loop'               => ( $slider_loop === 'true' ) ? true : false,
				'margin'             => 20,
				'responsive'         => array(
					'0'    => array( 'items' => 12 / $col_mobile ),
					'480'  => array( 'items' => 12 / $col_xs ),
					'768'  => array( 'items' => 12 / $col_sm ),
					'992'  => array( 'items' => 12 / $col_md ),
					'1200' => array( 'items' => 12 / $col_lg ),
					)
				);

			$owl_data = json_encode( $owl_data );
			$this->load_scripts();

			$template = 'logo-slider';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Logo_Slider;