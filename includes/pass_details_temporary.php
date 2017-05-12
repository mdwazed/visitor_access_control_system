<?php


if(isset($_POST['submit'])){


    if(   (empty($_POST['mobile_number']) && empty($_POST['national_ID']))  ||  empty($_POST['card_number']) ){

		$message = '';
		
        if(     empty($_POST['mobile_number']) && empty($_POST['national_ID'])      ){

            $message .= 'Mobile Number & National ID both can\'t be empty<br>';
        }
	
        if(empty($_POST['card_number'])){

            $message .= 'Card Number can\'t be empty<br>';
        }

		$message .= '</p>';
		
    }
	else{
		
		$query = sprintf("UPDATE tbl_pass_temporary SET mobileNumber = '%s', nationalID = '%s', visitorCardNo = '%s', visitorInTime = '%s', passStatus = '%s'
		 WHERE rowID = '" .$_REQUEST['passID']. "'",

			mysql_real_escape_string($_POST['mobile_number']),
			mysql_real_escape_string($_POST['national_ID']),						
			mysql_real_escape_string($_POST['card_number']),			
			mysql_real_escape_string(date('Y-m-d H:i:s')), 
			'running' ) or die(mysql_error());
			
		$sql = mysql_query($query);
		
		if ($sql){

				$message = "Pass Update Successful";
		}
		else{
				$message = "Pass could not be updated";
		}		
    }
	
}

$sql_search = "SELECT * FROM tbl_pass_temporary WHERE rowID = '" . $_REQUEST['passID'] . "'" ;
$result_all_rows = $db->execQuery($sql_search);
$result_array = $db->resultArray($result_all_rows);
?> 


<?php
if(isset($_POST['photoBtn'])){
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=take_photo<?php  ;?>" method="post">

<?php
}
?>



<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Temporary Pass Details</h4>
            
	<table bordercolor="#006666" border="0"  width="100%"  >         <!--      bgcolor="#EEEEEC"       -->
	<tr>
    <td align="center" >
   
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=pass_details_temporary&passID=<?php echo $result_array[0]['rowID'];?>" method="post">
     
        <table  bgcolor="#EEEEEC" width="100%" align="right" >
        
        <tr bgcolor="#66CCCC">
        	<td colspan="6" align="center" style="color:#990000">
	           <h5><?php if(isset($message)) echo $message; ?></h5>        	</td>
        </tr>

        <tr><td colspan="6" align="center" >&nbsp;
           
        </td></tr>    
            
            
            
            
            
    
<?php

if($result_array[0]['passStatus']!='open'){
	$visitorType = 'TV';
	$visitorPassID = $result_array[0]['rowID'];
	$image_Visitor_Photo = ("VisitorPhotosNew/".$visitorType."_".$visitorPassID. ".jpg");
?>            
        <tr>
                  <td width="232" align="right"><strong>Visitor Photo</strong></td>
                  <td width="9" align="center">:</td>
                  <td width="233" colspan="4">&nbsp;
				      <?php if($image_Visitor_Photo!=""){	?> <img src="<?php echo $image_Visitor_Photo;?>" height="180" width="240" /> <?php } ?>                  
                  </td>
        </tr>
        <tr><td>&nbsp; </td></tr>
<?php
}
?>        
            
            
            
            
            
            
            
            
        <tr>
                  <td width="232" align="right"><strong>Visitor Name</strong></td>
                  <td width="9" align="center">:</td>
                  <td width="233"><?php if (isset($result_array[0]['visitorName'])) echo $result_array[0]['visitorName'];?></td>
                  <td width="215"><div align="right"><strong>Mobile Number</strong></div></td>
                  <td width="6">:</td>
            <td width="252"><input type="text" name="mobile_number" value = "<?php if (isset($result_array[0]['mobileNumber'])) echo $result_array[0]['mobileNumber'];?>" /></td>
        </tr>

        <tr>
                  <td width="232" align="right"><strong>Visitor Type</strong></td>
                  <td align="center">:</td>
                  <td width="233"><?php echo $result_array[0]['visitorType'];?></td>                         
		          <td width="215"><div align="right"><strong>National ID</strong></div></td>
                  <td width="6">:</td>
                  <td width="252"><input type="text" name="national_ID" value = "<?php if (isset($result_array[0]['nationalID'])) echo $result_array[0]['nationalID'];?>"/></td>
        </tr>       
       
        <tr>
                  <td width="232" rowspan="2" align="right" valign="top"><strong>Address</strong></td>
                  <td rowspan="2" align="center"  valign="top">:</td>
                  <td rowspan="2"><?php echo $result_array[0]['visitorAddress'];?>
                  <p>&nbsp;</p></td>
                  
                  <td  valign="top" align="right"><strong>Card Number</strong></td>
                  <td valign="top">:</td>
                  <td width="252" valign="top"><input type="text" name="card_number" value = "<?php if (isset($result_array[0]['visitorCardNo'])) echo $result_array[0]['visitorCardNo'];?>"/></td>
        </tr>
        
        
        
        
        
        
        <tr>

          <td valign="top" align="right">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top" align="left">
                 <?php 
				   if( ($result_array[0]['passStatus'] == 'open')&& ($_SESSION['_userType'] !=1 )){ 
				  
					  $_SESSION['visitorType'] = 'TV';  // Temporary Visitor
					  $_SESSION['visitorPassID'] = $result_array[0]['rowID'];			  
					  
				  
				  ?>
<!--          			<input type="button" name="photoBtn" id="photoBtn" value="Take Photo" onclick="parent.location='CapturePhoto/index.html'" -->
          			<input type="button" name="photoBtn" id="photoBtn" value="Take Photo" onclick="parent.window.open('CapturePhotoNew/index.html');" />                    
                    
                 <?php
				  }
				  ?>  </td>
        </tr>
        
        
        
        
        

		<tr>
                    <td width="232" align="right"><strong>Directorate</strong></td>
          <td align="center">:</td>                                    
                  <td><?php 	
				if (isset($result_array[0]['directorateToVisit'])){

				$sql_search = "SELECT directorateName FROM tbl_directorate WHERE rowID = '".$result_array[0]['directorateToVisit']."'";
				$result_row_directorate = $db->execQuery($sql_search);
				$result_array_directorate = $db->resultArray($result_row_directorate);	  

				echo $result_array_directorate[0]['directorateName'];		}	?>         </td>
                                         
                  <td><div align="right"><strong>In Time</strong></div></td>
                  <td>:&nbsp;</td>
                  <td>&nbsp;<?php 
						  if (isset($result_array[0]['visitorInTime'])){ 
						  		echo $result_array[0]['visitorInTime'];
						  }
					   ?>                   </td>                  
		</tr>       
   
       
<tr>
                  <td width="232" align="right"><strong>Purpose</strong></td>
      <td align="center">:</td>                                    
                 
                  <td> <?php if (isset($result_array[0]['purposeOfVisit'])){

				$sql_search = "SELECT purposeName FROM tbl_visit_purpose WHERE rowID = '".$result_array[0]['purposeOfVisit']."'";
				$result_row_purpose = $db->execQuery($sql_search);
				$result_array_purpose = $db->resultArray($result_row_purpose);	  
				echo $result_array_purpose[0]['purposeName'];		}?></td> 
                
                                   
                  <td><div align="right"><strong>Out Time</strong></div></td>
                  <td>:</td>
                  <!--<td><?php //print strftime('%c'); ?>&nbsp;</td>-->
                  
                  <td>&nbsp;<?php 
						  if (isset($result_array[0]['visitorOutTime'])){ 
						  		echo $result_array[0]['visitorOutTime'];
						  }	?></td>
        <tr>
                  <td width="232" align="right"><strong>Start Date</strong></td>
                  <td align="center">:</td>
                  <td><?php if (isset($result_array[0]['startDate'])) echo $result_array[0]['startDate'];?></td>
                  <td>&nbsp;</td>
          <td>&nbsp;</td>
  <td>&nbsp;</td>
        </tr>
        <tr>
                  <td width="232" align="right"><strong>End Date</strong></td>
                  <td align="center">:</td>
                  <td><?php if (isset($result_array[0]['endDate'])) echo $result_array[0]['endDate'];?></td>
                  <td><div align="right"></div></td>
                  <td>&nbsp;</td>
                  <td><?php 
				  if( ($result_array[0]['passStatus'] == 'open')&& ($_SESSION['_userType'] !=1 )){ 
				  ?>
                    <input type="submit" name="submit" value="Save" />
                  <?php
				  }
				  ?>                  </td>
        </tr>
        

        <tr >
                    <td colspan="2">&nbsp; </td>
           		    <td>&nbsp;</td>
           		    <td><div align="right"></div></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
        </tr>
        <tr bgcolor="#66CCCC">
                    <td colspan="6" align="center"><strong>Current Time :</strong>   <span id="date_time"></span></td>   
                                      <script type="text/javascript">window.onload = date_time('date_time');</script>             		
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