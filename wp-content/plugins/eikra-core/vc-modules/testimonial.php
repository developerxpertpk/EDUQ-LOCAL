<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.0
 */

if ( !class_exists( 'RDTheme_VC_Testimonial' ) ) {

	class RDTheme_VC_Testimonial extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Testimonial", 'eikra-core' );
			$this->base = 'eikra-vc-testimonial';
			$this->translate = array(
				'title' => __( "Our Happy Students", 'eikra-core' ),
			);
			parent::__construct();
		}
		
		public function load_scripts(){	
			wp_enqueue_style( 'owl-carousel' );
			wp_enqueue_style( 'owl-theme-default' );
			wp_enqueue_script( 'owl-carousel' );	
		}

		public function fields(){
			$terms = get_terms( array('taxonomy' => 'ac_testimonial_category') );
			$category_dropdown = array( __( 'All Categories', 'eikra-core' ) => '0' );
			foreach ( $terms as $category ) {
				$category_dropdown[$category->name] = $category->term_id;
			}

			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Style", 'eikra-core' ),
					"param_name" => "style",
					'value' => array( 
						__( 'Style 1', 'eikra-core' ) => 'style1',
						__( 'Style 2 (Requires Dark Background)', 'eikra-core' ) => 'style2',
						__( 'Style 3', 'eikra-core' ) => 'style3',
					),
				),
				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Section Title", 'eikra-core' ),
					"param_name"  => "title",
					"value"       => $this->translate['title'],
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style2' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Total number of items", 'eikra-core' ),
					"param_name" => "slider_item_number",
					"value" => "3",
					'description' => __( 'Write -1 to show all', 'eikra-core' ),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Categories", 'eikra-core' ),
					"param_name" => "cat",
					'value' => $category_dropdown,
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Order By", 'eikra-core' ),
					"param_name" => "orderby",
					"value" => array(
						__( 'Date', 'eikra-core' )  => 'date',
						__( 'Title', 'eikra-core' ) => 'title',
						__( 'Custom Order (Available via Order field inside Post Attributes box)', 'eikra-core' ) => 'menu_order',
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Order", 'eikra-core' ),
					"param_name" => "order",
					"value" => array(
						__( 'Descending', 'eikra-core' ) => 'DESC',
						__( 'Ascending ', 'eikra-core' ) => 'ASC',
					),
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Section Title color", "eikra-core" ),
					"param_name" => "sec_color",
					"value" => '',
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style2' ),
					),
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Name color", "eikra-core" ),
					"param_name" => "name_color",
					"value" => '',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Designation color", "eikra-core" ),
					"param_name" => "designation_color",
					"value" => '',
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Content color", "eikra-core" ),
					"param_name" => "content_color",
					"value" => '',
				),
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
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'style'                 => 'style1',
				'title'                 => $this->translate['title'],
				'slider_item_number'    => '3',
				'cat'                   => '',
				'orderby'               => 'date',
				'order'                 => 'DESC',
				'sec_color'		        => '',
				'name_color'		    => '',
				'designation_color'     => '',				
				'content_color'  	    => '',
				'slider_autoplay'       => 'true',
				'slider_interval'       => '5000',
				'slider_stop_on_hover'  => 'true',
				'slider_autoplay_speed' => '200',
				'slider_loop'           => 'true',
				), $atts ) );

			$slider_item_number = intval( $slider_item_number );

			$owl_data = array( 
				'nav'                => false,
				'dots'               => true,
				'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
				'autoplayTimeout'    => $slider_interval,
				'autoplaySpeed'      => $slider_autoplay_speed,
				'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
				'loop'               => ( $slider_loop === 'true' ) ? true : false,
				'margin'             => 30,
				'responsive'         => array(
					'0'    => array( 'items' => 1 ),
					'480'  => array( 'items' => 2 ),
				)
			);

			switch ( $style ) {
				case 'style2':
				$owl_data['responsive'] = array( '0' => array( 'items' => 1 ) );
				$template = 'testimonial-2';
				break;

				case 'style3':
				$owl_data['margin'] = 50;
				$owl_data['responsive'] = array(
					'0'   => array( 'items' => 1 ),
					'768' => array( 'items' => 2 )
				);
				$template = 'testimonial-3';
				break;

				default:
				$template = 'testimonial-1';
				break;
			}

			$owl_data = json_encode( $owl_data );
			$this->load_scripts();
			

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Testimonial;