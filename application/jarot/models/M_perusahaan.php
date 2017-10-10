<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_perusahaan
 *
 * @author Ihtiyar
 */
class M_perusahaan extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    public function get_detail_perusahaan_by_id($params) {
        $sql = "SELECT * FROM tbl_perusahaan WHERE id = ? ";
        $query = $this->db->query($sql, trim($params));
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
    
    public function getPerusahaanByName($params) {
        $sql = "SELECT * FROM tbl_perusahaan WHERE nama_perusahaan LIKE '%$params%' ORDER BY id DESC";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

        // insert
    public function insert($data_field) {
        return $this->db->insert('tbl_perusahaan', $data_field);
    }

    // update
    public function update($data_field, $id) {
        $this->db->where("id", $id);
        return $this->db->update('tbl_perusahaan', $data_field);
    }

    // delete
    public function delete($id) {
        $this->db->where("id", $id);
        return $this->db->delete('tbl_perusahaan');
    }

}
