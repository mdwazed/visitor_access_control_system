<?php
include '../report_lib/connection.php';
include '../report_lib/class.getvalue.php';

include('phpgraphlib.php');
$month= (int)date('m',time());
$month=$month-1;

$dte = new getvalue();
$graph = new PHPGraphLib(500,400);

$M1= date('M',strtotime('-1 months'));
$M2= date('M',strtotime('-2 months'));
$M3= date('M',strtotime('-3 months'));



$data= array();


$sql = "SELECT directorateToVisit, COUNT(visitorInTime) FROM tbl_pass WHERE month(visitorInTime)= '".$month."' GROUP BY directorateToVisit ";
$result = mysql_query($sql) or die(mysql_error());
while($row= mysql_fetch_array($result))
{
	 $data[$dte->get_dte($row['directorateToVisit'])]= $row['COUNT(visitorInTime)'];
	
}



$data2= array();
$month=$month-1;

$sql = "SELECT directorateToVisit, COUNT(visitorInTime) FROM tbl_pass WHERE month(visitorInTime)= '".$month."'  GROUP BY directorateToVisit ";
$result = mysql_query($sql) or die(mysql_error());
while($row= mysql_fetch_array($result))
{
	$data2[$dte->get_dte($row['directorateToVisit'])]= $row['COUNT(visitorInTime)'];
	
}
$data3= array();
$month=$month-1;

$sql = "SELECT directorateToVisit, COUNT(visitorInTime) FROM tbl_pass WHERE month(visitorInTime)= '".$month."'Group by directorateToVisit";
$result = mysql_query($sql) or die(mysql_error());
while($row= mysql_fetch_array($result))
{
	$data3[$dte->get_dte($row['directorateToVisit'])]= $row['COUNT(visitorInTime)'];
	 
}
/*
echo "var data";
echo var_dump($data);
echo var_dump($data2);
echo var_dump($data3);
*/


//$data = array('alpha'=>23, 'beta'=>45, 'cappa'=>20, 'delta'=>32, 'echo'=>14);
//$data2 = array('alpha'=>15, 'beta'=>23, 'cappa'=>23,'delta'=>12, 'echo'=>17);
//$data3 = array('alpha'=>43, 'beta'=>23, 'cappa'=>34, 'delta'=>16, 'echo'=>20);
//$data4 = array('alpha'=>23, 'beta'=>34, 'cappa'=>23, 'delta'=>9, 'echo'=>8);



$graph->addData($data,$data2,$data3);
$graph->setupYAxis("15");
$graph->setGradient('teal', '#0000FF');
$graph->setXValuesHorizontal(true);
$graph->setXAxisTextColor ('navy');
$graph->setLegend(true);
$graph->setLegendTitle($M1, $M2, $M3);
$graph->createGraph();


?>