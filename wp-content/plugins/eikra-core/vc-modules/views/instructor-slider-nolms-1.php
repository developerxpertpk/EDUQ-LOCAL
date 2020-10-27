<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.0
 */

$thumb_size = 'rdtheme-size9';

$args = array(
	'post_type'      => 'lp_instructor',
	'posts_per_page' => $number,
	'orderby'        => $orderby,
);

if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'instructor_category',
			'field' => 'term_id',
			'terms' => $cat,
		)
	);
}

switch ( $orderby ) {
	case 'title':
	case 'menu_order':
	$args['order'] = 'ASC';
	break;
}

$query = new WP_Query( $args );

global $wp_query;
$wp_query = NULL;
$wp_query = $query;
?>
<div class="rt-vc-instructor-1 owl-wrap rt-owl-nav-1">
	<div class="section-title clearfix">
		<h2 class="owl-custom-nav-title"><?php echo esc_html( $title );?></h2>
		<div class="owl-custom-nav">
			<div class="owl-prev"><i class="fa fa-angle-left"></i></div><div class="owl-next"><i class="fa fa-angle-right"></i></div>
		</div>
	</div>
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
		<?php if ( have_posts() ) :?>
			<?php while ( have_posts() ) : the_post();?>
				<?php
				$id = get_the_id();
				$designation = get_post_meta( $id, 'ac_instructor_designation', true );
				$socials = get_post_meta( $id, 'ac_instructor_socials', true );
				$socials = array_filter( $socials );
				$socials_fields = RDTheme_Helper::instructor_socials();
				?>
				<div class="rtin-item">
					<div class="rtin-img">
						<a href="<?php the_permalink();?>"><?php the_post_thumbnail( $thumb_size );?></a>
					</div>
					<div class="rtin-content">
						<h3 class="rtin-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
						<?php if ( $designation ) : ?>
							<div class="rtin-designation"><?php echo wp_kses_post( $designation ); ?></div>
						<?php endif; ?>	
						<?php if ( !empty( $socials ) ) : ?>
							<ul class="rtin-social">
								<?php foreach ( $socials as $key => $value ): ?>
									<li><a href="<?php echo esc_url(  $value ); ?>" target="_blank"><i class="fa <?php echo esc_attr( $socials_fields[$key]['icon'] ); ?>"></i></a></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile;?>
		<?php else: ?>
			<?php esc_html_e( 'No Instructors Found' , 'eikra-core' ); ?>
		<?php endif;?>
		<?php wp_reset_query();?>
	</div>
</div>