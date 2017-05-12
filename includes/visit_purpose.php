<?php

//...........

if(  isset($_REQUEST["edit"]) && $_REQUEST["edit"] == "true"){
		
		$query = "SELECT * FROM tbl_visit_purpose WHERE rowID ='".$_REQUEST["rowID"]."'";
		$result_all_rows = $db->execQuery($query);
		$result_array = $db->resultArray($result_all_rows);	  

		$edit_purpose_ID = $result_array[0]['rowID'];
		$edit_purpose_name = $result_array[0]['purposeName'];
		//$edit_directorate_description = $result_array[0]['directorateDescription'];
				
										
}

if(  isset($_REQUEST["disable"]) && $_REQUEST["disable"] == "true"){
		
				$query = "UPDATE tbl_visit_purpose SET isDisabled='yes' WHERE rowID ='".$_REQUEST["rowID"]."'";
				$sql = mysql_query($query);
								
}

if(  isset($_REQUEST["enable"]) && $_REQUEST["enable"] == "true"){
		
				$query = "UPDATE tbl_visit_purpose SET isDisabled='no' WHERE rowID ='".$_REQUEST["rowID"]."'";
				$sql = mysql_query($query);
								
}

if(isset($_POST['submit_edit'])){

    if(  empty($_POST['purpose_name'])  ){

		$message = '';
        if(empty($_POST['purpose_name'])){
            $message .= 'Purpose Name can\'t be empty<br>';
        }
		
		$message .= '</p>';
    }
	else{
		
		$query1 = sprintf("UPDATE tbl_visit_purpose SET  purposeName='%s' WHERE rowID = '".$_POST['rowID']."'",
					
					mysql_real_escape_string($_POST['purpose_name']))or die(mysql_error());
		
		$sql1 = mysql_query($query1);
		
		if ($sql1){

			$message = "Purpose edited successfully";
		}

		else{
			$message = "Purpose could not be edited";
		}
		
    }
}




//.....................................
if(isset($_POST['submit'])){

    $query = sprintf("SELECT * FROM tbl_visit_purpose WHERE purposeName='%s' LIMIT 1",mysql_real_escape_string($_POST['purpose_name']));
	$sql = mysql_query($query);
    $row = mysql_fetch_array($sql);

    if( $row||empty($_POST['purpose_name'])  ){

		$message = '';
        if(empty($_POST['purpose_name'])){
            $message .= 'Purpose Name can\'t be empty<br>';
        }

        if($row){
            $message .= 'Purpose already exists<br>';
        }
		$message .= '</p>';
    }else{
        # If all fields are not empty, and the passwords match,
        # create a session, and session variables,
		
		
		$query1 = sprintf( "INSERT INTO tbl_visit_purpose (purposeName) VALUES ('%s')", mysql_real_escape_string($_POST['purpose_name']) )or die(mysql_error());							
		
		$sql1 = mysql_query($query1);
		
		if ($sql1){

			$message = "Purpose created successfully";
						
		}
		else{
			$message = "Purpose could not be created";
		}			
    }
}
/*
if(  isset($_REQUEST["delete"]) && $_REQUEST["delete"] == "true"){
		
				$query = "DELETE U FROM tbl_visit_purpose U WHERE U.purposeName='". $_REQUEST['purpose_name']."'";
				$sql = mysql_query($query);
					//$message = '';      
           			// $message .= 'One row deleted<br>';		
			}*/
?> 


<table width="100%" >
	<tr>
		<td align="left" width="70%" valign="top">
			<h4>Purpose Profile</h4>
            
	<table bordercolor="#006666" border="0"  width="100%"  >         <!--      bgcolor="#EEEEEC"       -->
	<tr>
    <td align="center" >
    
   
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_visit_purpose" method="post">
     
        <table  bgcolor="#EEEEEC" width="100%" align="right" >
        
        <tr bgcolor="#DFDFDF"><td colspan="4" align="center" style="color:#990000">
           <h5><?php if(isset($message)) echo $message; ?></h5>
        </td></tr>

        <tr><td colspan="4" align="center" >&nbsp;
           
        </td></tr>
        
        
        
        <tr>
                    <td width="460" align="right"><strong>Purpose Name</strong></td>
                    <td width="35" align="center">:</td>
					<td width="460"><input type="text" name="purpose_name" <?php if(isset($edit_purpose_name))  echo "value='".$edit_purpose_name."'"; ?> /></td>         </tr>
        
        
<!--------------------------------------------------------------------------------------------------------------------->       
<!--------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------------------->
        

<?php
        if(  isset($_REQUEST["edit"]) && $_REQUEST["edit"] == "true"){        
        ?>		
                <input type="hidden" name="rowID" value="<?php echo $edit_purpose_ID; ?>" />
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
                          <td><input type="submit" name="submit" value="Save" /></td>
                </tr>
        <?php
        }
        ?>
        
        
        <tr bgcolor="#DFDFDF">
                    <td colspan="6">&nbsp; </td>           		
        </tr>
     
      </form> 


    
<!-------------------------------------------------------------------------------------ANIS----- List of existing purpose--------------->


		<!--
		 <?php   
      //  if(  isset($_REQUEST["delete"]) && $_REQUEST["delete"] == "true"){
      //                         $message = '';      
      //                       $message .= 'One record deleted<br>';
        ?>		
                                 <table  bgcolor="#EEEEEC" width="100%" align="left" >
                                 <tr bgcolor="#DFDFDF"><td colspan="5" align="center" style="color:#990000">	
                                 <h5><?php if(isset($message)) echo $message; ?></h5> </td></tr>                         
        <?php	
        //    }			
        ?>    --->
 </td></tr>      
	
        
        	<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">
                      
                          <tr>
                            <td width="25%"  bgcolor="#DFDFDF" align="center"><strong>PurposeName</strong></td>                           
                            <td width="35%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp; </strong></td>
                            <td width="20%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>
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
				
				
		$sql_search = "SELECT * FROM tbl_visit_purpose ORDER BY rowID DESC LIMIT ".$offset.",".$rowsPerPage;        //Changed
		
		$result_all_rows = $db->execQuery($sql_search);
				
		$result_array = $db->resultArray($result_all_rows);	  
		
		$num_of_rows_found=mysql_num_rows($result_all_rows); 

		if($num_of_rows_found>0){
		
				for($i=0; $i<$num_of_rows_found; $i++){
				
							
					$sql = "SELECT PurposeName FROM tbl_visit_purpose WHERE purposeName = "."'".$result_array[$i]['purposeName']."'";
					$result_all_rows = $db->execQuery($sql);
					$result_array_registration = $db->resultArray($result_all_rows);	  		
?>						 
 
		<tr>
        	<td bgcolor="#EEEEEC" align="center"><?php echo $result_array[$i]['purposeName'];?></td>			
			<td bgcolor="#EEEEEC" align="center"></td>
            
      		<td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_visit_purpose&edit=true&rowID=<?php echo $result_array[$i]['rowID'];?>"> Edit</a></td>
            
            
            <?php                                                              // Change
    if ($result_array[$i]['isDisabled'] != 'yes'){
    ?>
                <td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_visit_purpose&disable=true&rowID=<?php echo $result_array[$i]['rowID'];?>"> Disable</a></td>
    <?php 
    }
    else{            
    ?>
                <td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=setup_visit_purpose&enable=true&rowID=<?php echo $result_array[$i]['rowID'];?>"> Enable</a></td>            
    <?php
    }
    ?>                           
        
            
            
			<td bgcolor="#EEEEEC" align="center"></td>			
		</tr>
<?php
		}
?>  
				<tr>
					<td bgcolor="#EEEEEC" align="center" height="20"  colspan="5"></td>
				</tr>

				<tr class="Text" align="center">
                  <td height="20" colspan="5">
<?php

		$query = "SELECT * FROM tbl_visit_purpose ";
		
		
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
			  $nav .= " <a href=\"$self?action=setup_visit_purpose&page=$page\">$page</a> ";
		   } 
		}
		
		if ($pageNum > 1)
		{
		   $page  = $pageNum - 1;
		   $prev  = " <a href=\"$self?action=setup_visit_purpose&page=$page\">[Prev]</a> ";
		
		   $first = " <a href=\"$self?action=setup_visit_purpose&page=1\">[First Page]</a> ";
		} 
		else
		{
		   $prev  = '&nbsp;'; // we're on page one, don't print previous link
		   $first = '&nbsp;'; // nor the first page link
		}
		if ($pageNum < $maxPage)
		{
		   $page = $pageNum + 1;
		   $next = " <a href=\"$self?action=setup_visit_purpose&page=$page\">[Next]</a> ";
		
		   $last = " <a href=\"$self?action=setup_visit_purpose&page=$maxPage\">[Last Page]</a> ";
		} 
		else
		{
		   $next = '&nbsp;'; // we're on the last page, don't print next link
		   $last = '&nbsp;'; // nor the last page link
		}

		//echo $first . $prev . $nav . $next . $last;

		echo $first . $prev . " Showing page $pageNum of $maxPage pages " . $next . $last;

}
?> 
</table>   
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

    
    
    
  


