<?php
/**
 * Template for displaying content and items of section in single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/section/content.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( ! isset( $section ) ) {
	return;
}

$user = LP_Global::user();
?>

<?php if ( $items = $section->get_items() ): ?>
	<ul class="section-content">
		<?php foreach ( $items as $item ): ?>
			<?php
			$item_type = $item->get_item_type();
			if ( empty( $count[$item_type] ) ) {
				$count[$item_type] = 1;
			}
			else {
				$count[$item_type]++;
			}
			$order = $section->get_order() . '.' . $count[$item_type];
			if ( $item_type == 'lp_quiz' ) {
				$order_text = esc_html__( 'Quiz', 'eikra' );
				$icon = 'fa fa-pencil-square-o';
			}
			else {
				$order_text = esc_html__( 'Lecture', 'eikra' );
				$icon = 'fa fa-file-text-o';
			}

			$order_html = "<span>$order_text </span>$order";
			if ( is_rtl() ) {
				$order_html = "$order";
			}

			$duration = rdtheme_lp_lesson_duration( $item->get_id() );
			if ( $duration ) {
				$item_right_html = '<i class="fa fa-clock-o" aria-hidden="true"></i><span>'.$duration.'</span>';
				$item_class = '';
			}
			else {
				$item_right_html = '';
				$item_class = 'no-counting';
			}
			?>
			<li class="<?php echo join( ' ', $item->get_class( $item_class ) ); ?>">
				<?php
				if ( $item->is_visible() ):
					/**
					 * @since 3.0.0
					 */
					if ( $user->can_view_item( $item->get_id() ) ) {
						$start_tag = '<a class="section-item-link" href="' . $item->get_permalink() . '">';
						$end_tag   = '</a>';
					}
					else {
						$start_tag = '<div class="section-item-link">';
						$end_tag   = '</div>';
					}
					do_action( 'learn-press/begin-section-loop-item', $item );
					?>
					<?php echo wp_kses_post( $start_tag );?>

					<div class="rtin-left">
						<span class="rtin-left-icon"><i class="<?php echo esc_attr( $icon );?>"></i></span>
						<span class="rtin-left-index"><?php echo wp_kses_post( $order_html ); ?></span>
					</div>
					<div class="rtin-center">
						<span class="course-item-title"><?php echo wp_kses_post( $item->get_title( 'display' ) ); ?></span>
						<div class="course-item-meta">
							<?php do_action( 'learn-press/course-section-item/before-' . $item->get_item_type() . '-meta', $item ); ?>
							<?php if ( $item->is_preview() ): ?>
								<?php $course_id = $section->get_course_id(); ?>
								<?php if ( get_post_meta( $course_id, '_lp_required_enroll', true ) == 'yes' ): ?>
									<span><?php esc_html_e( 'Preview', 'eikra' ); ?></span>
								<?php endif; ?>
							<?php else: ?>
								<i class="fa item-meta course-item-status trans"></i>
							<?php endif; ?>
							<?php do_action( 'learn-press/course-section-item/after-' . $item->get_item_type() . '-meta', $item ); ?>
						</div>
					</div>
					<div class="rtin-right"><?php echo wp_kses_post( $item_right_html );?></div>
					<div class="clear"></div>

					<?php echo wp_kses_post( $end_tag );?>

					<?php
					/**
					 * @since 3.0.0
					 */
					do_action( 'learn-press/end-section-loop-item', $item );
				endif;
				?>

			</li>

		<?php endforeach; ?>
	</ul>
<?php else: ?>
	<?php learn_press_display_message( esc_html__( 'No items in this section', 'eikra' ) ); ?>
<?php endif; ?>