<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Peremajaan
 *
 * @author Ihtiyar
 */
class Peremajaan extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        self::check_authority();
    }

    public function index() {
        $total_row = $this->m_peremajaan->get_total_peremajaan();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('peremajaan/index/p'));
        $a['data'] = $this->m_peremajaan->get_peremajaan_all($akhir, $awal);
        $a['page'] = "peremajaan/list";

        $this->load->view('admin/dashboard', $a);
    }

    public function input() {
        $a['page'] = "peremajaan/input";
        $this->load->view('admin/dashboard', $a);
    }

    public function act_add() {
        $data = array(
            "no_kendaraan_lama" => $this->input->post("no_kendaraan_lama"),
            "no_kendaraan_baru" => $this->input->post("no_kendaraan_baru"),
            "id_kendaraan" => $this->input->post("id_kendaraan"),
            "tanggal" => date("Y-m-d"),
            "verifikasi" => 0
        );

        $a['data'] = $this->m_peremajaan->cek_kendaraan_available($this->input->post("no_kendaraan_lama"));
        if (empty($a['data'])) {
            if ($this->m_peremajaan->insert($data)) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }
        } else {
             echo "<script>alert('Gagal! data kendaraan sudah ada!');</script>";
        }



        $a['page'] = "peremajaan/input";
        $this->load->view('admin/dashboard', $a);
    }

    public function act_delete($id_peremajaan) {
        if ($this->m_peremajaan->delete($id_peremajaan)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed </div>");
        }

        redirect('peremajaan/index');
    }

    public function cari_kendaraan() {
        $no_kendaraan = $this->input->post("no_kendaraan");
        $trim_nokendaraan = trim($no_kendaraan);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);

        $SQL = "SELECT A.*, A.id_kendaraan AS kendaraan_id,  A.tgl_mati_uji as berlaku_kp,  B.*, D.* "
                . " FROM tbl_kendaraan A LEFT JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                . " LEFT JOIN tbl_trayek D ON A.id_trayek = D.id_trayek  "
                . " WHERE  A.no_uji = '$rawl_nokendaraan' ";

        $a['kendaraan'] = $this->db->query($SQL)->row_array();
//        if (empty($a['kendaraan'])) {
//
//            $this->session->set_flashdata("message_cari", "<div class=\"alert alert-error\" id=\"alert\">Data Tidak ditemukan</div>");
//        }

        $a['page'] = "peremajaan/search_result";
        $this->load->view('admin/dashboard', $a);
    }

    private function check_authority() {
        $this->com_user = $this->session->userdata('session_admin');
        if (!empty($this->com_user)) {
            $this->load->model('m_peremajaan');
        } else {
            redirect("admin/login");
        }
    }

}
