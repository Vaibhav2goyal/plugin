 <?php 
  function holiday_list(){
    if (isset($_POST['delete'])) {
     global $wpdb;
      $table = $wpdb->prefix . "holidays";
      $id = $_POST['holiday_id'];
      $wpdb->query($wpdb->prepare("DELETE FROM $table WHERE id = %s", $id));
    
}
 ?>
 <style>
    th, td {
    border: .1px solid #ccc;
}
 </style>   
     <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/holiday/style-admin.css" rel="stylesheet" /> 
    <h1 style="padding:8px 8px; background: #0073aa; color: #fff;" >Holiday List</h1>
    

    <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "holidays";
        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts' id="wedding_list_all">
            <thead><tr>
                <th class="manage-column ss-list-width">Holiday name</th>
                <th class="manage-column ss-list-width">Date</th>
                <th class="manage-column ss-list-width">Action</th>
                
            </tr></thead>
                

            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->holiday_name; ?></td>
                    <td class="manage-column ss-list-width"><?php  echo date("m-d-Y", strtotime($row->date)); ?></td>
                    <td class="manage-column ss-list-width">
                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                            <input  name="holiday_id" type="hidden" value="<?php echo $row->id; ?>" />
                            <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Do you want to delete this holiday')">
                        
                        </form>
                    </td>
                    
                    
               </tr>
            <?php } ?>
        </table>
        <?php } ?>