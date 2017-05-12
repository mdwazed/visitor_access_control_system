<?php

if(  isset($_REQUEST["edit"]) && $_REQUEST["edit"] == "true"){
		
		$query = "SELECT * FROM tbl_rank WHERE rowID ='".$_REQUEST["rowID"]."'";
		$result_all_rows = $db->execQuery($query);
		$result_array = $db->resultArray($result_all_rows);	  

		$edit_rank_ID = $result_array[0]['rowID'];
		$edit_rank_name = $result_array[0]['rankName'];
		$edit_rank_description = $result_array[0]['rankDescription'];

		if ($result_array[0]['forSentry']=='yes')
				$edit_sentry_rank = 'selected';						
		else		
				$edit_officer_rank = 'selected';						
										
}

if(  isset($_REQUEST["disable"]) && $_REQUEST["disable"] == "true"){
		
				$query = "UPDATE tbl_rank SET isDisabled='yes' WHERE rowID ='".$_REQUEST["rowID"]."'";
				$sql = mysql_query($query);
								
}

if(  isset($_REQUEST["enable"]) && $_REQUEST["enable"] == "true"){
		
				$query = "UPDATE tbl_rank SET isDisabled='no' WHERE rowID ='".$_REQUEST["rowID"]."'";
				$sql = mysql_query($query);
								
}

if(isset($_POST['submit_edit'])){

    if(  empty($_POST['rank_name']) || empty($_POST['for_sentry']) ){

		$message = '';
        if(empty($_POST['rank_name'])){
            $message .= 'Rank Name can\'t be empty<br>';
        }

		if(empty($_POST['for_sentry'])){
            $message .= 'Please select for whom the rank is<br>';
        }
		
		$message .= '</p>';
    }
	else{
		
		$query1 = sprintf("UPDATE tbl_rank SET forSentry='%s', rankName='%s', rankDescription='%s' WHERE rowID = '".$_POST['rowID']."'",
					mysql_real_escape_string($_POST['for_sentry']),
					mysql_real_escape_string($_POST['rank_name']),
					mysql_real_escape_string($_POST['rank_description']) )or die(mysql_error());								
		
		$sql1 = mysql_query($query1);
		
		if ($sql1){

			$message = "Rank edited successfully";
		}

		else{
			$message = "Rank could not be edited";
		}
		
    }
}


if(isset($_POST['submit_save'])){

    $query = sprintf("SELECT * FROM tbl_rank WHERE rankName='%s' LIMIT 1",mysql_real_escape_string($_POST['rank_name']));
	$sql = mysql_query($query);
    $row = mysql_fetch_array($sql);

    if( $row||empty($_POST['rank_name']) || empty($_POST['for_sentry']) ){

		$message = '';
        if(empty($_POST['rank_name'])){
            $message .= 'Rank Name can\'t be empty<br>';
        }

        if($row){
            $message .= 'Rank already exists<br>';
        }
		
		
		if(empty($_POST['for_sentry'])){
            $message .= 'Please select for whom the rank is<br>';
        }
		
		$message .= '</p>';
    }
	else{
		
		$query1 = sprintf("INSERT INTO tbl_rank(forSentry,rankName, rankDescription) VALUES ('%s','%s' ,'%s')",           
					mysql_real_escape_string($_POST['for_sentry']),
					mysql_real_escape_string($_POST['rank_name']),
					mysql_real_escape_string($_POST['rank_description']) )or die(mysql_error());								
		
		$sql1 = mysql_query($query1);
		
		if ($sql1){

			$message = "Rank created successfully";
		}

		else{
			$message = "Rank could not be created";
		}
		
    }
}


?> 

<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Rank Profile</h4>
            
	<table  border="0"  width="100%"  >         <!--      bgcolor="#EEEEEC"       -->
	<tr>
    <td align="center" >
    
   

     
        <table  bgcolor="#EEEEEC" width="100%" align="right" >
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_rank" method="post">        
        <tr bgcolor="#DFDFDF"><td colspan="3" align="center" style="color:#990000">
           <h5><?php if(isset($message)) echo $message; ?></h5>
        </td></tr>

        <tr><td colspan="3" align="center" >&nbsp;
           
        </td></tr>
        
        
        
         <tr>
                  <td align="right"><strong>Rank of</strong></td>
                  <td align="center">:</td>
                  <td colspan="3">
                  <select name="for_sentry">
                      <option selected>      </option>
                      <option value="no" <?php if(isset($edit_officer_rank)) echo $edit_officer_rank; ?>  >Officer</option>
                      <option value="yes" <?php if(isset($edit_sentry_rank)) echo $edit_sentry_rank; ?> >Other Ranks</option>
        	      </select>  </td>
                  
      
			</tr>
        
        
        
        
        
        <tr>
                    <td width="460" align="right"><strong>Rank</strong></td>
                    <td width="35" align="center">:</td>
                  <td width="460"><input type="text" name="rank_name" <?php if(isset($edit_rank_name))  echo "value='".$edit_rank_name."'"; ?> /></td>
        </tr>    
            
        <tr>
                    <td width="460" align="right"><strong>Description</strong></td>
                    <td width="35" align="center">:</td>
                  <td><input type="text" name="rank_description" <?php if(isset($edit_rank_description))  echo "value='".$edit_rank_description."'"; ?> /></td>
        </tr>
        
<?php
if(  isset($_REQUEST["edit"]) && $_REQUEST["edit"] == "true"){        
?>		
		<input type="hidden" name="rowID" value="<?php echo $edit_rank_ID; ?>" />
        <tr >
                    <td colspan="2">&nbsp; </td>
           		  <td><input type="submit" name="submit_edit" value="Edit" /></td>
        </tr>
<?php
}
else{
?>   
        <tr >
                    <td colspan="2">&nbsp; </td>
           		  <td><input type="submit" name="submit_save" value="Save" /></td>
        </tr>
<?php
}
?>     
        
        <tr bgcolor="#DFDFDF">
                    <td colspan="3">&nbsp; </td>           		
        </tr>
    </form>         


        </table>
        


</td>
  </tr>
  
  <!-------------------------------------------------------------------------------------ANIS----- List of existing appointment--------------->



<?php
if(  isset($_REQUEST["delete"]) && $_REQUEST["delete"] == "true"){
						$message = '';      
           			 $message .= 'One record deleted<br>';
?>		
 						 <table  bgcolor="#EEEEEC" width="100%" align="left" >
						 <tr bgcolor="#DFDFDF"><td colspan="4" align="center" style="color:#990000">	
                         <h5><?php if(isset($message)) echo $message; ?></h5> </td></tr>                         
<?php	
	}			
?>  
  
                <TR bgcolor="#DFDFDF">
                    <TD>	
                    
                        <table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">
                      
                          <tr>
                            <td width="30%"  bgcolor="#DFDFDF" align="center"><strong>Rank Name</strong></td>
                            <td width="30%"  bgcolor="#DFDFDF" align="center"><strong>Description </strong></td>
                            <td width="20%"  bgcolor="#DFDFDF" align="center"><strong>JCO/NCO </strong></td>                            
                             <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>
                             <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>                             

                             <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>
                          </tr>
                
                         
<?php

		$rowsPerPage = 7;		
		$pageNum = 1;
		
		if(isset($_REQUEST['page'])){
			$pageNum = $_REQUEST['page'];
		}
		
		
		$offset = ($pageNum - 1) * $rowsPerPage;
				
				
		$sql_search = "SELECT * FROM tbl_rank ORDER BY rowID ASC LIMIT ".$offset.",".$rowsPerPage;
		
		$result_all_rows = $db->execQuery($sql_search);
				
		$result_array = $db->resultArray($result_all_rows);	  
		
		$num_of_rows_found=mysql_num_rows($result_all_rows); 

		if($num_of_rows_found>0){
		
				for($i=0; $i<$num_of_rows_found; $i++){
				
							
					$sql = "SELECT * FROM tbl_rank WHERE rankName = "."'".$result_array[$i]['rankName']."'";
					$result_all_rows = $db->execQuery($sql);
					$result_array_registration = $db->resultArray($result_all_rows);	  		
?>						 
 
		<tr>
        	<td bgcolor="#EEEEEC" align="center"><?php echo $result_array[$i]['rankName'];?></td>
			<td bgcolor="#EEEEEC" align="center"><?php echo $result_array[$i]['rankDescription'];?></td>
			<td bgcolor="#EEEEEC" align="center"><?php echo $result_array[$i]['forSentry'];?></td>            
   			<td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_rank&edit=true&rowID=<?php echo $result_array[$i]['rowID'];?>"> Edit</a></td>
            
            
<?php
if ($result_array[$i]['isDisabled'] != 'yes'){
?>
   			<td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_rank&disable=true&rowID=<?php echo $result_array[$i]['rowID'];?>"> Disable</a></td>
<?php 
}
else{            
?>
   			<td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_rank&enable=true&rowID=<?php echo $result_array[$i]['rowID'];?>"> Enable</a></td>            
<?php
}
?>            
			<td bgcolor="#EEEEEC" align="center"></td>
            
        
        </tr>
<?php
		}
?>  
				<tr>
					<td bgcolor="#EEEEEC" align="center" height="20"  colspan="6"></td>
				</tr>

				<tr class="Text" align="center">
                  <td height="20" colspan="6">
<?php

		$query = "SELECT * FROM tbl_rank ";
		
		
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
			  $nav .= " <a href=\"$self?action=setup_rank&page=$page\">$page</a> ";
		   } 
		}
		
		if ($pageNum > 1)
		{
		   $page  = $pageNum - 1;
		   $prev  = " <a href=\"$self?action=setup_rank&page=$page\">[Prev]</a> ";
		
		   $first = " <a href=\"$self?action=setup_rank&page=1\">[First Page]</a> ";
		} 
		else
		{
		   $prev  = '&nbsp;'; // we're on page one, don't print previous link
		   $first = '&nbsp;'; // nor the first page link
		}
		if ($pageNum < $maxPage)
		{
		   $page = $pageNum + 1;
		   $next = " <a href=\"$self?action=setup_rank&page=$page\">[Next]</a> ";
		
		   $last = " <a href=\"$self?action=setup_rank&page=$maxPage\">[Last Page]</a> ";
		} 
		else
		{
		   $next = '&nbsp;'; // we're on the last page, don't print next link
		   $last = '&nbsp;'; // nor the last page link
		}

		//echo $first . $prev . $nav . $next . $last;

		echo $first . $prev . " Showing page $pageNum of $maxPage pages " . $next . $last;

}
?></table>   
</td></tr>


  
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




