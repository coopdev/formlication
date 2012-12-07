<?php

   require_once('/var/www/tcpdf/tcpdf.php');

   $name = 'Joseph';

   $pdf = new TCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,true);
   $pdf->SetPrintHeader(false);
   $pdf->SetPrintFooter(false);
   $pdf->AddPage("L");
   $pdf->SetFont("freeserif","",11);

   $pdf->Cell(20,7,"Name");
   

   //$pdf->Output('example.pdf', 'F');
   $pdf->Output('doc.pdf', 'F');
?>
