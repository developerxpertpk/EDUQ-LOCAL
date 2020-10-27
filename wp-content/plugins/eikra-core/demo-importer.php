<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.2
 */

require_once EIKRA_CORE_BASE_DIR . 'demo-users/user-importer.php';

add_filter( 'plugin_action_links_rt-demo-importer/rt-demo-importer.php', 'eikra_importer_add_action_links' );
add_filter( 'rt_demo_installer_warning', 'eikra_importer_warning' );
add_filter( 'fw:ext:backups-demo:demos', 'eikra_importer_backups_demos' );
add_action( 'fw:ext:backups:tasks:success:id:demo-content-install', 'eikra_importer_after_demo_install' );

function eikra_importer_add_action_links( $links ) {
	$mylinks = array(
		'<a href="' . esc_url( admin_url( 'tools.php?page=fw-backups-demo-content' ) ) . '">'.__( 'Install Demo Contents', 'eikra-core' ).'</a>',
	);
	return array_merge( $links, $mylinks );
}

function eikra_importer_warning( $links ) {
	$html  = '<div style="margin-top:20px;color:#f00;font-size:20px;line-height:1.3;font-weight:600;margin-bottom:40px;border-color: #f00;border-style: dashed;border-width: 1px 0;padding:10px 0;">';
	$html .= __( 'Warning: All your old data will be lost if you install One Click demo data from here, so it is suitable only for a new website.', 'eikra-core');
	$html .= '</div>';
	return $html;
}

function eikra_importer_backups_demos( $demos ) {
	$demos_array = array(
		'demo1' => array(
			'title' => __( 'Home 1', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/',
		),
		'demo2' => array(
			'title' => __( 'Home 2', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-2/',
		),
		'demo3' => array(
			'title' => __( 'Home 3', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-3/',
		),
		'demo4' => array(
			'title' => __( 'Home 4', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-4/',
		),
		'demo5' => array(
			'title' => __( 'Home 5', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-5/',
		),
		'demo6' => array(
			'title' => __( 'Home 6', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-6/',
		),
		'demo13' => array(
			'title' => __( 'Home 7', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-7/',
		),
		'demo7' => array(
			'title' => __( 'Home 1 Onepage', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-1-onepage/',
		),
		'demo8' => array(
			'title' => __( 'Home 2 Onepage', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-2-onepage/',
		),
		'demo9' => array(
			'title' => __( 'Home 3 Onepage', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-3-onepage/',
		),
		'demo10' => array(
			'title' => __( 'Home 4 Onepage', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-4-onepage/',
		),
		'demo11' => array(
			'title' => __( 'Home 5 Onepage', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-5-onepage/',
		),
		'demo12' => array(
			'title' => __( 'Home 6 Onepage', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-6-onepage/',
		),
		'demo14' => array(
			'title' => __( 'Home 7 Onepage', 'eikra-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot7.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/eikra/home-7-onepage/',
		),
	);

	$download_url = 'http://radiustheme.com/demo/wordpress/demo-content/eikra/';

	foreach ($demos_array as $id => $data) {
		$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
			'url' => $download_url,
			'file_id' => $id,
		));
		$demo->set_title($data['title']);
		$demo->set_screenshot($data['screenshot']);
		$demo->set_preview_link($data['preview_link']);

		$demos[ $demo->get_id() ] = $demo;

		unset($demo);
	}

	return $demos;
}

// Run after demo install
function eikra_importer_after_demo_install( $collection ){
	// Update front page id
	$demos = array(
		'demo1'  => 54,
		'demo2'  => 1096,
		'demo3'  => 1135,
		'demo4'  => 1205,
		'demo5'  => 1284,
		'demo6'  => 1273,
		'demo7'  => 1537,
		'demo8'  => 1555,
		'demo9'  => 1573,
		'demo10' => 1588,
		'demo11' => 1601,
		'demo12' => 1612,
		'demo13' => 1734,
		'demo14' => 1802,
	);

	$data = $collection->to_array();

	foreach( $data['tasks'] as $task ) {
		if( $task['id'] == 'demo:demo-download' ){
			$demo_id = $task['args']['demo_id'];
			$page_id = $demos[$demo_id];
			update_option( 'page_on_front', $page_id );
			flush_rewrite_rules();
			break;
		}
	}

	// Update contact form 7 email
	$cf7ids = array( 7, 1749 );
	foreach ( $cf7ids as $cf7id ) {
		$mail = get_post_meta( $cf7id, '_mail', true );
		$mail['recipient'] = get_option( 'admin_email' );
		if ( class_exists( 'WPCF7_ContactFormTemplate' ) ) {
			$pattern = "/<[^@\s]*@[^@\s]*\.[^@\s]*>/"; // <email@email.com>
			$replacement = '<'. WPCF7_ContactFormTemplate::from_email().'>';
			$mail['sender'] = preg_replace($pattern, $replacement, $mail['sender']);
		}
		update_post_meta( $cf7id, '_mail', $mail );		
	}

	// Update post author id
	global $wpdb;
	$id = get_current_user_id();
	if ( $id && $id != 1 ) {
		$query = "UPDATE $wpdb->posts SET post_author = $id";
		$wpdb->query($query);		
	}

	// Import Users
	new Eikra_Core_Demo_User_Import();
}