<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.5
 */

global $product;

$term_seperator = !is_rtl() ? ', ' : '<span class="rtin-sep">&bull;</span>';

do_action( 'woocommerce_product_meta_start' );

$cats_html = wc_get_product_category_list( $product->get_id(), $term_seperator, '<div class="product-meta clearfix"><span class="rtin-label">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'eikra' ) . '</span> ', '</div>' );

$tags_html = wc_get_product_tag_list( $product->get_id(), $term_seperator, '<div class="product-meta clearfix"><span class="rtin-label">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'eikra' ) . '</span> ', '</div>' );

if ( RDTheme::$options['wc_cats'] ) {
	echo wp_kses_post( $cats_html );
}
if ( RDTheme::$options['wc_tags'] ) {
	echo wp_kses_post( $tags_html );
}

do_action( 'woocommerce_product_meta_end' );