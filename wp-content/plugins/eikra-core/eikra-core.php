<?php
/*
Plugin Name: Eikra Core
Plugin URI: http://radiustheme.com
Description: Eikra Core Plugin for Eikra Theme
Version: 2.3
Author: Radius Theme
Author URI: http://radiustheme.com
*/

define( 'EIKRA_CORE', true );
define( 'EIKRA_CORE_VERSION', '2.3' );
define( 'EIKRA_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
define( 'EIKRA_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );

// Text Domain
add_action( 'plugins_loaded', 'eikra_core_load_textdomain' );
if ( !function_exists( 'eikra_core_load_textdomain' ) ) {
	function eikra_core_load_textdomain() {
		load_plugin_textdomain( 'eikra-core' , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	}
}

// Includes
add_action( 'after_setup_theme', 'eikra_core_includes', 4 );
if ( !function_exists( 'eikra_core_includes' ) ) {
	function eikra_core_includes(){
		if ( !defined( 'EIKRA_VERSION' ) || ! defined( 'RT_FRAMEWORK_VERSION' ) ) {
			return;
		}

		// Widgets
		require_once EIKRA_CORE_BASE_DIR . 'widgets/init.php';

		// Demo Importer settings
		require_once EIKRA_CORE_BASE_DIR . 'demo-importer.php';
		require_once EIKRA_CORE_BASE_DIR . 'demo-importer-ocdi.php';
	}
}

// Post types
add_action( 'after_setup_theme', 'eikra_core_post_types', 15 );
if ( !function_exists( 'eikra_core_post_types' ) ) {
	function eikra_core_post_types(){
		if ( !defined( 'EIKRA_VERSION' ) || ! defined( 'RT_FRAMEWORK_VERSION' ) ) {
			return;
		}
		require_once EIKRA_CORE_BASE_DIR . 'post-types.php';
		require_once EIKRA_CORE_BASE_DIR . 'post-meta.php';
	}
}

// Visual composer
add_action( 'after_setup_theme', 'eikra_core_vc_modules', 20 );
if ( !function_exists( 'eikra_core_vc_modules' ) ) {
	function eikra_core_vc_modules(){
		if ( !defined( 'EIKRA_VERSION' ) || ! defined( 'WPB_VC_VERSION' ) || ! defined( 'RT_FRAMEWORK_VERSION' ) ) {
			return;
		}

		$modules = array( 'inc/abstruct', 'title', 'info-box', 'image-text-box', 'text-with-title', 'text-with-button', 'cta', 'posts', 'research', 'event', 'course-search', 'course-slider', 'course-grid', 'course-featured', 'course-isotope', 'instructor-slider', 'instructor-grid', 'counter', 'testimonial', 'event-countdown', 'countdown', 'logo-slider', 'product-slider', 'pricing-box' , 'gallery', 'video', 'contact' );
		$modules = apply_filters( 'eikra_vc_addons_list', $modules );

		foreach ( $modules as $module ) {
			$template_name = "/vc-modules/{$module}.php";
			if ( file_exists( STYLESHEETPATH . $template_name ) ) {
				$file = STYLESHEETPATH . $template_name;
			}
			elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
				$file = TEMPLATEPATH . $template_name;
			}
			else {
				$file = EIKRA_CORE_BASE_DIR . 'vc-modules/' . $module. '.php';
			}
			require_once $file;
		}
	}
}

// Plugin Hooks
require_once EIKRA_CORE_BASE_DIR . 'plugin-hooks.php';