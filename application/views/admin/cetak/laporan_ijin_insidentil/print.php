<?php

$this->load->library('fpdf');
$this->fpdf->__construct("P", "cm", array(21.6, 33));
$this->fpdf->SetMargins(2, 1, 2);
$this->fpdf->setAutoPageBreak(false);

$this->fpdf->AddPage();
$this->fpdf->Image(base_url() . 'aset/img/logo_balikpapan.png', 1, 1, 2.5, 3);
$this->fpdf->SetFont('Arial', 'B', 16);
//$this->fpdf->SetLeftMargin(3);
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

$this->fpdf->SetFont('Arial', 'UB', 16);
$this->fpdf->Cell(0, 0.8, "", 0, 0, 'C');
$this->fpdf->ln();
$this->fpdf->Cell(0, 0.5, "IZIN ISIDENTIL", 0, 0, 'C');
$this->fpdf->ln();
$this->fpdf->SetFont('Arial', '', 12);
$this->fpdf->Cell(0, 0.5, "Nomor : 551.21/07/".$detail['id_ijin']."/".date('Y'), 0, 0, 'C');

$this->fpdf->SetLeftMargin(1.5);
$this->fpdf->ln(1.5);
$this->fpdf->Cell(3.5, 0.5, "1. Dasar  ", 0,0,'L');
$this->fpdf->Cell(0.5, 0.5, ": ", 0, 0, 'L');
$this->fpdf->MultiCell(0, 0.5, "Keputusan Walikota Balikpapan Nomor : 188.45 - 167 / 2000 tanggal 14 "
        . "September 2000 Tentang Pelimpahan Wewenang Mengeluarkan Atau Menerbitkan, "
        . "Menandatangani Kartu Pengawasan Izin Operasi dan Izin Isidentil Kepada Dinas Perhubungan Kota Balikpapan", 0,'J', false);
$this->fpdf->ln(0.5);
$this->fpdf->Cell(3.5, 0.5, "2. Memperhatikan  ", 0,0,'L');
$this->fpdf->Cell(0.5, 0.5, ": ", 0, 0, 'L');
$this->fpdf->Cell(0.5, 0.5, "a. ", 0, 0, 'L');
$this->fpdf->MultiCell(0, 0.5, "Peraturan Daerah Kota Balikpapan Nomor 7 Tahun 2000 tentang Izin Angkutan Umum", 0 ,'J', false);
$this->fpdf->Cell(3.5, 0.5, "", 0,0,'L');
$this->fpdf->Cell(0.5, 0.5, "", 0, 0, 'L');
$this->fpdf->Cell(0.5, 0.5, "b. ", 0, 0, 'L');
$this->fpdf->MultiCell(0, 0.5, "Peraturan Daerah Kota Balikpapan Nomor 11 Tahun 2000 tentang Retribusi Izin Angkutan Umum", 0 ,'J', false);
$this->fpdf->Cell(3.5, 0.5, "", 0,0,'L');
$this->fpdf->Cell(0.5, 0.5, "", 0, 0, 'L');
$this->fpdf->Cell(0.5, 0.5, "c. ", 0, 0, 'L');
$tanggal_dikeluarkan = date("Y-m-d");
$this->fpdf->MultiCell(0, 0.5, "Permohonan Tanggal " . $date_manipulation->get_full_date($tanggal_dikeluarkan), 0 ,'J', false);
$this->fpdf->ln(0.5);

$this->fpdf->Cell(3.5, 0.5, "3. Memberikan Izin Isidentil kepada  :", 0,1,'L');
$this->fpdf->ln(0.5);
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "1. Nama Pemilik", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, $detail['nama_pemilik'], 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "2. Alamat", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'R');
$alamat_pemilik = trim($detail['alamat_perusahaan']);
if (strlen($alamat_pemilik) > 30) {
    $this->fpdf->MultiCell(0, 0.5, $alamat_pemilik , 0, 'J');
    $this->fpdf->ln(0.8);
} else {
    $this->fpdf->Cell(0, 0.5, $alamat_pemilik, 0, 0, 'L');
}
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "3. Jenis Kendaraan", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(5, 0.5,"Penumpang", 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "4. Nomor Kendaraan", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5, trim($detail['no_kendaraan']), 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "5. Tujuan ", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.5,trim($detail['kota_tujuan']), 0, 0, 'L');
$this->fpdf->ln(0.8);
//
$this->fpdf->Cell(2, 0.5, "  ", 0,0,'L');
$this->fpdf->Cell(6, 0.5, "6. Masa Berlaku Izin", 0 , 0, 'L');
$this->fpdf->Cell(0.5, 0.5 , ": ", 0, 0, 'L');
$this->fpdf->Cell(0, 0.3,$date_manipulation->get_full_date($detail['berlaku_tanggal']), 0, 0, 'L');
$this->fpdf->ln(1.5);
//
$this->fpdf->Cell(3.5, 0.5, "4. Perhatian  ", 0,1,'L');
//

$this->fpdf->SetFont('Arial', '', 12);
$this->fpdf->SetLeftMargin(3);
$this->fpdf->Cell(3.5, 0.5, "1. Izin ini berlaku untuk 1(satu) kali perjalanan pergi pulang (PP)", 0,1,'L');
$this->fpdf->Cell(3.5, 0.5, "2. Izin Isidentil diberikan dengan ketentuan :", 0,1,'L');
$this->fpdf->SetLeftMargin(3.5);
$this->fpdf->Cell(1, 0.5, "a. ", 0, 0, 'L');
$this->fpdf->Cell(3.5, 0.5, "Dilarang mengangkut penumpang selain dari maksut diatas", 0,1,'L');
$this->fpdf->Cell(1, 0.5, "b. ", 0, 0, 'L');
$this->fpdf->MultiCell(0, 0.5, "Izin Isidentil harus dikembalikan kepada Dinas Perhubungan Kota Balikpapan setelah selesai dipergunakan", 0, 'J');
$this->fpdf->ln(2);
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