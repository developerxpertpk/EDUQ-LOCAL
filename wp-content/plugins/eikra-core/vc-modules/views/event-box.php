<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.0
 */
?>
<div class="rt-vc-event-box">
	<?php if ( $events ): ?>
		<div class="row auto-clear">
			<?php foreach ( $events as $event ): ?>
				<?php
				$id        = (int) $event['id'];
				$permalink = get_the_permalink( $id );
				$title     = $event['title'];
				$time      = date_i18n( get_option( 'date_format' ), strtotime( $event['start_date'] ) );
				$location  = $event['location'];
				?>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="rtin-item media clearfix">
						<div class="rtin-left media-left media-middle pull-left">
							<?php if ( has_post_thumbnail( $id ) ): ?>
								<div class="rtin-thumb"><?php echo get_the_post_thumbnail( $id, 'thumbnail' ); ?></div>
							<?php endif; ?>
						</div>
						<div class="rtin-right media-body media-middle">
							<h3 class="rtin-title"><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ) ; ?></a></h3>
							<div class="rtin-meta">
								<?php if ( $location ): ?>
									<div class="rtin-location"><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo esc_html( $location ); ?></div>
								<?php endif; ?>
								<div class="rtin-time"><i class="fa fa-calendar" aria-hidden="true"></i><?php echo esc_html( $time ); ?></div>	
							</div>
							<div class="rtin-btn"><a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html_e( 'Details', 'eikra-core' ); ?><i class="fa fa-angle-right" aria-hidden="true"></i></a></div>	
						</div>
					</div>
				</div>
			<?php endforeach;?>
		</div>
	<?php else: ?>
		<div class="rtin-item"><?php esc_html_e( 'No Events Available', 'eikra-core' )?></div>
	<?php endif; ?>
	<?php wp_reset_query();?>
</div>