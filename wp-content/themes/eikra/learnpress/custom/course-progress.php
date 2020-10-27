<?php
/**
 * @author  RadiusTheme
 * @since   3.1.1
 * @version 3.3
 */

$course = LP_Global::course();
?>
<?php if ( rdtheme_lp_user_can_access_course() && RDTheme::$options['course_progress'] ): ?>
	<div class="widget course-meta-wid course_progress_wid single-sidebar padding-bottom1">
		<h3 class="widgettitle"><?php esc_html_e( 'Your Progress', 'eikra' );?></h3>
		<?php learn_press_course_progress(); ?>
	</div>
<?php endif; ?>
<?php if ( RDTheme::$options['course_price'] ): ?>
	<div class="widget course-meta-wid course_enroll_wid single-sidebar padding-bottom1">
		<h3 class="widgettitle"><?php esc_html_e( 'Price', 'eikra' );?></h3>
		<div class="rtin-pricing"><?php echo rdtheme_lp_price_html( $course );?></div>
		<?php learn_press_course_buttons();?>
	</div>	
<?php endif; ?>
<?php if ( function_exists( 'learn_press_course_review_template' ) && RDTheme::$options['course_rating'] ): ?>
	<div class="widget course-meta-wid course_review_wid single-sidebar padding-bottom1">
		<h3 class="widgettitle"><?php esc_html_e( 'Rating', 'eikra' );?></h3>
		<?php learn_press_course_review_template( 'course-rate.php' );?>
	</div>
<?php endif; ?>