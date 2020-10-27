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

$featured_class = ( $featured == 'true' ) ? ' rtin-featured' : '';

$price_html  = !empty( $currency ) ? "<span class='price-currency'>$currency</span>": '';
$price_html .= $price;
$price_html .= !empty( $unit ) ? "<span class='price-unit'>/ $unit</span>": '';
?>
<div class="<?php echo esc_attr( $custom_class );?>">
	<div class="rt-price-table-box3<?php echo esc_attr( $featured_class );?>" style="<?php echo esc_attr( $style );?>">
		<div class="rtin-title"><?php echo esc_html( $title );?></div>
		<div class="rtin-price"><?php echo wp_kses_post( $price_html );?></div>
		<div class="rtin-features">		
			<?php foreach ( $features as $feature ): ?>
				<div class="rtin-feature-each"><?php echo esc_html( $feature );?></div>
			<?php endforeach; ?>
		</div>
		<?php if ( $btntext ): ?>
			<a href="<?php echo esc_url( $btnurl );?>" class="rtin-btn"><?php echo esc_html( $btntext );?></a>
		<?php endif; ?>
	</div>
</div>