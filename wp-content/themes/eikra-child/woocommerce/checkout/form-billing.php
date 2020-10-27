<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */
defined('ABSPATH') || exit;
?>
<div class="woocommerce-billing-fields">
    <?php if (wc_ship_to_billing_address_only() && WC()->cart->needs_shipping()) : ?>

        <h3><?php esc_html_e('Billing &amp; Shipping', 'woocommerce'); ?></h3>

    <?php else : ?>

    <?php endif; ?>

    <?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

    <div class="woocommerce-billing-fields__field-wrapper">
        <?php
        global $woocommerce;
        $subscription = $woocommerce->session->get('subscription');
        $fields = $checkout->get_checkout_fields('billing');
        $noCursists = $subscription['noCursists'];
        $subscription_companyname = $subscription['companyname'];
//        echo $subscription_middlename = $subscription['middlename'];
        ?>
        <div class="customer-info">
            <div class="cs-form-row">
                <div class="col-md-12">
                    <h3 class="field-heading"><?php _e('Factuurgegevens', 'woocommerce'); ?></h3>
                </div>
            </div>
            <?php if (!empty($subscription_companyname)) { ?>
                <div class="cs-form-row">
                    <div class="vc_col-sm-12">
                        <?php
                        woocommerce_form_field('billing_company', $fields ['billing_company'], $checkout->get_value('billing_company'));
                        ?>
                    </div>
                </div>
            <?php } ?>
            <div class="cs-form-row c-fullname">
                <div class="vc_col-sm-6">
                    <?php
                    woocommerce_form_field('billing_first_name', $fields ['billing_first_name'], $checkout->get_value('billing_first_name'));
                    ?>
                </div>
<!--                <div class="vc_col-sm-4">
                    <p class="form-row form-row-first validate-required" id="billing_first_name_field" data-priority="74">
                        <label for="billing_middle_name" class="">Tussenv.&nbsp;</label>
                        <span class="woocommerce-input-wrapper">
                            <input type="hidden" class="input-text " name="billing_middle_name" id="billing_middle_name" placeholder="Tussenv." value="<?php echo $subscription['middlename'] ?>">
                        </span>
                    </p>
                </div>-->
                <div class="vc_col-sm-6">
                    <?php
                    woocommerce_form_field('billing_last_name', $fields ['billing_last_name'], $checkout->get_value('billing_last_name'));
                    ?>
                </div>
            </div>


            <div class="cs-form-row">
                <div class="vc_col-sm-6">
                    <?php
                    woocommerce_form_field('billing_street', $fields ['billing_street'], $checkout->get_value('billing_street'));
                    ?>
                </div>
                <div class="vc_col-sm-6">
                    <?php
                    woocommerce_form_field('billing_housenumber', $fields ['billing_housenumber'], $checkout->get_value('billing_housenumber'));
                    ?>
                </div>
            </div>
            <div class="cs-form-row">
                <div class="vc_col-sm-6">
                    <?php
                    woocommerce_form_field('billing_postcode', $fields ['billing_postcode'], $checkout->get_value('billing_postcode'));
                    ?>
                </div>
                <div class="vc_col-sm-6">
                    <?php
                    woocommerce_form_field('billing_city', $fields ['billing_city'], $checkout->get_value('billing_city'));
                    ?>
                </div>
                <div class="vc_col-sm-6 hidden">
                    <?php
                    $countries_obj = new WC_Countries();
                    $countries = $countries_obj->__get('countries');
                    echo '<label for="billing_country" class="">' . __('Countries') . '&nbsp;<abbr class="required" title="required">*</abbr></label>';
                    echo '<span class="woocommerce-input-wrapper">';
//                    woocommerce_form_field('billing_country', array(
//                        'type' => 'select',
//                        'class' => array('input-text'),
//                        'placeholder' => __('Enter something'),
//                        'options' => $countries,
//                        'default' => $checkout->get_value('billing_country')
//                            )
//                    );
                    echo '</span>';
                    ?>
                </div>
            </div>
            <div class="cs-form-row">
                <div class="vc_col-sm-6">
                    <?php
                    woocommerce_form_field('billing_phone',$fields ['billing_phone'], $checkout->get_value('billing_phone'));
                    ?>
                </div>
                <div class="vc_col-sm-6">
                    <?php
                    woocommerce_form_field('billing_email', $fields ['billing_email'], $checkout->get_value('billing_email'));
                    ?>
                </div>
            </div> 
        </div>
        <div class="participants-info">
            <div class="cs-form-row">
                <div class="col-md-12">
                    <h3 class="field-heading"><?php _e('Cursist(en) gegevens', 'woocommerce'); ?></h3>
                </div>
            </div>
            <input type="hidden" class="input-text " name="billing_noCursists" id="billing_noCursists" value="<?php echo $noCursists; ?>"  > 
            <?php
            for ($Cursists = 1; $Cursists <= $noCursists; $Cursists++) {
                ?>
                <div id="participant-<?php echo $Cursists; ?>" class="participant-info">
                    <div class="cs-form-row">
                        <div class="col-md-12 formsubheader">
                            <h5 class=""><?php _e('Deelnemer ' . $Cursists, 'woocommerce'); ?></h5>
                        </div>
                    </div>
                    <div class="cs-form-row c-fullname">
                        <?php
                  
                        $cursist_full_name = array('firstname_cursist' . $Cursists,  'lastname_cursist' . $Cursists);
                        for ($index = 0; $index <= 1; $index++) {
                            $key = $cursist_full_name[$index];
                            $field = $fields [$key];
                            echo ' <div class="vc_col-sm-6">';
                            woocommerce_form_field($key, $field, $checkout->get_value($key));
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="cs-form-row">
                        <div class="vc_col-sm-6 participants-birthplace">
                            <?php
                            $birtplacekey = 'placeofbrith_cursist' . $Cursists;
                            $birtplacefield = $fields [$birtplacekey];
                            woocommerce_form_field($birtplacekey, $birtplacefield, $checkout->get_value($birtplacekey));
                            ?>
                        </div>
                        <div class="vc_col-sm-6 participants-dob">
                            <?php
                            $birtdatekey = 'birtdate_cursist' . $Cursists;
                            $birtdatefield = $fields [$birtdatekey];
                            woocommerce_form_field($birtdatekey, $birtdatefield, $checkout->get_value($birtdatekey));
                            ?>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
    <?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
</div>

<?php if (!is_user_logged_in() && $checkout->is_registration_enabled()) : ?>
    <div class="woocommerce-account-fields">
        <?php if (!$checkout->is_registration_required()) : ?>

            <p class="form-row form-row-wide create-account">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked(( true === $checkout->get_value('createaccount') || ( true === apply_filters('woocommerce_create_account_default_checked', false) )), true); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e('Create an account?', 'woocommerce'); ?></span>
                </label>
            </p>

        <?php endif; ?>

        <?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

        <?php if ($checkout->get_checkout_fields('account')) : ?>

            <div class="create-account">
                <?php foreach ($checkout->get_checkout_fields('account') as $key => $field) : ?>
                    <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
                <?php endforeach; ?>
                <div class="clear"></div>
            </div>

        <?php endif; ?>

        <?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
    </div>
<?php endif; ?>