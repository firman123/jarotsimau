<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ijin_trayek
 *
 * @author Ihtiyar
 */
class ijin_trayek_operasi extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->load->model('m_ijin_trayek');
        $this->load->model('m_ijin_operasi');
        $this->load->model('m_ijin_usaha');
        $this->load->model('m_trayek');
    }

    public function ijin_trayek() {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_user') == "") {
            redirect("admin/login");
        }

        /* pagination */
        $total_row = $this->m_ijin_trayek->total_ijin_trayek();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('ijin_trayek_operasi/ijin_trayek/p'));

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        $data = array(
            "id_ijin_trayek" => $this->input->post("id_ijin_trayek"),
            "masa_berlaku" => $this->input->post("masa_berlaku"),
            "masa_berakhir" => $this->input->post("masa_berakhir"),
            "id_trayek" => $this->input->post("id_trayek"),
            "id_kendaraan" => $this->input->post("id_kendaraan"),
            "verifikasi" => $this->input->post("verifikasi")
        );
        
        print_r($data);
        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM tbl_ijin_trayek WHERE id_ijin = '$idu'");
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('ijin_trayek_operasi/ijin_trayek');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("select a.*, b.* from tbl_perusahaan a join tbl_ijin_usaha b on a.id = b.id_perusahaan"
                            . "                     where b.jenis_angkutan = '" . $jenis_kendaraan . "' AND a.nama_perusahaan LIKE '%$cari%'")->result();

//            $a['data'] = $this->db->query("SELECT * FROM t_surat_masuk WHERE isi_ringkas LIKE '%$cari%' ORDER BY id DESC")->result();
            $a['path'] = "angkutan_barang";
            $a['page'] = "ijin_usaha/list";
            $a['sub_title'] = 'Angkutan Barang';
            $a['page'] = "ijin_usaha/list";
        } else if ($mau_ke == "add") {
            $a['kode'] = $this->m_ijin_trayek->buat_kode();
            $a['page'] = "ijin_trayek/input";
        } else if ($mau_ke == "edt") {
            $a['sub_title'] = 'Angkutan Barang';
            $a['datpil'] = $this->m_ijin_trayek->get_detail_ijin_trayek($idu);
            $a['page'] = "ijin_trayek/input";
        } else if ($mau_ke == "act_add") {
            $id_kendaraan = $this->input->post("id_kendaraan");
            $cek_data = $this->m_ijin_usaha->get_detail_ijin_usaha_by_kendaraan($id_kendaraan);
            if (empty($cek_data)) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal Disimpan, Anda belum membuat ijin usaha </div>");
            } else {
                $save_data = $this->m_ijin_trayek->insert($data);
                if ($save_data) {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
                } else {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
                }
            }
            redirect('ijin_trayek_operasi/ijin_trayek');
        } else if ($mau_ke == "act_edt") {

            if ($this->m_ijin_trayek->update($data, $this->input->post('id_ijin_trayek'))) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed to update. </div>");
            }
            redirect('ijin_trayek_operasi/ijin_trayek');
        } else if ($mau_ke == "cetak") {
            $idu = $this->uri->segment(3);
//            $a['datpil1'] = $this->db->query("SELECT * FROM t_surat_masuk WHERE id = '$idu'")->row();
//            $a['datpil2'] = $this->db->query("SELECT * FROM t_disposisi WHERE id = '$idu'")->result();
            $this->load->view('admin/cetak/ijin_usaha');
        } else {
            $a['data'] = $this->db->query("select a.*, b.* ,c.*, d.* from tbl_ijin_trayek a join tbl_kendaraan b on a.id_kendaraan = b.no_uji "
                            . " JOIN tbl_perusahaan c on a.id_perusahaan = c.id JOIN tbl_trayek d ON a.id_trayek = d.id_trayek ORDER BY a.id_ijin_trayek DESC "
                            . " LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "ijin_trayek/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    function cari_kendaraan() {
        // tangkap variabel keyword dari URL
        $keyword = $this->input->post('id_trayek');


        // cari data yang ada di database
        $data = $this->m_ijin_trayek->getKendaraan($keyword);
        $hasil_data = array();


        foreach ($data as $d) {

            $json_array = array();
            $json_array['value'] = $d['no_uji'];
            $json_array['label'] = $d['no_kendaraan'] . " -" . $d['no_chasis'] . " - " . $d['nama_pemilik'];
            $hasil_data[] = $json_array;
        }
        echo json_encode($hasil_data);
    }
    
    function cari_trayek() {
        // tangkap variabel keyword dari URL
        $keyword = $this->input->post('kd_trayek');


        // cari data yang ada di database
        $data = $this->m_ijin_trayek->getTrayek($keyword);
        $hasil_data = array();


        foreach ($data as $d) {

            $json_array = array();
            $json_array['value'] = $d['id_trayek'];
            $json_array['label'] = $d['kd_trayek'];
            $hasil_data[] = $json_array;
        }
        echo json_encode($hasil_data);
    }
    
    function cari_trayek2() {
        // tangkap variabel keyword dari URL
        $keyword = $this->input->post('kd_trayek');


        // cari data yang ada di database
        $data = $this->m_ijin_trayek->get_trayek_lintasan($keyword);
        $hasil_data = array();


        foreach ($data as $d) {

            $json_array = array();
            $json_array['value'] = $d['id_trayek'];
            $json_array['label'] = $d['id_trayek'] . "-" . $d['kode_trayek'];
            $hasil_data[] = $json_array;
        }
        echo json_encode($hasil_data);
    }
    
    

}
