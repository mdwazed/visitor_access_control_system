<?php
include '../report_lib/connection.php';	
include '../report_lib/class.getvalue.php';

$purpose= new getvalue();
$dte= new getvalue();
$today= date_create();
$today=date_timestamp_get($today);
$ldate= date('d-M-Y',$today);
$date=$today-(30*24*60*60);
$date_pass= $date;
$fdate= date('d-M-Y',$date);
$date= date('Y-m-d H:m:s',$date);


$sql = "SELECT * FROM tbl_pass_foreigner WHERE visitorInTime >'$date' ";
$result = mysql_query($sql) or die(mysql_error());
$num_of_rows= mysql_num_rows($result);
//echo "num rows".$num_of_rows;




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
		<link href="../css/report_style_print.css" rel="stylesheet" type="text/css">
	</head>
	
	
	<body>
	<table>
				<tr><td id="cap" colspan="8"><h2><u><strong>Foreigners visited AHQ from <?php echo $fdate." to ". $ldate;?></strong></u></h2></td></tr>
				<tr><th >SER  </th>
				<th >NAME</th>
				<th>Country</th>
				<th >Address</th>
				<th >Purpose</th>
				<th >Date</th>
				<th >Dte visited</th>
				<th >In Time</th>
				
				
				</tr>
				<?php
				
					$ser=1;				
					while($row = mysql_fetch_array($result))
  						{
  							echo "<tr>";
							echo "<td border-width:'1px'>".$ser." </td> <td>".$row['visitorName']." </td> <td> ".$row['visitorCountry']." </td> <td> ".$row['visitorAddress']." </td> <td> ".$purpose->get_purpose($row['purposeOfVisit'])." </td> <td> ".$row['scheduledVisitDate']."</td><td>".$dte->get_dte($row['directorateToVisit'])."</td><td>".$row['visitorInTime']."</td>";
  							echo "</tr>";
							$ser +=1;
  						}

					mysql_close($con);
				?> 	
    </table>
		
		
	
	</body>

</html>
