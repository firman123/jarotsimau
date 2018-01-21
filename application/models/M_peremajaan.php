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
        $tanggal = date("Y-m-d");
        $sql = "SELECT A.*, B.kp_ijin_trayek FROM tbl_peremajaan A JOIN tbl_kendaraan B "
                . " ON A.id_kendaraan = B.id_kendaraan "
                . " WHERE A.tanggal = '$tanggal' ORDER BY A.id_peremajaan DESC "
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

    public function get_data_non_verfied() {
        $sql = "SELECT A.*, B.kp_ijin_trayek FROM tbl_peremajaan A JOIN tbl_kendaraan B "
                . " ON A.id_kendaraan = B.id_kendaraan "
                . " WHERE verifikasi = 0 ORDER BY A.id_peremajaan DESC ";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function get_detail_verifikasi($id) {
        $SQL = "SELECT A.*, A.id_kendaraan AS kendaraan_id,  A.tgl_mati_uji as berlaku_kp,  B.*,"
                . " C.id_peremajaan, C.no_kendaraan_lama, C.no_kendaraan_baru, D.* "
                . " FROM tbl_kendaraan A LEFT JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                . " LEFT JOIN tbl_trayek D ON A.id_trayek = D.id_trayek "
                . " JOIN tbl_peremajaan C on A.no_kendaraan = C.no_kendaraan_lama"
                . " WHERE C.id_peremajaan = ? ";
        $query = $this->db->query($SQL, $id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
        
    }
    
    public function cek_kendaraan_available($no_kendaraan) {
        $SQL = "SELECT no_kendaraan_lama FROM tbl_peremajaan WHERE no_kendaraan_lama = ? ";
        $query = $this->db->query($SQL, $no_kendaraan);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function get_total_peremajaan() {
        $tanggal = date("Y-m-d");
        $SQL = "SELECT count(*) as TOTAL FROM tbl_peremajaan WHERE tanggal = '$tanggal' ";
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
        return $this->db->update('tbl_peremajaan', $data);
    }

    public function insert($data) {
        return $this->db->insert('tbl_peremajaan', $data);
    }

}
