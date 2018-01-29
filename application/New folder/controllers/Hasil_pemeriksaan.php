<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Hasil_pemeriksaan extends CI_Controller {

    protected $com_user;
    private $param_data;

    public function __construct() {
        parent::__construct();
        self::check_authority();

        $this->load->library('ciqrcode');
        $this->load->library("datetimemanipulation");
        $this->load->library('fpdf');
    }

    private function check_authority() {
        $this->com_user = $this->session->userdata('session_admin');
        if (!empty($this->com_user)) {
            $this->load->model('m_pemeriksaan');
            $this->load->model('m_kuitansi');
            $this->load->model('m_kendaraan');
            $this->load->model('m_cetak_ulang');
        } else {
            redirect("admin/login");
        }
    }

    public function index() {
        $this->rubah_sifat_penumpang();

        $this->cetak_ulang();

        $total_row = $this->m_pemeriksaan->get_total_hasil_pemeriksaan("trayek", NULL);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $this->param_data['date_manipulation'] = $this->datetimemanipulation;
        $this->param_data['pagi'] = _page($total_row, $per_page, 4, site_url('hasil_pemeriksaan/index/p'));
        $this->param_data['path'] = "trayek";
        $this->param_data['data'] = $this->m_pemeriksaan->get_hasil_pemeriksaan_all("trayek", $akhir, $awal, NULL);
        $this->param_data['page'] = "hasil_pemeriksaan/list";

        $this->load->view('admin/dashboard', $this->param_data);

//        $this->rubah_sifat_penumpang();
    }

    public function rubah_sifat_penumpang() {
//        $mode = $this->uri->segment(3);
        $jenis = 'Penumpang';
        $total_row = $this->m_kendaraan->total_kendaraan_rubah_sifat($jenis);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $this->param_data['pagi2'] = _page($total_row, $per_page, 4, site_url('hasil_pemeriksaan/index/p'));
        $this->param_data['data_sifat_penumpang'] = $this->m_kendaraan->get_all_kendaraan_rubah_sifat($akhir, $awal, $jenis);
//        print_r($this->param_data['data_sifat_penumpang']);
        $this->param_data['jenis'] = $jenis;
        $this->param_data['page2'] = "hasil_pemeriksaan/list_rubahsifat_penumpang";
    }

    public function cetak_ulang() {
        $total_row = $this->m_cetak_ulang->get_total_cetak_ulang(0);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $this->param_data['pagi_cetak_ulang'] = _page($total_row, $per_page, 4, site_url('hasil_pemeriksaan/index/p'));
        $this->param_data['data_cetak_ulang'] = $this->m_cetak_ulang->get_cetak_ulang_all(0, $akhir, $awal);
//        print_r($this->param_data['data_cetak_ulang']);
        $this->param_data['page3'] = "hasil_pemeriksaan/list_cetak_ulang";
    }

    public function index_trayek() {
        $total_row = $this->m_pemeriksaan->get_total_hasil_pemeriksaan("trayek", NULL);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['date_manipulation'] = $this->datetimemanipulation;
        $a['pagi'] = _page($total_row, $per_page, 4, site_url('hasil_pemeriksaan/index_trayek/p'));
        $a['path'] = "trayek";
        $a['data'] = $this->m_pemeriksaan->get_hasil_pemeriksaan_all("trayek", $akhir, $awal, NULL);
        $a['page'] = "hasil_pemeriksaan/list_siap_cetak";

        $this->load->view('admin/dashboard', $a);
    }

    public function index_operasi() {
        $total_row = $this->m_pemeriksaan->get_total_hasil_pemeriksaan("operasi", NULL);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['date_manipulation'] = $this->datetimemanipulation;
        $a['pagi'] = _page($total_row, $per_page, 4, site_url('hasil_pemeriksaan/index_operasi/p'));
        $a['path'] = "operasi";
        $a['data'] = $this->m_pemeriksaan->get_hasil_pemeriksaan_all("operasi", $akhir, $awal, NULL);
        $a['page'] = "hasil_pemeriksaan/list_siap_cetak";

        $this->load->view('admin/dashboard', $a);
    }

    public function cari_kendaraan_by_tanggal() {
        $tanggal = $this->input->post('tanggal');
        $path = $this->input->post('path');

        $this->session->set_userdata('tanggal_session', $tanggal);
        $this->session->set_userdata('path_session', $path);

        $total_row = $this->m_pemeriksaan->get_total_hasil_pemeriksaan($this->session->userdata('path_session'), $this->session->userdata('tanggal_session'));
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['date_manipulation'] = $this->datetimemanipulation;
        $a['pagi'] = _page($total_row, $per_page, 4, site_url('hasil_pemeriksaan/cari_kendaraan_by_tanggal_pagi/p'));
        $a['path'] = $this->session->userdata('path_session');
        $a['sub_title'] = 'Angkutan Barang';
        $a['data'] = $this->m_pemeriksaan->get_hasil_pemeriksaan_all($this->session->userdata('path_session'), $akhir, $awal, $this->session->userdata('tanggal_session'));
        $a['page'] = "hasil_pemeriksaan/list_siap_cetak";

        $this->load->view('admin/dashboard', $a);
    }

    public function cari_kendaraan_by_tanggal_pagi() {
        $total_row = $this->m_pemeriksaan->get_total_hasil_pemeriksaan($this->session->userdata('path_session'), $this->session->userdata('tanggal_session'));
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['date_manipulation'] = $this->datetimemanipulation;
        $a['pagi'] = _page($total_row, $per_page, 4, site_url('hasil_pemeriksaan/cari_kendaraan_by_tanggal_pagi/p'));
        $a['path'] = $this->session->userdata('path_session');
        $a['sub_title'] = 'Angkutan Barang';
        $a['data'] = $this->m_pemeriksaan->get_hasil_pemeriksaan_all($this->session->userdata('path_session'), $akhir, $awal, $this->session->userdata('tanggal_session'));
        $a['page'] = "hasil_pemeriksaan/list_siap_cetak";

        $this->load->view('admin/dashboard', $a);
    }

    public function verifikasi_cetak_ulang($no_uji) {
        $trim_nokendaraan = trim($no_uji);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);
       
        $a['kendaraan'] = $this->m_cetak_ulang->cari_kendaraan($rawl_nokendaraan);
        $a['page'] = "hasil_pemeriksaan/view_cetak_ulang";
        $this->load->view('admin/dashboard', $a);
    }
    
     public function update_cetak_ulang() {
        $data = array(
            "verifikasi" => $this->input->post("verifikasi")
        );

        $save_data = $this->m_cetak_ulang->update($data, $this->input->post("id_cetak_ulang"));
        if ($save_data) {
            $this->session->set_flashdata("message_cetak_ulang", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil diverifikasi. </div>");
        } else {
            $this->session->set_flashdata("message_cetak_ulang", "<div class=\"alert alert-error\" id=\"alert\">Data gagal diverifikasi. </div>");
        }

        redirect('hasil_pemeriksaan/index');
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

    public function insertKwitansi($idKp, $id_kendaraan, $idBiaya) {
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

    public function print_kwitansi_trayek($id) {


        ob_start();

        $SQL = "SELECT b.*, a.kp_ijin_trayek as kp_ijin_trayek, a.id_kendaraan as id_kendaraan FROM tbl_checklist_kendaraan c "
                . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                . " WHERE c.id_checklist = $id";

        $SQL2 = "SELECT * FROM tbl_kuitansi where id_kwitansi = 1";
        $a['datpil'] = $this->db->query($SQL)->row();
        $a['kuitansi'] = $this->db->query($SQL2)->row();
        $a['tanggal_cetak'] = date("Y-m-d");
        $a['date_manipulation'] = $this->datetimemanipulation;

        $no_kp = $a['datpil']->kp_ijin_trayek;
        $id_kendaraan = $a['datpil']->id_kendaraan;
//        $this->insertKwitansi($no_kp, $id_kendaraan, 1);

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

        $SQL = "SELECT b.*, a.kp_ijin_operasi as kp_ijin_operasi, a.id_kendaraan as id_kendaraan FROM tbl_checklist_kendaraan c "
                . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                . " WHERE c.id_checklist = $id";

        $SQL2 = "SELECT * FROM tbl_kuitansi where id_kwitansi = 2";
        $a['datpil'] = $this->db->query($SQL)->row();
        $a['kuitansi'] = $this->db->query($SQL2)->row();
        $a['tanggal_cetak'] = date("Y-m-d");
        $a['date_manipulation'] = $this->datetimemanipulation;

        $no_kp = $a['datpil']->kp_ijin_operasi;
        $id_kendaraan = $a['datpil']->id_kendaraan;
//        $this->insertKwitansi($no_kp, $id_kendaraan, 2);

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
    
    public function print_ulang($no_uji) {
        $trim_nokendaraan = trim($no_uji);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);
       
        $a['data_kendaraan'] = $this->m_cetak_ulang->get_checklist_id($rawl_nokendaraan);
        $id_checklist = $a['data_kendaraan']['id_checklist'];
        
        $a['id_pemeriksaan'] = $id_checklist;
        $a['page'] = "hasil_pemeriksaan/view_print";
        $a['path'] = 'trayek';
        $this->load->view('admin/dashboard', $a);
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

        if (!empty($a['datpil']->no_uji)) {
            $data_qr = "http://integratesystem.id/display/info_stiker.php?no_uji=" . $a['datpil']->no_uji;
            $qr['data'] = $data_qr;
            $qr['level'] = 'H';
            $qr['size'] = 10;
            $qr['savename'] = FCPATH . 'qr.png';
            $this->ciqrcode->generate($qr);


//        echo '<img src="' . base_url() . 'qr.png" />';
            $this->load->view('admin/cetak/stiker/print.php', $a);
        }
    }

    public function cetak_stiker_operasi($id) {

        $SQL = "SELECT a.*, d.masa_berlaku as masa_berlaku_kp, b.* FROM tbl_checklist_kendaraan c "
                . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                . " WHERE c.id_checklist = $id";
        $a['datpil'] = $this->db->query($SQL)->row();
        $a['date_manipulation'] = $this->datetimemanipulation;

        if (!empty($a['datpil']->no_uji)) {
            $data_qr = "http://integratesystem.id/display/info_stiker.php?no_uji=" . $a['datpil']->no_uji;
            $qr['data'] = $data_qr;
            $qr['level'] = 'H';
            $qr['size'] = 10;
            $qr['savename'] = FCPATH . 'qr.png';
            $this->ciqrcode->generate($qr);

//        echo '<img src="' . base_url() . 'qr.png" />';
            $this->load->view('admin/cetak/stiker/print_operasi.php', $a);
        }
    }

    public function update_verifikasi() {
        $data = array(
            "status_verifikasi" => $this->input->post("verifikasi")
        );

        $data_pemeriksaan['masa_berlaku'] = $this->input->post('tgl_mati_uji');
        if (!empty($data_pemeriksaan['masa_berlaku'])) {
            $update_pemeriksaan = $this->m_pemeriksaan->update($data_pemeriksaan, $this->input->post("id_update_pemeriksaan"));
        }

        $save_data = $this->m_pemeriksaan->update_checklist($data, $this->input->post("id_pemeriksaan"));
        if ($save_data) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data Berhasil diverifikasi. </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data gagal diverifikasi. </div>");
        }

        redirect('hasil_pemeriksaan/index');
    }

}
