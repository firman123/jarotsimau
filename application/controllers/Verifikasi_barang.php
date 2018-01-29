<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of verifikasi_barang
 *
 * @author Ihtiyar
 */
class verifikasi_barang extends CI_Controller {

    //put your code here
    private $param_data;

    public function __construct() {
        parent::__construct();
        self::check_authority();
    }

    public function index() {
        $this->rubah_sifat_barang();
        
        $this->param_data['peremajaan'] = $this->m_peremajaan->get_data_non_verfied();
        $this->param_data['page'] = "verifikasi_barang/list";
        $this->load->view('admin/dashboard', $this->param_data);
    }

    public function rubah_sifat_barang() {
        $jenis = 'Barang';
        $total_row = $this->m_kendaraan->total_kendaraan_rubah_sifat($jenis);
        $per_page = 10;

        $awal = $this->uri->segment(3);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;
        $akhir = $per_page;

        $this->param_data['pagi'] = _page($total_row, $per_page, 3, site_url('verifikasi_barang/index'));
        $this->param_data['data_sifat_penumpang'] = $this->m_kendaraan->get_all_kendaraan_rubah_sifat($akhir, $awal, $jenis);
        $this->param_data['jenis'] = $jenis;
        $this->param_data['page2'] = "verifikasi_barang/list_rubahsifat_penumpang";
    }

    public function cari_kendaraan() {
        $no_kendaraan = $this->input->post("no_kendaraan");
        $trim_nokendaraan = trim($no_kendaraan);
        $rawl_nokendaraan = rawurldecode($trim_nokendaraan);

        $SQL = "SELECT A.*, A.id_kendaraan AS kendaraan_id,  A.tgl_mati_uji as berlaku_kp,  B.*, C.*, D.* "
                . " FROM tbl_kendaraan A LEFT JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                . "  LEFT JOIN tb_note_kendaraan C ON a.no_uji=c.id_kendaraan"
                . " LEFT JOIN tbl_trayek D ON A.id_trayek = D.id_trayek  WHERE (A.kp_ijin_trayek != '' OR A.kp_ijin_trayek is not null) ";
        $SQL.= " AND A.no_kendaraan = '$rawl_nokendaraan'  ORDER BY C.id_data DESC LIMIT 1";

        $a['kendaraan'] = $this->db->query($SQL)->row_array();
        if (empty($a['kendaraan'])) {

            $this->session->set_flashdata("message_cari", "<div class=\"alert alert-error\" id=\"alert\">Data Tidak ditemukan</div>");
        }

        $a['page'] = "peremajaan/search_result";
        $this->load->view('admin/dashboard', $a);
    }

    public function detail_verifikasi($id) {
        $data['kendaraan'] = $this->m_peremajaan->get_detail_verifikasi($id);
        $data['page'] = "verifikasi_barang/search_result";
        $this->load->view('admin/dashboard', $data);
    }

    private function check_authority() {
        $this->com_user = $this->session->userdata('session_admin');
        if (!empty($this->com_user)) {
            $this->load->model('m_peremajaan');
            $this->load->model("m_kendaraan");
        } else {
            redirect("admin/login");
        }
    }

    public function konfirmasi() {
        $id = $this->input->post("id_peremajaan");
        $value = $this->input->post("submit");
        $data = array(
            "verifikasi" => $value
        );

        //jika 1 maka setuju jika 2 maka tidak
        if ($this->m_peremajaan->update($data, $id)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Sukses update data </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed. </div>");
        }
        redirect("verifikasi_barang");
    }

    public function act_delete($id_peremajaan) {
        if ($this->m_peremajaan->delete($id_peremajaan)) {
            $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
        } else {
            $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed </div>");
        }

        redirect('verifikasi_barang');
    }

}
