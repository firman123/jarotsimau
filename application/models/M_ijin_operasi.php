<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_ijin_operasi
 *
 * @author Ihtiyar
 */
class M_ijin_operasi extends CI_Model {
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    public function total_ijin_operasi() {
        $sql = "select count(*) as TOTAL from tbl_ijin_operasi ";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
        
    }
    
    function buat_kode() {
        $this->db->select('RIGHT(tbl_ijin_operasi.id_ijin_operasi,6) as kode', FALSE);
        $this->db->order_by('id_ijin_operasi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_ijin_operasi');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }
        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $tahun = date("Y");
        $kodetahun = substr($tahun, 2);
        $kodejadi = "KPIO" .$tahun. $kodemax;
        return $kodejadi;
    }

    public function get_detail_ijin_operasi($params) {
        $sql = "SELECT * FROM tbl_ijin_operasi WHERE id_ijin_operasi = ? ";
        $query = $this->db->query($sql, $params);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function get_all_ijin_operasi() {
        $sql = "SELECT * FROM tbl_ijin_operasi";
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
        return $this->db->insert('tbl_ijin_operasi', $data_field);
    }

    // update
    public function update($data_field, $id) {
        $this->db->where("id_ijin_operasi", $id);
        return $this->db->update('tbl_ijin_operasi', $data_field);
    }

    // delete
    public function delete($id) {
        $this->db->where("id_ijin_operasi", $id);
        return $this->db->delete('tbl_ijin_operasi');
    }

}
