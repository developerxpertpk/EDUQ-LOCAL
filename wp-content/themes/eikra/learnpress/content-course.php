<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( RDTheme::$layout == 'full-width' ) {
	$rdtheme_course_container_class = 'col-lg-3 col-md-3 col-sm-4 col-xs-12';
}
else{
	$rdtheme_course_container_class = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
}
?>
<div class="rtin-main-cols <?php echo esc_attr( $rdtheme_course_container_class );?>">
	<?php
	$rdtheme_course_style = RDTheme::$options['course_style'];
	if ( RDTheme::$options['course_style'] != 1 ) {
		learn_press_get_template( "custom/course-box-{$rdtheme_course_style}.php" );
	}
	else {
		learn_press_get_template( 'custom/course-box.php' );
	}
	?>
</div>