<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.6
 */

$thumb_size = 'rdtheme-size8';
$args = array(
	'post_type'      => 'ac_testimonial',
	'posts_per_page' => $slider_item_number,
	'orderby' => $orderby,
	'order'   => $order,
);

if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'ac_testimonial_category',
			'field' => 'term_id',
			'terms' => $cat,
		)
	);
}

$query = new WP_Query( $args );

global $wp_query;
$wp_query = NULL;
$wp_query = $query;

$sec_style         = $sec_color ? "color:{$sec_color};" : '';
$name_style        = $name_color ? "color:{$name_color};" : '';
$designation_style = $designation_color ? "color:{$designation_color};" : '';
$content_style     = $content_color ? "color:{$content_color};" : '';
?>
<div class="rt-vc-testimonial-2">
	<h3 class="rtin-section-title" style="<?php echo esc_attr( $sec_style ); ?>"><?php echo esc_html( $title ); ?></h3>
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
		<?php if ( have_posts() ): ?>
			<?php while ( have_posts() ) : the_post();?>
				<?php
				$id = get_the_ID();
				$designation = get_post_meta( $id, 'ac_testimonial_designation', true );
				$content = get_the_content();
				?>
				<div class="rtin-item">
					<p class="rtin-item-content" style="<?php echo esc_attr( $content_style ); ?>"><?php echo esc_html( $content ); ?></p>
					<div class="rtin-item-title" style="<?php echo esc_attr( $name_style );?>"><?php the_title(); ?></div>
					<?php if( !empty( $designation ) ): ?>
						<div class="rtin-item-designation" style="<?php echo esc_attr( $designation_style );?>"><?php echo esc_html( $designation ); ?></div>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
		<?php else:?>
			<?php esc_html_e( 'No Testimonial Found' , 'eikra-core' ); ?>
		<?php endif; ?>
		<?php wp_reset_query();?>
	</div>
</div>