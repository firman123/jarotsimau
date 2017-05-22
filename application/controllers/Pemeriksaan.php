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

    //put your code here

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_user') == "") {
            redirect("admin/login");
        }

        $this->load->model('m_pemeriksaan');
    }

    public function index() {
        $total_row = $this->m_pemeriksaan->get_total_pemeriksaan();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('ijin_trayek_operasi/i/p'));
        $a['path'] = "angkutan_barang";
        $a['sub_title'] = 'Angkutan Barang';
//        $a['data'] = $this->db->query("SELECT * FROM tbl_perusahaan ORDER BY id_perusahaan DESC LIMIT $akhir OFFSET $awal ")->result();
        $a['data'] = $this->m_pemeriksaan->get_pemeriksaan_all($akhir, $awal);
        $a['page'] = "pemeriksaan/list";

        $this->load->view('admin/dashboard', $a);
    }

    public function input() {
        $a['page'] = "pemeriksaan/input";
        $this->load->view('admin/dashboard', $a);
    }

    public function cari_kendaraan() {
        $no_kendaraan = $this->input->post("no_kendaraan");
        $trim_nokendaraan = trim($no_kendaraan);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);
        $a['kendaraan'] = $this->db->query("SELECT A.*, B.*, C.* FROM tbl_kendaraan A JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                        . "  LEFT JOIN tb_note_kendaraan C ON a.no_uji=c.id_kendaraan WHERE A.kp_ijin_trayek != '' AND A.no_kendaraan = '$rawl_nokendaraan'")->row_array();
        if (empty($a['kendaraan'])) {

            $this->session->set_flashdata("message_cari", "<div class=\"alert alert-error\" id=\"alert\">Data Tidak ditemukan</div>");
        }
        $a['page'] = "pemeriksaan/search_result";
    }

}
