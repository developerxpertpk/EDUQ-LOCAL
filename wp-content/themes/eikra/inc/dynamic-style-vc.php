<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.0
 */

$primary_color   = RDTheme::$options['primary_color']; // #002147
$secondery_color = RDTheme::$options['secondery_color']; // #fdc800
$primary_rgb     = RDTheme_Helper::hex2rgb( $primary_color ); // 0, 33, 71
$secondary_rgb   = RDTheme_Helper::hex2rgb( $secondery_color ); // 253, 200, 0

/*-------------------------------------    
INDEX
===================================
#. VC: Pagination
#. VC: Common button
#. VC: Owl Nav 1
#. VC: RT Default Title
#. VC: Section Title
#. VC: Info Box
#. VC: Image Text Box
#. VC: Text With Title
#. VC: Text With Button
#. VC: CTA
#. VC: Posts
#. VC: Research
#. VC: Events
#. VC: Counter
#. VC: Testimonial
#. VC: Countdown
#. VC: Event Countdown
#. VC: Pricing Box
#. VC: Gallery
#. VC: Video
#. VC: Contact
#. VC: Instructor
#. VC: Course Search
#. VC: Course Slider
#. VC: Course Featured
#. VC: Course Isotope
#. VC: Image Gallery- Flex Slider Slide
#. VC: FAQ Accordion
-------------------------------------*/
?>

<?php
/*------------------------------
#. VC: Pagination
--------------------------------*/
?>
.rt-vc-pagination .pagination-area ul li a,
.rt-vc-pagination .pagination-area ul li span {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-pagination .pagination-area ul li.active a,
.rt-vc-pagination .pagination-area ul li a:hover,
.rt-vc-pagination .pagination-area ul li .current {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: Common button
--------------------------------*/
?>
body .entry-content .rdtheme-button-5,
body .rdtheme-button-5 {
    border-color: <?php echo esc_html( $secondery_color ); ?>;
}
body .entry-content .rdtheme-button-5:hover,
body .rdtheme-button-5:hover{
    background-color: <?php echo esc_html( $secondery_color ); ?>;
    color: <?php echo esc_html( $primary_color ); ?>;
}
body .entry-content .rdtheme-button-6,
body .rdtheme-button-6 {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
body .entry-content .rdtheme-button-6:hover,
body .rdtheme-button-6:hover {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
    color: <?php echo esc_html( $primary_color ); ?>;
}
body .rdtheme-button-7,
body a.rdtheme-button-7 {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}
body .rdtheme-button-7:hover,
body a.rdtheme-button-7:hover {
    color: <?php echo esc_html( $primary_color ); ?>;
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.entry-content .isotop-btn a:hover,
.entry-content .isotop-btn .current {
    border-color: <?php echo esc_html( $primary_color ); ?> !important;
    background-color: <?php echo esc_html( $primary_color ); ?> !important;
}

<?php
/*------------------------------
#. VC: Owl Nav 1
--------------------------------*/
?>
.rt-owl-nav-1 .section-title .owl-custom-nav-title {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-owl-nav-1 .section-title .owl-custom-nav .owl-prev,
.rt-owl-nav-1 .section-title .owl-custom-nav .owl-next {
    background-color: <?php echo esc_html( $secondery_color );?>;
}
.rt-owl-nav-1 .section-title .owl-custom-nav .owl-prev:hover,
.rt-owl-nav-1 .section-title .owl-custom-nav .owl-next:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: RT Default Title
--------------------------------*/
?>
.rt-vc-title-left {
    color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Section Title
--------------------------------*/
?>
.rt-vc-title h2 {
    color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Info Box
--------------------------------*/
?>
.rt-info-box .media-heading,
.rt-info-box .media-heading a,
.rt-info-box.layout2 i,
.rt-info-box.layout3 i,
.rt-info-box.layout4:hover .rtin-icon i {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-info-box .media-heading a:hover,
.rt-info-box.layout2:hover i,
.rt-info-box.layout5 .rtin-icon i,
.rt-info-box.layout5:hover .media-heading,
.rt-info-box.layout6:hover .media-heading a {
	color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-info-box.layout4::before,
.rt-info-box.layout4:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-info-box.layout5 {
	background-color: rgba( <?php echo esc_html($primary_rgb); ?>, 0.8 );
}
.rt-info-box.layout3:hover i,
.rt-info-box.layout4 .rtin-icon i {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-infobox-6 .rtin-item .rtin-left .rtin-icon i {
    color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: Image Text Box
--------------------------------*/
?>
.rt-vc-imagetext-2 .rtin-img:before {
    background-color: rgba(<?php echo esc_html($primary_rgb); ?>, 0.6);
}
.rt-vc-imagetext-2 .rtin-img a {
    border-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-imagetext-2 .rtin-title a:hover {
    color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Text With Title
--------------------------------*/
?>
.rt-vc-text-title .rtin-title {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-text-title.style2 .rtin-title::after {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-text-title.style3 .rtin-btn a {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-text-title.style4 .rtin-btn a {
    border-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-text-title.style4 .rtin-btn a:hover {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: Text With Button
--------------------------------*/
?>
.rt-vc-text-button .rtin-btn a {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: CTA
--------------------------------*/
?>
.rt-vc-cta .rtin-right {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-cta .rtin-right .rtin-btn {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
    border-color: <?php echo esc_html( $secondery_color ); ?>;
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-cta.style2 .rtin-right {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-cta.style2 .rtin-right .rtin-btn {
    background-color: <?php echo esc_html( $primary_color ); ?>;
    border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-cta.style2 .rtin-right .rtin-btn:hover {
    color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Posts
--------------------------------*/
?>
.rt-vc-posts .rtin-item .media-list .rtin-content-area h3 a {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-posts .rtin-item .media-list .rtin-content-area h3 a:hover {
    color: <?php echo esc_html( $secondery_color ); ?>;
} 
.rt-vc-posts .rtin-item .media-list .rtin-content-area .rtin-date {
    color: <?php echo esc_html( $secondery_color ); ?>;
}

.rt-vc-posts-2 {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-posts-2 .rtin-item .rtin-date {
    color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-posts-2 .rtin-btn:hover {
    color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-posts-2 .rtin-btn i {
    color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-posts-2 .rtin-item .rtin-title a:hover {
    color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: Research
--------------------------------*/
?>
.rt-vc-research-1 .rtin-item .rtin-title::after,
.rt-vc-research-2 .rtin-item .rtin-title::after,
.rt-vc-research-3 .rtin-item .rtin-holder .rtin-title a:hover {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-research-1 .rtin-item .rtin-title a,
.rt-vc-research-2 .rtin-item .rtin-title a,
.rt-vc-research-3 .rtin-item .rtin-holder .rtin-title a:hover,
.rt-vc-research-3 .rtin-item .rtin-holder .rtin-title a:hover i {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-research-1 .rtin-item .rtin-title a:hover,
.rt-vc-research-2 .rtin-item .rtin-title a:hover,
.rt-vc-research-3 .rtin-item .rtin-holder .rtin-title a i {
    color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-research-3 .rtin-item .rtin-holder .rtin-title a {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*--------------------------------------
#. VC: Events
---------------------------------------*/
?>
.rt-vc-event .rtin-item .rtin-calender-holder .rtin-calender {
    background-color:<?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-event .rtin-item .rtin-calender-holder .rtin-calender:before,
.rt-vc-event .rtin-item .rtin-calender-holder .rtin-calender:after,
.rt-vc-event .rtin-item .rtin-calender-holder .rtin-calender h3,
.rt-vc-event .rtin-item .rtin-calender-holder .rtin-calender h3 p,
.rt-vc-event .rtin-item .rtin-calender-holder .rtin-calender h3 span,
.rt-vc-event .rtin-item .rtin-right h3 a,
.rt-vc-event .rtin-item .rtin-right ul li,
.rt-vc-event .rtin-btn a:hover {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-event .rtin-item .rtin-right h3 a:hover {
    color: <?php echo esc_html( $secondery_color ); ?>;
}

.rt-vc-event-box .rtin-item .rtin-meta i {
    color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-event-box .rtin-item .rtin-btn a {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
    border-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: Counter
--------------------------------*/
?>
.rt-vc-counter .rtin-left .rtin-counter {
    border-bottom-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-counter .rtin-right .rtin-title {
    color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Testimonial
--------------------------------*/
?>
.rt-vc-testimonial .rt-item .rt-item-content-holder .rt-item-title {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-testimonial .owl-theme .owl-dots .owl-dot.active span {       
    background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-testimonial-2 .rtin-item .rtin-item-designation {
    color:<?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-testimonial-2 .owl-theme .owl-dots .owl-dot:hover span,
.rt-vc-testimonial-2 .owl-theme .owl-dots .owl-dot.active span {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
    border-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-testimonial-3 .rtin-item .rtin-content-area .rtin-title {
     color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Countdown
--------------------------------*/
?>
.rt-countdown .rt-date .rt-countdown-section-2 {
    border-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: Event Countdown
--------------------------------*/
?>
.rt-event-countdown .rt-content h2,
.rt-event-countdown .rt-content h3,
.rt-event-countdown .rt-date .rt-countdown-section .rt-countdown-text .rtin-count,
.rt-event-countdown .rt-date .rt-countdown-section .rt-countdown-text .rtin-text {
	color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-event-countdown .rt-date .rt-countdown-section .countdown-colon,
.rt-event-countdown.rt-dark .rt-date .rt-countdown-section .rt-countdown-text .rtin-count {
	color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: Pricing Box
--------------------------------*/
?>
.rt-price-table-box1 span {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-price-table-box1 .rtin-price {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-price-table-box1 .rtin-btn {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
    border-color: <?php echo esc_html( $secondery_color ); ?>;
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-price-table-box1:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-price-table-box1:hover .rtin-price {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}

.rt-pricing-box2 .rtin-title,
.rt-pricing-box2 ul li {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-pricing-box2 .rtin-price {
    color: <?php echo esc_html( $secondery_color ); ?>;
}

.rt-price-table-box3 .rtin-title,
.rt-price-table-box3 .rtin-price {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-price-table-box3 .rtin-btn {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-price-table-box3.rtin-featured,
.rt-price-table-box3:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Gallery
--------------------------------*/
?>
.rt-gallery-1 .rt-gallery-wrapper .rt-gallery-box:before {
    background-color: rgba( <?php echo esc_html($secondary_rgb); ?>, 0.8 );
}
.rt-gallery-1 .rt-gallery-wrapper .rt-gallery-box .rt-gallery-content a {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Video
--------------------------------*/
?>
.rt-vc-video .rtin-item .rtin-btn {
    color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-video .rtin-item .rtin-btn:hover {
    border-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-video.rt-light .rtin-item .rtin-title {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-video.rt-light .rtin-item .rtin-btn {
    color: <?php echo esc_html( $primary_color ); ?>;
    border-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: Contact
--------------------------------*/
?>
.rt-vc-contact-1 ul.rtin-item > li > i {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-contact-1 ul.rtin-item > li .contact-social li a {
    color: <?php echo esc_html( $primary_color ); ?>;
    border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-contact-1 ul.rtin-item > li .contact-social li a:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-contact-2 ul.rtin-item > li {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-contact-2 ul.rtin-item > li > i {
    color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-contact-2 ul.rtin-item > li.rtin-social-wrap .rtin-social li a {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-contact-2 ul.rtin-item > li.rtin-social-wrap .rtin-social li a:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Instructor
--------------------------------*/
?>
.rt-vc-instructor-1 .rtin-item .rtin-content .rtin-title a {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-instructor-1 .rtin-item .rtin-content .rtin-title a:hover {
    color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-instructor-1 .rtin-item .rtin-content .rtin-social li a {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-instructor-1 .rtin-item .rtin-content .rtin-social li a:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-vc-instructor-2 .rtin-item .rtin-content .rtin-title a,
.rt-vc-instructor-2 .rtin-item .rtin-content .rtin-social li a {
    color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-instructor-2 .rtin-item .rtin-content .rtin-social li a:hover {
    border-color: <?php echo esc_html( $secondery_color ); ?>;
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-instructor-2 .rtin-item:before {
    background: linear-gradient(to bottom, rgba(125, 185, 232, 0) 55%, <?php echo esc_html( $primary_color ); ?>);
}
.rt-vc-instructor-2 .rtin-item:hover:after {
    background-color: rgba( <?php echo esc_html( $primary_rgb ); ?> , 0.7 );
}

.rt-vc-instructor-3 .rtin-item .rtin-meta span {
    color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-instructor-3 .rtin-btn a {
    color: <?php echo esc_html( $primary_color ); ?>;
    border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-instructor-3 .rtin-btn a:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}

.rt-vc-instructor-4 .rtin-item .rtin-content:after {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-instructor-5 .rtin-item {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.rt-vc-instructor-5 .rtin-item .rtin-content .rtin-social li a:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Course Search
--------------------------------*/
?>
.rt-vc-course-search .form-group .input-group .input-group-addon.rtin-submit-btn-wrap .rtin-submit-btn {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: Course Slider
--------------------------------*/
?>
.rt-vc-course-slider.style-4.rt-owl-nav-1 .section-title .owl-custom-nav .owl-prev:hover,
.rt-vc-course-slider.style-4.rt-owl-nav-1 .section-title .owl-custom-nav .owl-next:hover {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: Course Featured
--------------------------------*/
?>
.rt-vc-course-featured .rtin-sec-title {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-course-featured .rt-course-box .rtin-thumbnail::before {
    background-color: rgba( <?php echo esc_html( $secondary_rgb ); ?> , 0.8 );
}
.rt-vc-course-featured .rt-course-box .rtin-thumbnail a {
    background-color: <?php echo esc_html( $primary_color ); ?>;
    border-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Course Isotope
--------------------------------*/
?>
.rt-vc-course-isotope.style-2 .isotop-btn a {
    border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-course-isotope.style-2 .rtin-btn a {
    color: <?php echo esc_html( $primary_color ); ?>;
    border-color: <?php echo esc_html( $primary_color ); ?>;
}
.rt-vc-course-isotope.style-2 .rtin-btn a:hover {
    background-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*------------------------------
#. VC: Image Gallery- Flex Slider Slide
--------------------------------*/
?>
.wpb_gallery .wpb_flexslider .flex-direction-nav a {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*------------------------------
#. VC: FAQ Accordion
--------------------------------*/
?>
.wpb-js-composer .vc_tta.vc_tta-o-no-fill .vc_tta-panels .vc_tta-panel-body {
  background-color: <?php echo esc_html( $primary_color ); ?> !important;
}
.wpb-js-composer .vc_tta-style-classic .vc_tta-panel .vc_tta-panel-title > a,
.wpb-js-composer .vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-title > a {
  color: <?php echo esc_html( $primary_color ); ?> !important;
}
.wpb-js-composer .vc_tta-style-classic .vc_tta-controls-icon:after,
.wpb-js-composer .vc_tta-style-classic .vc_tta-controls-icon:before {
  border-color: <?php echo esc_html( $primary_color ); ?> !important;
}
.wpb-js-composer .vc_tta-container .vc_tta-panel span.faq-box-count {
    background-color: <?php echo esc_html( $secondery_color ); ?>;
    color: <?php echo esc_html( $primary_color ); ?>;
}