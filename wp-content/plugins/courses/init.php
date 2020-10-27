<?php
/*
Plugin Name: Courses
Description: Beheer van VCA-Plus trainigen
Version: 1
Author: cms4biz.nl
Author URI: http://cms4biz.nl
*/
// function to create the DB / Options / Defaults					
function c_options_install() {

    global $wpdb;

    $table_name = $wpdb->prefix . "courses";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            `id` varchar(3) CHARACTER SET utf8 NOT NULL,
            `date` varchar(50) CHARACTER SET utf8 NOT NULL,
			`location` varchar(150) CHARACTER SET utf8 NOT NULL,
			`course` varchar(10) CHARACTER SET utf8 NOT NULL,
			`date` NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'c_options_install');

//menu items
add_action('admin_menu','courses_modifymenu');
function courses_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Trainingen', //page title
	'VCA Trainingen', //menu title
	'manage_options', //capabilities
	'course_list', //menu slug
	'course_list' //function
	);
	
	//this is a submenu
	add_submenu_page('trainigen_list', //parent slug
	'Nieuw training', //page title
	'Toevoegen', //menu title
	'manage_options', //capability
	'course_create', //menu slug
	'course_create'); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
	'Update Training', //page title
	'Update', //menu title
	'manage_options', //capability
	'course_update', //menu slug
	'course_update'); //function
}
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'course-list.php');
require_once(ROOTDIR . 'course-create.php');
require_once(ROOTDIR . 'course-update.php');
