<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kendaraan
 *
 * @author Ihtiyar
 */
class master_data extends CI_Controller {
    protected $com_user;
    //put your code here

    public function __construct() {
        parent::__construct();
        self::check_authority();
    }
    
      private function check_authority() {
	$this->com_user = $this->session->userdata('session_admin');
	if (!empty($this->com_user)) {
	  $this->load->model('m_kendaraan');
          $this->load->model('m_perusahaan');
          $this->load->model('m_trayek');
	} else {
	   redirect("admin/login");
	}
    }

    public function kendaraan() {

        /* pagination */
        $total_row = $this->db->query("SELECT * FROM tbl_kendaraan ORDER BY no_uji DESC")->num_rows();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('master_data/kendaraan/p'));

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        $data = array(
            "no_uji" => $this->input->post("no_uji"),
            "no_kendaraan" => $this->input->post("no_kendaraan"),
            "nama_pemilik" => $this->input->post("nama_pemilik"),
            "alamat" => $this->input->post("alamat"),
            "no_chasis" => $this->input->post("no_chasis"),
            "no_mesin" => $this->input->post("no_mesin"),
            "sifat" => $this->input->post("sifat")
        );
        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM tbl_kendaraan WHERE no_uji = '$idu'");
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('admin/kendaraan/surat_masuk');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE no_kendaraan LIKE '%$cari%'")->result();
            $a['page'] = "kendaraan/list";
        } else if ($mau_ke == "add") {
            $a['kode'] = $this->m_kendaraan->buat_kode();
            $a['data_sifat'] = array("UMUM", "TIDAK UMUM", "COBA JALAN");
            $a['jenis_kendaraan'] = array("Barang", "Penumpang");
            $a['trayek'] = $this->m_trayek->get_all_trayek();
            $a['page'] = "kendaraan/input";
        } else if ($mau_ke == "edt") {
            $a['data_sifat'] = array("UMUM", "TIDAK UMUM", "COBA JALAN");
            $a['jenis_kendaraan'] = array("Barang", "Penumpang");
            $a['trayek'] = $this->m_trayek->get_all_trayek();
            $id_kendaraan = rawurldecode($idu);
            $a['datpil'] = $this->m_kendaraan->get_detail_kendaraan_by_id($id_kendaraan);
//            $a['datpil'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE no_uji = '$idu'")->row();
//            print_r($a['datpil']);
            $a['page'] = "kendaraan/input";
//            $a['datpil'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE no_uji = '$idu'")->row();
        } else if ($mau_ke == "act_add") {
            $save_data = $this->m_kendaraan->insert($data);
            if ($save_data) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }


            redirect('master_data/kendaraan');
        } else if ($mau_ke == "act_edt") {

            if ($this->m_kendaraan->update($data, $this->input->post('no_uji'))) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed to update. </div>");
            }
            redirect('master_data/kendaraan');
        } else {
            $a['data'] = $this->db->query("SELECT * FROM tbl_kendaraan ORDER BY no_uji DESC LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "kendaraan/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    public function perusahaan() {
        /* pagination */
        $total_row = $this->db->query("SELECT * FROM tbl_perusahaan")->num_rows();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('master_data/perusahaan/p'));

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        $data = array(
            "no_surat_ijin" => $this->input->post("no_surat_ijin"),
            "nama_perusahaan" => $this->input->post("nama_perusahaan"),
            "alamat_perusahaan" => $this->input->post("alamat_perusahaan"),
            "npwp" => $this->input->post("npwp"),
            "nama_pimpinan" => $this->input->post("nama_pimpinan"),
            "alamat" => $this->input->post("alamat"),
            "no_ktp" => $this->input->post("no_ktp"),
            "no_telpon" => $this->input->post("no_telpon"),
            "masa_berlaku" => $this->input->post("masa_berlaku"),
            "jenis" => $this->input->post("jenis")
        );
        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM tbl_perusahaan WHERE id = '$idu'");
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('master_data/perusahaan');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM tbl_perusahaan WHERE nama_perusahaan LIKE '%$cari%' ORDER BY id DESC")->result();
            $a['page'] = "perusahaan/list";
        } else if ($mau_ke == "add") {
            $a['jenis_perusahaan'] = array("Barang", "Penumpang");
            $a['page'] = "perusahaan/input";
        } else if ($mau_ke == "edt") {
            $a['jenis_perusahaan'] = array("Barang", "Penumpang");
            $a['datpil'] = $this->m_perusahaan->get_detail_perusahaan_by_id($idu);
            $a['page'] = "perusahaan/input";
        } else if ($mau_ke == "act_add") {
            $save_data = $this->m_perusahaan->insert($data);
            if ($save_data) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }
            redirect('master_data/perusahaan');
        } else if ($mau_ke == "act_edt") {
            if ($this->m_perusahaan->update($data, $this->input->post('id'))) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed to update. </div>");
            }
            redirect('master_data/perusahaan');
        } else {
            $a['data'] = $this->db->query("SELECT * FROM tbl_perusahaan ORDER BY id DESC LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "perusahaan/list";
        }
        $this->load->view('admin/dashboard', $a);
    }

    public function trayek() {
        /* pagination */
        $total_row = $this->db->query("SELECT * FROM tbl_trayek")->num_rows();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('master_data/trayek/p'));

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        $data = array(
            "kd_trayek" => $this->input->post("kd_trayek"),
            "lintasan_trayek" => $this->input->post("lintasan_trayek")
        );
        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM tbl_trayek WHERE id_trayek = '$idu'");
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('master_data/trayek');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM tbl_trayek WHERE lintasan_trayek LIKE '%$cari%' ORDER BY id_trayek DESC")->result();
            $a['page'] = "trayek/list";
        } else if ($mau_ke == "add") {
            $a['page'] = "trayek/input";
        } else if ($mau_ke == "edt") {
            $a['datpil'] = $this->m_trayek->get_detail_trayek_by_id($idu);
            $a['page'] = "trayek/input";
//            $a['datpil'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE no_uji = '$idu'")->row();
        } else if ($mau_ke == "act_add") {
            $save_data = $this->m_trayek->insert($data);
            if ($save_data) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }


            redirect('master_data/trayek');
        } else if ($mau_ke == "act_edt") {

            if ($this->m_trayek->update($data, $this->input->post('id_trayek'))) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed to update. </div>");
            }
            redirect('master_data/trayek');
        } else {
            $a['data'] = $this->db->query("SELECT * FROM tbl_trayek ORDER BY id_trayek DESC LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "trayek/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    public function get_perusahaan() {
        $nama_perusahaan = $this->input->post('perusahaan');

        $data = $this->m_perusahaan->getPerusahaanByName($nama_perusahaan);



        $hasil_data = array();


        foreach ($data as $d) {

            $json_array = array();
            $json_array['value'] = $d['id'];
            $json_array['label'] = $d['nama_perusahaan'] . " - " . $d['nama_pimpinan'];
            $hasil_data[] = $json_array;
        }
        echo json_encode($hasil_data);
    }

}
