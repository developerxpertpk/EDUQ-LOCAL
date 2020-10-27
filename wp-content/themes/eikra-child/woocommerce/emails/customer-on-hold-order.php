<?php
/**
 * Customer on-hold order email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-on-hold-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.5.0
 */
if (!defined('ABSPATH')) {
    exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action('woocommerce_email_header', $email_heading, $email);
?>

<?php /* translators: %s: Customer first name */ ?>
<p><?php _e('Bedankt voor uw inschrijving en hierbij ontvangt u de gegevens van uw bestelling.<br/>Wij zullen u spoedig een factuur sturen.', 'woocommerce'); ?></p><?php // phpcs:ignore WordPress.XSS.EscapeOutput  ?>

<?php
global $woocommerce;



if (!empty($woocommerce->session)) {
    $subscription = $woocommerce->session->get('subscription');
    $course = $subscription['course'];
    $cursists = $woocommerce->session->get('info_cursists');
    // print_r($cursists);
    $type = array(0 => "Particulier", 1 => "Zakelijk");
}
?>
<?php
if (isset($course) && !empty($course)) {
    $coursedata = explode(' - ', $course);
    $coursetitle = explode('- ', $coursedata[1]);
    ?>
    Deze opleiding is gepland op <strong><?= $coursedata[0] ?></strong>, <strong>adres: <?= $coursetitle[1] ?></strong><br/>
    <br />
    <?php
}
?>

<?php
/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action('woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email);

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action('woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email);

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */
do_action('woocommerce_email_customer_details2', $order, $sent_to_admin, $plain_text, $email);
?>
<?php
/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action('woocommerce_email_footer', $email);
