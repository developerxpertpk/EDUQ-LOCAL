<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.6
 */

$thumb_size = 'rdtheme-size2';

$args = array(
	'post_type'      => 'ac_research',
	'posts_per_page' => $number,
	'orderby' => $orderby,
	'order'   => $order,
);

if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'ac_research_category',
			'field' => 'term_id',
			'terms' => $cat,
		)
	);
}

if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}

$args['paged'] = $paged;

$query = new WP_Query( $args );
$col_class = "col-lg-$col_lg col-md-$col_md col-sm-$col_sm col-xs-$col_xs";

// Pagination fix
global $wp_query;
$wp_query = NULL;
$wp_query = $query;
?>
<div class="rt-vc-research-2">
	<?php if ( have_posts() ): ?>
		<div class="row auto-clear">
			<?php while ( have_posts() ) : the_post();?>
				<?php
				if ( has_post_thumbnail() ){
					$thumbnail = get_the_post_thumbnail( null, $thumb_size );
				}
				elseif ( !empty( RDTheme::$options['no_preview_image']['id'] ) ) {
					$thumbnail = wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
				}
				else {
					$thumbnail = '<img width="410" height="260" src="'.RDTHEME_IMG_URL.'noimage-410x260.jpg" alt="'.get_the_title().'">';
				}
				$content = RDTheme_Helper::get_current_post_content();
				$content = wp_trim_words( $content, $count );
				?>
				<div class="<?php echo esc_attr( $col_class );?>">
					<div class="rtin-item">
						<a href="<?php the_permalink();?>"><?php echo $thumbnail;?></a>
						<h3 class="rtin-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
						<p><?php echo wp_kses_post( $content ); ?></p>
					</div>
				</div>
			<?php endwhile;?>
			<div class="col-sm-12 col-xs-12"><?php RDTheme_Helper::pagination();?></div>
		</div>
	<?php else: ?>
		<?php esc_html_e( 'No Research Found' , 'eikra-core' ); ?>
	<?php endif; ?>
	<?php wp_reset_query();?>
</div>