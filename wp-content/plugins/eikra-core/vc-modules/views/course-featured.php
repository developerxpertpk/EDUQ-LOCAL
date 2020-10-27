<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

global $post;
$title_style = $title_color ? "color:{$title_color};" : '';
?>
<div class="rt-vc-course-featured">
	<h2 class="rtin-sec-title" style="<?php echo esc_attr( $title_style );?>"><?php echo esc_html( $title ); ?></h2>
	<div class="row">
		<div class="col-sm-12 col-md-6 col-lg-6 col-xs-12 rtin-leftbox">
			<?php
			$post = get_post( $item1 );
			setup_postdata( $post );
			$rdtheme_content = RDTheme_Helper::course_excerpt( 500, 'content' );
			if ( RDTheme_Helper::is_LMS() ) {
				learn_press_get_template( 'custom/course-box.php', array( 'rdtheme_thumbnail' => 'rdtheme-size1', 'rdtheme_content' => $rdtheme_content ) );
			}
			else {
				RDTheme_Helper::get_template( 'template-parts/content-course-box', array( 'rdtheme_thumbnail' => 'rdtheme-size1', 'rdtheme_content' => $rdtheme_content ) );
			}
			wp_reset_postdata();
			?>
		</div>
		<div class="col-sm-12 col-md-6 col-lg-6 col-xs-12 rtin-rightbox">
			<div class="row auto-clear">
				<?php for ( $i = 2; $i <= 5; $i++ ): ?>
					<?php
					$item = ${'item' . $i};
					$post = get_post( $item );
					setup_postdata( $post );
					?>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
						<?php
						if ( RDTheme_Helper::is_LMS() ) {
							learn_press_get_template( 'custom/course-box.php' );
						}
						else {
							get_template_part( 'template-parts/content', 'course-box' );
						}
						?>
					</div>
					<?php wp_reset_postdata();?>
				<?php endfor;?>
			</div>
		</div>
	</div>
</div>