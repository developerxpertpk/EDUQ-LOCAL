<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.1
 */

$args = array(
	'role'   => LP_TEACHER_ROLE,
	'number' => $number,
);

switch ( $orderby ) {
	case 'id_asc':
	$args['orderby'] = 'ID';
	$args['order']   = 'ASC';
	break;

	case 'id_dsc':
	$args['orderby'] = 'ID';
	$args['order']   = 'DESC';
	break;

	case 'display_name':
	$args['orderby'] = 'display_name';
	$args['order']   = 'ASC';
	break;

	case 'custom_order':
	$args['meta_query'] = array(
		'relation' => 'OR',
		'b' => array(
			'key' => 'rt_user_custom_order',
			'compare' => 'EXISTS',
		),
		'a' => array(
			'key' => 'rt_user_custom_order',
			'compare' => 'NOT EXISTS',
		),

	);
	$this->user_custom_ordering();
	break;
	
	default:
	$args['orderby'] = 'ID';
	$args['order']   = 'DESC';
	break;
}

$query = new WP_User_Query( $args );
?>
<div class="rt-vc-instructor-4 owl-wrap rt-owl-nav-1">
	<div class="section-title clearfix">
		<h2 class="owl-custom-nav-title"><?php echo esc_html( $title );?></h2>
		<div class="owl-custom-nav">
			<div class="owl-prev"><i class="fa fa-angle-left"></i></div><div class="owl-next"><i class="fa fa-angle-right"></i></div>
		</div>
	</div>
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
		<?php if ( ! empty( $query->results ) ): ?>
			<?php foreach ( $query->results as $instructor ): ?>
				<?php
				$id = $instructor->ID;
				$user_meta = get_the_author_meta( 'rt_lp_instructor_info', $id );
				?>
				<div class="rtin-item">
					<div class="rtin-img">
						<a href="<?php echo esc_url( learn_press_user_profile_link( $id ) ); ?>"><?php echo get_avatar( $id , 360 ); ?></a>
					</div>
					<div class="rtin-content">
						<h3 class="rtin-title"><a href="<?php echo esc_url( learn_press_user_profile_link( $id ) ); ?>"><?php echo esc_html( $instructor->display_name ); ?></a></h3>						
						<?php if ( !empty( $user_meta['designation'] ) ) : ?>
							<div class="rtin-designation"><?php echo wp_kses_post( $user_meta['designation'] ); ?></div>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<?php esc_html_e( 'No Instructors Found' , 'eikra-core' ); ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
	</div>
</div>