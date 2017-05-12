<?php
include '../report_lib/connection.php';
include '../report_lib/class.getvalue.php';

$dte= new getvalue();
$today= date_create();
$today=date_timestamp_get($today);
$date=$today-(7*24*60*60);
$date_w= date('Y-m-d H:m:s',$date);
$date_m=$today-(30*7*24*60*60);
$date_m= date('Y-m-d H:m:s',$date_m);


$sql = "SELECT directorateToVisit, COUNT(visitorInTime) FROM tbl_pass WHERE visitorInTime >'$date_w' GROUP BY directorateToVisit ";
$result = mysql_query($sql) or die(mysql_error());
$sql_t_wk = "SELECT directorateToVisit, COUNT(visitorInTime) FROM tbl_pass_temporary WHERE visitorInTime >'$date_w' GROUP BY directorateToVisit ";
$result_t_wk = mysql_query($sql_t_wk) or die(mysql_error());
$sql_m = "SELECT directorateToVisit, COUNT(visitorInTime) FROM tbl_pass WHERE visitorInTime >'$date_m' GROUP BY directorateToVisit ";
$result_m = mysql_query($sql_m);
$sql_t_m = "SELECT directorateToVisit, COUNT(visitorInTime) FROM tbl_pass_temporary WHERE visitorInTime >'$date_m' GROUP BY directorateToVisit ";
$result_t_m = mysql_query($sql_t_m);


$date = date_create();
$dateB= date_format($date,'d-m-Y');

$dateA =  date_timestamp_get($date);


$dateB = date('Y-m-d H:i:s', strtotime($dateB)); 


//echo date_format($date, 'd-m-Y');
//echo date("M-d-Y H:i:s", mktime(0, 0, 0, 12, 30, 1997));
?>


<html>
	<head>
		<link href="../css/report_style_print.css" rel="stylesheet" type="text/css">	
		
		
	
	</head>
	
	
	<body>
	<table border="0" align="center"  style="text-align:center;">
		<tr><td colspan="2"><u>Regular Pass</u></td></tr>
		<tr><td valign="top">
		<table border="0" align="center" valign="top" cellspacing="3" bordercolor="#FFFFFF"  style="text-align:center; color:#000000">
          <tr>
            <td colspan="4">Last 7 days</td>          
          <tr>
            <td>Directorate</td>
			<td>Military</td>
			<td>Civilian</td>
            <td>Total</td>
          </tr>
          <?php
				
									
					while($row = mysql_fetch_array($result))
  						{
							
							
  							echo "<tr>";
							echo "<td >".$dte->get_dte($row['directorateToVisit'])."</td><td></td><td></td><td>".$row['COUNT(visitorInTime)']."</td>";
  							echo "</tr>";
  						}
						
						echo "<tr><td colspan=\"3\">Total</td><td>";
						
						$sql = "SELECT COUNT(visitorInTime) FROM tbl_pass WHERE visitorInTime >'$date_w' ";
						$result= mysql_query($sql) or die(mysql_error());
						$row= mysql_fetch_array($result);
						echo $row['COUNT(visitorInTime)'];
						echo "</td>";

					
				?>
        </table></td>
		<td>
			
		  <table border="0" align="center" vspace="1" cellspacing="3" bordercolor="#FFFFFF"  style="text-align:center; color:#000000">
			  <tr>
				<td colspan="4">Last 30 days</td>          
			  <tr>				
				<td>Directorate</td>
				<td>Military</td>
				<td>Civilian</td>
				<td>Total</td>
				
				</tr>
				<?php
				
									
					while($row_m = mysql_fetch_array($result_m))
  						{
							
							
  							echo "<tr>";
							echo "<td >".$dte->get_dte($row_m['directorateToVisit'])."</td><td></td><td></td><td>".$row_m['COUNT(visitorInTime)']."</td>";
  							echo "</tr>";
  						}
						echo "<tr><td colspan=\"3\">Total</td><td>";
						
						$sql = "SELECT COUNT(visitorInTime) FROM tbl_pass WHERE visitorInTime >'$date_m' ";
						$result= mysql_query($sql);
						$row= mysql_fetch_array($result);
						echo $row['COUNT(visitorInTime)'];
						echo "</td>";

					
				?>
		  </table>			</td>
		  </table>
		  
		  <!------------------------------------------------------------------------------------------------------------------------------->
		  <table class="break" align="center">
		  <tr><td colspan="2" align="center"><u> Temporary Pass</u></td></tr>
		  <td   valign="top">
		  <table  border="0" align="center" valign="top" cellspacing="3" bordercolor="#FFFFFF"  style="text-align:center; color:#000000">
          <tr>
            <td colspan="4">Last 7 days</td>          
          <tr>
            <td>Directorate</td>
			<td>Military</td>
			<td>Civilian</td>
            <td>Total</td>
          </tr>
          <?php
				
									
					while($row = mysql_fetch_array($result_t_wk))
  						{
							
							
  							echo "<tr>";
							echo "<td >".$dte->get_dte($row['directorateToVisit'])."</td><td></td><td></td><td>".$row['COUNT(visitorInTime)']."</td>";
  							echo "</tr>";
  						}
						
						echo "<tr><td colspan=\"3\">Total</td><td>";
						
						$sql = "SELECT COUNT(visitorInTime) FROM tbl_pass_temporary WHERE visitorInTime >'$date_w' ";
						$result= mysql_query($sql) or die(mysql_error());
						$row= mysql_fetch_array($result);
						echo $row['COUNT(visitorInTime)'];
						echo "</td>";

					
				?>
        </table>
		  </td><td valign="top">
		  <table border="0" align="center" valign="top" cellspacing="3" bordercolor="#FFFFFF" style="text-align:center; color:#000000">
          <tr>
            <td colspan="4">Last 30 days</td>          
          <tr>
            <td>Directorate</td>
			<td>Military</td>
			<td>Civilian</td>
            <td>Total</td>
          </tr>
          <?php
				
									
					while($row = mysql_fetch_array($result_t_m))
  						{
							
							
  							echo "<tr>";
							echo "<td >".$dte->get_dte($row['directorateToVisit'])."</td><td></td><td></td><td>".$row['COUNT(visitorInTime)']."</td>";
  							echo "</tr>";
  						}
						
						echo "<tr><td colspan=\"3\">Total</td><td>";
						
						$sql = "SELECT COUNT(visitorInTime) FROM tbl_pass_temporary WHERE visitorInTime >'$date_m' ";
						$result= mysql_query($sql) or die(mysql_error());
						$row= mysql_fetch_array($result);
						echo $row['COUNT(visitorInTime)'];
						echo "</td>";

					mysql_close($con);
				?>
        </table>
		  </td></tr>
	  </table>
						
				
		</div>
		
		<!--
		<div id="rdiv" style="position:absolute; left:1000px; top:150; height:300px; width:200px; background-color:#CCCCCC; text-align:							              center;">
		<?php include 'logout.php' ?>
		</div>
		-->
	</body>

</html>
