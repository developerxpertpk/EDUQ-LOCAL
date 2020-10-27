<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$class = vc_shortcode_custom_css_class( $css );

if ( $alignment == 'center' ) {
    $class .= ' rtin-align-center';
}
?>
<div class="rt-vc-infobox-6 <?php echo esc_attr( $class );?>" <?php if( !empty( $width ) ) { ?>style="max-width:<?php echo esc_attr( $width ); ?>px;" <?php } ?>>
    <div class="rtin-item">
        <div class="rtin-left">
            <div class="rtin-icon">
                <?php if ( $icontype == 'image' ): ?>
                    <?php echo wp_get_attachment_image( $image, 'thumbnail', true );?>
                <?php else: ?>
                    <i class="<?php echo esc_attr( $icon );?>" aria-hidden="true"></i>
                <?php endif; ?>
            </div>
        </div>
        <div class="rtin-right">
            <div class="rtin-title"><?php echo esc_html( $title );?></div>
            <div class="rtin-subtitle"><?php echo esc_html( $subtitle ); ?></div>
        </div>
        <div class="clear"></div>       
    </div>
</div>