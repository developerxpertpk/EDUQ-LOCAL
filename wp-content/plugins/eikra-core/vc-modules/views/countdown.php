<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.0
 */

$css = vc_shortcode_custom_css_class( $css );

$start_date      = $date ;
$start_time      = $time;					
$countdown_time  = trim( $start_date. ' ' . $start_time );
$countdown_time  = strtotime( $countdown_time );
$countdown_time  = date('Y/m/d H:i:s', $countdown_time);
?>
<div class="rt-countdown elementwidth elwidth-450 rtin-<?php echo esc_attr( $style ); ?> <?php echo esc_attr( $css );?>">
	<h3 class="rtin-title1"><?php echo esc_html( $title1 ); ?></h3>
	<h3 class="rtin-title2"><?php echo esc_html( $title2 ); ?></h3>
	<div class="rt-date clearfix" data-time="<?php echo esc_attr( $countdown_time ); ?>"></div>
</div>