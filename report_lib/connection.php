<?php
	

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  exit();
  }

//echo 'connection successful';
mysql_select_db("VACS", $con) or die (mysql_error());
//mysql_close($con);

?>