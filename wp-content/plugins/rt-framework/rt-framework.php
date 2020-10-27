<?php
/*
Plugin Name: RT Framework
Plugin URI: http://radiustheme.com
Description: Theme Framework by RadiusTheme
Version: 1.15
Author: Radius Theme
Author URI: http://radiustheme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit;

if ( defined( 'RT_FRAMEWORK_VERSION' ) ) exit;

define( 'RT_FRAMEWORK_VERSION', ( WP_DEBUG ) ? time() : '1.15' );

// Text Domain
add_action( 'plugins_loaded', 'rt_fw_load_textdomain' );
function rt_fw_load_textdomain() {
	load_plugin_textdomain( 'rt-framework' , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

// Load Framework
add_action( 'setup_theme', 'rt_fw_load_files' );
function rt_fw_load_files(){
	require_once 'inc/rt-posts.php';
	require_once 'inc/rt-postmeta.php';
	require_once 'inc/rt-widget-fields.php';
}