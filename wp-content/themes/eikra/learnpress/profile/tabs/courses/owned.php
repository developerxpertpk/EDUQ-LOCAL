<?php
/**
 * Template for displaying own courses in courses tab of user profile page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/courses/own.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.11.2
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile       = learn_press_get_profile();
$filter_status = LP_Request::get_string( 'filter-status' );
$query         = $profile->query_courses( 'own', array( 'status' => $filter_status ) );
?>

<div class="learn-press-subtab-content">

    <h3 class="profile-heading">
		<?php esc_html_e( 'My Courses', 'eikra' ); ?>
    </h3>

	<?php if ( $filters = $profile->get_own_courses_filters( $filter_status ) ) { ?>
        <ul class="lp-sub-menu">
			<?php foreach ( $filters as $class => $link ) { ?>
                <li class="<?php echo esc_attr( $class ); ?>"><?php echo wp_kses_post( $link ); ?></li>
			<?php } ?>
        </ul>
	<?php } ?>

	<?php if ( ! $query['total'] ) {
		learn_press_display_message( __( 'No courses!', 'eikra' ) );
	} else { ?>
		
		<div class="rt-owned-courses">
	        <div class="row auto-clear">
				<?php
				global $post;
				foreach ( $query['items'] as $item ) {
					$course = learn_press_get_course( $item );
					$post   = get_post( $item );
					setup_postdata( $post );

					echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
					$rdtheme_course_style = RDTheme::$options['course_style'];
					if ( RDTheme::$options['course_style'] != 1 ) {
						learn_press_get_template( "custom/course-box-{$rdtheme_course_style}.php" );
					}
					else {
						learn_press_get_template( 'custom/course-box.php' );
					}
					echo '</div>';

				}
				wp_reset_postdata();
				?>
	        </div>
		</div>

		<?php $query->get_nav( '', true, $profile->get_current_url() ); ?>

	<?php } ?>
</div>
