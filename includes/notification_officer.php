<?php

//$whereQ= "";
$whereQ= "WHERE passCreator = '". $_SESSION["_userName"] ."' AND approvalStatus = 1 AND officerNotified = 'no'";
$already_used_parameter="no";

if(  isset($_REQUEST["notified"]) && $_REQUEST["notified"] == "true"){

	$query='';

	if(  isset($_REQUEST["passID_T"]) ){
		$query = sprintf("UPDATE tbl_pass_temporary SET officerNotified = 'yes'
 		 WHERE rowID = '" .$_REQUEST['passID_T']. "'"	) or die(mysql_error());
	}
	else if(  isset($_REQUEST["passID_F"]) ){
		$query = sprintf("UPDATE tbl_pass_foreigner SET officerNotified = 'yes'
 		 WHERE rowID = '" .$_REQUEST['passID_F']. "'"	) or die(mysql_error());
	}
	$sql = mysql_query($query);
}

?>
<table width="100%" >
	<tr>
	  <td align="left" width="70%" valign="top">
		  <h4>Notifications</h4>
            
        <TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>

	<TR>
		<TD>	
        
        	<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">


                          <tr>
                           <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Directorate</strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Visitor Name</strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Visitor Type</strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Address </strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Country</strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Purpose of Visit</strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Start Date</strong></td>                            
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>End Date</strong></td>

                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>                                                                                    
                          </tr>
<?php

		$rowsPerPage = 5;		
		$pageNum = 1;
		
		if(isset($_REQUEST['page'])){
			$pageNum = $_REQUEST['page'];
		}
		
		
		$offset = ($pageNum - 1) * $rowsPerPage;
		
		
$sql_search = "SELECT * FROM ( 

(SELECT rowID , visitorName, 'Foreigner' AS visitorType, visitorAddress, visitorCountry, directorateToVisit, purposeOfVisit, scheduledVisitDate AS startDate, 'NA' AS endDate FROM tbl_pass_foreigner ".$whereQ ." ORDER BY directorateToVisit ASC) UNION 

(SELECT rowID , visitorName, visitorType, visitorAddress, 'BD' AS visitorCountry, directorateToVisit, purposeOfVisit, startDate, endDate FROM tbl_pass_temporary ".$whereQ ." ORDER BY directorateToVisit ASC) 

) AS Result "." LIMIT ".$offset.",".$rowsPerPage;;

	
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

			<td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['visitorType']))echo $result_array[$i]['visitorType'];?></td>

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
            
            <td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['startDate']))echo $result_array[$i]['startDate'];?></td>            
            
            <td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['endDate']))echo $result_array[$i]['endDate'];?></td>                        


            <td bgcolor="#EEEEEC" align="center">

<?php
if ($result_array[$i]['visitorType'] == 'Foreigner'){
?>
				   
<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=notification_officer&page=<?php if(isset($_REQUEST['page'])) echo $_REQUEST['page']; else echo 1; 		 							?>&notified=true&passID_F=<?php echo $result_array[$i]['rowID'];?>">Notified</a>

<?php
}


else {
?>		   

<a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=notification_officer&page=<?php if(isset($_REQUEST['page'])) echo $_REQUEST['page']; else echo 1; 		 							?>&notified=true&passID_T=<?php echo $result_array[$i]['rowID'];?>">Notified</a>

<?php
}
?>
            </td>
            
        </tr>
<?php
		}
?>  
				<tr>
					<td bgcolor="#EEEEEC" align="center" height="20"  colspan="9"></td>
				</tr>

				<tr class="Text" align="center">
                  <td height="20" colspan="8">
<?php

//		$query = "SELECT * FROM tbl_pass_temporary " . $whereQ ;
 $query = "( SELECT rowID , visitorName, 'Foreigner' AS visitorType, visitorAddress, visitorCountry, directorateToVisit, purposeOfVisit, scheduledVisitDate AS startDate, 'NA' AS endDate FROM tbl_pass_foreigner ".$whereQ ." ) UNION (SELECT rowID , visitorName, visitorType, visitorAddress, 'BD' AS visitorCountry, directorateToVisit, purposeOfVisit, startDate, endDate FROM tbl_pass_temporary ".$whereQ ." )";				
		
		
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
			  $nav .= " <a href=\"$self?action=notification_officer&page=$page\">$page</a> ";
		   } 
		}
		
		if ($pageNum > 1)
		{
		   $page  = $pageNum - 1;
		   $prev  = " <a href=\"$self?action=notification_officer&page=$page\">[Prev]</a> ";
		
		   $first = " <a href=\"$self?action=notification_officer&page=1\">[First Page]</a> ";
		} 
		else
		{
		   $prev  = '&nbsp;'; // we're on page one, don't print previous link
		   $first = '&nbsp;'; // nor the first page link
		}
		if ($pageNum < $maxPage)
		{
		   $page = $pageNum + 1;
		   $next = " <a href=\"$self?action=notification_officer&page=$page\">[Next]</a> ";
		
		   $last = " <a href=\"$self?action=notification_officer&page=$maxPage\">[Last Page]</a> ";
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
	


        <td align="left" width="20%" valign="top">
			<?php  
            if (isset($_SESSION['_userName'])) {
            
                include('includes/sidebar.php'); 
            
            }
            ?>        
         </td>
        
	</tr>
</table>