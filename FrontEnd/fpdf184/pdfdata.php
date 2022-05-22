<?Php
require('fpdf.php');
$pdf = new FPDF(); 
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

$width_cell=array(10,30,20,30);
$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0],10,'EMPLOYEE_ID',1,0,'C',true); // First header column 
$pdf->Cell($width_cell[1],10,'NAME',1,0,'C',true); // Second header column
$pdf->Cell($width_cell[2],10,'CLASS',1,0,'C',true); // Third header column 
$pdf->Cell($width_cell[3],10,'MARK',1,1,'C',true); // Fourth header column
//// header is over ///////

$pdf->SetFont('Arial','',10);
// First row of data 
$pdf->Cell($width_cell[0],10,'1',1,0,'C',false); // First column of row 1 
$pdf->Cell($width_cell[1],10,'John Deo',1,0,'C',false); // Second column of row 1 
$pdf->Cell($width_cell[2],10,'Four',1,0,'C',false); // Third column of row 1 
$pdf->Cell($width_cell[3],10,'75',1,1,'C',false); // Fourth column of row 1 

$pdf->Output();

?>