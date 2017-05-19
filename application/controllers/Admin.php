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

//put your code here

    function __construct() {
        parent::__construct();
    }

    public function index() {
        if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_user') == "") {
            redirect("admin/login");
        }

        $a['page'] = "home";

        $this->load->view('admin/dashboard_menu', $a);
    }

    public function login() {
        $this->load->view('admin/login');
    }

    public function do_login() {
        $u = $this->security->xss_clean($this->input->post('u'));
        $p = md5($this->security->xss_clean($this->input->post('p')));


        $q_cek = $this->db->query("SELECT * FROM tbl_user WHERE user_name = '" . $u . "' AND user_pass = '" . $p . "'");
        $j_cek = $q_cek->num_rows();
        $d_cek = $q_cek->row();
//echo $this->db->last_query();

        if ($j_cek == 1) {
            $data = array(
                'admin_id' => $d_cek->id_user,
                'admin_user' => $d_cek->user_name,
                'password' => $d_cek->user_pass,
                'admin_level' => $d_cek->otoritas,
                'admin_valid' => true
            );
            $this->session->set_userdata($data);
            redirect('admin');
        } else {
            $this->session->set_flashdata("message", "<div id=\"alert\" class=\"alert alert-error\">username or password is not valid</div>");
            redirect('admin/login');
        }
    }
    
    public function logout(){
        $this->session->sess_destroy();
		redirect('admin/login');
    }

}
