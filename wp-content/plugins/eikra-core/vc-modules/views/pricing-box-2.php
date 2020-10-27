<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$custom_class = vc_shortcode_custom_css_class( $css );

$style = "";
if ( !empty( $maxwidth ) ) {
	$style .= "max-width:{$maxwidth}px;";
}
if ( !empty( $bgcolor ) ) {
	$style .= "background-color:{$bgcolor};";
}

$price_html  = $price;
$price_html .= !empty( $unit ) ? "<span>/$unit</span>": '';
?>
<div class="<?php echo esc_attr( $custom_class );?> hvr-float-shadow">
	<div class="rt-pricing-box2" style="<?php echo esc_attr( $style );?>">
		<div class="rtin-title"><?php echo esc_html( $title );?></div>
		<div class="rtin-price"><?php echo wp_kses_post( $price_html );?></span></div>
		<ul>
			<?php foreach ( $features as $feature ): ?>
				<li><?php echo esc_html( $feature );?></li>
			<?php endforeach; ?>
		</ul>
		<?php if ( $btntext ): ?>
			<a class="rtin-btn rdtheme-button-6" href="<?php echo esc_url( $btnurl );?>"><?php echo esc_html( $btntext );?></a>
		<?php endif; ?>
	</div>
</div>