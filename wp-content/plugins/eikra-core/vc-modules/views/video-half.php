<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>
<div class="rt-vc-video rt-<?php echo esc_attr( $background );?>">
	<?php if ( $title ): ?>
		<h2 class="rt-vc-title-left"><?php echo esc_html( $title ); ?></h2>
	<?php endif; ?>
	<div class="rtin-item <?php echo esc_attr( $class );?>">
		<a class="rtin-btn rt-video-popup" href="<?php echo esc_url( $url );?>"><i class="fa fa-play" aria-hidden="true"></i></a>
	</div>
</div>