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

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->load->model('m_kendaraan');
    }

    public function kendaraan() {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_user') == "") {
            redirect("admin/login");
        }

        /* pagination */
        $total_row = $this->db->query("SELECT * FROM tbl_kendaraan where no_uji LIKE 'SIMAU%'")->num_rows();
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
            $this->db->query("DELETE FROM t_surat_masuk WHERE id = '$idu'");
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('admin/kendaraan/surat_masuk');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM t_surat_masuk WHERE isi_ringkas LIKE '%$cari%' ORDER BY id DESC")->result();
            $a['page'] = "kendaraan/list";
        } else if ($mau_ke == "add") {
            $a['kode'] = $this->m_kendaraan->buat_kode();
            $a['data_jenis'] = array("Umum", "Tidak Umum", "Coba Jalan");
//            $a['data_jenis'] = $this->$jenis;
            $a['page'] = "kendaraan/input";
        } else if ($mau_ke == "edt") {
            $a['data_jenis'] = array("Umum", "Tidak Umum", "Coba Jalan");
            $a['datpil'] = $this->m_kendaraan->get_detail_kendaraan_by_id($idu);
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
//            if ($this->upload->do_upload('file_surat')) {
//                $up_data = $this->upload->data();
//
//                $this->db->query("UPDATE t_surat_masuk SET kode = '$kode', no_agenda = '$no_agenda', indek_berkas = '$indek_berkas', isi_ringkas = '$uraian', dari = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket', file = '" . $up_data['file_name'] . "' WHERE id = '$idp'");
//            } else {
//                $this->db->query("UPDATE t_surat_masuk SET kode = '$kode', no_agenda = '$no_agenda', indek_berkas = '$indek_berkas', isi_ringkas = '$uraian', dari = '$dari', no_surat = '$no_surat', tgl_surat = '$tgl_surat', keterangan = '$ket' WHERE id = '$idp'");
//            }
//            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. " . $this->upload->display_errors() . "</div>");
            redirect('master_data/kendaraan');
        } else {
            $a['data'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE no_uji LIKE 'SIMAU%' LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "kendaraan/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

}
