<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.0
 */

$custom_class = vc_shortcode_custom_css_class( $css );

if ( $link ) {
	$title_html = '<a href="'.$link.'">'.$title.'</a>';
}
else {
	$title_html = $title;
}
?>
<div class="rt-vc-imagetext-2 <?php echo esc_attr( $custom_class );?>">
	<?php if ( $link ): ?>
		<div class="rtin-img hvr-bounce-to-right">
			<?php echo wp_get_attachment_image( $image, 'full' );;?>
			<a href="<?php echo esc_attr( $link );?>" title="<?php echo esc_attr( $title );?>"><i class="fa fa-link" aria-hidden="true"></i></a>
		</div>			
	<?php else: ?>
		<div class="rtin-img">
			<?php echo wp_get_attachment_image( $image, 'full' );;?>
		</div>
	<?php endif; ?>
	<h3 class="rtin-title"><?php echo $title_html;?></h3>
</div>