<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.7
 */
?>
<div class="rt-vc-event">
	<h2 class="rt-vc-title-left"><?php echo esc_html( $title ); ?></h2>
	<?php if ( $events ): ?>
		<?php foreach ( $events as $event ): ?>
			<?php
			$id = $event['id'];
			$content = $event['content'];
			$content = RDTheme_Helper::filter_content( $content );
			$content = wp_trim_words( $content, $count );

			$date = date_i18n( "d-M-Y", strtotime( $event['start_date'] ) );
			$date = explode( "-", $date );
			$date_dormat  = get_option( 'date_format' );

			if ( $event['start_date'] != $event['end_date'] ) {
				$end_date   = date_i18n( $date_dormat, strtotime( $event['end_date'] ) );
				$event_time = "{$event['start_time']} - {$event['end_time']} ({$end_date})";
			}
			else {
				$event_time = "{$event['start_time']} - {$event['end_time']}";
			}
			?>
			<div class="media rtin-item" style="background-color:<?php echo esc_attr( $bg_color ); ?>">
				<div class="media-left rtin-calender-holder">
					<div class="rtin-calender">
						<h3><?php echo esc_html( $date[0] ); ?></h3>
						<p><?php echo esc_html( $date[1] ); ?></p>
						<span><?php echo esc_html( $date[2] ); ?></span>
					</div>
				</div>
				<div class="media-body rtin-right">
					<h3><a href="<?php echo esc_url( get_the_permalink( $id ) ); ?>"><?php echo esc_html( $event['title']) ; ?></a></h3>
					<p class="rtin-content"><?php echo wp_kses_post( $content ); ?></p>
					<ul>
						<li class="rtin-time"><?php echo esc_html( $event_time ); ?></li>
						<?php if( !empty( $event['location'] ) ): ?>
							<li class="rtin-location"><?php echo esc_html( $event['location'] ); ?></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		<?php endforeach;?>
		<?php if( $button_display == 'true' ): ?>
			<div class="rtin-btn">
				<a href="<?php echo esc_url( $button_url ); ?>" class="rdtheme-button-6"><?php echo esc_html( $button_text ); ?></a>
			</div>
		<?php endif; ?>
	<?php else: ?>
		<div class="media rtin-item" style="background-color:<?php echo esc_attr( $bg_color ); ?>"><?php esc_html_e( 'No Events Available', 'eikra-core' )?></div>
	<?php endif; ?>
</div>