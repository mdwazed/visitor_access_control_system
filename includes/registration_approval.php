<?php

if(isset($_POST["btn_approve"])){

	$status = $_REQUEST['status'];

	 while (list ($key,$val) = @each ($status)) {

		$query_app = "Update tbl_user_info set `approvalStatus` = 1 where `userName`='".$val."' ";
		$result_app =	$db->execQuery($query_app) or die("Error: " . mysql_error());
	} 
}

if(isset($_POST["btn_deny"])){

	$status = $_REQUEST['status'];

	 while (list ($key,$val) = @each ($status)) {

		$query_app = "Update tbl_user_info set `approvalStatus` = 2 where `userName`='".$val."' ";
		$result_app =	$db->execQuery($query_app) or die("Error: " . mysql_error());
	} 
}

?>

<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top"> 
			<h4>Pending User List</h4>
            
            <TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>

	<TR>
		<TD>	
        
        	<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">
                      
                          <tr>
                                <td bgcolor="#DFDFDF" align="center"><strong>Select</strong></td>                          
                                <td width="25%"  bgcolor="#DFDFDF" align="center"><strong>User Name</strong></td>
                                <td width="25%"  bgcolor="#DFDFDF" align="center"><strong>User Type </strong></td>
                                <td width="25%"  bgcolor="#DFDFDF" align="center"><strong>First Name </strong></td>
                                <td width="25%"  bgcolor="#DFDFDF" align="center"><strong>Last Name </strong></td>
                          </tr>
                         
<?php

		$rowsPerPage = 7;		
		$pageNum = 1;
		
		if(isset($_REQUEST['page'])){
			$pageNum = $_REQUEST['page'];
		}
		
		
		$offset = ($pageNum - 1) * $rowsPerPage;
				
				
		$sql_search = "SELECT rowID,userName,userType FROM tbl_user_info  WHERE approvalStatus = 0 ORDER BY rowID DESC LIMIT ".$offset.",".$rowsPerPage;
		
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
				
					//	get Name from tbl_product_code_info
		
					$sql = "SELECT firstName, lastName FROM tbl_registration WHERE userName = "."'".$result_array[$i]['userName']."'";
					$result_all_rows = $db->execQuery($sql);
					$result_array_registration = $db->resultArray($result_all_rows);	  		
?>						 

<form name="registration_approval" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=registration_approval" method="post" onsubmit="return validate();">
 
		<tr>
            <td bgcolor="#EEEEEC" align="center"><input type="checkbox" name="status[]" value="<?php echo $result_array[$i]['userName'];?>" /></td>						        
        	<td bgcolor="#EEEEEC" align="center"><?php  if (isset($result_array[$i]['userName'])) echo $result_array[$i]['userName'];?></td>
			<td bgcolor="#EEEEEC" align="center"><?php  if (isset($result_array[$i]['userType'])) echo $result_array[$i]['userType'];?></td>
			<td bgcolor="#EEEEEC" align="center"><?php  if (isset($result_array_registration[0]['firstName'])) echo $result_array_registration[0]['firstName'];?></td>
            <td bgcolor="#EEEEEC" align="center"><?php  if (isset($result_array_registration[0]['lastName'])) echo $result_array_registration[0]['lastName'];?></td>
		</tr>
<?php
		}
?>  
				<tr>

					<td bgcolor="#EEEEEC" align="center" height="20"  colspan="5"></td>
				</tr>

				<tr class="Text" align="center">
                  <td align="center"><strong><input type="submit" value="Approve" name="btn_approve" /></strong></td>
                  <td align="left"><strong><input type="submit" value="Deny" name="btn_deny" /></strong></td>
                                    
                  <td height="20" colspan="4">
<?php

		$query = "SELECT * FROM tbl_user_info where approvalStatus = 0";
		
		
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
			  $nav .= " <a href=\"$self?action=registration_approval&page=$page\">$page</a> ";
		   } 
		}
		
		if ($pageNum > 1)
		{
		   $page  = $pageNum - 1;
		   $prev  = " <a href=\"$self?action=registration_approval&page=$page\">[Prev]</a> ";
		
		   $first = " <a href=\"$self?action=registration_approval&page=1\">[First Page]</a> ";
		} 
		else
		{
		   $prev  = '&nbsp;'; // we're on page one, don't print previous link
		   $first = '&nbsp;'; // nor the first page link
		}
		if ($pageNum < $maxPage)
		{
		   $page = $pageNum + 1;
		   $next = " <a href=\"$self?action=registration_approval&page=$page\">[Next]</a> ";
		
		   $last = " <a href=\"$self?action=registration_approval&page=$maxPage\">[Last Page]</a> ";
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


