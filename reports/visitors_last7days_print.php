<?php
include '../report_lib/connection.php';	
include '../report_lib/class.getvalue.php';
$purpose= new getvalue();
$today= date_create();
$today=date_timestamp_get($today);
$fdate= date('d-M-Y',$today);
$date=$today-(7*24*60*60);
$ldate= date('d-M-Y',$date);
$date= date('Y-m-d H:m:s',$date);


$sql = "SELECT * FROM tbl_pass WHERE visitorInTime >'$date' ";
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
	<?php 
	
		echo	"<link href='../css/report_style_print.css' rel='stylesheet' type='text/css' >" ;	
		
	?>		
	
	</head>
	
	
	<body>
	<table align="center" cellspacing="1" >
				<tr><td  colspan="10" align="center"><h2> <u>Visitors visited AHQ from <?php echo $ldate ." to ".$fdate; ?></u></h2>
				</td></tr>
				<tr class="yellow"><td>Ser</td>
				<td>Visitors name</td>
				<td>Visitor Type</td>
				<td>Address</td>
				<td>Purpose</td>
				<td>Date</td>
				<td>Multiple pass</td>
				<td>In time</td>
				<td>out time </td>
				
				</tr>
				<?php
					$ser= 1;
					while($row = mysql_fetch_array($result))
  						{
  							echo "<tr>";
							echo "<td >".$ser." </td> <td>".$row['visitorName']." </td> <td> ".$row['visitorType']." </td> <td> ".$row['visitorAddress']." </td> <td> ".$purpose->get_purpose($row['purposeOfVisit'])." </td> <td> ".$row['scheduledVisitDate']."</td><td>".$row['isMultipleEntry']."</td><td>".$row['visitorInTime']."</td><td>".$row['visitorOutTime']."</td>";
  							echo "</tr>";
							$ser +=1;
  						}

					mysql_close($con);
				?> 	
    </table>
						
				
		</div>
	
		
	</body>

</html>

