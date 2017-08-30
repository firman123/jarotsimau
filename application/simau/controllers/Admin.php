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
    
    public function manage_admin() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_user') == "") {
			redirect("admin/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM tbl_user")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, site_url('admin/manage_admin/p'));
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$username				= addslashes($this->input->post('username'));
		$password				= md5(addslashes($this->input->post('password')));
		$nama					= addslashes($this->input->post('nama'));
		$nip					= addslashes($this->input->post('nip'));
		$level					= addslashes($this->input->post('level'));
		
		$cari					= addslashes($this->input->post('q'));

		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM t_admin WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
			redirect('admin/manage_admin');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM t_admin WHERE nama LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_manage_admin";
		} else if ($mau_ke == "add") {
			$a['page']		= "manage_admin/input";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM t_admin WHERE id = '$idu'")->row();	
			$a['page']		= "f_manage_admin";
		} else if ($mau_ke == "act_add") {
                        $check_user = $this->db->query("SELECT * FROM tbl_user WHERE user_name = '$username'") -> row();
                        if($check_user==NULL) {
                            
                        }
			$this->db->query("INSERT INTO t_admin VALUES (NULL, '$username', '$password', '$nama', '$nip', '$level')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");
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
			$a['data']		= $this->db->query("SELECT * FROM tbl_user LIMIT $akhir OFFSET $awal ")->result();
			$a['page']		= "manage_admin/list";
		}
		
		$this->load->view('admin/dashboard', $a);
	}
    
    public function logout(){
        $this->session->sess_destroy();
		redirect('admin/login');
    }

}
