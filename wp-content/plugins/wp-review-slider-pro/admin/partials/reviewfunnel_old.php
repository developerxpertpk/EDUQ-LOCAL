<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://ljapps.com
 * @since      1.0.0
 *
 * @package    WP_Review_Pro
 * @subpackage WP_Review_Pro/admin/partials
 */
 
 //freemius license function https://freemius.com/help/documentation/wordpress-sdk/software-licensing/
 
 //add thickbox
 add_thickbox();
 
 //global variables for using freemius api
	$frlicenseid = WPREV_FR_SITEID;
	$frsiteurl = urlencode(WPREV_FR_URL);
 
     // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
	$dbmsg = "";
	$html="";
	$currentreviewfunnel= new stdClass();
	$currentreviewfunnel->id="";
	$currentreviewfunnel->title="";
	$currentreviewfunnel->site_type="";
	$currentreviewfunnel->url="";
	$currentreviewfunnel->cron="";

	
	//db function variables
	global $wpdb;
	$table_name = $wpdb->prefix . 'wpfb_reviewfunnel';
	
	//form deleting and updating here---------------------------
	if(isset($_GET['taction'])){
		if(isset($_GET['tid'])){
			$tid = htmlentities($_GET['tid']);
			//for deleting
			if($_GET['taction'] == "del" && $_GET['tid'] > 0){
				//security
				check_admin_referer( 'tdel_');
				//delete
				$wpdb->delete( $table_name, array( 'id' => $tid ), array( '%d' ) );
			}
			//for updating
			if($_GET['taction'] == "edit" && $_GET['tid'] > 0){
				//security
				check_admin_referer( 'tedit_');
				//get form array
				$currentreviewfunnel = $wpdb->get_row( "SELECT * FROM ".$table_name." WHERE id = ".$tid );
			}
			//for copying
			if($_GET['taction'] == "copy" && $_GET['tid'] > 0){
				//security
				check_admin_referer( 'tcopy_');
				//get form array
				$currentreviewfunnel = $wpdb->get_row( "SELECT * FROM ".$table_name." WHERE id = ".$tid );
				//add new template
				$array = (array) $currentreviewfunnel;
				$array['title'] = $array['title'].'_copy';
				
				unset($array['id']);
				//print_r($array);
				//remove the id so it can be generated.
				$wpdb->insert( $table_name, $array );
				//$wpdb->show_errors();
				//$wpdb->print_error();
			}
		}
		
	}
	//------------------------------------------
	
	//template importing from CSV file--------------------
	 if(isset($_POST["Import"])){
		//print_r($_FILES);
		$filename=$_FILES["file"]["tmp_name"];		
		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
			$c = 0; //use line one for column names
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
				$c++;
				if($c == 1){
				//print_r($getData);
					$colarray = $getData;
				} else {
					$insertdata = array_combine($colarray, $getData);
					//remove id so it will assign another on insert
					unset($insertdata['id']);
					//insert to db here
					$wpdb->insert( $table_name, $insertdata );
				}
	         }
	         fclose($file);	
		 }
	}
	//---------------------------------------------------------------
	
	

	//form posting here--------------------------------
	//check to see if form has been posted.
	//if template id present then update database if not then insert as new.

	if (isset($_POST['wprevpro_submittemplatebtn'])){
		//verify nonce wp_nonce_field( 'wprevpro_save_template');
		check_admin_referer( 'wprevpro_save_template');
		//get form submission values and then save or update
		$t_id = sanitize_text_field($_POST['edittid']);
		$title = sanitize_text_field($_POST['wprevpro_template_title']);
		$site_type = sanitize_text_field($_POST['wprevpro_site_type']);
		$url = sanitize_text_field($_POST['wprevpro_url']);
		$cron = sanitize_text_field($_POST['wprevpro_cron_setting']);

		//call cloudways server to make addprofile request and save details in db, return job_id and save in db
		$options = get_option('wprevpro_funnel_options'); 
		$dbsiteinfo_id = $options['dbsiteinfo_id'];
		$response = wp_remote_get( 'https://funnel.ljapps.com/addprofile?sid='.intval($dbsiteinfo_id).'&frlicenseid='.intval($frlicenseid).'&frsiteurl='.$frsiteurl.'&scrapeurl='.urlencode($url).'&scrapequery=&scrapefromdate=&scrapeblocks=' );
 			if ( is_array( $response ) && ! is_wp_error( $response ) ) {
				$headers = $response['headers']; // array of http header lines
				$body    = $response['body']; // use the content
			}
		$addscrapeprofilearray = json_decode($body,true);
			
		print_r($addscrapeprofilearray);

		$timenow = time();
		
		//+++++++++need to sql escape using prepare+++++++++++++++++++
		//+++++++++++++++++++++++++++++++++++++++++++++++++++++
		//insert or update
			$data = array( 
				'title' => "$title",
				'site_type' => "$site_type",
				'created_time_stamp' => "$timenow",
				'url' => "$url",
				'cron' => "$cron",
				);
				//print_r($data);
			$format = array( 
					'%s',
					'%s',
					'%s',
					'%s',
					'%s',
				); 

		if($t_id==""){
			//print_r($data);
			//insert
			$wpdb->insert( $table_name, $data, $format );
			//$wpdb->show_errors();
			//$wpdb->print_error();
			//die();
		} else {
			//update
			//print_r($data);
			$updatetempquery = $wpdb->update($table_name, $data, array( 'id' => $t_id ), $format, array( '%d' ));
			//$wpdb->show_errors();
			//$wpdb->print_error();
			if($updatetempquery>0){
				$dbmsg = '<div id="setting-error-wprevpro_message" class="updated settings-error notice is-dismissible">'.__('<p><strong>Review Funnel Updated!</strong></p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>', 'wp-review-slider-pro').'</div>';
			}
		}
		
		
	}

	//Get list of all current forms--------------------------
	$currentforms = $wpdb->get_results("SELECT * FROM $table_name");
	//-------------------------------------------------------

	
?>

<div class="wrap wp_pro-settings" id="">
	<h1><img src="<?php echo plugin_dir_url( __FILE__ ) . 'logo.png'; ?>"></h1>
	
<?php 
include("tabmenu.php");

//query args for export and import
$url_tempdownload = admin_url( 'admin-post.php?action=print_reviewfunnel.csv' );
if ( wrsp_fs()->can_use_premium_code() ) {
?>
<div class="w3-col m2 sidemenucontainer">
<?php
include("getrevs_sidemenu.php");
?>	
</div>
<div class="w3-col m10">
<div>
<?php
/*
?>
<div class="wprevpro_margin10">
	<a id="wprevpro_helpicon_posts" class="wprevpro_btnicononly button dashicons-before dashicons-editor-help"></a>
	<a id="wprevpro_addnewtemplate" class="button dashicons-before dashicons-plus-alt"><?php _e('Add New Review Funnel', 'wp-review-slider-pro'); ?></a>
	<a href="<?php echo $url_tempdownload;?>" id="wprevpro_exporttemplates" class="button dashicons-before dashicons-download"><?php _e('Export Review Funnels', 'wp-review-slider-pro'); ?></a>
	<a id="wprevpro_importtemplates" class="button dashicons-before dashicons-upload"><?php _e('Import Review Funnels', 'wp-review-slider-pro'); ?></a>
</div>
<div class="wprevpro_margin10" id="importform" style='display:none;'>
	    <form  action="?page=wp_pro-reviewfunnel" method="post" name="upload_excel" enctype="multipart/form-data">
		<p><b>Use this form to import previously exported Review Funnels.</b></p>
			<input type="file" name="file" id="file">
			</br>
			<button type="submit" id="submit" name="Import" class="button-primary" data-loading-text="Loading...">Import</button>
        </form>
</div>

<?php
*/
} else {
	echo '<div class="wprevpro_margin10">Review Funnels are a Premium feature. Please upgrade.</div>';
}

// make a call to http://funnel.ljapps.com/frstats with the variables to get stats, or insert if new
//echo $frlicenseid."<br>" ;
//echo $frsiteurl."<br>" ;

$response = wp_remote_get( 'https://funnel.ljapps.com/frstats?frlicenseid='.$frlicenseid.'&frsiteurl='.$frsiteurl );
 
if ( is_array( $response ) && ! is_wp_error( $response ) ) {
    $headers = $response['headers']; // array of http header lines
    $body    = $response['body']; // use the content
}
$licensecheckarray = json_decode($body,true);

//error check
if($licensecheckarray['ack']!="success"){
	echo '<div class="w3-panel w3-red"><p>'.$licensecheckarray['ackmessage'].'</p></div> ';
	die();
}

//print_r($licensecheckarray);
$statsarray=$licensecheckarray['stats'];

//update options in db, so we can check before we make call to server, also do this when using cron job
$tempoptions['ack']=$licensecheckarray['ack'];
$tempoptions['totalreviewbank']=$statsarray['totalreviewbank'];
$tempoptions['totalreviewcreditsused']=$statsarray['totalreviewcreditsused'];
$tempoptions['dbsiteinfo_id']=$statsarray['id'];
update_option('wprevpro_funnel_options',$tempoptions);
/*
?>
<div class="w3-row-padding w3-margin-bottom" style="margin-right: -30px;">
    <div class="w3-third" style="margin-left: -15px;">
      <div class="w3-container w3-green w3-padding-16">
        <div class="w3-left"><span class="dashicons dashicons-download"></span> Review Quota Remaining</div>
        <div class="w3-right"></div>
        <h1 class="w3-text-white" style="padding-top: 30px;"><?php echo $statsarray['totalreviewbank']-$statsarray['totalreviewcreditsused']."/".$statsarray['totalreviewbank']; ?></h1>
      </div>
    </div>
	<div class="w3-third">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><span class="dashicons dashicons-plus-alt"></span> Total Calls Made</div>
        <div class="w3-right"></div>
        <h1 class="w3-text-white" style="padding-top: 30px;"><?php echo $statsarray['totalcallsmade']; ?></h1>
      </div>
    </div>
		<div class="w3-third">
      <div class="w3-container w3-orange w3-padding-16">
        <div class="w3-left w3-text-white"><span class="dashicons dashicons-calendar-alt"></span> Last Call Date</div>
        <div class="w3-right"></div>
        <h1 class="w3-text-white" style="padding-top: 30px;"><?php 
		if($statsarray['lastcalldatetime']>0){
		echo date_i18n( get_option( 'date_format' ), $statsarray['lastcalldatetime'] ); 
		} else {
			echo "-";
		}
		?></h1>
      </div>
    </div>
  </div>
  <div class="wprevpro_margin10" id="wprevpro_new_template">
<form name="newtemplateform" id="newtemplateform" action="?page=wp_pro-reviewfunnel" method="post" onsubmit="return validatebadgeForm()">
	<table class="wprevpro_margin10 form-table ">
		<tbody>
			<tr class="wprevpro_row">
				<th scope="row">
					<?php _e('Review Funnel Title:', 'wp-review-slider-pro'); ?>
				</th>
				<td>
					<input id="wprevpro_template_title" data-custom="custom" type="text" name="wprevpro_template_title" placeholder="" value="<?php echo $currentreviewfunnel->title; ?>" required>
					<p class="description">
					<?php _e('Enter a title or name for this Review Funnel.', 'wp-review-slider-pro'); ?>		</p>
				</td>
			</tr>
			<tr class="wprevpro_row">
				<th scope="row">
					<?php _e('Choose Review Site:', 'wp-review-slider-pro'); ?>
				</th>
				<td><div id="divsitetype">
						<select name="wprevpro_site_type" id="wprevpro_site_type">
						<?php
						$typearray = unserialize(WPREV_TYPE_ARRAY_RF);
						  for($x=0;$x<count($typearray);$x++){
							$typelowercase = strtolower($typearray[$x]);
						?>
							<option value="<?php echo $typelowercase;?>" <?php if($currentreviewfunnel->site_type==$typelowercase){echo "selected";} ?>><?php echo $typearray[$x];?></option>
						<?php
						  }
						?>
						</select>
					</div>
					<p class="description">
					<?php _e('This is the site you are downloading the reviews from.', 'wp-review-slider-pro'); ?></p>
				</td>
			</tr>
			<tr class="wprevpro_row">
				<th scope="row">
					<?php _e('Review URL', 'wp-review-slider-pro'); ?>
				</th>
				<td>
					<input class="yelp_business_url" id="wprevpro_url" data-custom="custom" type="url" name="wprevpro_url" placeholder="" value="<?php echo $currentreviewfunnel->url; ?>" required>
					<p class="description">
					<?php _e('The URL of the page where the reviews are located.', 'wp-review-slider-pro'); ?>		</p>
				</td>
			</tr>
			<tr class="wprevpro_row">
				<th scope="row">
					<?php _e('Check Reviews 24 Hours', 'wp-review-slider-pro'); ?>
				</th>
				<td><div id="divtemplatestyles">

					<input type="radio" name="wprevpro_cron_setting" id="wprevpro_cron_type1-radio" value="no" checked="checked">
					<label for="wprevpro_badge_type1-radio"><?php _e('No', 'wp-review-slider-pro'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<input type="radio" name="wprevpro_cron_setting" id="wprevpro_cron_type2-radio" value="yes" <?php if($currentreviewfunnel->cron== "yes"){echo 'checked="checked"';}?>>
					<label for="wprevpro_badge_type2-radio"><?php _e('Yes', 'wp-review-slider-pro'); ?></label>
					</div>
					<p class="description">
					<?php _e('Checks for new reviews every 24 hours.', 'wp-review-slider-pro'); ?></p>
				</td>
			</tr>

		</tbody>
	</table>
	<?php 
	//security nonce
	wp_nonce_field( 'wprevpro_save_template');
	?>
	<input type="hidden" name="edittid" id="edittid"  value="<?php echo $currentreviewfunnel->id; ?>">
	<input type="submit" name="wprevpro_submittemplatebtn" id="wprevpro_submittemplatebtn" class="button button-primary" value="<?php _e('Save Review Funnel', 'wp-review-slider-pro'); ?>">
	<a id="wprevpro_addnewtemplate_cancel" class="button button-secondary"><?php _e('Cancel', 'wp-review-slider-pro'); ?></a>
	</form>
</div>
  

<?php
*/
//display message
echo $dbmsg;
		$html .= '
		<table class="wp-list-table widefat striped posts">
			<thead>
				<tr>
					<th scope="col" width="30px" class="manage-column">'.__('ID', 'wp-review-slider-pro').'</th>
					<th scope="col" class="manage-column">'.__('Title', 'wp-review-slider-pro').'</th>
					<th scope="col" width="100px" class="manage-column">'.__('Type', 'wp-review-slider-pro').'</th>
					<th scope="col" class="manage-column">'.__('Cron', 'wp-review-slider-pro').'</th>
					<th scope="col" width="170px" class="manage-column">'.__('Date Created', 'wp-review-slider-pro').'</th>
					<th scope="col" width="450px" class="manage-column">'.__('Action', 'wp-review-slider-pro').'</th>
				</tr>
				</thead>
			<tbody id="reviewfunnelstable">';
	if(count($currentforms)>0){
	foreach ( $currentforms as $currentform ) 
	{
	//remove query args we just used
	$urltrimmed = remove_query_arg( array('taction', 'id') );
		$tempeditbtn =  add_query_arg(  array(
			'taction' => 'edit',
			'tid' => "$currentform->id",
			),$urltrimmed);
			
		$url_tempeditbtn = wp_nonce_url( $tempeditbtn, 'tedit_');
			
		$tempdelbtn = add_query_arg(  array(
			'taction' => 'del',
			'tid' => "$currentform->id",
			),$urltrimmed) ;
			
		$url_tempdelbtn = wp_nonce_url( $tempdelbtn, 'tdel_');
		
						//for copying
		$tempcopybtn = add_query_arg(  array(
			'taction' => 'copy',
			'tid' => "$currentform->id",
			),$urltrimmed) ;
		$url_tempcopybtn = wp_nonce_url( $tempcopybtn, 'tcopy_');
			
		$html .= '<tr id="'.$currentform->id.'">
				<th scope="col" class=" manage-column">'.$currentform->id.'</th>
				<th scope="col" class=" manage-column"><b>'.$currentform->title.'</b></th>
				<th scope="col" class=" manage-column"><b>'.$currentform->site_type.'</b></th>
				<th scope="col" class=" manage-column"><b>'.$currentform->cron.'</b></th>
				<th scope="col" class=" manage-column">'.date("M j, Y",$currentform->created_time_stamp) .'</th>
				<th scope="col" class="manage-column" templateid="'.$currentform->id.'" templatetype="'.$currentform->site_type.'"><a href="'.$url_tempeditbtn.'" class="rfbtn button button-secondary dashicons-before dashicons-admin-generic">'.__('Edit', 'wp-review-slider-pro').'</a> <a href="'.$url_tempdelbtn.'" class="rfbtn button button-secondary dashicons-before dashicons-trash">'.__('Delete', 'wp-review-slider-pro').'</a> <a href="'.$url_tempcopybtn.'" class="rfbtn button button-secondary dashicons-before dashicons-admin-page">'.__('Copy', 'wp-fb-reviews').'</a> <span class="rfbtn button button-primary dashicons-before dashicons-star-filled retreviewsbtn"> '.__('Retrieve Reviews', 'wp-fb-reviews').'</span></th>
			</tr>';
	}
	} else {
		$html .= '<tr><td colspan="6">You can create a Review Funnel to download reviews from even more sites! Click the "Add New Review Funnel" button above to get started.<br><br><b>Note:</b> Review Funnels use a third party service to download reviews, so you are limited to 2,000 reviews per a year per a site. You must also have an active license for this plugin. Soon you will be able to purchase more reviews for your account.</td></tr>';
	}
		$html .= '</tbody></table>';
//echo $html;
echo "<div></br>Coming Soon! Review Funnels will give you a way to download reviews from more than 40 different sites!</br></br></div>"; 

?>

<div id="retreivewspopupdiv" class="wprevpro_hide">
<div><p>Placeholder for info about last time the URL was scraped.</p></div>
<div>
<span id="getrevsbtnpopup" class="rfbtn button button-primary dashicons-before dashicons-star-filled"> Retrieve Reviews</span>
<span class="rfbtn button button-secondary dashicons-before dashicons-no-alt">Cancel</span>
</div>
<div><h3>Call Log<h3></div>
<table class="w3-table w3-bordered w3-striped w3-border"><tbody><tr>
  <th>Last Ran On</th>
  <th># of Reviews Downloaded</th>
  <th>Review URL</th>
</tr>
<tr>
  <td>Jan 28, 2019</td>
  <td>50</td>
  <td>www.google.com</td>
</tr>
</tbody>
</table>
</div>

	<div id="popup_review_list" class="popup-wrapper wprevpro_hide">
	  <div class="popup-content">
		<div class="popup-title">
		  <button type="button" class="popup-close">&times;</button>
		  <h3 id="popup_titletext"></h3>
		</div>
		<div class="popup-body">
		  <div id="popup_bobytext1"></div>
		  <div id="popup_bobytext2"></div>
		</div>
	  </div>
	</div>
	
</div>
<?php
echo "<br><br><br>";
//print_r($licensecheckarray);
?>
</div>
</div>
</div>