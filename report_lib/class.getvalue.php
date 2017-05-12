<?php

class getvalue
{
	public function getvalue()
	{
		//include '../report_lib/connection.php';	
		//echo "new object created";
		
	}
	public function get_dte($dte)
	{
		$sql= "SELECT directorateName  FROM tbl_directorate WHERE rowID = '".$dte."'"; 
		$result= mysql_query($sql) or die(mysql_error());
		
		$row= mysql_fetch_array($result);
		 
		return $row['directorateName'];
				
	}
	public function get_rank($rank)
	{
		$sql= "SELECT rankName  FROM tbl_rank WHERE rowID = '".$rank."'"; 
		$result= mysql_query($sql) or die(mysql_error());
		
		$row= mysql_fetch_array($result);
		 
		return $row['rankName'];
				
	}
	public function get_purpose($purpose)
	{
		$sql= "SELECT purposeName  FROM tbl_visit_purpose WHERE rowID = '".$purpose."'"; 
		$result= mysql_query($sql) or die(mysql_error());
		
		$row= mysql_fetch_array($result);
		 
		return $row['purposeName'];
				
	}
	public function get_appt($appt)
	{
		$sql= "SELECT appointmentName  FROM tbl_visit_purpose WHERE rowID = '".$appt."'"; 
		$result= mysql_query($sql) or die(mysql_error());
		
		$row= mysql_fetch_array($result);
		 
		return $row['appointmentName'];
				
	}

}
?>