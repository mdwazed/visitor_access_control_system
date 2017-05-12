<?php

$whereQ= "";
$already_used_parameter="no";

if(  isset($_REQUEST["out"]) && $_REQUEST["out"] == "true"){

		$query = sprintf("UPDATE tbl_pass_temporary SET visitorOutTime = '%s', passStatus = '%s'
 		 WHERE rowID = '" .$_REQUEST['passID']. "'", 

			mysql_real_escape_string(date('Y-m-d H:i:s')),
			'closed' ) or die(mysql_error());
			
		$sql = mysql_query($query);

}

if(isset($_POST['submit'])){

		$whereQ="";
		$already_used_parameter="";

		if (!$_REQUEST['card_number']=="0" and !$_REQUEST['card_number']=="")
		{
			$whereQ.= " WHERE visitorCardNo LIKE '%".$_REQUEST['card_number']."%'";
			$already_used_parameter="yes";			
		}
		
		
		if (!$_REQUEST['visitor_name']=="0" and !$_REQUEST['visitor_name']=="")
		{
			if ($already_used_parameter=="yes")		
				$whereQ.= " and visitorName LIKE '%".$_REQUEST['visitor_name']."%%'";
			else{
				$whereQ.= " WHERE visitorName LIKE '%".$_REQUEST['visitor_name']."%'";
			}
			$already_used_parameter="yes";				
		}

		if (!$_REQUEST['mobile_number']=="0" and !$_REQUEST['mobile_number']=="")
		{
			if ($already_used_parameter=="yes")		
				$whereQ.= " and mobileNumber LIKE '%".$_REQUEST['mobile_number']."%' ";
			else{
				$whereQ.= " WHERE mobileNumber LIKE '%".$_REQUEST['mobile_number']."%'";
			}
			$already_used_parameter="yes";				
		}
		
		if (!$_REQUEST['directorate_to_visit']=="0" and !$_REQUEST['directorate_to_visit']=="")
		{		

			if ($already_used_parameter=="yes")		
				$whereQ.= " and directorateToVisit = '".$_REQUEST['directorate_to_visit']."'";
			else{
				$whereQ.= " WHERE directorateToVisit = '".$_REQUEST['directorate_to_visit']."'";
			}
			$already_used_parameter="yes";				

		}
		
		
		if (!$_REQUEST['pass_status']=="0" and !$_REQUEST['pass_status']=="")
		{
			
			if ($already_used_parameter=="yes")		
				$whereQ.= " and passStatus = '".$_REQUEST['pass_status']."'";
			else{
				$whereQ.= " WHERE passStatus = '".$_REQUEST['pass_status']."'";
			}
		}
}

?>

<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Temporary Pass</h4>
            
            <TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>

	<TR>
		<TD>	
        
        	<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">
<tr valign="middle">

                           <td width="15%"  bgcolor="#66CCCC" align="center"><strong>Card Number </strong></td>
                            <td width="15%"  bgcolor="#66CCCC" align="center"><strong>Visitor Name</strong></td>
                           <td width="15%"  bgcolor="#66CCCC" align="center"><strong>Mobile Number</strong></td>

                            <td width="15%"  bgcolor="#66CCCC" align="center"><strong>Directorate</strong></td>
                            <td width="15%"  bgcolor="#66CCCC"align="center"><strong>Pass Status</strong></td>
                            <td width="15%" colspan="5"  bgcolor="#66CCCC" align="center"><strong>&nbsp;</strong></td>
                            
</tr>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=search_temporary_pass" method="post">
<tr valign="middle">

	<td width="15%"  bgcolor="#9999FF" align="center"><strong><input type="text" name="card_number" /></strong></td>
	
    <td width="15%"  bgcolor="#9999FF" align="center"><strong><input type="text" name="visitor_name" /></strong></td>
    
     <td width="15%"  bgcolor="#9999FF"  align="center"><strong><input type="text" name="mobile_number" /></strong></td>

	<td width="15%"  bgcolor="#9999FF" align="center"><strong><select name="directorate_to_visit">
		<option value="" selected>Please Select</option>                    
					<?php
                    
                    $sql_search = "SELECT rowID,directorateName FROM tbl_directorate WHERE isDisabled= 'no' ORDER BY directorateName ";
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
         				</select></strong></td>
                        
	<td width="15%"  bgcolor="#9999FF" align="center"><strong><select name="pass_status">
                      <option value="" selected>Please Select</option>
                      <option value="open">Open</option>
                      <option value="running">Running</option>
<!--                      <option value="closed">Closed</option>   -->                   
        	      </select> </strong></td>
                  
	<td width="15%" colspan="5"  bgcolor="#9999FF" align="left"><strong><input type="submit" name="submit" value="Search Pass" /></strong></td>
                            
</tr>                      
</form>
<tr>
                           <td width="100%" colspan="10"  bgcolor="#FFFFFF" align="center">&nbsp;</strong></td>
</tr>
</table>              


<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">            


                          <tr>
                           <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Visiting Dir</strong></td>
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Visitor Name</strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Address </strong></td>
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Purpose of Visit</strong></td>
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Start Date</strong></td>                            
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>End Date</strong></td>                                                        
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>In Time</strong></td>
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Out Time</strong></td>                                                        
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>                                                                                    
                          </tr>
<?php

		$rowsPerPage = 20;		
		$pageNum = 1;
		
		if(isset($_REQUEST['page'])){
			$pageNum = $_REQUEST['page'];
		}
		
		
		$offset = ($pageNum - 1) * $rowsPerPage;
		

		$sql_search = "SELECT * FROM tbl_pass_temporary " . $whereQ ." ORDER BY directorateToVisit ASC LIMIT ".$offset.",".$rowsPerPage;

//echo $sql_search;
	
		$result_all_rows = $db->execQuery($sql_search);
				
		$result_array = $db->resultArray($result_all_rows);	  
		
		$num_of_rows_found=mysql_num_rows($result_all_rows);

		if($num_of_rows_found>0){
		
				for($i=0; $i<$num_of_rows_found; $i++){
				
?>						 
 
		<tr>
			<td bgcolor="#EEEEEC" align="center">
			
			<?php 
			
			if (isset($result_array[$i]['directorateToVisit'])){

				$sql_search = "SELECT directorateName FROM tbl_directorate WHERE rowID = '".$result_array[$i]['directorateToVisit']."'";
				$result_row_directorate = $db->execQuery($sql_search);
				$result_array_directorate = $db->resultArray($result_row_directorate);	  

				echo $result_array_directorate[0]['directorateName'];
					
			}		
			?>
            
            </td>
            
            <td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['visitorName'])) echo $result_array[$i]['visitorName'];?></td>
			<td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['visitorAddress']))echo $result_array[$i]['visitorAddress'];?></td>
            <td bgcolor="#EEEEEC" align="center">
			
			<?php 
			
			if (isset($result_array[$i]['purposeOfVisit'])){

				$sql_search = "SELECT purposeName FROM tbl_visit_purpose WHERE rowID = '".$result_array[$i]['purposeOfVisit']."'";
				$result_row_purpose = $db->execQuery($sql_search);
				$result_array_purpose = $db->resultArray($result_row_purpose);	  

				echo $result_array_purpose[0]['purposeName'];
					
			}		
			?>

            </td>
            <td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['startDate']))echo $result_array[$i]['startDate'];?></td>            
            
            <td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['endDate']))echo $result_array[$i]['endDate'];?></td>                        

            <td bgcolor="#EEEEEC" align="center">
            
            <?php if (isset($result_array[$i]['visitorInTime'])){

						echo $result_array[$i]['visitorInTime'];
						
  				   }
				   else{
				   		echo "N/A";
				   }		
			
			?>
            
            </td>

            <td bgcolor="#EEEEEC" align="center">
            
            <?php if (isset($result_array[$i]['visitorOutTime'])){

						echo $result_array[$i]['visitorOutTime'];
						
  				   }
				   else if (isset($result_array[$i]['visitorInTime'])) { 
			
			?>
				   
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=search_temporary_pass&page=<?php if(isset($_REQUEST['page'])) echo $_REQUEST['page']; else echo 1; 		 							?>&out=true&passID=<?php echo $result_array[$i]['rowID'];?>">Out</a>
		    <?php 
				   }
				   else{
				   		echo "N/A";
				   }		
			
			?>
            
            </td>

            <td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=pass_details_temporary&passID=<?php echo $result_array[$i]['rowID'];?>">Detail</a></td> 		        </tr>
<?php
		}
?>  
				<tr>
					<td bgcolor="#EEEEEC" align="center" height="20"  colspan="9"></td>
				</tr>

				<tr class="Text" align="center">
                  <td height="20" colspan="8">
<?php

		$query = "SELECT * FROM tbl_pass_temporary " . $whereQ ;
		
		
		$result  = mysql_query($query) or die('Error, query failed');
		$numrows     = mysql_num_rows($result);
		
		$maxPage = ceil($numrows/$rowsPerPage);
		
		$self = $_SERVER['PHP_SELF'];
		
		$nav  = '';
		
		for($page = 1; $page <= $maxPage; $page++)
		{
		   if ($page == $pageNum)
		   {
			  $nav .= " $page ";
		  }
		  else
		   {
			  $nav .= " <a href=\"$self?action=search_temporary_pass&page=$page\">$page</a> ";
		   } 
		}
		
		if ($pageNum > 1)
		{
		   $page  = $pageNum - 1;
		   $prev  = " <a href=\"$self?action=search_temporary_pass&page=$page\">[Prev]</a> ";
		
		   $first = " <a href=\"$self?action=search_temporary_pass&page=1\">[First Page]</a> ";
		} 
		else
		{
		   $prev  = '&nbsp;'; // we're on page one, don't print previous link
		   $first = '&nbsp;'; // nor the first page link
		}
		if ($pageNum < $maxPage)
		{
		   $page = $pageNum + 1;
		   $next = " <a href=\"$self?action=search_temporary_pass&page=$page\">[Next]</a> ";
		
		   $last = " <a href=\"$self?action=search_temporary_pass&page=$maxPage\">[Last Page]</a> ";
		} 
		else
		{
		   $next = '&nbsp;'; // we're on the last page, don't print next link
		   $last = '&nbsp;'; // nor the last page link
		}

		//echo $first . $prev . $nav . $next . $last;

		echo $first . $prev . " Showing page $pageNum of $maxPage pages " . $next . $last;

}
?></td></tr>
                        
            </table>						                        
        </TD>
	</TR>
</TABLE>
            
		</td>
	


<!--        <td align="left" width="20%">-->
			<?php  
//            if (isset($_SESSION['_userName'])) {
//            
//                include('includes/sidebar.php'); 
//            
//            }
            ?>
<!--        </td>-->
        
	</tr>
</table>