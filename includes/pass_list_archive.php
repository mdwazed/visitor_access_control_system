<table width="100%" >
	<tr>
	  <td align="left" width="70%" valign="top">
		  <h4>Archived Passes</h4>
            
             <TABLE WIDTH=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>

	<TR>
		<TD>	
        
        	<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#BFBFBF" class="bodytext" style="									                                                                                        border-collapse: collapse">
                                  
                                  
                                      <tr>
                                        <td width="8%" style="font-size:14px" bgcolor="#DFDFDF" align="center"><strong>Dir</strong></td>
                                        <td width="15%" style="font-size:14px"  bgcolor="#DFDFDF" align="center"><strong>Visitor</strong></td>
                                        <td width="10%" style="font-size:14px"  bgcolor="#DFDFDF" align="center"><strong>Address </strong></td>
                                        <td  width="8%" style="font-size:14px"  bgcolor="#DFDFDF" align="center"><strong>Type </strong></td>
                                        <td  width="8%" style="font-size:14px"  bgcolor="#DFDFDF" align="center"><strong>Purpose </strong></td>                                                                 
                                        <td width="8%" style="font-size:14px"  bgcolor="#DFDFDF" align="center"><strong>Officer</strong></td>                            
                                                           
                                        <td width="8%" style="font-size:14px"  bgcolor="#DFDFDF" align="center"><strong>Card No</strong></td>                            
                                        <td width="8%" style="font-size:14px"  bgcolor="#DFDFDF" align="center"><strong>In Time</strong></td>                            
                                        <td width="8%" style="font-size:14px"  bgcolor="#DFDFDF" align="center"><strong>Out Time</strong></td>                                        <td width="8%" style="font-size:14px"  bgcolor="#DFDFDF" align="center"><strong>Pass Status</strong></td>                                    	<td width="8%"  bgcolor="#DFDFDF" align="center"><strong>&nbsp;</strong></td>
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
            
                
                    $sql_search = "SELECT * FROM tbl_archive_pass " . $where_clause . " ORDER BY  passStatus DESC LIMIT ".$offset.",".$rowsPerPage;
                
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
                            
            ?>						 
             
                    <tr>
                        <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php 
			
			if (isset($result_array[$i]['directorateToVisit'])){

				$sql_search = "SELECT directorateName FROM tbl_directorate WHERE rowID = '".$result_array[$i]['directorateToVisit']."'";
				$result_row_directorate = $db->execQuery($sql_search);
				$result_array_directorate = $db->resultArray($result_row_directorate);	  

				echo $result_array_directorate[0]['directorateName'];
					
			}		
			?></td>
                        <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['visitorName'])) echo $result_array[$i]['visitorName'];?></td>
                        <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['visitorAddress']))echo $result_array[$i]['visitorAddress'];?></td>
                        <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['visitorType'])) echo $result_array[$i]['visitorType'];?></td>
                        <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php 
			
			if (isset($result_array[$i]['purposeOfVisit'])){

				$sql_search = "SELECT purposeName FROM tbl_visit_purpose WHERE rowID = '".$result_array[$i]['purposeOfVisit']."'";
				$result_row_purpose = $db->execQuery($sql_search);
				$result_array_purpose = $db->resultArray($result_row_purpose);	  

				echo $result_array_purpose[0]['purposeName'];
					
			}		
			?></td>
                       
                        <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['passCreator'])) echo $result_array[$i]['passCreator'];?></td>       
                             
                        <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['visitorCardNo'])) echo $result_array[$i]['visitorCardNo'];?></td>                                
                        <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['visitorInTime'])) echo $result_array[$i]['visitorInTime'];?></td>                                
                        <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['visitorOutTime'])) echo $result_array[$i]['visitorOutTime'];?></td>                                                        
                        <td style="font-size:14px"  bgcolor="#EEEEEC" align="center"><?php if (isset($result_array[$i]['passStatus'])) echo $result_array[$i]['passStatus'];?></td>      
                        <td bgcolor="#EEEEEC" align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=pass_details_archive&passID=<?php echo $result_array[$i]['rowID'];?>">Detail</a></td> 		      
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
            
                    $query = "SELECT * FROM tbl_archive_pass " . $where_clause;
                    
                    
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
                          $nav .= " <a href=\"$self?action=view_pass_list_archive&page=$page\">$page</a> ";
                       } 
                    }
                    
                    if ($pageNum > 1)
                    {
                       $page  = $pageNum - 1;
                       $prev  = " <a href=\"$self?action=view_pass_list_archive&page=$page\">[Prev]</a> ";
                    
                       $first = " <a href=\"$self?action=view_pass_list_archive&page=1\">[First Page]</a> ";
                    } 
                    else
                    {
                       $prev  = '&nbsp;'; // we're on page one, don't print previous link
                       $first = '&nbsp;'; // nor the first page link
                    }
                    if ($pageNum < $maxPage)
                    {
                       $page = $pageNum + 1;
                       $next = " <a href=\"$self?action=view_pass_list_archive&page=$page\">[Next]</a> ";
                    
                       $last = " <a href=\"$self?action=view_pass_list_archive&page=$maxPage\">[Last Page]</a> ";
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