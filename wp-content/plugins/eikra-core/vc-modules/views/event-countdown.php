<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.6
 */

if( $id == '' ){
	esc_html_e( 'Please Select an Event', 'eikra-core' );
	return;
}

$custom_class = vc_shortcode_custom_css_class( $css );

$title = ( $title_type == 'event' ) ? get_the_title( $id ) : $title;
$btn_class = ( $style == 'light' ) ? 'rdtheme-button-6' : 'rdtheme-button-5';

$start_date      = get_post_meta( $id, 'ac_event_start_date', true );
$start_time      = get_post_meta( $id, 'ac_event_start_time', true );	
$date            = date( "d M, Y", strtotime( $start_date ) );					
$countdown_time  = trim( $start_date. ' ' . $start_time );
$countdown_time  = strtotime( $countdown_time );
$countdown_time  = date('Y/m/d H:i:s', $countdown_time);
?>
<div class="rt-event-countdown rt-<?php echo esc_attr( $style ); ?> <?php echo esc_attr( $custom_class );?>">
	<div class="row">
		<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
			<div class="rt-content">
				<h2><?php echo esc_html( $title ); ?></h2>
				<h3><?php echo esc_html( $date ); ?></h3>
				<a href="<?php echo esc_url( get_permalink( $id ) ); ?>" class="<?php echo esc_attr( $btn_class ); ?>"><?php echo esc_html( $btntxt ); ?></a>
			</div>
		</div>  
		<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
			<div class="rt-date" data-time="<?php echo esc_attr( $countdown_time ); ?>"></div>
		</div>
	</div>
</div>