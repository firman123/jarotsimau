<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_trayek
 *
 * @author Ihtiyar
 */
class M_trayek extends CI_Model{
     //put your code here

    public function __construct() {
        parent::__construct();
    }

    public function get_detail_trayek_by_id($params) {
        $sql = "SELECT * FROM tbl_trayek WHERE id_trayek = ? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
    
     public function get_all_trayek() {
        $sql = "SELECT * FROM tbl_trayek";
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
        return $this->db->insert('tbl_trayek', $data_field);
    }

    // update
    public function update($data_field, $id) {
        $this->db->where("id_trayek", $id);
        return $this->db->update('tbl_trayek', $data_field);
    }

    // delete
    public function delete($id) {
        $this->db->where("id_trayek", $id);
        return $this->db->delete('tbl_trayek');
    }
}
