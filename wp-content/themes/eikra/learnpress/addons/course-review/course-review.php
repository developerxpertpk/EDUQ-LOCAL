<?php
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$course_id     = get_the_ID();
$course_review = learn_press_get_course_review( $course_id );
if ( $course_review['total'] ) {
	$reviews = $course_review['reviews'];
	?>
	<div id="course-reviews">
		<h3 class="course-review-head"><?php esc_html_e( 'Reviews', 'eikra' ); ?></h3>
		<ul class="course-reviews-list">
			<?php foreach ( $reviews as $review ) { ?>
			<?php
			learn_press_course_review_template( 'loop-review.php', array( 'review' => $review ) );
			?>
			<?php } ?>
			<?php if ( empty( $course_review['finish'] ) ) { ?>
			<li class="loading"><?php esc_html_e( 'Loading...', 'eikra' ); ?></li>
			<?php } ?>
		</ul>
		<?php if ( empty( $course_review['finish'] ) ) { ?>
		<button class="button" id="course-review-load-more" data-paged="<?php echo esc_attr( $course_review['paged'] ); ?>"><?php esc_html_e( 'Load More', 'eikra' ); ?></button>
		<?php } ?>
	</div>
	<?php
}
else {
	?>
	<div class="learn-press-message success"><p><?php esc_html_e( 'There is no review for this course', 'eikra' ); ?></p></div>
	<?php
}