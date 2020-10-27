<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.2
 */

include RDTHEME_INC_DIR . 'dynamic-style-gutenberg.php';

/*-------------------------------------
INDEX
=======================================
#. Defaults
#. Top Bar
#. Header
#. Banner
#. Footer
#. Widgets
#. Pagination
#. Error 404
#. Buttons
#. Comments
#. Inner Contents
#. WooCommerce
#. Plugins
-------------------------------------*/

$primary_color         = RDTheme::$options['primary_color']; // #002147
$secondery_color       = RDTheme::$options['secondery_color']; // #fdc800
$primary_rgb           = RDTheme_Helper::hex2rgb( $primary_color ); // 0, 33, 71

$menu_typo             = RDTheme::$options['menu_typo'];
$menu_color            = RDTheme::$options['menu_color'];
$menu_color_alt        = RDTheme::$options['menu_color_alt'];
$menu_color_tr         = RDTheme::$options['menu_color_tr'];
$menu_hover_color      = RDTheme::$options['menu_hover_color'];
$submenu_typo          = RDTheme::$options['submenu_typo'];
$submenu_color         = RDTheme::$options['submenu_color'];
$submenu_bgcolor       = RDTheme::$options['submenu_bgcolor'];
$submenu_hover_color   = RDTheme::$options['submenu_hover_color'];
$submenu_hover_bgcolor = RDTheme::$options['submenu_hover_bgcolor'];
$resmenu_typo          = RDTheme::$options['resmenu_typo'];

$rdtheme_typo_body     = RDTheme::$options['typo_body'];
$rdtheme_typo_h1       = RDTheme::$options['typo_h1'];
$rdtheme_typo_h2       = RDTheme::$options['typo_h2'];
$rdtheme_typo_h3       = RDTheme::$options['typo_h3'];
$rdtheme_typo_h4       = RDTheme::$options['typo_h4'];
$rdtheme_typo_h5       = RDTheme::$options['typo_h5'];
$rdtheme_typo_h6       = RDTheme::$options['typo_h6'];
?>

<?php
/*-------------------------------------
#. Defaults
---------------------------------------*/
?>
.primary-color {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.secondery-color {
	color: <?php echo esc_html( $secondery_color ); ?>;
}
.primary-bgcolor {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.secondery-bgcolor {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*-------------------------------------
#. Top Bar
---------------------------------------*/
?>
#tophead {
    background-color: <?php echo esc_html( RDTheme::$options['top_bar_bgcolor'] ); ?>;
}
#tophead,
#tophead a,
#tophead .tophead-social li a,
#tophead .tophead-social li a:hover {
    color: <?php echo esc_html( RDTheme::$options['top_bar_color'] ); ?>;
}

#tophead .tophead-contact .fa,
#tophead .tophead-address .fa {
	color: <?php echo esc_html( RDTheme::$options['top_bar_icon_color'] ); ?>;
}

.trheader #tophead,
.trheader #tophead a,
.trheader #tophead .tophead-social li a,
.trheader #tophead .tophead-social li a:hover {
	color: <?php echo esc_html( RDTheme::$options['top_bar_color_tr'] ); ?>;
}

.topbar-style-4 #tophead a.topbar-btn {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
	border-color: <?php echo esc_html( $secondery_color ); ?>;
	color: <?php echo esc_html( $primary_color ); ?>;
}
.topbar-style-5 #tophead .widget ul li i {
	color: <?php echo esc_html( RDTheme::$options['top_bar_icon_color'] ); ?>;
}

<?php
/*-------------------------------------
#. Header
---------------------------------------*/
?>
<?php // Main Menu ?>
.site-header .main-navigation ul li a {
	font-family: <?php echo esc_html( $menu_typo['font-family'] ); ?>, sans-serif;
	font-size : <?php echo esc_html( $menu_typo['font-size'] ); ?>;
	font-weight : <?php echo esc_html( $menu_typo['font-weight'] ); ?>;
	line-height : <?php echo esc_html( $menu_typo['line-height'] ); ?>;
	color: <?php echo esc_html( $menu_color ); ?>;
	text-transform : <?php echo esc_html( $menu_typo['text-transform'] ); ?>;
	font-style: <?php echo empty( $menu_typo['font-style'] ) ? 'normal' : $menu_typo['font-style']; ?>;
}
.site-header .main-navigation ul.menu > li > a:hover,
.site-header .main-navigation ul.menu > li.current-menu-item > a,
.site-header .main-navigation ul.menu > li.current > a {
	color: <?php echo esc_html( $menu_hover_color ); ?>;
}
.site-header .main-navigation ul li a.active {
	color: <?php echo esc_html( $menu_hover_color );?> !important;
}

.trheader #masthead .main-navigation ul.menu > li > a,
.trheader #masthead .main-navigation ul.menu > li > a:hover,
.trheader #masthead .main-navigation ul.menu > li.current-menu-item > a,
.trheader #masthead .main-navigation ul.menu > li.current > a,
.trheader #masthead .search-box .search-button i,
.trheader #masthead .header-icon-seperator,
.trheader #masthead .header-icon-area .cart-icon-area > a, 
.trheader #masthead .additional-menu-area a.side-menu-trigger {
	color: <?php echo esc_html( $menu_color_tr ); ?>;
}

<?php // Submenu ?>
.site-header .main-navigation ul li ul li {
	background-color: <?php echo esc_html( $submenu_bgcolor ); ?>;
}
.site-header .main-navigation ul li ul li:hover {
	background-color: <?php echo esc_html( $submenu_hover_bgcolor ); ?>;
}
.site-header .main-navigation ul li ul li a {
	font-family: <?php echo esc_html( $submenu_typo['font-family'] ); ?>, sans-serif;
	font-size : <?php echo esc_html( $submenu_typo['font-size'] ); ?>;
	font-weight : <?php echo esc_html( $submenu_typo['font-weight'] ); ?>;
	line-height : <?php echo esc_html( $submenu_typo['line-height'] ); ?>;
	color: <?php echo esc_html( $submenu_color ); ?>;
	text-transform : <?php echo esc_html( $submenu_typo['text-transform'] ); ?>;
	font-style: <?php echo empty( $submenu_typo['font-style'] ) ? 'normal' : $submenu_typo['font-style']; ?>;
}
.site-header .main-navigation ul li ul li:hover > a {
	color: <?php echo esc_html( $submenu_hover_color ); ?>;
}

<?php // Sticky Menu ?>
#sticky-header-wrapper .site-header {
	border-color: <?php echo esc_html( $primary_color ); ?>
}

<?php // Multi Column Menu ?>
.site-header .main-navigation ul li.mega-menu > ul.sub-menu {
	background-color: <?php echo esc_html( $submenu_bgcolor ); ?>
}
.site-header .main-navigation ul li.mega-menu ul.sub-menu li a {
	color: <?php echo esc_html( $submenu_color ); ?>
}
.site-header .main-navigation ul li.mega-menu ul.sub-menu li a:hover {
	background-color: <?php echo esc_html( $submenu_hover_bgcolor ); ?>;
	color: <?php echo esc_html( $submenu_hover_color ); ?>;
}

<?php // Mean Menu ?>
.mean-container a.meanmenu-reveal,
.mean-container .mean-nav ul li a.mean-expand {
	color: <?php echo esc_html( $menu_hover_color ); ?>;
}
.mean-container a.meanmenu-reveal span {
	background-color: <?php echo esc_html( $menu_hover_color ); ?>;
}
.mean-container .mean-bar {
	border-color: <?php echo esc_html( $menu_hover_color ); ?>;
}
.mean-container .mean-nav ul li a {
	font-family: <?php echo esc_html( $resmenu_typo['font-family'] ); ?>, sans-serif;
	font-size : <?php echo esc_html( $resmenu_typo['font-size'] ); ?>;
	font-weight : <?php echo esc_html( $resmenu_typo['font-weight'] ); ?>;
	line-height : <?php echo esc_html( $resmenu_typo['line-height'] ); ?>;
	color: <?php echo esc_html( $menu_color ); ?>;
	text-transform : <?php echo esc_html( $resmenu_typo['text-transform'] ); ?>;
	font-style: <?php echo empty( $resmenu_typo['font-style'] ) ? 'normal' : $resmenu_typo['font-style']; ?>;
}
.mean-container .mean-nav ul li a:hover,
.mean-container .mean-nav > ul > li.current-menu-item > a {
	color: <?php echo esc_html( $menu_hover_color ); ?>;
}

body .mean-container .mean-nav ul li.mean-append-area .rtin-append-inner a.header-menu-btn {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
	border-color: <?php echo esc_html( $secondery_color ); ?>;
	color: <?php echo esc_html( $primary_color );?>;
}

<?php // Header icons ?>
.header-icon-area .cart-icon-area .cart-icon-num {
	background-color: <?php echo esc_html( $menu_hover_color );?>;
}
.site-header .search-box .search-text {
	border-color: <?php echo esc_html( $menu_hover_color );?>;
}

<?php // Header Layout 3 ?>
.header-style-3 .header-social li a:hover,
.header-style-3.trheader .header-social li a:hover {
	color: <?php echo esc_html( $menu_hover_color );?>;
}
.header-style-3.trheader .header-contact li a,
.header-style-3.trheader .header-social li a {
	color: <?php echo esc_html( $menu_color_tr ); ?>;
}

<?php // Header Layout 4 ?>
.header-style-4 .header-social li a:hover {
	color: <?php echo esc_html( $menu_hover_color );?>;
}
.header-style-4.trheader .header-contact li a,
.header-style-4.trheader .header-social li a {
	color: <?php echo esc_html( $menu_color_tr ); ?>;
}

<?php // Header Layout 5 ?>
.header-style-5 .header-menu-btn {
	background-color: <?php echo esc_html( $primary_color );?>;
}
.trheader.header-style-5 .header-menu-btn {
	color: <?php echo esc_html( $menu_color_tr ); ?>;
}

<?php // Header Layout 6 ?>
.header-style-6 .site-header,
.header-style-6 #sticky-header-wrapper .site-header {
	background-color: <?php echo esc_html( $primary_color );?>;
}
.header-style-6 .site-header a.header-menu-btn {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
	border-color: <?php echo esc_html( $secondery_color ); ?>;
	color: <?php echo esc_html( $primary_color ); ?>;
}
.header-style-6 .site-header .main-navigation ul.menu > li > a {
	color: <?php echo esc_html( $menu_color_alt ); ?>;
}

<?php // Header Layout 7 ?>
.header-style-7 .header-social a:hover {
    color: <?php echo esc_html( $primary_color ); ?>;
}
.header-style-7 a.header-menu-btn {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.header-style-7.trheader .header-social li a:hover {
    color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*-------------------------------------
#. Banner
---------------------------------------*/
?>
.entry-banner .entry-banner-content h1 {
	color: <?php echo esc_html( RDTheme::$options['banner_heading_color'] );?>;
}
.breadcrumb-area .entry-breadcrumb span a,
.breadcrumb-area .entry-breadcrumb span a span {
	color: <?php echo esc_html( RDTheme::$options['breadcrumb_link_color'] );?>;
}
.breadcrumb-area .entry-breadcrumb span a:hover,
.breadcrumb-area .entry-breadcrumb span a:hover span {
	color: <?php echo esc_html( RDTheme::$options['breadcrumb_link_hover_color'] );?>;
}
.breadcrumb-area .entry-breadcrumb {
	color: <?php echo esc_html( RDTheme::$options['breadcrumb_seperator_color'] );?>;
}
.breadcrumb-area .entry-breadcrumb > span {
	color: <?php echo esc_html( RDTheme::$options['breadcrumb_active_color'] );?>;
}

<?php
/*-------------------------------------
#. Footer
---------------------------------------*/
?>
#preloader {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.scrollToTop {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.footer-top-area {
	background-color: <?php echo esc_html( RDTheme::$options['footer_bgcolor'] ); ?>;
}
.footer-top-area .widget > h3 {
	color: <?php echo esc_html( RDTheme::$options['footer_title_color'] ); ?>;
}
.footer-top-area .widget {
	color: <?php echo esc_html( RDTheme::$options['footer_color'] ); ?>;
}
.footer-top-area a:link,
.footer-top-area a:visited,
.footer-top-area widget_nav_menu ul.menu li:before {
	color: <?php echo esc_html( RDTheme::$options['footer_link_color'] ); ?>;
}
.footer-top-area .widget a:hover,
.footer-top-area .widget a:active {
	color: <?php echo esc_html( RDTheme::$options['footer_link_hover_color'] ); ?>;
}
.footer-top-area .search-form input.search-submit {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.footer-top-area .widget_nav_menu ul.menu li:before {
	color: <?php echo esc_html( $secondery_color ); ?>;
}
.footer-bottom-area {
	background-color: <?php echo esc_html( RDTheme::$options['copyright_bgcolor'] ); ?>;
	color: <?php echo esc_html( RDTheme::$options['copyright_color'] ); ?>;
}

<?php
/*-------------------------------------
#. Widgets
---------------------------------------*/
?>
.search-form input.search-submit {
	background-color: <?php echo esc_html( $primary_color ); ?>;
	border-color: <?php echo esc_html( $primary_color ); ?>;
}
.search-form input.search-submit a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.widget ul li a:hover {
	color: <?php echo esc_html( $secondery_color ); ?>;
}
.sidebar-widget-area .widget > h3 {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.sidebar-widget-area .widget > h3:after {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
}
.sidebar-widget-area .widget_tag_cloud a {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.sidebar-widget-area .widget_tag_cloud a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.widget.widget_rdtheme_about ul li a:hover {
	background-color: <?php echo esc_html( $secondery_color ); ?>;
	border-color: <?php echo esc_html( $secondery_color ); ?>;
	color: <?php echo esc_html( $primary_color ); ?>;
}
.widget.widget_rdtheme_info ul li i {
	color: <?php echo esc_html( $secondery_color ); ?>;
}

<?php
/*-------------------------------------
#. Pagination
---------------------------------------*/
?>
.pagination-area ul li a,
.learn-press-pagination ul li a {
	background-color: <?php echo esc_html( $primary_color );?> !important;
}
.pagination-area ul li.active a,
.pagination-area ul li a:hover,
.pagination-area ul li span.current,
.pagination-area ul li .current,
.learn-press-pagination ul li.active a,
.learn-press-pagination ul li a:hover,
.learn-press-pagination ul li span.current,
.learn-press-pagination ul li .current {
	background-color: <?php echo esc_html( $secondery_color );?> !important;
}

<?php
/*-------------------------------------
#. Error 404
---------------------------------------*/
?>
.error-page-area {
    background-color: <?php echo esc_html( RDTheme::$options['error_bodybg'] );?>;
}
.error-page-area .error-page h3 {
	color: <?php echo esc_html( RDTheme::$options['error_text1_color'] );?>;
}
.error-page-area .error-page p {
	color: <?php echo esc_html( RDTheme::$options['error_text2_color'] );?>;
}

<?php
/*------------------------------------
# Buttons
------------------------------------*/
?>
body .rdtheme-button-1,
body .rdtheme-button-1:link {
	color: <?php echo esc_html( $primary_color ); ?>;
}
body .rdtheme-button-1:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
body a.rdtheme-button-2,
body .rdtheme-button-2 {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
body a.rdtheme-button-2:hover,
body .rdtheme-button-2:hover {
	color: <?php echo esc_html( $primary_color );?>;
	background-color: <?php echo esc_html( $secondery_color );?>;
}
body a.rdtheme-button-3,
body .rdtheme-button-3 {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
body a.rdtheme-button-3:hover,
body .rdtheme-button-4:hover {
	color: <?php echo esc_html( $primary_color );?>;
	background-color: <?php echo esc_html( $secondery_color );?>;
}

<?php
/*-------------------------------------
#. Comments
------------------------------------*/
?>
.comments-area h3.comment-title {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.comments-area h3.comment-title:after {
	background-color: <?php echo esc_html( $secondery_color );?>;
}
.comments-area .main-comments .comment-meta .comment-author-name,
.comments-area .main-comments .comment-meta .comment-author-name a {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.comments-area .main-comments .reply-area a {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.comments-area .main-comments .reply-area a:hover {
	background-color: <?php echo esc_html( $secondery_color );?>;
}
#respond .comment-reply-title {
	color: <?php echo esc_html( $primary_color ); ?>;
}
#respond .comment-reply-title:after {
	background-color: <?php echo esc_html( $secondery_color );?>;
}
#respond form .btn-send {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
#respond form .btn-send:hover {
	background-color: <?php echo esc_html( $secondery_color );?>;
}

<?php
/*-------------------------------------
#. Inner Contents
---------------------------------------*/
?>
.entry-header h2.entry-title a,
.entry-header .entry-meta ul li a:hover,
.entry-footer .tags a:hover,
.event-single .event-meta li,
.event-single ul li span i,
.event-single .event-info h3,
.event-single .event-social h3 {
	color: <?php echo esc_html( $primary_color ); ?>;
}

button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.entry-header .entry-thumbnail-area .post-date li:nth-child(odd),
.event-single .event-thumbnail-area #event-countdown .event-countdown-each:nth-child(odd),
.event-single .event-social ul li a,
.instructor-single .rtin-content ul.rtin-social li a:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

.entry-header h2.entry-title a:hover,
.entry-header h2.entry-title a:hover,
.entry-header .entry-meta ul li i,
.event-single .event-meta li i {
	color: <?php echo esc_html( $secondery_color );?>;
}

.bar1::after,
.bar2::after,
.hvr-bounce-to-right:before,
.hvr-bounce-to-bottom:before,
.entry-header .entry-thumbnail-area .post-date li:nth-child(even),
.event-single .event-thumbnail-area #event-countdown .event-countdown-each:nth-child(even),
.event-single .event-social ul li a:hover {
	background-color: <?php echo esc_html( $secondery_color );?>;
}

.ls-bar-timer {
	background-color: <?php echo esc_html( $secondery_color );?>;
	border-bottom-color: <?php echo esc_html( $secondery_color );?>;
}

.instructor-single .rtin-content ul.rtin-social li a:hover {
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

.list-style-1 li {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.list-style-1 li::before {
	color: <?php echo esc_html( $secondery_color );?>;
}

<?php
/*-------------------------------------
#. WooCommerce
---------------------------------------*/
?>
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.rt-woo-nav .owl-custom-nav-title::after,
.rt-woo-nav .owl-custom-nav .owl-prev:hover,
.rt-woo-nav .owl-custom-nav .owl-next:hover,
.woocommerce ul.products li.product .onsale,
.woocommerce span.onsale,
.woocommerce a.added_to_cart,
.woocommerce div.product form.cart .button,
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
p.demo_store,
.woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit[disabled]:disabled:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button[disabled]:disabled:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button[disabled]:disabled:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button[disabled]:disabled:hover,
.woocommerce #respond input#submit.alt,
.woocommerce a.button.alt,
.woocommerce button.button.alt,
.woocommerce input.button.alt {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}

.product-grid-view .view-mode ul li.grid-view-nav a,
.product-list-view .view-mode ul li.list-view-nav a,
.woocommerce ul.products li.product h3 a:hover,
.woocommerce ul.products li.product .price,
.woocommerce div.product p.price,
.woocommerce div.product span.price,
.woocommerce div.product .product-meta a:hover,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
.woocommerce a.woocommerce-review-link:hover,
.woocommerce-message::before,
.woocommerce-info::before {
	color: <?php echo esc_html( $primary_color ); ?>;
}

.woocommerce-message,
.woocommerce-info {
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

.woocommerce .product-thumb-area .overlay {
	background-color: rgba(<?php echo esc_html( $primary_rgb ); ?>, 0.8);
}

.woocommerce .product-thumb-area .product-info ul li a {
	border-color: <?php echo esc_html( $secondery_color );?>;
}
.woocommerce .product-thumb-area .product-info ul li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
	background-color: <?php echo esc_html( $secondery_color );?>;
}

<?php
/*-------------------------------------
#. Plugins
---------------------------------------*/
?>
.contact-us-form .wpcf7-submit:hover {
	background-color: <?php echo esc_html( $secondery_color );?>;
}
.contact-form-2 h3,
.contact-form-2 input[type="submit"]:hover {
	background-color: <?php echo esc_html( $secondery_color );?>;
}