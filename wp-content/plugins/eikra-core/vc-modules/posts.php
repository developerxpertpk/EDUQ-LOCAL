<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_VC_Post' ) ) {

	class RDTheme_VC_Post extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Post", 'eikra-core' );
			$this->base = 'eikra-vc-post';
			$this->translate = array(
				'title'       => __( "Latest Posts", 'eikra-core' ),
				'button_text' => __( "VIEW ALL", 'eikra-core' )
			);
			parent::__construct();
		}

		public function fields(){
			$terms = get_terms( array( 'taxonomy' => 'category' ) );
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
						__( "Style 1", 'eikra-core' )  => 'style1',
						__( "Style 2", 'eikra-core' )  => 'style2',
					),
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
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Background Color", "eikra-core" ),
					"param_name" => "bgcolor",
					"value" => '#ffffff',
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style1' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of Items", 'eikra-core' ),
					"param_name" => "grid_item_number",
					"value" => 3,
					'description' => __( 'Write -1 to show all', 'eikra-core' ),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Limit", 'eikra-core' ),
					"param_name" => "content_limit",
					"value" => '13',
					"description" => __( "Maximum number of words to display. Default: 13", 'eikra-core' ),
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
					"heading" => __( "Button Display", 'eikra-core' ),
					"param_name" => "button_display",
					"value" => array( 
						__( "Enabled", "eikra-core" )  => 'true',
						__( "Disabled", "eikra-core" ) => 'false',
					),
				),	
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Text", 'eikra-core' ),
					"param_name" => "button_text",
					'dependency' => array(
						'element' => 'button_display',
						'value'   => array( 'true' ),
					),
					"value" => $this->translate['button_text'],
				),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'style'             => 'style1',
				'bgcolor'           => '#ffffff',
				'title'             => $this->translate['title'],
				'bgcolor'           => '#ffffff',
				'grid_item_number'  => '3',
				'content_limit'     => '13',
				'cat'               => '',	
				'button_display'    => 'true',
				'button_text'		=> $this->translate['button_text'],
			), $atts ) );

			$grid_item_number = intval( $grid_item_number );
			$content_limit    = intval( $content_limit );

			switch ( $style ) {
				case 'style2':
				$template = 'posts-2';
				break;
				default:
				$template = 'posts';
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Post;