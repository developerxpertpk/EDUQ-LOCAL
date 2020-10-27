<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.1
 */

class RDTheme_VC_Course_Grid extends RDTheme_VC_Modules {

	public function __construct(){
		$this->name = __( "Eikra: Course Grid", 'eikra-core' );
		$this->base = 'eikra-vc-course-grid';
		parent::__construct();
	}
	
	public function load_scripts(){	
		wp_enqueue_style( 'course-review' );
		wp_enqueue_style( 'dashicons' );
	}

	public function fields(){
		$terms = get_terms( array('taxonomy' => 'course_category' ) );
		$category_dropdown = array( __( 'All Categories', 'eikra-core' ) => '0' );
		foreach ( $terms as $category ) {
			$category_dropdown[$category->name] = $category->term_id;
		}

		$orderby = array(
			__( 'Title', 'eikra-core' ) => 'title',
			__( 'Date (Recents comes first)', 'eikra-core' ) => 'date',
			__( 'Custom Order (Available via Order field inside Post Attributes box)', 'eikra-core' ) => 'menu_order',
		);

		if ( RDTheme_Helper::is_LMS() ) {
			$orderby[__( 'Popularity (Based on enrolled students)', 'eikra-core' )] = 'popularity';
		}

		$fields = array(
			'style' => array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Style", 'eikra-core' ),
				"param_name" => "style",
				'value' => array( 
					__( 'Style 1', 'eikra-core' ) => '1',
					__( 'Style 2', 'eikra-core' ) => '2',
					__( 'Style 3', 'eikra-core' ) => '3',
					__( 'Style 4', 'eikra-core' ) => '4',
				),
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
				"heading" => __( "Items Per Page", 'eikra-core' ),
				"param_name" => "number",
				"value" => 8,
				'description' => __( 'Write -1 to show all', 'eikra-core' ),
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Order By", 'eikra-core' ),
				"param_name" => "orderby",
				"value" => $orderby,
				"std" => "date",
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Pagination", 'eikra-core' ),
				"param_name" => "pagination",
				"value" => array( 
					__( "Enabled", "eikra-core" )  => 'true',
					__( "Disabled", "eikra-core" ) => 'false',
				),
			),
		);

		if ( !RDTheme_Helper::is_LMS() ) {
			unset( $fields['style'] );
		}

		return $fields;
	}

	public function shortcode( $atts, $content = '' ){
		extract( shortcode_atts( array(			
			'style'      => '1',
			'cat'        => '',
			'number'     => '8',
			'orderby'    => 'date',
			'pagination' => 'true',
		), $atts ) );
		
		if ( RDTheme_Helper::is_LMS() && $orderby == 'popularity' ) {
			$orderby = 'date';
		}
		
		$number = intval( $number );

		$this->load_scripts();

		$template = 'course-grid';

		return $this->template( $template, get_defined_vars() );
	}
}

new RDTheme_VC_Course_Grid;