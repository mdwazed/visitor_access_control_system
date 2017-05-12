<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Pass List</h4>
            
            <TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>

	<TR>
		<TD>	
        
        	<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">
                      
                          <tr>
                          <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Visiting Directorate </strong></td>
                          
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Visitor Name</strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Visitor Address </strong></td>                          
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Purpose of Visit</strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Date of Visit</strong></td>                            
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>                                                        
                          </tr>
                         
<?php

		$rowsPerPage = 5;		
		$pageNum = 1;
		
		if(isset($_REQUEST['page'])){
			$pageNum = $_REQUEST['page'];
		}
		
		
		$offset = ($pageNum - 1) * $rowsPerPage;

		if ( isset($_SESSION['_userType']) && ($_SESSION['_userType']) == 1) {

			$where_clause = "WHERE passCreator LIKE '%'";		
		}
		else{
			$where_clause = "WHERE passCreator = '" .($_SESSION['_userName']) . "'";		
		}

	
		$sql_search = "SELECT * FROM tbl_pass " . $where_clause . " ORDER BY rowID DESC LIMIT ".$offset.",".$rowsPerPage;
	
		$result_all_rows = $db->execQuery($sql_search);
				
		$result_array = $db->resultArray($result_all_rows);	  
		
		$num_of_rows_found=mysql_num_rows($result_all_rows);

		if($num_of_rows_found>0){
		
				for($i=0; $i<$num_of_rows_found; $i++){
				
?>						 
 
		<tr>
       		 <td bgcolor="#EEEEEC" align="center"><?php echo $result_array[$i]['directorateToVisit'];?></td>
        	<td bgcolor="#EEEEEC" align="center"><?php echo $result_array[$i]['visitorName'];?></td>
			<td bgcolor="#EEEEEC" align="center"><?php echo $result_array[$i]['visitorAddress'];?></td>			
            <td bgcolor="#EEEEEC" align="center"><?php echo $result_array[$i]['purposeOfVisit'];?></td>
            <td bgcolor="#EEEEEC" align="center"><?php echo $result_array[$i]['scheduledVisitDate'];?></td>            
            <td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=pass_details&passID=<?php echo $result_array[$i]['rowID'];?>">View</a></td>    
                                
		</tr>
<?php
		}
?>  
				<tr>
					<td bgcolor="#EEEEEC" align="center" height="20"  colspan="6"></td>
				</tr>

				<tr class="Text" align="center">
                  <td height="20" colspan="5">
<?php

		$query = "SELECT * FROM tbl_pass " . $where_clause;
		
		
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
			  $nav .= " <a href=\"$self?action=view_pass_list&page=$page\">$page</a> ";
		   } 
		}
		
		if ($pageNum > 1)
		{
		   $page  = $pageNum - 1;
		   $prev  = " <a href=\"$self?action=view_pass_list&page=$page\">[Prev]</a> ";
		
		   $first = " <a href=\"$self?action=view_pass_list&page=1\">[First Page]</a> ";
		} 
		else
		{
		   $prev  = '&nbsp;'; // we're on page one, don't print previous link
		   $first = '&nbsp;'; // nor the first page link
		}
		if ($pageNum < $maxPage)
		{
		   $page = $pageNum + 1;
		   $next = " <a href=\"$self?action=view_pass_list&page=$page\">[Next]</a> ";
		
		   $last = " <a href=\"$self?action=view_pass_list&page=$maxPage\">[Last Page]</a> ";
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


