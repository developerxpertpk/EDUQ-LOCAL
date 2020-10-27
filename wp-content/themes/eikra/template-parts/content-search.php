<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-each' ); ?>>
	<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
	<div class="entry-content"><?php the_excerpt();?><div class="mt20"><a href="<?php the_permalink(); ?>" class="readmore-btn rdtheme-button-2"><?php esc_html_e( 'Read More', 'eikra' ); ?></a></div>
	</div>
</article>