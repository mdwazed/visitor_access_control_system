<script language = "Javascript">

$(function() {

		$( "#datepicker_past1" ).datepicker( { dateFormat: 'dd-mm-yy', maxDate: 0 });	
		$( "#datepicker_past2" ).datepicker( { dateFormat: 'dd-mm-yy', maxDate: 0 });			

	});

function validateForm() {

	if (document.getElementById('datepicker_past1').value=="") {
		alert("Please select the From date.");
		return false;
	}

	if (document.getElementById('datepicker_past2').value=="") {
		alert("Please select the To date.");
		return false;
	}

	if ((document.getElementById('datepicker_past1').value) > (document.getElementById('datepicker_past2').value)) {
		alert("Invalid Date Range!\nFrom Date cannot be after To Date!")
		return false;
	}

}

//}

</script>
<?php

$current_value='';

if(isset($_POST['submit_no_of_visits'])){

		$query1 = sprintf("UPDATE tbl_admin_config SET noOfVisits = ('%s') WHERE rowID = 1 ", mysql_real_escape_string($_POST['no_of_visits']) )or die(mysql_error());							
		
		$sql1 = mysql_query($query1);
		
		if ($sql1){
			$message1 = "Data saved successfully";
		}
		else{
			$message1 = "Data could not be saved";
		}
}
else{
		$sql_search = sprintf("SELECT * FROM tbl_admin_config WHERE rowID = 1 ")or die(mysql_error());							
		$result_all_rows = $db->execQuery($sql_search);				
		$result_array = $db->resultArray($result_all_rows);	  		
		$current_value = $result_array[0]['noOfVisits'];
}

?> 

<?php

//	$message = '';

if(isset($_POST['submit_archive_delete'])){

		$query1 = sprintf("DELETE FROM tbl_archive_pass WHERE scheduledVisitDate BETWEEN '%s' AND '%s'", 
					mysql_real_escape_string($_POST['from_date']),
					mysql_real_escape_string($_POST['to_date']) )or die(mysql_error());							
		

		$sql1 = mysql_query($query1);
		
		if ($sql1){

			$message2 = mysql_affected_rows()." record(s) deleted.";
		}
		else{
			$message2 = "Data could not be deleted.";
		}
}
//onSubmit="validateDate('from_date');"
?> 

<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Configuration</h4>
            
	<table bordercolor="#006666" border="0"  width="100%"  >         <!--      bgcolor="#EEEEEC"       -->


	<tr>
    <td align="center" >
    
   
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=admin_configuration" method="post">
     
        <table  bgcolor="#EEEEEC" width="100%" align="right" >
        
        <tr bgcolor="#DFDFDF"><td colspan="3" align="center" style="color:#990000">
           <h5><?php if(isset($message1)) echo $message1; ?></h5>
        </td></tr>

        <tr>
            <td colspan="3" align="center" style="color:#3333FF" >Number of visits (during the past 30 days) which is considered unusual.            </td>
        </tr>
        
        <tr ><td colspan="3" align="center" style="color:#990000">&nbsp;
        </td></tr>
        
        <tr>
                    <td width="460" align="right"><strong>No of Visits</strong></td>
                    <td width="35" align="center">:</td>
                  <td width="460"><input type="text" name="no_of_visits" value="<?php echo $current_value; ?>" /> </td>
        </tr>    


        <tr >
                    <td colspan="2">&nbsp; </td>
           		  <td><input type="submit" name="submit_no_of_visits" value="Save" /></td>
        </tr>
        <tr >
                    <td colspan="3">&nbsp; </td>           		
        </tr>
        </table>
        
    </form> 

</td>

  </tr>

	<tr>
    <td align="center" >
    
   
    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>?action=admin_configuration" method="post" onsubmit="return validateForm();" >
     
        <table  bgcolor="#EEEEEC" width="100%" align="right" >

        <tr bgcolor="#DFDFDF"><td colspan="5" align="center" style="color:#990000">
           <h5><?php if(isset($message2)) echo $message2; ?></h5>
        </td></tr>
        
        <tr>
            <td colspan="5" align="center" style="color:#3333FF" >Deletion of Previous pass informations within a date bracket.          </td>
        </tr>        
            
        <tr>
            <td colspan="4" align="center" >&nbsp;           
            </td>
        </tr>    

       
        <tr>
                    <td width="428" align="right"><strong>From</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="text" name="from_date" id="datepicker_past1" /></td>
        </tr>
        

		 <tr>
                    <td width="428" align="right"><strong>To</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="text" name="to_date" id="datepicker_past2" /></td>
        </tr>



        <tr >
                    <td colspan="2">&nbsp; </td>
           		  <td width="138"><input type="submit" name="submit_archive_delete" value="Detele" /></td>
                  <td width="292">&nbsp;</td>
        </tr>
        <tr >
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
