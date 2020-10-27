<?php
/**
 * Template for displaying user profile cover image.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/profile/profile-cover.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile = LP_Profile::instance();
$user = $profile->get_user();

if ( $user->is_instructor() ) {
	$instructor_info = get_the_author_meta( 'rt_lp_instructor_info', $user->get_id() );
	$socials = isset( $instructor_info['socials'] ) ? $instructor_info['socials'] : array();
	$socials = array_filter( $socials );
	$socials_fields = RDTheme_Helper::instructor_socials();
}
?>
<div class="rdtheme-lp-profile-header">
	<div class="rtin-item clearfix">
		<div class="rtin-left">
			<div class="rtin-overlay"></div>
			<?php echo wp_kses_post( $user->get_profile_picture( '', 140 ) ); ?>
		</div>
		<div class="rtin-right">
			<h3 class="rtin-name"><?php echo esc_html( $user->get_display_name() ); ?></h3>
			<?php if ( $user->is_instructor() && !empty( $instructor_info['designation'] ) ) : ?>
				<div class="rtin-designation"><?php echo esc_html( $instructor_info['designation'] ); ?></div>
			<?php endif; ?>
			<?php if ( !empty( $socials ) ) : ?>
				<ul class="rtin-social">
					<?php foreach ( $socials as $key => $value ): ?>
						<li><a href="<?php echo esc_url(  $value ); ?>" target="_blank"><i class="fa <?php echo esc_attr( $socials_fields[$key]['icon'] ); ?>"></i></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>		
	</div>
	<?php if ( $user->get_id() == learn_press_get_current_user_id() ): ?>
		<div class="rtin-logout"><a href="<?php echo esc_url( $profile->logout_url() );?>"><i class="fa fa-user-o" aria-hidden="true"></i><?php esc_html_e( 'Sign Out', 'eikra' ) ?></a></div>
	<?php endif ?>
</div>