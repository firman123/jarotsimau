<?php
$WIDTH = 21;
$HEIGHT = 29.7;
$this->load->library('fpdf');
$this->fpdf->__construct("P", "cm", array($WIDTH, $HEIGHT));
$this->fpdf->setMargins(1,1,1);
$this->fpdf->setAutoPageBreak(true);

$this->fpdf->AddPage();
$this->fpdf->SetFont('Arial', 'B', 16);
$this->fpdf->Line(1, 1, 20, 1);
$this->fpdf->Line(1, 1, 1, 28.7);
$this->fpdf->Line(1, 28.7, 20, 28.7);
$this->fpdf->Line(20, 1, 20, 28.7 );
$this->fpdf->Image(base_url().'aset/img/pancasila.png', $WIDTH / 2 - 1.5, 1.5, 3, 0);

$this->fpdf->ln(4);

$this->fpdf->Cell(19, 1, 'WALIKOTA BALIKPAPAN', 0, 0, 'C');
$this->fpdf->ln();
$this->fpdf->SetFont('Arial', '', 10);
$this->fpdf->Cell(18, 0.5, 'Kode Pos 76100', 0, 0, 'R');
$this->fpdf->SetLineWidth(0.1);
$this->fpdf->Line(1.2, 6.5, 19.8, 6.5);
$this->fpdf->SetLineWidth(0.03);
$this->fpdf->Line(1.2, 6.7, 19.8, 6.7);

$this->fpdf->ln(1);
$this->fpdf->SetFont('Arial', 'BU', 16);
$this->fpdf->Cell(19, 0.5, 'IZIN OPERASI TAKSI', 0, 0, 'C');
$this->fpdf->ln();
$this->fpdf->SetFont('Arial', '', 12);
$this->fpdf->Cell(19, 0.5, 'Nomor : 551.2.07/'.$data['id'].'/'.  date('Y'), 0, 0, 'C');

$this->fpdf->ln(1);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(4.5, 0.5, '1.   Memperhatikan', 0, 0);
$this->fpdf->Cell(17, 0.5, ': Surat Permohonan Izin Operasi Taksi dari  :', 0, 0, 'L');
$this->fpdf->ln(1);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(4.5, 0.5, '', 0, 0);
$this->fpdf->Cell(2.5, 0.5, 'Nama', 0, 0);
$this->fpdf->Cell(17, 0.5, ':   '.$data['nama_pimpinan'], 0, 0, 'L');
$this->fpdf->ln();
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(4.5, 0.5, '', 0, 0);
$this->fpdf->Cell(2.5, 0.5, 'Tanggal', 0, 0);
$this->fpdf->Cell(17, 0.5, ':   '.$date_manipulation->get_full_date($data['tanggal_input']), 0, 0, 'L');

$this->fpdf->ln(1);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(4.5, 0.5, '2.   Mengingat', 0, 0);
$this->fpdf->Cell(1, 0.5, ': 1.	', 0, 0);
$this->fpdf->MultiCell(12, 0.5, "Undang - Undang Nomor 22 Tahun 2009 tentang lalu Lintas Angkutan Jalan;", 0, 'J');
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(4.5, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '  2.	', 0, 0);
$this->fpdf->Cell(17, 0.5, 'Peraturan pemerintah Nomor 74 Tahun 2014 tentang Angkutan', 0, 0, 'L');
$this->fpdf->ln();
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(4.5, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '  3.	', 0, 0);
$this->fpdf->Cell(17, 0.5, 'Peraturan Pemerintah Nomor 55 Tahun 2012 tentang Kendaraan', 0, 0, 'L');
$this->fpdf->ln();
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(4.5, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '  4.	', 0, 0);
$this->fpdf->MultiCell(12, 0.5, 'Peraturan Daerah Kota Balikpapan Nomor 7 Tahun 2000 tentang Izin Angkutan Umum', 0, 'J');

$this->fpdf->ln();
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(17, 0.5, '3.   Memberikan Izin Operasi Taksi kepada :', 0, 0, 'L');
$this->fpdf->ln(1);
$this->fpdf->Cell(3, 0.5, '', 0, 0);
$this->fpdf->Cell(1.5, 0.5, '3.1', 0, 0);
$this->fpdf->Cell(4.5, 0.5, 'N a m a', 0, 0);
$this->fpdf->Cell(17, 0.5, ':    '.$data['nama_pimpinan'], 0, 0, 'L');
$this->fpdf->ln();
$this->fpdf->Cell(3, 0.5, '', 0, 0);
$this->fpdf->Cell(1.5, 0.5, '3.2', 0, 0);
$this->fpdf->Cell(4.5, 0.5, 'Jabatan/Kedudukan', 0, 0, 'L');
$this->fpdf->Cell(17, 0.5, ':    Direktur', 0, 0, 'L');
$this->fpdf->ln();
$this->fpdf->Cell(3, 0.5, '', 0, 0);
$this->fpdf->Cell(1.5, 0.5, '3.3', 0, 0);
$this->fpdf->Cell(4.5, 0.5, 'Alamat', 0, 0, 'L');
$this->fpdf->Cell(17, 0.5, ':    '.$data['alamat'], 0, 0, 'L');
$this->fpdf->ln();
$this->fpdf->Cell(3, 0.5, '', 0, 0);
$this->fpdf->Cell(1.5, 0.5, '3.4', 0, 0);
$this->fpdf->Cell(4.5, 0.5, 'Nama Badan Usaha', 0, 0, 'L');
$this->fpdf->Cell(17, 0.5, ':    '.$data['nama_perusahaan'], 0, 0, 'L');
$this->fpdf->ln();
$this->fpdf->Cell(3, 0.5, '', 0, 0);
$this->fpdf->Cell(1.5, 0.5, '3.5', 0, 0);
$this->fpdf->Cell(4.5, 0.5, 'Alamat Usaha', 0, 0, 'L');
$this->fpdf->Cell(17, 0.5, ':    '.$data['alamat_perusahaan'], 0, 0, 'L');
$this->fpdf->ln();
$this->fpdf->Cell(3, 0.5, '', 0, 0);
$this->fpdf->Cell(1.5, 0.5, '3.6', 0, 0);
$this->fpdf->Cell(4.5, 0.5, 'N P W P D', 0, 0, 'L');
$this->fpdf->Cell(17, 0.5, ':    '.$data['npwp'], 0, 0, 'L');
$this->fpdf->ln();
$this->fpdf->Cell(3, 0.5, '', 0, 0);
$this->fpdf->Cell(1.5, 0.5, '3.7', 0, 0);
$this->fpdf->Cell(4.5, 0.5, 'Wilayah Operasi', 0, 0, 'L');
$this->fpdf->Cell(17, 0.5, ':    Wilayah Dalam Kota Balikpapan', 0, 0, 'L');
$this->fpdf->ln(1);
$this->fpdf->Cell(1.7, 0.5, '', 0, 0);
$this->fpdf->MultiCell(17, 0.5, 'Untuk mengoperasikan taksi sebanyak '.$total_kendaraan.' unit, dengan jenis, merk, tahun pembuatan dan nomor kendaraan sebagaimana terlampir.', 0, 'J');

$this->fpdf->ln();
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(17, 0.5, '4.   Izin Operasi Taksi berlaku dari tanggal '.$date_manipulation->get_full_date($data['tanggal_input']).' s/d '.$date_manipulation->get_full_date($data['masa_berakhir']), 0, 0, 'L');
$this->fpdf->ln(1);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(0.7, 0.5, '5.', 0, 0, 'L');
$this->fpdf->MultiCell(15, 0.5, 'Ketentuan yang harus diperhatikan dan ditaati sebagaimana tersebut pada halaman belakang izin Operasi Taksi ini.', 0, 'J');
$this->fpdf->ln();
$this->fpdf->Cell(2, 0.5, '', 0, 0);
$this->fpdf->Cell(15, 0.5, 'Demikian Izin Operasi Taksi  ini dikeluarkan untuk dipergunakan sebagaimana mestinya.', 0, 0, 'L');

$this->fpdf->ln(1);
$this->fpdf->Cell(2, 0.5, '', 0, 0);
$this->fpdf->setFont('Arial', 'i');
$this->fpdf->Cell(10, 0.5, '', 0, 0);
$this->fpdf->Cell(7, 0.5, 'Balikpapan, '.$date_manipulation->get_full_date($data['tanggal_input']), 0, 0, 'C');
$this->fpdf->ln();
$this->fpdf->Cell(2, 0.5, '', 0, 0);
$this->fpdf->setFont('Arial', 'B');
$this->fpdf->Cell(10, 0.5, '', 0, 0);
$this->fpdf->Cell(7, 0.5, 'WALIKOTA BALIKPAPAN', 0, 0, 'C');
$this->fpdf->SetFont('Arial', 'BU');
$this->fpdf->ln(3);
$this->fpdf->Cell(12, 0.5, '', 0, 0);
$this->fpdf->Cell(7, 0.5, 'M. RIZAL EFFENDI', 0, 0, 'C');
$this->fpdf->SetFont('Arial', '');
$this->fpdf->ln(1.5);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->setFont('Arial', 'BU');
$this->fpdf->Cell(17, 0.5, 'KETENTUAN YANG HARUS DIPERHATIKAN', 0, 0, 'L');
$this->fpdf->setFont('Arial', '');
$this->fpdf->ln(1.5);

$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(17, 0.5, 'Pengusaha Angkutan Taksi yang telah mendapatkan Izin Operasi diwajibkan untuk :', 0, 0, 'L');
$this->fpdf->ln(1.5);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '1.', 0, 0);
$this->fpdf->Cell(17, 0.5, 'Mengoperasikan kendaraan yang memenuhi persyaratan teknis dan laik jalan.', 0, 0, 'L');
$this->fpdf->ln(1);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '2.', 0, 0);
$this->fpdf->MultiCell(16, 0.5, 'Awak kendaraan yang memenuhi persyaratan sesuai dengan ketentuan yang berlaku dan merupakan pengemudi tetap serta mematuhi waktu kerja dan waktu istirahat bagi pengemudi kecuali kendaraan taksi tanpa pengemudi.', 0, 'J');
$this->fpdf->ln(0.5);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '3.', 0, 0);
$this->fpdf->Cell(17, 0.5, 'Membawa kartu pengawasan dalam operasinya.', 0, 0, 'L');
$this->fpdf->ln(1);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '4.', 0, 0);
$this->fpdf->Cell(17, 0.5, 'Memberikan pelayanan yang sebaik-baiknya kepada penumpang yang diangkut.', 0, 0, 'L');
$this->fpdf->ln(1);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '5.', 0, 0);
$this->fpdf->MultiCell(15, 0.5, 'Melaporkan setiap bulan kegiatan operasional angkutan kepada Dinas Perhubungan Kota Balikpapan', 0,'J');
$this->fpdf->ln(0.5);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '6.', 0, 0);
$this->fpdf->Cell(15, 0.5, 'Menaikkan dan menurunkan penumpang di tempat-tempat yang telah ditentukan.', 0, 0, 'L');
$this->fpdf->ln(1);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '7.', 0, 0);
$this->fpdf->MultiCell(15, 0.5, 'Melaporkan apabila terjadi perubahan pemilikan perusahaan atau domisili perusahaan.', 0, 'J');
$this->fpdf->ln(0.5);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '8.', 0, 0);
$this->fpdf->MultiCell(15, 0.5, 'Meminta pengesahan dari Pejabat pemberi Izin Operasi apabila akan mengalihkan izin operasi.', 0, 'J');
$this->fpdf->ln(0.5);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '9.', 0, 0);
$this->fpdf->MultiCell(15, 0.5, 'Melaporkan secara tertulis kepada Pejabat pemberi Izin Operasi apabila terjadi perubahan alamat selambat-lambatnya 14 (empat belas) hari setelah terjadi perubahan.', 0, 'J');
$this->fpdf->ln(0.5);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '10.', 0, 0);
$this->fpdf->MultiCell(15, 0.5, 'Awak kendaraan wajib mengenakan pakaian seragam perusahaan dan tanda pengenal perusahaan.', 0, 'J');
$this->fpdf->ln(0.5);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '11', 0, 0);
$this->fpdf->MultiCell(15, 0.5, 'Mematuhi peraturan perundang-undangan yang berlaku yang berkaitan dengan bidang usaha angkutan.', 0, 'J');
$this->fpdf->ln(0.5);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '12', 0, 0);
$this->fpdf->Cell(17, 0.5, 'Mengoperasikan kendaraan angkutan taksi dengan menggunakan mobil penumpang.', 0, 0, 'L');
$this->fpdf->ln(1);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '13', 0, 0);
$this->fpdf->Cell(17, 0.5, 'Memberikan pelayanan angkutan dari pintu ke pintu.', 0, 0, 'L');
$this->fpdf->ln(1);
$this->fpdf->Cell(1, 0.5, '', 0, 0);
$this->fpdf->Cell(1, 0.5, '14', 0, 0);
$this->fpdf->MultiCell(15, 0.5, 'Menutup pertanggungan asuransi kecelakaan terhadap penumpang sesuai yang dimaksud dalam Undang-undang Nomor 33 Tahun 1964 Jo. Peraturan Pemerintah Nomor 17 tahun 1965.', 0, 'J');
$this->fpdf->ln(0.5);
$this->fpdf->Cell(10, 0.5, '', 0, 0);
$this->fpdf->Cell(7, 0.5, 'Menyatakan sanggup melaksanakan', 0, 1, 'C');
$this->fpdf->Cell(10, 0.5, '', 0, 0);
$this->fpdf->Cell(7, 0.5, 'ketentuan tersebut diatas', 0, 0, 'C');
$this->fpdf->ln(3);
$this->fpdf->SetFont('Arial', 'BU');
$this->fpdf->Cell(10, 0.5, '', 0, 0);
$this->fpdf->Cell(7, 0.5, 'Hj. TUNY BINTORO', 0, 1, 'C');
$this->fpdf->SetFont('Arial', '');
$this->fpdf->Cell(10, 0.5, '', 0, 0);
$this->fpdf->Cell(7, 0.5, 'Direktris', 0, 0, 'C');

   
   
   
   
   
   
   
   
   
     
        
        
        
        


$this->fpdf->Output('SuratIjin.pdf', 'I');

?>