<?php
if(isset($_POST['submit'])){

    if(   empty($_POST['visitor_name'])  ||  ($_POST['visitor_type'] == "Please Select")  ||  ($_POST['directorate_to_visit'] == "Please Select") ||  empty($_POST['scheduled_visit_date']) ){

        # if a field is empty, or the passwords don't match make a message
		$message = '';

        if(empty($_POST['visitor_name'])){
            $message .= 'Visitor Name can\'t be empty<br>';	
        }

        if( $_POST['visitor_type'] == "Please Select" ){
            $message .= 'Visitor Type must be selected<br>';
//			echo 'visitor_type : '. $_POST['visitor_type'];
        }
		
        if( $_POST['directorate_to_visit'] == "Please Select"){
            $message .= 'Directorate must be selected<br>';
        }

        if(empty($_POST['scheduled_visit_date'])){
            $message .= 'Scheduled Visit Date can\'t be empty<br>';
        }

//        if($row){
//            $message .= 'User Name already exists<br>';
//        }

		$message .= '</p>';
		
    }
	else{
	
		if( isset($_POST['chk_multiple_entry'])){
			$_POST['chk_multiple_entry']="yes";		
		}
		else{
			$_POST['chk_multiple_entry']="no";			
		}

		$postdate = $_POST['scheduled_visit_date'];
		$insertdate = $db->changeFormatDate($postdate);
		
		
		$query = sprintf("INSERT INTO tbl_pass (visitorName, visitorType, visitorAddress, directorateToVisit, purposeOfVisit, mobileNumber, scheduledVisitDate, isMultipleEntry, passCreator, passStatus)
            VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",

			mysql_real_escape_string($_POST['visitor_name']),
			mysql_real_escape_string($_POST['visitor_type']),						
			mysql_real_escape_string($_POST['visitor_address']),			
			mysql_real_escape_string($_POST['directorate_to_visit']),			
			mysql_real_escape_string($_POST['purpose_of_visit']),
			mysql_real_escape_string($_POST['mobile_number']),			
			mysql_real_escape_string($insertdate),
			mysql_real_escape_string($_POST['chk_multiple_entry']),			
			$_SESSION['_userName'],
			mysql_real_escape_string('open') ) or die(mysql_error());

		$sql = mysql_query($query);
		

		if ($sql){

				$message = "Pass Creation Successful";
		}
		else{
			$message = "Pass could not be created";
		}
    }
}

?> 

<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Regular Pass</h4>
            
	<table bordercolor="#006666" border="0"  width="100%"  >         <!--      bgcolor="#EEEEEC"       -->
	<tr>
    <td align="center" >
    
   
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=create_pass" method="post">
     
        <table  bgcolor="#EEEEEC" width="100%" align="right" >
        
        <tr bgcolor="#DFDFDF">
        	<td colspan="4" align="center" style="color:#990000">
	           <h5><?php if(isset($message)) echo $message; ?></h5>        	</td>
        </tr>

        <tr><td colspan="4" align="center" >&nbsp;
           
        </td></tr>    
            
        <tr>
                    <td width="428" align="right"><strong>Visitor Name</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="text" name="visitor_name" /><? echo 'value="'.$_POST['visitor_name'].'"'; ?> </td>
        </tr>

        <tr>
                  <td width="428" align="right"><strong>Visitor Type</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2">
                  
                  <select name="visitor_type">
                      <option selected>Please Select</option>
                      <option value="Military">Military</option>
                      <option value="Civilian">Civilian</option>
        	      </select> <? //if(!$row){echo 'value="'.$_POST['visitor_type'].'"';} ?></td>                         
		</tr>       
         
        
        <tr>
                    <td width="428" align="right"><strong>Address</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="text" name="visitor_address" /><? echo 'value="'.$_POST['visitor_address'].'"'; ?></td>
        </tr>
        
        
<!--------------------------------------------------------------------------------------------------------------------->
<tr>
                    <td width="428" align="right"><strong>Directorate to Visit</strong></td>
                  <td width="32" align="center">:</td>                                    
                  <td colspan="2"><select name="directorate_to_visit">
                         <option selected>Please Select</option>
                    
<?php

$sql_search = "SELECT rowID,directorateName FROM tbl_directorate WHERE isDisabled ='no' ORDER BY rowID";
$result_all_rows = $db->execQuery($sql_search);		
$num_of_rows_found=mysql_num_rows($result_all_rows);

if($num_of_rows_found>0){

		$result_array = $db->resultArray($result_all_rows);
		for($i=0; $i<$num_of_rows_found; $i++){		
?>
                    	<option value="<?php echo $result_array[$i]['rowID'];?>"><?php echo $result_array[$i]['directorateName'];?></option>
<?php
		}		
}
?>
         				</select> <? if(!$row){echo 'value="'.$_POST['directorate'].'"';} ?></td>                         
</tr>       
<!--------------------------------------------------------------------------------------------------------------------->       
       
<tr>
                    <td width="428" align="right"><strong>Purpose of Visit</strong></td>
                  <td width="32" align="center">:</td>                                    
                  <td width="138"><select name="purpose_of_visit">
                    
<?php

$sql_search = "SELECT rowID,purposeName FROM tbl_visit_purpose WHERE isDisabled ='no' ORDER BY rowID";
$result_all_rows = $db->execQuery($sql_search);		
$num_of_rows_found=mysql_num_rows($result_all_rows);

if($num_of_rows_found>0){

		$result_array = $db->resultArray($result_all_rows);
		for($i=0; $i<$num_of_rows_found; $i++){		
?>
                    	<option value="<?php echo $result_array[$i]['rowID'];?>"><?php echo $result_array[$i]['purposeName'];?></option>
<?php
		}		
}
?>
         				</select> 
                    <? if(!$row){echo 'value="'.$_POST['purpose_of_visit'].'"';} ?></td>                    
                  <td width="292">&nbsp;</td>
</tr>




		 <tr>
                    <td width="428" align="right"><strong>Mobile Number</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="text" name="mobile_number" /><? echo 'value="'.$_POST['mobile_number'].'"'; ?></td>
        </tr>


        <tr>
                    <td width="428" align="right"><strong>Scheduled Visit Date</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="text" name="scheduled_visit_date" id="datepicker_future1" /><? echo 'value="'.$_POST['scheduled_visit_date'].'"'; ?></td>
        </tr>
        

        <tr >
                    <td colspan="2">&nbsp; </td>
           		  <td><input type="submit" name="submit" value="Create Pass" /></td>
                  <td width="292"><input type="checkbox"  name="chk_multiple_entry"  />
                      <font color="#990066"> Multiple Entry</font></td>
        </tr>
        <tr bgcolor="#DFDFDF">
                    <td colspan="4">&nbsp; </td>           		
        </tr>
        </table>
        
    </form> 

</td>

  </tr>
    </table>
            
		</td>

        <td align="left" width="20%" valign="top" >
			<?php  
            if (isset($_SESSION['_userName'])) {
            
                include('includes/sidebar.php'); 
            
            }			 
            ?>
            
        </td>
        
	</tr>
</table>