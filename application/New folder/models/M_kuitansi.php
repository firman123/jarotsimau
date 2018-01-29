<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_kuitansi
 *
 * @author Ihtiyar
 */
class M_kuitansi extends CI_Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function get_kuitansi_all() {
       $sql = "SELECT * FROM tbl_kuitansi";
       $query = $this->db->query($sql);
       if ($query->num_rows() > 0) {
           $result = $query->result();
           $query->free_result();
           return $result;
       } else {
           return array();
       }
    }
    
    public function  get_detail_kuitansi($params) {
        $sql = "SELECT * FROM tbl_kuitansi WHERE id_kwitansi = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
    
    public function  cek_kuitansi_available($params) {
        $sql = "SELECT id_cetak FROM tbl_cetak_kuitansi WHERE kp_ijin = ?";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    // update
    public function update($data_field, $id) {
        $this->db->where("id_kwitansi", $id);
        return $this->db->update('tbl_kuitansi', $data_field);
    }

    // delete
    public function delete($id) {
        $this->db->where("id_kwitansi", $id);
        return $this->db->delete('tbl_kuitansi');
    }
    
    public function insertCetak($data_field) {
        return $this->db->insert('tbl_cetak_kuitansi', $data_field);
    }

}
