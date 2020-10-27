<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>
<div class="rt-vc-text-button rtin-<?php echo esc_attr( $style );?>">
	<h2 class="rtin-title"><?php echo wp_kses_post( $title );?></h2>
	<h3 class="rtin-subtitle"><?php echo wp_kses_post( $subtitle );?></h3>
	<?php if ( $button_text ): ?>
		<div class="rtin-btn"><a href="<?php echo esc_html( $button_url );?>"><?php echo esc_html( $button_text );?></a></div>
	<?php endif; ?>
</div>