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

if ( function_exists( 'learn_press_get_course_rate' ) ) {
	$course_rate_res = learn_press_get_course_rate( $rdtheme_id, false );
	$course_rate     = $course_rate_res['rated'];
}
?>
<div <?php post_class( 'rt-course-box-3' ) ; ?>>
	<?php do_action( 'learn_press_before_courses_loop_item' ); ?>
	<div class="rtin-thumbnail hvr-bounce-to-right">
		<?php the_post_thumbnail( $rdtheme_thumbnail ); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
		<div class="rtin-price"><?php echo rdtheme_lp_price_html( $rdtheme_course, 'left' );?></div>
	</div>
	<div class="rtin-content-wrap">
		<div class="rtin-content">
			<h3 class="rtin-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<?php if ( !empty( $rdtheme_content ) ): ?>
				<div class="rtin-description"><?php echo wp_kses_post( $rdtheme_content ); ?></div>
			<?php endif; ?>
		</div>
		<div class="rtin-meta clearfix">
			<div class="rtin-left pull-left">
				<a class="rtin-author" href="<?php echo esc_url( learn_press_user_profile_link( $rdtheme_author ) );?>"><?php echo get_avatar( $rdtheme_author, 40 ); ?><span><?php echo wp_kses_post( $rdtheme_course->get_instructor_name() ); ?></span></a>
				<?php if ( function_exists( 'learn_press_get_course_rate' ) ) : ?>
					<?php learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );?>
				<?php endif; ?>				
			</div>
			<div class="rtin-right pull-right">
				<?php if ( class_exists( 'LP_Addon_Wishlist' ) ): ?>
					<?php rdtheme_lp_wishlist_icon( $rdtheme_id ); ?>		
				<?php endif; ?>
				<i class="fa fa-users" aria-hidden="true"></i><span><?php echo esc_html( $rdtheme_enroll_count ); ?></span>				
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<?php do_action( 'learn_press_after_courses_loop_item' ); ?>
</div>