<?php
include '../report_lib/connection.php';	
include '../report_lib/class.getvalue.php';
$purpose= new getvalue();
$expected_date = mktime(0,0,0,date("m"),date("d")-30,date("y"));
$date= date('Y-m-d H:m:s',$expected_date);

$ldate= date('d-m-y',$expected_date);
$fdate= date('d-m-y');

$sql = "SELECT * FROM tbl_pass WHERE visitorInTime >'$date' ";
$result = mysql_query($sql);
$count=1;

?>


<html>
	<head>
	<?php 
	
		echo	"<link href='../css/report_style.css' rel='stylesheet' type='text/css' >" ;	
		
	?>
	<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #FFFFFF}
.style3 {font-size: 12px}
-->
    </style>
	</head>
	
	
	<body>
			<table width="1244" bgcolor="#FFCCFF">
	<tr>
		
		<td width="97"><img src="../images/BG_lesslogo.png" Style=width:70px;height:70px;></td>
	  <td width="281" valign="bottom"><p>VISITOR ACCESS CONTROL SYSTEM</p>
      <span class="style3">Powered by: CSE, MIST</span> </td>
		<td width="802"></td>
	</tr>
	</table>
	<h2 align="center" class="style1"><u> Visitors visited AHQ from <?php echo $ldate ." to ".$fdate; ?></u></h2>
	<table border="0" align="center" cellpadding="0" cellspacing="2" bgcolor="#3333FF" >
			
				<tr bordercolor="#FFFFFF" bgcolor="#3333FF" ><td><span class="style2">Ser</span></td>
				<td nowrap><span class="style2">Visitors name</span></td>
				<td nowrap><span class="style2">Visitor Type</span></td>
				<td nowrap><span class="style2">Address</span></td>
				<td nowrap><span class="style2">Purpose</span></td>
				<td nowrap><span class="style2">Date</span></td>
				<td nowrap><span class="style2">Multiple pass</span></td>
				<td nowrap><span class="style2">In time</span></td>
				<td nowrap><span class="style2">out time </span></td>
				<td nowrap><span class="style2">status</span></td>
	  </tr>
				<?php
				
					while($row = mysql_fetch_array($result))
  						{
  							echo "<tr bgcolor=#FFFFFF align=center>";
							echo "<td bordercolor= #CCCCCC>".$count." </td> <td>".$row['visitorName']." </td> <td> ".$row['visitorType']." </td> <td> ".$row['visitorAddress']." </td> <td> ".$purpose->get_purpose($row['purposeOfVisit'])." </td> <td> ".$row['scheduledVisitDate']."</td><td>".$row['isMultipleEntry']."</td><td>".$row['visitorInTime']."</td><td>".$row['visitorOutTime']."</td><td>".$row['passStatus']."</td>";
  							echo "</tr>";
							$count++;
  						}

					mysql_close($con);
				?> 	
    </table>
						
				
		</div>

		
		<a href="javascript:window.print()">Print</a>
	</body>

</html>

