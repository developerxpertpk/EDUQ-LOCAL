<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.0
 */

global $wp_query;

$rdtheme_lp_is_tax = false;

if ( function_exists( 'learn_press_is_course_taxonomy' ) && learn_press_is_course_taxonomy() ) {
	$rdtheme_lp_is_tax = true;
	$temp              = $wp_query;
	$wp_query          = RDTheme_Helper::lp_tax_query_obj();
}

if( function_exists( 'bcn_display') ){
	echo '<div class="breadcrumb-area"><div class="entry-breadcrumb">';
	bcn_display();
	echo '</div></div>';
}

if ( $rdtheme_lp_is_tax ) {
	$wp_query = $temp;
}