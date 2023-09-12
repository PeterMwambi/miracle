<?php

use Vendor\Services\File\File;

File::require("vendor/libraries/pdf/fpdf.php");




class PDF extends FPDF
{

    function Header()
    {
        $this->Image(File::requirePath("app/assets/icons/logo/rmis.png"), 15, 15, 12);
        $this->setFont('Times', 'B', 20);
        $this->SetTitle("Invoice");
        $this->Cell(80);
        $this->Cell(30, 50, 'Invoice for the Month of ' . date("F, Y"));
        $this->Ln(50);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->setFont('Arial', '', 8);
        $this->Cell(0, 10, $this->PageNo(), 0, 0, 'C');
        $this->SetFillColor(255, 255, 255);
    }
}

$pdf = new PDF();

$pdf->AliasNbPages();

$pdf->AddPage("A4");

$pdf->SetFont('Arial', 'B', 12);


$invoice = [
    "Fullname" => "Peter Mwambi",
    "Date" => date("l,  d/M/Y"),
    "Amount" => "4500ksh",
    "Transaction Id" => "QWDFH563TB",
    "Payment mode" => "Mpesa",
    "Narrator" => "Westprime Properties",
    "Account Number" => "456RFHG67845PDGFA",
];


foreach ($invoice as $item => $value) {
    $pdf->Cell(1800, 10, $item . ": " . $value, 5, 2, 'L');
}
$pdf->Output();