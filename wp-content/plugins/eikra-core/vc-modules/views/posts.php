<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 2.1
 */

$thumb_size = 'rdtheme-size5';

if ( !empty( $cat ) ) {
	$blog_permalink = get_category_link( $cat );
}
else {
	$blog_page = get_option( 'page_for_posts' );
	$blog_permalink = $blog_page ? get_permalink( $blog_page ) : home_url( '/' );
}

$args = array(
	'posts_per_page' => $grid_item_number,
	'ignore_sticky_posts' => 1
);

if ( !empty( $cat ) ) {
	$args['cat'] = $cat;
}
$query = new WP_Query( $args );

global $wp_query;
$wp_query = NULL;
$wp_query = $query;
?>
<div class="rt-vc-posts">
	<h2 class="rt-vc-title-left"><?php echo esc_html( $title ); ?></h2>
	<?php if ( have_posts() ): ?>
		<div class="rtin-item" style="background-color:<?php echo esc_attr( $bgcolor ); ?>;">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				$content = RDTheme_Helper::get_current_post_content();
				$content = wp_trim_words( $content, $content_limit );
				?>
				<div class="media media-list">
					<div class="media-left rtin-img">
						<a href="<?php the_permalink(); ?>">
							<?php
							if ( has_post_thumbnail() ){
								the_post_thumbnail( $thumb_size );
							}
							else {
								if ( !empty( RDTheme::$options['no_preview_image']['id'] ) ) {
									echo wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
								}
								else {
									echo '<img class="media-object wp-post-image" src="'.RDTHEME_IMG_URL.'noimage_150x100.jpg" alt="'.get_the_title().'">';
								}
							}
							?>						
						</a>
					</div>
					<div class="media-body rtin-content-area">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="rtin-date"><?php the_time( get_option( 'date_format' ) ); ?></div>
						<p class="rtin-content"><?php echo wp_kses_post( $content ); ?></p>
					</div>
				</div>
			<?php endwhile;?>			
		</div>
		<?php if( $button_display == 'true' ): ?>
			<div class="rtin-btn">
				<a href="<?php echo esc_url( $blog_permalink ); ?>" class="rdtheme-button-6"><?php echo esc_html( $button_text ); ?></a>
			</div>
		<?php endif; ?>
		<?php else: ?>
			<?php esc_html_e( 'No posts found' , 'eikra-core' ); ?>
		<?php endif; ?>
		<?php wp_reset_query();?>
	</div>