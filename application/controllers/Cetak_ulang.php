<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cetak_ulang
 *
 * @author Ihtiyar
 */
class Cetak_ulang extends CI_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        self::check_authority();
    }

    private function check_authority() {
        $this->com_user = $this->session->userdata('session_admin');
        if (!empty($this->com_user)) {
            $this->load->model('m_cetak_ulang');
            $this->load->model('m_pemeriksaan');
            $this->load->model('m_kuitansi');
            $this->load->model('m_pemeriksaan');

            $this->load->library('ciqrcode');
            $this->load->library("datetimemanipulation");
            $this->load->library('fpdf');
        } else {
            redirect("admin/login");
        }
    }

    public function index() {
        $total_row = $this->m_cetak_ulang->get_total_cetak_ulang(0);
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('cetak_ulang/index/p'));
        $a['data'] = $this->m_cetak_ulang->get_cetak_ulang_all(3, $akhir, $awal);
        $a['page'] = "cetak_ulang/list";

        $this->load->view('admin/dashboard', $a);
    }

    public function input() {
        $a['page'] = "cetak_ulang/input";
        $this->load->view('admin/dashboard', $a);
    }

    public function cari_kendaraan() {
        $no_kendaraan = $this->input->post("no_kendaraan");
        $trim_nokendaraan = trim($no_kendaraan);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);
        $a['kendaraan'] = $this->m_cetak_ulang->cari_kendaraan($rawl_nokendaraan);
        $a['page'] = "cetak_ulang/search_result";
        $this->load->view('admin/dashboard', $a);
    }

    public function act_add() {
        $data = array(
            "id_kendaraan" => $this->input->post("id_kendaraan"),
            "tanggal" => date("Y-m-d"),
            "verifikasi" => 0
        );

        $a['data'] = $this->m_cetak_ulang->cek_kendaraan_available($this->input->post("id_kendaraan"));
        if (empty($a['data'])) {
            if ($this->m_cetak_ulang->insert($data)) {
                $id_kp = $this->input->post("no_kp");
                $id_kendaraan = $this->input->post("id_kendaraan");
                $this->insert_kwitansi($id_kp, $id_kendaraan, 4);
                $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added. </div>");
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
            }
        } else {
            echo "<script>alert('Gagal! data kendaraan sudah ada!');</script>";
        }



        $a['page'] = "cetak_ulang/input";
        $this->load->view('admin/dashboard', $a);
    }

    public function insert_kwitansi($idKp, $id_kendaraan, $idBiaya) {

        $data_kuitansi = $this->m_kuitansi->cek_kuitansi_by_tanggal(array($idKp, date('Y-m-d')));
        if (empty($data_kuitansi)) {
            $admin_id = $this->com_user['admin_id'];

            $no_nota = $this->m_pemeriksaan->no_kwitansi();
            $data = array(
                "kp_ijin" => $idKp,
                "tanggal" => date("Y-m-d"),
                "id_admin" => $admin_id,
                "id_kwitansi" => $no_nota,
                "id_kendaraan" => $id_kendaraan,
                "id_biaya_kwitansi" => $idBiaya
            );

            $save_kuitansi = $this->m_kuitansi->insertCetak($data);
        }
    }

    public function act_delete($id_cetak_ulang) {
        if ($this->m_cetak_ulang->delete($id_cetak_ulang)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed </div>");
        }

        redirect('cetak_ulang/index');
    }

    public function print_kwitansi_trayek($no_uji) {
        $id_cheklist = $this->get_checklist_id($no_uji);

        if ($id_cheklist != 0) {
            ob_start();

            $SQL = "SELECT b.*, a.kp_ijin_trayek as kp_ijin_trayek, a.id_kendaraan as id_kendaraan FROM tbl_checklist_kendaraan c "
                    . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                    . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                    . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                    . " WHERE c.id_checklist = $id_cheklist";

            $SQL2 = "SELECT * FROM tbl_kuitansi where id_kwitansi = 3";
            $a['title_kwitansi'] = 'Retribusi cetak kartu yang hilang';
            $a['datpil'] = $this->db->query($SQL)->row();
            $a['kuitansi'] = $this->db->query($SQL2)->row();
            $a['tanggal_cetak'] = date("Y-m-d");
            $a['date_manipulation'] = $this->datetimemanipulation;

            $no_kp = $a['datpil']->kp_ijin_trayek;
            $id_kendaraan = $a['datpil']->id_kendaraan;
//        $this->insertKwitansi($no_kp, $id_kendaraan, 1);

            $this->load->view('admin/cetak/kwitansi/general/print', $a);
            $html = ob_get_contents();
            ob_end_clean();

            require_once('./aset/html2pdf/html2pdf.class.php');
            $pdf = new HTML2PDF('P', 'A4', 'en');
            $pdf->WriteHTML($html);
            $pdf->Output('kwitansi KP Trayek.pdf', 'FI');
        } else {
            
        }
    }

    public function print_kwitansi_operasi($no_uji) {
        $id_cheklist = $this->get_checklist_id($no_uji);
        if ($id_cheklist != 0) {
            ob_start();

            $SQL = "SELECT b.*, a.kp_ijin_operasi as kp_ijin_operasi, a.id_kendaraan as id_kendaraan FROM tbl_checklist_kendaraan c "
                    . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                    . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                    . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                    . " WHERE c.id_checklist = $id_cheklist";

            $SQL2 = "SELECT * FROM tbl_kuitansi where id_kwitansi = 3";
            $a['title_kwitansi'] = 'Retribusi cetak kartu yang hilang';
            $a['datpil'] = $this->db->query($SQL)->row();
            $a['kuitansi'] = $this->db->query($SQL2)->row();
            $a['tanggal_cetak'] = date("Y-m-d");
            $a['date_manipulation'] = $this->datetimemanipulation;

            $no_kp = $a['datpil']->kp_ijin_operasi;
            $id_kendaraan = $a['datpil']->id_kendaraan;
//        $this->insertKwitansi($no_kp, $id_kendaraan, 2);

            $this->load->view('admin/cetak/kwitansi/general/print', $a);
            $html = ob_get_contents();
            ob_end_clean();

            require_once('./aset/html2pdf/html2pdf.class.php');
            $pdf = new HTML2PDF('P', 'A4', 'en');
            $pdf->WriteHTML($html);
            $pdf->Output('kwitansi KP Operasi.pdf', 'FI');
        }
    }

    public function print_kp_trayek() {
        $no_uji = $this->uri->segment(3);
        $verifikasi = $this->uri->segment(4);

        if ($verifikasi == 0) {
            print "<script type=\"text/javascript\">window.location.href = '" . base_url() . "index.php/Cetak_ulang';;alert('Gagal Cetak! Belum Diverifikasi!');</script>";
        } else {
            $id_cheklist = $this->get_checklist_id($no_uji);
            if ($id_cheklist != 0) {
                define('FPDF_FONTPATH', $this->config->item('fonts_path'));
                $SQL = "SELECT a.*, b.*, e.* FROM tbl_checklist_kendaraan c "
                        . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                        . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                        . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                        . " LEFT JOIN tbl_trayek e ON a.id_trayek = e.id_trayek "
                        . " WHERE c.id_checklist = $id_cheklist";
                $a['datpil'] = $this->db->query($SQL)->row();
                $a['path'] = "trayek";

                $data_qr = "http://integratesystem.id/display/info_smartcard.php?no_uji=" . $a['datpil']->no_uji;
                $qr['data'] = $data_qr;
                $qr['level'] = 'H';
                $qr['size'] = 10;
                $qr['savename'] = FCPATH . 'qr.png';
                $this->ciqrcode->generate($qr);

                $this->load->view('admin/cetak/kp/kp_trayek_v2', $a);
            } else {
                print "<script type=\"text/javascript\">window.location.href = '" . base_url() . "index.php/Cetak_ulang';;alert('Gagal Cetak! Belum Diverifikasi!');</script>";
            }
        }
    }

    public function print_kp_operasi() {
        $no_uji = $this->uri->segment(3);
        $verifikasi = $this->uri->segment(4);

        if ($verifikasi == 0) {
            print "<script type=\"text/javascript\">window.location.href = '" . base_url() . "index.php/Cetak_ulang';;alert('Gagal Cetak! Belum Diverifikasi!');</script>";
        } else {
            $id_cheklist = $this->get_checklist_id($no_uji);
            if ($id_cheklist != 0) {
                define('FPDF_FONTPATH', $this->config->item('fonts_path'));
                $SQL = "SELECT a.*, b.*, e.* FROM tbl_checklist_kendaraan c "
                        . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                        . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                        . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                        . " LEFT JOIN tbl_trayek e ON a.id_trayek = e.id_trayek "
                        . " WHERE c.id_checklist = $id_cheklist";
                $a['datpil'] = $this->db->query($SQL)->row();
                $a['path'] = "operasi";

                $data_qr = "http://integratesystem.id/display/info_smartcard.php?no_uji=" . $a['datpil']->no_uji;
                $qr['data'] = $data_qr;
                $qr['level'] = 'H';
                $qr['size'] = 10;
                $qr['savename'] = FCPATH . 'qr.png';
                $this->ciqrcode->generate($qr);

                $this->load->view('admin/cetak/kp/kp_operasi_v2', $a);
            } else {
                print "<script type=\"text/javascript\">window.location.href = '" . base_url() . "index.php/Cetak_ulang';;alert('Gagal Cetak! Belum Diverifikasi!');</script>";
            }
        }
    }

    public function cetak_stiker_trayek() {
        $no_uji = $this->uri->segment(3);
        $verifikasi = $this->uri->segment(4);

        if ($verifikasi == 0) {
            print "<script type=\"text/javascript\">window.location.href = '" . base_url() . "index.php/Cetak_ulang';;alert('Gagal Cetak! Belum Diverifikasi!');</script>";
        } else {
            $id_cheklist = $this->get_checklist_id($no_uji);
            if ($id_cheklist != 0) {
                $SQL = "SELECT a.*, d.masa_berlaku as masa_berlaku_kp, b.*, e.* FROM tbl_checklist_kendaraan c "
                        . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                        . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                        . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                        . " JOIN tbl_trayek e ON a.id_trayek = e.id_trayek "
                        . " WHERE c.id_checklist = $id_cheklist";
                $a['datpil'] = $this->db->query($SQL)->row();
                $a['date_manipulation'] = $this->datetimemanipulation;

                if (!empty($a['datpil']->no_uji)) {
                    $data_qr = "http://integratesystem.id/display/info_stiker.php?no_uji=" . $a['datpil']->no_uji;
                    $qr['data'] = $data_qr;
                    $qr['level'] = 'H';
                    $qr['size'] = 10;
                    $qr['savename'] = FCPATH . 'qr.png';
                    $this->ciqrcode->generate($qr);
//        echo '<img src="' . base_url() . 'qr.png" />';
                    $this->load->view('admin/cetak/stiker/print.php', $a);
                }
            } else {
                print "<script type=\"text/javascript\">window.location.href = '" . base_url() . "index.php/Cetak_ulang';;alert('Gagal Cetak! Belum Diverifikasi!');</script>";
            }
        }
    }

    public function cetak_stiker_operasi() {
        $no_uji = $this->uri->segment(3);
        $verifikasi = $this->uri->segment(4);

        if ($verifikasi == 0) {
            print "<script type=\"text/javascript\">window.location.href = '" . base_url() . "index.php/Cetak_ulang';;alert('Gagal Cetak! Belum Diverifikasi!');</script>";
        } else {
            $id_cheklist = $this->get_checklist_id($no_uji);
            if ($id_cheklist != 0) {
                $SQL = "SELECT a.*, d.masa_berlaku as masa_berlaku_kp, b.* FROM tbl_checklist_kendaraan c "
                        . " join tbl_pemeriksaan d ON c.id_pemeriksaan = d.id_pemeriksaan "
                        . " join tbl_kendaraan a ON a.no_uji = d.id_kendaraan  "
                        . " LEFT JOIN tbl_perusahaan b ON a.id_perusahaan = b.id "
                        . " WHERE c.id_checklist = $id_cheklist";
                $a['datpil'] = $this->db->query($SQL)->row();
                $a['date_manipulation'] = $this->datetimemanipulation;

                if (!empty($a['datpil']->no_uji)) {
                    $data_qr = "http://integratesystem.id/display/info_stiker.php?no_uji=" . $a['datpil']->no_uji;
                    $qr['data'] = $data_qr;
                    $qr['level'] = 'H';
                    $qr['size'] = 10;
                    $qr['savename'] = FCPATH . 'qr.png';
                    $this->ciqrcode->generate($qr);

//        echo '<img src="' . base_url() . 'qr.png" />';
                    $this->load->view('admin/cetak/stiker/print_operasi.php', $a);
                }
            } else {
                print "<script type=\"text/javascript\">window.location.href = '" . base_url() . "index.php/Cetak_ulang';;alert('Gagal Cetak! Belum Diverifikasi!');</script>";
            }
        }
    }

    public function get_checklist_id($no_uji) {
        $trim_nokendaraan = trim($no_uji);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);

        $a['data_kendaraan'] = $this->m_cetak_ulang->get_checklist_id($rawl_nokendaraan);
        if (empty($a['data_kendaraan'])) {
            return 0;
        } else {
            if (!empty($a['data_kendaraan']['id_checklist'])) {
                $id_checklist = $a['data_kendaraan']['id_checklist'];
                return $id_checklist;
            } else {
                return 0;
            }
        }
    }

}
