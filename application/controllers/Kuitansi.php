<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kuitansi
 *
 * @author Ihtiyar
 */
class Kuitansi extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        self::check_authority();
    }

    private function check_authority() {
        $this->com_user = $this->session->userdata('session_admin');
        if (!empty($this->com_user)) {
            $this->load->model('m_kuitansi');
        } else {
            redirect("admin/login");
        }
    }

    public function index() {
        $a['data'] = $this->m_kuitansi->get_kuitansi_all();
        $a['page'] = "kuitansi/list";
        $this->load->view('admin/dashboard', $a);
    }

    public function edit($id) {
        $a['datpil'] = $this->m_kuitansi->get_detail_kuitansi($id);
        $a['page'] = "kuitansi/input";
        $this->load->view('admin/dashboard', $a);
    }

    // update
    public function act_edt() {
        $harga = $this->input->post("harga");
        $harga = str_replace("Rp.", "", $harga);
  
        $data = array(
            "jenis" => $this->input->post("jenis"),
            "harga" => $harga,
            "keterangan" => $this->input->post("keterangan")
        );
        if ($this->m_kuitansi->update($data, $this->input->post('id_kwitansi'))) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed to update. </div>");
        }
        redirect('kuitansi');
    }

}
