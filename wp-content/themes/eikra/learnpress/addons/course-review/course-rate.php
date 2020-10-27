<?php
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$course_id       = get_the_ID();
$course_rate_res = learn_press_get_course_rate( $course_id, false );
$course_rate     = $course_rate_res['rated'];
?>
<?php if ( $course_rate ): ?>
	<div class="course-rate">
		<div class="average-rating"><?php esc_html_e( 'Average Rating', 'eikra' )?><span><?php printf( '%1.1f', $course_rate );?></span></div>
		<?php learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );?>
		<?php
		if ( isset( $course_rate_res['items'] ) && !empty( $course_rate_res['items'] ) ):
			$count = 0;
			foreach ( $course_rate_res['items'] as $item ):
				$count++;
				$star_text = ( $count == 5 ) ? esc_html__( ' Star', 'eikra' ) : esc_html__( ' Stars', 'eikra' );
				$percent = round( $item['percent'], 0 );
				?>
				<div class="course-each-rating">
					<div class="star-info clearfix">
						<div class="pull-left"><?php echo esc_html( $item['rated'] ); ?><?php echo esc_html( $star_text ); ?></div>
						<div class="pull-right"><?php echo esc_html( $item['total'] ); ?></div>
					</div>
					<div class="review-bar">
						<div class="rating" style="width:<?php echo esc_attr( $percent ); ?>% "></div>
					</div>
				</div>
				<?php
			endforeach;
		endif;
		?>
	</div>
<?php else: ?>
	<?php esc_html_e( 'Not enough ratings to display', 'eikra' ); ?>
<?php endif; ?>