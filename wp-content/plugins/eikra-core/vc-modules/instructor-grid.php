<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.1
 */

if ( !class_exists( 'RDTheme_VC_Instructor_Grid' ) ) {

	class RDTheme_VC_Instructor_Grid extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Instructor Grid", 'eikra-core' );
			$this->base = 'eikra-vc-instructor-grid';
			parent::__construct();
		}

		public function fields(){
			$users_dropdown = array();

			if ( RDTheme_Helper::is_LMS() ) {
				$users = get_users( array( 'role' => LP_TEACHER_ROLE, 'number' => -1, 'orderby' => 'display_name','order' => 'ASC','fields' => array( 'ID', 'display_name' ) ) );

				foreach ( $users as $user ) {
					$users_dropdown[$user->display_name] = $user->ID;
				}

				$orderby = array(
					__( 'Name', 'eikra-core' ) => 'display_name',
					__( 'ID (Ascending)', 'eikra-core' )  => 'id_asc',
					__( 'ID (Descending)', 'eikra-core' ) => 'id_dsc',
					__( 'Custom Order', 'eikra-core' )    => 'custom_order',
				);
				$orderby_std = 'id_dsc';
			}
			else {
				$args = array(
					'post_type'           => 'lp_instructor',
					'posts_per_page'      => -1,
					'suppress_filters'    => false,
					'ignore_sticky_posts' => 1,
					'orderby'             => 'title',
					'order'               => 'ASC',
					'post_status'         => 'publish'
				);

				$posts = get_posts( $args );
				foreach ( $posts as $post ) {
					$users_dropdown[$post->post_title] = $post->ID;
				}

				$orderby = array(
					__( 'Date (Recents comes first)', 'eikra-core' )  => 'date',
					__( 'Title', 'eikra-core' ) => 'title',
					__( 'Custom Order (Available via Order field inside Post Attributes box)', 'eikra-core' ) => 'menu_order',
				);
				$orderby_std = 'date';
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
						__( 'Style 2', 'eikra-core' ) => 'style2',
						__( 'Style 3', 'eikra-core' ) => 'style3',
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Items Per Page", 'eikra-core' ),
					"param_name" => "number",
					"value" => '8',
					'description' => __( 'Write -1 to show all', 'eikra-core' ),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Order By", 'eikra-core' ),
					"param_name" => "orderby",
					"value" => $orderby,
					"std" => $orderby_std,
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style1', 'style2' ),
					),
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

			return $fields;
		}

		public function alter_query_orderby( $class ){
			global $wpdb;
			$class->query_orderby = "ORDER BY {$wpdb->usermeta}.meta_value+0 ASC";
		}

		public function user_custom_ordering(){
			add_action( 'pre_user_query', array( $this, 'alter_query_orderby' ) );
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(	
				'style'      => 'style1',
				'number'     => '8',
				'orderby'    => 'id_dsc',
				'pagination' => 'true',
			), $atts ) );

			// validation
			$number = intval( $number );

			switch ( $style ) {
				case 'style1':
				$template = RDTheme_Helper::is_LMS() ? 'instructor-grid-1' : 'instructor-grid-nolms-1';
				break;
				case 'style2':
				$template = RDTheme_Helper::is_LMS() ? 'instructor-grid-2' : 'instructor-grid-nolms-2';
				break;
				case 'style3':
				$template = RDTheme_Helper::is_LMS() ? 'instructor-grid-3' : 'instructor-grid-nolms-3';
				break;
				default:
				$template = RDTheme_Helper::is_LMS() ? 'instructor-grid-1' : 'instructor-grid-nolms-1';
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Instructor_Grid;