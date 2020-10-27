<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.0
 */

if ( !class_exists( 'RDTheme_VC_Event' ) ) {

	class RDTheme_VC_Event extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Events", 'eikra-core' );
			$this->base = 'eikra-vc-event';
			$this->translate = array(
				'title'       => __( "Upcoming Events", 'eikra-core' ),
				'button_text' => __( "VIEW ALL", 'eikra-core' )
			);
			parent::__construct();
		}

		public function sort_by_time( $a, $b ) {
			return $a['timestamp'] - $b['timestamp'];
		}

		public function sort_by_time_past( $a, $b ) {
			return $b['timestamp'] - $a['timestamp'];
		}

		public function get_events( $cat, $type, $number ) {
			$events = array();

			$args = array(
				'posts_per_page'      => -1,
				'post_type'           => 'ac_event',
				'suppress_filters'    => false,
				'ignore_sticky_posts' => 1,
			);

			if ( !empty( $cat ) ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'ac_event_category',
						'field'    => 'term_id',
						'terms'    => $cat,
					)
				);
			}

			$all_events = get_posts( $args );

			$current_time = current_time( 'timestamp' );

			foreach ( $all_events as $event ) {
				$start_date = get_post_meta( $event->ID, 'ac_event_start_date', true );
				$start_time = get_post_meta( $event->ID, 'ac_event_start_time', true );
				$end_date   = get_post_meta( $event->ID, 'ac_event_end_date', true );
				$end_time   = get_post_meta( $event->ID, 'ac_event_end_time', true );

				if ( empty( $start_date ) || empty( $start_time ) ) {
					continue;
				}

				$event_time = $start_date . ' ' . $start_time;
				$event_time = strtotime( $event_time );

				if ( $type == 'past' && $event_time >= $current_time) {
					continue;
				}
				if ( $type == 'upcoming' && $event_time < $current_time ) {
					continue;
				}

				$time_pattern = RDTheme::$options['event_time_format'] == '12' ? 'g:ia' : 'H:i';
				$start_time   = date_i18n( $time_pattern, strtotime( $start_time ) );
				$end_time     = $end_time ? date_i18n( $time_pattern, strtotime( $end_time ) ) : '';

				$events[] = array(
					'id'         => $event->ID,
					'title'      => $event->post_title,
					'content'    => has_excerpt( $event->ID ) ? $event->post_excerpt : $event->post_content,
					'start_date' => $start_date,
					'start_time' => $start_time,
					'end_date'   => $end_date,
					'end_time'   => $end_time,
					'location'   => get_post_meta( $event->ID, 'ac_event_location', true ),					
					'timestamp'  => $event_time,
				);
			}

			if ( $type == 'past'){
				usort( $events, array( $this, 'sort_by_time_past' ) );
			}
			else {
				usort( $events, array( $this, 'sort_by_time' ) );
			}

			if ( $number == 'grid' ) {
				return $events;
			}

			return array_slice( $events, 0, $number );
		}

		public function fields(){
			
			$terms = get_terms( array( 'taxonomy' => 'ac_event_category' ) );
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
						__( "List", 'eikra-core' )  => 'list',
						__( "Grid", 'eikra-core' )  => 'grid',
						__( "Box", 'eikra-core' )   => 'box',
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Event Type", 'eikra-core' ),
					"param_name" => "type",
					"value" => array(
						__( 'All Events' , 'eikra-core')      => 'all',
						__( 'Upcoming Events' , 'eikra-core') => 'upcoming',
						__( 'Past Events' , 'eikra-core')  	  => 'past',
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", 'eikra-core' ),
					"param_name" => "title",
					"value" => $this->translate['title'],
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'list' ),
					),
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Background Color", "eikra-core" ),
					"param_name" => "bg_color",
					"value" => '#ffffff',
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'list' ),
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Categories", 'eikra-core' ),
					"param_name" => "cat",
					'value' => $category_dropdown,
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'list' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Total number of items", 'eikra-core' ),
					"param_name" => "number",
					"value" => '2',
					'description' => __( 'Write -1 to show all', 'eikra-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'list','box' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of items per page", 'eikra-core' ),
					"param_name" => "grid_item_number",
					"value" => '4',
					'description' => __( 'Write -1 to show all', 'eikra-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'grid' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Limit", 'eikra-core' ),
					"param_name" => "count",
					"value" => '35',
					"description" => __( "Maximum number of words to display. Default: 35", 'eikra-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'grid', 'list' ),
					),
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
					'dependency' => array(
						'element' => 'layout',
						'value' => array( 'list' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button Text", 'eikra-core' ),
					"param_name" => "button_text",
					"value" => $this->translate['button_text'],
					'dependency' => array(
						'element' => 'button_display',
						'value'   => array( 'true' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Button URL", 'eikra-core' ),
					"param_name" => "button_url",
					"value" => '',
					'dependency' => array(
						'element' => 'button_display',
						'value'   => array( 'true' ),
					),
				),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'layout'           => 'list',
				'title'            => $this->translate['title'],
				'type'             => 'all',
				'cat'			   => '',
				'number'           => '2',
				'grid_item_number' => '4',
				'count'            => '35',
				'bg_color'	       => '#ffffff',
				'button_display'   => 'true',
				'button_text'	   => $this->translate['button_text'],
				'button_url'	   => ''
			), $atts ) );

			$count	= intval( $count );
			$number	= intval( $number );
			$grid_item_number = intval( $grid_item_number );

			if ( $layout == 'grid' ) {
				$events = $this->get_events( $cat, $type, 'grid' );
				$template = 'event-grid';
			}
			elseif ( $layout == 'box' ) {
				$events = $this->get_events( $cat, $type, $number );
				$template = 'event-box';
			}
			else {
				$events = $this->get_events( $cat, $type, $number );
				$template = 'event-list';
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Event;