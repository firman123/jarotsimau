<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cetak_ulang
 *
 * @author Ihtiyar
 */
class Cetak_ulang extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        self::check_authority();
    }

    private function check_authority() {
        $this->com_user = $this->session->userdata('session_admin');
        if (!empty($this->com_user)) {
            $this->load->model('m_cetak_ulang');
        } else {
            redirect("admin/login");
        }
    }

    public function index() {
        $total_row = $this->m_cetak_ulang->get_total_cetak_ulang(0);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('cetak_ulang/index/p'));
        $a['data'] = $this->m_cetak_ulang->get_cetak_ulang_all(0, $akhir, $awal);
        $a['page'] = "Cetak_ulang/list";

        $this->load->view('admin/dashboard', $a);
    }

    public function input() {
        $a['page'] = "cetak_ulang/input";
        $this->load->view('admin/dashboard', $a);
    }

    public function cari_kendaraan() {
        $no_kendaraan = $this->input->post("no_kendaraan");
        $trim_nokendaraan = trim($no_kendaraan);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);
        $a['kendaraan'] = $this->m_cetak_ulang->cari_kendaraan($rawl_nokendaraan);
        $a['page'] = "cetak_ulang/search_result";
        $this->load->view('admin/dashboard', $a);
    }
    
    public function act_add() {
        $data = array(
            "id_kendaraan" => $this->input->post("id_kendaraan"),
            "tanggal" => date("Y-m-d"),
            "verifikasi" => 0
        );

        $a['data'] = $this->m_cetak_ulang->cek_kendaraan_available($this->input->post("id_kendaraan"));
        if (empty($a['data'])) {
            if ($this->m_cetak_ulang->insert($data)) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }
        } else {
             echo "<script>alert('Gagal! data kendaraan sudah ada!');</script>";
        }



        $a['page'] = "cetak_ulang/input";
        $this->load->view('admin/dashboard', $a);
    }
    
       public function act_delete($id_cetak_ulang) {
        if ($this->m_cetak_ulang->delete($id_cetak_ulang)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed </div>");
        }

        redirect('cetak_ulang/index');
    }

}
