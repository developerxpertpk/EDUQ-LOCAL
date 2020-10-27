<?php
/**
 * Template for displaying title of section in single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/section/title.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$user        = learn_press_get_current_user();
$course      = learn_press_get_the_course();
$user_course = $user->get_course_data( get_the_ID() );

if ( ! isset( $section ) ) {
	return;
}

$rdtheme_step1 = $user_course->get_completed_items( '', false, $section->get_id() );
$rdtheme_step1 = number_format_i18n( $rdtheme_step1 );
$rdtheme_step2 = $section->count_items();
$rdtheme_step2 = number_format_i18n( $rdtheme_step2 );
if ( is_rtl() ) {
	$rdtheme_steps = "$rdtheme_step2/$rdtheme_step1";
}
else {
	$rdtheme_steps = "$rdtheme_step1/$rdtheme_step2";
}
?>
<h4 class="section-header">
	<span class="title"><?php echo esc_html( $section->get_title() ); ?></span>
	<span class="meta">
		<span class="step"><?php echo esc_html( $rdtheme_steps ); ?></span>
		<span class="collapse"></span>
	</span>
</h4>
<?php if ( $description = $section->get_description() ): ?>
	<p class="section-description"><?php echo wp_kses_post( $description ); ?></p>
<?php endif; ?>