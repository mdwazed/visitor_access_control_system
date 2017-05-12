<?php
require('../report_lib/mysql_table_pdf.php');


class PDF extends PDF_MySQL_Table
{

function Header()
{
	$table_name = 'test table';
    //Title
    $this->SetFont('Arial','',18);
    $this->Cell(0,6,$table_name,0,1,'C');
    $this->Ln(10);
    //Ensure table header is output
    parent::Header();
}
}

//Connect to database
mysql_connect('localhost','wazed','wazed');
mysql_select_db('vacs');

$pdf=new PDF();
$pdf->AddPage();
//First table: put all columns automatically
$pdf->Table('select * from tbl_print');

$pdf->Output();
?>