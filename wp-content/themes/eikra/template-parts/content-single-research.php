<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-header">
		<?php if ( has_post_thumbnail() ): ?>
			<div class="entry-thumbnail-area">
				<?php the_post_thumbnail( 'rdtheme-size1' ); ?>
			</div>
		<?php endif; ?>
	</div>
	<div class="entry-content">
		<?php the_content();?>
	</div>
</div>