<?php

$WIDTH = 29.7;
$HEIGHT = 21;
$this->load->library('fpdf');
$this->fpdf->__construct("L", "cm", array($WIDTH, $HEIGHT));
$this->fpdf->setMargins(0.5, 1, 0.5);
$this->fpdf->setAutoPageBreak(true);
$this->fpdf->AddPage();
$this->fpdf->SetFont('Arial', 'B', 16);
//$this->fpdf->Line(1, 1, 20, 1);
//$this->fpdf->Line(1, 1, 1, 28.7);
//$this->fpdf->Line(1, 28.7, 20, 28.7);
//$this->fpdf->Line(20, 1, 20, 28.7 );
$this->fpdf->Image(base_url() . 'aset/img/logo_balikpapan.png', 1, 1.5, 3, 0);
$this->fpdf->ln(1);
//$this->fpdf->Cell(5, 0.5, '', 0, 0);

$this->fpdf->Cell(28.5, 0.5, 'REKAP VALIDASI', 0, 1, 'C');
$this->fpdf->Cell(28.5, 1, 'PENGUJIAN KENDARAAN BERMOTOR', 0, 1, 'C');
$this->fpdf->Cell(28.5, 0.5, 'DINAS PERHUBUNGAN KOTA BALIKPAPAN', 0, 1, 'C');
$this->fpdf->SetFont('Arial', 'B', 12);
$tgl = date('Y-m-d');
$this->fpdf->Cell(27.5, 1, 'Tanggal Retribusi ' . $date_manipulation->get_full_date($tanggal), 0, 0, 'C');

$this->fpdf->ln(4);
$this->fpdf->SetFont('Arial', 'B', 10);

$this->fpdf->SetXY(1.3, 6);

//$this->fpdf->SetFillColor(230,230,230);
$this->fpdf->SetFillColor(255, 204, 0);
$this->fpdf->MultiCell(1, 1, 'NO', 1, 'C', true);
$this->fpdf->SetXY(2.3, 6);
$this->fpdf->MultiCell(3, 1, 'NO KWITANSI', 1, 'C', true);
$this->fpdf->SetXY(5.3, 6);
$this->fpdf->MultiCell(4, 1, 'NO. KENDARAAN', 1, 'C', true);
$this->fpdf->SetXY(9.3, 6);
$this->fpdf->MultiCell(3, 1, 'NO KP', 1, 'C', true);
$this->fpdf->SetXY(12.3, 6);
$this->fpdf->MultiCell(7, 1, 'NAMA PEMILIK', 1, 'C', true);
$this->fpdf->SetXY(19.3, 6);
$this->fpdf->MultiCell(7, 1, 'NAMA PERUSAHAAN', 1, 'C', true);
$this->fpdf->SetXY(25.3, 6);
$this->fpdf->MultiCell(3.5, 1, 'RETRIBUSI', 1, 'C', true);
$nomor = 0;

$this->fpdf->SetFont('Arial', '', 10);
$totalHeight = 0;
$totalPrice = 0;
foreach ($data as $item) {

    $nomor++;
    $new_price = preg_replace('/[^A-Za-z0-9\  ]/', '', $item->harga);
    $convertPriceToInt = (int) $new_price;
    $this->fpdf->SetLeftMargin(1.3);
    $this->fpdf->Cell(1, 1, $nomor, 1, 0, 'C');
    $this->fpdf->Cell(3, 1, $item->id_kwitansi, 1, 0, 'L');
    $this->fpdf->Cell(4, 1, $item->no_kendaraan, 1, 0, 'L');
    $this->fpdf->Cell(3, 1, $item->kp_ijin, 1, 0, 'L');
    $this->fpdf->Cell(7, 1, trim($item->nama_pemilik), 1, 0, 'L');
    $this->fpdf->Cell(6, 1, trim($item->perusahaan_name), 1, 0, 'L');
    $this->fpdf->Cell(3.5, 1, $item->harga, 1, 1, 'R');
    $totalHeight += 1;
    $totalPrice += $convertPriceToInt;
}

if (empty($data)) {
    $this->fpdf->SetLeftMargin(1.3);
    $this->fpdf->Cell(27.5, 1, 'Belum ada kuitansi tercetak hari ini', 1, 0, 'C');
} else {
    $convertTotalPrice = number_format($totalPrice, 0, ',', '.');
    $this->fpdf->SetFillColor(255, 204, 0);
    $this->fpdf->SetXY(1.3, $totalHeight + 7);
    $this->fpdf->MultiCell(25, 1, 'TOTAL', 1, 'C', true);
    $this->fpdf->SetXY(25.3, $totalHeight + 7);
    $this->fpdf->MultiCell(3.5, 1, $convertTotalPrice, 1, 'R', true);
}

$this->fpdf->ln(3);
$this->fpdf->SetLeftMargin(3);
$this->fpdf->Cell(2, 0.5, '', 0, 0, 'L');
$this->fpdf->Cell(2, 0.5, 'Mengetahui,', 0, 1, 'L');
$this->fpdf->Cell(0.5, 0.5, '', 0, 0, 'L');
$this->fpdf->Cell(16, 0.5, 'Kepala Unit Pelaksana Teknis', 0, 0, 'L');
$this->fpdf->Cell(10, 0.5, 'Bendahara Pembantu Penerima', 0, 1, 'L');
$this->fpdf->Cell(0.3, 0.3, '', 0, 0, 'L');
$this->fpdf->Cell(2, 0.5, 'Pengujian Kendaraan Bermotor', 0, 1, 'L');
$this->fpdf->ln(2);
$this->fpdf->SetFont('Arial', 'U', 12);
$this->fpdf->Cell(6, 0.5, 'AGUS WIJAYA BUMI ', 0, 0, 'C');
$this->fpdf->Cell(10, 0.5, '', 0, 0, 'C');
$this->fpdf->Cell(6, 0.5, 'YULIA RUMADUTU ', 0, 1, 'C');
$this->fpdf->SetFont('Arial', '', 12);
$this->fpdf->Cell(6, 0.5, 'NIP. 19610817 198303 1 030 ', 0, 0, 'C');
$this->fpdf->Cell(10, 0.5, '', 0, 0, 'C');
$this->fpdf->Cell(6, 0.5, 'NIP. 19650703 200604 2 005 ', 0, 1, 'C');
$this->fpdf->Output('SuratIjin.pdf', 'I');
?>