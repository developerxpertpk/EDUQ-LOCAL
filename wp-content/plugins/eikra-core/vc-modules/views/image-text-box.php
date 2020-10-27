<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$custom_class = vc_shortcode_custom_css_class( $css );
?>
<div class="<?php echo esc_attr( $custom_class );?>">
	<div class="rt-vc-imagetext">
		<?php if ( $link ): ?>
			<a href="<?php echo esc_url( $link );?>">
			<?php endif; ?>
			<div class="rtin-item">
				<div class="rtin-img"><?php echo wp_get_attachment_image( $image, 'full' );?></div>
				<div class="rtin-overlay">
					<div class="rtin-title"><?php echo esc_html( $title );?></div>
					<div class="rtin-subtitle"><?php echo esc_html( $subtitle );?></div>		
				</div>		
			</div>
			<?php if ( $link ): ?>
			</a>
		<?php endif; ?>
	</div>
</div>