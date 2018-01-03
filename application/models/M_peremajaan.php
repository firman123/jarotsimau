<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_peremajaan
 *
 * @author Ihtiyar
 */
class M_peremajaan extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

     public function get_peremajaan_all($limit, $offset) {
        $sql = "SELECT A.*, B.kp_ijin_trayek FROM tbl_peremajaan A JOIN tbl_kendaraan B "
                . " ON A.id_kendaraan = B.id_kendaraan ORDER BY A.id_peremajaan DESC "
                . " LIMIT $limit OFFSET $offset ";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
    
    public function get_total_peremajaan() {
        $SQL = "SELECT count(*) as TOTAL FROM tbl_peremajaan ";
        $query = $this->db->query($SQL);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }
    
    public function delete($id) {
        $this->db->where('id_peremajaan', $id);
        return $this->db->delete('tbl_peremajaan');
    }
    
    public function update($data, $id) {
        $this->db->where("id_peremajaan", $id);
        return $this->db->update('tbl_peremajaan');
    }
    
    public function insert($data) {
        return $this->db->insert('tbl_peremajaan', $data);
    }

}
