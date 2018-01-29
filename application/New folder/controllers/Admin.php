<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author Ihtiyar
 */
class Admin extends CI_Controller {
    private $user;

    function __construct() {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->library('encrypt');
    }

    public function index() {
        $this->user = $this->session->userdata('session_admin');
        if (!empty($this->user)) {
            $a['page'] = "home";
            $a['data_user'] = $this->m_admin->get_user_detail_by_username($this->user['admin_user']);
            $this->load->view('admin/dashboard_menu', $a);
        } else {
             redirect("admin/login");
        }
       
    }

    public function login() {
        $this->load->view('admin/login');
    }

    public function login_process() {
        $u = trim($this->input->post('u'));
        $p = trim($this->input->post('p'));
    
        $result = $this->m_admin->get_user_login($u, $p);
        
        if(!empty($result)) {
            $data = array(
                'admin_id' => $result['id'],
                'admin_user' => $result['user_name'],
                'password' => $result['user_pass'],
                'admin_level' => $result['otoritas']
            );
            $this->session->set_userdata('session_admin', $data);
            redirect('admin');
        } else {
            $this->session->set_flashdata("message", "<div id=\"alert\" class=\"alert alert-error\">username or password is not valid</div>");
            redirect('admin/login');
        }
    }

    public function do_login() {
        $u = $this->security->xss_clean($this->input->post('u'));
        $p = md5($this->security->xss_clean($this->input->post('p')));

//        print_r($p);

        $q_cek = $this->db->query("SELECT * FROM tbl_user_simau WHERE user_name = '" . $u . "' AND user_pass = '" . $p . "'");
        $j_cek = $q_cek->num_rows();
        $d_cek = $q_cek->row();
//echo $this->db->last_query();

        if ($j_cek == 1) {
            $data = array(
                'admin_id' => $d_cek->id,
                'admin_user' => $d_cek->user_name,
                'password' => $d_cek->user_pass,
                'admin_level' => $d_cek->otoritas
            );
            $this->session->set_userdata($data);
            redirect('admin');
        } else {
            $this->session->set_flashdata("message", "<div id=\"alert\" class=\"alert alert-error\">username or password is not valid</div>");
            redirect('admin/login');
        }
    }

    public function manage_admin() {
        /* pagination */
        $total_row = $this->db->query("SELECT * FROM tbl_user_simau")->num_rows();
        $per_page = 10;

        $awal = $this->uri->segment(4);
        $awal = (empty($awal) || $awal == 1) ? 0 : $awal;

        //if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
        $akhir = $per_page;

        $a['pagi'] = _page($total_row, $per_page, 4, site_url('admin/manage_admin/p'));

        //ambil variabel URL
        $mau_ke = $this->uri->segment(3);
        $idu = $this->uri->segment(4);

        $cari = addslashes($this->input->post('q'));

        //ambil variabel Postingan
        $idp = addslashes($this->input->post('idp'));
        $name = $this->input->post('name');
        $username = addslashes($this->input->post('username'));
        $user_pass = $this->input->post('password');
        $nama = addslashes($this->input->post('nama'));
        $nip = addslashes($this->input->post('nip'));
        $level = addslashes($this->input->post('level'));
        $kendaran = $this->input->post('kendaraan');
        $perusahaan = $this->input->post('perusahaan');
        $trayek = $this->input->post('trayek');
        $ijin_trayek_operasi = $this->input->post('ijin_trayek_operasi');
        $kp_trayek_operasi = $this->input->post('kp_trayek_operasi');
        $pengemudi = $this->input->post('pengemudi');
        $verifikasi = $this->input->post('verifikasi');
        $rubah_sifat = $this->input->post('rubah_sifat');
        $checklist = $this->input->post('checklist');

        $cari = addslashes($this->input->post('q'));


        if ($mau_ke == "del") {
            $this->db->query("DELETE FROM tbl_user_simau WHERE id = '$idu'");
            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
            redirect('admin/manage_admin');
        } else if ($mau_ke == "cari") {
            $a['data'] = $this->db->query("SELECT * FROM t_admin WHERE nama LIKE '%$cari%' ORDER BY id DESC")->result();
            $a['page'] = "l_manage_admin";
        } else if ($mau_ke == "add") {
            $a['page'] = "manage_admin/input";
        } else if ($mau_ke == "edt") {
            $a['datpil'] = $this->db->query("SELECT * FROM tbl_user WHERE user_name = '$idu'")->row();
            $a['page'] = "manage_admin/input";
        } else if ($mau_ke == "act_add") {
            $check_user = $this->db->query("SELECT * FROM tbl_user_simau WHERE user_name = '$username'")->row();
            if ($check_user == NULL) {
                $data = array(
                    "name" => $name,
                    "user_name" => $username,
                    "user_pass" => $user_pass,
                    "otoritas" => $level,
                    "kendaraan" => $kendaran,
                    "perusahaan" => $perusahaan,
                    "trayek" => $trayek,
                    "ijin_operasi" => $ijin_trayek_operasi,
                    "ijin_trayek" => $ijin_trayek_operasi,
                    "pengemudi" => $pengemudi,
                    "verifikasi" => $verifikasi,
                    "kp_ijin_trayek" => $kp_trayek_operasi,
                    "kp_ijin_operasi" => $kp_trayek_operasi,
                    "rubah_sifat" => $rubah_sifat,
                    "checklist_trayek" => $checklist,
                    "checklist_operasi" => $checklist
                );
                $password_key = crc32($user_pass);
                $password = $this->encrypt->encode($user_pass, $password_key);
                $data['user_pass'] = $password;
                $data['password_key'] = $password_key;
                $save_data = $this->m_admin->insert($data);
//                $save = $this->m_admin->insert($data);
                if ($save_data) {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");
                } else {
                    $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Data failed to add</div>");
                }
            } else {
                $this->session->set_flashdata("message", "<div class=\"alert alert-error\" id=\"alert\">Gagal!!! User sudah ada!. </div>");
            }
            redirect('admin/manage_admin');
        } else if ($mau_ke == "act_edt") {
            if ($password = md5("-")) {
                $this->db->query("UPDATE t_admin SET username = '$username', nama = '$nama', nip = '$nip', level = '$level' WHERE id = '$idp'");
            } else {
                $this->db->query("UPDATE t_admin SET username = '$username', password = '$password', nama = '$nama', nip = '$nip', level = '$level' WHERE id = '$idp'");
            }

            $this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated </div>");
            redirect('admin/manage_admin');
        } else {
            $a['data'] = $this->db->query("SELECT * FROM tbl_user_simau LIMIT $akhir OFFSET $awal ")->result();
            $a['page'] = "manage_admin/list";
        }

        $this->load->view('admin/dashboard', $a);
    }

    public function logout() {
//        $this->session->sess_destroy();
        $this->session->unset_userdata('session_admin');
        redirect('admin/login');
    }

}
