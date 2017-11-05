<?php
$WIDTH = 21;
$HEIGHT = 29.7;
$this->load->library('fpdf');
$this->fpdf->__construct("P", "cm", array($WIDTH, $HEIGHT));
$this->fpdf->setMargins(0.5,1,0.5);
$this->fpdf->setAutoPageBreak(true);
$this->fpdf->AddPage();
$this->fpdf->SetFont('Arial', 'B', 16);
//$this->fpdf->Line(1, 1, 20, 1);
//$this->fpdf->Line(1, 1, 1, 28.7);
//$this->fpdf->Line(1, 28.7, 20, 28.7);
//$this->fpdf->Line(20, 1, 20, 28.7 );
$this->fpdf->Image(base_url().'aset/img/logo_balikpapan.png', 1, 1.5, 3, 0);
$this->fpdf->ln(1);
//$this->fpdf->Cell(5, 0.5, '', 0, 0);

$this->fpdf->Cell(20, 0.5, 'REKAP VALIDASI', 0, 1, 'C');
$this->fpdf->Cell(20, 1, 'PENGUJIAN KENDARAAN BERMOTOR', 0, 1, 'C');
$this->fpdf->Cell(20, 0.5, 'DINAS PERHUBUNGAN KOTA BALIKPAPAN', 0, 1, 'C');
$this->fpdf->SetFont('Arial', 'B', 12);
 $tgl=date('Y-m-d');
$this->fpdf->Cell(19, 1, 'Tanggal Retribusi '.$date_manipulation->get_full_date($tgl), 0, 0, 'C');

$this->fpdf->ln(4);
$this->fpdf->SetFont('Arial', 'B', 10);

$this->fpdf->SetXY(1.3,6);

//$this->fpdf->SetFillColor(230,230,230);
$this->fpdf->SetFillColor(255, 204, 0);
$this->fpdf->MultiCell(1, 1, 'NO', 1, 'C', true);
$this->fpdf->SetXY(2.3,6);
$this->fpdf->MultiCell(3, 1, 'NO KWITANSI', 1, 'C', true);
$this->fpdf->SetXY(5.3,6);
$this->fpdf->MultiCell(4, 1, 'NO. KENDARAAN', 1, 'C', true);
$this->fpdf->SetXY(9.3,6);
$this->fpdf->MultiCell(3, 1, 'NO KP', 1, 'C', true);
$this->fpdf->SetXY(12.3,6);
$this->fpdf->MultiCell(4, 1, 'PETUGAS', 1, 'C', true);
$this->fpdf->SetXY(16.3,6);
$this->fpdf->MultiCell(3.5, 1, 'BIAYA', 1, 'C', true);
$nomor = 0;

$this->fpdf->SetFont('Arial', '', 10);
foreach ($data as $item) {
  $nomor++;
  $this->fpdf->SetLeftMargin(1.3);
  $this->fpdf->Cell(1, 0.5, $nomor, 1, 0, 'C');
  $this->fpdf->Cell(3, 0.5, $item->id_kwitansi, 1, 0, 'C');
   $this->fpdf->Cell(4, 0.5, $item->no_kendaraan, 1, 0, 'L');
  $this->fpdf->Cell(3, 0.5, $item->kp_ijin, 1, 0,'L');
  $this->fpdf->Cell(4, 0.5, $item->nama_petugas, 1, 0, 'C');
  $this->fpdf->Cell(3.5, 0.5, $item->harga, 1, 1, 'R');
}
$this->fpdf->Output('SuratIjin.pdf', 'I');
?>