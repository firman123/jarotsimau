<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pemeriksaan
 *
 * @author Ihtiyar
 */
class Pemeriksaan extends CI_Controller {

    protected $com_user;

    //put your code here

    public function __construct() {
        parent::__construct();
        self::check_authority();

        $this->load->library('fpdf');
        $this->load->library("datetimemanipulation");
        $this->load->library('ciqrcode');
    }

    private function check_authority() {
        $this->com_user = $this->session->userdata('session_admin');
        if (!empty($this->com_user)) {
            $this->load->model('m_pemeriksaan');
            $this->load->model('m_kuitansi');
        } else {
            redirect("admin/login");
        }
    }

    public function index_trayek() {
        $tanggal = date('Y-m-d');
        $total_row = $this->m_pemeriksaan->get_total_pemeriksaan("trayek", $tanggal);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('pemeriksaan/index_trayek/p'));
        $a['path'] = "trayek";
        $a['sub_title'] = 'Angkutan Barang';
        $a['data'] = $this->m_pemeriksaan->get_pemeriksaan_all("trayek", $akhir, $awal, $tanggal);
        $a['page'] = "pemeriksaan/list";

        $this->load->view('admin/dashboard', $a);
    }

    public function index_operasi() {
        $tanggal = date('Y-m-d');
        $total_row = $this->m_pemeriksaan->get_total_pemeriksaan("operasi", $tanggal);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('pemeriksaan/index_operasi/p'));
        $a['path'] = "operasi";
        $a['sub_title'] = 'Angkutan Barang';
        $a['data'] = $this->m_pemeriksaan->get_pemeriksaan_all("operasi", $akhir, $awal, $tanggal);
        $a['page'] = "pemeriksaan/list";

        $this->load->view('admin/dashboard', $a);
    }

    public function input($path) {
        $a['path'] = $path;
        $a['page'] = "pemeriksaan/input";
        $this->load->view('admin/dashboard', $a);
    }

    public function cari_kendaraan($jenis) {
        $no_kendaraan = $this->input->post("no_kendaraan");
        $trim_nokendaraan = trim($no_kendaraan);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);

//        $SQL = "SELECT A.*, A.tgl_mati_uji as berlaku_kp,  B.*, C.*, D.* "
//                . " FROM tbl_kendaraan A LEFT JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
//                . "  LEFT JOIN tb_note_kendaraan C ON a.no_uji=c.id_kendaraan"
//                . " LEFT JOIN tbl_trayek D ON A.id_trayek = D.id_trayek  WHERE ";

        $SQL = "SELECT A.*, A.id_kendaraan as kendaraan_id, A.tgl_mati_uji as berlaku_kp,  B.*, C.*, D.* "
                . " FROM tbl_kendaraan A LEFT JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                . "  LEFT JOIN tb_note_kendaraan C ON a.no_uji=c.id_kendaraan"
                . " LEFT JOIN tbl_trayek D ON A.id_trayek = D.id_trayek "
                . " LEFT JOIN tbl_riwayat E on A.id_kendaraan = E.id_kendaraan WHERE ";

        $SQL_TANGGAL = "SELECT A.masa_berakhir as masa_berlaku_ijin_trayek, B.masa_berlaku as masa_berlaku_kp ";
        if ($jenis == 'trayek') {
            $SQL.= " A.kp_ijin_trayek != '' ";
            $SQL_TANGGAL .= "FROM tbl_ijin_trayek A ";
        } else {
            $SQL.= " A.kp_ijin_operasi != '' ";
             $SQL_TANGGAL .= "FROM tbl_ijin_operasi A ";
        }
        $SQL.= " AND A.no_kendaraan = '$rawl_nokendaraan'  ORDER BY E.tgl_uji DESC LIMIT 1";
        $SQL_TANGGAL.= " LEFT JOIN tbl_perusahaan C on C.id = A.id_perusahaan "
                        . " LEFT JOIN tbl_kendaraan D on D.id_perusahaan= C.id "
                        . " LEFT JOIN tbl_pemeriksaan B on B.id_kendaraan = D.no_uji "
                        . " WHERE D.no_kendaraan = '$rawl_nokendaraan' ORDER BY B.id_pemeriksaan DESC LIMIT 1 ";
        
        $a['kendaraan'] = $this->db->query($SQL)->row_array();
        $a['tanggal_pemeriksaan'] = $this->db->query($SQL_TANGGAL)->row_array();
        if (empty($a['kendaraan'])) {

            $this->session->set_flashdata("message_cari", "<div class=\"alert alert-error\" id=\"alert\">Data Tidak ditemukan</div>");
        }

        $a['path'] = $jenis;
        $a['page'] = "pemeriksaan/search_result";
        $this->load->view('admin/dashboard', $a);
    }

    public function act_add() {
        $jenis = $this->input->post("jenis");
        $no_nota = $this->m_pemeriksaan->no_kwitansi();
        $id_kp = $this->input->post("no_kp");
        $id_kendaraan = $this->input->post("id_kendaraan");
        $data = array(
            "id_kendaraan" => $this->input->post("no_uji"),
            "tanggal" => date("Y-m-d"),
            "jenis" => $jenis,
            "masa_berlaku" => $this->input->post("masa_berlaku_kp")
        );
        
        if ($jenis == 'Trayek') {
            $this->insert_kwitansi($id_kp, $id_kendaraan, 1);
        } else {
            $this->insert_kwitansi($id_kp, $id_kendaraan, 2);
        }
        

//        $tgl_berlaku = $this->input->post('masa_berlaku_ijin_trayek');
//        $new_thn = strtotime($tgl_berlaku);
//        $thn = substr($tgl_berlaku, 0, 4);
//        $bln = date("m", $new_thn) + 6;
//        $day = substr($tgl_berlaku, 8, 2);
//        $bln = $bln + 6;
//        if ($bln > 12) {
//            $bln = $bln - 12;
//            if ($bln < 10) {
//                $bln =
//            }
//            $thn = $thn + 1;
//        }
//        print_r($tgl_berlaku);
//        if (!empty($tgl_berlaku)) {
//            $data['masa_berlaku'] = $this->input->post('masa_berlaku_ijin_trayek');
//        }
        
        if ($this->m_pemeriksaan->insert($data)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
        }

        if ($jenis == 'Trayek') {
            $a['path'] = 'trayek';
        } else {
            $a['path'] = 'operasi';
        }
        $a['page'] = "pemeriksaan/input";
        $this->load->view('admin/dashboard', $a);
    }

    
    public function insert_kwitansi($idKp, $id_kendaraan, $idBiaya) {
        $data_kuitansi = $this->m_kuitansi->cek_kuitansi_available($idKp);
        if (empty($data_kuitansi)) {
            $admin_id = $this->com_user['admin_id'];

            $no_nota = $this->m_pemeriksaan->no_kwitansi();
            $data = array(
                "kp_ijin" => $idKp,
                "tanggal" => date("Y-m-d"),
                "id_admin" => $admin_id,
                "id_kwitansi" => $no_nota,
                "id_kendaraan" => $id_kendaraan,
                "id_biaya_kwitansi" => $idBiaya
            );

            $save_kuitansi = $this->m_kuitansi->insertCetak($data);
        }
    }

    public function input_checklist($jenis) {
        $tanggal = date('Y-m-d');
        $total_row = $this->m_pemeriksaan->get_total_checklist_pemeriksaan($jenis, $tanggal);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['date_manipulation'] = $this->datetimemanipulation;
        $a['path'] = $jenis;
        $a['pagi'] = _page($total_row, $per_page, 4, site_url('pemeriksaan/input_checklist/p'));
        $a['data'] = $this->m_pemeriksaan->get_checklist_pemeriksaan($jenis, $akhir, $awal, $tanggal);
        $a['page'] = "pemeriksaan/input_checklist";
        $this->load->view('admin/dashboard', $a);
    }

    public function act_add_checklist($jenis) {
        $data = array(
            "id_pemeriksaan" => $this->input->post("id_pemeriksaan"),
            "pakaian" => $this->input->post("pakaian"),
            "nm_perusahaan_kd_trayek" => $this->input->post("nm_perusahaan_kd_trayek"),
            "jenis_layanan" => $this->input->post("jenis_layanan"),
            "lambang_perusahaan" => $this->input->post("lambang_perusahaan"),
            "papan_trayek" => $this->input->post("papan_trayek"),
            "moto_kota" => $this->input->post("moto_kota"),
            "warna_kendaraan" => $this->input->post("warna_kendaraan"),
            "safetybelt" => $this->input->post("safetybelt"),
            "segitiga_pengaman" => $this->input->post("segitiga_pengaman"),
            "ban_serep" => $this->input->post("ban_serep"),
            "lampu_angkot" => $this->input->post("lampu_angkot"),
            "kotak_obat" => $this->input->post("kotak_obat"),
            "kotak_sampah" => $this->input->post("kotak_sampah"),
            "retribusi_parkir" => $this->input->post("retribusi_parkir"),
            "daftar_tarif" => $this->input->post("daftar_tarif"),
            "ck_no_kendaraan" => $this->input->post("no_kendaraan"),
            "ck_no_mesin" => $this->input->post("no_mesin"),
            "ck_no_rangka" => $this->input->post("no_rangka"),
            "tanggal_pemeriksaan" => date("Y-m-d"),
            "argometer" => $this->input->post("argometer"),
            "kartu_identitas" => $this->input->post("kartu_identitas")
        );

        $id_pemeriksaan = $this->input->post("id_pemeriksaan");
        $this->m_pemeriksaan->delete_hasil_pemeriksaan_by_id_pemeriksaan($id_pemeriksaan);

        if ($this->m_pemeriksaan->insert_checklist($data)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
        }

        redirect('pemeriksaan/input_checklist/' . $jenis);
    }

    public function act_delete_trayek($id_pemeriksaan) {
        if ($this->m_pemeriksaan->delete($id_pemeriksaan)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed </div>");
        }

        redirect('pemeriksaan/index_trayek');
    }

    public function act_delete_operasi($id_pemeriksaan) {
        if ($this->m_pemeriksaan->delete($id_pemeriksaan)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed </div>");
        }

        redirect('pemeriksaan/index_operasi');
    }

    public function cetak_kp_operasi() {
        $qr['data'] = '98989';

        $qr['level'] = 'H';
        $qr['size'] = 10;
        $qr['savename'] = FCPATH . 'qr.png';
        $this->ciqrcode->generate($qr);

        $this->load->view('admin/cetak/kp/kp_trayek.php');
    }

    public function cetak_stiker() {

        $qr['data'] = '98989';

        $qr['level'] = 'H';
        $qr['size'] = 10;
        $qr['savename'] = FCPATH . 'qr.png';
        $this->ciqrcode->generate($qr);


//        echo '<img src="' . base_url() . 'qr.png" />';
        $this->load->view('admin/cetak/stiker/print.php');
    }

    function cetak_laporan_harian() {
        $date = date("Y-m-d");
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $a['data'] = $this->m_pemeriksaan->get_data_laporan($date);
//        $a['total_kendaraan'] = $this->m_ijin_operasi->get_total_kendaraan_trayek($id);
//        $a['data_kendaraan'] = $this->m_ijin_operasi->get_all_kendaraan_by_id_perusahaan_trayek($id);
        $a['date_manipulation'] = $this->datetimemanipulation;
        $this->load->view('admin/cetak/laporan_pengujian/print.php', $a);
    }

    function cetak_laporan_layanan() {
        $date = date("Y-m-d");
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $a['data'] = $this->m_pemeriksaan->get_data_laporan($date);
//        $a['total_kendaraan'] = $this->m_ijin_operasi->get_total_kendaraan_trayek($id);
//        $a['data_kendaraan'] = $this->m_ijin_operasi->get_all_kendaraan_by_id_perusahaan_trayek($id);
        $a['date_manipulation'] = $this->datetimemanipulation;
        $this->load->view('admin/cetak/laporan_layanan/print.php', $a);
    }

    function cetak_laporan_angkutan() {
        $date = date("Y-m-d");
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $a['data'] = $this->m_pemeriksaan->get_data_laporan($date);
//        $a['total_kendaraan'] = $this->m_ijin_operasi->get_total_kendaraan_trayek($id);
//        $a['data_kendaraan'] = $this->m_ijin_operasi->get_all_kendaraan_by_id_perusahaan_trayek($id);
        $a['date_manipulation'] = $this->datetimemanipulation;
        $this->load->view('admin/cetak/laporan_jml_angkot/print.php', $a);
    }

}
