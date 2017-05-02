<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_surat_ijin
 *
 * @author Ihtiyar
 */
class m_ijin_usaha extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }
    
    public function total_surat_ijin($jenis_kendaraan) {
        $sql = "select count(a.*) as TOTAL from tbl_perusahaan a join tbl_ijin_usaha b on a.id = b.id_perusahaan where b.jenis_angkutan = ? ";
        $query = $this->db->query($sql, $jenis_kendaraan);
        if($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
        
    }
    
      public function create_nomor_surat_ijin() {
        $sql = "select count(*) as TOTAL from tbl_ijin_usaha";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
        
    }
    

    public function get_detail_ijin_usaha_by_id($params) {
        $sql = "SELECT * FROM tbl_ijin_usaha WHERE id_ijin = ? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
    
    public function get_detail_ijin_usaha_by_kendaraan($params) {
        $sql = "SELECT * from tbl_ijin_usaha  WHERE id_perusahaan = ? AND c.verifikasi = 1 ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function get_all_ijin_usaha() {
        $sql = "SELECT * FROM tbl_ijin_usaha";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    // insert
    public function insert($data_field) {
        return $this->db->insert('tbl_ijin_usaha', $data_field);
    }

    // update
    public function update($data_field, $id) {
        $this->db->where("id_ijin", $id);
        return $this->db->update('tbl_ijin_usaha', $data_field);
    }

    // delete
    public function delete($id) {
        $this->db->where("id_ijin", $id);
        return $this->db->delete('tbl_ijin_usaha');
    }

}
