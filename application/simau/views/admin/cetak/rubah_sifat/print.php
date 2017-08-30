<?php

$this->load->library('fpdf');
$this->fpdf->__construct("P", "cm", array(21.6, 33));
$this->fpdf->SetMargins(2, 1, 2);
$this->fpdf->setAutoPageBreak(false);

$this->fpdf->AddPage();
$this->fpdf->Image(base_url() . 'aset/img/logo_kota_hitam.png', 1, 1, 2.5, 3);
$this->fpdf->SetFont('Arial', 'B', 16);
$this->fpdf->Cell(0, 0.5, "PEMERINTAH KOTA BALIKAPAN", 0, 0, 'C');
$this->fpdf->ln();

//$this->fpdf->SetFont('Arial', 'I', 16);
$this->fpdf->SetFont('Arial', 'BI', 18);
$this->fpdf->Cell(0, 0.8, "DINAS PERHUBUNGAN", 0, 0, 'C');
$this->fpdf->ln();
$this->fpdf->SetFont('Arial', '', 12);
$this->fpdf->Cell(0, 0.5, "Jl. Syarifuddin Yoes Telp. 0542-7581358 Fax. 0542-7581359 Kode Pos 7614", 0, 0, "C");
$this->fpdf->ln();
$this->fpdf->Cell(0, 0.5, "Email : dishubbalikpapan@gmail.com", 0, 0, "C");
$this->fpdf->ln();
$this->fpdf->Cell(0, 0.5, "(Gedung Squash Indoor Kota Balikpapan)", 0, 0, "C");
$this->fpdf->ln();
$this->fpdf->Cell(0, 0.8, "BALIKPAPAN", 0, 0, "C");
$this->fpdf->SetLineWidth(0.08);
$this->fpdf->Line(1, 4.7, 20, 4.7);
$this->fpdf->ln(1.5);

$this->fpdf->SetFont('Arial', 'B', 16);
$this->fpdf->Cell(0, 0.8, "PERSETUJUAN PERUBAHAN SIFAT", 0, 0, 'C');
$this->fpdf->ln();
$this->fpdf->Cell(0, 0.5, "KENDARAAN BERMOTOR", 0, 0, 'C');
$this->fpdf->ln();
$this->fpdf->SetLineWidth(0.03);
$this->fpdf->Line(5, 6.6, 16, 6.6);
$this->fpdf->SetFont('Arial', '', 12);
$this->fpdf->Cell(0, 0.5, "Nomor : 551.21/07/".$datpil->id."/".date('Y'), 0, 0, 'C');

$this->fpdf->SetLeftMargin(1.5);
$this->fpdf->ln(1.5);
$this->fpdf->Cell(3.5, 0.5, "Dasar  ", 0,0,'L');
$this->fpdf->Cell(0.5, 0.5, ": ", 0, 0, 'L');
$this->fpdf->Cell(6, 0.5, "Surat Permohonan Tanggal", 0, 0, 'L');
$this->fpdf->Cell(0.5, 0.5, ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, $date_manipulation->get_full_date($datpil->tanggal), 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(4, 0.5, "  ", 0, 0, 'L');
$this->fpdf->Cell(6, 0.5, "Nama Pimpinan", 0, 0, 'L');
$this->fpdf->Cell(0.5, 0.5, ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, $datpil->nama_pimpinan, 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(4, 0.5, "  ", 0, 0, 'L');
$this->fpdf->Cell(6, 0.5, "Nama Badan Usaha", 0, 0, 'L');
$this->fpdf->Cell(0.5, 0.5, ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, $datpil->nama_perusahaan, 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(4, 0.5, "  ", 0, 0, 'L');
$this->fpdf->Cell(6, 0.5, "Alamat Usaha", 0, 0, 'L');
$this->fpdf->Cell(0.5, 0.5, ": ", 0, 0, 'L');

$alamat = $datpil->alamat_perusahaan;
if (strlen($alamat) > 30) {
    $this->fpdf->Cell(0, 0.5, substr($alamat, 0, 30) . " - ", 0, 0, 'L');
    $this->fpdf->ln(0.8);
    $this->fpdf->Cell(10.5, 0.5, "  ", 0, 0, 'L');
    $this->fpdf->Cell(0, 0.5, substr($alamat, 31), 0, 0, 'L');
    
} else {
    $this->fpdf->Cell(0, 0.5, $alamat, 0, 0, 'L');
}

$this->fpdf->ln(1.5);
$this->fpdf->Cell(3.5, 0.5, "Tentang  ", 0,0,'L');
$this->fpdf->Cell(0.5, 0.5, ": ", 0, 0, 'L');
$this->fpdf->Cell(5, 0.5, "Perubahan sifat kendaraan bermotor yang identitasnya sebagai berikut : ", 0 , 0, 'L');
$this->fpdf->ln(0.8);

//
$this->fpdf->Cell(4, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Nama Pemilik", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, $datpil->nama_pemilik, 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(4, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Alamat Pemilik", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'R');
$alamat_pemilik = $datpil->alamat;
if (strlen($alamat_pemilik) > 30) {
    $this->fpdf->Cell(0, 0.5, substr($alamat_pemilik, 0, 30) . " - ", 0, 0, 'L');
    $this->fpdf->ln(0.8);
    $this->fpdf->Cell(10.5, 0.5, "  ", 0, 0, 'L');
    $this->fpdf->Cell(0, 0.5, substr($alamat_pemilik, 31), 0, 0, 'L');
    
} else {
    $this->fpdf->Cell(0, 0.5, $alamat_pemilik, 0, 0, 'L');
}
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(4, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Merk / Type", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, $datpil->merk, 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(4, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Jenis / Model", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(5, 0.5, $datpil->jenis, 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(4, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Tahun Pembuatan", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, $datpil->tahun, 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(4, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Nomor Kendaraan", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, $datpil->no_kendaraan, 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(4, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Nomor Rangka/NIK ", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, $datpil->no_chasis, 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(4, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "Nomor Mesin", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.3, $datpil->no_mesin, 0, 0, 'L');
$this->fpdf->ln(1.5);
//
$this->fpdf->Cell(3.5, 0.5, "Sifat Kendaraan  ", 0,0,'L');
$this->fpdf->Cell(0.5, 0.5, ": ", 0, 0, 'L');
$this->fpdf->SetFont('Arial', 'BI', 12);
 
 if(trim($datpil->sifat_lama)=='TIDAK UMUM') {
     $keterangan_awal = "( Plat dasar hitam tulisan huruf dan angka putih )";
     $lebar_sifat_awal = 2.8;  
 } else if(trim($datpil->sifat_lama)=='UMUM') {
     $keterangan_awal = "( Plat dasar kuning tulisan huruf dan angka hitam )";
     $lebar_sifat_awal = 1.7;  
 } else {
     $keterangan_awal = "( Plat dasar putih tulisan huruf dan angka merah )";
     $lebar_sifat_awal = 2.8;  
 }
 
  if(trim($datpil->sifat)=='TIDAK UMUM') {
     $keterangan = "( Plat dasar hitam tulisan huruf dan angka putih )";
     $lebar_sifat = 2.8;
 } else if(trim($datpil->sifat)=='UMUM') {
     $keterangan = "( Plat dasar kuning tulisan huruf dan angka hitam )";
     $lebar_sifat = 1.7;
 } else {
     $keterangan = "( Plat dasar putih tulisan huruf dan angka merah )";
     $lebar_sifat = 2.8;
 }
 
$this->fpdf->Cell($lebar_sifat_awal, 0.5, $datpil->sifat_lama, 0 , 0, 'L');
$this->fpdf->SetFont('Arial', '', 12);
$this->fpdf->Cell(0, 0.5,$keterangan_awal, 0 , 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(4, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(3.2, 0.5, "Dirubah menjadi ", 0 , 0, 'L');
$this->fpdf->SetFont('Arial', 'BI', 12);
$this->fpdf->Cell($lebar_sifat, 0.5, $datpil->sifat, 0 , 0, 'L');
$this->fpdf->SetFont('Arial', '', 12);
$this->fpdf->Cell(0, 0.5, $keterangan, 0 , 0, 'L');
$this->fpdf->ln(1);
//
$this->fpdf->Cell(9, 0.5, "  ", 0,0,'L');
$tanggal_dikeluarkan = date("Y-m-d");
$this->fpdf->Cell(0, 0.5, "Balikpapan, ".$date_manipulation->get_full_date($tanggal_dikeluarkan), 0 , 0, 'C');
$this->fpdf->ln(1);
$this->fpdf->Cell(9, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(0, 0.5, "KEPALA DINAS PERHUBUNGAN", 0 , 0, 'C');
$this->fpdf->ln();
$this->fpdf->Cell(9, 0.3, "  ", 0,0,'L');
$this->fpdf->Cell(0, 0.3, "KOTA BALIKPAPAN", 0 , 0, 'C');
$this->fpdf->ln(2);
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
$this->fpdf->SetFont('Arial', 'U', 12);
$this->fpdf->Cell(3, 0.3, "Tembusan Yth  ", 0,0,'L');
$this->fpdf->SetFont('Arial', '', 12);
$this->fpdf->ln(0.5);
$this->fpdf->Cell(1, 0.5, "1", 0,0,'L');
$this->fpdf->Cell(0, 0.5, "Dirlantas Polda Kaltim", 0 , 0, 'L');
$this->fpdf->ln();
$this->fpdf->Cell(1, 0.5, " ", 0,0,'L');
$this->fpdf->Cell(0, 0.5, "Up. Kasubdib Min Reg Ident di Balikpapan ", 0 , 0, 'L');


$this->fpdf->Output("Rubah Sifat.pdf", "I");
?>