<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_admin
 *
 * @author Ihtiyar
 */
class m_admin extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function insert($data_field) {
        return $this->db->insert('tbl_user_simau', $data_field);
    }

    public function update($data_field, $id) {
        $this->db->where("id", $id);
        return $this->db->update('tbl_user_simau', $data_field);
    }

    // delete
    public function delete($id) {
        $this->db->where("id", $id);
        return $this->db->delete('tbl_user_simau');
    }
    
        // get login
    function get_user_login($username, $password) {
        // load encrypt
        $this->load->library('encrypt');
         
        $result = $this->get_user_detail_by_username($username);
        if(!empty($result)) {
            $password_decode = $this->encrypt->decode($result['user_pass'], $result['password_key']);
            // get user
            if($password_decode === $password) {
                // cek authority then return id
                return $result;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    function get_user_detail_by_username($params) {
        $sql = "SELECT * FROM tbl_user_simau WHERE user_name = ? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        }
    }


}
