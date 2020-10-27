<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'RDTheme_Sidebar_Generator' ) ) {

	class RDTheme_Sidebar_Generator {

		public $prefix = RDTHEME_PREFIX;
		public $option_name = null;

		public function __construct() {
			$this->option_name = $this->prefix . '_custom_sidebars';

			add_action( 'sidebar_admin_page', array( $this, 'sidebar_form' ) );
			add_action( 'init' , array( $this, 'register_sidebars' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
			
			add_action( 'wp_ajax_rdtheme_add_sidebar' , array( $this, 'ajax_add_sidebar' ) );
			add_action( 'wp_ajax_rdtheme_remove_sidebar', array( $this, 'ajax_remove_sidebar' ) );
		}

		public function sidebar_form() {
			?>
			<div class="widgets-holder-wrap">
				<div id="rdtheme-new-sidebar" class="widgets-sortables">
					<div class="sidebar-name">
						<div class="sidebar-name-arrow"></div>
						<h2><?php esc_html_e( 'Add New Sidebar', 'eikra' ); ?><span class="spinner"></span></h2>
					</div>
					<div class="sidebar-description">
						<form style="padding:0 7px;" method="POST" action="<?php echo esc_url( admin_url( 'admin-ajax.php?action=rdtheme_add_sidebar' ) );?>">
							<?php wp_nonce_field( 'rdtheme_add_sidebar' ); ?>
							<table class="form-table">
								<tr>
									<th scope="row"><?php esc_html_e( 'Name', 'eikra' ) ?></th>
									<td><input type="text" class="text" name="name" value=""></td>
									<td><input type="submit" class="button-primary" value="<?php esc_html_e( 'Add', 'eikra' ) ?>"></td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>
			<?php
		}

		public function register_sidebars() {
			$sidebars = get_option( $this->option_name, array() );

			if ( !$sidebars ) return;

			foreach ( $sidebars as $sidebar ) {
				register_sidebar( $sidebar );
			}
		}

		public function load_scripts() {
			$screen = get_current_screen();

			if ( $screen->id != 'widgets' ) return;

			wp_enqueue_script( 'admin-sidebar-generator', RDTHEME_JS_URL . 'admin-sidebar-generator.js', array( 'jquery' ), EIKRA_VERSION );

			$localize_data = array(
				'confirm'  => esc_html__( 'Are you sure you want to remove this custom sidebar', 'eikra' ),
				'failed'   => esc_html__( 'Operation failed' , 'eikra' ),
				'ajaxurl'  => admin_url( 'admin-ajax.php?action=rdtheme_remove_sidebar' ),
				'nonce'    => wp_create_nonce( 'rdtheme_remove_sidebar' ),
			);

			wp_localize_script( 'admin-sidebar-generator', 'RDThemeSidebarObj', $localize_data );
		}

		public function ajax_add_sidebar() {
			$name  = isset( $_REQUEST['name'] ) ? sanitize_text_field( $_REQUEST['name'] ) : null;
			$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : null;

			if ( empty( $name ) ) {
				wp_send_json_error( esc_html__( "Sidebar name can't be empty", 'eikra' ) );
			}
			if ( empty( $nonce ) ) {
				wp_send_json_error( esc_html__( 'Empty nonce', 'eikra' ) );
			}
			if ( ! wp_verify_nonce( $nonce, 'rdtheme_add_sidebar' ) ) {
				wp_send_json_error( esc_html__( 'Invalid nonce', 'eikra' ) );
			}

			$id = 'rdtheme-sidebar-' . sanitize_title( $name );
			$sidebars = get_option( $this->option_name, array() );

			if ( array_key_exists( $id, $sidebars ) ) {
				wp_send_json_error( esc_html__( 'Sidebar with the same name already exists. Please choose a different name', 'eikra' ) );
			}

			$sidebars[$id] = array(
				'id'             => $id,
				'name'           => $name,
				'class'          => 'rdtheme-custom',
				'description'    => '',
				'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'   => '</aside>',
				'before_title'   => '<h3 class="widget-title">',
				'after_title'    => '</h3>',
			);

			update_option( $this->option_name, $sidebars );

			if ( ! function_exists( 'wp_list_widget_controls' ) ) {
				include_once ABSPATH . 'wp-admin/includes/widgets.php';
			}

			ob_start();
			?>
			<div class="widgets-holder-wrap sidebar-rdtheme-custom closed">
				<?php wp_list_widget_controls( $id, $name ); ?>
			</div>
			<?php
			wp_send_json_success( ob_get_clean() );
		}

		public function ajax_remove_sidebar() {
			$id    = isset( $_REQUEST['id'] ) ? sanitize_text_field( $_REQUEST['id'] ) : null;
			$nonce = isset( $_REQUEST['_wpnonce'] ) ? sanitize_text_field( $_REQUEST['_wpnonce'] ) : null;

			if ( empty( $id ) ) {
				wp_send_json_error( esc_html__( 'Sidebar ID not found', 'eikra' ) );
			}
			if ( empty( $nonce ) ) {
				wp_send_json_error( esc_html__( 'Empty nonce', 'eikra' ) );
			}
			if ( ! wp_verify_nonce( $nonce, 'rdtheme_remove_sidebar' ) ) {
				wp_send_json_error( esc_html__( 'Invalid nonce', 'eikra' ) );
			}

			$sidebars = get_option( $this->option_name, array() );

			unset( $sidebars[ $id ] );

			update_option( $this->option_name, $sidebars );

			wp_send_json_success();
		}
	}
}

new RDTheme_Sidebar_Generator;