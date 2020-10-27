<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.0
 */

$custom_class = vc_shortcode_custom_css_class( $css );
$class = "$custom_class $style";
$css   = '';
if ( $width ) {
	$css .= "max-width: {$width}px";	
}
?>
<div class="rt-vc-text-title <?php echo esc_attr( $class );?>" style="<?php echo esc_attr( $css );?>">
	<?php if( !empty( $title ) ): ?>
		<h2 class="rtin-title"><?php echo esc_html( $title );?></h2>
	<?php endif;?>
	<?php if( !empty( $content ) ): ?>
		<p class="rtin-content"><?php echo wp_kses_post( $content );?></p>
	<?php endif;?>
	<?php if( !empty( $button_text ) ): ?>
		<div class="rtin-btn"><a href="<?php echo esc_html( $button_url );?>"><?php echo esc_html( $button_text );?></a></div>
	<?php endif;?>
</div>