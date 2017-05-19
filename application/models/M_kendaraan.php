<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kendaraan
 *
 * @author Ihtiyar
 */
class m_kendaraan extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function get_last_inserted_id() {
        return $this->db->insert_id();
    }

    public function get_detail_kendaraan_by_id($params) {
        $sql = "SELECT * FROM tbl_kendaraan WHERE no_uji = '$params' ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    function buat_kode() {
        $this->db->select('RIGHT(tbl_kendaraan.no_uji,6) as kode', FALSE);
        $this->db->like('no_uji', 'SIMAU', 'after');
        $this->db->order_by('no_uji', 'DESC');
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
        $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT);
        $kodejadi = "SIMAU" . $kodemax;
        return $kodejadi;
    }

    // insert
    public function insert($data_field) {
        return $this->db->insert('tbl_kendaraan', $data_field);
    }

    // update
    public function update($data_field, $no_uji) {
        $this->db->where("no_uji", rawurldecode($no_uji));
        return $this->db->update('tbl_kendaraan', $data_field);
    }

    // delete
    public function delete($katalog_id) {
        $this->db->where("id_katalog", $katalog_id);
        return $this->db->delete('web_katalog');
    }

}
