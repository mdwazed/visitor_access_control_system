<?php

if(isset($_POST["btn_approve"])){

	$status = $_REQUEST['status'];

	 while (list ($key,$val) = @each ($status)) {

		$query_app = "Update tbl_pass_foreigner set `approvalStatus` = 1 where `visitorName`='".$val."' ";      ///  could it chk with  other ID??  ??
		$result_app =	$db->execQuery($query_app) or die("Error: " . mysql_error());
	} 
}

if(isset($_POST["btn_deny"])){

	$status = $_REQUEST['status'];

	 while (list ($key,$val) = @each ($status)) {

		$query_app = "Update tbl_pass_foreigner set `approvalStatus` = 2 where `visitorName`='".$val."' ";      ///  could it chk with  other ID??  ??
		$result_app =	$db->execQuery($query_app) or die("Error: " . mysql_error());
	} 
}
?>

<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top"> 
			<h4>Pending Foreigner Pass</h4>
            
            <TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>

	<TR>
		<TD>	
        
        	<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">
                      
                          <tr>
                                <td bgcolor="#DFDFDF" align="center"><strong>Select</strong></td>                          
                                <td width="25%"  bgcolor="#DFDFDF" align="center"><strong>Visitor Name</strong></td>
                                <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Country </strong></td>
                                <td width="20%"  bgcolor="#DFDFDF" align="center"><strong>Address</strong></td>
                                <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Directorate </strong></td>
                                <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Purpose </strong></td>
                                <td width="20%"  bgcolor="#DFDFDF" align="center"><strong>Scheduled Date </strong></td>
                                
                          </tr>
                         
<?php

		$rowsPerPage = 5;		
		$pageNum = 1;
		
		if(isset($_REQUEST['page'])){
			$pageNum = $_REQUEST['page'];
		}
		
		
		$offset = ($pageNum - 1) * $rowsPerPage;
				
				
		$sql_search = "SELECT rowID,visitorName,visitorCountry FROM tbl_pass_foreigner  WHERE approvalStatus = 0 ORDER BY rowID DESC LIMIT ".$offset.",".$rowsPerPage;
		
		$result_all_rows = $db->execQuery($sql_search);
				
		$result_array = $db->resultArray($result_all_rows);	  
		
		$num_of_rows_found=mysql_num_rows($result_all_rows);


	if($num_of_rows_found<=0){
?>

				<tr>
					<td bgcolor="#EEEEEC" align="center" height="20" style="color:#990000"  colspan="8">No data found.</td>
				</tr>		
<?php		
		}
		
		else{
		
				for($i=0; $i<$num_of_rows_found; $i++){
				
					
		
					$sql = "SELECT visitorAddress, directorateToVisit,purposeOfVisit,scheduledVisitDate FROM tbl_pass_foreigner WHERE visitorName = "."'".$result_array[$i]['visitorName']."'";
					$result_all_rows = $db->execQuery($sql);
					$result_array_registration = $db->resultArray($result_all_rows);	  		
?>						 

<form name="foreigner_approval" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=foreigner_approval" method="post" onsubmit="return validate();">
 
		<tr>
            <td bgcolor="#EEEEEC" align="center"><input type="checkbox" name="status[]" value="<?php echo $result_array[$i]['visitorName'];?>" /></td>						        
        	<td bgcolor="#EEEEEC" align="center"><?php  if (isset($result_array[$i]['visitorName'])) echo $result_array[$i]['visitorName'];?></td>
			<td bgcolor="#EEEEEC" align="center"><?php  if (isset($result_array[$i]['visitorCountry'])) echo $result_array[$i]['visitorCountry'];?></td>
			<td bgcolor="#EEEEEC" align="center"><?php  if (isset($result_array_registration[0]['visitorAddress'])) echo $result_array_registration[0]['visitorAddress'];?></td>
            <td bgcolor="#EEEEEC" align="center"><?php  
				if (isset($result_array_registration[0]['directorateToVisit'])){

				$sql_search = "SELECT directorateName FROM tbl_directorate WHERE rowID = '".$result_array_registration[0]['directorateToVisit']."'";
				$result_row_directorate = $db->execQuery($sql_search);
				$result_array_directorate = $db->resultArray($result_row_directorate);	  

				echo $result_array_directorate[0]['directorateName'];
					
			}?></td>
            
            <td bgcolor="#EEEEEC" align="center"><?php 		
				if (isset($result_array_registration[0]['purposeOfVisit'])){

				$sql_search = "SELECT purposeName FROM tbl_visit_purpose WHERE rowID = '".$result_array_registration[0]['purposeOfVisit']."'";
				$result_row_purpose = $db->execQuery($sql_search);
				$result_array_purpose = $db->resultArray($result_row_purpose);	  

				echo $result_array_purpose[0]['purposeName'];
					
			}		?></td>
            <td bgcolor="#EEEEEC" align="center"><?php  if (isset($result_array_registration[0]['scheduledVisitDate'])) echo $result_array_registration[0]['scheduledVisitDate'];?></td>
            
		</tr>  
        
<?php
		}
?>  
				<tr>

					<td bgcolor="#EEEEEC" align="center" height="20"  colspan="7"></td>
				</tr>

				<tr class="Text" align="center">
                  <td align="center"><strong><input type="submit" value="Approve" name="btn_approve" /></strong></td>
                  <td align="left"><strong><input type="submit" value="Deny" name="btn_deny" /></strong></td>                  
                  <td height="20" colspan="4">
<?php

		$query = "SELECT * FROM tbl_pass_foreigner where approvalStatus = 0";		
		
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
			  $nav .= " <a href=\"$self?action=foreigner_approval&page=$page\">$page</a> ";
		   } 
		}
		
		if ($pageNum > 1)
		{
		   $page  = $pageNum - 1;
		   $prev  = " <a href=\"$self?action=foreigner_approval&page=$page\">[Prev]</a> ";
		
		   $first = " <a href=\"$self?action=foreigner_approval&page=1\">[First Page]</a> ";
		} 
		else
		{
		   $prev  = '&nbsp;'; // we're on page one, don't print previous link
		   $first = '&nbsp;'; // nor the first page link
		}
		if ($pageNum < $maxPage)
		{
		   $page = $pageNum + 1;
		   $next = " <a href=\"$self?action=foreigner_approval&page=$page\">[Next]</a> ";
		
		   $last = " <a href=\"$self?action=foreigner_approval&page=$maxPage\">[Last Page]</a> ";
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
</form>


                        
            </table>						                        
        </TD>
	</TR>
</TABLE>

            
		</td>
	


        <td align="left" width="20%">
			<?php  
            if (isset($_SESSION['_userName'])) {
            
                include('includes/sidebar.php'); 
            
            }
            ?>
        </td>
        
	</tr>
</table>


