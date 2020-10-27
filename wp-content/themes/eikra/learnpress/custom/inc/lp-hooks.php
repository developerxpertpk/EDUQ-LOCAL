<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.1
 */

/*-------------------------------------
#. Remove Ads
---------------------------------------*/
remove_action( 'admin_footer', 'learn_press_footer_advertisement', - 10 ); // remove footer advertisements
remove_action( 'admin_init', array( 'LP_Install', 'subsciption_button' ) ); // remove newsletter subscription notice
add_filter( 'learn_press_display_admin_footer_text', '__return_false' ); // remove footer rating text

/*-------------------------------------
#. Course Archive
---------------------------------------*/
remove_action( 'learn-press/before-main-content', 'learn_press_breadcrumb', 10 );
remove_action( 'learn-press/before-main-content', 'learn_press_search_form', 15 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_begin_meta', 10 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_price', 20 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_instructor', 25 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_end_meta', 30 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_course_loop_item_buttons', 35 );
remove_action( 'learn-press/after-courses-loop-item', 'learn_press_course_loop_item_user_progress', 40 );

add_action( 'learn-press/before-main-content', 'rdtheme_lp_archive_top_search' );

/*-------------------------------------
#. Course Single
---------------------------------------*/
// When user not enrolled
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_meta_start_wrapper', 5 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_students', 10 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_meta_end_wrapper', 15 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_price', 25 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_buttons', 30 );

// When user enrolled
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_meta_start_wrapper', 10 );
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_students', 15 );
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_meta_end_wrapper', 20 );
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_progress', 25 );
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_buttons', 40 );

// Overview tab - Include features before description
add_action( 'learn-press/before-single-course-description', 'rdtheme_lp_course_features' );

// Curriculam tab
remove_action( 'learn-press/course-section-item/before-lp_quiz-meta', 'learn_press_item_meta_duration', 10 );
remove_action( 'learn-press/course-section-item/before-lp_lesson-meta', 'learn_press_item_meta_duration', 5 );
add_filter( 'learn_press_course_curriculum_empty', 'rdtheme_lp_empty_curriculum_text' ); // Modify empty curriculam text

// Tabs property change
add_filter( 'learn-press/course-tabs', 'rdtheme_lp_instructor_tab' , 5 ); // Add instructor tab
add_filter( 'learn-press/course-tabs', 'rdtheme_lp_show_overview_tab_always' , 5 ); // Show overview tab even if no contents
add_filter( 'learn-press/course-tabs', 'rdtheme_lp_disable_tabs', 50 ); // Disable Tabs based on theme options
if ( class_exists( 'LP_Addon_Course_Review' ) ) {
	add_filter( 'learn-press/course-tabs', 'rdtheme_lp_modify_reviews_tab' , 6 ); // Modify Reviews Tab
}

// Curriculam Popup
add_action( 'learn-press/before-single-course-curriculum', 'rdtheme_lp_curriculum_title' );

// Wishlist Modal
add_action( 'wp_footer', 'rdtheme_lp_wishlist_modal' );

/*-------------------------------------
#. Profile
---------------------------------------*/
add_filter( 'learn-press/profile-settings-fields/avatar', 'rdtheme_lp_change_avatar_size' ); // change avatar size to 360x370
add_action( 'learn-press/after-profile-avatar-fields', 'rdtheme_lp_show_avatar_size_text' ); // Display avatar size hint on frontend

/*-------------------------------------
#. Instructor backend
---------------------------------------*/
if ( is_admin() && current_user_can( 'lp_teacher' ) && !current_user_can( 'administrator' ) ) {
	add_action( 'admin_menu', 'rdtheme_lp_instructor_admin_menu' ); // hide all admin menus except Learpress and Profile
	add_action( 'load-index.php', 'rdtheme_lp_instructor_admin_index' ); // set Course Page as default instead of dashboard
}

/*-------------------------------------
#. Instructor extra fields
---------------------------------------*/
// Create fields in backend
add_action( 'show_user_profile', 'rdtheme_lp_instructor_extra_fields' );
add_action( 'edit_user_profile', 'rdtheme_lp_instructor_extra_fields' );
add_action( 'personal_options', 'rdtheme_lp_instructor_custom_ordering_field' );

// Save fields in backend
add_action( 'personal_options_update', 'rdtheme_lp_instructor_extra_fields_update' );
add_action( 'edit_user_profile_update', 'rdtheme_lp_instructor_extra_fields_update' );

add_action( 'personal_options_update', 'rdtheme_lp_instructor_custom_ordering_field_update' );
add_action( 'edit_user_profile_update', 'rdtheme_lp_instructor_custom_ordering_field_update' );

// Save fields in frontend
add_action( 'init', 'rdtheme_lp_instructor_extra_fields_update' );