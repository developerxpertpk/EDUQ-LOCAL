<?php
/**
 * Template for displaying the list of course is in wishlist
 *
 * @author ThimPress
 */

defined( 'ABSPATH' ) || exit();

global $post;

if ( !$wishlist ) {
	learn_press_display_message( esc_html__( 'There are no courses in the wishlist', 'eikra' ) );
	return;
}
?>
<div class="row auto-clear">
	<?php foreach ( $wishlist as $post ): ?>
		<?php setup_postdata( $post ); ?>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
		<?php wp_reset_postdata(); ?>
	<?php endforeach; ?>
</div>