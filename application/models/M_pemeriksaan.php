<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pemeriksaan
 *
 * @author Ihtiyar
 */
class M_pemeriksaan extends CI_Model {
    //put your code here
    
     public function __construct() {
        parent::__construct();
    }
    
     public function get_pemeriksaan_all($limit, $offset) {
        $sql = "SELECT * FROM tbl_pemeriksaan "
                . " ORDER BY id_pemeriksaan DESC LIMIT $limit OFFSET $offset";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
    

    public function get_detail_pemeriksaan_by_id($params) {
        $sql = "SELECT * FROM tbl_pemeriksaan WHERE id_pemeriksaan = ? ";
        $query = $this->db->query($sql, trim($params));
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
    
    public function get_total_pemeriksaan() {
        $sql = "SELECT COUNT(id_pemeriksaan) as total FROM tbl_pemeriksaan";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }

        // insert
    public function insert($data_field) {
        return $this->db->insert('tbl_pemeriksaan', $data_field);
    }

    // update
    public function update($data_field, $id) {
        $this->db->where("id_pemeriksaan", $id);
        return $this->db->update('tbl_pemeriksaan', $data_field);
    }

    // delete
    public function delete($id) {
        $this->db->where("id_pemeriksaan", $id);
        return $this->db->delete('tbl_pemeriksaan');
    }
}
