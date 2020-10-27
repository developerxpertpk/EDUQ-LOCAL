<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.0
 */

$thumb_size = array( 130, 130 );

if ( $orderby_alt == 'name' ) {
	$args = array(
		'post_type'        => 'lp_instructor',
		'posts_per_page'   => 2,
		'suppress_filters' => false,
		'orderby'          => 'title',
		'order'            => 'ASC',
	);
	$posts = get_posts( $args );
}

$class = ( $student_dis == 'false' ) ? 'rtin-nostudent' : '';
?>
<div class="rt-vc-instructor-3 <?php echo esc_attr( $class );?>">
	<div class="row">
		<?php for ( $i = 1; $i < 3; $i++ ):?>
			<?php
			if ( $orderby_alt == 'name' ) {
				$index = $i - 1;
				if ( empty( $posts[$index] ) ) continue;
				$id = $posts[$index]->ID;
				$description = $posts[$index];
			}
			else {
				$id = ${'item'.$i};
				if ( !$id ) continue;
				$description = get_post( $id );
			}

			$description = RDTheme_Helper::get_current_post_content( $description );
			$description = wp_trim_words( $description, $count );
			$designation = get_post_meta( $id, 'ac_instructor_designation', true );
			?>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="rtin-item clearfix">
					<div class="media-left pull-left">
						<a href="<?php echo esc_url( get_the_permalink( $id ) );?>"><?php echo get_the_post_thumbnail( $id, $thumb_size );?></a>
					</div>
					<div class="media-body">
						<div class="rtin-name"><a href="<?php echo esc_url( get_the_permalink( $id ) );?>"><?php echo get_the_title( $id );?></a></div>
						<?php if ( $designation_dis == 'true' ): ?>
							<div class="rtin-designation"><?php echo wp_kses_post( $designation ); ?></div>
						<?php endif; ?>
						<div class="rtin-description"><?php echo wp_kses_post( $description ); ?></div>
					</div>
				</div>
			</div>
		<?php endfor;?>
	</div>
	<?php if ( $button_dis == 'true' && $buttontext ): ?>
		<div class="rtin-btn"><a href="<?php echo esc_html( $buttonurl );?>"><?php echo esc_html( $buttontext );?></a></div>
	<?php endif; ?>
</div>