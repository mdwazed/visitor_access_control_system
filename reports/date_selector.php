<script language = "Javascript">

$(function() {

//		$( "#datepicker_past1" ).datepicker( { dateFormat: 'dd-mm-yy' });	
//		$( "#datepicker_past2" ).datepicker( { dateFormat: 'dd-mm-yy', maxDate: 5 });
		// For Report
		//$( "#datepicker_past5" ).datepicker( { dateFormat: 'dd-mm-yy', maxDate: -30 });	
		//$( "#datepicker_past6" ).datepicker( { dateFormat: 'dd-mm-yy', maxDate: -30 });					

});


function validateForm() {

	if (document.getElementById('datepicker_past5').value=="") {
		alert("Please select the From date.");
		return false;
	}

	if (document.getElementById('datepicker_past6').value=="") {
		alert("Please select the To date.");
		return false;
	}

	if ((document.getElementById('datepicker_past5').value) > (document.getElementById('datepicker_past6').value)) {
		alert("Invalid Date Range!\n'From Date' cannot be after 'To Date'!")
		return false;
	}

}

//}

</script>


<?php


//	$message = '';

if(isset($_POST['submit_report_date'])){

		$from_date = $db->changeFormatDate($_POST['from_date']);       //need to forward this date to the field of visitor_inrange.php
		$to_date = $db->changeFormatDate($_POST['to_date']);
		
		
	
	// ########## added above to shift data to tbl_deleted_pass
	//	$query1 = sprintf("DELETE FROM tbl_archive_pass WHERE scheduledVisitDate BETWEEN '%s' AND '%s'", 
	//				$from_date,
	//				$to_date )or die(mysql_error());	

	//	$sql1 = mysql_query($query1);		
		
		//	if ($sql1){	
		//		$message2 = mysql_affected_rows()." record(s) deleted.";
		//	}
		//	else{
		//		$message2 = "Data could not be deleted.";
	//}		
}

?> 

<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Select Date Range </h4>
            
	<table bordercolor="#006666" border="0"  width="100%"  >         <!--   bgcolor="#EEEEEC"       -->


	<tr>
    <td align="center" >   
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=date_selector" method="post">            
        
    </form> 
</td>
  </tr>
	<tr>
    <td align="center" >
    


   
    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>?action=date_selector" method="post" onsubmit="return validateForm();" >
     
        <table  bgcolor="#EEEEEC" width="100%" align="right" >

        <tr bgcolor="#DFDFDF"><td colspan="5" align="center" style="color:#990000">
           <h5>    <?php if(isset($message2)) echo $message2; ?></h5> 
        </td></tr>
        
        <tr>
            <td colspan="5" align="center" style="color:#3333FF" >  Select date range to view visitor's state.  </td>
        </tr>        
            
        <tr>
            <td colspan="4" align="center" >&nbsp;           
            </td>
        </tr>    

       
        <tr>
                    <td width="428" align="right"><strong>From</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="text" name="from_date" id="datepicker_past5" /></td>
        </tr>
        

		 <tr>
                    <td width="428" align="right"><strong>To</strong></td>
                  <td width="32" align="center">:</td>
                  <td colspan="2"><input type="text" name="to_date" id="datepicker_past6" /></td>
        </tr>


        <tr >
                    <td colspan="2">&nbsp; </td>
           		  <td width="138"><input type="submit" name="submit_report_date" value="Submit" /></td>
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
		
            
        </td>
        
	</tr>
</table>
