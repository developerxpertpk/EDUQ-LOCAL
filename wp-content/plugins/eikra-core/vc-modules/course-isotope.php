<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.0
 */

if ( !class_exists( 'RDTheme_VC_Course_Isotope' ) ) {

	class RDTheme_VC_Course_Isotope extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Course Isotope", 'eikra-core' );
			$this->base = 'eikra-vc-course-isotope';
			$this->translate = array(
				'all' => __( "All", 'eikra-core' ),
			);
			parent::__construct();
		}

		public function render_query( $query, $clsss, $style ){
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					echo '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 ' . $clsss . '">';
					if ( RDTheme_Helper::is_LMS() ) {
						if ( $style != 1 ) {
							learn_press_get_template( "custom/course-box-{$style}.php" );
						}
						else {
							learn_press_get_template( 'custom/course-box.php' );
						}
					}
					else {
						get_template_part( 'template-parts/content', 'course-box' );
					}
					echo '</div>';
				}
			}
			wp_reset_query();
		}

		public function load_scripts(){
			wp_enqueue_style( 'course-review' );
			wp_enqueue_style( 'dashicons' );
			wp_enqueue_script( 'isotope-pkgd' );
		}

		public function fields(){
			$fields = array(
				'style' => array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Style", 'eikra-core' ),
					"param_name" => "style",
					'value' => array( 
						__( 'Style 1 (Category Navigation)', 'eikra-core' ) => 'style1',
						__( 'Style 2', 'eikra-core' ) => 'style2',
					),
				),
				'box_style' => array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Style", 'eikra-core' ),
					"param_name" => "box_style",
					'value' => array( 
						__( 'Style 1', 'eikra-core' ) => '1',
						__( 'Style 2', 'eikra-core' ) => '2',
						__( 'Style 3', 'eikra-core' ) => '3',
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "All items name", 'eikra-core' ),
					"param_name" => "all",
					'value' => $this->translate['all'],
					'dependency' => array(
						'element' => 'style',
						'value'   => array( 'style1' ),
					),
				),
				'button_display' => array(
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
						'element' => 'style',
						'value' => array( 'style2' ),
					),
				),
			);

			if ( !RDTheme_Helper::is_LMS() ) {
				unset( $fields['style'] );
				unset( $fields['box_style'] );
				unset( $fields['button_display'] );
			}

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'style'     => 'style1',
				'box_style' => '1',
				'all'       => $this->translate['all'],
				'button_display' => 'true',
				), $atts ) );

			$this->load_scripts();

			if ( $style == 'style2' && RDTheme_Helper::is_LMS() ) {
				$template = 'course-isotope-2';
			}
			else {
				$template = 'course-isotope-1';
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Course_Isotope;