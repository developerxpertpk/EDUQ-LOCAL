<?php
/**
 * @author  RadiusTheme
 * @since   2.0
 * @version 2.1
 */

$args = array(
	'post_type'      => 'lp_course',
	'posts_per_page' => $number,
	'ignore_sticky_posts' => 1,
);

switch ( $orderby ) {
	case 'date':
	$args['orderby'] = 'date';
	$args['order']   = 'DESC';
	break;
	case 'title':
	$args['orderby'] = 'title';
	$args['order']   = 'ASC';
	break;
	case 'menu_order':
	$args['orderby'] = 'menu_order';
	$args['order']   = 'ASC';
	break;
	case 'popularity':
	$args['meta_key'] = '_lp_students';
	$args['orderby'] = 'meta_value_num';
	$args['order']   = 'DESC';
	break;
	default:
	$args['orderby'] = 'date';
	$args['order']   = 'DESC';
	break;
}

if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'course_category',
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

global $wp_query;
$wp_query = NULL;
$wp_query = $query;
?>
<div class="rt-vc-course-grid style-<?php echo esc_attr( $style );?>">
	<?php if ( have_posts() ) :?>
		<div class="row auto-clear">
			<?php while ( have_posts() ) : the_post();?>
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
					<?php
					if ( RDTheme_Helper::is_LMS() ) {
						if ( $style != 1 ) {
							learn_press_get_template( "custom/course-box-{$style}.php" );
						}
						else {
							learn_press_get_template( 'custom/course-box.php' );
						}
					}
					else {
						get_template_part( 'template-parts/content', 'course-box' );
					}
					?>
				</div>
			<?php endwhile;?>
		</div>
		<?php if ( $pagination === 'true' ): ?>
			<div class="mt40"><?php RDTheme_Helper::pagination();?></div>
		<?php endif; ?>
	<?php endif;?>
	<?php wp_reset_query();?>
</div> 