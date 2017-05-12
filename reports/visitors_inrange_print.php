<?php
include '../report_lib/connection.php';
include '../report_lib/class.getvalue.php';

$purpose = new getvalue();
$fdate='1-8-2012';
$ldate= '1-9-2012';
$dateA =new DateTime($fdate);
$dateA=date_format($dateA,'Y-m-d H:m:s');

$dateB =new DateTime($ldate);
$dateB=date_format($dateB,'Y-m-d H:m:s');



$sql = "SELECT * FROM tbl_pass WHERE visitorInTime between '$dateA' and '$dateB' AND visitorOutTime is not null";
$result = mysql_query($sql);





?>


<html>
	<head>
		<link href="../css/report_style_print.css" rel="stylesheet" type="text/css">	
		
		
	
	</head>
	
	
	<body>
	<table border="0" align="center"  style="text-align:center; color:#000000">
		<tr><td colspan="12"><u><h2>List of visitors visited AHQ from <?php echo $fdate." to ".$ldate?></h2></u></td></tr>
				<tr><td>Ser</td>
				<td>Visitors name</td>
				<td>Visitor Type</td>
				<td>Address</td>
				<td>Purpose</td>
				<td>Date</td>
				<td>Multiple pass</td>
				<td>In Date</td>
				<td>In time</td>
				<td>Out Date</td>
				<td>out time </td>
				<td>status</td>
				</tr>
				<?php
					$ser=1;
					while($row = mysql_fetch_array($result))
  						{
  							echo "<tr>";
							echo "<td >".$ser." </td> <td>".$row['visitorName']." </td> <td> ".$row['visitorType']." </td> <td> ".$row['visitorAddress']." </td> <td> ".$purpose->get_purpose($row['purposeOfVisit'])." </td> <td> ".$row['scheduledVisitDate']."</td><td>".$row['isMultipleEntry']."</td><td>".date_format(date_create($row['visitorInTime']),'d-m-Y')." </td> <td> ".date_format(date_create($row['visitorInTime']),'H:m:s')." </td> <td> ".date_format(date_create($row['visitorOutTime']),'d-m-Y')." </td> <td> ".date_format(date_create($row['visitorOutTime']),'H:m:s')."</td><td>".$row['passStatus']."</td>";
  							echo "</tr>";
							$ser +=1;
  						}

					mysql_close($con);
				?> 	
		  </table>
						
				
		</div>
		
		
		
	</body>

</html>