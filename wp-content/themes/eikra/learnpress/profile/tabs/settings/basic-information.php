<?php
/**
 * Template for displaying editing basic information form of user in profile page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/settings/tabs/basic-information.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile = LP_Profile::instance();

if ( ! isset( $section ) ) {
	$section = 'basic-information';
}

$user    = $profile->get_user();
$user_id = $profile->get_user_data( 'id' );

$user_meta   = get_the_author_meta( 'rt_lp_instructor_info', $user_id );
$designation = isset( $user_meta['designation'] ) ? $user_meta['designation'] : '';
?>

<form method="post" id="learn-press-profile-basic-information" name="profile-basic-information"
enctype="multipart/form-data" class="learn-press-form">

<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/before-profile-basic-information-fields', $profile );

	?>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <ul class="form-fields">

              <?php
                /**
                 * @since 3.0.0
                 */
                do_action( 'learn-press/begin-profile-basic-information-fields', $profile );

                // @deprecated
                do_action( 'learn_press_before_' . $section . '_edit_fields' );
                ?>

                <li class="form-field">
                    <label for="first_name"><?php esc_html_e( 'First Name', 'eikra' ); ?></label>
                    <div class="form-field-input">
                        <input type="text" name="first_name" id="first_name"
                        value="<?php echo esc_attr( $user->get_data( 'first_name' ) ); ?>"
                        class="regular-text">
                    </div>
                </li>
                <li class="form-field">
                    <label for="last_name"><?php esc_html_e( 'Last Name', 'eikra' ); ?></label>
                    <div class="form-field-input">
                        <input type="text" name="last_name" id="last_name"
                        value="<?php echo esc_attr( $user->get_data( 'last_name' ) ); ?>"
                        class="regular-text">
                    </div>
                </li>
                <?php
                if ( user_can( $user_id, LP_TEACHER_ROLE ) ) {
                    rdtheme_lp_user_textfield_forntend( esc_html__( 'Designation', 'eikra' ), 'rt_lp_instructor_info[designation]', $designation );
                }
                ?>
                <li class="form-field">
                    <label for="nickname"><?php esc_html_e( 'Nickname', 'eikra' ); ?></label>
                    <div class="form-field-input">
                        <input type="text" name="nickname" id="nickname"
                        value="<?php echo esc_attr( $user->get_data( 'nickname' ) ) ?>"
                        class="regular-text"/>
                    </div>
                </li>
                <li class="form-field">
                    <label for="display_name"><?php esc_html_e( 'Display name publicly as', 'eikra' ); ?></label>
                    <div class="form-field-input">
                        <?php learn_press_profile_list_display_names(); ?>
                    </div>
                </li>
                <li class="form-field">
                    <label for="description"><?php esc_html_e( 'Biographical Info', 'eikra' ); ?></label>
                    <div class="form-field-input">
                        <textarea name="description" id="description" rows="5"
                        cols="30"><?php echo wp_kses_post( $user->get_data( 'description' ) ); ?></textarea>
                        <p class="description"><?php esc_html_e( 'Share a little biographical information to fill out your profile. This may be shown publicly.', 'eikra' ); ?></p>
                    </div>
                </li>
                <?php
                // @deprecated
                do_action( 'learn_press_after_' . $section . '_edit_fields' );

                /**
                 * @since 3.0.0
                 */
                do_action( 'learn-press/end-profile-basic-information-fields', $profile );

                ?>
            </ul>           
        </div>
        <div class="col-sm-6 col-xs-12">
            <ul class="form-fields"><?php rdtheme_lp_instructor_social_fields_frontend();?></ul>
        </div>
    </div>


    <?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/after-profile-basic-information-fields', $profile );
	?>

    <p>
        <input type="hidden" name="save-profile-basic-information"
        value="<?php echo wp_create_nonce( 'learn-press-save-profile-basic-information' ); ?>"/>
    </p>

    <button type="submit" name="submit"><?php esc_html_e( 'Save Changes', 'eikra' ); ?></button>

</form>