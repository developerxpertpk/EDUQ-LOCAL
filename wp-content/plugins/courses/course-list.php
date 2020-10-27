<?php

function course_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/courses/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h1>VCA-PLUS Trainingen</h1>
			<a class="page-title-action" href="<?php echo admin_url('admin.php?page=course_create'); ?>">Training toevoegen</a>
		<hr class="wp-header-end"/>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a class="page-title-action" href="<?php echo admin_url('admin.php?page=course_create'); ?>">Training toevoegen</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "courses";

        $rows = $wpdb->get_results("SELECT id,course,location,date from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <thead>
				<tr>
					<th class="manage-column ss-list-width">ID</th>
					<th class="manage-column ss-list-width">Cursus</th>
					<th class="manage-column ss-list-width">Locatie</th>
					<th class="manage-column ss-list-width">Datum</th>
					<th class="manage-column ss-list-width">Actie</th>
				</tr>
			</thead> 
            <?php foreach ($rows as $row) {?>



			
                <tr>
                    <td class="manage-column ss-list-width "><?php echo $row->id; ?></td>

<td class="manage-column ss-list-width ">
<select>
<?

                $courses = $wpdb->get_results($wpdb->prepare("SELECT id,location,date,course from $table_name where id=$row->id", $id));
        foreach ($courses as $c) {
            $location = $c->location;
                        $date = date('Y-m-d',$c->date);
                        $course = $c->course;
        }

                $args = array( 'post_type' => 'product', 'posts_per_page' => -1 );
        $loop = new WP_Query( $args );
                $list ='';
        while ( $loop->have_posts() ) : $loop->the_post();
                        global $product;
                        $selected = "";
                        if($loop->post->ID == $course ){
                                $selected = "SELECTED";
                        }
                        $list = $list.'<option '.$selected.' value="'.$loop->post->ID.'" disabled>'.$loop->post->post_title.'</option>';
                endwhile;
    //}
echo $list;
    ?>

</select>

</td>
                    <td class="manage-column ss-list-width"><?php echo $row->location; ?></td>
					<td class="manage-column ss-list-width"><?php echo date('d-m-Y',$row->date); ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=course_update&id=' . $row->id); ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}

