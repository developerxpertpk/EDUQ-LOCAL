<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.2
 */

if( !empty( $image ) ){
	$thumbnail = wp_get_attachment_image( $image, 'full', '', array( 'class' => 'img-responsive' ) );
}
else {
	$thumbnail = '<img class="media-object wp-post-image" src="'.RDTHEME_IMG_URL.'noimage_819X330.jpg" alt="">';
}

$target = $newtab ? ' target="_blank"' : '';

$custom_class = vc_shortcode_custom_css_class( $css );
$class = "$custom_class $style";
?>
<div class="rt-vc-cta <?php echo esc_attr( $class );?>">
	<div class="rtin-left">	
		<?php echo wp_kses_post( $thumbnail ); ?>		
	</div>
	<div class="rtin-right">
		<h2><?php echo rawurldecode( base64_decode( strip_tags( $title ) ) );?></h2>
		<?php if ( $buttontext ): ?>
			<a class="rtin-btn" href="<?php echo esc_html( $buttonurl );?>"<?php echo $target;?> ><?php echo esc_html( $buttontext );?></a>
		<?php endif; ?>
	</div>
</div>