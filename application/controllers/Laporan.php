<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        self::check_authority();
    }

    function cetak_laporan_harian() {
        $date = $this->input->post("tanggal_report");
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $a['data'] = $this->m_pemeriksaan->get_data_laporan($date);
//        $a['total_kendaraan'] = $this->m_ijin_operasi->get_total_kendaraan_trayek($id);
//        $a['data_kendaraan'] = $this->m_ijin_operasi->get_all_kendaraan_by_id_perusahaan_trayek($id);
        $a['date_manipulation'] = $this->datetimemanipulation;
        $a['tanggal'] = $date;
        $this->load->view('admin/cetak/laporan_pengujian/print.php', $a);
    }

    function cetak_laporan_layanan() {
        $tgl_awal = $this->input->post("tanggal_awal");
        $tgl_akhir = $this->input->post("tanggal_akhir");
        $a['tanggal_awal'] = $this->datetimemanipulation->get_full_date($tgl_awal);
        $a['tanggal_akhir'] = $this->datetimemanipulation->get_full_date($tgl_akhir);

        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $a['laporan_kp_trayek'] = $this->m_laporan->get_data_kp_trayek($tgl_awal, $tgl_akhir);
        $a['laporan_kp_operasi'] = $this->m_laporan->get_data_kp_operasi($tgl_awal, $tgl_akhir);
        $a['laporan_tidak_umum'] = $this->m_laporan->get_data_rubah_sifat($tgl_awal, $tgl_akhir, 'TIDAK UMUM');
        $a['laporan_umum'] = $this->m_laporan->get_data_rubah_sifat($tgl_awal, $tgl_akhir, 'UMUM');
        $this->load->view('admin/cetak/laporan_layanan/print.php', $a);
    }

    function cetak_laporan_angkutan() {
        $tgl_awal = $this->input->post("tanggal_awal");
        $tgl_akhir = $this->input->post("tanggal_akhir");
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $a['data'] = $this->m_laporan->total_angkot($tgl_awal, $tgl_akhir);
        $a['tanggal_awal'] = $this->datetimemanipulation->get_full_date($tgl_awal);
        $a['tanggal_akhir'] = $this->datetimemanipulation->get_full_date($tgl_akhir);
        $this->load->view('admin/cetak/laporan_jml_angkot/print.php', $a);
    }

    function cetak_laporan_perpanjangan_kp() {
        $tgl_awal = $this->input->post("tanggal_awal");
        $tgl_akhir = $this->input->post("tanggal_akhir");
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $a['tanggal_awal'] = $this->datetimemanipulation->get_full_date($tgl_awal);
        $a['tanggal_akhir'] = $this->datetimemanipulation->get_full_date($tgl_akhir);
        $a['data'] = $this->m_laporan->total_perpanjangan_kp($tgl_awal, $tgl_akhir);
        $this->load->view('admin/cetak/laporan_perusahaan/print.php', $a);
    }

    function cetak_laporan_pad() {
        $tgl_awal = $this->input->post("tanggal_awal");
        $tgl_akhir = $this->input->post("tanggal_akhir");

        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $total_trayek = $this->m_laporan->total_pad($tgl_awal, $tgl_akhir, 'Trayek');
        $total_operasi = $this->m_laporan->total_pad($tgl_awal, $tgl_akhir, 'Operasi');
        $temp_biaya_trayek = $this->m_laporan->biaya_pendaftaran('Trayek');
        $temp_biaya_operasi = $this->m_laporan->biaya_pendaftaran('Operasi');

        $biaya_trayek = str_replace(".", "", $temp_biaya_trayek);
        $biaya_operasi = str_replace(".", "", $temp_biaya_operasi);

        $total_biaya_trayek = $total_trayek * $biaya_trayek;
        $total_biaya_operasi = $total_operasi * $biaya_operasi;

        $a['total_biaya_trayek'] = $total_biaya_trayek;
        $a['total_biaya_operasi'] = $total_biaya_operasi;
        $a['tanggal_awal'] = $this->datetimemanipulation->get_full_date($tgl_awal);
        $a['tanggal_akhir'] = $this->datetimemanipulation->get_full_date($tgl_akhir);

        $this->load->view('admin/cetak/laporan_pad/print.php', $a);
    }

    public function setting_laporan() {
        $a['page'] = "laporan/setting_laporan";
        $this->load->view('admin/dashboard', $a);
    }

    private function check_authority() {
        $this->com_user = $this->session->userdata('session_admin');
        if (!empty($this->com_user)) {
            $this->load->model('m_pemeriksaan');
            $this->load->library('fpdf');
            $this->load->model("m_laporan");
            $this->load->library("datetimemanipulation");
        } else {
            redirect("admin/login");
        }
    }

}
