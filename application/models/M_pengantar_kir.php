<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_pengantar_kir extends CI_Model { 
    //put your code here

    public function __construct() {
        parent::__construct();
    }

    public function get_pengantar_kir_all($limit, $offset) {
        $tanggal = date("Y-m-d");
        $sql = "SELECT A.*, B.no_kendaraan, B.no_mesin, B.no_chasis, B.Merk, B.nama_pemilik FROM tbl_pengantar_kir A JOIN tbl_kendaraan B "
                . " ON A.id_kendaraan = B.id_kendaraan "
                . " WHERE A.tanggal = '$tanggal' ORDER BY A.id_pengantar DESC "
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
    
    public function get_all_by_status($status, $limit, $offset) {
       $tanggal = date("Y-m-d");
        $sql = "SELECT A.*, B.kp_ijin_trayek, B.no_uji, B.no_kendaraan, B.no_mesin, B.no_chasis, B.nama_pemilik FROM tbl_pengantar_kir A JOIN tbl_kendaraan B "
                . " ON A.id_kendaraan = B.id_kendaraan "
                . " WHERE A.tanggal = '$tanggal' AND A.verifikasi = $status ORDER BY A.id_pengantar DESC "
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

    public function get_total_ijin() {
        $tanggal = date("Y-m-d");
        $SQL = "SELECT count(*) as TOTAL FROM tbl_pengantar_kir WHERE tanggal = '$tanggal' ";
        $query = $this->db->query($SQL);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }
    
    public function get_total_ijin_by_status($value) {
        $tanggal = date("Y-m-d");
        $SQL = "SELECT count(*) as TOTAL FROM tbl_pengantar_kir WHERE tanggal = '$tanggal' AND verifikasi = $value ";
        $query = $this->db->query($SQL);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }

    public function cari_kendaraan($no_uji) {
        $SQL = "SELECT A.*, A.id_kendaraan AS kendaraan_id,  A.tgl_mati_uji as berlaku_kp,  B.*, D.* "
                . " FROM tbl_kendaraan A LEFT JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                . " LEFT JOIN tbl_trayek D ON A.id_trayek = D.id_trayek  "
                . " WHERE  A.no_uji = ? ";

        $query = $this->db->query($SQL, $no_uji);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
    
    public function get_detail_verifikasi($id) {
        $SQL = "SELECT A.*, A.id_kendaraan AS kendaraan_id, E.id_pengantar,  B.*, B.masa_berlaku as tgl_berlaku, D.* "
                . " FROM tbl_kendaraan A LEFT JOIN tbl_perusahaan B ON A.id_perusahaan = B.id "
                . " LEFT JOIN tbl_trayek D ON A.id_trayek = D.id_trayek"
                . " JOIN tbl_pengantar_kir E ON A.id_kendaraan = E.id_kendaraan "
                . " WHERE  E.id_pengantar = ? ";

        $query = $this->db->query($SQL, $id);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
        
    }

    public function delete($id) {
        $this->db->where('id_pengantar', $id);
        return $this->db->delete('tbl_pengantar_kir');
    }

    public function update($data, $id) {
        $this->db->where("id_pengantar", $id);
        return $this->db->update('tbl_pengantar_kir', $data);
    }

    public function insert($data) {
        return $this->db->insert('tbl_pengantar_kir', $data);
    }

}
