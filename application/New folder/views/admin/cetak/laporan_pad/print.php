<?php
$WIDTH = 29.7 ;
$HEIGHT = 21;
$HEGHT_HEADER = 1;
$this->load->library('fpdf');
$this->fpdf->__construct("L", "cm", array($WIDTH, $HEIGHT));
$this->fpdf->setMargins(0.5, 1, 0.5);
$this->fpdf->setAutoPageBreak(true);
$this->fpdf->AddPage();
$this->fpdf->SetFont('Arial', 'B', 16);

$this->fpdf->Cell(0, 1, 'LAPORAN PAD', 0, 1, 'C');
$this->fpdf->Cell(28.5, 0.5, 'DINAS PERHUBUNGAN KOTA BALIKPAPAN', 0, 1, 'C');
$this->fpdf->SetFont('Arial', 'B', 12);
$this->fpdf->Cell(28.5, 1, 'Tanggal ' . $tanggal_awal. " - " . $tanggal_akhir, 0, 1, 'C');

$this->fpdf->SetFont('Arial', 'B', 12);
$this->fpdf->SetLeftMargin(3);
$this->fpdf->Cell(3, $HEGHT_HEADER, 'NOMOR', 1, 0, 'C');
$this->fpdf->Cell(10,$HEGHT_HEADER, 'PERPANJANGAN KP TRAYEK', 1, 0, 'C');
$this->fpdf->Cell(10, $HEGHT_HEADER, 'PERPANJANGAN KP OPERASI', 1, 1, 'C');
$this->fpdf->SetFont('Arial', '', 12);
$this->fpdf->Cell(3, $HEGHT_HEADER, '1', 1, 0, 'C');
$this->fpdf->Cell(10,$HEGHT_HEADER, 'Rp. '.$total_biaya_trayek , 1, 0, 'R');
$this->fpdf->Cell(10, $HEGHT_HEADER, 'Rp. '.$total_biaya_operasi, 1, 0, 'R');

$this->fpdf->SetFont('Arial', '', 12);

$this->fpdf->Output('Laporan_pad.pdf', 'I');
?>

