<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.3
 */

// Build query
$course_id = get_the_ID();

$cat_ids = array();
$cats    = get_the_terms( $course_id, 'course_category' );
if ( $cats ) {
	foreach ( $cats as $cat ) {
		$cat_ids[] = $cat->slug;
	}
}

$tag_ids = array();
$tags    = get_the_terms( $course_id, 'course_tag' );
if ( $tags ) {
	foreach ( $tags as $tag ) {
		$tag_ids[] = $tag->slug;
	}
}

if ( !$cat_ids && !$tag_ids ) {
	return;
}

$args = array(
	'post_type'           => 'lp_course',
	'posts_per_page'      => 5,
	'paged'               => 1,
	'ignore_sticky_posts' => true,
	'post__not_in'        => array( $course_id ),
	'tax_query'           => array( 'relation' => 'OR' ),
);

if ( $cat_ids ) {
	$cat_query = array(
		'taxonomy' => 'course_category',
		'field'    => 'slug',
		'terms'    => $cat_ids
	);
	array_push( $args['tax_query'], $cat_query );
}

if ( $tag_ids ) {
	$tag_query = array(
		'taxonomy' => 'course_tag',
		'field'    => 'slug',
		'terms'    => $tag_ids
	);
	array_push( $args['tax_query'], $tag_query );
}

$rdtheme_query = new WP_Query( $args );

// Courasel data
if ( RDTheme::$options['course_sidebar'] ){
	$responsive = array(
		'0'    => array( 'items' => 1 ),
		'480'  => array( 'items' => 2 ),
		'768'  => array( 'items' => 2 ),
		'992'  => array( 'items' => 3 ),
	);
}
else {
	$responsive = array(
		'0'    => array( 'items' => 1 ),
		'480'  => array( 'items' => 2 ),
		'768'  => array( 'items' => 3 ),
		'992'  => array( 'items' => 3 ),
		'1200' => array( 'items' => 4 ),
	);	
}

$loop = $rdtheme_query->post_count > 3 ? true : false;
$wrapper_class = '';
if ( !$loop ) {
	$wrapper_class .= ' no-nav';
}

$owl_data = array( 
	'nav'                => false,
	'dots'               => false,
	'autoplay'           => true,
	'autoplayTimeout'    => '5000',
	'autoplaySpeed'      => '200',
	'autoplayHoverPause' => true,
	'loop'               => $loop,
	'margin'             => 20,
	'responsive'         => $responsive
);

$owl_data = json_encode( $owl_data );
wp_enqueue_style( 'owl-carousel' );
wp_enqueue_style( 'owl-theme-default' );
wp_enqueue_script( 'owl-carousel' );
?>
<?php if ( $rdtheme_query->have_posts() ) :?>
	<div class="owl-wrap rt-related-courses<?php echo esc_attr( $wrapper_class );?>">
		<div class="section-title">
			<h2 class="owl-custom-nav-title"><?php esc_html_e( 'Related Courses', 'eikra' );?></h2>
			<div class="owl-custom-nav owl-nav">
				<div class="owl-prev"><i class="fa fa-angle-left"></i></div><div class="owl-next"><i class="fa fa-angle-right"></i></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
			<?php while ( $rdtheme_query->have_posts() ) : $rdtheme_query->the_post();?>
				<?php
				if ( RDTheme_Helper::is_LMS() ) {
					$rdtheme_course_style = RDTheme::$options['course_style'];
					if ( RDTheme::$options['course_style'] != 1 ) {
						learn_press_get_template( "custom/course-box-{$rdtheme_course_style}.php" );
					}
					else {
						learn_press_get_template( 'custom/course-box.php' );
					}
				}
				else {
					get_template_part( 'template-parts/content', 'course-box' );
				}
				?>
			<?php endwhile;?>
		</div>
	</div>
<?php endif;?>
<?php wp_reset_query();?>