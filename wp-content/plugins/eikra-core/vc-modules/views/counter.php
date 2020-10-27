<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$class		    = vc_shortcode_custom_css_class( $css );

$counter_style  = $counter_color ? "color:{$counter_color};" : '';
$counter_style .= $counter_size ? "font-size:{$counter_size}px;" : '';
$counter_style .= $bottom_color ? "border-bottom-color:{$bottom_color};" : '';
$title_style    = $title_size ? "font-size:{$title_size}px;" : '';
$title_style   .= $title_color ? "color:{$title_color};" : '';
?>
<div class="rt-vc-counter <?php echo esc_attr( $class );?>" <?php if( !empty( $maxwidth ) ) { ?>style="max-width:<?php echo esc_attr( $maxwidth ); ?>px;" <?php } ?>>
	<div class="rtin-left">
		<div class="rtin-counter" style="<?php echo esc_attr( $counter_style ); ?>"><span class="rtin-counter-num" data-num="<?php echo esc_html( $counter_number ); ?>" data-rtSpeed="<?php echo esc_html( $speed ); ?>" data-rtSteps="<?php echo esc_html( $steps ); ?>"><?php echo esc_html( $counter_number ); ?></span><?php echo esc_html( $counter_text );?></div>
	</div>
	<div class="rtin-right">
		<div class="rtin-title" style="<?php echo esc_attr( $title_style ); ?>"><?php echo esc_html( $title ); ?></div>
	</div>
	<div class="clear"></div>
</div>