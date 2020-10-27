<?php
/**
 * @author  RadiusTheme
 * @since   1.3
 * @version 3.2
 */

$course = LP_Global::course();

learn_press_get_template( 'custom/course-progress.php' );

if ( is_active_sidebar( 'sidebar-single-course' ) ) dynamic_sidebar( 'sidebar-single-course' );