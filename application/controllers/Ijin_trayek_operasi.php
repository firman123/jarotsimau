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

    protected $com_user;

    //put your code here

    public function __construct() {
        parent::__construct();
        self::check_authority();

        $this->load->library('fpdf');
        $this->load->library("datetimemanipulation");
    }

    private function check_authority() {
        $this->com_user = $this->session->userdata('session_admin');
        if (!empty($this->com_user)) {
            $this->load->model('m_ijin_trayek');
            $this->load->model('m_ijin_operasi');
            $this->load->model('m_ijin_usaha');
            $this->load->model('m_trayek');
            $this->load->model('m_perusahaan');
            $this->load->model('m_kendaraan');
        } else {
            redirect("admin/login");
        }
    }

    public function ijin_operasi() {
        /* pagination */
        $date_now = date('Y-m-d');
//        $total_row = $this->db->query("select a.*, b.* from tbl_ijin_operasi a join tbl_kendaraan b on a.id_kendaraan = b.no_uji "
//                        . " WHERE a.tanggal_input = '$date_now'")->num_rows();
        $total_row = $this->db->query("select a.*, b.*, c.* from tbl_ijin_operasi a join tbl_perusahaan b on a.id_perusahaan = b.id "
                        . " JOIN tbl_kendaraan c ON c.id_perusahaan = b.id "
                        . " WHERE c.kp_ijin_operasi != '' "
                        . " AND c.tgl_input_ijin_operasi = '$date_now' ")->num_rows();

        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('ijin_trayek_operasi/ijin_operasi/p'));

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));



        $data = array(
            "id_ijin_operasi" => $this->input->post("id_ijin_operasi"),
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "verifikasi" => $this->input->post("verifikasi")
        );

//        $tanggal = date("Y-m-d");
        $tahun = date("Y") + 5;
        $bulan = date("m");
        $hari = date("d");

        $data['masa_berakhir'] = $tahun . "-" . $bulan . "-" . $hari;

        $data_kendaraan = array(
            "kp_ijin_operasi" => $this->input->post("kp_ijin_operasi"),
            "id_perusahaan" => $this->input->post("id_perusahaan")
        );


        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $data_kendaraan_del = array(
                "kp_ijin_operasi" => ""
            );

            $id_ijin_operasi = $this->uri->segment(5);
            $jml_data = $this->db->query("SELECT A.* FROM tbl_kendaraan A join tbl_perusahaan B ON A.id_perusahaan = b.id "
                            . " JOIN tbl_ijin_operasi C on B.id = C.id_perusahaan WHERE C.id_ijin_operasi = '$id_ijin_operasi' AND A.kp_ijin_operasi != ''")->num_rows();

            if ($jml_data == 1) {
                $this->m_ijin_operasi->delete($id_ijin_operasi);
            }

            if ($this->m_kendaraan->update($data_kendaraan_del, $idu)) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been delete. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }

//            $this->db->query("DELETE FROM tbl_ijin_operasi WHERE id_ijin_operasi = '$idu'");
//            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('ijin_trayek_operasi/ijin_operasi');
        } else if ($mau_ke == "del_kendaraan") {
            $id_kendaraan = $this->uri->segment(4);

            $id_ijin_operasi = $this->uri->segment(5);
            $jml_data = $this->db->query("SELECT A.* FROM tbl_kendaraan A join tbl_perusahaan B ON A.id_perusahaan = b.id "
                            . " JOIN tbl_ijin_operasi C on B.id = C.id_perusahaan WHERE C.id_ijin_operasi = '$id_ijin_operasi' AND LENGTH(A.kp_ijin_operasi) > 0 ")->num_rows();

            if ($jml_data == 1) {
                $this->m_ijin_operasi->delete($id_ijin_operasi);
            }

            $data_delete = array(
                "id_perusahaan" => 0
            );

            if ($this->m_kendaraan->update($data_delete, $id_kendaraan)) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been delete. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }

            $id_perusahaan = $this->uri->segment(6);
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['data'] = $this->db->query("SELECT a.*, c.* FROM tbl_kendaraan a JOIN tbl_perusahaan b "
                            . " ON a.id_perusahaan = b.id JOIN tbl_ijin_operasi c ON b.id = c.id_perusahaan WHERE a.id_perusahaan = $id_perusahaan AND LENGTH(a.kp_ijin_operasi) > 0")->result();
            $a['page'] = "ijin_operasi/list_kendaraan_perusahaan";
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("select a.*, b.* from tbl_ijin_operasi a join tbl_kendaraan b on a.id_kendaraan = b.no_uji WHERE LOWER(b.no_kendaraan) LIKE '%$cari%'")->result();
            $a['page'] = "ijin_operasi/list";
        } else if ($mau_ke == "cari_kendaraan") {
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $id_perusahaan = $this->input->post('id_perusahaan');
            $kendaraan = $this->input->post('no_kendaraan');
            $kategory;
            
//            print_r($kendaraan);
//            print_r($id_perusahaan);

            if (empty($id_perusahaan) && empty($kendaraan)) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Pencarian belum diisi. </div>");
            }  else {
                
                if ($id_perusahaan !== 0) {
                    $kategory = "a.id_perusahaan = $id_perusahaan";
                }

                if (!empty($kendaraan)) {
                    $trim_nokendaraan = trim($kendaraan);
                    $kategory = "a.no_kendaraan = '$trim_nokendaraan' ";
                }
                
                $a['data'] = $this->db->query("SELECT a.*, c.* FROM tbl_kendaraan a JOIN tbl_perusahaan b "
                                . " ON a.id_perusahaan = b.id JOIN tbl_ijin_operasi c ON b.id = c.id_perusahaan WHERE " . $kategory . " AND LENGTH(a.kp_ijin_operasi) > 0")->result();
            }
             $a['page'] = "ijin_operasi/list_kendaraan_perusahaan";
        } else if ($mau_ke == "cari_nomer_kendaraan") {
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['kode'] = $this->m_ijin_operasi->buat_kode();
            $a['kode_ijin_operasi'] = $this->m_ijin_operasi->kode_ijin_operasi();

            $no_kendaraan = $this->input->post("no_kendaraan");
            $trim_nokendaraan = trim($no_kendaraan);
            $rawl_nokendaraan = rawurldecode($trim_nokendaraan);
            $a['kendaraan'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE no_uji = '$rawl_nokendaraan' AND (LENGTH(kp_ijin_operasi) = 0 OR kp_ijin_operasi = '' OR kp_ijin_operasi isnull) ")->row_array();

            if (empty($a['kendaraan'])) {
                $this->session->set_flashdata("message_cari", "<div class=\"alert alert-error\" id=\"alert\">Data Tidak ditemukan</div>");
            }
            $a['page'] = "ijin_operasi/search_result";
        } else if ($mau_ke == "add") {
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['kode'] = $this->m_ijin_operasi->buat_kode();
            $a['kode_ijin_operasi'] = $this->m_ijin_operasi->kode_ijin_operasi();
            $a['page'] = "ijin_operasi/input";
        } else if ($mau_ke == "add_kendaraan") {
            $id_perusahaan = $this->uri->segment(5);
            $id_ijin_trayek = $this->uri->segment(4);
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['datpil'] = $this->m_perusahaan->get_detail_perusahaan_by_id($id_perusahaan);
            $a['ijin_operasi'] = $this->m_ijin_operasi->ijin_operasi_by_id($id_ijin_trayek);
            $a['kode'] = $this->m_ijin_operasi->buat_kode();
            $a['kode_ijin_operasi'] = $this->m_ijin_operasi->kode_ijin_operasi();
            $a['action'] = 'add_kendaraan';
            $a['page'] = "ijin_operasi/input_kendaraan";
        } else if ($mau_ke == "edt") {
            $a['sub_title'] = 'Angkutan Barang';
            $a['datpil'] = $this->m_ijin_operasi->get_detail_ijin_operasi($idu);
            $a['page'] = "ijin_operasi/view_ijin_operasi";
        } else if ($mau_ke == "act_add") {
            $data['tanggal_input'] = date('Y-m-d');
            $id_perusahaan = $this->input->post("id_perusahaan");
            $cari_ijin_trayek = $this->db->query("SELECT * FROM tbl_ijin_operasi WHERE id_perusahaan = '$id_perusahaan'")->num_rows();
            if ($cari_ijin_trayek == 0) {
                $save_data = $this->m_ijin_operasi->insert($data);
            }


            $id_perusahaan = $this->input->post("id_perusahaan");
            $total_kendaraan = $this->db->query("SELECT * FROM tbl_kendaraan WHERE id_perusahaan = '$id_perusahaan'")->num_rows();
            if ($total_kendaraan == 0) {
                $data_kendaraan['id_perusahaan'] = $id_perusahaan;
            }
            $data_kendaraan['tgl_input_ijin_operasi'] =  date('Y-m-d');
            $save_data = $this->m_kendaraan->update($data_kendaraan, $this->input->post("id_kendaraan"));
            if ($save_data) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }

            $id_ijin_operasi = $this->input->post("id_ijin_operasi");
            $id_perusahaan = $this->input->post("id_perusahaan");
            redirect('ijin_trayek_operasi/ijin_operasi/add');
//            redirect('ijin_trayek_operasi/ijin_operasi/add_kendaraan/' . trim($id_ijin_operasi) . '/' . $id_perusahaan);
        } else if ($mau_ke == "act_add_kendaraan") {
            $save_data = $this->m_kendaraan->update($data_kendaraan, $this->input->post("id_kendaraan"));
            if ($save_data) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }
            $id_ijin_trayek = $this->input->post("id_ijin_operasi");
            $id_perusahaan = $this->input->post("id_perusahaan");
            redirect('ijin_trayek_operasi/ijin_operasi/add_kendaraan/' . trim($id_ijin_trayek) . '/' . trim($id_perusahaan));
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
            $date_now = date('Y-m-d');
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['data'] = $this->db->query("select a.*, b.*, c.* from tbl_ijin_operasi a join tbl_perusahaan b on a.id_perusahaan = b.id "
                            . " JOIN tbl_kendaraan c ON c.id_perusahaan = b.id "
                            . " WHERE c.kp_ijin_operasi != '' "
                            . " AND c.tgl_input_ijin_operasi = '$date_now' "
                            . " ORDER BY a.id_ijin_operasi DESC "
                            . " LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "ijin_operasi/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    public function cetak() {

        $this->load->view('admin/cetak/surat_ijin_usaha/ijin_usaha');
    }

    public function ijin_trayek() {
        /* pagination */
        $date_now = date('Y-m-d');
        $total_row = $this->db->query("select a.*, b.*, c.* from tbl_ijin_trayek a join tbl_kendaraan b on a.id_perusahaan = b.id_perusahaan"
                        . " JOIN tbl_trayek c ON b.id_trayek = c.id_trayek "
                        . " WHERE b.kp_ijin_trayek != '' AND b.tgl_input_ijin_trayek = '$date_now'")->num_rows();
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
            "id_perusahaan" => $this->input->post("id_perusahaan"),
            "verifikasi" => $this->input->post("verifikasi")
        );

//        $tanggal = date("Y-m-d");
        $tahun = date("Y") + 5;
        $bulan = date("m");
        $hari = date("d");

        $data['masa_berakhir'] = $tahun . "-" . $bulan . "-" . $hari;

        $data_kendaraan = array(
            "id_trayek" => $this->input->post("id_trayek"),
            "kp_ijin_trayek" => $this->input->post("kp_ijin_trayek"),
            "id_perusahaan" => $this->input->post("id_perusahaan")
        );


        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $data_kendaraan_del = array(
                "id_trayek" => 0,
                "kp_ijin_trayek" => ""
            );

            $id_ijin_trayek = $this->uri->segment(5);
            $jml_data = $this->db->query("SELECT A.* FROM tbl_kendaraan A join tbl_perusahaan B ON A.id_perusahaan = b.id "
                            . " JOIN tbl_ijin_trayek C on B.id = C.id_perusahaan WHERE C.id_ijin_trayek = '$id_ijin_trayek' AND A.kp_ijin_trayek != ''")->num_rows();

            if ($jml_data == 1) {
                $this->m_ijin_trayek->delete($id_ijin_trayek);
            }

            if ($this->m_kendaraan->update($data_kendaraan_del, $idu)) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been delete. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }

//            $this->db->query("DELETE FROM tbl_ijin_trayek WHERE id_ijin_trayek = '$idu'");
//            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('ijin_trayek_operasi/ijin_trayek');
        } else if ($mau_ke == "del_kendaraan") {
            $id_kendaraan = $this->uri->segment(4);
            $data_delete = array(
                "id_perusahaan" => 0
            );

            $id_ijin_trayek = $this->uri->segment(5);
            $jml_data = $this->db->query("SELECT A.* FROM tbl_kendaraan A join tbl_perusahaan B ON A.id_perusahaan = b.id "
                            . " JOIN tbl_ijin_trayek C on B.id = C.id_perusahaan WHERE C.id_ijin_trayek = '$id_ijin_trayek' AND LENGTH(A.kp_ijin_trayek) > 0 ")->num_rows();
            if ($jml_data == 1) {
                $this->m_ijin_trayek->delete($id_ijin_trayek);
            }


            if ($this->m_kendaraan->update($data_delete, $id_kendaraan)) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been delete. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }

            $id_perusahaan = $this->uri->segment(6);
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['data'] = $this->db->query("SELECT a.*, c.* FROM tbl_kendaraan a JOIN tbl_perusahaan b "
                            . " ON a.id_perusahaan = b.id JOIN tbl_ijin_trayek c ON b.id = c.id_perusahaan WHERE a.id_perusahaan = $id_perusahaan AND LENGTH(a.kp_ijin_trayek) > 0")->result();

            $a['page'] = "ijin_trayek/list_kendaraan_perusahaan";
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("select a.*, b.*, c.* from tbl_ijin_trayek a join tbl_kendaraan b on a.id_kendaraan = b.no_uji "
                            . " JOIN tbl_trayek c ON a.id_trayek = c.id_trayek WHERE LOWER(b.no_kendaraan) LIKE '%$cari%'")->result();
            $a['page'] = "ijin_trayek/list";
        } else if ($mau_ke == "cari_kendaraan") {
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $id_perusahaan = $this->input->post('id_perusahaan');
            $kendaraan = $this->input->post('no_kendaraan');
            $kategory;
            
//            print_r($kendaraan);
//            print_r($id_perusahaan);

            if (empty($id_perusahaan) && empty($kendaraan)) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Pencarian belum diisi. </div>");
            } else {
                if ($id_perusahaan!== 0) {
                    $kategory = "a.id_perusahaan = $id_perusahaan";
                }

                if (!empty($kendaraan)) {
                    $trim_nokendaraan = trim($kendaraan);
                    $kategory = "a.no_kendaraan = '$trim_nokendaraan' ";
                }

                $a['data'] = $this->db->query("SELECT a.*, c.* FROM tbl_kendaraan a JOIN tbl_perusahaan b "
                                . " ON a.id_perusahaan = b.id JOIN tbl_ijin_trayek c ON b.id = c.id_perusahaan WHERE ". $kategory." AND LENGTH(a.kp_ijin_trayek) > 0")->result();
            }
            $a['page'] = "ijin_trayek/list_kendaraan_perusahaan";
        } else if ($mau_ke == "cari_nomer_kendaraan") {
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['kode_trayek'] = $this->db->query("select * from tbl_trayek")->result();
            $a['kode'] = $this->m_ijin_trayek->buat_kode();
            $a['kode_ijin_trayek'] = $this->m_ijin_trayek->kode_ijin_trayek();
            $a['action'] = "search_kendaraan";

            $no_kendaraan = $this->input->post("no_kendaraan");
            $trim_nokendaraan = trim($no_kendaraan);
            $rawl_nokendaraan = rawurldecode($trim_nokendaraan);
            $a['kendaraan'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE RTRIM(no_uji) = '$rawl_nokendaraan' AND (LENGTH(kp_ijin_trayek) = 0 OR kp_ijin_trayek = '' OR kp_ijin_trayek isnull)")->row_array();
            if (empty($a['kendaraan'])) {
                $this->session->set_flashdata("message_cari", "<div class=\"alert alert-error\" id=\"alert\">Data Tidak ditemukan</div>");
            }
            $a['page'] = "ijin_trayek/input";
        } else if ($mau_ke == "add") {
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['kode_trayek'] = $this->db->query("select * from tbl_trayek")->result();
            $a['kode'] = $this->m_ijin_trayek->buat_kode();
            $a['kode_ijin_trayek'] = $this->m_ijin_trayek->kode_ijin_trayek();
            $a['action'] = "";
            $a['page'] = "ijin_trayek/input";
        } else if ($mau_ke == "add_kendaraan") {
            $id_perusahaan = $this->uri->segment(5);
            $id_ijin_trayek = $this->uri->segment(4);
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['kode_trayek'] = $this->db->query("select * from tbl_trayek")->result();
            $a['datpil'] = $this->m_perusahaan->get_detail_perusahaan_by_id($id_perusahaan);
            $a['ijin_trayek'] = $this->m_ijin_trayek->ijin_trayek_by_id($id_ijin_trayek);
            $a['kode'] = $this->m_ijin_trayek->buat_kode();
            $a['kode_ijin_trayek'] = $this->m_ijin_trayek->kode_ijin_trayek();
            $a['page'] = "ijin_trayek/input_kendaraan";
        } else if ($mau_ke == "edt") {
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['kode_trayek'] = $this->db->query("select * from tbl_trayek")->result();
            $a['sub_title'] = 'Angkutan Barang';
            $a['datpil'] = $this->m_ijin_trayek->get_detail_ijin_trayek($idu);
            $a['page'] = "ijin_trayek/view_ijin_trayek";
        } else if ($mau_ke == "act_add") {
            $data['tanggal_input'] = date('Y-m-d');
            $id_perusahaan = $this->input->post("id_perusahaan");
            $cari_ijin_trayek = $this->db->query("SELECT * FROM tbl_ijin_trayek WHERE id_perusahaan = '$id_perusahaan'")->num_rows();
            if ($cari_ijin_trayek == 0) {
                $save_data = $this->m_ijin_trayek->insert($data);
            }

            $data_kendaraan['tgl_input_ijin_trayek'] =  date('Y-m-d');
            $save_data = $this->m_kendaraan->update($data_kendaraan, $this->input->post("id_kendaraan"));
            if ($save_data) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }

            $id_ijin_trayek = $this->input->post("id_ijin_trayek");
            $id_perusahaan = $this->input->post("id_perusahaan");
            redirect('ijin_trayek_operasi/ijin_trayek/add');
//            redirect('ijin_trayek_operasi/ijin_trayek/add_kendaraan/' . $id_ijin_trayek . '/' . $id_perusahaan);
        } else if ($mau_ke == "act_add_kendaraan") {
            $save_data = $this->m_kendaraan->update($data_kendaraan, $this->input->post("id_kendaraan"));
            if ($save_data) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }
            $id_ijin_trayek = $this->input->post("id_ijin_trayek");
            $id_perusahaan = $this->input->post("id_perusahaan");
            redirect('ijin_trayek_operasi/ijin_trayek/add_kendaraan/' . trim($id_ijin_trayek) . '/' . trim($id_perusahaan));
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
            $date_now = date('Y-m-d');
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
//            $a['data'] = $this->db->query("select a.*, b.*, c.* from tbl_ijin_trayek a join tbl_kendaraan b on a.id_perusahaan = b.id_perusahaan"
//                            . " JOIN tbl_trayek c ON b.id_trayek = c.id_trayek "
//                            . " WHERE b.kp_ijin_trayek != '' "
//                            . " ORDER BY a.id_ijin_trayek DESC "
//                            . " LIMIT $akhir OFFSET $awal ")->result();


            $a['data'] = $this->db->query("select a.*, b.*, c.*, d.* from tbl_ijin_trayek a join tbl_perusahaan b on a.id_perusahaan = b.id "
                            . " JOIN tbl_kendaraan c ON c.id_perusahaan = b.id "
                            . " JOIN tbl_trayek d ON d.id_trayek = c.id_trayek "
                            . " WHERE c.kp_ijin_trayek != '' "
                            . " AND c.tgl_input_ijin_trayek = '$date_now' "
                            . " ORDER BY a.id_ijin_trayek DESC "
                            . " LIMIT $akhir OFFSET $awal ")->result();

            $a['page'] = "ijin_trayek/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    function cari_kendaraan() {
        $keyword = $this->uri->segment(3);
        $keyword_rawurl = rawurldecode($keyword);

        // cari di database
//        $data = $this->db->from('tbl_kendaraan')->like('LOWER(no_uji)', $keyword)->get();

        $data = $this->db->query("SELECT * FROM tbl_kendaraan WHERE LOWER(no_kendaraan) LIKE '%$keyword_rawurl%'");

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->no_kendaraan . " - " . $row->nama_pemilik,
                'no_uji' => $row->no_uji
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

    function cari_kendaraan_kp($params) {
        $keyword = $this->uri->segment(3);
        $keywordlower = strtolower($keyword);
//        OR LOWER(a.no_kendaraan) LIKE '%$keyword%'

        $data = $this->db->query("SELECT A.*, B.*, C.* FROM tbl_kendaraan A JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                . "  LEFT JOIN tb_note_kendaraan C ON a.no_uji=c.id_kendaraan WHERE (A.kp_ijin_trayek != '' OR A.kp_ijin_operasi !='') AND lower(A.no_kendaraan) LIKE '%$keywordlower%'");

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keywordlower;
            $arr['suggestions'][] = array(
                'value' => $row->no_kendaraan,
                'kp_ijin_trayek' => $row->kp_ijin_trayek,
                'kp_ijin_operasi' => $row->kp_ijin_operasi,
                'no_kendaraan' => $row->no_kendaraan,
                'masa_berlaku' => $row->tgl_mati_uji,
                'no_trayek' => $row->id_trayek,
                'nama_pemilik' => $row->nama_pemilik,
                'alamat_pemilik' => $row->alamat,
                'nama_perusahaan' => $row->nama_perusahaan,
                'no_uji' => $row->no_uji,
                'catatan' => $row->catatan,
                'last_update' => $row->masa_berlaku,
                'post_by' => $row->post_by
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

    function cari_kendaraan_kp_operasi() {
        $keyword = $this->uri->segment(3);
        $keywordlower = strtolower($keyword);
//        OR LOWER(a.no_kendaraan) LIKE '%$keyword%'
        $data = $this->db->query("SELECT A.*, B.*, C.* FROM tbl_kendaraan A JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                . " LEFT JOIN tb_note_kendaraan C ON a.no_uji=c.id_kendaraan WHERE lower(A.kp_ijin_operasi) LIKE '%$keywordlower%'");

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $arr['query'] = $keywordlower;
            $arr['suggestions'][] = array(
                'value' => $row->kp_ijin_operasi,
                'no_kendaraan' => $row->no_kendaraan,
                'masa_berlaku' => $row->tgl_mati_uji,
                'no_trayek' => $row->id_trayek,
                'nama_pemilik' => $row->nama_pemilik,
                'alamat_pemilik' => $row->alamat,
                'nama_perusahaan' => $row->nama_perusahaan,
                'no_uji' => $row->no_uji,
                'catatan' => $row->catatan,
                'last_update' => $row->masa_berlaku,
                'post_by' => $row->post_by
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

        if (empty($jenis) || $jenis == NULL) {
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

    function perusahaan_combo() {
        $id_perusahaan = $this->input->post("id");
        $perusahaan = $this->m_perusahaan->get_detail_perusahaan_by_id($id_perusahaan);

        $data = "<tr><td width='60%'>Nama Perusahaan</td><td><b><input type='text' value='$perusahaan[nama_perusahaan]' style='width: 300px' class='form-control' readonly></b></td></tr>";
        $data .= "<tr><td width='60%'>Alamat Perusahaan</td><td><b><input type='text' value='$perusahaan[alamat_perusahaan]' style='width: 300px' class='form-control' readonly></b></td></tr>";
        echo $data;
    }

    function daftar_surat_ijin() {
        $total_row = $this->m_ijin_operasi->total_ijin_operasi_now();
//        print_r($total_row);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('ijin_trayek_operasi/daftar_surat_ijin/p'));

        $a['data'] = $this->m_ijin_operasi->get_all_ijin_operasi_limits(array($akhir, $awal));
        $a['page'] = "ijin_operasi/list_surat_ijin";

        $this->load->view('admin/dashboard', $a);
    }

    function daftar_surat_ijin_trayek() {
        $total_row = $this->m_ijin_operasi->total_ijin_trayek_now();
//        print_r($total_row);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('ijin_trayek_operasi/daftar_surat_ijin/p'));

        $a['data'] = $this->m_ijin_operasi->get_all_ijin_trayek_limits(array($akhir, $awal));
        $a['page'] = "ijin_trayek/list_surat_ijin";

        $this->load->view('admin/dashboard', $a);
    }

    function cetak_ijin_operasi($id) {
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $a['data'] = $this->m_ijin_operasi->detail_cetak_operasi($id);
        $a['total_kendaraan'] = $this->m_ijin_operasi->get_total_kendaraan($id);
        $a['data_kendaraan'] = $this->m_ijin_operasi->get_all_kendaraan_by_id_perusahaan($id);
        $a['date_manipulation'] = $this->datetimemanipulation;
        $this->load->view('admin/cetak/surat_ijin_operasi/print.php', $a);
    }

    function cetak_ijin_trayek($id) {
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $a['data'] = $this->m_ijin_operasi->detail_cetak_trayek($id);
        $a['total_kendaraan'] = $this->m_ijin_operasi->get_total_kendaraan_trayek($id);
        $a['data_kendaraan'] = $this->m_ijin_operasi->get_all_kendaraan_by_id_perusahaan_trayek($id);
        $a['date_manipulation'] = $this->datetimemanipulation;
        $this->load->view('admin/cetak/surat_ijin_trayek/print.php', $a);
    }

}
