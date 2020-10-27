<?php
/**
 * @author  RadiusTheme
 * @since   2.1
 * @version 3.3
 */

/*-------------------------------------
INDEX
=======================================
#. Common
#. Course Archive
#. Course Single - Tabs and Defaults
#. Course Single Curriculum
#. Course Curriculum Popup
#. Course Single Reviews
#. Course Sidebar
#. Related Courses
#. User profile
#. Checkout
-------------------------------------*/

$primary_color         = RDTheme::$options['primary_color']; // #002147
$secondery_color       = RDTheme::$options['secondery_color']; // #fdc800
$primary_rgb           = RDTheme_Helper::hex2rgb( $primary_color ); // 0, 33, 71
?>

<?php
/*-------------------------------------
#. Common
---------------------------------------*/
?>
.rt-course-box-3 .rtin-meta .rtin-author span,
ul.learn-press-courses .rt-course-box-3 .rtin-meta .rtin-author span,
.rt-course-box-4 .rtin-content .rtin-author-area .rtin-author span,
ul.learn-press-courses .rt-course-box-4 .rtin-content .rtin-author-area .rtin-author span,
.rt-lp-socials li a:hover,
.learn-press-message:before,
#popup_container #popup_title {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-course-box .rtin-thumbnail .rtin-price,
ul.learn-press-courses .rt-course-box .rtin-thumbnail .rtin-price,
.rt-course-box-2 .rtin-meta .rtin-price ins,
ul.learn-press-courses .rt-course-box-2 .rtin-meta .rtin-price ins,
.rt-course-box-3 .rtin-thumbnail .rtin-price,
ul.learn-press-courses .rt-course-box-3 .rtin-thumbnail .rtin-price,
.rt-lp-socials li a,
.lp-label.label-enrolled,
.lp-label.label-started,
.single-lp_course .learn-press-message .learn-press-countdown {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-course-box .rtin-thumbnail:before,
ul.learn-press-courses .rt-course-box .rtin-thumbnail:before,
.rt-course-box-3 .rtin-thumbnail:before,
ul.learn-press-courses .rt-course-box-3 .rtin-thumbnail:before,
.rt-course-box-4 .rtin-thumbnail:before,
ul.learn-press-courses .rt-course-box-4 .rtin-thumbnail:before {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.6);
}
.rt-course-box .rtin-content .rtin-author i,
ul.learn-press-courses .rt-course-box .rtin-content .rtin-author i,
.rt-course-box-4 .rtin-content .rtin-title a:hover,
ul.learn-press-courses .rt-course-box-4 .rtin-content .rtin-title a:hover {
	color: <?php echo esc_html( $secondery_color ); ?>;
}
.course-remaining-time {
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-course-box .rtin-thumbnail a,
ul.learn-press-courses .rt-course-box .rtin-thumbnail a,
.rt-course-box-3 .rtin-thumbnail a,
ul.learn-press-courses .rt-course-box-3 .rtin-thumbnail a,
.rt-course-box-4 .rtin-thumbnail a,
ul.learn-press-courses .rt-course-box-4 .rtin-thumbnail a {
	border-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*-------------------------------------
#. Course Archive
---------------------------------------*/
?>
.rt-course-archive-top .rtin-left .rtin-icons a:hover,
.rt-course-grid-view .rt-course-archive-top .rtin-left .rtin-icons a.rtin-grid,
.rt-course-list-view .rt-course-archive-top .rtin-left .rtin-icons a.rtin-list,
.rt-course-archive-top .rtin-left .rtin-text {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-course-archive-top .rtin-search form button[type="submit"] {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. Course Single - Tabs and Defaults
---------------------------------------*/
?>
.single-lp_course .content-area .site-main > .lp_course ul.learn-press-nav-tabs li a {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.single-lp_course .content-area .site-main > .lp_course ul.learn-press-nav-tabs li.active,
.single-lp_course .content-area .site-main > .lp_course ul.learn-press-nav-tabs li:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
ul.course-features li:before {
	color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*-------------------------------------
#. Course Single Curriculum
---------------------------------------*/
?>
#learn-press-course-curriculum .curriculum-sections .section .section-header,
#learn-press-course-curriculum .curriculum-sections .section .section-header .meta .collapse,
#learn-press-course-curriculum .curriculum-sections .section .section-content li .section-item-link .rtin-center .course-item-meta .course-item-status:before {
	color: <?php echo esc_html( $primary_color ); ?>;
}
#learn-press-course-curriculum .curriculum-sections .section .section-header.active,
#learn-press-course-curriculum .curriculum-sections .section .section-header:hover {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
}
#learn-press-course-curriculum .curriculum-sections .section .section-content li .section-item-link .rtin-left .rtin-left-icon {
	color: <?php echo esc_html( $secondery_color ); ?>;
}
#learn-press-course-curriculum .curriculum-sections .section .section-content li .section-item-link .rtin-center .course-item-meta span {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. Course Curriculum Popup
---------------------------------------*/
?>
body.course-item-popup #learn-press-course-curriculum .curriculum-sections .section .section-header,
body.course-item-popup #learn-press-course-curriculum .curriculum-sections .section .section-content li:before,
body.course-item-popup #learn-press-content-item #content-item-quiz .question-numbers li a:hover,
body.course-item-popup #learn-press-content-item #content-item-quiz .question-numbers li.current a,
.scrollbar-light > .scroll-element.scroll-y .scroll-bar {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
body.course-item-popup #course-item-content-header {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
}
body.course-item-popup #learn-press-content-item #content-item-quiz .quiz-result .result-achieved {
	color: <?php echo esc_html( $primary_color ); ?>;
}
body.course-item-popup #learn-press-content-item #content-item-quiz .question-numbers li a:hover,
body.course-item-popup #learn-press-content-item #content-item-quiz .question-numbers li.current a {
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. Course Single Reviews
---------------------------------------*/
?>
#course-reviews .course-review-head,
#course-reviews .course-reviews-list li .review-text .user-name {
	color: <?php echo esc_html( $primary_color ); ?>;
}
#course-reviews .course-reviews-list li .review-text .review-meta .review-title {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
#course-reviews .course-review-head::after {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*-------------------------------------
#. Course Sidebar
---------------------------------------*/
?>
.learnpress-page .course_enroll_wid .rtin-pricing,
.course-rate .average-rating,
.course-rate .course-each-rating .star-info {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.learnpress-page .course_enroll_wid a,
.learnpress-page .course_enroll_wid button {
	color: <?php echo esc_html( $primary_color ); ?>;
	background-color: <?php echo esc_html( $secondery_color ); ?>;
	border-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*-------------------------------------
#. Related Courses
---------------------------------------*/
?>
.rt-related-courses .owl-custom-nav-title {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-related-courses .owl-custom-nav .owl-prev:hover,
.rt-related-courses .owl-custom-nav .owl-next:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-related-courses .owl-custom-nav .owl-prev,
.rt-related-courses .owl-custom-nav .owl-next {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*-------------------------------------
#. User profile
---------------------------------------*/
?>
#learn-press-user-profile .rdtheme-lp-profile-header,
#learn-press-user-profile #learn-press-profile-content .lp-tab-sections li a:hover,
#learn-press-user-profile #learn-press-profile-content .learn-press-subtab-content .lp-sub-menu li.active span,
#learn-press-user-profile #learn-press-profile-content .learn-press-subtab-content .lp-sub-menu li a:hover,
#learn-press-user-profile #learn-press-profile-nav:hover #profile-mobile-menu {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
#learn-press-user-profile .rdtheme-lp-profile-header .rtin-item .rtin-right .rtin-social li a,
#learn-press-user-profile .rdtheme-lp-profile-header .rtin-logout a,
#learn-press-user-profile #learn-press-profile-nav .learn-press-tabs li.active > a,
#learn-press-user-profile #learn-press-profile-nav .learn-press-tabs li a:hover {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
}
#learn-press-user-profile #learn-press-profile-content .lp-tab-sections li span,
#learn-press-user-profile #learn-press-profile-content .lp-tab-sections li a {
	color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. Checkout
---------------------------------------*/
?>
.learn-press-checkout .lp-list-table thead tr th {
	background: <?php echo esc_html( $primary_color ); ?>;
}