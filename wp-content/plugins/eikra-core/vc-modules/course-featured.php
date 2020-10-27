<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.7
 */

if ( !class_exists( 'RDTheme_VC_Course_Featured' ) ) {

	class RDTheme_VC_Course_Featured extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Course Featured", 'eikra-core' );
			$this->base = 'eikra-vc-course-featured';
			$this->translate = array(
				'title'  => __( "Featured Courses", 'eikra-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$terms = get_terms( array('taxonomy' => 'course_category' ) );
			$category_dropdown = array( __( 'All Categories', 'eikra-core' ) => '0' );
			foreach ( $terms as $category ) {
				$category_dropdown[$category->name] = $category->term_id;
			}

			$args = array(
				'post_type'           => 'lp_course',
				'posts_per_page'      => -1,
				'suppress_filters'    => false,
				'ignore_sticky_posts' => 1,
				'orderby'             => 'title',
				'order'               => 'ASC',
				'post_status'         => 'publish'
			);

			$posts = get_posts( $args );
			$posts_dropdown = array();
			foreach ( $posts as $post ) {
				$posts_dropdown[$post->post_title] = $post->ID;
			}

			$fields = array(
				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Section Title", 'eikra-core' ),
					"param_name"  => "title",
					"value"       => $this->translate['title'],
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Section Title Color", "eikra-core" ),
					"param_name" => "title_color",
					"value" => '',
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "1st Post", 'eikra-core' ),
					"param_name" => "item1",
					'value' => $posts_dropdown,
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "2nd Post", 'eikra-core' ),
					"param_name" => "item2",
					'value' => $posts_dropdown,
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "3rd Post", 'eikra-core' ),
					"param_name" => "item3",
					'value' => $posts_dropdown,
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "4th Post", 'eikra-core' ),
					"param_name" => "item4",
					'value' => $posts_dropdown,
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "5th Post", 'eikra-core' ),
					"param_name" => "item5",
					'value' => $posts_dropdown,
				),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(			
				'title'       => $this->translate['title'],
				'title_color' => '',
				'item1'       => '',
				'item2'       => '',
				'item3'       => '',
				'item4'       => '',
				'item5'       => '',
			), $atts ) );

			$template = 'course-featured';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Course_Featured;