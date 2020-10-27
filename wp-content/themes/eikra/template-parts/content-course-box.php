<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$rdtheme_thumbnail = !empty( $rdtheme_thumbnail ) ? $rdtheme_thumbnail : 'rdtheme-size2';
$rdtheme_content   = !empty( $rdtheme_content ) ? $rdtheme_content : RDTheme_Helper::course_excerpt();
?>
<div <?php post_class( 'rt-course-box' ) ; ?>>
	<div class="rtin-thumbnail hvr-bounce-to-right">
		<?php the_post_thumbnail( $rdtheme_thumbnail ); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
	</div>
	<div class="rtin-content-wrap">
		<div class="rtin-content">
			<h3 class="rtin-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<?php if ( !empty( $rdtheme_content ) ): ?>
				<div class="rtin-description"><?php echo wp_kses_post( $rdtheme_content ); ?></div>
			<?php endif; ?>
		</div>
	</div>
	<div class="clear"></div>
</div>