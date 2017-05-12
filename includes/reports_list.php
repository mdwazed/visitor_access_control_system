<table width="100%" >
	<tr>
		<td align="left" width="100%" valign="top">
			<h4>List of Reports</h4>


	<table border="0"  width="100%" style="padding-right: 20px; padding-right:20px;" >
	<tr valign="top">
        <td align="center"  valign="top">
         
            <table  width="100%" align="right" >
                <tr>
                    <td colspan="2" align="justify"    valign="top"  style="color:#000000">
                    
                      <p>This page is under construction                  </p>
                      <table width="100%" border="1">
                        <tr>
                          <td width="10%"><div align="center">Ser</div></td>
                          <td width="80%"><div align="center">Reports</div></td>
                          <td width="10%"><div align="center"></div></td>
                        </tr>
                        <tr>
                          <td>1</td>
                         <td><a href="reports/visitors_last7days.php" target="_blank">List of visitors of last 7 days</a></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td>2</td>
                        <!--    <td><a href="reports/visitors_inrange.php" target="_blank">List of visitors for a selective duration</a></td>  -->
                         <td><a href="reports/visitors_last30days.php" target="_blank">List of visitors of last 30 days</a></td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td><a href="reports/stat_by_dte.php" target="_blank">summary statistics</a></td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td><a href="reports/last_30days_temp.php" target="_blank">Temporary pass used during last 30 days</a> </td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>5</td>
                           <td><a href="reports/last_30days_foreigner.php" target="_blank">List of foreigner visited AHQ during last 30 days</a> </td>
                          <td>&nbsp;</td>
                        </tr>
			<tr>
                          <td>6</td>
                          <td><a href="reports/stat_graph.php" target="_blank">Graph representation of summary</a></td>
                          <td>&nbsp;</td>
                        </tr>
                      </table>
                      <p>&nbsp;</p>
                    <p>&nbsp;  </p></td>
              </tr>            
	        </table>
        </td>
    </tr>
    </table>
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