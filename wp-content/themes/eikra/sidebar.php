<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>
<div class="col-sm-4 col-md-3 col-xs-12">
	<aside class="sidebar-widget-area">
		<?php
		if ( is_singular( 'lp_course' ) && RDTheme_Helper::is_LMS() ) {
			learn_press_get_template( 'custom/content-course-sidebar.php' );
		}
		else {
			if ( RDTheme::$sidebar ) {
				if ( is_active_sidebar( RDTheme::$sidebar ) ) dynamic_sidebar( RDTheme::$sidebar );
			}
			else {
				if ( is_active_sidebar( 'sidebar' ) ) dynamic_sidebar( 'sidebar' );
			}
		}
		?>
	</aside>
</div>