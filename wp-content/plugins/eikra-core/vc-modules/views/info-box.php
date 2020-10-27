<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$heading = $wrapper_css = $icon_css = $title_css = $content_css = $icon_holder_style = '';

$class = vc_shortcode_custom_css_class( $css );
$class .= " {$layout}";
if ( $layout == 'layout4' ) {
    $class .= " hvr-bounce-to-right";
}

$heading   .= !empty( $url ) ? '<a href="' . $url . '">' : '';
$heading   .= $title;
$heading   .= !empty( $url ) ? '</a>' : '';

if ( $size != '' ) {
    $size       = (int) $size;
    $icon_css  .= "font-size: {$size}px;";
}
if ( $icontype == 'image' && $layout == 'layout4' ) {
    $size = 60;
}

if ( $icon_padding != '' ) {
    if ( $layout == 'layout3' ) {
        $icon_css    .= "padding: {$icon_padding};";
    }
}
if ( $spacing_top != '' ) {
    $spacing_top = (int) $spacing_top;
    $icon_holder_style .= "margin-bottom: {$spacing_top}px;";
}
if ( $spacing_bottom != '' ) {
    $spacing_bottom = (int) $spacing_bottom;
    $title_css .= "margin-bottom: {$spacing_bottom}px;";
}
if ( $title_size != '' ) {
    $title_size   = (int) $title_size;
    $title_css   .= "font-size: {$title_size}px;";
}
if ( $content_size != '' ) {
    $content_size = (int) $content_size;
    $content_css .= "font-size: {$content_size}px;";
}
if ( $width != '' ) {
    $width        = (int) $width;
    $wrapper_css .= 'max-width: '. $width . 'px;';
}
?>
<div class="media rt-info-box <?php echo esc_attr( $class );?>" style="<?php echo esc_attr( $wrapper_css );?>">
    <div class="rtin-icon<?php echo ( $icon_style == 'squire' ) ? '' : ' rounded' ;?>" style="<?php echo esc_attr( $icon_holder_style );?>">
        <?php if ( $icontype == 'image' ): ?>
            <?php echo wp_get_attachment_image( $image, array( $size, $size ), true );?>
        <?php else: ?>
            <i class="<?php echo esc_attr( $icon );?>" aria-hidden="true" style="<?php echo esc_attr( $icon_css );?>"></i>
        <?php endif; ?>
    </div>
    <div class="media-body">
        <h3 class="media-heading" style="<?php echo esc_attr( $title_css );?>"><?php echo wp_kses_post( $heading );?></h3>
        <?php if ( $layout != 'layout4'): ?>
            <p class="mb0" style="<?php echo esc_attr( $content_css );?>"><?php echo wp_kses_post( $content );?></p>
        <?php endif; ?>
    </div>
    <div class="clear"></div>
</div>