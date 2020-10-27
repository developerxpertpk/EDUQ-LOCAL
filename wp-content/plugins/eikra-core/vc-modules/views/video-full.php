<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>
<div class="rt-vc-video rt-<?php echo esc_attr( $background );?> <?php echo esc_attr( $class );?>">
	<div class="rtin-item">
		<?php if ( $title ): ?>
			<h2 class="rtin-title"><?php echo esc_html( $title );?></h2>
		<?php endif; ?>
		<p class="rtin-content"><?php echo wp_kses_post( $content );?></p>
		<a class="rtin-btn rt-video-popup" href="<?php echo esc_url( $url );?>"><i class="fa fa-play" aria-hidden="true"></i></a>
	</div>
</div>