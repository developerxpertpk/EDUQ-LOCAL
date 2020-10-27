<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$custom_class    = vc_shortcode_custom_css_class( $css );
$title_style     = $size ? "font-size:{$size}px;" : '';
$title_style    .= $title_color ? "color:{$title_color};" : '';
$subtitle_style  = $subtitle_color ? "color:{$subtitle_color};" : '';
?>
<div class="rt-vc-title <?php echo esc_attr( $style );?>">
	<div class="<?php echo esc_attr( $custom_class );?>">
		<?php if( !empty( $title ) ): ?>
			<h2 style="<?php echo esc_attr( $title_style ); ?>"><?php echo esc_html( $title );?></h2>
		<?php endif;?>
		<?php if( !empty( $subtitle ) ): ?>
			<p class="rtin-subtitle" style="<?php echo esc_attr( $subtitle_style ); ?>"><?php echo wp_kses_post( $subtitle );?></p>
		<?php endif;?>
	</div>
</div>