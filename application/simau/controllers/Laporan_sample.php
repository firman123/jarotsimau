<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Laporan_sample extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->library('fpdf');
    }

    function kartu_pengawasan() {
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $params['nama'] = "indah";
        $this->load->view('admin/cetak/kp/kp_operasi_v2', $params);
    }
    
     function kartu_pengemudi() {
        define('FPDF_FONTPATH', $this->config->item('fonts_path'));
        $params['nama'] = "indah";
        $this->load->view('admin/cetak/kartu_pengemudi/print_v2', $params);
    }

}
