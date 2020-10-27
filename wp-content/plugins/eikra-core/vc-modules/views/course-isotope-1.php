<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$args = array(
	'post_type'      => 'lp_course',
	'posts_per_page' => -1,
);

$query = new WP_Query( $args );

$cats  = array();
$terms = get_terms( array('taxonomy' => 'course_category') );
foreach ( $terms as $term ) {
	$cats[$term->slug] = $term->name;
}
?>
<div class="rt-vc-course-isotope rt-vc-isotope-container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="rt-vc-isotope-tab isotop-btn"> 
				<a href="#" data-filter="*" class="current"><?php echo esc_html( $all );?></a>
				<?php foreach ( $cats as $key => $value): ?>
					<a href="#" data-filter=".<?php echo esc_attr( $key );?>"><?php echo esc_html( $value );?></a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="row rt-vc-isotope-wrapper">
		<?php if ( $query->have_posts() ) :?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$terms = get_the_terms( get_the_ID(), 'course_category' );
				$terms_html = '';
				if ( $terms ) {
					foreach ( $terms as $term ) {
						$terms_html .= ' ' . $term->slug;
					}
				}
				?>
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12<?php echo esc_attr( $terms_html );?>">
					<?php
					if ( RDTheme_Helper::is_LMS() ) {
						if ( $box_style != 1 ) {
							learn_press_get_template( "custom/course-box-{$box_style}.php" );
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
		<?php endif;?>
		<?php wp_reset_query();?>
	</div>
</div>