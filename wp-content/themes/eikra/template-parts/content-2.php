<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.5
 */

$thumb_size = 'rdtheme-size2';

$rdtheme_has_entry_meta  = ( ( !has_post_thumbnail() && RDTheme::$options['blog_date'] ) || RDTheme::$options['blog_author_name'] || RDTheme::$options['blog_comment_num'] || RDTheme::$options['blog_cats'] ) ? true : false;
$rdtheme_time_html       = sprintf( '<li>%s</li><li>%s</li>', get_the_time( 'd M' ), get_the_time( 'Y' ) );
$rdtheme_time_html       = apply_filters( 'rdtheme_single_time', $rdtheme_time_html );

$rdtheme_comments_number = number_format_i18n( get_comments_number() );
$rdtheme_comments_html   = $rdtheme_comments_number < 2 ? esc_html__( 'Comment' , 'eikra' ) : esc_html__( 'Comments' , 'eikra' );
$rdtheme_comments_html   = '<span>('. $rdtheme_comments_number . ')</span> ' . $rdtheme_comments_html;
$term_seperator = !is_rtl() ? ', ' : '<span class="rtin-sep">&bull;</span>';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-each-2 post-each-blog' ); ?>>
	<div class="entry-header">
		<div class="entry-thumbnail-area">
			<a href="<?php the_permalink();?>">
				<?php
				if ( has_post_thumbnail() ){
					the_post_thumbnail( $thumb_size );
				}
				else {
					if ( !empty( RDTheme::$options['no_preview_image']['id'] ) ) {
						echo wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
					}
					else {
						echo '<img class="attachment-rdtheme-size2 size-rdtheme-size2 wp-post-image" src="'.RDTHEME_IMG_URL.'noimage-420x273.jpg" alt="'.get_the_title().'">';
					}
				}
				?>
				<?php if ( has_post_thumbnail() && RDTheme::$options['blog_date'] ): ?>
					<ul class="post-date">
						<?php echo wp_kses_post( $rdtheme_time_html );?>
					</ul>
				<?php endif; ?>
			</a>
		</div>
		<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>	
		<?php if ( $rdtheme_has_entry_meta ): ?>
			<div class="entry-meta bar1">
				<ul>
					<?php if ( !has_post_thumbnail() && RDTheme::$options['blog_date'] ): ?>
						<li><i class="fa fa-calendar" aria-hidden="true"></i><span><?php esc_html_e( 'Posted on', 'eikra' );?></span><?php the_time( get_option( 'date_format' ) );?></li>
					<?php endif; ?>
					<?php if ( RDTheme::$options['blog_author_name'] ): ?>
						<li><i class="fa fa-user" aria-hidden="true"></i><span><?php esc_html_e( 'By', 'eikra' ) ?></span><?php the_author_posts_link();?></li>
					<?php endif; ?>
					<?php if ( RDTheme::$options['blog_cats'] && has_category() ): ?>
						<li><i class="fa fa-tags" aria-hidden="true"></i><?php the_category( $term_seperator );?></li>
					<?php endif; ?>
					<?php if ( RDTheme::$options['blog_comment_num'] ): ?>
						<li><i class="fa fa-comments-o" aria-hidden="true"></i><?php echo wp_kses_post( $rdtheme_comments_html );?></li>
					<?php endif; ?>
				</ul>			
			</div>			
		<?php endif; ?>
	</div>
	<div class="entry-content">
		<?php the_excerpt();?>
	</div>
</article>