<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_ijin_trayek
 *
 * @author Ihtiyar
 */
class m_ijin_operasi extends CI_Model {

    //put your code here

    public function __construct() {
        parent::__construct();
    }

    public function getKendaraan($params) {
        $sql = "SELECT * FROM tbl_kendaraan WHERE LOWER(no_uji) LIKE '%$params%' ORDER BY no_uji DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function getTrayek($params) {
        $sql = "SELECT * FROM tbl_trayek WHERE LOWER(kd_trayek) LIKE  '%$params%' ORDER BY id_trayek DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function total_ijin_operasi() {
        $sql = "select count(*) as TOTAL from tbl_ijin_operasi ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }

    public function ijin_operasi_by_id($params) {
        $sql = "SELECT * FROM tbl_ijin_operasi WHERE id_ijin_operasi = ? ";
        $query = $this->db->query($sql, trim($params));
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    function buat_kode() {
        $this->db->select('RIGHT(tbl_kendaraan.kp_ijin_operasi,6) as kode', FALSE);
        $this->db->like('kp_ijin_operasi', 'KPIO', 'after');
        $this->db->order_by('kp_ijin_operasi', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tbl_kendaraan');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            //jika kode ternyata sudah ada.      
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            //jika kode belum ada      
            $kode = 1;
        }

        $tahun = date("Y");
        $subtanggal = substr($tahun, 2);
        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $kodejadi = "KPIO" . $subtanggal . $kodemax;
        return $kodejadi;
    }
    
     function kode_ijin_operasi() {
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
        $kodejadi = "IJTO" . $kodemax;
        return $kodejadi;
    }

    public function get_detail_ijin_operasi($params) {
        $sql = "SELECT a.*, b.* , c.* FROM tbl_ijin_operasi a join tbl_kendaraan b on a.id_perusahaan = b.id_perusahaan "
                . " JOIN tbl_perusahaan c ON c.id = a.id_perusahaan  WHERE b.no_uji = ? ";
        $query = $this->db->query($sql, rawurldecode($params));
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
