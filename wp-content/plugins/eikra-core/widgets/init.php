<?php
/**
 * @author  RadiusTheme
 * @since   2.2
 * @version 2.2
 */

add_action( 'widgets_init', 'eikra_core_register_widgets' );
function eikra_core_register_widgets() {
	if ( !class_exists( 'RT_Widget_Fields' ) ) return;

	require_once EIKRA_CORE_BASE_DIR . 'widgets/about-widget.php';
	require_once EIKRA_CORE_BASE_DIR . 'widgets/info-widget.php';
	require_once EIKRA_CORE_BASE_DIR . 'widgets/course-cat-widget.php';

	register_widget( 'RDTheme_About_Widget' );
	register_widget( 'RDTheme_Information_Widget' );
	register_widget( 'RDTheme_Course_Category_Widget' );
}