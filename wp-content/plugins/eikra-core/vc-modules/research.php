<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_VC_Research' ) ) {

	class RDTheme_VC_Research extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Research Grid", 'eikra-core' );
			$this->base = 'eikra-vc-reseach';
			$this->translate = array(
				'btntxt' => __( "READ MORE", 'eikra-core' ),
				'cols'   => array( 
					__( '1 col', 'eikra-core' ) => '12',
					__( '2 col', 'eikra-core' ) => '6',
					__( '3 col', 'eikra-core' ) => '4',
					__( '4 col', 'eikra-core' ) => '3',
					__( '6 col', 'eikra-core' ) => '2',
				),
			);
			parent::__construct();
		}

		public function fields(){
			$terms = get_terms( array('taxonomy' => 'ac_research_category') );
			$category_dropdown = array( __( 'All Categories', 'eikra-core' ) => '0' );
			foreach ( $terms as $category ) {
				$category_dropdown[$category->name] = $category->term_id;
			}

			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Layout", 'eikra-core' ),
					"param_name" => "layout",
					'value' => array(
						__( "Layout 1", 'eikra-core' )  => 'layout1',
						__( "Layout 2", 'eikra-core' )  => 'layout2',
						__( "Layout 3", 'eikra-core' )  => 'layout3',
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
					"value" => 9,
					'description' => __( 'Write -1 to show all', 'eikra-core' ),
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
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Word count", 'eikra-core' ),
					"param_name" => "count",
					"value" => 35,
					'description' => __( 'Maximum number of words', 'eikra-core' ),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Display", 'eikra-core' ),
					"param_name" => "btn",
					"value" => array(
						__( 'Enabled', 'eikra-core' )  => 'true',
						__( 'Disabled', 'eikra-core' ) => 'false',
					),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'layout1' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Text", 'eikra-core' ),
					"param_name" => "btntxt",
					'dependency' => array(
						'element' => 'btn',
						'value' => array( 'true' ),
					),
					"value" => $this->translate['btntxt'],
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'eikra-core' ),
					"param_name" => "col_lg",
					"value" => $this->translate['cols'],
					"std" => "4",
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'layout2', 'layout3' ),
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'eikra-core' ),
					"param_name" => "col_md",
					"value" => $this->translate['cols'],
					"std" => "4",
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'layout2', 'layout3' ),
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'eikra-core' ),
					"param_name" => "col_sm",
					"value" => $this->translate['cols'],
					"std" => "6",
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'layout2', 'layout3' ),
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'eikra-core' ),
					"param_name" => "col_xs",
					"value" => $this->translate['cols'],
					"std" => "12",
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'layout2', 'layout3' ),
					),
				),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'layout' => 'layout1',
				'cat'    => '',
				'number' => '9',
				'orderby'=> 'date',
				'order'  => 'DESC',
				'count'  => '35',
				'btn'    => 'true',
				'btntxt' => $this->translate['btntxt'],
				'col_lg' => '4',
				'col_md' => '4',
				'col_sm' => '6',
				'col_xs' => '12',
				), $atts ) );


			// validation
			$cat     = empty( $cat ) ? '' : $cat;
			$number  = intval( $number );
			$count   = intval( $count );
			$col_lg  = esc_attr( $col_lg );
			$col_md  = esc_attr( $col_md );
			$col_sm  = esc_attr( $col_sm );
			$col_xs  = esc_attr( $col_xs );

			switch ( $layout ) {
				case 'layout1':
				$template = 'research-1';
				break;
				case 'layout2':
				$template = 'research-2';
				break;
				case 'layout3':
				$template = 'research-3';
				break;
				default:
				$template = 'research-1';
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Research;