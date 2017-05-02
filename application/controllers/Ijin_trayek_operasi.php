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

    public function ijin_operasi() {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_user') == "") {
            redirect("admin/login");
        }

        /* pagination */
        $total_row = $this->db->query("select a.*, b.* from tbl_ijin_operasi a join tbl_kendaraan b on a.id_kendaraan = b.no_uji")->num_rows();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('ijin_trayek_operasi/i/p'));

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        $data = array(
            "id_ijin_operasi" => $this->input->post("id_ijin_operasi"),
            "id_kendaraan" => $this->input->post("id_kendaraan"),
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "verifikasi" => $this->input->post("verifikasi")
        );


        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM tbl_ijin_operasi WHERE id_ijin_operasi = '$idu'");
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('ijin_trayek_operasi/ijin_operasi');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("select a.*, b.* from tbl_ijin_operasi a join tbl_kendaraan b on a.id_kendaraan = b.no_uji WHERE LOWER(b.no_kendaraan) LIKE '%$cari%'")->result();
            $a['page'] = "ijin_operasi/list";
        } else if ($mau_ke == "add") {
            $a['kode'] = $this->m_ijin_operasi->buat_kode();
            $a['page'] = "ijin_operasi/input";
        } else if ($mau_ke == "edt") {
            $a['sub_title'] = 'Angkutan Barang';
            $a['datpil'] = $this->m_ijin_operasi->get_detail_ijin_operasi($idu);
            $a['page'] = "ijin_operasi/input";
        } else if ($mau_ke == "act_add") {
            $save_data = $this->m_ijin_operasi->insert($data);
            if ($save_data) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }
            redirect('ijin_trayek_operasi/ijin_operasi');
        } else if ($mau_ke == "act_edt") {
            if ($this->m_ijin_operasi->update($data, $this->input->post('id_ijin_operasi'))) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed to update. </div>");
            }
            redirect('ijin_trayek_operasi/ijin_operasi');
        } else if ($mau_ke == "cetak") {
            $idu = $this->uri->segment(3);
//            $a['datpil1'] = $this->db->query("SELECT * FROM t_surat_masuk WHERE id = '$idu'")->row();
//            $a['datpil2'] = $this->db->query("SELECT * FROM t_disposisi WHERE id = '$idu'")->result();
            $this->load->view('admin/cetak/ijin_usaha');
        } else {
            $a['data'] = $this->db->query("select a.*, b.* from tbl_ijin_operasi a join tbl_kendaraan b on a.id_kendaraan = b.no_uji "
                            . " ORDER BY a.id_ijin_operasi DESC "
                            . " LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "ijin_operasi/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    public function ijin_trayek() {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_user') == "") {
            redirect("admin/login");
        }

        /* pagination */
        $total_row = $this->db->query("select a.*, b.*, c.* from tbl_ijin_trayek a join tbl_kendaraan b on a.id_kendaraan = b.no_uji "
                            . " JOIN tbl_trayek c ON a.id_trayek = c.id_trayek")->num_rows();
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
            "id_trayek" => $this->input->post("id_trayek"),
            "id_kendaraan" => $this->input->post("id_kendaraan"),
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "verifikasi" => $this->input->post("verifikasi")
        );


        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM tbl_ijin_trayek WHERE id_ijin_trayek = '$idu'");
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('ijin_trayek_operasi/ijin_trayek');
        } else if ($mau_ke == "cari") {
           $a['data'] = $this->db->query("select a.*, b.*, c.* from tbl_ijin_trayek a join tbl_kendaraan b on a.id_kendaraan = b.no_uji "
                            . " JOIN tbl_trayek c ON a.id_trayek = c.id_trayek WHERE LOWER(b.no_kendaraan) LIKE '%$cari%'")->result();
            $a['page'] = "ijin_trayek/list";
        } else if ($mau_ke == "add") {
            $a['kode_trayek'] = $this->db->query("select * from tbl_trayek")->result();
            $a['kode'] = $this->m_ijin_trayek->buat_kode();
            $a['page'] = "ijin_trayek/input";
        } else if ($mau_ke == "edt") {
            $a['kode_trayek'] = $this->db->query("select * from tbl_trayek")->result();
            $a['sub_title'] = 'Angkutan Barang';
            $a['datpil'] = $this->m_ijin_trayek->get_detail_ijin_trayek($idu);
            $a['page'] = "ijin_trayek/input";
        } else if ($mau_ke == "act_add") {
//            $id_perusahaan = $this->input->post("id_perusahaan");
//            $cek_data = $this->m_ijin_usaha->get_detail_ijin_usaha_by_kendaraan($id_perusahaan);
//            if (empty($cek_data)) {
//                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal Disimpan, Anda belum membuat ijin usaha </div>");
//            } else {
//                $save_data = $this->m_ijin_trayek->insert($data);
//                if ($save_data) {
//                    $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
//                } else {
//                    $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
//                }
//            }
            $save_data = $this->m_ijin_trayek->insert($data);
            if ($save_data) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
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
            $a['data'] = $this->db->query("select a.*, b.*, c.* from tbl_ijin_trayek a join tbl_kendaraan b on a.id_kendaraan = b.no_uji "
                            . " JOIN tbl_trayek c ON a.id_trayek = c.id_trayek"
                            . " ORDER BY a.id_ijin_trayek DESC "
                            . " LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "ijin_trayek/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    function cari_kendaraan() {
        $keyword = $this->uri->segment(3);

        // cari di database
//        $data = $this->db->from('tbl_kendaraan')->like('LOWER(no_uji)', $keyword)->get();

        $data = $this->db->query("SELECT * FROM tbl_kendaraan WHERE LOWER(no_uji) LIKE '%$keyword%' OR LOWER(no_kendaraan) LIKE '%$keyword%'");

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->no_uji . " - " . $row->no_kendaraan . " - " . $row->nama_pemilik,
                'no_uji' => $row->no_uji
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

    function cari_kendaraan_advance() {
        $keyword = $this->uri->segment(3);
//        OR LOWER(a.no_kendaraan) LIKE '%$keyword%'
        $data = $this->db->query("SELECT a.*, b.* , c.*, d.*, e.* FROM tbl_kendaraan a JOIN tbl_ijin_trayek b"
                . " ON a.no_uji = b.id_kendaraan JOIN tbl_perusahaan c ON b.id_perusahaan = c.id "
                . " JOIN tbl_trayek e ON b.id_trayek = e.id_trayek "
                . " LEFT JOIN tb_note_kendaraan d ON a.no_uji  = d.id_kendaraan "
                . " WHERE LOWER(a.no_uji) LIKE '%$keyword%' OR LOWER(TRIM(a.no_kendaraan)) LIKE '%$keyword%'");

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->no_uji . " - " . $row->no_kendaraan . " - " . $row->nama_pemilik,
                'no_kendaraan' => $row->no_kendaraan,
                'no_uji' => $row->no_uji,
                'id_kp' => $row->id_ijin_trayek,
                'masa_berlaku' => $row->masa_berlaku,
                'no_trayek' => $row->kd_trayek,
                'nama_pemilik' => $row->nama_pemilik,
                'alamat_pemilik' => $row->alamat,
                'nama_perusahaan' => $row->nama_perusahaan,
                'catatan' => $row->catatan,
                'last_update' => $row->last_update,
                'post_by' => $row->post_by
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

    function cari_kendaraan_operasi() {
        $keyword = $this->uri->segment(3);
//        OR LOWER(a.no_kendaraan) LIKE '%$keyword%'
        $data = $this->db->query("SELECT a.*, b.* , c.*, d.* FROM tbl_kendaraan a JOIN tbl_ijin_operasi b"
                . " ON a.no_uji = b.id_kendaraan JOIN tbl_perusahaan c ON b.id_perusahaan = c.id "
                . " LEFT JOIN tb_note_kendaraan d ON a.no_uji  = d.id_kendaraan "
                . " WHERE LOWER(a.no_uji) LIKE '%$keyword%' OR LOWER(TRIM(a.no_kendaraan)) LIKE '%$keyword%'");

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->no_uji . " - " . $row->no_kendaraan . " - " . $row->nama_pemilik,
                'no_kendaraan' => $row->no_kendaraan,
                'no_uji' => $row->no_uji,
                'id_kp' => $row->id_ijin_operasi,
                'masa_berlaku' => $row->masa_berlaku,
                'nama_pemilik' => $row->nama_pemilik,
                'alamat_pemilik' => $row->alamat,
                'nama_perusahaan' => $row->nama_perusahaan,
                'catatan' => $row->catatan,
                'last_update' => $row->last_update,
                'post_by' => $row->post_by
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
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
    
    function cari_perusahaan2() {
        // tangkap variabel keyword dari URL
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);

        // cari di database

        $data = $this->db->from('tbl_perusahaan')->like('LOWER(nama_perusahaan)', $keyword)->get();

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->nama_perusahaan,
                'id' => $row->id,
                'nama_perusahaan' => $row->nama_perusahaan,
                'alamat_perusahaan' => $row->alamat_perusahaan
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

    function cari_perusahaan($jenis) {
        // tangkap variabel keyword dari URL
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);

        // cari di database

        if (empty($jenis) || $jenis==NULL) {
            $data = $this->db->from('tbl_perusahaan')->like('LOWER(nama_perusahaan)', $keyword)->get();
        } else {
            $data = $this->db->query("SELECT * FROM tbl_perusahaan WHERE jenis = '$jenis'");
        }


        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->nama_perusahaan,
                'id' => $row->id,
                'nama_perusahaan' => $row->nama_perusahaan,
                'alamat_perusahaan' => $row->alamat_perusahaan
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

}
