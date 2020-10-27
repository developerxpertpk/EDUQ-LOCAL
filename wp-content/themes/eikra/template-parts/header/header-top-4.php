<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>
<div id="tophead">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="tophead-contact">
					<ul>
						<?php if ( RDTheme::$options['phone'] ): ?>
							<li>
								<i class="fa fa-phone" aria-hidden="true"></i><a href="tel:<?php echo esc_attr( RDTheme::$options['phone'] );?>"><?php echo esc_html( RDTheme::$options['phone'] );?></a>
							</li>
						<?php endif; ?>
						<?php if ( RDTheme::$options['phone'] && RDTheme::$options['email'] ): ?>
							<li class="topbar-icon-seperator">|</li>
						<?php endif; ?>
						<?php if ( RDTheme::$options['email'] ): ?>
							<li>
								<i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?php echo esc_attr( RDTheme::$options['email'] );?>"><?php echo esc_html( RDTheme::$options['email'] );?></a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="tophead-right">
					<?php if ( RDTheme::$options['header_btn_txt'] && RDTheme::$options['header_btn_url'] ): ?>
						<a class="topbar-btn" href="<?php echo RDTheme::$options['header_btn_url'];?>"><?php echo RDTheme::$options['header_btn_txt'];?></a>
					<?php endif; ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>