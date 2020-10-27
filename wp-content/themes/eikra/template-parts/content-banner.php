<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.5
 */

if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
	$rdtheme_title = woocommerce_page_title( false );
}
elseif ( function_exists( 'learn_press_is_course_taxonomy' ) && learn_press_is_course_taxonomy() ) {
	if ( function_exists( 'learn_press_is_course_category' ) && learn_press_is_course_category() ) {
		$taxonomy = 'course_category';
		$rdtheme_title = esc_html__( 'Course Category:', 'eikra' );
	}
	if ( function_exists( 'learn_press_is_course_tag' ) && learn_press_is_course_tag() ) {
		$taxonomy = 'course_tag';
		$rdtheme_title = esc_html__( 'Course Tag:', 'eikra' );
	}
	$term_name     = RDTheme_Helper::lp_get_term_name( $taxonomy );
	$rdtheme_title = $rdtheme_title . ' ' . $term_name;
}
elseif ( is_404() ) {
	$rdtheme_title = RDTheme::$options['error_title'];
}
elseif ( is_search() ) {
	$rdtheme_title = esc_html__( 'Search Results for : ', 'eikra' ) . get_search_query();
}
elseif ( is_home() ) {
	if ( get_option( 'page_for_posts' ) ) {
		$rdtheme_title = get_the_title( get_option( 'page_for_posts' ) );
	}
	else {
		$rdtheme_title = apply_filters( 'eikra_blog_title', esc_html__( 'All Posts', 'eikra' ) );
	}
}
elseif ( is_archive() ) {
	if ( is_post_type_archive( 'lp_course' ) ) {
		$rdtheme_title = esc_html__( 'All Courses', 'eikra' );
	}
	else {
		$rdtheme_title = get_the_archive_title();
	}
}
else{
	$rdtheme_title = get_the_title();
}
?>
<?php if ( RDTheme::$has_banner == '1' || RDTheme::$has_banner == 'on' ): ?>
	<div class="entry-banner">
		<div class="container">
			<div class="entry-banner-content">
				<h1 class="entry-title"><?php echo wp_kses_post( $rdtheme_title );?></h1>
				<?php if ( RDTheme::$has_breadcrumb == '1' || RDTheme::$has_breadcrumb == 'on' ): ?>
					<?php get_template_part( 'template-parts/content', 'breadcrumb' );?>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>