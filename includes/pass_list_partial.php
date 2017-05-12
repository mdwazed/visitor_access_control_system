<?php

if (isset($_REQUEST["criterion"])) {
	
	if ($_REQUEST["criterion"] == "open"){
		$criterion = "open";
	}
	else if ($_REQUEST["criterion"] == "running"){
		$criterion = "running";	
	}
	else if ($_REQUEST["criterion"] == "closed"){
		$criterion = "closed";	
	}
}

if(  isset($_REQUEST["out"]) && $_REQUEST["out"] == "true"){

		$query = sprintf("UPDATE tbl_pass SET visitorOutTime = '%s', passStatus = '%s'
 		 WHERE rowID = '" .$_REQUEST['passID']. "'", 

			mysql_real_escape_string(date('Y-m-d H:i:s')), 
			'closed' ) or die(mysql_error());
			
		$sql = mysql_query($query);

}

?>

<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Pass List</h4>
            
            <TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>

	<TR>
		<TD>	
        
        	<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">
                      
                          <tr>
                           <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Directorate to Visit </strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Visitor Name</strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Visitor Address </strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Purpose of Visit</strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Date of Visit</strong></td>                            
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>In Time</strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Out Time</strong></td>                                                        
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>                                                                                    
                          </tr>
<?php

		$rowsPerPage = 10;		
		$pageNum = 1;
		
		if(isset($_REQUEST['page'])){
			$pageNum = $_REQUEST['page'];
		}
		
		
		$offset = ($pageNum - 1) * $rowsPerPage;

		if ( isset($_SESSION['_userType']) && ($_SESSION['_userType']) == 3) {

			$where_clause = "WHERE passCreator LIKE '%' and passStatus = '".$criterion."'";		
		}
		else{
			$where_clause = "WHERE passCreator = '" .($_SESSION['_userName']) . "'and passStatus = '".$criterion."'";		
		}

	
		$sql_search = "SELECT * FROM tbl_pass " . $where_clause . " and scheduledVisitDate='".date("Y-m-d")."' ORDER BY directorateToVisit,visitorName DESC LIMIT ".$offset.",".$rowsPerPage;
	
	
		$result_all_rows = $db->execQuery($sql_search);
				
		$result_array = $db->resultArray($result_all_rows);	  
		
		$num_of_rows_found=mysql_num_rows($result_all_rows);

		if($num_of_rows_found <= 0){
?>

				<tr>
					<td bgcolor="#EEEEEC" align="center" height="20" style="color:#990000"  colspan="8">No data found.</td>
				</tr>		
<?php		
		}
		
		else{
				
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
            <td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['scheduledVisitDate']))echo $result_array[$i]['scheduledVisitDate'];?></td>            

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
				   
                            <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_pass_list_partial&page=<?php if(isset($_REQUEST['page'])) echo $_REQUEST['page']; else echo 1; 		 							?>&out=true&criterion=running&passID=<?php echo $result_array[$i]['rowID'];?>">Out</a>
		    <?php 
				   }
				   else{
				   		echo "N/A";
				   }		
			
			?>
            
            </td>

            <td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=pass_details&passID=<?php echo $result_array[$i]['rowID'];?>">Detail</a></td> 		        </tr>
<?php
				
		}		
?>


				<tr>
					<td bgcolor="#EEEEEC" align="center" height="20"  colspan="8"></td>
				</tr>





				<tr class="Text" align="center">
                  <td height="20" colspan="8">
<?php

		$query = "SELECT * FROM tbl_pass " . $where_clause. " and scheduledVisitDate='".date("Y-m-d")."'";
		
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
			  $nav .= " <a href=\"$self?action=view_pass_list_partial&criterion=$criterion&page=$page\">$page</a> ";
		   } 
		}
		
		if ($pageNum > 1)
		{
		   $page  = $pageNum - 1;
		   $prev  = " <a href=\"$self?action=view_pass_list_partial&criterion=$criterion&page=$page\">[Prev]</a> ";
		
		   $first = " <a href=\"$self?action=view_pass_list_partial&criterion=$criterion&page=1\">[First Page]</a> ";
		} 
		else
		{
		   $prev  = '&nbsp;'; // we're on page one, don't print previous link
		   $first = '&nbsp;'; // nor the first page link
		}
		if ($pageNum < $maxPage)
		{
		   $page = $pageNum + 1;
		   $next = " <a href=\"$self?action=view_pass_list_partial&criterion=$criterion&page=$page\">[Next]</a> ";
		
		   $last = " <a href=\"$self?action=view_pass_list_partial&criterion=$criterion&page=$maxPage\">[Last Page]</a> ";
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