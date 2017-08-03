<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Hasil_pemeriksaan extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_user') == "") {
            redirect("admin/login");
        }

        $this->load->model('m_pemeriksaan');

        $this->load->library('ciqrcode');
        $this->load->library("datetimemanipulation");
        $this->load->library('fpdf');
    }

    public function index() {
        $total_row = $this->m_pemeriksaan->get_total_hasil_pemeriksaan(NULL);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['date_manipulation'] = $this->datetimemanipulation;
        $a['pagi'] = _page($total_row, $per_page, 4, site_url('hasil_pemeriksaan/index_trayek/p'));
        $a['path'] = "trayek";
        $a['data'] = $this->m_pemeriksaan->get_hasil_pemeriksaan_all(NULL, $akhir, $awal);
        $a['page'] = "hasil_pemeriksaan/list";

        $this->load->view('admin/dashboard', $a);
    }

    public function index_trayek() {
        $total_row = $this->m_pemeriksaan->get_total_hasil_pemeriksaan("trayek");
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['date_manipulation'] = $this->datetimemanipulation;
        $a['pagi'] = _page($total_row, $per_page, 4, site_url('hasil_pemeriksaan/index_trayek/p'));
        $a['path'] = "trayek";
        $a['data'] = $this->m_pemeriksaan->get_hasil_pemeriksaan_all("trayek", $akhir, $awal);
        $a['page'] = "hasil_pemeriksaan/list_siap_cetak";

        $this->load->view('admin/dashboard', $a);
    }

    public function index_operasi() {
        $total_row = $this->m_pemeriksaan->get_total_hasil_pemeriksaan("operasi");
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['date_manipulation'] = $this->datetimemanipulation;
        $a['pagi'] = _page($total_row, $per_page, 4, site_url('hasil_pemeriksaan/index_operasi/p'));
        $a['path'] = "operasi";
        $a['data'] = $this->m_pemeriksaan->get_hasil_pemeriksaan_all("operasi", $akhir, $awal);
        $a['page'] = "hasil_pemeriksaan/list_siap_cetak";

        $this->load->view('admin/dashboard', $a);
    }

    public function view_trayek($id) {
        $a['pemeriksaan'] = $this->m_pemeriksaan->get_detail_hasil_pemeriksaan($id);
        $a['page'] = "hasil_pemeriksaan/view";
        $a['path'] = 'trayek';
        $this->load->view('admin/dashboard', $a);
    }

    public function view_operasi($id) {
        $a['pemeriksaan'] = $this->m_pemeriksaan->get_detail_hasil_pemeriksaan($id);
        $a['page'] = "hasil_pemeriksaan/view";
        $a['path'] = 'operasi';
        $this->load->view('admin/dashboard', $a);
    }

    public function del_trayek($id_pemeriksaan) {
        if ($this->m_pemeriksaan->delete_hasil_pemeriksaan($id_pemeriksaan)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed </div>");
        }

        redirect('hasil_pemeriksaan/index_trayek');
    }

    public function del_operasi($id_pemeriksaan) {
        if ($this->m_pemeriksaan->delete_hasil_pemeriksaan($id_pemeriksaan)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed </div>");
        }

        redirect('hasil_pemeriksaan/index_operasi');
    }

    public function view_print_trayek($id) {
        $a['id_pemeriksaan'] = $id;
        $a['page'] = "hasil_pemeriksaan/view_print";
        $a['path'] = 'trayek';
        $this->load->view('admin/dashboard', $a);
    }

    public function view_print_operasi($id) {
        $a['id_pemeriksaan'] = $id;
        $a['page'] = "hasil_pemeriksaan/view_print";
        $a['path'] = 'operasi';
        $this->load->view('admin/dashboard', $a);
    }

    public function print_kwitansi_trayek($id) {
        ob_start();

        $SQL = "SELECT b.* FROM tbl_checklist_kendaraan c "
                . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                . " WHERE c.id_checklist = $id";

        $a['datpil'] = $this->db->query($SQL)->row();
        $a['tanggal_cetak'] = date("Y-m-d");
        $a['date_manipulation'] = $this->datetimemanipulation;

        $this->load->view('admin/cetak/kwitansi/kartu_pengawasan_trayek/print', $a);
        $html = ob_get_contents();
        ob_end_clean();

        require_once('./aset/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P', 'A4', 'en');
        $pdf->WriteHTML($html);
        $pdf->Output('kwitansi KP Trayek.pdf', 'FI');
    }

    public function print_kwitansi_operasi($id) {
        ob_start();

        $SQL = "SELECT b.* FROM tbl_checklist_kendaraan c "
                . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                . " WHERE c.id_checklist = $id";

        $a['datpil'] = $this->db->query($SQL)->row();
        $a['tanggal_cetak'] = date("Y-m-d");
        $a['date_manipulation'] = $this->datetimemanipulation;

        $this->load->view('admin/cetak/kwitansi/kartu_pengawasan_operasi/print', $a);
        $html = ob_get_contents();
        ob_end_clean();

        require_once('./aset/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P', 'A4', 'en');
        $pdf->WriteHTML($html);
        $pdf->Output('kwitansi KP Operasi.pdf', 'FI');
    }

    public function print_kp_operasi($id) {
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $SQL = "SELECT a.*, b.*, e.* FROM tbl_checklist_kendaraan c "
                . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                . " LEFT JOIN tbl_trayek e ON a.id_trayek = e.id_trayek "
                . " WHERE c.id_checklist = $id";
        $a['datpil'] = $this->db->query($SQL)->row();
        $a['path'] = "operasi";

        $data_qr = "http://integratesystem.id/display/info_smartcard.php?no_uji=" . $a['datpil']->no_uji;
        $qr['data'] = $data_qr;
        $qr['level'] = 'H';
        $qr['size'] = 10;
        $qr['savename'] = FCPATH . 'qr.png';
        $this->ciqrcode->generate($qr);

        $this->load->view('admin/cetak/kp/kp_operasi_v2', $a);
    }

    public function print_kp_trayek($id) {
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $SQL = "SELECT a.*, b.*, e.* FROM tbl_checklist_kendaraan c "
                . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                . " LEFT JOIN tbl_trayek e ON a.id_trayek = e.id_trayek "
                . " WHERE c.id_checklist = $id";
        $a['datpil'] = $this->db->query($SQL)->row();
        $a['path'] = "trayek";

        $data_qr = "http://integratesystem.id/display/info_smartcard.php?no_uji=" . $a['datpil']->no_uji;
        $qr['data'] = $data_qr;
        $qr['level'] = 'H';
        $qr['size'] = 10;
        $qr['savename'] = FCPATH . 'qr.png';
        $this->ciqrcode->generate($qr);

        $this->load->view('admin/cetak/kp/kp_trayek_v2', $a);
    }

    public function cetak_stiker_trayek($id) {

        $SQL = "SELECT a.*, d.masa_berlaku as masa_berlaku_kp, b.*, e.* FROM tbl_checklist_kendaraan c "
                . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                . " JOIN tbl_trayek e ON a.id_trayek = e.id_trayek "
                . " WHERE c.id_checklist = $id";
        $a['datpil'] = $this->db->query($SQL)->row();
        $a['date_manipulation'] = $this->datetimemanipulation;

        $data_qr = "http://integratesystem.id/display/info_stiker.php?no_uji=" . $a['datpil']->no_uji;
        $qr['data'] = $data_qr;
        $qr['level'] = 'H';
        $qr['size'] = 10;
        $qr['savename'] = FCPATH . 'qr.png';
        $this->ciqrcode->generate($qr);


//        echo '<img src="' . base_url() . 'qr.png" />';
        $this->load->view('admin/cetak/stiker/print.php', $a);
    }

    public function cetak_stiker_operasi($id) {

        $SQL = "SELECT a.*, d.masa_berlaku as masa_berlaku_kp, b.* FROM tbl_checklist_kendaraan c "
                . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                . " WHERE c.id_checklist = $id";
        $a['datpil'] = $this->db->query($SQL)->row();
        $a['date_manipulation'] = $this->datetimemanipulation;

        $data_qr = "http://integratesystem.id/display/info_stiker.php?no_uji=" . $a['datpil']->no_uji;
        $qr['data'] = $data_qr;
        $qr['level'] = 'H';
        $qr['size'] = 10;
        $qr['savename'] = FCPATH . 'qr.png';
        $this->ciqrcode->generate($qr);


//        echo '<img src="' . base_url() . 'qr.png" />';
        $this->load->view('admin/cetak/stiker/print_operasi.php', $a);
    }

    public function update_verifikasi() {
        $data = array(
            "status_verifikasi" => $this->input->post("verifikasi")
        );

        $save_data = $this->m_pemeriksaan->update_checklist($data, $this->input->post("id_pemeriksaan"));
        if ($save_data) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil diverifikasi. </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data gagal diverifikasi. </div>");
        }

        redirect('hasil_pemeriksaan/index');
    }

}
