<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$terms = get_terms( array('taxonomy' => 'course_category' ) );
$category_dropdown = array(  0 => __( 'All', 'eikra-core' ) );
foreach ( $terms as $category ) {
	$category_dropdown[$category->term_id] = $category->name;
}
?>
<div class="rt-vc-course-search rtin-<?php echo esc_attr( $style );?>">
	<h3 class="rtin-title"><?php echo esc_html( $title );?></h3>
	<form class="form-inline" role="search" method="get" action="<?php echo esc_url( get_post_type_archive_link( 'lp_course' ) ); ?>">
		<div class="form-group">
			<div class="input-group">
				<div class="input-group-addon rtin-dropdown">
					<button type="button" data-toggle="dropdown" aria-expanded="false">
						<span class="rtin-cat"><?php esc_html_e( 'Opleidingen', 'eikra-core' );?></span>
						<i class="fa fa-caret-down" aria-hidden="true"></i>
						<span class="rtin-sep">|</span>
					</button>
					<div class="dropdown-menu">
						<ul>
							<?php foreach ( $category_dropdown as $key => $value ): ?>
								<li><a href="#" data-cat="<?php echo esc_attr( $key );?>"><?php echo esc_html( $value );?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="input-group-addon rtin-input-wrap">
					<input type="hidden" name="refcat" value="">
					<input type="hidden" name="ref" value="course">
					<input type="text" class="form-control rtin-searchtext" placeholder="<?php esc_attr_e( 'Type hier welke cursus je zoekt', 'eikra-core' );?>" name="s">
				</div>
				<div class="input-group-addon rtin-submit-btn-wrap"><button type="submit" class="rtin-submit-btn"><i class="fa fa-search" aria-hidden="true"></i></button></div>
			</div>
		</div>
	</form>
</div>