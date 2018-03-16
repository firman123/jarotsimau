<?php

$this->load->library('fpdf');
$this->fpdf->__construct("P", "cm", array(21.6, 33));
$this->fpdf->SetMargins(2, 3, 2);
$this->fpdf->setAutoPageBreak(false);

$this->fpdf->AddPage();
$this->fpdf->SetFont('Arial', '', 12);
$tanggal_dikeluarkan = date("Y-m-d");
//
$this->fpdf->Cell(11, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(5, 0.5, "Balikpapan", 0 , 0, 'C');
$this->fpdf->Cell(0, 0.5, "", 0 , 1, 'C');
$this->fpdf->Cell(11, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(5, 0.5, "Yth. Kepala  UPT PKB", 0 , 0, 'C');
$this->fpdf->Cell(0, 0.5, "", 0 , 1, 'C');
$this->fpdf->Cell(11, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(5, 0.5, "Di", 0 , 0, 'C');
$this->fpdf->Cell(0, 0.5, "", 0 , 1, 'C');
$this->fpdf->ln(2);

$this->fpdf->Multicell(0, 0.5, "  Bersama ini disampaikan permohonan bantuan proses administrasi untuk pengujian"
        . " berkala kendaraan bermotor Angkutan Kota Balikpapan dengan identitas sebagai berikut", 0, 'J');
$this->fpdf->ln(0.5);
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Nomor Kendaraan", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, $detail['no_kendaraan'], 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Nama Pemilik", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'R');
$nama_pemilik = $detail['nama_pemilik'];
if (strlen($nama_pemilik) > 30) {
    $this->fpdf->MultiCell(0, 0.5, $nama_pemilik , 0, 'J');
    $this->fpdf->ln(0.8);
} else {
    $this->fpdf->Cell(0, 0.5, $nama_pemilik, 0, 0, 'L');
}
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Merk Kendaraan", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(5, 0.5,$detail['merk'], 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "No. Uji", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, $detail['no_uji'], 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Tahun Pembuatan ", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5,$detail['tahun'], 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Nomor Trayek", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.3,$detail['kd_trayek'], 0, 0, 'L');
$this->fpdf->ln(0.8);

$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Nomor Rangka ", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5,$detail['no_chasis'], 0, 0, 'L');
$this->fpdf->ln(0.8);

$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Nomor Mesin ", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5,$detail['no_mesin'], 0, 0, 'L');
$this->fpdf->ln(0.8);

$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Masa Berlaku ", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5,$date_manipulation->get_full_date($detail['berlaku_masa']), 0, 0, 'L');
$this->fpdf->ln(0.8);

$this->fpdf->Cell(0, 0.5, "Demikian disampaikan, atas bantuan dan kerjasamanya kami ucapkan terima kasih ", 0 , 1, 'L');
//
$this->fpdf->ln(2);
$this->fpdf->Cell(9, 0.5, "", 0, 0, 'C');
$this->fpdf->Cell(0, 0.5, "Balikpapan, ".$date_manipulation->get_full_date($tanggal_dikeluarkan), 0 , 1, 'L');

$this->fpdf->Cell(9, 0.5, "", 0, 0, 'C');
$this->fpdf->Cell(0, 0.5, "KEPALA DINAS PERHUBUNGAN", 0 , 0, 'C');
$this->fpdf->ln();
$this->fpdf->Cell(9, 0.3, "  ", 0,0,'L');
$this->fpdf->Cell(0, 0.3, "KOTA BALIKPAPAN", 0 , 0, 'C');
$this->fpdf->ln(3);
$this->fpdf->Cell(9, 0.5, "  ", 0,0,'L');
$this->fpdf->SetFont('Arial', 'U', 12);
$this->fpdf->Cell(0, 0.5, "SUDIRMAN DJAYALEKSANA", 0 , 0, 'C');
$this->fpdf->ln();
$this->fpdf->SetFont('Arial', '', 12);
$this->fpdf->Cell(9, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(0, 0.5, "Pembina TK. I", 0 , 0, 'C');
$this->fpdf->ln();
$this->fpdf->Cell(9, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(0, 0.5, "NIP. 19691110 199003 1 013", 0 , 0, 'C');
$this->fpdf->ln(1.3);
//

$this->fpdf->Output("Rubah Sifat.pdf", "I");
?>