<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.6
 */

add_action( 'tgmpa_register', 'rdtheme_register_required_plugins' );
function rdtheme_register_required_plugins() {
	$plugins = array(
		// Bundled
		array(
			'name'         => 'Eikra Core',
			'slug'         => 'eikra-core',
			'source'       => 'eikra-core.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '2.3'
		),
		array(
			'name'         => 'RT Framework',
			'slug'         => 'rt-framework',
			'source'       => 'rt-framework.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '1.15'
		),
		array(
			'name'         => 'RT Demo Importer',
			'slug'         => 'rt-demo-importer',
			'source'       => 'rt-demo-importer.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '4.0'
		),
		array(
			'name'         => 'WPBakery Page Builder',
			'slug'         => 'js_composer',
			'source'       => 'js_composer.zip',
			'required'     => true,
			'external_url' => 'http://vc.wpbakery.com',
			'version'      => '6.0.2'
		),
		array(
			'name'         => 'LayerSlider WP',
			'slug'         => 'LayerSlider',
			'source'       => 'LayerSlider.zip',
			'required'     => false,
			'external_url' => 'https://layerslider.kreaturamedia.com',
			'version'      => '6.8.4'
		),
		
		// Repository
		array(
			'name'     => 'Redux Framework',
			'slug'     => 'redux-framework',
			'required' => true,
		),
		array(
			'name'     => 'Breadcrumb NavXT',
			'slug'     => 'breadcrumb-navxt',
			'required' => true,
		),
		array(
			'name'     => 'LearnPress - WordPress LMS Plugin',
			'slug'     => 'learnpress',
			'required' => true,
		),
		array(
			'name'     => 'LearnPress - Course Review',
			'slug'     => 'learnpress-course-review',
			'required' => false,
		),		
		array(
			'name'     => 'LearnPress Courses Wishlist',
			'slug'     => 'learnpress-wishlist',
			'required' => false,
		),
		array(
			'name'     => 'Theme My Login',
			'slug'     => 'theme-my-login',
			'required' => false,
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false,
		),
		array(
			'name'     => 'WP Retina 2x',
			'slug'     => 'wp-retina-2x',
			'required' => false,
		),
		array(
			'name'     => 'Meks Simple Flickr Widget',
			'slug'     => 'meks-simple-flickr-widget',
			'required' => false,
		),
		array(
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce',
			'required' => false,
		),
		array(
			'name'     => 'YITH WooCommerce Quick View',
			'slug'     => 'yith-woocommerce-quick-view',
			'required' => false,
		),
		array(
			'name'     => 'YITH WooCommerce Wishlist',
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false,
		),
	);

	$config = array(
		'id'           => 'eikra',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => RDTHEME_PLUGINS_DIR,     // Default absolute path to bundled plugins.
		'menu'         => 'eikra-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}