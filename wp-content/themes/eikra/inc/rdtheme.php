<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 3.5
 */

if ( !class_exists( 'RDTheme' ) ) {

	class RDTheme {

		protected static $instance = null;

		// Sitewide static variables
		public static $options = null;
		public static $event_socials = null;
		public static $profile_current_page = null;
		public static $lp_global_script = null;

		// Template specific variables
		public static $layout = null;
		public static $sidebar = null;
		public static $tr_header = null;
		public static $top_bar = null;
		public static $top_bar_style = null;
		public static $header_style = null;
		public static $padding_top = null;
		public static $padding_bottom = null;
		public static $has_banner = null;
		public static $has_breadcrumb = null;
		public static $bgtype = null;
		public static $bgimg = null;
		public static $bgcolor = null;

		private function __construct() {	
			$this->redux_init();
			add_action( 'after_setup_theme', array( $this, 'set_redux_option' ) );
			add_action( 'after_setup_theme', array( $this, 'set_redux_compability_options' ) );
			add_action( 'init', array( $this, 'rewrite_flush_check' ) );
		}

		public static function instance() {
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		public function redux_init() {
			add_action( 'admin_menu', array( $this, 'remove_redux_menu' ), 12 ); // Remove Redux Menu
			add_action( 'redux/loaded', array( $this, 'remove_redux_demo' ) ); // Removes the demo link and the notice
			add_filter( 'redux/eikra/aURL_filter', '__return_empty_string' ); // Remove Redux Ads

			// Flash permalink after options changed
			add_action( 'redux/options/eikra/saved', array( $this, 'flush_redux_saved' ), 10, 2 );
			add_action( 'redux/options/eikra/section/reset', array( $this, 'flush_redux_reset' ) );
			add_action( 'redux/options/eikra/reset', array( $this, 'flush_redux_reset' ) );
		}

		public function set_redux_option(){
			if ( ! class_exists( 'Redux' ) ) {
				include RDTHEME_INC_DIR . 'redux-data.php';
				self::$options = json_decode( $rdtheme_redux_data, true );
				return;
			}		
			global $eikra;
			self::$options = $eikra ? $eikra : array();

			// Prevent Redux first activation error on admin
			if ( is_admin() && count( self::$options ) < 3 ) {
				include RDTHEME_INC_DIR . 'redux-data.php';
				self::$options = json_decode( $rdtheme_redux_data, true );
			}
		}

		// Backward compability for newly added options
		public function set_redux_compability_options(){
			$new_options = array(
				'event_time_format' => '24',
				'payment_img'       => false,
				'course_price_hide' => false,
				'course_meta'       => array(
					'ins' => '1', 
					'lec' => '1', 
					'qz'  => '1',
					'stu' => '1',
					'dur' => '1',
				),
				'course_cats'       => true,
				'course_tags'       => true,
				'course_curriculum' => true,
				'course_instructor' => true,
				'course_review'     => true,
				'course_related'    => true,
				'course_sidebar'    => true,
				'course_progress'   => true,
				'course_price'      => true,
				'course_rating'     => true,
			);

			foreach ( $new_options as $key => $value ) {
				if ( !isset( self::$options[$key] ) ) {
					self::$options[$key] = $value;
				}
			}
		}

		public function remove_redux_menu() {
			remove_submenu_page('tools.php','redux-about');
		}

		public function remove_redux_demo(){
			if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
				add_filter( 'plugin_row_meta', array( $this, 'redux_remove_extra_meta' ), 12, 2 );
				remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
			}
		}

		public function redux_remove_extra_meta( $links, $file ){
			if ( strpos( $file, 'redux-framework.php' ) !== false ) {
				$links = array_slice( $links, 0, 3 );
			}

			return $links;
		}

		// Flush rewrites
		public function flush_redux_saved( $saved_options, $changed_options ){
			if ( empty( $changed_options ) ) {
				return;
			}
			$flush = false;
			$slugs = array( 'research_slug', 'event_slug', 'course_slug', 'instructor_slug' );
			foreach ( $slugs as $slug ) {
				if ( array_key_exists( $slug, $changed_options ) ) {
					$flush = true;
				}
			}

			if ( $flush ) {
				update_option( 'eikra_rewrite_flash', true );
			}
		}

		public function flush_redux_reset(){
			update_option( 'eikra_rewrite_flash', true );
		}

		public function rewrite_flush_check() {
			if ( get_option('eikra_rewrite_flash') == true ) {
				flush_rewrite_rules();
				update_option( 'eikra_rewrite_flash', false );
			}
		}
	}
}

RDTheme::instance();

// Remove Redux NewsFlash
if ( ! class_exists( 'reduxNewsflash' ) ){
	class reduxNewsflash {
		public function __construct( $parent, $params ) {}
	}
}