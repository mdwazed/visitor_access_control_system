<script type="text/javascript">

function validateForm() {

	if (document.getElementById('directorate_to_visit').value=="" && document.getElementById('rank').value=="" && document.getElementById('appointment').value==""){	

			alert("Please select search criteria.");
			return false;

	}

}
</script>


<?php

$whereQ= "WHERE userName <> ''";
$already_used_parameter="yes";

if(  isset($_REQUEST["delete"]) && $_REQUEST["delete"] == "true"){

		$query = "DELETE U, R FROM tbl_user_info U, tbl_registration R WHERE U.userName = R.userName and U.userName='". $_REQUEST['user_name']."'";
		$sql = mysql_query($query);

}

if(isset($_POST['submit_search'])){
		
		$whereQ="";
		$already_used_parameter="";

		if (!$_REQUEST['rank']=="0" and !$_REQUEST['rank']=="")
		{
			$whereQ.= " WHERE rank = '".$_REQUEST['rank']."'";   
			$already_used_parameter="yes";			
		}
		
		
		if (!$_REQUEST['appointment']=="0" and !$_REQUEST['appointment']=="")
		{
			if ($already_used_parameter=="yes")		
				$whereQ.= " and appointment = '".$_REQUEST['appointment']."'";
			else{
				$whereQ.= " WHERE appointment = '".$_REQUEST['appointment']."'";
			}
			$already_used_parameter="yes";				
		}

		
		if (!$_REQUEST['directorate_to_visit']=="0" and !$_REQUEST['directorate_to_visit']=="")
		{		

			if ($already_used_parameter=="yes")		
				$whereQ.= " and directorate = '".$_REQUEST['directorate_to_visit']."'";
			else{
				$whereQ.= " WHERE directorate = '".$_REQUEST['directorate_to_visit']."'";
			}
			$already_used_parameter="yes";	
		}
}

?>


<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>User List</h4>
            
            <TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>

	<TR>
		<TD>	
        
        	<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">
                      
                      
                   
  <tr valign="middle">

                            <td width="25%"  bgcolor="#FF9966" align="center"><strong>Rank </strong></td>
                            <td width="35%"  bgcolor="#FF9966" align="center"><strong>Appointment</strong></td>
                            <td width="25%"  bgcolor="#FF9966" align="center"><strong>Directorate</strong></td>
                          
                            <td width="15%" colspan="5"  bgcolor="#FF9966" align="center"><strong>&nbsp;</strong></td>
                            
</tr>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_user_list" onsubmit="return validateForm()"  method="post">
<tr valign="middle">

		
        <td width="15%"  bgcolor="#9999FF" align="center"><strong><select name="rank" id="rank">
		<option value="" selected>Please Select</option>                    
					<?php
                    
                    $sql_search = "SELECT rowID,rankName FROM tbl_rank WHERE isDisabled= 'no' ORDER BY rowID";
                    $result_all_rows = $db->execQuery($sql_search);		
                    $num_of_rows_found=mysql_num_rows($result_all_rows);
                    
                    if($num_of_rows_found>0){
                    
                            $result_array = $db->resultArray($result_all_rows);
                            for($i=0; $i<$num_of_rows_found; $i++){		
                    ?>
                                            <option value="<?php echo $result_array[$i]['rowID'];?>"><?php echo $result_array[$i]['rankName'];?></option>
                    <?php
                            }		
                    }
                    ?>
         				</select></strong></td>
    
        


	<td width="15%"  bgcolor="#9999FF" align="center"><strong><select name="appointment" id="appointment">
		<option value="" selected>Please Select</option>                    
					<?php
                    
                    $sql_search = "SELECT rowID,appointmentName FROM tbl_appointment WHERE isDisabled= 'no' ORDER BY rowID";
                    $result_all_rows = $db->execQuery($sql_search);		
                    $num_of_rows_found=mysql_num_rows($result_all_rows);
                    
                    if($num_of_rows_found>0){
                    
                            $result_array = $db->resultArray($result_all_rows);
                            for($i=0; $i<$num_of_rows_found; $i++){		
                    ?>
                                            <option value="<?php echo $result_array[$i]['rowID'];?>"><?php echo $result_array[$i]['appointmentName'];?></option>
                    <?php
                            }		
                    }
                    ?>
         				</select></strong></td>


	<td width="15%"  bgcolor="#9999FF" align="center"><strong><select name="directorate_to_visit" id="directorate_to_visit">
		<option value="" selected>Please Select</option>                    
					<?php
                    
                    $sql_search = "SELECT rowID,directorateName FROM tbl_directorate WHERE isDisabled= 'no' ORDER BY directorateName";
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
                        
	              
	<td width="15%" colspan="5"  bgcolor="#9999FF" align="left"><strong><input type="submit" name="submit_search" value="Search User" id="submit_search" />
	</strong></td>
                            
</tr>                      
</form>
<tr>
                           <td width="100%" colspan="9"  bgcolor="#FFFFFF" align="center">&nbsp;</strong></td>
</tr>   
                      
                      
                      
                 <!--%%%%%%%%%%%%   new incl   ..ANIS   (upper part)  %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  -->     
                          <tr>
                            <td width="20%"  bgcolor="#DFDFDF" align="center"><strong>User Name</strong></td>
                            <td width="5%"  bgcolor="#DFDFDF" align="center"><strong>Rank </strong></td>
                            <td width="25%"  bgcolor="#DFDFDF" align="center"><strong>First Name </strong></td>
                            <td width="25%"  bgcolor="#DFDFDF" align="center"><strong>Last Name </strong></td>
                            <td width="15%"  bgcolor="#DFDFDF" align="center"><strong>Appointment </strong></td>
                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>Directorate </strong></td>                      
                            <td width="10%"  bgcolor="#DFDFDF" align="center">&nbsp;</td>
                          </tr>
                         
<?php

		$rowsPerPage = 7;		
		$pageNum = 1;
		
		if(isset($_REQUEST['page'])){
			$pageNum = $_REQUEST['page'];
		}
		
		
		$offset = ($pageNum - 1) * $rowsPerPage;
				
				
//		$sql_search = "SELECT * FROM tbl_registration " . $whereQ ." ORDER BY rowID DESC LIMIT ".$offset.",".$rowsPerPage;
		
		$sql_search = "SELECT * FROM tbl_registration " . $whereQ ." AND userName IN (Select userName from tbl_user_info WHERE approvalStatus = 1)"." ORDER BY rowID DESC LIMIT ".$offset.",".$rowsPerPage;
		
		$result_all_rows = $db->execQuery($sql_search);
				
		$result_array = $db->resultArray($result_all_rows);	  
		
		$num_of_rows_found=mysql_num_rows($result_all_rows);

		if($num_of_rows_found>0){
		
				for($i=0; $i<$num_of_rows_found; $i++){
				
					//	get Name from tbl_registration
		
					$sql = "SELECT rank, firstName, lastName, appointment, directorate FROM tbl_registration WHERE userName = "."'".$result_array[$i]['userName']."' ";
					$result_all_rows = $db->execQuery($sql);
					$result_array_registration = $db->resultArray($result_all_rows);	  		
?>						 
 
		<tr>
        	<td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['userName'])) echo $result_array[$i]['userName'];?></td>
			<td bgcolor="#EEEEEC" align="center">
            
            <?php 
			
			if (isset($result_array_registration[0]['rank'])){

				$sql_search = "SELECT rankName FROM tbl_rank WHERE rowID = '".$result_array_registration[0]['rank']."'";
				$result_row_rank = $db->execQuery($sql_search);
				$result_array_rank = $db->resultArray($result_row_rank);	  

				echo $result_array_rank[0]['rankName'];
					
			}		
			?>
            
            </td>
			<td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array_registration[0]['firstName'])) echo $result_array_registration[0]['firstName'];?></td>
            <td bgcolor="#EEEEEC" align="center"><?php if (isset($result_array_registration[0]['lastName'])) echo $result_array_registration[0]['lastName'];?></td>
            <td bgcolor="#EEEEEC" align="center">
			
            
            <?php 
			
			if (isset($result_array_registration[0]['appointment']) && !empty($result_array_registration[0]['appointment'])){

				$sql_search = "SELECT appointmentName FROM tbl_appointment WHERE rowID = '".$result_array_registration[0]['appointment']."'";
				$result_row_appointment = $db->execQuery($sql_search);
				$result_array_appointment = $db->resultArray($result_row_appointment);	  

				echo $result_array_appointment[0]['appointmentName'];
					
			}		
			?>
            
            </td>
            <td bgcolor="#EEEEEC" align="center">
			
			<?php 
			
			if (isset($result_array_registration[0]['directorate']) && !empty($result_array_registration[0]['directorate'])){

				$sql_search = "SELECT directorateName FROM tbl_directorate WHERE rowID = '".$result_array_registration[0]['directorate']."'";
				$result_row_directorate = $db->execQuery($sql_search);
				$result_array_directorate = $db->resultArray($result_row_directorate);	  

				echo $result_array_directorate[0]['directorateName'];
					
			}		
			?>            
            </td>
            <td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=view_user_list&delete=true&user_name=<?php echo $result_array[$i]['userName'];?>"> Delete</a></td>
            						
		</tr>
<?php
		}
?>  
				<tr>
					<td bgcolor="#EEEEEC" align="center" height="20"  colspan="7"></td>
				</tr>

				<tr class="Text" align="center">
                  <td height="20" colspan="7">
<?php

		$query = "SELECT * FROM tbl_registration " . $whereQ ." AND userName IN (Select userName from tbl_user_info WHERE approvalStatus = 1)";
		
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
			  $nav .= " <a href=\"$self?action=view_user_list&page=$page\">$page</a> ";
		   } 
		}
		
		if ($pageNum > 1)
		{
		   $page  = $pageNum - 1;
		   $prev  = " <a href=\"$self?action=view_user_list&page=$page\">[Prev]</a> ";
		
		   $first = " <a href=\"$self?action=view_user_list&page=1\">[First Page]</a> ";
		} 
		else
		{
		   $prev  = '&nbsp;'; // we're on page one, don't print previous link
		   $first = '&nbsp;'; // nor the first page link
		}
		if ($pageNum < $maxPage)
		{
		   $page = $pageNum + 1;
		   $next = " <a href=\"$self?action=view_user_list&page=$page\">[Next]</a> ";
		
		   $last = " <a href=\"$self?action=view_user_list&page=$maxPage\">[Last Page]</a> ";
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


