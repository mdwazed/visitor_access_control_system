<?php
		$image_Pending_Registration="";       /* new icon for pending user approval */
		
		$sql_search = "SELECT userName FROM tbl_user_info  WHERE approvalStatus = 0";		
		$result_all_rows = $db->execQuery($sql_search);				
		$result_array = $db->resultArray($result_all_rows);	  		
		$num_of_rows_found=mysql_num_rows($result_all_rows);
		if($num_of_rows_found>0){
			$image_Pending_Registration = "images/new-icon.jpg";
		}

		
		$image_Pending_Temporary="";       /* new icon for temporary pass approval */
		
		$sql_search = "SELECT visitorName FROM tbl_pass_temporary  WHERE approvalStatus = 0";		
		$result_all_rows = $db->execQuery($sql_search);				
		$result_array = $db->resultArray($result_all_rows);	  		
		$num_of_rows_found=mysql_num_rows($result_all_rows);
		if($num_of_rows_found>0){
			$image_Pending_Temporary = "images/new-icon.jpg";
		}
		
		
		
		$image_Pending_Foreigner="";       /* new icon for foreigner pass approval */
		
		$sql_search = "SELECT visitorName FROM tbl_pass_foreigner  WHERE approvalStatus = 0";		
		$result_all_rows = $db->execQuery($sql_search);				
		$result_array = $db->resultArray($result_all_rows);	  		
		$num_of_rows_found=mysql_num_rows($result_all_rows);
		if($num_of_rows_found>0){
			$image_Pending_Foreigner = "images/new-icon.jpg";
		}	
		
		
		$image_Notification_Officer="";       /* notification icon for temp /foreigner pass approval */
		
$whereQ= "WHERE passCreator = '". $_SESSION["_userName"] ."' AND approvalStatus = 1 AND officerNotified = 'no'";

$sql_search =  "( SELECT rowID , visitorName, 'Foreigner' AS visitorType, visitorAddress, visitorCountry, directorateToVisit, purposeOfVisit, scheduledVisitDate AS startDate, 'NA' AS endDate FROM tbl_pass_foreigner ".$whereQ ." ) UNION (SELECT rowID , visitorName, visitorType, visitorAddress, 'BD' AS visitorCountry, directorateToVisit, purposeOfVisit, startDate, endDate FROM tbl_pass_temporary ".$whereQ ." )";


		
		$result_all_rows = $db->execQuery($sql_search);				
		$result_array = $db->resultArray($result_all_rows);	  		
		$num_of_rows_found=mysql_num_rows($result_all_rows);
		if($num_of_rows_found>0){
			$image_Notification_Officer = "images/new-icon.jpg";
		}	


		$image_notify_unusual_entry="";      /* notification icon for unusual entries of visitors */

		$noOfVisits='';
		$sql_search = sprintf("SELECT * FROM tbl_admin_config WHERE rowID = 1 ")or die(mysql_error());							
		$result_all_rows = $db->execQuery($sql_search);				
		$result_array = $db->resultArray($result_all_rows);	  		
		$noOfVisits = $result_array[0]['noOfVisits'];
		

        $sql_search = "SELECT * FROM tbl_pass WHERE adminNotified <> 'yes' AND DATEDIFF( CURDATE( ) , scheduledVisitDate ) < 30 GROUP BY mobileNumber HAVING (COUNT( mobileNumber ) > '".$noOfVisits."')";

		$result_all_rows = $db->execQuery($sql_search);				
		$result_array = $db->resultArray($result_all_rows);	  		
		$num_of_rows_found=mysql_num_rows($result_all_rows);
		if($num_of_rows_found>0){
			$image_notify_unusual_entry = "images/new-icon.jpg";
		}	

//-----------------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------


		$image_Approved_Foreigner_Notify_Admin="";       /* new icon for foreigner pass approval */
		
		$sql_search = "SELECT visitorName FROM tbl_pass_foreigner WHERE approvalStatus = 1 AND adminNotified = 'no'";
		$result_all_rows = $db->execQuery($sql_search);				
		$result_array = $db->resultArray($result_all_rows);	  		
		$num_of_rows_found=mysql_num_rows($result_all_rows);
		if($num_of_rows_found>0){
			$image_Approved_Foreigner_Notify_Admin = "images/new-icon.jpg";
		}	


		$image_Approved_Foreigner_Notify_Officer="";       /* new icon for foreigner pass approval */
		
		$sql_search = "SELECT visitorName FROM tbl_pass_foreigner  WHERE passCreator = '". $_SESSION["_userName"] ."' AND approvalStatus = 1 AND officerNotified = 'no'";
		$result_all_rows = $db->execQuery($sql_search);				
		$result_array = $db->resultArray($result_all_rows);	  		
		$num_of_rows_found=mysql_num_rows($result_all_rows);
		if($num_of_rows_found>0){
			$image_Approved_Foreigner_Notify_Officer = "images/new-icon.jpg";
		}	

?>

<div id="sidebar">

<?php	
if ($_SESSION['_userType'] == 1) {
?>



<h4><em>Actions</em></h4>
    
  <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=registration">Create User</a></li>      
   	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_user_list">User List</a></li> 
    <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_pass_list_admin">Recent PassList </a>       

	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_pass_list_archive">Archived PassList</a></li> </br>
    
    <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=reports_list">Reports</a> 
 
 </br>
 
 <h4><em>Pending</em></h4>   
 
    <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=registration_approval">User Approval</a>     
    	<?php if($image_Pending_Registration!=""){	?> &nbsp;<img src="<?php echo $image_Pending_Registration;?>" height="15" width="28" /> <?php } ?> </li>

    <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=temporary_approval">Temp  Pass</a> 
		<?php if($image_Pending_Temporary!=""){	?> &nbsp;<img src="<?php echo $image_Pending_Temporary;?>" height="15" width="28" /> <?php } ?> </li>

</br>
    
    
    
    
    
    <h4><em>Notifications</em></h4>
       
              <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_pass_list_unusual_entry">Excessive Entry</a>     
    	<?php if($image_notify_unusual_entry!=""){	?> &nbsp;<img src="<?php echo $image_notify_unusual_entry;?>" height="15" width="28" /> <?php } ?> </li> 
       
        <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=foreigner_approval_notification_admin">Approved Foreigner</a> 
		<?php if($image_Approved_Foreigner_Notify_Admin!=""){	?> &nbsp;<img src="<?php echo $image_Approved_Foreigner_Notify_Admin;?>" height="15" width="28" /> <?php } ?> </li>
    
       

 </br>       
        
        
    
    
 <h4><em>Setup</em></h4> 
 
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_rank">Setup Rank</a></li>
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_directorate">Setup Directorate</a></li>    
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_appointment">Setup Appointment</a></li>       
    <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_visit_purpose">Setup Visit Purpose</a></li>     </br> 
    
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=upload_policy">Upload Policy</a></li>               

	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=admin_configuration">Configuration</a></li>    
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=change_password">Change Password</a></li>

<?php
}


else if ($_SESSION['_userType'] == 2){

?>

 <h4><em>Actions</em></h4>
 	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=create_pass">General Pass</a></li>
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=create_pass_temporary">Temporary Pass</a></li>
 	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=create_pass_foreigner">Foreigner Pass</a></li>  </br>
	
	
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_pass_list_officer">View Pass List</a></li>  
    <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=notification_officer"> Notifications</a>    
		<?php if($image_Notification_Officer!=""){	?> &nbsp;<img src="<?php echo $image_Notification_Officer;?>" height="15" width="28"  /><?php } ?> </li> 
    
           <?php /*?> <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=foreigner_approval_notification_officer">Approved Foreigner  Pass</a> 
		<?php if($image_Approved_Foreigner_Notify_Officer!=""){	?> &nbsp;<img src="<?php echo $image_Approved_Foreigner_Notify_Officer;?>" height="15" width="30" /> <?php } ?> </li> <?php */?>
</br>    
    </br>         
    
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=change_password">Change Password</a></li>


    <?php
}
else if ($_SESSION['_userType'] == 3){

?>
    </fieldset>
    
<h4><em>Current Pass</em></h4>

	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=search_pass_current">Search Pass</a></li>
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_pass_list_partial&criterion=open">Todays Pass List</a></li>
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_pass_list_partial&criterion=running">'Running' Pass List</a></li>
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_pass_list_partial&criterion=closed">'Closed' Pass List</a></li></br>
    
<h4><em>Previous Pass</em></h4>
  <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=search_pass_previous">Show All Pass</a></li></br>


<h4><em>Special Pass</em></h4>

    <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=search_temporary_pass">Temporary Pass List</a></li>
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=search_foreigner_pass">Foreigner Pass List</a></li></br>


<?php
}
else if ($_SESSION['_userType'] == 4){

?>

<h4><em>Actions</em></h4>
 	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=create_pass">General Pass</a></li>
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=create_pass_temporary">Temporary Pass</a></li>
 	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=create_pass_foreigner">Foreigner Pass</a></li>     
	 </br> 
   
	
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_pass_list_officer">View Pass List</a></li>
    <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=notification_officer"> Notifications</a>
		<?php if($image_Notification_Officer!=""){	?> &nbsp;<img src="<?php echo $image_Notification_Officer;?>" height="15" width="28"  /><?php } ?> </li> </br>    
    </br> 
    
    <h4><em>Approve</em></h4>
     <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=foreigner_approval">Foreigner Approval </a> 
		<?php if($image_Pending_Foreigner!=""){	?> &nbsp;<img src="<?php echo $image_Pending_Foreigner;?>" height="15" width="28"  /><?php } ?> </li> 	
    </br> 
    
	<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=change_password">Change Password</a></li>

    <?php
}

?>
</div> <!-- end #sidebar -->
