<?php
class Eikra_Core_Plugin_Hooks  {

	protected static $instance = null;

	private function __construct() {
		add_action( 'after_setup_theme', array( $this, 'init' ), 3 );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function init() {
		$this->learnpress_init();
		$this->vc_init();
		$this->layerslider_init();
	}

	public function learnpress_init() {
		if ( is_admin() && current_user_can( 'lp_teacher' ) && !current_user_can( 'administrator' ) ) {
			add_action( 'add_admin_bar_menus', array( $this, 'rdtheme_lp_instructor_admin_bar_menu' ) ); // hide some admin bar menus in Instructor backend
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'lp_enqueue_scripts' ), 1501 );
	}

	public function rdtheme_lp_instructor_admin_bar_menu(){
		remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );
		remove_action( 'admin_bar_menu', 'wp_admin_bar_new_content_menu', 70 );
		remove_action( 'admin_bar_menu', 'wp_admin_bar_edit_menu', 80 );
	}

	public function lp_enqueue_scripts(){
		$css = '@media all and (max-width: 767px) {	html #wpadminbar {position: fixed;} }';
		wp_add_inline_style( 'eikra-learnpress', $css );
	}
	
	public function vc_init() {
		if ( function_exists('vc_updater') ) {
			remove_filter( 'upgrader_pre_download', array( vc_updater(), 'preUpgradeFilter' ), 10);
			remove_filter( 'pre_set_site_transient_update_plugins', array( vc_updater()->updateManager(), 'check_update' ) );
		}
	}

	public function layerslider_init() {

		if( function_exists( 'layerslider_set_as_theme' ) ) {
			layerslider_set_as_theme();
		}

		if( function_exists( 'layerslider_hide_promotions' ) ) {
			layerslider_hide_promotions();
		}

		add_action( 'admin_init', array( $this, 'layerslider_disable_plugin_notice' ) ); // Remove LayerSlider purchase notice from plugins page

		$this->fix_layerslider_tgm_compability(); // Fix issue of Layerslider update via TGM
	}

	public function layerslider_disable_plugin_notice() {
		if ( defined( 'LS_PLUGIN_BASE' ) ) {
			remove_action( 'after_plugin_row_' . LS_PLUGIN_BASE, 'layerslider_plugins_purchase_notice', 10, 3 );
		}
	}

	public function fix_layerslider_tgm_compability(){
		if ( !is_admin() || !apply_filters( 'rdtheme_disable_layerslider_autoupdate', true ) || get_option( 'layerslider-authorized-site' ) ) return;

		global $LS_AutoUpdate;
		if ( isset( $LS_AutoUpdate ) && defined( 'LS_ROOT_FILE' ) ) {
			remove_filter( 'pre_set_site_transient_update_plugins', array( $LS_AutoUpdate, 'set_update_transient' ) );
			remove_filter( 'plugins_api', array( $LS_AutoUpdate, 'set_updates_api_results'), 10, 3 );
			remove_filter( 'upgrader_pre_download', array( $LS_AutoUpdate, 'pre_download_filter' ), 10, 4 );
			remove_filter( 'in_plugin_update_message-'.plugin_basename( LS_ROOT_FILE ), array( $LS_AutoUpdate, 'update_message' ) );
			remove_filter( 'wp_ajax_layerslider_authorize_site', array( $LS_AutoUpdate, 'handleActivation' ) );
			remove_filter( 'wp_ajax_layerslider_deauthorize_site', array( $LS_AutoUpdate, 'handleDeactivation' ) );
		}
	}
}

Eikra_Core_Plugin_Hooks::instance();

// Course search page
add_filter( 'pre_get_posts', 'eikra_core_rdtheme_filter_course_search_by_category', 99 );
function eikra_core_rdtheme_filter_course_search_by_category( $q ) {
	if ( $q->is_main_query() && ( ! empty( $_REQUEST['ref'] ) && $_REQUEST['ref'] == 'course' ) && ! empty( $_REQUEST['refcat'] ) ) {
		$cat = intval( $_REQUEST['refcat'] );
		$taxquery = array(
			array(
				'taxonomy' => 'course_category',
				'field' => 'term_id',
				'terms' => array( $cat ),
			)
		);
		$q->set( 'tax_query', $taxquery );
		remove_filter( 'pre_get_posts', 'rdtheme_filter_course_search_by_category', 99 );
	}
}