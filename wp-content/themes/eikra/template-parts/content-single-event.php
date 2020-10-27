<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.5
 */

global $post;
$rdtheme_event_start_date  = get_post_meta( $post->ID, 'ac_event_start_date', true );
$rdtheme_event_start_time  = get_post_meta( $post->ID, 'ac_event_start_time', true );
$rdtheme_event_end_date    = get_post_meta( $post->ID, 'ac_event_end_date', true );
$rdtheme_event_end_time    = get_post_meta( $post->ID, 'ac_event_end_time', true );
$rdtheme_event_participant = get_post_meta( $post->ID, 'ac_event_participant', true );
$rdtheme_event_location    = get_post_meta( $post->ID, 'ac_event_location', true );
$rdtheme_event_map         = get_post_meta( $post->ID, 'ac_event_map', true );
$rdtheme_event_link        = get_post_meta( $post->ID, 'ac_event_link', true );
$rdtheme_event_socials     = get_post_meta( $post->ID, 'ac_event_socials', true );

$rdtheme_countdown_time    = trim( $rdtheme_event_start_date. ' ' . $rdtheme_event_start_time );
$rdtheme_countdown_time    = strtotime( $rdtheme_countdown_time );
$rdtheme_countdown_time    = date( 'Y/m/d H:i:s', $rdtheme_countdown_time );

$rdtheme_date_dormat       = get_option( 'date_format' );
$rdtheme_event_start_date  = date_i18n( $rdtheme_date_dormat, strtotime( $rdtheme_event_start_date ) );
$rdtheme_event_end_date    = date_i18n( $rdtheme_date_dormat, strtotime( $rdtheme_event_end_date ) );

$rdtheme_time_pattern      = RDTheme::$options['event_time_format'] == '12' ? 'g:ia' : 'H:i';
$rdtheme_event_start_time  = $rdtheme_event_start_time ? date_i18n( $rdtheme_time_pattern, strtotime( $rdtheme_event_start_time ) ) : false;
$rdtheme_event_end_time    = $rdtheme_event_end_time ?   date_i18n( $rdtheme_time_pattern, strtotime( $rdtheme_event_end_time ) ) : false;
$rdtheme_event_time_html   = $rdtheme_event_start_time ? $rdtheme_event_start_date. ' - ' . $rdtheme_event_start_time : $rdtheme_event_start_date;
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'event-single' ); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="event-thumbnail-area">
			<?php the_post_thumbnail( 'rdtheme-size1' ); ?>
			<div id="event-countdown" data-time="<?php echo esc_attr( $rdtheme_countdown_time );?>"></div>
		</div>	
	<?php endif; ?>	
	<ul class="event-meta">
		<?php if( $rdtheme_event_start_date ): ?>
			<li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo esc_html( $rdtheme_event_time_html );?></li>
		<?php endif ?>
		<?php if( $rdtheme_event_location ): ?>
			<li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo esc_html( $rdtheme_event_location );?></li>
		<?php endif; ?>
	</ul>
	<div class="event-contents"><?php the_content();?></div>
	<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="event-info">		
				<h3 class="bar2"><?php esc_html_e( 'EVENT INFO', 'eikra' );?> :</h3>
				<ul class="clearfix">
					<?php if ( $rdtheme_event_start_date ): ?>
						<li>
							<span><i class="fa fa-calendar" aria-hidden="true"></i><?php esc_html_e( 'Start Date', 'eikra' );?>:</span><?php echo esc_html( $rdtheme_event_start_date );?>
						</li>
					<?php endif; ?>
					<?php if ( $rdtheme_event_start_time ): ?>
						<li>
							<span><i class="fa fa-clock-o" aria-hidden="true"></i><?php esc_html_e( 'Start Time', 'eikra' );?>:</span><?php echo esc_html( $rdtheme_event_start_time );?>
						</li>
					<?php endif; ?>				
					<?php if ( $rdtheme_event_end_date ): ?>
						<li>
							<span><i class="fa fa-calendar-o" aria-hidden="true"></i><?php esc_html_e( 'End Date', 'eikra' );?>:</span><?php echo esc_html( $rdtheme_event_end_date );?>
						</li>
					<?php endif; ?>

					<?php if ( $rdtheme_event_end_time ): ?>
						<li><span><i class="fa fa-clock-o" aria-hidden="true"></i><?php esc_html_e( 'End Time', 'eikra' );?>:</span><?php echo esc_html( $rdtheme_event_end_time );?> </li>
					<?php endif; ?>
					<?php if ( $rdtheme_event_participant ): ?>
						<li><span><i class="fa fa-ticket" aria-hidden="true"></i><?php esc_html_e( 'Number of Participants', 'eikra' );?>:</span><?php echo esc_html( $rdtheme_event_participant );?></li>
					<?php endif; ?>
					<?php if ( $rdtheme_event_location ): ?>
						<li>
							<span><i class="fa fa-map-marker" aria-hidden="true"></i><?php esc_html_e( 'Location', 'eikra' );?>:</span><?php echo esc_html( $rdtheme_event_location );?>
						</li>
					<?php endif; ?>
					<?php if ( $rdtheme_event_link ): ?>
						<li><span><i class="fa fa-globe" aria-hidden="true"></i><?php esc_html_e( 'Website', 'eikra' );?>:</span><a target="_blank" href="<?php echo esc_url( $rdtheme_event_link );?>"><?php echo esc_html( $rdtheme_event_link );?></a></li>			
					<?php endif; ?>
				</ul>		
			</div>
		</div>
		<div class="col-md-6 col-sm-12 col-xs-12">
			<div class="event-map"><?php echo trim( $rdtheme_event_map);?></div>
		</div>
	</div>
	<?php if ( array_filter( $rdtheme_event_socials ) ): ?>
		<div class="event-social">		
			<h3 class="bar2"><?php esc_html_e( 'FIND THIS EVENT ON', 'eikra' );?> :</h3>			
			<ul>
				<?php foreach ( $rdtheme_event_socials as $rdtheme_key => $rdtheme_social ): ?>
					<?php if ( !empty( $rdtheme_social ) ): ?>
						<li><a target="_blank" href="<?php echo esc_attr( $rdtheme_social );?>"><i class="fa <?php echo esc_attr( RDTheme::$event_socials[$rdtheme_key]['icon'] );?>"></i></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>	
		</div>		
	<?php endif; ?>
</div>