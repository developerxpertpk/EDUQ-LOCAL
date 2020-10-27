<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$ac_designation = get_post_meta( $post->ID, 'ac_instructor_designation', true );
$ac_socials = get_post_meta( $id, 'ac_instructor_socials', true );
$ac_socials = array_filter( $ac_socials );
$ac_socials_fields = RDTheme_Helper::instructor_socials();
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'instructor-single' ); ?>>
	<div class="row">
		<div class="col-md-4 col-sm-5 col-xs-12">
			<div class="rtin-image">
				<?php the_post_thumbnail( 'rdtheme-size9' );?>
			</div>
		</div>
		<div class="col-md-8 col-sm-7 col-xs-12">
			<div class="rtin-content">
				<div class="rtin-heading">
					<h2><?php the_title();?></h2>
					<?php if ( $ac_designation ): ?>
						<div class="rtin-designation"><?php echo esc_html( $ac_designation );?></div>
					<?php endif; ?>
					<?php if ( !empty( $ac_socials ) ): ?>
						<ul class="rtin-social">
							<?php foreach ( $ac_socials as $key => $value ): ?>
								<li><a target="_blank" href="<?php echo esc_url( $value ); ?>"><i class="fa <?php echo esc_attr( $ac_socials_fields[$key]['icon'] );?>"></i></a></li>
							<?php endforeach; ?>
						</ul>						
					<?php endif; ?>
				</div>
				<?php the_content();?>
			</div>
		</div>
	</div>
</div>