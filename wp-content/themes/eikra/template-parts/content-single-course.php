<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.3
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php if ( has_post_thumbnail() ): ?>
			<div class="entry-thumbnail-area">
				<?php the_post_thumbnail( 'rdtheme-size1' );?>
			</div>
		<?php endif; ?>
	</div>
	<div class="course-terms">
		<?php if ( has_term( '', 'course_category' ) && RDTheme::$options['course_cats'] ): ?>
			<div class="course-term"><span><?php esc_html_e( 'Categories:', 'eikra' );?></span><?php echo get_the_term_list( $post->ID, 'course_category', '', ', ' ); ?></div>
		<?php endif; ?>
		<?php if ( has_term( '', 'course_tag' ) && RDTheme::$options['course_tags'] ): ?>
			<div class="course-term"><span><?php esc_html_e( 'Tags:', 'eikra' );?></span><?php echo get_the_term_list( $post->ID, 'course_tag', '', ', ' ); ?></div>
		<?php endif; ?>		
	</div>
	<div class="course-sep"></div>
	<div class="entry-content">
		<?php the_content();?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after'  => '</div>' ) );?>
	</div>
</div>
<?php
if ( RDTheme::$options['course_related'] ) {
	get_template_part( 'learnpress/custom/related', 'course' );
}