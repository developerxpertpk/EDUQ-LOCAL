<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_Course_Search' ) ) {

	class RDTheme_Course_Search extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Course Search", 'eikra-core' );
			$this->base = 'eikra-vc-course-search';
			$this->translate = array(
				'title' => __( "Find Your Preferred Courses", 'eikra-core' ),
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
						__( "Light Background", 'eikra-core' )  => 'light',
						__( "Dark Background", 'eikra-core' )   => 'dark',
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Search Title", 'eikra-core' ),
					"param_name" => "title",
					"value" => $this->translate['title'],
				),
			);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'style'   => 'light',
				'title'    => $this->translate['title'],
				), $atts ) );

			$template = 'course-search';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_Course_Search;