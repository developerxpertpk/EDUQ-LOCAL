<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.6
 */

$rdtheme_theme_data = wp_get_theme( get_template() );
if ( function_exists('vc_is_inline') && vc_is_inline() ) {
	define( 'EIKRA_VERSION', time() );
}
else {
	define( 'EIKRA_VERSION', ( WP_DEBUG ) ? time() : $rdtheme_theme_data->get( 'Version' ) );
}

define( 'RDTHEME_AUTHOR_URI',  $rdtheme_theme_data->get( 'AuthorURI' ) );
define( 'RDTHEME_PREFIX',      'eikra' );

// DIR
define( 'RDTHEME_BASE_DIR',    get_template_directory(). '/' );
define( 'RDTHEME_INC_DIR',     RDTHEME_BASE_DIR . 'inc/' );
define( 'RDTHEME_VIEW_DIR',    RDTHEME_INC_DIR . 'views/' );
define( 'RDTHEME_PLUGINS_DIR', RDTHEME_INC_DIR . 'plugins/' );

// URL
define( 'RDTHEME_BASE_URL',    get_template_directory_uri(). '/' );
define( 'RDTHEME_ASSETS_URL',  RDTHEME_BASE_URL . 'assets/' );
define( 'RDTHEME_CSS_URL',     RDTHEME_ASSETS_URL . 'css/' );
define( 'RDTHEME_AUTORTL_URL', RDTHEME_ASSETS_URL . 'css-auto-rtl/' );
define( 'RDTHEME_JS_URL',      RDTHEME_ASSETS_URL . 'js/' );
define( 'RDTHEME_IMG_URL',     RDTHEME_ASSETS_URL . 'img/' );

// Includes
require_once RDTHEME_INC_DIR . 'helper-functions.php';
RDTheme_Helper::requires( 'class-tgm-plugin-activation.php' );
RDTheme_Helper::requires( 'tgm-config.php' );
RDTheme_Helper::requires( 'redux-config.php' );
RDTheme_Helper::requires( 'rdtheme.php' );
RDTheme_Helper::requires( 'general.php' );
RDTheme_Helper::requires( 'scripts.php' );
RDTheme_Helper::requires( 'layout-settings.php' );
RDTheme_Helper::requires( 'sidebar-generator.php' );
RDTheme_Helper::requires( 'vc-settings.php' );

// Learnpress
if ( RDTheme_Helper::lp_is_v3() ) {
	RDTheme_Helper::requires( 'lp-functions.php', 'learnpress/custom/inc' );
	RDTheme_Helper::requires( 'lp-hooks.php', 'learnpress/custom/inc' );
}

// WooCommerce
if ( class_exists( 'WooCommerce' ) ) {
	RDTheme_Helper::requires( 'woo-functions.php' );
	RDTheme_Helper::requires( 'woo-hooks.php' );
}

// Notices
if ( defined( 'EIKRA_CORE' ) ) {
	$notice = false;

	if ( defined( 'EIKRA_CORE_VERSION' ) ) {
		if ( version_compare( EIKRA_CORE_VERSION, '2.3', '<' ) ) {
			$notice = true;
		}
	}
	else {
		$notice = true;
	}

	if ( $notice ) {
		add_action( 'admin_notices', 'eikra_core_plugin_update_notice', 3 );	
	}
}

function eikra_core_plugin_update_notice() {
	$notice = '<div class="error"><p>' . sprintf( __( "Please update plugin <b><i>Eikra Core</b></i> to the latest version otherwise some functionalities will not work properly. You can update it from <a href='%s'>here</a>", 'eikra' ), menu_page_url( 'eikra-install-plugins', false ) ) . '</p></div>';
	echo wp_kses_post( $notice );
}