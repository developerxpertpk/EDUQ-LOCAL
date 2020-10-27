<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$args = array(
	'post_type'      => 'lp_course',
	'posts_per_page' => 8,
);
$query_recent = new WP_Query( $args );

$args = array(
	'post_type'      => 'lp_course',
	'posts_per_page' => 8,
	'meta_key'       => '_lp_featured',
	'meta_value'     => 'yes',
	'orderby'        => 'title',
	'order'          => 'ASC',
);
$query_featured = new WP_Query( $args );

$args = array(
	'post_type'      => 'lp_course',
	'posts_per_page' => 8,
	'meta_key'       => '_lp_students',
	'orderby'        => 'meta_value_num',
	'order'          => 'DESC',
);
$query_popular = new WP_Query( $args );

$navs = array(
	'recent'   => __( "New Courses", 'eikra-core' ),
	'featured' => __( "Featured Courses", 'eikra-core' ),
	'popular'  => __( "Popular Courses", 'eikra-core' ),
);

$uniqueid = time().rand( 1, 99 );
$count = 0;
?>
<div class="rt-vc-course-isotope style-2 rt-vc-isotope-container">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="rt-vc-isotope-tab isotop-btn">
				<?php foreach ( $navs as $key => $value ): ?>
					<?php
					$count++;
					$navclass = '';
					if ( $count == 1) {
						$navclass = 'current';
					}
					?>
					<a class= "<?php echo esc_attr( $navclass );?>" href="#" data-filter=".<?php echo esc_attr( $uniqueid.$key );?>"><?php echo esc_html( $value );?></a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
	<div class="row rt-vc-isotope-wrapper">
		<?php
		$this->render_query( $query_recent, $uniqueid.'recent', $box_style );
		$this->render_query( $query_featured, $uniqueid.'featured', $box_style );
		$this->render_query( $query_popular, $uniqueid.'popular', $box_style );
		?>
	</div>
	<?php if ( $button_display == 'true' ): ?>
		<div class="rtin-btn"><a href="<?php echo esc_url( get_permalink ( learn_press_get_page_id( 'courses' ) ) );?>"><?php esc_html_e( "SEE ALL COURSES", 'eikra-core' );?></a></div>
	<?php endif; ?>
</div>