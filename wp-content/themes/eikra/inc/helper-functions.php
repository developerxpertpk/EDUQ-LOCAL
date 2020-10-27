<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.5
 */

if ( !class_exists( 'RDTheme_Helper' ) ) {
	
	class RDTheme_Helper {

		public static function requires( $filename, $dir = false ){
			require_once self::get_file_path( $filename, $dir );
		}

		public static function includes( $filename, $dir = false ){
			include self::get_file_path( $filename, $dir );
		}

		public static function get_file_path( $filename, $dir = false ){
			if ( $dir) {
				$child_file = get_stylesheet_directory() . '/' . $dir . '/' . $filename;

				if ( file_exists( $child_file ) ) {
					$file = $child_file;
				}
				else {
					$file = get_template_directory() . '/' . $dir . '/' . $filename;
				}
			}
			else {
				$child_file = get_stylesheet_directory() . '/inc/' . $filename;

				if ( file_exists( $child_file ) ) {
					$file = $child_file;
				}
				else {
					$file = RDTHEME_INC_DIR . $filename;
				}
			}

			return $file;
		}

		//@rtl
		public static function maybe_rtl( $css ){
			if ( is_rtl() ) {
				return RDTHEME_AUTORTL_URL . $css;
			}
			else {
				return RDTHEME_CSS_URL . $css;
			}
		}

		public static function pagination( $max_num_pages = false ) {
			global $wp_query;

			$max = $max_num_pages ? $max_num_pages : $wp_query->max_num_pages;
			$max = intval( $max );

			/** Stop execution if there's only 1 page */
			if( $max <= 1 ) return;

			$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;

			/**	Add current page to the array */
			if ( $paged >= 1 )
				$links[] = $paged;

			/**	Add the pages around the current page to the array */
			if ( $paged >= 3 ) {
				$links[] = $paged - 1;
				$links[] = $paged - 2;
			}

			if ( ( $paged + 2 ) <= $max ) {
				$links[] = $paged + 2;
				$links[] = $paged + 1;
			}
			include RDTHEME_VIEW_DIR . 'pagination.php';
		}


		public static function comments_callback( $comment, $args, $depth ){
			include RDTHEME_VIEW_DIR . 'comments-callback.php';
		}

		public static function hex2rgb($hex) {
			$hex = str_replace("#", "", $hex);
			if(strlen($hex) == 3) {
				$r = hexdec(substr($hex,0,1).substr($hex,0,1));
				$g = hexdec(substr($hex,1,1).substr($hex,1,1));
				$b = hexdec(substr($hex,2,1).substr($hex,2,1));
			} else {
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
			}
			$rgb = "$r, $g, $b";
			return $rgb;
		}

		public static function filter_social( $args ){
			return ( $args['url'] != '' );
		}

		public static function fonts_url(){
			$fonts_url = '';
			if ( 'off' !== _x( 'on', 'Google fonts - Roboto: on or off', 'eikra' ) ) {
				$fonts_url = add_query_arg( 'family', urlencode( 'Roboto:400,400i,500,500i,700,700i&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );				
			}
			return $fonts_url;
		}

		public static function socials(){
			$rdtheme_socials = array(
				'social_facebook' => array(
					'icon' => 'fa-facebook',
					'url'  => RDTheme::$options['social_facebook'],
				),
				'social_twitter' => array(
					'icon' => 'fa-twitter',
					'url'  => RDTheme::$options['social_twitter'],
				),
				'social_gplus' => array(
					'icon' => 'fa-google-plus',
					'url'  => RDTheme::$options['social_gplus'],
				),
				'social_linkedin' => array(
					'icon' => 'fa-linkedin',
					'url'  => RDTheme::$options['social_linkedin'],
				),
				'social_youtube' => array(
					'icon' => 'fa-youtube',
					'url'  => RDTheme::$options['social_youtube'],
				),
				'social_pinterest' => array(
					'icon' => 'fa-pinterest',
					'url'  => RDTheme::$options['social_pinterest'],
				),
				'social_instagram' => array(
					'icon' => 'fa-instagram',
					'url'  => RDTheme::$options['social_instagram'],
				),
				'social_skype' => array(
					'icon' => 'fa-skype',
					'url'  => RDTheme::$options['social_skype'],
				),
				'social_rss' => array(
					'icon' => 'fa-rss',
					'url'  => RDTheme::$options['social_rss'],
				),
			);
			return array_filter( $rdtheme_socials, array( 'RDTheme_Helper' , 'filter_social' ) );
		}

		public static function nav_menu_args(){
			$rdtheme_pagemenu = false;
			if ( ( is_single() || is_page() ) ) {
				$rdtheme_menuid = get_post_meta( get_the_id(), 'eikra_page_menu', true );
				if ( !empty( $rdtheme_menuid ) && $rdtheme_menuid != 'default' ) {
					$rdtheme_pagemenu = $rdtheme_menuid;
				}
			}
			if ( $rdtheme_pagemenu ) {
				$nav_menu_args = array( 'menu' => $rdtheme_pagemenu,'container' => 'nav' );
			}
			else {
				$nav_menu_args = array( 'theme_location' => 'primary','container' => 'nav', 'fallback_cb' => false );
			}
			return $nav_menu_args;
		}

		public static function has_footer(){
			if ( !RDTheme::$options['footer_area'] ) {
				return false;
			}
			$footer_column = RDTheme::$options['footer_column'];
			for ( $i = 1; $i <= $footer_column; $i++ ) {
				if ( is_active_sidebar( 'footer-'. $i ) ) {
					return true;
				}
			}
			return false;
		}

		public static function custom_sidebar_fields(){
			$sidebar_fields = array();

			$sidebar_fields['sidebar'] = esc_html__( 'Sidebar', 'eikra' );

			$sidebars = get_option( 'eikra_custom_sidebars', array() );
			if ( $sidebars ) {
				foreach ( $sidebars as $sidebar ) {
					$sidebar_fields[$sidebar['id']] = $sidebar['name'];
				}
			}

			return $sidebar_fields;
		}

		public static function get_template( $template, $args = array() ){
			extract( $args );
			$template = '/' . $template . '.php';

			if ( file_exists( get_stylesheet_directory() . $template ) ) {
				$file = get_stylesheet_directory() . $template;
			}
			else {
				$file = get_template_directory() . $template;
			}

			ob_start();
			require $file;
			echo ob_get_clean();
		}

		public static function is_LMS(){
			if ( class_exists( 'LearnPress' ) ) {
				return true;
			}
			else {
				return false;
			}
		}

		public static function instructor_socials(){
			$socials = array(
				'facebook' => array(
					'label' => esc_html__( 'Facebook Link', 'eikra' ),
					'type'  => 'text',
					'icon'  => 'fa-facebook',
				),
				'twitter' => array(
					'label' => esc_html__( 'Twitter Link', 'eikra' ),
					'type'  => 'text',
					'icon'  => 'fa-twitter',
				),
				'linkedin' => array(
					'label' => esc_html__( 'Linkedin Link', 'eikra' ),
					'type'  => 'text',
					'icon'  => 'fa-linkedin',
				),
				'gplus' => array(
					'label' => esc_html__( 'Google Plus Link', 'eikra' ),
					'type'  => 'text',
					'icon'  => 'fa-google-plus',
				),
				'github' => array(
					'label' => esc_html__( 'Github Link', 'eikra' ),
					'type'  => 'text',
					'icon'  => 'fa-github',
				),
				'youtube' => array(
					'label' => esc_html__( 'Youtube Link', 'eikra' ),
					'type'  => 'text',
					'icon'  => 'fa-youtube-play',
				),
				'pinterest' => array(
					'label' => esc_html__( 'Pinterest Link', 'eikra' ),
					'type'  => 'text',
					'icon'  => 'fa-pinterest-p',
				),
				'instagram' => array(
					'label' => esc_html__( 'Instagram Link', 'eikra' ),
					'type'  => 'text',
					'icon'  => 'fa-instagram',
				),
			);
			return $socials;
		}

		public static function minified_css( $css ) {
			/* remove comments */
			$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
			/* remove tabs, spaces, newlines, etc. */
			$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), ' ', $css );
			return $css;
		}

		public static function filter_content( $content ){
			// wp filters
			$content = wptexturize( $content );
			$content = convert_smilies( $content );
			$content = convert_chars( $content );
			$content = wpautop( $content );
			$content = shortcode_unautop( $content );

			// remove shortcodes
			$pattern= '/\[(.+?)\]/';
			$content = preg_replace( $pattern,'',$content );

			// remove tags
			$content = strip_tags( $content );

			return $content;
		}

		public static function get_current_post_content( $post = false ) {
			if ( !$post ) {
				$post = get_post();				
			}
			$content = has_excerpt( $post->ID ) ? $post->post_excerpt : $post->post_content;
			$content = self::filter_content( $content );
			return $content;
		}

		public static function course_excerpt( $limit = 50, $type = 'excerpt' ){
			$post = get_post();
			if ( $type == 'content' ) {
				$content = $post->post_content;
			}
			else {
				$content = has_excerpt( $post->ID ) ? $post->post_excerpt : $post->post_content;
			}
			$content = self::filter_content( $content );
			$content = wp_trim_words( $content, $limit );
			return $content;
		}

		public static function lp_is_archive(){
			if ( !class_exists( 'LearnPress' ) ) {
				return false;
			}
			
			if ( learn_press_is_courses() || learn_press_is_course_tag() || learn_press_is_course_category() || learn_press_is_search() || learn_press_is_course_tax() ) {
				return true;
			}
			return false;
		}

		public static function lp_is_v2(){
			if ( !defined( 'LEARNPRESS_VERSION' ) ) {
				return false;
			}
			if ( version_compare( LEARNPRESS_VERSION, '3.0', '<' ) ) {
				return true;
			}
			return false;
		}

		public static function lp_is_v3(){
			if ( !defined( 'LEARNPRESS_VERSION' ) ) {
				return false;
			}
			if ( version_compare( LEARNPRESS_VERSION, '3.0', '>=' ) ) {
				return true;
			}
			return false;
		}

		public static function course_indexing_text( $total ){
			if ( $total == 0 ) {
				$result = esc_html__( 'There are no available courses!', 'eikra' );
			}
			elseif ( $total == 1 ) {
				$result = esc_html__( 'Showing only one result', 'eikra' );
			}
			else {
				$courses_per_page = apply_filters( 'course_per_page', 9 );
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

		public static function lp_tax_query_obj(){
			global $wp_query;

			$args = array(
				'post_type'      => 'lp_course',
				'posts_per_page' => 1,
			);
			if ( function_exists( 'learn_press_is_course_category' ) && learn_press_is_course_category() ) {
				$term = get_query_var( 'course_category' );
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'course_category',
						'field' => 'slug',
						'terms' => $term,
					)
				);
			}
			if ( function_exists( 'learn_press_is_course_tag' ) && learn_press_is_course_tag() ) {
				$term = get_query_var( 'course_tag' );
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'course_tag',
						'field' => 'slug',
						'terms' => $term,
					)
				);
			}
			
			return new WP_Query( $args );
		}

		public static function lp_get_term_name( $taxonomy ){
			$slug = get_query_var( $taxonomy );
			$term = get_term_by( 'slug', $slug, $taxonomy );
			return $term->name;
		}
	}
}