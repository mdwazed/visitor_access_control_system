<?php
include '../report_lib/connection.php';	
include '../report_lib/class.getvalue.php';

$purpose= new getvalue();
$dte= new getvalue();
$expected_date = mktime(0,0,0,date("m"),date("d")-30,date("y"));
$date= date('Y-m-d H:m:s',$expected_date);

$fdate= date('d-m-y',$expected_date);
$ldate= date('d-m-y');
$count=1;

$sql = "SELECT * FROM tbl_pass_temporary WHERE visitorInTime >'$date' ";
$result = mysql_query($sql) or die(mysql_error());
$num_of_rows= mysql_num_rows($result);
//echo "num rows".$num_of_rows;


?>


<html>
	<head>
		<link href="../css/report_style.css" rel="stylesheet" type="text/css">
	    <style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {font-size: 12px}
.style4 {
	color: #0000FF;
	font-weight: bold;
}
-->
        </style>
</head>
	
	
	<body>
		<table width="1244" bgcolor="#FFCCFF">
	<tr>
		
		<td width="97"><img src="../images/BG_lesslogo.png" Style=width:70px;height:70px;></td>
		<td width="281" valign="bottom"><p>VISITOR ACCESS CONTROL SYSTEM</p>
      <span class="style3">Powered by: CSE, MIST</span> </td><td width="802"></td>
	</tr>
	</table>
	
	<table align="center" bgcolor="#3333FF">
				<h2 align="center" class="style4"><u>Temporary pass issued from <?php echo $fdate." to ". $ldate;?></u></h2>
				<tr><th ><span class="style1">Ser</span></th>
				<th ><span class="style1">Name</span></th>
				
				<th ><span class="style1">Address</span></th>
				<th ><span class="style1">Purpose</span></th>
				<th ><span class="style1">Date</span></th>
				<th ><span class="style1">Dte to visit</span></th>
				<th ><span class="style1">In Time</span></th>
				<th ><span class="style1">Out Time</span></th>
				<th ><span class="style1">Pass Status</span></th>
				</tr>
				<?php
				
									
					while($row = mysql_fetch_array($result))
  						{
  							echo "<tr bgcolor=#FFFFFF>";
							echo "<td border-width:'1px'>".$count." </td><td>".$row['visitorName']." </td> <td> ".$row['visitorAddress']." </td> <td> ".$purpose->get_purpose($row['purposeOfVisit'])." </td> <td> ".date('d-m-Y',strtotime($row['startDate']))."</td><td>".$dte->get_dte($row['directorateToVisit'])."</td><td>".$row['visitorInTime']."</td><td>".$row['visitorOutTime']."</td><td>".$row['passStatus']."</td>";
  							echo "</tr>";
							$count++;
  						}

					mysql_close($con);
				?> 	
    </table>
		
		
			<a href="javascript:window.print()">Print</a>
	</body>

</html>
