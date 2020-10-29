<?php

add_action('wp_enqueue_scripts', 'eikra_child_styles', 18);

function eikra_child_styles() {
    wp_enqueue_style('child-style', get_stylesheet_uri());
     wp_register_script('stikcy-resizer',get_stylesheet_directory_uri().'/js/sticky-resizer.js' , array('jquery'));
    wp_register_script('stikcy-sidebar',get_stylesheet_directory_uri().'/js/sticky.js' , array('jquery'));
 wp_enqueue_script('stikcy-resizer');
wp_enqueue_script('stikcy-sidebar');
}

add_action('after_setup_theme', 'eikra_child_theme_setup');

function eikra_child_theme_setup() {
    load_child_theme_textdomain('eikra', get_stylesheet_directory() . '/languages');
}

function ekira_counter($atts) {
    $content_post = get_post($atts['page_id']);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    //echo $content;
    return $content;
}
add_shortcode('ekira_counter', 'ekira_counter');
require( get_stylesheet_directory() . '/woocommerce/custom-functions.php');
require( get_stylesheet_directory() . '/courses/custom-functions.php');
require( get_stylesheet_directory() . '/team/team-functions.php');

function cs_search_form_widget($form) {
   $form = '<form role="search" method="get" id="search-form" class="search-form" action="' . home_url('/') . '">
	<label><span class="screen-reader-text">Zoeken..</span><input type="search" class="search-field" placeholder="Zoeken.." value="' . get_search_query() . '" name="s"></label>
	<input type="submit" class="search-submit" value="Zoek">
	</form>';
    return $form;
}

 add_filter( 'get_search_form', 'cs_search_form_widget' );

/**
 * Changes the redirect URL for the Return To Shop button in the cart.
 *
 * @return string
 */
function wc_empty_cart_redirect_url() {
	return 'https://www.cre8tive.online';
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );
// heloo test