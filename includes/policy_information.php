<?php

if(  isset($_REQUEST["delete"]) && $_REQUEST["delete"] == "true"){
		
		   $sql_search = "SELECT fileName FROM tbl_policy_upload WHERE rowID='". $_REQUEST['policy_id']."'";
		   $result_all_rows = $db->execQuery($sql_search);		
		   $result_array = $db->resultArray($result_all_rows);		
		   
		   $tmpfile = "policy_docs/" . $result_array[0]['fileName'];  

		   if (  file_exists($tmpfile)){
						
					   if( unlink($tmpfile) ){	
							$query = "DELETE  FROM tbl_policy_upload WHERE rowID='". $_REQUEST['policy_id']."'";
							mysql_query($query);				
					   }
					   else{
							echo "Policy document could not be deleted.";		   	   
					   }
			}
			else{
							$query = "DELETE  FROM tbl_policy_upload WHERE rowID='". $_REQUEST['policy_id']."'";
							mysql_query($query);				
			}
}

?>

<table width="100%" >
	<tr>
    	<?php  
            if (isset($_SESSION['_userName'])) {
             ?>	  <td align="left" width="70%" valign="top">

         <?php 
            }
			else {
            ?>   <td align="left" width="100%" valign="top">
		   <?php 
                }
            ?> 
              <h4>Policy Information</h4>
            
             <TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>

	<TR>
		<TD>	
        
        	<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">
                                      <tr>
                                        <td width="10%" style="font-size:14px" bgcolor="#DFDFDF" align="center"><strong></strong></td>
                                        <td width="25%" style="font-size:14px"  bgcolor="#DFDFDF" align="center"><strong>Policy Name</strong></td>
                                        <td width="40%" style="font-size:14px"  bgcolor="#DFDFDF" align="center"><strong>Description </strong></td>
                                    	<td width="10%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>
                                        <?php	
												if ((isset($_SESSION['_userName'])) && ($_SESSION['_userType'] == 1) ) {
										?> 	
                                            
                                            <td width="10%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>
                                        <?php
										}
										?>
                                        
                                         </tr>
                                     
            <?php
            
                    $rowsPerPage = 20;		
                    $pageNum = 1;
                    
                    if(isset($_REQUEST['page'])){
                        $pageNum = $_REQUEST['page'];
                    }
                    
                    
                    $offset = ($pageNum - 1) * $rowsPerPage;
            
               
                    $sql_search = "SELECT * FROM tbl_policy_upload ORDER BY sortOrder ASC LIMIT ".$offset.",".$rowsPerPage;
                
                    $result_all_rows = $db->execQuery($sql_search);
                            
                    $result_array = $db->resultArray($result_all_rows);	  
                    
                    $num_of_rows_found=mysql_num_rows($result_all_rows);
            
                    if($num_of_rows_found>0){
                    
                            for($i=0; $i<$num_of_rows_found; $i++){
                            
            ?>						 
             
             
             <tr>
            <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><img src="images/pdf_icon.jpg" height="30" width="25" /></td>        <!-- includeed to fill space of sortOrder->
  <!--      <tr>
            <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php //if (isset($result_array[$i]['sortOrder'])) echo $result_array[$i]['sortOrder'];?></td>
-->

            <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['policyName'])) echo $result_array[$i]['policyName'];?></td>
           
            <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['policyDescription'])) echo $result_array[$i]['policyDescription'];?></td>       
            <?php /*?>            

<td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=policy_information&policyID=<?php echo $result_array[$i]['rowID'];?>">View</a></td><?php */?>


<td bgcolor="#EEEEEC" align="center">            
<input type="button" name="view_policy_Btn" id="view_policy_Btn" value="View" onclick="parent.window.open('includes/view_pdf.php?document=<?php echo $result_array[$i]['fileName'];?>','thePopup', width='800', height='500', top='10', left='10');" /></td>                    
       
 <?php	
if ((isset($_SESSION['_userName'])) && ($_SESSION['_userType'] == 1) ) {
?>
       
       <td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=policy_information&delete=true&policy_id=<?php echo $result_array[$i]['rowID'];?>"> Delete</a></td>
       
  <?php
  
  }
  ?>     
  
  
        </tr>
            <?php
                    }
            ?>  
                            <tr>
                                <td bgcolor="#EEEEEC" align="center" height="20"  colspan="12"></td>
                            </tr>
            
                            <tr class="Text" align="center">
                              <td height="20" colspan="12">
            <?php
            
                    $query = "SELECT * FROM tbl_policy_upload ";
                    
                    
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
                          $nav .= " <a href=\"$self?action=policy_information&page=$page\">$page</a> ";
                       } 
                    }
                    
                    if ($pageNum > 1)
                    {
                       $page  = $pageNum - 1;
                       $prev  = " <a href=\"$self?action=policy_information&page=$page\">[Prev]</a> ";
                    
                       $first = " <a href=\"$self?action=policy_information&page=1\">[First Page]</a> ";
                    } 
                    else
                    {
                       $prev  = '&nbsp;'; // we're on page one, don't print previous link
                       $first = '&nbsp;'; // nor the first page link
                    }
                    if ($pageNum < $maxPage)
                    {
                       $page = $pageNum + 1;
                       $next = " <a href=\"$self?action=policy_information&page=$page\">[Next]</a> ";
                    
                       $last = " <a href=\"$self?action=policy_information&page=$maxPage\">[Last Page]</a> ";
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
