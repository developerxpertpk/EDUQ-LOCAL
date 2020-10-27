<?php
add_action('wp_enqueue_scripts', 'eikra_child_course_script', 19);

function eikra_child_course_script() {
    wp_enqueue_script('custome-courses-script', get_stylesheet_directory_uri() . '/js/custom.js', array(), '', true);
}

function getCourses($product = null) {
    global $wpdb;
    $table_name = $wpdb->prefix . "courses";

    if (!empty($product)) {
//        $rows = $wpdb->get_results("SELECT location,date from $table_name WHERE course=" . $product . " AND date <= " . time());
        // echo "SELECT * from ".$table_name." WHERE course=". $product .'"';
        $rows = $wpdb->get_results("SELECT * from " . $table_name . " WHERE course=" . $product);
    } else {
        $rows = $wpdb->get_results("SELECT location,date from $table_name AND date >= " . time());
    }

    // print '<pre>';
    // print_r($rows);
    // exit;
    return $rows;
}
?>

<?php
add_action('init', 'courses_subscription_redirect');

function courses_subscription_redirect() {
    if (!is_admin()) {
        global $woocommerce;
        if (isset($_POST['eventform']) && $_POST['eventform'] == 1) {
            $woocommerce->session->set('subscription', $_POST);
            $noCursists = $_POST['noCursists'];
            $product_id = $_POST['courseid'];
            $woocommerce->cart->add_to_cart($product_id, $noCursists);
        }
    }
}

function cloudways_save_extra_checkout_fields($order_id, $posted) {
    $adress = $posted['billing_street'] . ' ' . $posted['billing_housenumber'];
    update_post_meta($order_id, '_billing_address_1', $adress);
}

add_action('woocommerce_checkout_update_order_meta', 'cloudways_save_extra_checkout_fields', 10, 2);
add_action('wp_loaded', 'redirect');

function redirect() {
    if (isset($_POST['eventform']) && $_POST['eventform'] == 1) {
        $url = get_permalink(get_option('woocommerce_checkout_page_id'));
        header('Location:' . $url);
        exit();
    }
}

// WooCommerce Rename Checkout Fields
add_filter('woocommerce_checkout_fields', 'custom_rename_wc_checkout_fields');

// Change placeholder and label text
function custom_rename_wc_checkout_fields($fields) {
    $fields['billing']['billing_first_name']['placeholder'] = 'Voorletters';
    $fields['billing']['billing_first_name']['label'] = 'Voorletters';
    $fields['billing']['billing_middlename_name'] = array(
        'label' => __('Tussenv.', 'woocommerce'),
        'required' => false,
    );
    $fields['billing']['billing_last_name']['placeholder'] = 'Achternaam';
    $fields['billing']['billing_last_name']['label'] = 'Achternaam';
    $fields['billing']['billing_phone']['placeholder'] = 'Telefoon';
    $fields['billing']['billing_phone']['label'] = 'Telefoon';
    $fields['billing']['billing_company']['placeholder'] = 'Bedrijfsnaam';
    $fields['billing']['billing_company']['label'] = 'Bedrijfsnaam';
    $fields['billing']['billing_postcode']['placeholder'] = 'Postcode';
    $fields['billing']['billing_postcode']['label'] = 'Postcode';
    $fields['billing']['billing_city']['placeholder'] = 'Plaats';
    $fields['billing']['billing_city']['label'] = 'Plaats';
    return $fields;
}

add_filter('woocommerce_checkout_fields', 'override_checkoutfields');

function override_checkoutfields($fields) {
    global $woocommerce;

    $subscription = $woocommerce->session->get('subscription');


    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['account']);
    unset($fields['billing']['billing_address_1']);

    $fields['billing']['billing_postcode']['required'] = true;
    $fields['billing']['billing_address_1']['required'] = false;
    $fields['billing']['billing_city']['required'] = true;




    $fields['billing']['billing_company']['default'] = $subscription['companyname'];
    if ($subscription['iscompany'] != '1') {
        unset($fields['billing']['billing_company']);
        $fields['order']['order_comments']['default'] = 'Klant is ' . $type[$subscription['iscompany']] . ' en wil de opleiding ' . $subscription['course'];
    } else {

        $fields['order']['order_comments']['default'] = 'Klant is ' . $type[$subscription['iscompany']] . ' met de branche ' . $subscription['course'] . ' en wil de opleiding ' . $subscription['course'];
    }

    $type = array(0 => "Particulier", 1 => "Zakelijk");

    $fields['billing']['billing_email']['default'] = $subscription['email'];
    $fields['billing']['billing_first_name']['default'] = $subscription['firstname'];

    $fields['billing']['billing_middlename_name']['default'] = $subscription['middlename'];

    $fields['billing']['billing_last_name']['default'] = $subscription['lastname'];
    //$fields['billing']['billing_address_1']['default'] = $subscription['address'];
    $fields['billing']['billing_postcode']['default'] = $subscription['zip'];
    $fields['billing']['billing_phone']['default'] = $subscription['phone'];
    $fields['billing']['billing_city']['default'] = $subscription['city'];

    if ($subscription['iscompany'] == '1') {
        $fields['billing']['billing_company']['required'] = true;
        $fields['billing']['billing_company']['default'] = $subscription['companyname'];
    }

    $fields['order']['order_comments']['default'] = 'Klant is ' . $type[$subscription['iscompany']] . ' en wil de opleiding ' . $subscription['course'];


    $noCursists = $subscription['noCursists'];
    $cursists = array();
    for ($i = 1; $i <= $noCursists; $i++) {
        $cursists[$i]['name'] = $subscription['firstname_cursist' . $i] . ' ' . $subscription['middlename_cursist' . $i] . ' ' . $subscription['lastname_cursist' . $i];
        $cursists[$i]['bsn'] = $subscription['BSN_cursist' . $i];
        $cursists[$i]['placeofbirth'] = $subscription['placeofbrith_cursist' . $i];
        $cursists[$i]['birthdata'] = $subscription['birtdate_cursist' . $i];
        //$cursists .= " Deelnemer".$i.": Naam:".$name." BSN: ".$bsn." geboorteplaats :".$placeofbrith." geboortedatum: ".$birtdate."<br/>";  
    }

    $woocommerce->session->set('info_cursists', $cursists);
    unset($fields['order']['order_comments']);
    if (!is_null($survey_email)) {
        $fields['billing']['billing_email']['default'] = 'gerardvanhattem@live.nl';
    }

    $fields['billing']['billing_street'] = array(
        'label' => __('Straat', 'woocommerce'),
        'placeholder' => _x('Straat', 'placeholder', 'woocommerce'),
        'required' => true,
        'class' => array('form-row-first'),
        'clear' => true
    );

    $fields['billing']['billing_housenumber'] = array(
        'label' => __('Huisnummer', 'woocommerce'),
        'placeholder' => _x('Huisnummer', 'placeholder', 'woocommerce'),
        'required' => true,
        'class' => array('form-row-first'),
        'clear' => true
    );

    $fields['billing']['noCursists']['default'] = $noCursists;

    /* Rendering settings */
    $fields['billing']['billing_email']['class'][0] = "form-row-first";
    $fields['billing']['billing_postcode']['class'][0] = "form-row-first";
    $fields['billing']['billing_phone']['class'][0] = "form-row-first";
    $fields['billing']['billing_city']['class'][0] = "form-row-first";
    $fields['billing']['billing_last_name']['class'][0] = "form-row-first";
    $fields['billing']['billing_street']['priority'] = 111;
    $fields['billing']['billing_housenumber']['priority'] = 112;
    $fields['billing']['billing_city']['priority'] = 63;

    unset($fields['billing']['billing_address_1']);


    $order = array(
        "billing_first_name",
        "billing_last_name",
        "billing_street",
        "billing_housenumber",
        "billing_postcode",
        "billing_city",
        "billing_phone",
        "billing_email",
    );

    if ($subscription['iscompany'] == '1') {
        $order[] = 'billing_company';
        array_unshift($order, 'billing_company');
    }


    foreach ($order as $field) {
        $ordered_fields[$field] = $fields["billing"][$field];
    }
    $fields["billing"] = $ordered_fields;

    return $fields;
}

function getFormCursist() {
    $number = $_POST['number'];
    $noCursist = $_POST['noCursist'];
    $html = "";
    for ($i = $noCursist + 1; $i <= $number; $i++) {
        $html = $html . '<div class="cursist" id="cursist' . $i . '"> 
		<div class="vc_row-fluid rowform">
		  <div class="form-group">
		    <label class="vc_column_container  vc_col-sm-3 control-label"></label>
		     <div class="vc_column_container  vc_col-sm-9"><div class="formsubheader">Deelnemer ' . $i . '</div>
		  </div>
	                    </div>
		<div class="clear"></div>
                
		<div class="vc_row-fluid rowform">
		<div class="form-group">
		   <label class="vc_column_container  vc_col-sm-3 control-label">Naam*</label>
		    <div class="vc_column_container  vc_col-sm-9">
		        <div class="vc_col-sm-6" style="padding-left:0px;"><input type ="text" name="firstname_cursist' . $i . '" class="form-control"  placeholder="Voorletters" required="true"/></div>
		        <div class="vc_col-sm-4 hidden"><input type ="hidden" name="middlename_cursist' . $i . '" class="form-control " placeholder="Tussenv." /></div>
		         <div class="vc_col-sm-6" style="padding-right:0px;"><input type ="text" name="lastname_cursist' . $i . '" class="form-control " placeholder="Achternaam" required="true"/></div>
		    </div>
		</div>
		</div>
		<div class="clear"></div>
                
		<div class="vc_row-fluid rowform">
		<div class="form-group">
		   <label class="vc_column_container  vc_col-sm-3 control-label">Geboorteplaats</label>
		   <div class="vc_column_container  vc_col-sm-9"><input type ="text" name="placeofbrith_cursist' . $i . '" class="form-control" placeholder="Geboorteplaats" /></div>
		</div>
		</div>
		<div class="clear"></div>
                
		<div class="vc_row-fluid rowform">
		<div class="form-group">
		   <label class="vc_column_container  vc_col-sm-3 control-label">Geboortedatum</label>
		   <div class="vc_column_container  vc_col-sm-9"><input type ="text" placeholder="dd/mm/yyyy" name="birtdate_cursist' . $i . '" class="form-control number" /></div>
                                       </div>
                                       </div>
                                       <div class="clear"></div>
                                </div>';
    }
    echo $html;
    wp_die();
}

add_action('wp_ajax_getFormCursist', 'getFormCursist');
add_action('wp_ajax_nopriv_getFormCursist', 'getFormCursist');
?>
<?php
/*
 * SUBSCRIPTION
 */

function sc_subscription2() {

    global $post;
    $id = $post->ID;

    $courses = getCourses($id);

    if (empty($courses)) {
        $html = "Er zijn momenteel geen data bekend voor deze opleiding.</br>";
        $html .= "Neem <a href='/contact/'>contact met ons op.</a>";
        return $html;
    }

    $options = "";
    $trainingradio = "";
    foreach ($courses as $course) {
        $options .= '<option value="' . date('d-m-Y', $course->date) . ' - ' . $course->location . '">' . date('d-m-Y', $course->date) . ' - ' . $course->location . '</option>';
        $trainingradio .= '<label class="label-training-form"><input type="radio" name ="course"   required value="' . date('d-m-Y', $course->date) . ' - ' . $course->location . '" />' . date('d-m-Y', $course->date) . ' - ' . $course->location . '</label>';
    }

    $form = '<form name="form_subscription" id="form_subscription" method="POST"><div class="vc_row-fluid rowform">
                                        <div class="vc_column_container vc_col-sm-12 formheader">Cursusdata + locatie</div>
    <div class="form-group">
            <label class="vc_column_container  vc_col-sm-3 control-label">Selecteer *</label>
            <div class="vc_column_container vc_col-sm-9">
                   ' . $trainingradio . '
            </div>
        </div>
                <div class="clear"></div>
        <div class="vc_column_container vc_col-sm-12 formheader">Klantgegevens</div>
        <div class="form-group">
            <label class="vc_column_container  vc_col-sm-3 control-label">Aanmelden als</label>
            <div class="vc_column_container  vc_col-sm-9">
                <label class="radio-inline"> <input class="radio_type" type="radio" name="iscompany" value="0" CHECKED>Particulier</label>
                <label class="radio-inline"> <input class="radio_type" type="radio" name="iscompany" value="1" >Zakelijk</label>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="business">
        <div class="vc_row-fluid rowform">
            <div class="form-group">
                <label class="vc_column_container  vc_col-sm-3 control-label">Bedrijfsnaam*</label>
                <div class="vc_column_container  vc_col-sm-9">
                    <input type ="text" name="companyname" class="form-control businessfield" placeholder="Bedrijfsnaam" required="true"/>
                </div>
            </div>
        </div>
        <div class="clear"></div>
<!--
        <div class="vc_row-fluid rowform">
            <div class="form-group">
                <label class="vc_column_container  vc_col-sm-3 control-label">Branche</label>
                <div class="vc_column_container  vc_col-sm-9">
                        <select class="form-control businessfield" name="branche">
                            <option value="">Maak een keuze</option>
                            <option value="ZZP" >ZZP</option>
                            <option value="Asbest" >Asbest</option>
                            <option value="Bouw" >Bouw</option>
                            <option value="Evenementen" >Evenementen</option>
                            <option value="Groothandel" >Groothandel</option>
                            <option value="GW&W" >GW&W</option>
                            <option value="Haven & Overslag" >Haven & Overslag</option>
                            <option value="Horeca" >Horeca</option>
                            <option value="Opleiden" >Opleiden</option>
                            <option value="Overheid" >Overheid</option>
                            <option value="ReÃ¯ntegratie" >ReÃ¯ntegratie</option>
                            <option value="Steigerbouw" >Steigerbouw</option>
                            <option value="Transport & Logistiek" >Transport & Logistiek</option>
                            <option value="Uitzenden" >Uitzenden</option>
                            <option value="Overige" >Overige</option>
                        </select>
                </div>
            </div>
        </div>
-->
    </div>

    <div class="clear"></div>
    <div class="vc_row-fluid rowform">
        <div class="form-group">
            <label class="vc_column_container  vc_col-sm-3 control-label">Contactpersoon*</label>
            <div class="vc_column_container  vc_col-sm-9">
                <div class="vc_col-sm-6" style="padding-left:0px;">
                    <input type ="text" name="firstname" class="form-control"  placeholder="Voorletters" required="true"/>
                </div>
                <div class="vc_col-sm-4 hidden">
                    <input type ="hidden" name="middlename" class="form-control " placeholder="Tussenv." />
                </div>
                <div class="vc_col-sm-6" style="padding-right:0px;">
                    <input type ="text" name="lastname" class="form-control " placeholder="Achternaam" required="true"/>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="vc_row-fluid rowform">
        <div class="form-group">
            <label class="vc_column_container  vc_col-sm-3 control-label">Telefoon*</label>
            <div class="vc_column_container  vc_col-sm-9">
                <input type ="tel" name="phone" class="form-control number" placeholder="Telefoonnummer" required="true"/>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="vc_row-fluid rowform">
        <div class="form-group">
            <label class="vc_column_container  vc_col-sm-3 control-label">Email*</label>
            <div class="vc_column_container  vc_col-sm-9">
                <input type = "email" name="email" class="form-control" placeholder="Email" required="true"/>
            </div>
        </div>
    </div>
    <div id="cursist">
        <div class="vc_column_container vc_col-sm-12 formheader">Cursist(en) gegevens</div>
        <div class="form-group">
            <label class="vc_column_container  vc_col-sm-3 control-label">Aantal *</label>
            <div class="vc_column_container  vc_col-sm-9"> 
                <input id="amount_cursists" name ="noCursists" class="form-control" value="1" type="number" min="1"  required/> 
            </div>
        </div>
        <div class="clear"></div>
        <div id="cusistswrapper">  
        </div>
    </div>
    <div class="clear"></div>
    <div id="payment" class="private">
        <div class="vc_row-fluid rowform">
            <div class="vc_column_container vc_col-sm-12 formheader">Betalen & versturen</div>
            <div class="form-group">
                <label class="vc_column_container  vc_col-sm-3 control-label">Betalen via</label>
                <div class="vc_column_container  vc_col-sm-9">
                    <label class="radio-inline"> <input class="radio_type2 privatefield" type="radio" name="payment" value="0" CHECKED>iDeal</label>
                     <label class="radio-inline"> <input class="radio_type2 privatefield" type="radio" name="payment" value="1">factuur</label>
                </div>
            </div>
        </div>
    </div>
    
    <div class="clear"></div>
    <div class="vc_row-fluid rowform"> 
        <div class="vc_column_container vc_col-sm-12"><input type="submit" class="btn btn-primary" id="submit_subscription" value="Inschrijven"></input></div>
    </div>
    <input type="hidden" name="eventform" value="1"></input>
    <input type="hidden" name="courseid" value="' . $id . '"></input>
    </form>
    ';
    $error = "<p class='error' style='color:red;'>Dit veld is vereist</p>";
    $form .= '<script>
        jQuery(document).ready(function(){
            
            jQuery(".number").keydown(function (e) {
        
            if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                (e.keyCode >= 35 && e.keyCode <= 40)) {        
                    return;
                }
      
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        
            });
            
            jQuery(document).on("keydown",".number",function (e) {
            
            if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190,191]) !== -1 ||
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                (e.keyCode >= 35 && e.keyCode <= 40)) {        
                    return;
                }
      
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        
            });
            
            
            jQuery("#submit_subscription").click(function(){
                jQuery("input").css("border-color","#ccc");
                jQuery(".error").remove();
                jQuery("form#form_subscription :input").each(function(){
                    
                    if(jQuery(this).prop("required") && jQuery(this).val()==""){ 
                        jQuery(this).css("border-color","red");
                        jQuery(this).parent().append( "' . $error . '" );  
                    }
                })
                
                 
            });
                 
        });
    </script>';

    return $form;
}

add_shortcode('sc_subscription2', 'sc_subscription2');

function sc_eventlist() {
      global $post;
    $id = $post->ID;
// 	echo $id.'-';
    $courses = getCourses($id);

    if (!empty($courses)) {
        $html = '<table><tr><th>Datum</th><th>Locatie</th></tr>';
        foreach ($courses as $course) {
            $html .= '<tr><td>' . date('d-m-Y', $course->date) . '</td><td>' . $course->location . '</td></tr>';
        }
        $html .= '</table>';
    } else {
        $html = "Er zijn momenteel geen data bekend voor deze opleiding.</br>";
        $html .= "Neem <a href='/contact/'>contact met ons op. ";
    }

    return $html;
}

add_shortcode('sc_eventlist', 'sc_eventlist');

// SOMIN NEW CODE
add_filter('woocommerce_checkout_fields', 'sb_add_custom_checkout_field');

function sb_add_custom_checkout_field($fields) {
    global $woocommerce;
    $subscription = $woocommerce->session->get('subscription');
    $noCursists = $subscription['noCursists'];
    $cursists = array();
    for ($i = 1; $i <= $noCursists; $i++) {
        // FIRST NAME
        $fields['billing']['firstname_cursist' . $i] = array(
            'label' => __('Voorletters', 'example'),
            'type' => 'text',
            'placeholder' => _x('Voorletters', 'placeholder', 'example'),
            'required' => true,
            'class' => array('firstname_cursist' . $i),
            'clear' => true
        );
        $fields['billing']['firstname_cursist' . $i]['default'] = $subscription['firstname_cursist' . $i];
        $fields['billing']['firstname_cursist' . $i]['priority'] = (120 + $i) * $i;

        // MIDDEL NAME
        $fields['billing']['middlename_cursist' . $i] = array(
            'label' => __('Tussenv.', 'example'),
            'type' => 'text',
            'placeholder' => _x('Tussenv.', 'placeholder', 'example'),
            'required' => false,
            'class' => array('middlename_cursist' . $i),
            'clear' => true
        );
        $fields['billing']['middlename_cursist' . $i]['default'] = $subscription['middlename_cursist' . $i];
        $fields['billing']['middlename_cursist' . $i]['priority'] = (121 + $i) * $i;


        // LAST NAME
        $fields['billing']['lastname_cursist' . $i] = array(
            'label' => __('Achternaam', 'example'),
            'type' => 'text',
            'placeholder' => _x('Achternaam', 'placeholder', 'example'),
            'required' => true,
            'class' => array('lastname_cursist' . $i),
        );
        $fields['billing']['lastname_cursist' . $i]['default'] = $subscription['lastname_cursist' . $i];
        $fields['billing']['lastname_cursist' . $i]['priority'] = (122 + $i) * $i;

        //PLACE OF BIRTH
        $fields['billing']['placeofbrith_cursist' . $i] = array(
            'label' => __('Geboorteplaats', 'example'),
            'type' => 'text',
            'placeholder' => _x('Geboorteplaats', 'placeholder', 'example'),
            'required' => true,
            'class' => array('placeofbrith_cursist' . $i),
        );
        $fields['billing']['placeofbrith_cursist' . $i]['default'] = $subscription['placeofbrith_cursist' . $i];
        $fields['billing']['placeofbrith_cursist' . $i]['priority'] = (123 + $i) * $i;


        //   // DATE
        $fields['billing']['birtdate_cursist' . $i] = array(
            'label' => __('Geboortedatum', 'example'),
            'type' => 'text',
            'placeholder' => _x('Geboortedatum', 'placeholder', 'example'),
            'required' => true,
            'class' => array('birtdate_cursist' . $i),
        );
        $fields['billing']['birtdate_cursist' . $i]['default'] = $subscription['birtdate_cursist' . $i];
        $fields['billing']['birtdate_cursist' . $i]['priority'] = (124 + $i) * $i;
    }
    return $fields;
}

add_action('woocommerce_checkout_update_order_meta', 'sb_checkout_field_update_order_meta');

function sb_checkout_field_update_order_meta($order_id) {
    $noCursists = $_POST['billing_noCursists'];
    update_post_meta($order_id, 'billing_noCursists', sanitize_text_field($noCursists));
    for ($i = 1; $i <= $noCursists; $i++) {
        if (!empty($noCursists)) {
            update_post_meta($order_id, 'firstname_cursist' . $i, sanitize_text_field($_POST['firstname_cursist' . $i]));
            update_post_meta($order_id, 'middlename_cursist' . $i, sanitize_text_field($_POST['middlename_cursist' . $i]));
            update_post_meta($order_id, 'lastname_cursist' . $i, sanitize_text_field($_POST['lastname_cursist' . $i]));
            update_post_meta($order_id, 'placeofbrith_cursist' . $i, sanitize_text_field($_POST['placeofbrith_cursist' . $i]));
            update_post_meta($order_id, 'birtdate_cursist' . $i, sanitize_text_field($_POST['birtdate_cursist' . $i]));
        }
    }
}

function sb_display_order_data_in_admin($order) {
    ?>
    <div class="order_data_column1">
        <h4><?php _e('Cursist(en) gegevens:', 'woocommerce'); ?></h4>
        <div class="address">
            <?php $noCursists = get_post_meta($order->id, 'billing_noCursists', true); ?>
            <?php for ($i = 1; $i <= $noCursists; $i++) { ?>
                <?php
                echo '<div class="colum"><span class="strong" style="font-weight:bold; margin-right:5px; margin-bottom:5px;">' . __('First Name Cursist' . $i) . ':</span>' . get_post_meta($order->id, 'firstname_cursist' . $i, true) . '</div>';
                //echo '<div class="colum"><span class="strong" style="font-weight:bold; margin-right:5px; margin-bottom:5px;">' . __('Middel Name Cursist' . $i) . ':</span>' . get_post_meta($order->id, 'middlename_cursist' . $i, true) . '</div>';
                echo '<div class="colum"><span class="strong" style="font-weight:bold; margin-right:5px; margin-bottom:5px;">' . __('Last  Name Cursist' . $i) . ':</span>' . get_post_meta($order->id, 'lastname_cursist' . $i, true) . '</div>';
                echo '<div class="colum"><span class="strong" style="font-weight:bold; margin-right:5px; margin-bottom:5px;">' . __('Place of brith Cursist' . $i) . ':</span>' . get_post_meta($order->id, 'placeofbrith_cursist' . $i, true) . '</div>';
                echo '<div class="colum"><span class="strong" style="font-weight:bold; margin-right:5px; margin-bottom:5px;">' . __('Birtdate Cursist' . $i) . ':</span>' . get_post_meta($order->id, 'birtdate_cursist' . $i, true) . '</div>';
                ?>
            <?php } ?>
        </div>
    </div>
    <?php
}

add_action('woocommerce_admin_order_data_after_shipping_address', 'sb_display_order_data_in_admin');

add_action('woocommerce_email_order_meta2', 'order_customer_Cursists_details', 5, 4);

function order_customer_Cursists_details($order, $sent_to_admin, $plain_text, $email) {
    $noCursists = get_post_meta($order->get_order_number(), 'billing_noCursists', true);
    // we won't display anything if it is not a gift
    if (empty($noCursists))
        return;
    echo '<h2 style="color:#f57d30;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">Cursist(en) gegevens:</h2>';
    echo '<table class="table" cellspacing="0" cellpadding="0" border="0" style="width:100%;vertical-align:top;margin-bottom:40px;padding:0">';
    echo '<thead>';
    echo '<tr>';
    echo '<th style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Aantal </th>';
    echo '<th style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Naam</th>';
//     echo '<th> Middle Name </th>';
//     echo '<th> last Name </th>';
    echo '<th style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Geboorteplaats</th>';
    echo '<th style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Geboortedatum</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    for ($i = 1; $i <= $noCursists; $i++) {
        $firstname_cursist = get_post_meta($order->get_order_number(), 'firstname_cursist' . $i, true);
        $lastname_cursist = get_post_meta($order->get_order_number(), 'lastname_cursist' . $i, true);
        $fullname_cursist = $firstname_cursist . ' ' . $lastname_cursist;
        $placeofbrith_cursist = get_post_meta($order->get_order_number(), 'placeofbrith_cursist' . $i, true);
        $birtdate_cursist = get_post_meta($order->get_order_number(), 'birtdate_cursist' . $i, true);
        echo '<tr>';
        echo '<td style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">' . $i . '</td>';
        echo '<td style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">' . $fullname_cursist . '</td>';
        echo '<td style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">' . $placeofbrith_cursist . '</td>';
        echo '<td style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">' . $birtdate_cursist . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}

//add_action('woocommerce_email_order_meta_fields', 'add_Cursists_order_meta', 10, 3);
/*
 * @param $order_obj Order Object
 * @param $sent_to_admin If this email is for administrator or for a customer
 * @param $plain_text HTML or Plain text (can be configured in WooCommerce > Settings > Emails)
 */

function add_Cursists_order_meta($order_obj, $sent_to_admin, $order) {
//     print_r($order);      
    // this order meta checks if order is marked as a gift
    if ($order->has_status('processing')) {
        $noCursists = get_post_meta($order->get_order_number(), 'billing_noCursists', true);
        // we won't display anything if it is not a gift
        if (empty($noCursists))
            return;
        echo '<h2 style="color:#f57d30;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">Cursist(en) gegevens:</h2>';
        echo '<table class="table" cellspacing="0" cellpadding="0" border="0" style="width:100%;vertical-align:top;margin-bottom:40px;padding:0">';
        echo '<thead>';
        echo '<tr>';
        echo '<th style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Aantal </th>';
        echo '<th style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Naam</th>';
//     echo '<th> Middle Name </th>';
//     echo '<th> last Name </th>';
        echo '<th style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Geboorteplaats</th>';
        echo '<th style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">Geboortedatum</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        for ($i = 1; $i <= $noCursists; $i++) {
            $firstname_cursist = get_post_meta($order->get_order_number(), 'firstname_cursist' . $i, true);
            $lastname_cursist = get_post_meta($order->get_order_number(), 'lastname_cursist' . $i, true);
            $fullname_cursist = $firstname_cursist . ' ' . $lastname_cursist;
            $placeofbrith_cursist = get_post_meta($order->get_order_number(), 'placeofbrith_cursist' . $i, true);
            $birtdate_cursist = get_post_meta($order->get_order_number(), 'birtdate_cursist' . $i, true);
            echo '<tr>';
            echo '<td style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">' . $i . '</td>';
            echo '<td style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">' . $fullname_cursist . '</td>';
            echo '<td style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">' . $placeofbrith_cursist . '</td>';
            echo '<td style="color:#737973;border:1px solid #e5e5e5;vertical-align:middle;padding:12px;text-align:left">' . $birtdate_cursist . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } elseif ($order->has_status('on-hold')) {
        
    }
}

add_filter('woocommerce_available_payment_gateways', 'unset_gateway');

function unset_gateway($available_gateways) {
    global $woocommerce;
    $subscription = $woocommerce->session->get('subscription');
    if ($subscription['payment'] == 0) {
        unset($available_gateways['bacs']);
    } elseif ($subscription['payment'] == 1) {
        unset($available_gateways['multisafepay_ideal']);
    }
    return $available_gateways;
}

add_action('woocommerce_email_customer_details2', 'order_customer_billing_details', 5, 4);

function order_customer_billing_details($order, $sent_to_admin, $plain_text, $email) {
    ?>
    <style>
        .cursist-details{
            width:100%;
            vertical-align:top;
            margin-bottom:40px;
            padding:0;
        }
        .bg-light{
            background: #f5f5f5;
        }
    </style>
    <?php
    if (!empty($order->billing_company)) {
        $company = $order->billing_company . '<br/>';
    }
    echo '
	<table class="cursist-details" id="m_-7913608979401080979addresses" style="" cellspacing="0" cellpadding="0" border="0">
	<tbody><tr>
	<td style="text-align:left;border:0;padding:0" width="50%" valign="top">
	<h2 style="color:#f57d30;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:0 0 18px;text-align:left">Factuuradres</h2>
                   <address class="m_-7913608979401080979address" style="padding:12px 12px 0;color:#737973;border:1px solid #e5e5e5">';
    echo $company;
    echo $order->billing_first_name . ' ' . $order->billing_last_name . '<br/>';
    echo $order->billing_address_1 . '<br/>';
    echo $order->billing_postcode . ' ';
    echo $order->billing_city . '<br/>';
    echo $order->billing_phone . '<br/>';
    echo $order->billing_email . '<br/><br/>';
    echo '</address><span class="HOEnZb"><font color="#888888">
		</font></span>
                </td>
                </tr>
                </tbody>
                </table>';
}

add_filter('woocommerce_email_recipient_new_order', 'custom_new_order_email_recipient', 10, 2);

function custom_new_order_email_recipient($recipient, $order) {
    // Avoiding backend displayed error in Woocommerce email settings for undefined $order
    if (!is_a($order, 'WC_Order'))
        return $recipient;

    // Check order items for a shipped product is in the order   
    foreach ($order->get_items() as $item) {
        $product = $item->get_product(); // Get WC_Product instance Object
        // When a product needs shipping we add the customer email to email recipients
        if ($product->needs_shipping()) {
            return $recipient . ',' . $order->get_billing_email();
        }
    }
    return $recipient;
}
?>