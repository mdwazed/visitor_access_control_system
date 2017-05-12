<?php

$sql_insert = "Insert into tbl_archive_pass (passID,visitorName,visitorType,visitorAddress,directorateToVisit,purposeOfVisit,scheduledVisitDate,isMultipleEntry,passCreator,sentryUserName,mobileNumber,nationalID, 	visitorCardNo,visitorInTime,visitorOutTime,	passStatus, adminNotified) select * from tbl_pass where DATEDIFF(CURDATE(), scheduledVisitDate) > 30";		
		
$db->execQuery($sql_insert);				

$sql_delete = "Delete from tbl_pass where DATEDIFF(CURDATE(), scheduledVisitDate) > 30";		
$db->execQuery($sql_delete);				

?>

