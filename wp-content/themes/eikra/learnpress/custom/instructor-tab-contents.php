<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.3
 */

$course_id   = get_the_ID();
$author_id   = get_post_field( 'post_author', $course_id );
$author_info = get_the_author_meta( 'rt_lp_instructor_info', $author_id );
$author_name = get_the_author_meta( 'display_name', $author_id );
$author_bio  = get_user_meta( $author_id, 'description', true );
$author_link = learn_press_user_profile_link( get_post_field( 'post_author', $course_id ) );
$socials     = isset( $author_info['socials'] ) ? $author_info['socials'] : array();
$socials     = array_filter( $socials );
$socials_fields = RDTheme_Helper::instructor_socials();
?>
<div class="course-instructor-tab-contents">
	<div class="media">
		<div class="media-left pull-left">
			<a href="<?php echo esc_url( $author_link );?>"><?php echo get_avatar( $author_id, 130 ); ?></a>
		</div>
		<div class="media-body">
			<div class="author-name"><a href="<?php echo esc_url( $author_link );?>"><?php echo esc_html( $author_name );?></a></div>
			<?php if ( !empty( $author_info['designation'] ) ) : ?>
				<div class="author-designation"><?php echo esc_html( $author_info['designation'] ); ?></div>
			<?php endif; ?>
			<?php if ( $author_bio ): ?>
				<div class="author-bio"><?php echo esc_html( $author_bio );?></div>
			<?php endif; ?>
			<?php if ( !empty( $socials ) ) : ?>
				<ul class="rtin-social rt-lp-socials">
					<?php foreach ( $socials as $key => $value ): ?>
						<li><a href="<?php echo esc_url(  $value ); ?>" target="_blank"><i class="fa <?php echo esc_attr( $socials_fields[$key]['icon'] ); ?>"></i></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>		
	</div>
</div>