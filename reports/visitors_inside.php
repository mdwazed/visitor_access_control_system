<?php
include '../report_lib/connection.php';	
$result = mysql_query("SELECT * FROM tbl_pass WHERE visitorOutTime is NULL");



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
				<tr><td>Ser</td>
				<td>Visitors name</td>
				<td>Visitor Type</td>
				<td>Address</td>
				<td>Purpose</td>
				<td>Date</td>
				<td>Multiple pass</td>
				</tr>
				<?php
					while($row = mysql_fetch_array($result))
  						{
  							echo "<tr>";
							echo "<td >".$row['rowID']." </td> <td>".$row['visitorName']." </td> <td> ".$row['visitorType']." </td> <td> ".$row['visitorAddress']." </td> <td> ".$row['purposeOfVisit']." </td> <td> ".$row['scheduledVisitDate']."</td><td>".$row['isMultipleEntry'];
  							echo "</tr>";
  						}

					mysql_close($con);
				?> 	
		  </table>
						
				
		</div>
		
		<!--
		<div id="rdiv" style="position:absolute; left:1000px; top:150; height:300px; width:200px; background-color:#CCCCCC; text-align:							              center;">
		<?php include 'logout.php' ?>
		</div>
		-->
	</body>

</html>

