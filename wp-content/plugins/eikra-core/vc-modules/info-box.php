<?php
if ( !class_exists( 'RDTheme_VC_Info_Text' ) ) {

	class RDTheme_VC_Info_Box extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Eikra: Info Box", 'eikra-core' );
			$this->base = 'eikra-vc-info-box';
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Layout", 'eikra-core' ),
					"param_name" => "layout",
					'value' => array( 
						__( 'Layout 1', 'eikra-core' ) => 'layout1',
						__( 'Layout 2', 'eikra-core' ) => 'layout2',
						__( 'Layout 3', 'eikra-core' ) => 'layout3',
						__( 'Layout 4', 'eikra-core' ) => 'layout4',
						__( 'Layout 5', 'eikra-core' ) => 'layout5',
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Alignment", 'eikra-core' ),
					"param_name" => "alignment",
					'value' => array( 
						__( 'Center', 'eikra-core' ) => 'center',
						__( 'Left', 'eikra-core' )   => 'left',
					),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout5' ),
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon Type", 'eikra-core' ),
					"param_name" => "icontype",
					'value' => array(
						__( 'FontAwesome', 'eikra-core' )  => 'fontawesome',
						__( 'Custom Image', 'eikra-core' ) => 'image',
					),
				),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'FontAwesome Icon', 'eikra-core' ),
					'param_name' => 'icon',
					"value" => 'fa fa-graduation-cap',
					'settings' => array(
						'emptyIcon' => false,
						'iconsPerPage' => 160,
					),
					'dependency' => array(
						'element' => 'icontype',
						'value'   => array( 'fontawesome' ),
					),
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Upload icon image", 'eikra-core' ),
					"param_name" => "image",
					'dependency' => array(
						'element' => 'icontype',
						'value'   => array( 'image' ),
					),
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon style", 'eikra-core' ),
					"param_name" => "icon_style",
					'value' => array( 
						__( 'Rounded', 'eikra-core' ) => 'rounded',
						__( 'Squire', 'eikra-core' )  => 'squire',
					),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2','layout3', 'layout4' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon size", 'eikra-core' ),
					"param_name" => "size",
					'description' => __( 'Icon size in px eg. 30', 'eikra-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon padding", 'eikra-core' ),
					"param_name" => "icon_padding",
					'description' => __( "Icon padding in px eg. 15px. Doesn't work on custom image" , 'eikra-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout2' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", 'eikra-core' ),
					"param_name" => "title",
					"value" => 'I am Title',
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title URL", 'eikra-core' ),
					"param_name" => "url",
					'description' => __( "keep this field empty if you don't want the title linkable", 'eikra-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2','layout3', 'layout4' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Font Size", 'eikra-core' ),
					"param_name" => "title_size",
					'description' => __( 'Title font size in px. eg 20. If not defined, default h3 font size will be used', 'eikra-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2','layout3', 'layout4' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Subitle", 'eikra-core' ),
					"param_name" => "subtitle",
					"value" => 'I am Subtitle',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout5' ),
					),
				),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", 'eikra-core' ),
					"param_name" => "content",
					"value" => 'Lorem Ipsum has been the industrys standard dummy text ever since the en an unknown printer galley dear',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2', 'layout4' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Font Size", 'eikra-core' ),
					"param_name" => "content_size",
					'description' => __( 'Content font size in px eg. 15. If not defined, default body font size will be used', 'eikra-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2', 'layout4' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Width", 'eikra-core' ),
					"param_name" => "width",
					'description' => __( "Content maximum width in px eg 360. Keep this field empty if you want full width", 'eikra-core' ),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Spacing Before Title", 'eikra-core' ),
					"param_name" => "spacing_top",
					"description" => __( "Spacing between icon and title in px eg. 25", 'eikra-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2' ),
					),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Spacing After Title", 'eikra-core' ),
					"param_name" => "spacing_bottom",
					"description" => __( "Spacing between title and content in px eg. 12", 'eikra-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'layout1', 'layout2' ),
					),
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
				'layout'         => 'layout1',
				'alignment'      => 'center',
				'icontype'       => 'fontawesome',
				'icon'           => 'fa fa-graduation-cap',
				'image'          => '',
				'icon_style'     => 'rounded',
				'size'           => '',
				'icon_padding'   => '',
				'title'          => 'I am Title',
				'subtitle'       => 'I am Subtitle',
				'url'            => '',
				'title_size'     => '',
				'content_size'   => '',
				'width'          => '',
				'spacing_top'    => '',
				'spacing_bottom' => '',
				'css'            => '',
				), $atts ) );


			$layout_class_replace = array(
				'layout1' => 'layout2',
				'layout2' => 'layout3',
				'layout3' => 'layout4',
				'layout4' => 'layout5',
				'layout5' => 'layout6',
			);
			$layout = $layout_class_replace[$layout];

			if ( $layout == 'layout6' ) {
				$template = 'info-box-6';
			}
			else {
				$template = 'info-box';
			}

			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Info_Box;