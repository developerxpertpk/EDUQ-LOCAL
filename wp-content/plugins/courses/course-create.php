<?php

function course_create() {
    $id = $_POST['id'];
    $location = $_POST["location"];
    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
				
        $table_name = $wpdb->prefix . "courses";
		
		$date = strtotime($_POST["date"]);
		
		$course = $_POST["course"];
		$id = $_POST["id"];
		$location = $_POST["location"]; 
		
		
		//$id = Null;
        $wpdb->insert(
                $table_name, //table
                array('location' => $location, 'date' => $date, 'course' => $course), //data 
                array('%s', '%s', '%d' ,'%s') //data format		 	
        );
        $message.="Training aangemaakt";
    }
	$args = array( 'post_type' => 'product', 'posts_per_page' => -1 );  
        $loop = new WP_Query( $args );
		$list ='';
        while ( $loop->have_posts() ) : $loop->the_post(); 
			global $product; 
			$list = $list.'<option value="'.$loop->post->ID.'">'.$loop->post->post_title.'</option>';
		endwhile;
	
    
	?>
    
	<link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/courses/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>VCA training toevoegen</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <table class='wp-list-table widefat fixed'>
				<tr>
                    <th class="ss-th-width">Product</th>
                    <td><select name="course"><?=$list?></select> 
                </tr>
                <tr>
                    <th class="ss-th-width">Trainingslocatie</th>
                    <td><input type="text" name="location" value="<?php echo $location; ?>" class="ss-field-width" /></td>
                </tr>
				<tr>
                    <th class="ss-th-width">Datum</th>
                    <td><input  type="date" id="datepicker" name="date" value="" class="ss-field-width" /></td>
                </tr>
            </table>
            <input type='submit' name="insert" value='Opslaan' class='button'>
        </form>
    </div>
    <?php
}
