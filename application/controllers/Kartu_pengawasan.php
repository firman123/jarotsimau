<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kartu_pengawasan
 *
 * @author Ihtiyar
 */
class Kartu_pengawasan extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();

        $this->load->model('m_kendaraan');
        $this->load->model('m_perusahaan');
        $this->load->model('m_trayek');
        $this->load->model('m_kartu_pengawas');
    }

    public function trayek() {
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

        //upload config 
        $config['upload_path'] = 'upload/kartu_pengawas/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';

        $this->load->library('upload', $config);

        $data = array(
            "id_kp" => $this->input->post("id_kp"),
            "id_kendaraan" => $this->input->post("no_uji"),
            "no_ktp" => $this->input->post("no_ktp"),
            "nama_pengemudi" => $this->input->post("nama_pengemudi"),
            "alamat" => $this->input->post("alamat")
        );
        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM tbl_kartu_pengawasan WHERE id = '$idu'");
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('kartu_pengawasan/trayek');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE nama_pemilik LIKE '%$cari%'")->result();
            $a['page'] = "kendaraan/list";
        } else if ($mau_ke == "add") {
            $a['label'] = "Kartu Pengawasan Trayek";
            $a['type'] = "Trayek";
            $a['path'] = "trayek";
            $a['page'] = "kartu_pengawasan/input";
        } else if ($mau_ke == "edt") {
            $a['path'] = "trayek";
            $a['datpil'] = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE id = '$idu'")->row_array();

            $id_kendaraan = $this->db->query("SELECT id_kendaraan FROM tbl_kartu_pengawasan WHERE id = '$idu'")->row();

            $no_uji = trim($id_kendaraan->id_kendaraan);

            $a['data_kendaraan'] = $this->db->query("SELECT a.*, a.alamat as alamat_pemilik, b.* , c.*, d.*, e.* FROM tbl_kendaraan a JOIN tbl_ijin_trayek b"
                            . " ON a.no_uji = b.id_kendaraan JOIN tbl_perusahaan c ON b.id_perusahaan = c.id "
                            . " JOIN tbl_trayek e ON b.id_trayek = e.id_trayek "
                            . " LEFT JOIN tb_note_kendaraan d ON a.no_uji  = d.id_kendaraan "
                            . " WHERE a.no_uji = '$no_uji'")->row_array();

//            print_r($no_uji);
//            print_r($a['data_kendaraan']);
            $a['page'] = "kartu_pengawasan/input";
        } else if ($mau_ke == "act_add") {
            $id_kendaraan = $this->input->post("no_uji");
            $no_ktp = $this->input->post("no_ktp");
            $jumlah_sopir = $this->db->query("SELECT a.* FROM tbl_kartu_pengawasan a JOIN tbl_ijin_trayek b ON a.id_kp = b.id_ijin_trayek WHERE a.id_kendaraan = '$id_kendaraan'")->num_rows();

            $ktp_available = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE no_ktp = '$no_ktp'")->num_rows();

            if ($jumlah_sopir > 1) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, jumlah supir maksimal 2. </div>");
            } else {
                if ($ktp_available > 0) {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, KTP Sudah digunakan </div>");
                } else {
                    if ($this->upload->do_upload('foto')) {
                        $up_data = $this->upload->data();
                        $data['create_date'] = date("Y-m-d");
                        $data['foto'] = $up_data['file_name'];

                        $save_data = $this->m_kartu_pengawas->insert($data);
                    } else {
                        $save_data = $this->m_kartu_pengawas->insert($data);
                    }

                    if ($save_data) {
                        $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
                    } else {
                        $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
                    }
                }
            }
            redirect('kartu_pengawasan/trayek');
        } else if ($mau_ke == "act_edt") {
            $id_kendaraan = $this->input->post("no_uji");
            $no_ktp = $this->input->post("no_ktp");
            $jumlah_sopir = $this->db->query("SELECT a.* FROM tbl_kartu_pengawasan a JOIN tbl_ijin_trayek b ON a.id_kp = b.id_ijin_trayek WHERE a.id_kendaraan = '$id_kendaraan'")->num_rows();

            $ktp_available = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE no_ktp = '$no_ktp'")->num_rows();


            if ($ktp_available > 0) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, KTP Sudah digunakan </div>");
            } else {
                if ($this->upload->do_upload('foto')) {
                    $up_data = $this->upload->data();
                    $data['create_date'] = date("Y-m-d");
                    $data['foto'] = $up_data['file_name'];

                    $save_data = $this->m_kartu_pengawas->update($data, $this->input->post("id"));
                } else {
                    $save_data = $this->m_kartu_pengawas->update($data, $this->input->post("id"));
                }

                if ($save_data) {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
                } else {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
                }
            }

            redirect('kartu_pengawasan/trayek');
        } else {
            $a['path'] = "trayek";
            $a['label'] = "Kartu Pengawasan Trayek";
            $a['type'] = "Trayek";
            $a['data'] = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE id_kp LIKE 'KPIT%' ORDER BY id DESC LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "kartu_pengawasan/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    public function operasi() {
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

        //upload config 
        $config['upload_path'] = 'upload/kartu_pengawas/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';

        $this->load->library('upload', $config);

        $data = array(
            "id_kendaraan" => $this->input->post("no_uji"),
            "no_ktp" => $this->input->post("no_ktp"),
            "nama_pengemudi" => $this->input->post("nama_pengemudi"),
            "alamat" => $this->input->post("alamat")
        );
        //ambil variabel Postingan
        $cari = addslashes($this->input->post('q'));

        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM tbl_kartu_pengawasan WHERE id = '$idu'");
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('kartu_pengawasan/operasi');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM tbl_kendaraan WHERE nama_pemilik LIKE '%$cari%'")->result();
            $a['page'] = "kendaraan/list";
        } else if ($mau_ke == "add") {
            $a['label'] = "Kartu Pengawasan Trayek";
            $a['type'] = "Trayek";
            $a['path'] = "trayek";
            $a['page'] = "kartu_pengawasan/input_operasi";
        } else if ($mau_ke == "edt") {
            $a['path'] = "trayek";
            $a['datpil'] = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE id = '$idu'")->row_array();

            $id_kendaraan = $this->db->query("SELECT id_kendaraan FROM tbl_kartu_pengawasan WHERE id = '$idu'")->row();

            $no_uji = trim($id_kendaraan->id_kendaraan);

            $a['data_kendaraan'] = $this->db->query("SELECT a.*, a.alamat as alamat_pemilik, b.* , c.*, d.*, e.* FROM tbl_kendaraan a JOIN tbl_ijin_trayek b"
                            . " ON a.no_uji = b.id_kendaraan JOIN tbl_perusahaan c ON b.id_perusahaan = c.id "
                            . " JOIN tbl_trayek e ON b.id_trayek = e.id_trayek "
                            . " LEFT JOIN tb_note_kendaraan d ON a.no_uji  = d.id_kendaraan "
                            . " WHERE a.no_uji = '$no_uji'")->row_array();

//            print_r($no_uji);
//            print_r($a['data_kendaraan']);
            $a['page'] = "kartu_pengawasan/input_operasi";
        } else if ($mau_ke == "act_add") {
            $id_kendaraan = $this->input->post("no_uji");
            $no_ktp = $this->input->post("no_ktp");
            $jumlah_sopir = $this->db->query("SELECT a.* FROM tbl_kartu_pengawasan a JOIN tbl_ijin_trayek b ON a.id_kp = b.id_ijin_trayek WHERE a.id_kendaraan = '$id_kendaraan'")->num_rows();

            $ktp_available = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE no_ktp = '$no_ktp'")->num_rows();

            if ($jumlah_sopir > 1) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, jumlah supir maksimal 2. </div>");
            } else {
                if ($ktp_available > 0) {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, KTP Sudah digunakan </div>");
                } else {
                    if ($this->upload->do_upload('foto')) {
                        $up_data = $this->upload->data();
                        $data['create_date'] = date("Y-m-d");
                        $data['foto'] = $up_data['file_name'];

                        $save_data = $this->m_kartu_pengawas->insert($data);
                    } else {
                        $save_data = $this->m_kartu_pengawas->insert($data);
                    }

                    if ($save_data) {
                        $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
                    } else {
                        $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
                    }
                }
            }
            redirect('kartu_pengawasan/operasi');
        } else if ($mau_ke == "act_edt") {
            $id_kendaraan = $this->input->post("no_uji");
            $no_ktp = $this->input->post("no_ktp");
            $jumlah_sopir = $this->db->query("SELECT a.* FROM tbl_kartu_pengawasan a JOIN tbl_ijin_trayek b ON a.id_kp = b.id_ijin_trayek WHERE a.id_kendaraan = '$id_kendaraan'")->num_rows();

            $ktp_available = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE no_ktp = '$no_ktp'")->num_rows();


            if ($ktp_available > 0) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, KTP Sudah digunakan </div>");
            } else {
                if ($this->upload->do_upload('foto')) {
                    $up_data = $this->upload->data();
                    $data['create_date'] = date("Y-m-d");
                    $data['foto'] = $up_data['file_name'];

                    $save_data = $this->m_kartu_pengawas->update($data, $this->input->post("id"));
                } else {
                    $save_data = $this->m_kartu_pengawas->update($data, $this->input->post("id"));
                }

                if ($save_data) {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
                } else {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
                }
            }

            redirect('kartu_pengawasan/operasi');
        } else {
            $a['path'] = "operasi";
            $a['label'] = "Kartu Pengawasan Operasi";
            $a['type'] = "Operasi";
            $a['data'] = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE id_kp LIKE 'KPIO%' ORDER BY id DESC LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "kartu_pengawasan/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

}
