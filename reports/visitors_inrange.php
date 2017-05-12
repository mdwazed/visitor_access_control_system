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




//date("Y-m-d H:i:s", $timestamp);
//$dateB = date_create($datetime);
//date_sub($dateB, date_interval_create_from_date_string('10 days')); 
//$dateC = strtotime($dateA);
//echo " predate ".date_format($dateB,'Y-m-d');
//date("d.m.Y", strtotime($timestamp));


$date = date_create();
$dateB= date_format($date,'d-m-Y');

$dateA =  date_timestamp_get($date);


$dateB = date('Y-m-d H:i:s', strtotime($dateB)); 


//echo date_format($date, 'd-m-Y');
//echo date("M-d-Y H:i:s", mktime(0, 0, 0, 12, 30, 1997));
?>


<html>
	<head>
		<link href="../style_sheets/div_style.css" rel="stylesheet" type="text/css">	
		
			<style type="text/css">
			td
			{
			background-color:#CDEDE9;
			font-size:larger;					 	
			}		
		
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><style type="text/css">
	
			
			</style>
	
	</head>
	
	
	<body>
	<table border="0" align="center"  style="text-align:center; color:#000000">
		<tr><td colspan="12"><h2>List of visitors visited AHQ from <?php echo $fdate." to ".$ldate?></h2></td></tr>
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
					while($row = mysql_fetch_array($result))
  						{
  							echo "<tr>";
							echo "<td >".$row['rowID']." </td> <td>".$row['visitorName']." </td> <td> ".$row['visitorType']." </td> <td> ".$row['visitorAddress']." </td> <td> ".$purpose->get_purpose($row['purposeOfVisit'])." </td> <td> ".$row['scheduledVisitDate']."</td><td>".$row['isMultipleEntry']."</td><td>".date_format(date_create($row['visitorInTime']),'d-m-Y')." </td> <td> ".date_format(date_create($row['visitorInTime']),'H:m:s')." </td> <td> ".date_format(date_create($row['visitorOutTime']),'d-m-Y')." </td> <td> ".date_format(date_create($row['visitorOutTime']),'H:m:s')."</td><td>".$row['passStatus']."</td>";
  							echo "</tr>";
  						}

					mysql_close($con);
				?> 	
		  </table>
						
				
		</div>
		
		<a href="visitors_inrange_print.php" target="_blank">Printer Friendly version</a>
		
	</body>

</html>