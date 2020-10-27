<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$class = vc_shortcode_custom_css_class( $css );
$rdtheme_socials = RDTheme_Helper::socials();
?>
<div class="rt-vc-contact-2 <?php echo esc_attr( $class );?>">  
	<ul class="rtin-item">
		<?php if( !empty( $address ) ): ?>
			<li><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo wp_kses_post( $address ); ?></li>
		<?php endif; ?>
		<?php if( !empty( $email ) ): ?>
			<li><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo esc_html( $email ); ?></li>
		<?php endif; ?> 
		<?php if( !empty( $phone ) ): ?>		
			<li><i class="fa fa-phone" aria-hidden="true"></i><?php echo esc_html( $phone ); ?></li>
		<?php endif; ?>
		<?php if( $socials=='true' && !empty( $rdtheme_socials ) ): ?>
			<li class="rtin-social-wrap">
				<ul class="rtin-social">
					<?php foreach ( $rdtheme_socials as $rdtheme_social ): ?>
						<li><a target="_blank" href="<?php echo esc_url( $rdtheme_social['url'] );?>"><i class="fa <?php echo esc_attr( $rdtheme_social['icon'] );?>"></i></a></li>
					<?php endforeach; ?>
				</ul>
			</li>		
		<?php endif; ?>
	</ul>
</div>