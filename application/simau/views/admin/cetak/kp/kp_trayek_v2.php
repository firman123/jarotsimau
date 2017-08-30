<?php

$this->load->library('fpdf');
$this->fpdf->__construct("L", "cm", array(8.6, 5.5));
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(0.2, 1.7, 0);
$this->fpdf->SetAutoPageBreak(false);
/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
  di footer, nanti kita akan membuat page number dengan format : number page / total page
 */

// AddPage merupakan fungsi untuk membuat halaman baru
$this->fpdf->AddPage();

$this->fpdf->Image(base_url() . 'aset/img/kp_trayek.jpg', 0, 0, 8.6, 5.5, 'JPG');
// Setting Font : String Family, String Style, Font size
$this->fpdf->SetFont('Arial', 'B', 7);
$this->fpdf->Ln(0.4);
$this->fpdf->Cell(2.5, 0.4, 'No. Kendaraan', 0, 'L', 'L');
$this->fpdf->Cell(6, 0.4, ': '.$datpil->no_kendaraan, 0, 'C', 'L');
$this->fpdf->Ln();
$this->fpdf->Cell(2.5, 0.4, 'Nama Pemilik', 0, 'L', 'L');
$this->fpdf->Cell(6, 0.4, ': '.$datpil->nama_pemilik, 0, 'C', 'L');
$this->fpdf->Ln();
$this->fpdf->Cell(2.5, 0.4, 'Nama Perusahaan', 0, 'L', 'L');
$this->fpdf->Cell(3.7, 0.4, ': '.$datpil->nama_perusahaan, 0, 'L', 'L');
$this->fpdf->Cell(2, 0.4, $datpil->kp_ijin_trayek, 0, 'L', 'L');
$this->fpdf->Ln();
$this->fpdf->SetFont('Arial', 'B', 14);
$this->fpdf->Cell(5.5, 2, trim($datpil->kd_trayek), 0, 'L', 'R');
$this->fpdf->Image(base_url() . 'qr.png', 6.4, 3.4, 2, 2, 'PNG');
// $this->fpdf->Line(1,3.5,30,3.5);
$this->fpdf->Output("Kartu Pengawasan Trayek.pdf", "I");
?>