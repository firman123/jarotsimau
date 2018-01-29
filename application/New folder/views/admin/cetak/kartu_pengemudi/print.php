<?php

$this->load->library('fpdf');
$this->fpdf->__construct("P", "cm", array(5.5, 8.6));
// kita set marginnya dimulai dari kiri, atas, kanan. jika tidak diset, defaultnya 1 cm
$this->fpdf->SetMargins(0, 4, 0);
$this->fpdf->SetAutoPageBreak(false);
/* AliasNbPages() merupakan fungsi untuk menampilkan total halaman
  di footer, nanti kita akan membuat page number dengan format : number page / total page
 */

// AddPage merupakan fungsi untuk membuat halaman baru
$this->fpdf->AddPage();

$this->fpdf->Image(base_url() . 'aset/img/kartu_pengemudi.jpg', 0, 0, 5.5, 8.6, 'JPG');
// Setting Font : String Family, String Style, Font size
$this->fpdf->SetFont('Arial', 'B', 7);

$this->fpdf->Image($poto_sopir, 4, 1.3, 0, 2.5);

//$this->fpdf->SetMargins(0, 4, 0);
$this->fpdf->SetFont('Arial', 'B', 9);
$nama = trim(rawurldecode($datpil->nama_pengemudi));
$this->fpdf->Cell(5.6, 0.5,$nama, 0, 0, 'C');
$this->fpdf->ln(0.5);

$this->fpdf->SetFont('Arial', 'B', 8);
$this->fpdf->SetLeftMargin(0.3);
$this->fpdf->Cell(5.6, 0.4, $datpil->no_kendaraan, 0, 0, 'L');
$this->fpdf->ln();
$this->fpdf->Cell(5.6, 0.4, $datpil->nama_perusahaan, 0, 0, 'L');
$this->fpdf->Image(base_url() . 'qr.png', 0.3, 5.6, 1.8, 1.8, 'PNG');
$this->fpdf->ln(2);
$this->fpdf->SetFont('Arial', 'B', 16);
$this->fpdf->SetRightMargin(1.4);
$this->fpdf->SetTextColor(2555, 255, 255);
$this->fpdf->Cell(5, 1.5, trim($datpil->kd_trayek), 0, 0, 'R');
// $this->fpdf->Line(1,3.5,30,3.5);
$this->fpdf->Output("Output.pdf", "I");
?>