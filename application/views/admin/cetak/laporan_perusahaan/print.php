<?php
$WIDTH = 21;
$HEIGHT = 29.7;
$WIDTH_COLUMN = 8;
$this->load->library('fpdf');
$this->fpdf->__construct("P", "cm", array($WIDTH, $HEIGHT));
$this->fpdf->setMargins(0.5, 1, 0.5);
$this->fpdf->setAutoPageBreak(true);
$this->fpdf->AddPage();
$this->fpdf->SetFont('Arial', 'B', 16);

$this->fpdf->Cell(0, 1, 'LAPORAN PERPANJANGAN KP', 0, 1, 'C');
$this->fpdf->Cell(0, 0.5, 'DINAS PERHUBUNGAN KOTA BALIKPAPAN', 0, 1, 'C');
$this->fpdf->SetFont('Arial', 'B', 12);
$this->fpdf->Cell(0, 1, 'Tanggal ' . $tanggal_awal. " - " . $tanggal_akhir, 0, 1, 'C');

$this->fpdf->ln();
$this->fpdf->SetFont('Arial', 'B', 12);
$this->fpdf->Cell($WIDTH /2, 1, 'NAMA PERUSAHAAN', 1, 0, 'C');
$this->fpdf->Cell(0, 1, 'JUMLAH', 1, 1, 'C');
$this->fpdf->SetFont('Arial', '', 12);
foreach ($data as $value) {
 $this->fpdf->Cell($WIDTH /2, 1, trim($value['nama_perusahaan']), 1, 0, 'C');
$this->fpdf->Cell(0, 1, $value['total'], 1, 1, 'C'); 
}
$this->fpdf->Output('Laporan_perusahaan.pdf', 'I');
?>

