<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.5
 */

$rdtheme_has_entry_meta  = ( ( !has_post_thumbnail() && RDTheme::$options['post_date'] ) || RDTheme::$options['post_author_name'] || RDTheme::$options['post_comment_num'] || RDTheme::$options['post_cats'] ) ? true : false;
$rdtheme_time_html       = sprintf( '<li>%s</li><li>%s</li>', get_the_time( 'd M' ), get_the_time( 'Y' ) );
$rdtheme_time_html       = apply_filters( 'rdtheme_single_time', $rdtheme_time_html );

$rdtheme_comments_number = number_format_i18n( get_comments_number() );
$rdtheme_comments_html = $rdtheme_comments_number < 2 ? esc_html__( 'Comment' , 'eikra' ) : esc_html__( 'Comments' , 'eikra' );
$rdtheme_comments_html = '<span>('. $rdtheme_comments_number . ')</span> ' . $rdtheme_comments_html;
$term_seperator = !is_rtl() ? ', ' : '<span class="rtin-sep">&bull;</span>';
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'post-each' ); ?>>
	<div class="entry-header">
		<?php if ( has_post_thumbnail() ): ?>
			<div class="entry-thumbnail-area">
				<?php the_post_thumbnail( 'rdtheme-size1' );?>
				<?php if ( RDTheme::$options['post_date'] ): ?>
					<ul class="post-date">
						<?php echo wp_kses_post( $rdtheme_time_html );?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>	
		<?php if ( $rdtheme_has_entry_meta ): ?>
			<div class="entry-meta bar1 clearfix">
				<ul>
					<?php if ( !has_post_thumbnail() && RDTheme::$options['post_date'] ): ?>
						<li><i class="fa fa-calendar" aria-hidden="true"></i><span><?php esc_html_e( 'Posted on', 'eikra' );?></span><?php the_time( get_option( 'date_format' ) );?></li>
					<?php endif; ?>
					<?php if ( RDTheme::$options['post_author_name'] ): ?>
						<li><i class="fa fa-user" aria-hidden="true"></i><span><?php esc_html_e( 'By', 'eikra' ) ?></span><?php the_author_posts_link();?></li>
					<?php endif; ?>
					<?php if ( RDTheme::$options['post_cats'] && has_category() ): ?>
						<li><i class="fa fa-tags" aria-hidden="true"></i><?php the_category( $term_seperator ); ?></li>
					<?php endif; ?>
					<?php if ( RDTheme::$options['post_comment_num'] ): ?>
						<li><i class="fa fa-comments-o" aria-hidden="true"></i><?php echo wp_kses_post( $rdtheme_comments_html );?></li>
					<?php endif; ?>
				</ul>			
			</div>			
		<?php endif; ?>
	</div>
	<div class="entry-content">
		<?php the_content();?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">', 'after'  => '</div>' ) );?>
	</div>
	<?php if ( RDTheme::$options['post_tags'] && has_tag() ): ?>
		<div class="entry-footer">
			<div class="tags clearfix">
				<span><?php esc_html_e( 'Tags:', 'eikra' );?></span>
				<?php
				if ( is_rtl() ) { 	
					echo get_the_term_list( $post->ID, 'post_tag', '', '<span class="rtin-sep">&bull;</span>' );
				}
				else {
					echo get_the_term_list( $post->ID, 'post_tag', '', ', ' );
				}
				?>
			</div>
		</div>		
	<?php endif; ?>
</div>