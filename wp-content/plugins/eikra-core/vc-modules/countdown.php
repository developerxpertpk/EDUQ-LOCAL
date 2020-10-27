<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.0
 */

class RDTheme_VC_Countdown extends RDTheme_VC_Modules {

	public function __construct(){
		$this->name = __( "Eikra: Countdown", 'eikra-core' );
		$this->base = 'eikra-vc-countdown';
		parent::__construct();
	}

	public function load_scripts(){
		wp_enqueue_script( 'js-countdown' );
	}

	public function fields(){
		$fields = array(
			array(
				"type"   => "dropdown",
				"holder" => "div",
				"class"  => "",
				"heading" => __( "Style", 'eikra-core' ),
				"param_name" => "style",
				'value' => array(
					__( "Light Background", 'eikra-core' ) => 'light',
					__( "Dark Background", 'eikra-core' )  => 'dark',
				),
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Title 1", 'eikra-core' ),
				"param_name" => "title1",
				"value" => 'Lorem ipsum',
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Title 2", 'eikra-core' ),
				"param_name" => "title2",
				"value" => 'Lorem ipsum sit amet',
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Date", 'eikra-core' ),
				"param_name" => "date",
				'description' => __( 'Enter a future date in YYYY-MM-DD format eg. 2019-11-07', 'eikra-core' ),
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Time (optional)", 'eikra-core' ),
				"param_name" => "time",
				'description' => __( 'Enter the time in Hour:Minute format eg. 14:50', 'eikra-core' ),
			),
			array(
				'type' => 'css_editor',
				'heading' => __( 'Css', 'eikra-core' ),
				'param_name' => 'css',
				'group' => __( 'Design options', 'eikra-core' ),
			),
		);
		return $fields;
	}

	public function shortcode( $atts, $content = '' ){
		extract( shortcode_atts( array(
			'style'  => 'light',
			'title1' => 'Lorem Ipsum Amet',
			'title2' => 'Lorem Ipsum',
			'date'	 => '',
			'time'   => '',
			'css'    => '',
		), $atts ) );

		$this->load_scripts();

		$template = 'countdown';

		return $this->template( $template, get_defined_vars() );
	}
}

new RDTheme_VC_Countdown;