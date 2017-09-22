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

    protected $com_user;

    //put your code here

    public function __construct() {
        parent::__construct();
        self::check_authority();

        $this->load->library('ciqrcode');
        $this->load->library('fpdf');
    }

    private function check_authority() {
        $this->com_user = $this->session->userdata('session_admin');
        if (!empty($this->com_user)) {
            $this->load->model('m_kendaraan');
            $this->load->model('m_perusahaan');
            $this->load->model('m_trayek');
            $this->load->model('m_kartu_pengawas');
        } else {
            redirect("admin/login");
        }
    }

    public function trayek() {


        /* pagination */
        $total_row = $this->db->query("SELECT a.* , b.* FROM tbl_kendaraan a join tbl_kartu_pengawasan b "
                        . " ON a.no_uji = b.id_kendaraan WHERE b.id_kp LIKE 'KPIT%' ")->num_rows();
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
        $config['max_size'] = '20000';

        $this->load->library('upload', $config);

        $data = array(
            "id_kp" => $this->input->post("no_kp"),
            "id_kendaraan" => $this->input->post("no_uji"),
            "no_ktp" => $this->input->post("no_ktp"),
            "nama_pengemudi" => $this->input->post("nama_pengemudi"),
            "alamat" => $this->input->post("alamat"),
            "masa_berlaku" => $this->input->post("masa_berlaku_ijin_trayek")
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
        } else if ($mau_ke == "cari_nomer_kendaraan") {
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['label'] = "Kartu Pengawasan Trayek";
            $a['action'] = "search_kendaraan";
            $a['path'] = "trayek";
            $no_kendaraan = $this->input->post("no_kendaraan");
            $trim_nokendaraan = trim($no_kendaraan);
            $rawl_nokendaraan = rawurldecode($trim_nokendaraan);
            $a['kendaraan'] = $this->db->query("SELECT A.*, B.*, C.* FROM tbl_kendaraan A JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                            . "  LEFT JOIN tb_note_kendaraan C ON a.no_uji=c.id_kendaraan WHERE A.kp_ijin_trayek != '' AND A.no_kendaraan = '$rawl_nokendaraan'")->row_array();
            if (empty($a['kendaraan'])) {

                $this->session->set_flashdata("message_cari", "<div class=\"alert alert-error\" id=\"alert\">Data Tidak ditemukan</div>");
            }
            $a['page'] = "kartu_pengawasan/search_result";
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
            $no_uji2 = rawurldecode($no_uji);

            $a['data_kendaraan'] = $this->db->query("SELECT A.*, A.alamat as alamat_pemilik, B.*, B.masa_berlaku as masa_berlaku_ijin , C.* FROM tbl_kendaraan A JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                            . "  LEFT JOIN tb_note_kendaraan C ON a.no_uji=c.id_kendaraan WHERE A.no_uji = '$no_uji2'")->row_array();
            $a['label'] = "Trayek";
//            print_r($no_uji);
//            print_r($a['data_kendaraan']);
            $a['page'] = "kartu_pengawasan/view_kp";
        } else if ($mau_ke == "act_add") {
            $id_kendaraan = $this->input->post("no_uji");
            $no_ktp = $this->input->post("no_ktp");
            $jumlah_sopir = $this->db->query("SELECT * FROM tbl_kartu_pengawasan  WHERE id_kendaraan = '$id_kendaraan'")->num_rows();

            $ktp_available = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE no_ktp = '$no_ktp'")->num_rows();

            if ($jumlah_sopir > 1) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, jumlah supir maksimal 2. </div>");
            } else {
                if ($ktp_available > 0) {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, KTP Sudah digunakan </div>");
                } else {
                    $data['create_date'] = date("Y-m-d");

                    if (isset($_FILES['foto']['tmp_name']) && !empty($_FILES['foto']['tmp_name'])) {
                        if (isset($_FILES['foto']['size']) > 20000) {
                            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Upload Gagal, Maximal 20MB </div>");
                        } else {
                            if ($this->upload->do_upload('foto')) {
                                $up_data = $this->upload->data();

                                $data['foto'] = $up_data['file_name'];

                                $save_data = $this->m_kartu_pengawas->insert($data);
                            }

                            if ($save_data) {
                                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
                            } else {
                                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Upload Gagal, Maximal 2MB </div>");
                            }
                        }
                    } else {
                        $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Foto tidak boleh kosong </div>");
                    }
                }
            }
            redirect('kartu_pengawasan/trayek/add');
        } else if ($mau_ke == "act_edt") {
            $id_kendaraan = $this->input->post("no_uji");

            $no_ktp = $this->input->post("no_ktp");
            $no_ktp_lama = $this->input->post("no_ktp_lama");

            $jumlah_sopir = $this->db->query("SELECT a.* FROM tbl_kartu_pengawasan a JOIN tbl_ijin_trayek b ON a.id_kp = b.id_ijin_trayek WHERE a.id_kendaraan = '$id_kendaraan'")->num_rows();

            if (trim(trim($no_ktp) != trim($no_ktp_lama))) {
                $ktp_available = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE no_ktp = '$no_ktp'")->num_rows();
                if ($ktp_available > 0) {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, KTP Sudah digunakan </div>");
                } else {
                    $data['create_date'] = date("Y-m-d");
                    if ($this->upload->do_upload('foto')) {
                        $up_data = $this->upload->data();
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
//            $a['data'] = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE id_kp LIKE 'KPIT%' ORDER BY id DESC LIMIT $akhir OFFSET $awal ")->result();
            $a['data'] = $this->db->query("SELECT a.* , b.* FROM tbl_kendaraan a join tbl_kartu_pengawasan b "
                            . " ON a.no_uji = b.id_kendaraan WHERE b.id_kp LIKE 'KPIT%' ORDER BY b.id DESC LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "kartu_pengawasan/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    public function operasi() {
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
            "id_kp" => $this->input->post("no_kp"),
            "id_kendaraan" => $this->input->post("no_uji"),
            "no_ktp" => $this->input->post("no_ktp"),
            "nama_pengemudi" => $this->input->post("nama_pengemudi"),
            "alamat" => $this->input->post("alamat"),
            "masa_berlaku" => $this->input->post("masa_berlaku_ijin_operasi")
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
        } else if ($mau_ke == "cari_nomer_kendaraan") {
            $a['list_perusahaan'] = $this->db->query("select * from tbl_perusahaan")->result();
            $a['label'] = "Kartu Pengawasan Trayek";
            $a['action'] = "search_kendaraan";
            $a['path'] = "operasi";
            $no_kendaraan = $this->input->post("no_kendaraan");
            $trim_nokendaraan = trim($no_kendaraan);
            $rawl_nokendaraan = rawurldecode($trim_nokendaraan);
            $a['kendaraan'] = $this->db->query("SELECT A.*, B.*, C.* FROM tbl_kendaraan A LEFT JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                            . "  LEFT JOIN tb_note_kendaraan C ON a.no_uji=c.id_kendaraan WHERE  A.kp_ijin_operasi !='' AND A.no_kendaraan = '$rawl_nokendaraan'")->row_array();

            if (empty($a['kendaraan'])) {

                $this->session->set_flashdata("message_cari", "<div class=\"alert alert-error\" id=\"alert\">Data Tidak ditemukan</div>");
            }
            $a['page'] = "kartu_pengawasan/search_result_operasi";
        } else if ($mau_ke == "add") {
            $a['label'] = "Kartu Pengawasan Trayek";
            $a['type'] = "Operasi";
            $a['path'] = "operasi";
            $a['page'] = "kartu_pengawasan/input_operasi";
        } else if ($mau_ke == "edt") {
            $a['path'] = "operasi";
            $a['datpil'] = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE id = '$idu'")->row_array();

            $id_kendaraan = $this->db->query("SELECT id_kendaraan FROM tbl_kartu_pengawasan WHERE id = '$idu'")->row();

            $no_uji = trim($id_kendaraan->id_kendaraan);

//            $a['data_kendaraan'] = $this->db->query("SELECT A.*, B.*, C.* FROM tbl_kendaraan A JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
//                            . " LEFT JOIN tb_note_kendaraan C ON a.no_uji=c.id_kendaraan WHERE lower(A.kp_ijin_operasi) "
//                            . " WHERE A.no_uji = '$no_uji'")->row_array();
            $a['data_kendaraan'] = $this->db->query("SELECT A.*, A.alamat as alamat_pemilik, B.*, B.masa_berlaku as masa_berlaku_ijin , C.* FROM tbl_kendaraan A JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                            . "  LEFT JOIN tb_note_kendaraan C ON a.no_uji=c.id_kendaraan WHERE A.no_uji = '$no_uji'")->row_array();
            $a['label'] = "Operasi";
//            print_r($no_uji);
//            print_r($a['data_kendaraan']);
            $a['page'] = "kartu_pengawasan/view_kp";
        } else if ($mau_ke == "act_add") {
            $id_kendaraan = $this->input->post("no_uji");
            $id_kendaraan_trim = trim($id_kendaraan);
            $no_ktp = $this->input->post("no_ktp");
            $jumlah_sopir = $this->db->query("SELECT a.* FROM tbl_kartu_pengawasan a JOIN tbl_ijin_trayek b ON a.id_kp = b.id_ijin_trayek WHERE a.id_kendaraan = '$id_kendaraan_trim'")->num_rows();

            $ktp_available = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE no_ktp = '$no_ktp'")->num_rows();

            if ($jumlah_sopir > 1) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, jumlah supir maksimal 2. </div>");
            } else {
                if ($ktp_available > 0) {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, KTP Sudah digunakan </div>");
                } else {
                    $data['create_date'] = date("Y-m-d");
                    if ($this->upload->do_upload('foto')) {
                        $up_data = $this->upload->data();
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
            redirect('kartu_pengawasan/operasi/add');
        } else if ($mau_ke == "act_edt") {
            $id_kendaraan = $this->input->post("no_uji");
            $no_ktp = $this->input->post("no_ktp");
            $jumlah_sopir = $this->db->query("SELECT a.* FROM tbl_kartu_pengawasan a JOIN tbl_ijin_trayek b ON a.id_kp = b.id_ijin_trayek WHERE a.id_kendaraan = '$id_kendaraan'")->num_rows();

            $ktp_available = $this->db->query("SELECT * FROM tbl_kartu_pengawasan WHERE no_ktp = '$no_ktp'")->num_rows();


            if ($ktp_available > 0) {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!, KTP Sudah digunakan </div>");
            } else {
                $data['create_date'] = date("Y-m-d");
                if ($this->upload->do_upload('foto')) {
                    $up_data = $this->upload->data();
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
            $a['data'] = $this->db->query("SELECT a.*, b.* FROM tbl_kendaraan a join tbl_kartu_pengawasan b "
                            . " ON a.no_uji = b.id_kendaraan WHERE b.id_kp LIKE 'KPIO%' ORDER BY b.id DESC LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "kartu_pengawasan/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    public function cetak_kartu_pengemudi($id) {
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $SQL = "SELECT a.*, b.no_kendaraan, b.no_uji, c.nama_perusahaan, d.kd_trayek "
                . " from tbl_kartu_pengawasan a JOIN tbl_kendaraan b ON a.id_kendaraan = b.no_uji "
                . " left JOIN tbl_perusahaan c ON b.id_perusahaan = c.id "
                . " LEFT JOIN tbl_trayek d ON d.id_trayek = b.id_trayek WHERE a.id = $id";
        $a['datpil'] = $this->db->query($SQL)->row();

        $data_gambar = $a['datpil']->foto;
        if ($data_gambar == null) {
//            $a['poto_sopir'] = getcwd() . '/upload/noimage.jpg';
            $a['poto_sopir'] = base_url() . 'upload/noimage.jpg';
        } else {
            $foto_trim = trim($data_gambar);
//            $a['poto_sopir'] = getcwd() . "/upload/kartu_pengawas/" . $foto_trim;
            $a['poto_sopir'] = base_url() . "upload/kartu_pengawas/" . $foto_trim;
        }

//        print_r($a['poto_sopir']);


        $data_qr = "http://integratesystem.id/display/info_pengemudi.php?no_uji=" . $a['datpil']->no_uji;
        $qr['data'] = $data_qr;

        $qr['level'] = 'H';
        $qr['size'] = 10;
        $qr['savename'] = FCPATH . 'qr.png';
        $this->ciqrcode->generate($qr);

        $this->load->view('admin/cetak/kartu_pengemudi/print.php', $a);
    }

    public function scan_kp() {
        $this->load->view('admin/scan/scan_kp.php');
    }

}
