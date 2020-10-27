<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.6
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="page-thumbnail"><?php the_post_thumbnail( 'rdtheme-size1' );?></div>
	<?php endif; ?>
	<div class="entry-content">
		<?php the_content();?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after'  => '</div>' ) );?>
	</div>
</article>
<?php
if ( is_singular( 'lp_course' ) && RDTheme::$options['course_sidebar'] ) {
	learn_press_get_template( 'custom/course-progress.php' );
}

if ( is_singular( 'lp_course' ) && RDTheme::$options['course_related'] ) {
	learn_press_get_template( 'custom/related-course.php' );
}