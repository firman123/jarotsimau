<?php

$WIDTH = 29.7;
$HEIGHT = 21;
$this->load->library('fpdf');
$this->fpdf->__construct("L", "cm", array($WIDTH, $HEIGHT));
$this->fpdf->setMargins(0.5, 1, 0.5);
$this->fpdf->setAutoPageBreak(true);
$this->fpdf->AddPage();
$this->fpdf->SetFont('Arial', 'B', 16);

$this->fpdf->Cell(28.5, 1, 'LAPORAN JUMLAH ANGKOT PER TRAYEK', 0, 1, 'C');
$this->fpdf->Cell(28.5, 0.5, 'DINAS PERHUBUNGAN KOTA BALIKPAPAN', 0, 1, 'C');
$this->fpdf->SetFont('Arial', 'B', 12);
//$this->fpdf->Cell(28.5, 1, 'Tanggal : ' . $tanggal_awal. " - " . $tanggal_akhir, 0, 1, 'C');
$this->fpdf->ln();

$this->fpdf->SetFont('Arial', 'B', 10);
$this->fpdf->Cell(4, 1, 'KODE TRAYEK', 1, 0, 'C');
foreach ($data as $value) {
    $this->fpdf->Cell(2, 1, trim($value['kd_trayek']), 1, 0, 'C');
}
$this->fpdf->ln();
$this->fpdf->Cell(4, 1, 'JUMLAH ANGKOT', 1, 0, 'C');
foreach ($data as $value) {
    $this->fpdf->Cell(2, 1, $value['count'], 1, 0, 'C');
}

$this->fpdf->Output('Laporan Jumlah Angkot.pdf', 'I');
?>