<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.3
 */

$rdtheme_thumbnail = !empty( $rdtheme_thumbnail ) ? $rdtheme_thumbnail : 'rdtheme-size2';
$rdtheme_content   = !empty( $rdtheme_content ) ? $rdtheme_content : RDTheme_Helper::course_excerpt();

$rdtheme_id = get_the_ID();
$rdtheme_course = LP_Global::course();

if ( empty( $rdtheme_course ) ) return;

$rdtheme_author = get_post_field( 'post_author', $rdtheme_id );
$rdtheme_enroll_count = $rdtheme_course->get_users_enrolled();
$rdtheme_enroll_count = $rdtheme_enroll_count ? $rdtheme_enroll_count : 0;
$rdtheme_enroll_text = $rdtheme_enroll_count > 1 ? esc_html__( 'Students', 'eikra' ) : esc_html__( 'Student', 'eikra' );

if ( function_exists( 'learn_press_get_course_rate' ) ) {
	$course_rate_res = learn_press_get_course_rate( $rdtheme_id, false );
	$course_rate     = $course_rate_res['rated'];
	$course_rate_total = $course_rate_res['total'];
	$course_rate_text = $course_rate_total > 1 ? esc_html__( 'Reviews', 'eikra' ) : esc_html__( 'Review', 'eikra' );
}
?>
<div <?php post_class( 'rt-course-box-2' ) ; ?>>
	<?php do_action( 'learn_press_before_courses_loop_item' ); ?>
	<div class="rtin-thumbnail">
		<?php the_post_thumbnail( $rdtheme_thumbnail ); ?>
		<?php if ( class_exists( 'LP_Addon_Wishlist' ) ): ?>
			<?php rdtheme_lp_wishlist_icon( $rdtheme_id ); ?>
		<?php endif; ?>
		<div class="rtin-thumb-user"><?php echo get_avatar( $rdtheme_author, 45 ); ?></div>
		<div class="rtin-thumb-meta">
			<div class="rtin-author"><?php echo wp_kses_post( $rdtheme_course->get_instructor_html() ); ?></div>
			<?php if ( function_exists( 'learn_press_get_course_rate' ) ) : ?>
				<?php learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );?><span class="rtin-rating-total">/ <?php echo esc_html( $course_rate_total );?> <?php echo esc_html( $course_rate_text );?></span>
			<?php endif; ?>
		</div>
	</div>
	<div class="rtin-content-wrap">
		<div class="rtin-content">
			<h3 class="rtin-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<?php if ( !empty( $rdtheme_content ) ): ?>
				<div class="rtin-description"><?php echo wp_kses_post( $rdtheme_content ); ?></div>
			<?php endif; ?>
		</div>
		<div class="rtin-meta clearfix">
			<div class="rtin-enrolled pull-left">
				<i class="fa fa-users" aria-hidden="true"></i>
				<span class="rtin-count"><?php echo esc_html( $rdtheme_enroll_count ); ?></span>
				<span class="rtin-text"><?php echo esc_html( $rdtheme_enroll_text )?></span>
			</div>
			<div class="rtin-price pull-right"><?php echo rdtheme_lp_price_html( $rdtheme_course, 'left' );?></div>
		</div>
	</div>
	<div class="clear"></div>
	<?php do_action( 'learn_press_after_courses_loop_item' ); ?>
</div>