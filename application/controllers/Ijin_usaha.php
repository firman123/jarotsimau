<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Surat_ijin
 *
 * @author Ihtiyar
 */
class ijin_usaha extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->load->model("m_ijin_usaha");
        
        $this->load->library("datetimemanipulation");
    }

    public function angkutan_barang() {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_user') == "") {
            redirect("admin/login");
        }

        $jenis_kendaraan = 'barang';

        /* pagination */
        $total_row = $this->m_ijin_usaha->total_surat_ijin($jenis_kendaraan);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('ijin_usaha/angkutan_barang/p'));

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        $data = array(
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "tanggal_berlaku" => $this->input->post("tanggal_berlaku"),
            "tanggal_berakhir" => $this->input->post("tanggal_berakhir"),
            "jenis_angkutan" => $this->input->post("jenis_angkutan"),
            "verifikasi" => $this->input->post("verifikasi")
        );
        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM tbl_ijin_usaha WHERE id_ijin = '$idu'");
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('ijin_usaha/angkutan_barang');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("select a.*, b.* from tbl_perusahaan a join tbl_ijin_usaha b on a.id = b.id_perusahaan"
                            . "                     where b.jenis_angkutan = '" . $jenis_kendaraan . "' AND a.nama_perusahaan LIKE '%$cari%'")->result();

//            $a['data'] = $this->db->query("SELECT * FROM t_surat_masuk WHERE isi_ringkas LIKE '%$cari%' ORDER BY id DESC")->result();
            $a['path'] = "angkutan_barang";
            $a['page'] = "ijin_usaha/list";
            $a['sub_title'] = 'Angkutan Barang';
            $a['page'] = "ijin_usaha/list";
        } else if ($mau_ke == "add") {
            $a['sub_title'] = 'Angkutan Barang';
            $a['jenis_angkutan'] = 'barang';
            $a['page'] = "ijin_usaha/input";
            $a['path'] = "angkutan_barang";
        } else if ($mau_ke == "edt") {
            $a['sub_title'] = 'Angkutan Barang';
            $a['datpil'] = $this->m_ijin_usaha->get_detail_ijin_usaha_by_id($idu);
            $a['jenis_angkutan'] = 'barang';
            $a['page'] = "ijin_usaha/input";
            $a['path'] = "angkutan_barang";
//            $a['datpil'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE no_uji = '$idu'")->row();
        } else if ($mau_ke == "act_add") {
            $nomor_surat = $this->m_ijin_usaha->create_nomor_surat_ijin();
            $data['nomor_surat'] = $nomor_surat + 1;
            $save_data = $this->m_ijin_usaha->insert($data);
            if ($save_data) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }
            redirect('ijin_usaha/angkutan_barang');
        } else if ($mau_ke == "act_edt") {

            if ($this->m_ijin_usaha->update($data, $this->input->post('id_ijin'))) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed to update. </div>");
            }
            redirect('ijin_usaha/angkutan_barang');
        } else if ($mau_ke == "cetak") {
            $idu = $this->uri->segment(3);
//            $a['datpil1'] = $this->db->query("SELECT * FROM t_surat_masuk WHERE id = '$idu'")->row();
//            $a['datpil2'] = $this->db->query("SELECT * FROM t_disposisi WHERE id = '$idu'")->result();
            $this->load->view('admin/cetak/ijin_usaha');
        } else {
            $a['path'] = "angkutan_barang";
            $a['sub_title'] = 'Angkutan Barang';
            $a['data'] = $this->db->query("select a.*, b.* from tbl_perusahaan a join tbl_ijin_usaha b on a.id = b.id_perusahaan"
                            . "                     where b.jenis_angkutan = '" . $jenis_kendaraan . "' LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "ijin_usaha/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    public function cetak() {
        ob_start();
        $data['siswa'] = $this->siswa_model->view_row();
        $this->load->view('admin/cetak/ijin_usaha', $data);
        $html = ob_get_contents();
        ob_end_clean();

        require_once('./aset/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P', 'A4', 'en');
        $pdf->WriteHTML($html);
        $pdf->Output('Data Siswa.pdf', 'D');
    }

    public function cetak_surat_ijin() {
        ob_start();
        $idu = $this->uri->segment(3);
        $a['datpil'] = $this->db->query("select a.*, b.* from tbl_perusahaan a join tbl_ijin_usaha b on a.id = b.id_perusahaan"
                        . "                     where b.id_ijin = '$idu'")->row();
        $a['date_manipulation'] = $this->datetimemanipulation;
//        $this->load->view('admin/cetak/surat_ijin_usaha/ijin_usaha', $a);
        
         $this->load->view('admin/cetak/kwitansi/kwitansi_ijin_usaha', $a);
        $html = ob_get_contents();
        ob_end_clean();

        require_once('./aset/html2pdf/html2pdf.class.php');
        $pdf = new HTML2PDF('P', 'A4', 'en');
        $pdf->WriteHTML($html);
        $pdf->Output('Surat Ijin Usaha.pdf', 'D');
    }

    public function angkutan_penumpang() {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_user') == "") {
            redirect("admin/login");
        }

        $jenis_kendaraan = 'penumpang';

        /* pagination */
        $total_row = $this->m_ijin_usaha->total_surat_ijin($jenis_kendaraan);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('ijin_usaha/angkutan_penumpang/p'));

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        $data = array(
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "tanggal_berlaku" => $this->input->post("tanggal_berlaku"),
            "tanggal_berakhir" => $this->input->post("tanggal_berakhir"),
            "jenis_angkutan" => $this->input->post("jenis_angkutan"),
            "verifikasi" => $this->input->post("verifikasi")
        );
        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM tbl_ijin_usaha WHERE id_ijin = '$idu'");
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('ijin_usaha/angkutan_penumpang');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("select a.*, b.* from tbl_perusahaan a join tbl_ijin_usaha b on a.id = b.id_perusahaan"
                            . "                     where b.jenis_angkutan = '" . $jenis_kendaraan . "' AND a.nama_perusahaan LIKE '%$cari%'")->result();

//            $a['data'] = $this->db->query("SELECT * FROM t_surat_masuk WHERE isi_ringkas LIKE '%$cari%' ORDER BY id DESC")->result();
            $a['path'] = "angkutan_penumpang";
            $a['page'] = "ijin_usaha/list";
            $a['sub_title'] = 'Angkutan Penumpang';
            $a['page'] = "ijin_usaha/list";
        } else if ($mau_ke == "add") {
            $a['sub_title'] = 'Angkutan Penumpang';
            $a['jenis_angkutan'] = 'penumpang';
            $a['page'] = "ijin_usaha/input";
            $a['path'] = "angkutan_penumpang";
        } else if ($mau_ke == "edt") {
            $a['sub_title'] = 'Angkutan Penumpang';
            $a['datpil'] = $this->m_ijin_usaha->get_detail_ijin_usaha_by_id($idu);
            $a['jenis_angkutan'] = 'penumpang';
            $a['page'] = "ijin_usaha/input";
            $a['path'] = "angkutan_penumpang";
//            $a['datpil'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE no_uji = '$idu'")->row();
        } else if ($mau_ke == "act_add") {
            $save_data = $this->m_ijin_usaha->insert($data);
            if ($save_data) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }
            redirect('ijin_usaha/angkutan_penumpang');
        } else if ($mau_ke == "act_edt") {

            if ($this->m_ijin_usaha->update($data, $this->input->post('id_ijin'))) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed to update. </div>");
            }
            redirect('ijin_usaha/angkutan_penumpang');
        } else {

            $a['data'] = $this->db->query("select a.*, b.* from tbl_perusahaan a join tbl_ijin_usaha b on a.id = b.id_perusahaan"
                            . "                     where b.jenis_angkutan = '" . $jenis_kendaraan . "' LIMIT $akhir OFFSET $awal ")->result();
            $a['path'] = "angkutan_penumpang";
            $a['page'] = "ijin_usaha/list";

            $a['sub_title'] = 'Angkutan Penumpang';
        }

        $this->load->view('admin/dashboard', $a);
    }

}
