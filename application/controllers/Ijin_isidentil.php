<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ijin_isidentil
 *
 * @author Ihtiyar
 */
class Ijin_isidentil extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        self::check_authority();
    }

    private function check_authority() {
        $this->com_user = $this->session->userdata('session_admin');
        if (!empty($this->com_user)) {
            $this->load->model('m_ijin_isidentil');
            $this->load->model('m_kuitansi');
            $this->load->library("datetimemanipulation");
            $this->load->library('fpdf');
        } else {
            redirect("admin/login");
        }
    }

    public function index() {
        $total_row = $this->m_ijin_isidentil->get_total_ijin();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('ijin_isidentil/index/p'));
        $a['data'] = $this->m_ijin_isidentil->get_ijin_isidentil_all($akhir, $awal);
        $a['page'] = "ijin_isidentil/list";

        $this->load->view('admin/dashboard', $a);
    }

    public function input() {
        $a['page'] = "ijin_isidentil/input";
        $this->load->view('admin/dashboard', $a);
    }

    public function cari_kendaraan() {
        $no_kendaraan = $this->input->post("no_kendaraan");
        $trim_nokendaraan = trim($no_kendaraan);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);

        $a['kendaraan'] = $this->m_ijin_isidentil->cari_kendaraan($rawl_nokendaraan);
//        if (empty($a['kendaraan'])) {
//
//            $this->session->set_flashdata("message_cari", "<div class=\"alert alert-error\" id=\"alert\">Data Tidak ditemukan</div>");
//        }

        $a['page'] = "ijin_isidentil/search_result";
        $this->load->view('admin/dashboard', $a);
    }

    public function act_add() {
        $data = array(
            "id_kendaraan" => $this->input->post("id_kendaraan"),
            "kota" => $this->input->post("kota"),
            "tanggal" => date("Y-m-d"),
            "verifikasi" => 0,
            "masa_berlaku" => $this->input->post("masa_berlaku")
        );
        if ($this->m_ijin_isidentil->insert($data)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
        }

        $a['page'] = "ijin_isidentil/input";
        $this->load->view('admin/dashboard', $a);
    }

    public function act_delete($id_ijin) {
        if ($this->m_ijin_isidentil->delete($id_ijin)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed </div>");
        }

        redirect('ijin_isidentil/index');
    }

    public function print_kwitansi($id) {
        ob_start();

        $rawlId = rawurldecode($id);
        $SQL = "SELECT a.*, b.* from tbl_kendaraan a left "
                . "join tbl_perusahaan b ON a.id_perusahaan = b.id "
                . "JOIN tbl_ijin_isidentil c on a.id_kendaraan = c.id_kendaraan "
                . "WHERE c.id_ijin = '$rawlId'";

        $a['datpil'] = $this->db->query($SQL)->row();

        $a['tanggal_cetak'] = date("Y-m-d");
        $a['date_manipulation'] = $this->datetimemanipulation;
        $a['detail_kuitansi'] = $this->m_kuitansi->get_detail_kuitansi(5);

        $this->load->view('admin/cetak/kwitansi/ijin_isidentil/print', $a);
        $html = ob_get_contents();
        ob_end_clean();

        require_once('./aset/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P', 'A4', 'en');
        $pdf->WriteHTML($html);
        ob_end_clean();
        $pdf->Output('kwitansi Ijin Isidentil.pdf', 'D');
    }

    public function cetak_surat_ijin() {
        $id_ijin = $this->uri->segment(3);
        $verifikasi = $this->uri->segment(4);

        if ($verifikasi == 0) {
            print "<script type=\"text/javascript\">window.location.href = '" . base_url() . "index.php/Ijin_isidentil';;alert('Gagal Cetak! Ijin Isidentil Belum Diverifikasi!');</script>";
        } else {
            $a['detail'] = $this->m_ijin_isidentil->get_detail_verifikasi($id_ijin);
            $a['date_manipulation'] = $this->datetimemanipulation;
            define('FPDF_FONTPATH', $this->config->item('fonts_path'));
            $this->load->view('admin/cetak/laporan_ijin_insidentil/print.php', $a);
        }
    }

}
