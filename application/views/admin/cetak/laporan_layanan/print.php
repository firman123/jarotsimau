<?php

$WIDTH = 29.7;
$HEIGHT = 21;
$Y_VALUE = 4;
$this->load->library('fpdf');
$this->fpdf->__construct("L", "cm", array($WIDTH, $HEIGHT));
$this->fpdf->setMargins(0.5, 1, 0.5);
$this->fpdf->setAutoPageBreak(true);
$this->fpdf->AddPage();
$this->fpdf->SetFont('Arial', 'B', 16);

$this->fpdf->Cell(28.5, 0.5, 'LAPORAN KEGIATAN', 0, 1, 'C');
$this->fpdf->Cell(28.5, 0.5, 'DINAS PERHUBUNGAN KOTA BALIKPAPAN', 0, 1, 'C');
$this->fpdf->SetFont('Arial', 'B', 12);
$this->fpdf->Cell(28.5, 1, 'Tanggal ' . $tanggal_awal. " - " . $tanggal_akhir, 0, 0, 'C');

$this->fpdf->ln();
$this->fpdf->SetFont('Arial', 'B', 10);
$this->fpdf->Cell(2, 3, '', 1, 0, 'C');
$this->fpdf->Cell(0, 1, 'Jenis Layanan', 1, 1, 'C');
$this->fpdf->SetXY(2.5, $Y_VALUE);
$this->fpdf->MultiCell(4, 1, 'Rubah Sifat ke Plat Kuning', 1, 'C');
$this->fpdf->SetXY(6.5, $Y_VALUE);
$this->fpdf->MultiCell(4, 1, 'Rubah Sifat ke Plat Hitam', 1, 'C');
$this->fpdf->SetXY(10.5, $Y_VALUE);
$this->fpdf->MultiCell(4, 1, 'Perpanjangan KP Trayek', 1, 'C');
$this->fpdf->SetXY(14.5, $Y_VALUE);
$this->fpdf->MultiCell(4, 1, 'Perpanjangan Ijin Operasi', 1, 'C');
$this->fpdf->SetXY(18.5, $Y_VALUE);
$this->fpdf->MultiCell(4, 2, 'Pengantar Uji KIR', 0, 'C');
$this->fpdf->SetXY(22.5, $Y_VALUE);
$this->fpdf->MultiCell(3, 2, 'Peremajaan', 1, 'C');
$this->fpdf->SetXY(25.5, $Y_VALUE);
$this->fpdf->MultiCell(0, 2, 'Ijin Isindentil', 1, 'C');
$this->fpdf->Cell(2, 1, 'JUMLAH', 1, 0, 'C');
$this->fpdf->SetFont('Arial', '', 10);
$this->fpdf->Cell(4, 1, $laporan_tidak_umum, 1, 0, 'C');
$this->fpdf->Cell(4, 1, $laporan_umum, 1, 0, 'C');
$this->fpdf->Cell(4, 1, $laporan_kp_trayek, 1, 0, 'C');
$this->fpdf->Cell(4, 1, $laporan_kp_operasi, 1, 0, 'C');
$this->fpdf->Cell(4, 1, '', 1, 0, 'C');
$this->fpdf->Cell(3, 1, '', 1, 0, 'C');
$this->fpdf->Cell(0, 1, '', 1, 0, 'C');
$this->fpdf->Output('Laporan layanan.pdf', 'I');
?>

