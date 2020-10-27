<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_VC_Gallery' ) ) {
	
	class RDTheme_VC_Gallery extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Gallery", 'eikra-core' );
			$this->base = 'eikra-vc-gallery';
			$this->translate = array(
				'all'   => __( "All", 'eikra-core' ),
			);
			parent::__construct();
		}

		public function load_scripts(){
			wp_enqueue_style( 'magnific-popup' );
			wp_enqueue_script( 'magnific-popup' );
			wp_enqueue_script( 'isotope-pkgd' );
		}

		public function fields(){
			$fields = array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "All items name", 'eikra-core' ),
					"param_name" => "all",
					'value' => $this->translate['all'],
				),
			);
			
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'all' => $this->translate['all'],
				), $atts ) );
			
			$this->load_scripts();
			$template = 'gallery';

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Gallery;