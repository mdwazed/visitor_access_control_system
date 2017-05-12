<?php

//$whereQ= "";
$whereQ= "WHERE approvalStatus = 1 AND adminNotified = 'no'";
//$already_used_parameter="no";

if(  isset($_REQUEST["notified"]) && $_REQUEST["notified"] == "true"){

	$query='';

	if(  isset($_REQUEST["passID"]) ){
		$query = sprintf("UPDATE tbl_pass_foreigner SET adminNotified = 'yes'
 		 WHERE rowID = '" .$_REQUEST['passID']. "'"	) or die(mysql_error());
	}
	$sql = mysql_query($query);
}
?>

<table width="100%" >
	<tr align="left">
		<td  valign="top">
			<h4>Foreigner Pass Approval Notifications</h4>
             
             <TABLE  width="100%" border="0"  CELLPADDING=1 CELLSPACING=1 style="margin-right:10px">
                         

	<TR>
		<TD>	
        <table   cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" style="border-collapse: collapse">
        	

                          <tr>
                           <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Directorate</strong></td>
                            <td width="20%"  bgcolor="#DFDFDF" align="center"><strong>Visitor Name</strong></td>
                           <!-- <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Visitor Type</strong></td>  -->
                           <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>
                            <td width="20%"  bgcolor="#DFDFDF" align="center"><strong>Address </strong></td>
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Country</strong></td>
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Purpose</strong></td>
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Visit Date</strong></td>                            
                           <!-- <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>End Date</strong></td>  -->
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>                   
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>                                                                                    
                          </tr>
<?php

		$rowsPerPage = 5;		
		$pageNum = 1;
		
		if(isset($_REQUEST['page'])){
			$pageNum = $_REQUEST['page'];
		}
		
		
		$offset = ($pageNum - 1) * $rowsPerPage;
		
		
$sql_search = "SELECT * FROM tbl_pass_foreigner ".$whereQ ." ORDER BY directorateToVisit ASC LIMIT ".$offset.",".$rowsPerPage;;

	
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

			<td bgcolor="#EEEEEC" align="center"><?php // if (isset($result_array[$i]['visitorType']))echo $result_array[$i]['visitorType'];?></td>  

			<td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['visitorAddress']))echo $result_array[$i]['visitorAddress'];?></td>
            
			<td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['visitorCountry']))echo $result_array[$i]['visitorCountry'];?></td>            

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
            
            <td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['scheduledVisitDate']))echo $result_array[$i]['scheduledVisitDate'];?></td>            
            
         <!--   <td bgcolor="#EEEEEC" align="center"><?php // if (isset($result_array[$i]['endDate']))echo $result_array[$i]['endDate'];?></td>  -->                        


            <td bgcolor="#EEEEEC" align="center">
			<td bgcolor="#EEEEEC" align="center">
            <td bgcolor="#EEEEEC" align="center">
				   
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=foreigner_approval_notification_admin&page=<?php if(isset($_REQUEST['page'])) echo $_REQUEST['page']; else echo 1; 		 							?>&notified=true&passID=<?php echo $result_array[$i]['rowID'];?>">Notified</a>
            </td>
            
        </tr>
<?php
		}
?>  
				<tr>
					<td bgcolor="#EEEEEC" align="center" height="20"  colspan="10"></td>
				</tr>

				<tr class="Text" align="center">
                  <td height="20" colspan="8">
<?php

//		$query = "SELECT * FROM tbl_pass_temporary " . $whereQ ;
 $query = "SELECT * FROM tbl_pass_foreigner ".$whereQ ;				
		
		
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
			  $nav .= " <a href=\"$self?action=foreigner_approval_notification_admin&page=$page\">$page</a> ";
		   } 
		}
		
		if ($pageNum > 1)
		{
		   $page  = $pageNum - 1;
		   $prev  = " <a href=\"$self?action=foreigner_approval_notification_admin&page=$page\">[Prev]</a> ";
		
		   $first = " <a href=\"$self?action=foreigner_approval_notification_admin&page=1\">[First Page]</a> ";
		} 
		else
		{
		   $prev  = '&nbsp;'; // we're on page one, don't print previous link
		   $first = '&nbsp;'; // nor the first page link
		}
		if ($pageNum < $maxPage)
		{
		   $page = $pageNum + 1;
		   $next = " <a href=\"$self?action=foreigner_approval_notification_admin&page=$page\">[Next]</a> ";
		
		   $last = " <a href=\"$self?action=foreigner_approval_notification_admin&page=$maxPage\">[Last Page]</a> ";
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
	


        <td align="left" width="20%">
			<?php  
            if (isset($_SESSION['_userName'])) {
            
                include('includes/sidebar.php'); 
            
            }
            ?>
        </td>
        
	</tr>
</table>