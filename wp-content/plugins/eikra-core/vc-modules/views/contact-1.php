<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$class = vc_shortcode_custom_css_class( $css );
$rdtheme_socials = RDTheme_Helper::socials();
?>
<div class="rt-vc-contact-1 <?php echo esc_attr( $class );?>">
	<ul class="rtin-item">
		<?php if( !empty( $address ) ): ?>
			<li>
				<i class="fa fa-map-marker" aria-hidden="true"></i>
				<h3><?php esc_html_e( 'Address', 'eikra-core' ); ?></h3>
				<p><?php echo wp_kses_post( $address ); ?></p> 
			</li>		
		<?php endif; ?>
		<?php if( !empty( $email ) ): ?>
			<li>
				<i class="fa fa-envelope-o" aria-hidden="true"></i>
				<h3><?php esc_html_e( 'E-mail', 'eikra-core' ); ?></h3>
				<p><?php echo esc_html( $email ); ?></p>
			</li>		
		<?php endif; ?>
		<?php if( !empty( $phone ) ): ?>		
			<li>
				<i class="fa fa-phone" aria-hidden="true"></i>
				<h3><?php esc_html_e( 'Phone', 'eikra-core' ); ?></h3>
				<p><?php echo esc_html( $phone ); ?></p>   
			</li>
		<?php endif; ?>
		<?php if( $socials=='true' && !empty( $rdtheme_socials ) ): ?>
			<li>
				<h3><?php esc_html_e( 'Find Us On', 'eikra-core' ); ?></h3>
				<ul class="contact-social">
					<?php foreach ( $rdtheme_socials as $rdtheme_social ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $rdtheme_social['url'] );?>"><i class="fa <?php echo esc_attr( $rdtheme_social['icon'] );?>"></i></a></li>
					<?php endforeach; ?>
				</ul>
			</li>		
		<?php endif; ?> 
	</ul>
</div> 