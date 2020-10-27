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
$rdtheme_meta_count = 1;

if ( empty( $rdtheme_course ) ) return;

$rdtheme_enroll_count = $rdtheme_course->get_users_enrolled();
$rdtheme_enroll_count = $rdtheme_enroll_count ? $rdtheme_enroll_count : 0;

if ( function_exists( 'learn_press_get_course_rate' ) ) {
	$course_rate_res = learn_press_get_course_rate( $rdtheme_id, false );
	$course_rate     = $course_rate_res['rated'];
	$rdtheme_meta_count++;
}
if ( class_exists( 'LP_Addon_Wishlist' ) ){
	$rdtheme_meta_count++;
}

if ( $rdtheme_meta_count == 1 ) {
	$rdtheme_meta_col_class = 'col-sm-12 col-xs-12';
}
elseif ( $rdtheme_meta_count == 2 ) {
	$rdtheme_meta_col_class = 'col-sm-6 col-xs-6';
}
else {
	$rdtheme_meta_col_class = 'col-sm-4 col-xs-4';
}
?>
<div <?php post_class( 'rt-course-box' ) ; ?>>
	<?php do_action( 'learn_press_before_courses_loop_item' ); ?>
	<div class="rtin-thumbnail hvr-bounce-to-right">
		<?php the_post_thumbnail( $rdtheme_thumbnail ); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
		<div class="rtin-price"><?php echo rdtheme_lp_price_html( $rdtheme_course, 'left' );?></div>
	</div>
	<div class="rtin-content-wrap">
		<div class="rtin-content">
			<h3 class="rtin-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<div class="rtin-author"><i class="fa fa-user" aria-hidden="true"></i><?php echo wp_kses_post( $rdtheme_course->get_instructor_html() ); ?></div>
			<?php if ( !empty( $rdtheme_content ) ): ?>
				<div class="rtin-description"><?php echo wp_kses_post( $rdtheme_content ); ?></div>
			<?php endif; ?>
		</div>
		<div class="rtin-meta rtin-count-<?php echo esc_attr( $rdtheme_meta_count );?>">
			<div class="row">
				<div class="<?php echo esc_attr( $rdtheme_meta_col_class );?>"><i class="fa fa-users" aria-hidden="true"></i><span><?php echo esc_html( $rdtheme_enroll_count ); ?></span></div>
				<?php if ( function_exists( 'learn_press_get_course_rate' ) ) : ?>
					<div class="<?php echo esc_attr( $rdtheme_meta_col_class );?>"><?php learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );?></div>
				<?php endif; ?>
				<?php if ( class_exists( 'LP_Addon_Wishlist' ) ): ?>
					<div class="<?php echo esc_attr( $rdtheme_meta_col_class );?>"><?php rdtheme_lp_wishlist_icon( $rdtheme_id ); ?></div>			
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<?php do_action( 'learn_press_after_courses_loop_item' ); ?>
</div>