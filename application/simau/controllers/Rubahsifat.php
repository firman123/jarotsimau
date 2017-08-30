<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RubahSifat
 *
 * @author Ihtiyar
 */
class Rubahsifat extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_user') == "") {
            redirect("admin/login");
        }

        $this->load->model("m_kendaraan");
        $this->load->model("m_perusahaan");
        $this->load->library("datetimemanipulation");
        $this->load->library('fpdf');
    }

    public function index() {
        $total_row = $this->m_kendaraan->total_kendaraan_rubah_sifat();
        $per_page = 10;

        $awal = $this->uri->segment(3);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('rubahsifat/index'));
        $a['data'] = $this->m_kendaraan->get_all_kendaraan_rubah_sifat($akhir, $awal);
        $a['page'] = "rubah_sifat/list";

        $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
        $this->load->view('admin/dashboard', $a);
    }

    public function cari_kendaraan() {
        $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
        $id_perusahaan = $this->input->post('id_perusahaan');
        $a['data'] = $this->db->query("SELECT a.* FROM tbl_kendaraan a JOIN tbl_perusahaan b "
                        . " ON a.id_perusahaan = b.id WHERE a.id_perusahaan = $id_perusahaan")->result();
        $a['page'] = "rubah_sifat/list_kendaraan_perusahaan";
        $this->load->view('admin/dashboard', $a);
    }

    public function cari_nomer_kendaraan() {
        $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
        $a['data_sifat'] = array("UMUM", "TIDAK UMUM", "COBA JALAN");
        $no_kendaraan = $this->input->post("no_kendaraan");
        $trim_nokendaraan = trim($no_kendaraan);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);
        $a['kendaraan'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE no_uji = '$rawl_nokendaraan'")->row_array();

        if (empty($a['kendaraan'])) {
            $this->session->set_flashdata("message_cari", "<div class=\"alert alert-error\" id=\"alert\">Data Tidak ditemukan</div>");
        }
        $a['page'] = "rubah_sifat/search_result";
        $this->load->view('admin/dashboard', $a);
    }

    public function add() {
        $a['data_sifat'] = array("UMUM", "TIDAK UMUM", "COBA JALAN");
        $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
        $a['page'] = "rubah_sifat/input";
        $this->load->view('admin/dashboard', $a);
    }

    public function view($id_kendaraan) {
        $trim_nokendaraan = trim($id_kendaraan);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);
        $a['kendaraan'] = $this->db->query("SELECT a.* , b.* FROM tbl_kendaraan a left join tbl_perusahaan b "
                . " ON a.id_perusahaan = b.id WHERE a.no_uji = '$rawl_nokendaraan'")->row_array();
        $a['value_validasi'] = array(2, 3);
        $a['page'] = "rubah_sifat/verifikasi";
        $this->load->view('admin/dashboard', $a);
    }

    public function act_save() {
        $data = array(
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "tanggal" => date("Y-m-d"),
            "verifikasi_rubah_sifat" => 1,
            "sifat" => $this->input->post("sifat"),
            "sifat_lama" => $this->input->post("sifat_lama")
        );

        $save_data = $this->m_kendaraan->update($data, $this->input->post("id_kendaraan"));
        if ($save_data) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
        }
        redirect('rubahsifat/add');
    }
    
    public function verifikasi_act() {
        $data = array(
            "tanggal" => date("Y-m-d"),
            "verifikasi_rubah_sifat" => $this->input->post("verifikasi")
        );

        $save_data = $this->m_kendaraan->update($data, $this->input->post("id_kendaraan"));
        if ($save_data) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
        }
        redirect('rubahsifat/add');
    }
    
   public function print_kwitansi($id) {
        ob_start();

        $rawlId = rawurldecode($id);
        $SQL = "SELECT a.*, b.* from tbl_kendaraan a left join tbl_perusahaan b"
                . " ON a.id_perusahaan = b.id WHERE a.no_uji = '$rawlId'";

        $a['datpil'] = $this->db->query($SQL)->row();
        
        $a['tanggal_cetak'] = date("Y-m-d");
        $a['date_manipulation'] = $this->datetimemanipulation;

        $this->load->view('admin/cetak/kwitansi/rubah_sifat/print', $a);
        $html = ob_get_contents();
        ob_end_clean();

        require_once('./aset/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P', 'A4', 'en');
        $pdf->WriteHTML($html);
        $pdf->Output('kwitansi Rubah Sifat.pdf', 'D');
    }
    
    public function print_rubah_sifat($id) {
        $id_kendaraan = trim(rawurldecode($id));
          define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $SQL = "SELECT a.*, b.* from tbl_kendaraan a JOIN tbl_perusahaan b "
                . " ON a.id_perusahaan = b.id WHERE a.no_uji = '$id_kendaraan'";
        $a['datpil'] = $this->db->query($SQL)->row();
        
        
        $a['date_manipulation'] = $this->datetimemanipulation;
//
//        $data_gambar = $a['datpil']->foto;
//        if ($data_gambar==null) {
//            $a['poto_sopir'] = base_url() . 'upload/noimage.jpg';
//        } else {
//            $foto_trim = trim($data_gambar);
//            $a['poto_sopir'] = base_url() . "upload/kartu_pengawas/" . $foto_trim;
//        }

//        print_r($a['poto_sopir']);


//        $data_qr = "http://integratesystem.id/display/kartu_induk.php?no_uji=" . $a['datpil']->no_uji;
//        $qr['data'] = $data_qr;
//
//        $qr['level'] = 'H';
//        $qr['size'] = 10;
//        $qr['savename'] = FCPATH . 'qr.png';
//        $this->ciqrcode->generate($qr);

        $this->load->view('admin/cetak/rubah_sifat/print.php', $a);
   
    }

}
