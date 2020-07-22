<?php 
	
function add_holiday(){
?>

<style>
    #holiday_list_all th,#holiday_list_all td {
    border: .1px solid #ccc;
}
 </style>

<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script>
         $(function() {
     var $dp2 =  $( "#datepicker-13" ).datepicker();
             $dp2.datepicker({
    dateFormat: "mm-dd-yy",
    yearRange: "-100:+20",
      minDate:0,
  });
         });
      </script>

      <h1 style="padding:8px 8px; background: #0073aa; color: #fff;" >Add New Holiday</h1>
 <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" >
 	<table>
 	<tr><td><p>Holiday Name: </td><td><input type = "text" id = "holiday_name" name="holiday_name"></p></td></tr>
	<tr><td><p>Enter Date: </td><td><input type = "text" id = "datepicker-13" name="holiday_date"></p></td></tr>
	<tr><td><input type='submit' name="save_holiday" value='Save' class='button'><td></tr>
	</table>
</form>


 <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "holidays";
        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts' id="holiday_list_all">
            <thead><tr>
                <th class="manage-column ss-list-width">Holiday name</th>
                <th class="manage-column ss-list-width">Date</th>
                <!-- <th class="manage-column ss-list-width">Action</th> -->
                
            </tr></thead>
                

            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->holiday_name; ?></td>
                    <td class="manage-column ss-list-width"><?php  echo date("d-m-Y", strtotime($row->date)); ?></td>
                    <!-- <td class="manage-column ss-list-width"><?php  echo $row->day; ?></td> -->
                    
                    
               </tr>
            <?php } ?>
        </table>




<?php
if (isset($_POST['save_holiday'])) {
	 global $wpdb;
	 $table_name = $wpdb->prefix . "holidays";
	 $holiday_name = $_POST["holiday_name"];
     $holiday_date=$_POST["holiday_date"];
     $holiday_date = date("Y-m-d", strtotime($holiday_date));  
	$wpdb->insert(
                $table_name, //table
                array('holiday_name' => $holiday_name,
					 'date' => $holiday_date,
                   	), //data
                array('%s', '%s') //data format			
        );
	echo "<meta http-equiv='refresh' content='0'>";
   
	
}

}

?>