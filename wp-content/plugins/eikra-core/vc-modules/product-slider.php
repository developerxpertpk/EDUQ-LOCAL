<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'WooCommerce' ) ) {
	return;
}

if ( !class_exists( 'RDTheme_VC_Product_Slider' ) ) {

	class RDTheme_VC_Product_Slider extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Product Slider", 'eikra-core' );
			$this->base = 'eikra-vc-product';
			$this->translate = array(
				'title' => __( "Our Publications", 'eikra-core' ),
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
		}

		public function fields(){
			$terms = get_terms( array('taxonomy' => 'product_cat' ) );
			$category_dropdown = array( __( 'All Categories', 'eikra-core' ) => '0' );
			foreach ( $terms as $category ) {
				$category_dropdown[$category->name] = $category->term_id;
			}

			$fields = array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", 'eikra-core' ),
					"param_name" => "title",
					"value" => $this->translate['title'],
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
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Total number of items", 'eikra-core' ),
					"param_name" => "number",
					"value" => 5,
					'description' => __( 'Write -1 to show all', 'eikra-core' ),
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
					"std" => "4",
					"group" => __( "Layout", 'eikra-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'eikra-core' ),
					"param_name" => "col_xs",
					"value" => $this->translate['cols'],
					"std" => "6",
					"group" => __( "Layout", 'eikra-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'eikra-core' ),
					"param_name" => "col_mobile",
					"value" => $this->translate['cols'],
					"std" => "12",
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
						__( 'Enabled', 'eikra-core' )  => 'true',
						__( 'Disabled', 'eikra-core' ) => 'false',
						),
					"description" => __( "Enable or disable autoplay. Default: Enable", 'eikra-core' ),
					"group" => __( "Slider Options", 'eikra-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Stop on Hover", 'eikra-core' ),
					"param_name" => "slider_stop_on_hover",
					"value" => array( 
						__( 'Enabled', 'eikra-core' )  => 'true',
						__( 'Disabled', 'eikra-core' ) => 'false',
						),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Stop autoplay on mouse hover. Default: Enable", 'eikra-core' ),
					"group" => __( "Slider Options", 'eikra-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay Interval", 'eikra-core' ),
					"param_name" => "slider_interval",
					"value" => array( 
						__( '5 Seconds', 'eikra-core' ) => '5000',
						__( '4 Seconds', 'eikra-core' ) => '4000',
						__( '3 Seconds', 'eikra-core' ) => '3000',
						__( '2 Seconds', 'eikra-core' ) => '4000',
						__( '1 Second', 'eikra-core' )  => '1000',
						),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'eikra-core' ),
					"group" => __( "Slider Options", 'eikra-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay Slide Speed", 'eikra-core' ),
					"param_name" => "slider_autoplay_speed",
					"value" => 200,
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'eikra-core' ),
					"group" => __( "Slider Options", 'eikra-core' ),
					),	
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Loop", 'eikra-core' ),
					"param_name" => "slider_loop",
					"value" => array( 
						__( 'Enabled', 'eikra-core' )  => 'true',
						__( 'Disabled', 'eikra-core' ) => 'false',
						),
					"description" => __( "Loop to first item. Default: Enable", 'eikra-core' ),
					"group" => __( "Slider Options", 'eikra-core' ),
					),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(			
			'title'                 => $this->translate['title'],
			'number'                => '5',
			'cat'                   => '',
			'col_lg'                => '3',
			'col_md'                => '3',
			'col_sm'                => '4',
			'col_xs'                => '6',
			'col_mobile'            => '12',
			// slider
			'slider_autoplay'       => 'true',
			'slider_stop_on_hover'  => 'true',
			'slider_interval'       => '5000',
			'slider_autoplay_speed' => '200',
			'slider_loop'           => 'true',
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

			// validation
			$number = intval( $number );

			$owl_data = json_encode( $owl_data );
			$this->load_scripts();

			$template = 'product-slider';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Product_Slider;