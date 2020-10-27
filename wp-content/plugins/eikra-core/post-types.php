<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.6
 */

if ( !class_exists( 'RT_Posts' ) ) {
	return;
}

$Posts = RT_Posts::getInstance();

// LearnPress alternative
if ( !RDTheme_Helper::is_LMS() ) {
	$post_types = array(
		'lp_course' => array(
			'title'        => __( 'Course', 'eikra-core' ),
			'plural_title' => __( 'Courses', 'eikra-core' ),
			'menu_icon'    => 'dashicons-welcome-learn-more',
			'rewrite'      => RDTheme::$options['course_slug'],
		),
		'lp_instructor' => array(
			'title'        => __( 'Instructor', 'eikra-core' ),
			'plural_title' => __( 'Instructors', 'eikra-core' ),
			'menu_icon'    => 'dashicons-universal-access',
			'rewrite'      => RDTheme::$options['instructor_slug'],
			'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' )
		),
	);

	$taxonomies = array(
		'course_category' => array(
			'title'         => __( 'Course Category', 'eikra-core' ),
			'plural_title'  => __( 'Course Categories', 'eikra-core' ),
			'post_types'    => 'lp_course',
		),
		'course_tag' => array(
			'title'         => __( 'Course Tag', 'eikra-core' ),
			'plural_title'  => __( 'Course Tags', 'eikra-core' ),
			'hierarchical'  => false,
			'post_types'    => 'lp_course',
		),
		'instructor_category' => array(
			'title'         => __( 'Instructor Category', 'eikra-core' ),
			'plural_title'  => __( 'Instructor Categories', 'eikra-core' ),
			'post_types'    => 'lp_instructor',
		),
	);

	$Posts->add_post_types( apply_filters( 'eikra_nolms_post_types', $post_types ) );
	$Posts->add_taxonomies( apply_filters( 'eikra_nolms_taxonomies', $taxonomies ) );
}

$post_types = array(
	'ac_research'      => array(
		'title'        => __( 'Research', 'eikra-core' ),
		'plural_title' => __( 'Research', 'eikra-core' ),
		'menu_icon'    => 'dashicons-book-alt',
		'rewrite'      => RDTheme::$options['research_slug'],
		'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' )
	),
	'ac_event'         => array(
		'title'        => __( 'Event', 'eikra-core' ),
		'plural_title' => __( 'Events', 'eikra-core' ),
		'menu_icon'    => 'dashicons-megaphone',
		'rewrite'      => RDTheme::$options['event_slug'],
		'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' )
	),
	'ac_testimonial'   => array(
		'title'        => __( 'Testimonial', 'eikra-core' ),
		'plural_title' => __( 'Testimonials', 'eikra-core' ),
		'menu_icon'    => 'dashicons-awards',
		'rewrite'      => false,
		'supports'     => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' )
	),
	'ac_gallery'       => array(
		'title'        => __( 'Gallery', 'eikra-core' ),
		'plural_title' => __( 'Galleries', 'eikra-core' ),
		'menu_icon'    => 'dashicons-format-gallery',
		'rewrite'      => false,
	),
);

$taxonomies = array(
	'ac_research_category' => array(
		'title'           => __( 'Research Category', 'eikra-core' ),
		'plural_title'    => __( 'Research Categories', 'eikra-core' ),
		'post_types'      => 'ac_research',
	),
	'ac_event_category' => array(
		'title'         => __( 'Event Category', 'eikra-core' ),
		'plural_title'  => __( 'Event Categories', 'eikra-core' ),
		'post_types'    => 'ac_event',
	),
	'ac_testimonial_category' => array(
		'title'         => __( 'Testimonial Category', 'eikra-core' ),
		'plural_title'  => __( 'Testimonial Categories', 'eikra-core' ),
		'post_types'    => 'ac_testimonial',
	),		
	'ac_gallery_category' => array(
		'title'           => __( 'Gallery Category', 'eikra-core' ),
		'plural_title'    => __( 'Gallery Categories', 'eikra-core' ),
		'post_types'      => 'ac_gallery',
	),
);

$Posts->add_post_types( apply_filters( 'eikra_post_types', $post_types ) );
$Posts->add_taxonomies( apply_filters( 'eikra_taxonomies', $taxonomies ) );