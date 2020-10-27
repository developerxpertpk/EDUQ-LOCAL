<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.3
 */

/*-------------------------------------
#. Hooked functions
---------------------------------------*/
function rdtheme_lp_instructor_tab( $tabs ){
	$tabs['instructor'] = array(
		'title'  => esc_html__( 'Instructor', 'eikra' ),
		'priority' => 40,
		'callback' => 'rdtheme_lp_instructor_tab_contents'
	);
	return $tabs;
}

function rdtheme_lp_show_overview_tab_always( $tabs ){
	if ( empty( $tabs['overview'] ) ) {
		$overview = array(
			'title'    => esc_html__( 'Overview', 'eikra' ),
			'priority' => 10,
			'callback' => 'learn_press_course_overview_tab'
		);
		$tabs = array( 'overview' => $overview ) + $tabs;
	}
	return $tabs;
}

function rdtheme_lp_empty_curriculum_text( $text ){
	$text = '<div class="learn-press-message success"><p>'. $text . '</p></div>';
	return $text;
}

function rdtheme_lp_modify_reviews_tab( $tabs ){
	$tabs['reviews']['priority'] = 50;
	$tabs['reviews']['callback'] = 'rdtheme_lp_course_reviews_tab_reviews_callback';
	return $tabs;
}

function rdtheme_lp_disable_tabs( $tabs ){
	if ( isset( $tabs['curriculum'] ) && !RDTheme::$options['course_curriculum'] ) {
		unset( $tabs['curriculum'] );
	}
	if ( isset( $tabs['instructor'] ) && !RDTheme::$options['course_instructor'] ) {
		unset( $tabs['instructor'] );
	}
	if ( isset( $tabs['reviews'] ) && !RDTheme::$options['course_review'] ) {
		unset( $tabs['reviews'] );
	}
	return $tabs;
}

function rdtheme_lp_instructor_tab_contents(){
	learn_press_get_template( 'custom/instructor-tab-contents.php' );
}

function rdtheme_lp_course_reviews_tab_reviews_callback() {
	$review = LP_Addon_Course_Review::instance();
	$review->print_review();
	if ( rdtheme_lp_user_can_access_course() ) {
		$review->add_review_button();
	}
}

function rdtheme_lp_course_features() {
	$course        = LP_Global::course();
	$course_id     = get_the_ID();
	$lecture       = $course->get_curriculum_items( 'lp_lesson' );
	$lecture       = $lecture ? count( $lecture ) : false;
	$quiz          = $course->get_curriculum_items( 'lp_quiz' );
	$quiz          = $quiz ? count( $quiz ) : false;
	$students      = $course->get_users_enrolled();
	$students      = $students ? $students : 0;
	$instructor    = $course->get_instructor_html();
	$duration      = get_post_meta( $course_id, '_lp_duration', true );
	$duration_time = absint( $duration );
	$duration_time = !empty( $duration_time ) ? $duration_time : false;

	$features = array();
	if ( !empty( RDTheme::$options['course_meta']['ins'] ) ) {
		$features[] = array( esc_html__( 'Instructor', 'eikra' ), $instructor );
	}
	if ( $lecture && !empty( RDTheme::$options['course_meta']['lec'] ) ) {
		$features[] = array( esc_html__( 'Lectures', 'eikra' ), $lecture );
	}
	if ( $quiz && !empty( RDTheme::$options['course_meta']['qz'] ) ) {
		$features[] = array( esc_html__( 'Quizzes', 'eikra' ), $quiz );
	}
	if ( $students && !empty( RDTheme::$options['course_meta']['stu'] ) ) {
		$features[] = array( esc_html__( 'Students', 'eikra' ), $students );
	}
	if ( $duration_time && !empty( RDTheme::$options['course_meta']['dur'] ) ) {
		$duration_text = str_replace( $duration_time, '', $duration );
		$duration_text = trim( $duration_text );

		switch ( $duration_text ) {
			case 'minute':
			$duration_text = $duration_time > 1 ? esc_html__( 'minutes', 'eikra' ) : esc_html__( 'minute', 'eikra' );
			break;
			case 'hour':
			$duration_text = $duration_time > 1 ? esc_html__( 'hours', 'eikra' ) : esc_html__( 'hour', 'eikra' );
			break;
			case 'day':
			$duration_text = $duration_time > 1 ? esc_html__( 'days', 'eikra' ) : esc_html__( 'day', 'eikra' );
			break;
			case 'week':
			$duration_text = $duration_time > 1 ? esc_html__( 'weeks', 'eikra' ) : esc_html__( 'week', 'eikra' );
			break;
		}

		$duration_html = "$duration_time $duration_text";
		$features[] = array( esc_html__( 'Duration', 'eikra' ), $duration_html );
	}
	$term_seperator = !is_rtl() ? ', ' : '<span class="rtin-sep">&bull;</span>';
	?>
	<ul class="course-features">
		<?php foreach ( $features as $feature ): ?>
			<li><span><?php echo esc_html( $feature[0] ); ?></span>: <?php echo wp_kses_post( $feature[1] ); ?></li>
		<?php endforeach; ?>
	</ul>
	<div class="course-terms">
		<?php if ( has_term( '', 'course_category' ) && RDTheme::$options['course_cats'] ): ?>
			<div class="course-term clearfix"><span><?php esc_html_e( 'Categories:', 'eikra' );?></span> <?php echo get_the_term_list( $course_id, 'course_category', '', $term_seperator ); ?></div>
		<?php endif; ?>
		<?php if ( has_term( '', 'course_tag' ) && RDTheme::$options['course_tags'] ): ?>
			<div class="course-term clearfix"><span><?php esc_html_e( 'Tags:', 'eikra' );?></span> <?php echo get_the_term_list( $course_id, 'course_tag', '', $term_seperator ); ?></div>
		<?php endif; ?>		
	</div>
	<div class="course-sep"></div>
	<?php
}

function rdtheme_lp_change_avatar_size( $args ){
	foreach ( $args as $key => $value ) {
		if ( isset($value['id']) && $value['id'] == 'profile_picture_thumbnail_size' ) {
			$args[$key]['default'] = array( 360, 370, 'yes' );
			$args[$key]['desc'] = '';
		}
	}
	return $args;
}

function rdtheme_lp_show_avatar_size_text(){
	$thumb_size   = learn_press_get_avatar_thumb_size();
	?>
	<p class="mt20"><em><?php echo sprintf( esc_html__( 'Image size should be %sx%s px', 'eikra' ), $thumb_size['width'], $thumb_size['height']) ; ?></em></p>
	<?php
}

function rdtheme_lp_instructor_admin_menu(){
	global $menu;
	$accept = array( 'profile.php', 'learn_press' );
	foreach ( $menu as $menu_item ) {
		if ( !empty( $menu_item[0] ) && !in_array( $menu_item[2], $accept ) ) {
			remove_menu_page( $menu_item[2] );
		}
	}
}

function rdtheme_lp_instructor_admin_index(){
	wp_safe_redirect( admin_url( 'edit.php?post_type=lp_course' ) );
	exit;
}

function rdtheme_lp_instructor_extra_fields( $user ) {

	if ( !user_can( $user->ID, LP_TEACHER_ROLE ) ) {
		return false;
	}

	$user_meta   = get_the_author_meta( 'rt_lp_instructor_info', $user->ID );
	$designation = isset( $user_meta['designation'] ) ? $user_meta['designation'] : '';
	$socials = RDTheme_Helper::instructor_socials();
	?>
	<h3><?php esc_html_e( 'Instructor Info', 'eikra' ); ?></h3>
	<table class="form-table">
		<tbody>
			<?php
			rdtheme_lp_user_textfield( esc_html__( 'Designation', 'eikra' ), 'rt_lp_instructor_info[designation]', $designation );
			foreach ( $socials as $key => $value ) {
				$social = isset( $user_meta['socials'][$key] ) ? $user_meta['socials'][$key] : '';
				rdtheme_lp_user_textfield( $value['label'], "rt_lp_instructor_info[socials][$key]", $social );
			}
			?>
		</tbody>
	</table>
	<?php
}

function rdtheme_lp_instructor_custom_ordering_field( $user ) {
	if ( !current_user_can( 'edit_user' ) ) {
		return;
	}

	$custom_order = get_the_author_meta( 'rt_user_custom_order', $user->ID );
	$custom_order = $custom_order ? $custom_order : 0;
	?>
	<tr class="user-custom-order-wrap">
		<th><label for="custom_order"><?php esc_html_e( 'Custom Order', 'eikra' ); ?></label></th>
		<td><input type="number" name="rt_user_custom_order" id="custom_order" value="<?php echo esc_attr( $custom_order ); ?>"></td>
	</tr>
	<?php
}

function rdtheme_lp_instructor_extra_fields_update( $user_id=false ) {
	if ( !$user_id ) {
		$user_id = get_current_user_id();
		if ( !$user_id ) return;
	}

	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	if ( !isset( $_POST['rt_lp_instructor_info'] ) ) return;

	// Sanitize fields
	$meta = $_POST['rt_lp_instructor_info'];
	if ( isset( $meta['designation'] ) ) {
		sanitize_text_field( $meta['designation'] );
	}
	if ( isset( $meta['socials'] ) ) {
		foreach ( $meta['socials'] as $key => $value ) {
			$meta['socials'][$key] = sanitize_text_field( $value );
		}
	}
	
	update_user_meta( $user_id, 'rt_lp_instructor_info', $meta );
}

function rdtheme_lp_instructor_custom_ordering_field_update( $user_id=false ) {
	if ( !$user_id ) {
		$user_id = get_current_user_id();
		if ( !$user_id ) return;
	}


	if ( !current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	if ( isset( $_POST['rt_user_custom_order'] ) ) {
		$meta = intval( $_POST['rt_user_custom_order'] );
		update_user_meta( $user_id, 'rt_user_custom_order', $meta );
	}
}

function rdtheme_lp_instructor_social_fields_frontend() {
	$user_id = get_current_user_id();

	if ( !user_can( $user_id, LP_TEACHER_ROLE ) ) {
		return false;
	}

	$user_meta = get_the_author_meta( 'rt_lp_instructor_info', $user_id );
	$socials   = RDTheme_Helper::instructor_socials();

	foreach ( $socials as $key => $value ) {
		$social = isset( $user_meta['socials'][$key] ) ? $user_meta['socials'][$key] : '';
		rdtheme_lp_user_textfield_forntend( $value['label'], "rt_lp_instructor_info[socials][$key]", $social );
	}
}

function rdtheme_lp_wishlist_modal() {
	if ( !class_exists( 'LP_Addon_Wishlist' ) ) {
		return;
	}
	locate_template( 'learnpress/custom/wishlist-modal.php', true );
}

function rdtheme_lp_curriculum_title(){
	$type = LP_Global::course_item();
	if ( $type ) {
		$type = $type->get_item_type();
		if ( $type == 'lp_lesson' || $type == 'lp_quiz' ) {
			echo '<h3 class="rt-popup-title">';
			the_title();
			echo '</h3>';			
		}
	}
}


/*-------------------------------------
#. Custom Functions
---------------------------------------*/
// Display indexing text on top of course archive
function rdtheme_lp_the_course_indexing_text( $total ){
	if ( $total == 0 ) {
		$result = esc_html__( 'There are no available courses!', 'eikra' );
	}
	elseif ( $total == 1 ) {
		$result = esc_html__( 'Showing only one result', 'eikra' );
	}
	else {
		$courses_per_page = absint( LP()->settings->get( 'archive_course_limit' ) );
		$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

		$from = 1 + ( $paged - 1 ) * $courses_per_page;
		$to   = ( $paged * $courses_per_page > $total ) ? $total : $paged * $courses_per_page;

		if ( $from == $to ) {
			$result = sprintf( esc_html__( 'Showing last course of %s results', 'eikra' ), $total );
		}
		else {
			$result = sprintf( esc_html__( 'Showing %s-%s of %s results', 'eikra' ), $from, $to, $total );
		}
	}
	echo esc_html( $result );
}

// Calculate lesson duration
function rdtheme_lp_lesson_duration( $lesson_id ) {
	$duration = get_post_meta( $lesson_id, '_lp_duration', true );
	$duration_val = absint( $duration );

	// when disabled
	if ( empty( $duration_val ) ) {
		return false;
	}

	// when week
	if ( strrpos( $duration, 'week' ) ) {
		$weektext = ( $duration > 1 ) ? esc_html__( 'Weeks', 'eikra' ) : esc_html__( 'Week', 'eikra' );
		return "$duration_val $weektext";
	}

	// when week
	if ( strrpos( $duration, 'day' ) ) {
		$daytext = ( $duration > 1 ) ? esc_html__( 'Days', 'eikra' ) : esc_html__( 'Day', 'eikra' );
		return "$duration_val $daytext";
	}

	// when hour
	if ( strrpos( $duration, 'hour' ) ) {
		return $duration_val . esc_html__( 'h', 'eikra' );
	}

	// when min
	$hour = floor( $duration_val / 60 );
	if ( $hour == 0 ) {
		$hour = '';
	}
	else {
		$hour = $hour . esc_html__( 'h', 'eikra' );
	}
	$minute = $duration_val % 60;
	$minute = $minute . esc_html__( 'm', 'eikra' );

	return $hour . $minute;
}

// Calculate number of questions in a quiz
function rdtheme_lp_quiz_ques_count( $quiz_id ) {
	$questions = learn_press_get_quiz_questions( $quiz_id );
	if ( $questions ) {
		return count( $questions );
	}
	return false;
}

// Generate wishlist icon
function rdtheme_lp_wishlist_icon( $course_id ){
	$user_id = get_current_user_id();

	if ( !class_exists( 'LP_Addon_Wishlist' ) || !$course_id ) {
		return;
	}

	if ( !$user_id ) {
		echo '<div class="rt-wishlist-icon"><span data-toggle="modal" data-target="#rt-wishlist-modal" class="fa fa-heart" title="' . esc_attr__( 'Add this course to your wishlist', 'eikra' ) . '"></span></div>';
		return;
	}

	$classes = array( 'course-wishlist' );
	$state   = learn_press_user_wishlist_has_course( $course_id, $user_id ) ? 'on' : 'off';

	if ( $state == 'on' ) {
		$classes[] = 'on';
	}
	$classes = apply_filters( 'learn_press_course_wishlist_button_classes', $classes, $course_id );
	$title   = ( $state == 'on' ) ? esc_html__( 'Remove this course from your wishlist', 'eikra' ) : esc_html__( 'Add this course to your wishlist', 'eikra' );

	echo '<div class="rt-wishlist-icon">';
	printf(
		'<span class="fa fa-heart learn-press-course-wishlist-button-%2$d %s" data-id="%s" data-nonce="%s" title="%s"></span>',
		join( " ", $classes ),
		$course_id,
		wp_create_nonce( 'course-toggle-wishlist' ),
		$title
	);
	echo '</div>';		
}

// Check if user can access course
function rdtheme_lp_user_can_access_course(){
	$course = LP_Global::course();
	$user   = learn_press_get_current_user();
	return $user->has_purchased_course( $course->get_id() );
}

// Create user text field(Backend)
function rdtheme_lp_user_textfield( $label, $field, $value ){
	?>
	<tr>
		<th>
			<label><?php echo esc_html( $label ); ?></label>
		</th>
		<td>
			<input class="regular-text" type="text" value="<?php echo esc_attr( $value );?>" name="<?php echo esc_attr( $field );?>">
		</td>
	</tr>
	<?php
}

// Create user text field(Frontend)
function rdtheme_lp_user_textfield_forntend( $label, $field, $value ){
	?>
	<li class="form-field">
		<label class="lp-form-field-label"><?php echo esc_html( $label ); ?></label>
		<div class="form-field-input">
			<input type="text" name="<?php echo esc_attr( $field );?>" value="<?php echo esc_attr( $value );?>" class="regular-text">
		</div>
	</li>
	<?php
}

// Generate course excerpt
function rdtheme_lp_course_excerpt( $limit = 50, $type = 'content' ){
	global $post;
	if ( $type = 'content' ) {
		$content = $post->post_content;
	}
	else {
		$content = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
	}
	$content = wptexturize( $content );
	$content = convert_smilies( $content );
	$content = convert_chars( $content );
	$content = wpautop( $content );
	$content = shortcode_unautop( $content );
	$content = wp_trim_words( $content, $limit );
	return $content;
}

// Course archive top search
function rdtheme_lp_archive_top_search(){
	if ( !( is_post_type_archive( 'lp_course' ) || is_tax( 'course_category' ) ) ) {
		return;
	}
	global $wp_query;
	?>
	<div class="rt-course-archive-top">
		<div class="row">
			<div class="col-sm-6">
				<div class="rtin-left">
					<div class="rtin-icons">
						<a href="#" class="rtin-grid"><i class="fa fa-th-large"></i></a>
						<a href="#" class="rtin-list"><i class="fa fa-list-ul"></i></a>
					</div>
					<div class="rtin-text"><?php rdtheme_lp_the_course_indexing_text( $wp_query->found_posts ); ?></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="rtin-search">
					<form method="get" action="<?php echo esc_url( get_post_type_archive_link( 'lp_course' ) ); ?>">
						<input type="hidden" name="ref" value="course">
						<input type="text" value="<?php echo esc_attr( get_search_query() );?>" name="s" placeholder="<?php esc_attr_e( 'Search our courses', 'eikra' ) ?>" class="form-control" />
						<button type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
}

// Course price html
function rdtheme_lp_price_html( $course, $pos = 'right' ){
	$regular_price  = $course->get_origin_price_html();
	$final_price    = $course->get_price_html();
	if ( $course->has_sale_price() ) {
		if ( $pos == 'right' ) {
			$price_html = sprintf( '<span class="rt-lp-price"><ins>%1$s</ins><del>%2$s</del></span>', $final_price, $regular_price );
		}
		else {
			$price_html = sprintf( '<span class="rt-lp-price"><del>%2$s</del><ins>%1$s</ins></span>', $final_price, $regular_price );
		}
	}
	else {
		$price_html = sprintf( '<span class="rt-lp-price"><ins>%1$s</ins></span>', $final_price );
	}
	return $price_html;
}