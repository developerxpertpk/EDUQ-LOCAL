<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.7
 */

if ( !class_exists( 'RDTheme_VC_Instructor_Slider' ) ) {

	class RDTheme_VC_Instructor_Slider extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Instructor Slider", 'eikra-core' );
			$this->base = 'eikra-vc-instructor-slider';
			$this->translate = array(
				'title'      => __( "Our Skilled Instructors", 'eikra-core' ),
				'buttontext' => __( "BECOME AN INSTRUCTOR", 'eikra-core' ),
			);
			$this->item = false;
			parent::__construct();
		}
		
		public function load_scripts(){	
			wp_enqueue_style( 'owl-carousel' );
			wp_enqueue_style( 'owl-theme-default' );
			wp_enqueue_script( 'owl-carousel' );
		}

		public function fields(){
			$users_dropdown = array();

			if ( RDTheme_Helper::is_LMS() ) {
				$users = get_users( array( 'role' => LP_TEACHER_ROLE, 'number' => -1, 'orderby' => 'display_name','order' => 'ASC','fields' => array( 'ID', 'display_name' ) ) );

				foreach ( $users as $user ) {
					$users_dropdown[$user->display_name] = $user->ID;
				}

				if ( !empty( $users[0] ) ) {
					$this->item = $users[0]->ID;
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

				if ( !empty( $posts[0] ) ) {
					$this->item = $posts[0]->ID;
				}

				$orderby = array(
					__( 'Date (Recents comes first)', 'eikra-core' )  => 'date',
					__( 'Title', 'eikra-core' ) => 'title',
					__( 'Custom Order (Available via Order field inside Post Attributes box)', 'eikra-core' ) => 'menu_order',
				);
				$orderby_std = 'date';

				$terms = get_terms( array('taxonomy' => 'instructor_category' ) );
				$category_dropdown = array( __( 'All Categories', 'eikra-core' ) => '0' );
				foreach ( $terms as $category ) {
					$category_dropdown[$category->name] = $category->term_id;
				}
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
						__( 'Style 4', 'eikra-core' ) => 'style4',
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
						'value'   => array( 'style1', 'style2', 'style4' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Total number of items", 'eikra-core' ),
					"param_name" => "number",
					"value" => '5',
					'description' => __( 'Write -1 to show all', 'eikra-core' ),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style1', 'style2', 'style4' ),
					),
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
						'value'   => array( 'style1', 'style2', 'style4' ),
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Order By", 'eikra-core' ),
					"param_name" => "orderby_alt",
					"value" => array(
						__( 'Name', 'eikra-core' ) => 'name',
						__( 'Custom', 'eikra-core' ) => 'custom',
					),
					"std" => 'name',
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style3' ),
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "1st Instructor", 'eikra-core' ),
					"param_name" => "item1",
					'value' => $users_dropdown,
					'dependency' => array(
						'element' => 'orderby_alt',
						'value'   => array( 'custom' ),
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "2nd Instructor", 'eikra-core' ),
					"param_name" => "item2",
					'value' => $users_dropdown,
					'dependency' => array(
						'element' => 'orderby_alt',
						'value'   => array( 'custom' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Limit", 'eikra-core' ),
					"param_name" => "count",
					"value" => '25',
					"description" => __( "Maximum number of words to display. Default: 35", 'eikra-core' ),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style3' ),
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Designation Display", 'eikra-core' ),
					"param_name" => "designation_dis",
					"value" => array( 
						__( "Enabled", "eikra-core" )  => 'true',
						__( "Disabled", "eikra-core" ) => 'false',
					),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style3' ),
					),
				),
				'student_dis' => array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Student Count Display", 'eikra-core' ),
					"param_name" => "student_dis",
					"value" => array( 
						__( "Enabled", "eikra-core" )  => 'true',
						__( "Disabled", "eikra-core" ) => 'false',
					),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style3' ),
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Display", 'eikra-core' ),
					"param_name" => "button_dis",
					"value" => array( 
						__( "Enabled", "eikra-core" )  => 'true',
						__( "Disabled", "eikra-core" ) => 'false',
					),
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style3' ),
					),
				),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Button Text", 'eikra-core' ),
					"param_name"  => "buttontext",
					"value" 	  => $this->translate['buttontext'],
					'dependency' => array(
						'element' => 'button_dis',
						'value'   => array( 'true' ),
					),
				),
				array(
					"type"        => "textfield",
					"holder"      => "div",
					"class"       => "",
					"heading"     => __( "Button URL", 'eikra-core' ),
					"param_name"  => "buttonurl",
					'dependency' => array(
						'element' => 'button_dis',
						'value'   => array( 'true' ),
					),
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
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style1', 'style2', 'style4' ),
					),
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
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style1', 'style2', 'style4' ),
					),
				),
			);

			if ( !RDTheme_Helper::is_LMS() ) {
				unset( $fields['student_dis'] );
				$fields[] = array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Categories", 'eikra-core' ),
					"param_name" => "cat",
					'value' => $category_dropdown,
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style1', 'style2', 'style4' ),
					),
				);	
			}

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
				'style'                   => 'style1',
				'title'     			  => $this->translate['title'],
				'number'                  => '5',
				'orderby'                 => RDTheme_Helper::is_LMS() ? 'id_dsc' : 'date',
				'cat'                     => '',
				'count'                   => '25',
				'designation_dis'         => 'true',
				'student_dis'             => RDTheme_Helper::is_LMS() ? 'true' : 'false',
				'button_dis'              => 'true',
				'buttontext'              => $this->translate['buttontext'],
				'buttonurl'               => '',
				'orderby_alt'             => 'name',
				'item1'                   => $this->item ? $this->item : '',
				'item2'                   => $this->item ? $this->item : '',
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
					'0'    => array( 'items' => 1 ),
					'480'  => array( 'items' => 2 ),
					'768'  => array( 'items' => 3 ),
					'992'  => array( 'items' => 4 ),
				)
			);

			// validation
			$item1  = intval( $item1 );
			$item2  = intval( $item2 );
			$number = intval( $number );
			$count  = intval( $count );

			switch ( $style ) {
				case 'style1':
				$template = RDTheme_Helper::is_LMS() ? 'instructor-slider-1' : 'instructor-slider-nolms-1';
				$owl_data = json_encode( $owl_data );
				$this->load_scripts();
				break;

				case 'style2':
				$owl_data['margin'] = 30;
				$owl_data['responsive'] = array(
					'0'    => array( 'items' => 1 ),
					'768'  => array( 'items' => 2 ),
					'992'  => array( 'items' => 3 ),
				);
				$template = RDTheme_Helper::is_LMS() ? 'instructor-slider-2' : 'instructor-slider-nolms-2';
				$owl_data = json_encode( $owl_data );
				$this->load_scripts();
				break;

				case 'style3':
				$template = RDTheme_Helper::is_LMS() ? 'instructor-slider-3' : 'instructor-slider-nolms-3';
				break;

				case 'style4':
				$template = RDTheme_Helper::is_LMS() ? 'instructor-slider-4' : 'instructor-slider-nolms-4';
				$owl_data = json_encode( $owl_data );
				$this->load_scripts();
				break;

				default:
				$template = RDTheme_Helper::is_LMS() ? 'instructor-slider-1' : 'instructor-slider-nolms-1';
				$owl_data = json_encode( $owl_data );
				$this->load_scripts();
				break;
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Instructor_Slider;