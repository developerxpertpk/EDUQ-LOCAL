<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.7
 */

$args = array(
    'post_type'        => 'ac_gallery',
    'posts_per_page'   => -1,
    'suppress_filters' => false,
    );
$posts = get_posts( $args );

$gallery = array();
$cats    = array();

foreach ( $posts as $post ) {
    $img_l = get_the_post_thumbnail_url( $post, 'rdtheme-size6' );
    $img_s = get_the_post_thumbnail_url( $post, 'rdtheme-size3' );
    $terms = get_the_terms( $post, 'ac_gallery_category' );
    $terms_html = '';
	
	if ( $terms ) {
		foreach ( $terms as $term ) {
			$terms_html .= ' ' . $term->slug;
			if ( !isset( $cats[$term->slug] ) ) {
				$cats[$term->slug] = $term->name;
			}
		}
	}
	
    $gallery[] = array(
        'img_l' => $img_l,
        'img_s' => $img_s,
        'title' => $post->post_title,
        'cats'  => $terms_html,
     );
}  
?>
<div class="rt-gallery-1 rt-vc-isotope-container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="rt-gallery-tab rt-vc-isotope-tab isotop-btn"> 
                <a href="#" data-filter="*" class="current"><?php echo esc_html( $all );?></a>
                <?php foreach ( $cats as $key => $value): ?>
                    <a href="#" data-filter=".<?php echo esc_attr( $key );?>"><?php echo esc_html( $value );?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row rt-vc-isotope-wrapper rt-gallery-wrapper rt-vc-magnific-popup">
        <?php foreach ( $gallery as $gallery_each ): ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12<?php echo esc_attr( $gallery_each['cats'] );?>">
                <div class="rt-gallery-box">
                    <img src="<?php echo esc_url( $gallery_each['img_s'] );?>" class="img-responsive" alt="<?php echo esc_html( $gallery_each['title'] );?>">
                    <div class="rt-gallery-content">
                        <a href="<?php echo esc_url( $gallery_each['img_l'] );?>" class="rt-gallery-1-zoom" title="<?php echo esc_html( $gallery_each['title'] );?>"><i class="fa fa-link" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>             
</div>