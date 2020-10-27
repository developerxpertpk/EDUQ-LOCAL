<?php
/**
 * @author  RadiusTheme
 * @since   2.1
 * @version 2.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class Eikra_Core_Demo_Importer_OCDI {

	public function __construct() {
		add_filter( 'pt-ocdi/import_files', array( $this, 'demo_config' ) );
		add_filter( 'pt-ocdi/after_import', array( $this, 'after_import' ) );
		add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
	}

	public function demo_config() {

		$demos_array = array(
			'demo1' => array(
				'title' => __( 'Home 1', 'eikra-core' ),
				'page'  => __( 'Home 1', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/',
			),
			'demo2' => array(
				'title' => __( 'Home 2', 'eikra-core' ),
				'page'  => __( 'Home 2', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-2/',
			),
			'demo3' => array(
				'title' => __( 'Home 3', 'eikra-core' ),
				'page'  => __( 'Home 3', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-3/',
			),
			'demo4' => array(
				'title' => __( 'Home 4', 'eikra-core' ),
				'page'  => __( 'Home 4', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-4/',
			),
			'demo5' => array(
				'title' => __( 'Home 5', 'eikra-core' ),
				'page'  => __( 'Home 5', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-5/',
			),
			'demo6' => array(
				'title' => __( 'Home 6', 'eikra-core' ),
				'page'  => __( 'Home 6', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-6/',
			),
			'demo13' => array(
				'title' => __( 'Home 7', 'eikra-core' ),
				'page'  => __( 'Home 7', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-7/',
			),
			'demo7' => array(
				'title' => __( 'Home 1 Onepage', 'eikra-core' ),
				'page'  => __( 'Home 1 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-1-onepage/',
			),
			'demo8' => array(
				'title' => __( 'Home 2 Onepage', 'eikra-core' ),
				'page'  => __( 'Home 2 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-2-onepage/',
			),
			'demo9' => array(
				'title' => __( 'Home 3 Onepage', 'eikra-core' ),
				'page'  => __( 'Home 3 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-3-onepage/',
			),
			'demo10' => array(
				'title' => __( 'Home 4 Onepage', 'eikra-core' ),
				'page'  => __( 'Home 4 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-4-onepage/',
			),
			'demo11' => array(
				'title' => __( 'Home 5 Onepage', 'eikra-core' ),
				'page'  => __( 'Home 5 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-5-onepage/',
			),
			'demo12' => array(
				'title' => __( 'Home 6 Onepage', 'eikra-core' ),
				'page'  => __( 'Home 6 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-6-onepage/',
			),
			'demo14' => array(
				'title' => __( 'Home 7 Onepage', 'eikra-core' ),
				'page'  => __( 'Home 7 (Onepage)', 'eikra-core' ),
				'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
				'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-7-onepage/',
			),
		);

		$config = array();
		$import_path  = trailingslashit( get_template_directory() ) . 'sample-data/';
		$redux_option = 'eikra';

		foreach ( $demos_array as $key => $demo ) {
			$config[] = array(
				'import_file_id'               => $key,
				'import_page_name'             => $demo['page'],
				'import_file_name'             => $demo['title'],
				'local_import_file'            => $import_path . 'contents.xml',
				'local_import_widget_file'     => $import_path . 'widgets.wie',
				'local_import_customizer_file' => $import_path . 'customizer.dat',
				'local_import_redux'           => array(
					array(
						'file_path'   => $import_path . 'options.json',
						'option_name' => $redux_option,
					),
				),
				'import_preview_image_url'   => $demo['screenshot'],
				'preview_url'                => $demo['preview_link'],
			);
		}

		return $config;
	}

	public function after_import( $selected_import ) {
		$this->assign_menu( $selected_import['import_file_id'] );
		$this->assign_frontpage( $selected_import );
		$this->update_contact_form_email();
		$this->update_bcn_options();
	}

	private function assign_menu( $demo ) {
		if ( $demo == 'demo7' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 1', 'nav_menu' );
		}
		elseif( $demo == 'demo8' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 2', 'nav_menu' );
		}
		elseif( $demo == 'demo9' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 3', 'nav_menu' );
		}
		elseif( $demo == 'demo10' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 4', 'nav_menu' );
		}
		elseif( $demo == 'demo11' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 5', 'nav_menu' );
		}
		elseif( $demo == 'demo12' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 6', 'nav_menu' );
		}
		elseif( $demo == 'demo14' ) {
			$primary = get_term_by( 'name', 'Onepage Menu - Home 7', 'nav_menu' );
		}
		else {
			$primary  = get_term_by( 'name', 'Main Menu', 'nav_menu' );
		}

		$topright = get_term_by( 'name', 'Featured Links', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
			'primary'  => $primary->term_id,
			'topright' => $topright->term_id,
		));
	}

	private function assign_frontpage( $selected_import ) {
		$blog_page  = get_page_by_title( 'News' );
		$front_page = get_page_by_title( $selected_import['import_page_name'] );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front',  $front_page->ID );
		update_option( 'page_for_posts', $blog_page->ID );
	}

	private function update_contact_form_email() {
		$form1 = get_page_by_title( 'Contact', OBJECT, 'wpcf7_contact_form' );
		$form2 = get_page_by_title( 'Request a Quote', OBJECT, 'wpcf7_contact_form' );

		$forms = array( $form1, $form2 );
		foreach ( $forms as $form ) {
			if ( !$form ) {
				continue;
			}
			$cf7id = $form->ID;
			$mail  = get_post_meta( $cf7id, '_mail', true );
			$mail['recipient'] = get_option( 'admin_email' );
			if ( class_exists( 'WPCF7_ContactFormTemplate' ) ) {
				$pattern = "/<[^@\s]*@[^@\s]*\.[^@\s]*>/"; // <email@email.com>
				$replacement = '<'. WPCF7_ContactFormTemplate::from_email().'>';
				$mail['sender'] = preg_replace($pattern, $replacement, $mail['sender']);
			}
			update_post_meta( $cf7id, '_mail', $mail );		
		}
	}

	private function update_bcn_options() {
		$options = get_option( 'bcn_options' );

		$shop     = get_page_by_title( 'Shop' );
		$course   = get_page_by_title( 'Courses' );
		$research = get_page_by_title( 'Research' );
		$event    = get_page_by_title( 'Events' );

		if ( $shop ) {
			$options['apost_product_root'] = $shop->ID;
		}

		if ( $course ) {
			$options['apost_lp_course_root'] = $course->ID;
		}

		if ( $research ) {
			$options['apost_ac_research_root'] = $research->ID;
		}

		if ( $event ) {
			$options['apost_ac_event_root'] = $event->ID;
		}

		update_option( 'bcn_options', $options );
	}
}

new Eikra_Core_Demo_Importer_OCDI;