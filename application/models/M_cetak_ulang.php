<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_cetak_ulang
 *
 * @author Ihtiyar
 */
class M_cetak_ulang extends CI_Model {
    //put your code here
     public function __construct() {
        parent::__construct();
    }
    
     public function get_cetak_ulang_all($verifikasi, $limit, $offset) {
        $tanggal = date("Y-m-d");
        
        $sql = "SELECT A.*, B.kp_ijin_trayek, B.no_uji, B.no_kendaraan FROM tbl_cetak_ulang A JOIN tbl_kendaraan B "
                . " ON A.id_kendaraan = B.id_kendaraan ";
        if ($verifikasi == NULL) {
          $sql .= " WHERE A.tanggal = '$tanggal' ORDER BY A.id_cetak_ulang DESC "
                . " LIMIT $limit OFFSET $offset "; 
        } else {
           $sql .= " WHERE A.verifikasi = '$verifikasi' AND A.tanggal = '$tanggal' ORDER BY A.id_cetak_ulang DESC "
                . " LIMIT $limit OFFSET $offset ";
        }
                

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
        $sql = "SELECT A.*, B.kp_ijin_trayek FROM tbl_cetak_ulang A JOIN tbl_kendaraan B "
                . " ON A.id_kendaraan = B.id_kendaraan "
                . " WHERE verifikasi = 0 ORDER BY A.id_cetak_ulang DESC ";

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
    
    public function cari_kendaraan ($no_uji) {
      $SQL = "SELECT B.id_pemeriksaan, A.id_kendaraan, A.no_uji, A.kp_ijin_trayek, A.kp_ijin_operasi, A.no_kendaraan,
                 A.nama_pemilik, A.alamat, C.id_cetak_ulang FROM tbl_kendaraan A JOIN tbl_pemeriksaan B 
                 ON A.no_uji = B.id_kendaraan
                 LEFT JOIN tbl_cetak_ulang C ON C.id_kendaraan = A.id_kendaraan
                 WHERE  A.no_uji = '$no_uji' ORDER BY B.id_pemeriksaan DESC LIMIT 1  ";
      $query = $this->db->query($SQL);
      if ($query->num_rows() > 0) {
          $result = $query->row_array();
          $query->free_result();
          return $result;
      } else {
          return array();
      }    
    }
    
    public function get_checklist_id ($no_uji) {
      $SQL = "SELECT B.id_pemeriksaan, A.id_checklist FROM tbl_checklist_kendaraan A 
                join tbl_pemeriksaan B ON A.id_pemeriksaan = B.id_pemeriksaan 
                 WHERE B.id_kendaraan = '$no_uji' ORDER BY B.id_pemeriksaan DESC LIMIT 1  ";
      $query = $this->db->query($SQL);
      if ($query->num_rows() > 0) {
          $result = $query->row_array();
          $query->free_result();
          return $result;
      } else {
          return array();
      }    
    }


    public function cek_kendaraan_available($id_kendaraan) {
        $tanggal = date('Y-m-d');
        $SQL = "SELECT id_cetak_ulang FROM tbl_cetak_ulang WHERE id_kendaraan = ? AND tanggal = '$tanggal' ";
        $query = $this->db->query($SQL, $id_kendaraan);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function get_total_cetak_ulang($verifikasi) {
        $tanggal = date("Y-m-d");
        if ($verifikasi == NULL) {
           $SQL = "SELECT count(*) as TOTAL FROM tbl_cetak_ulang WHERE tanggal = '$tanggal'";
        } else {
           $SQL = "SELECT count(*) as TOTAL FROM tbl_cetak_ulang WHERE tanggal = '$tanggal' AND verifikasi = '$verifikasi' ";
        }
        
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
        $this->db->where('id_cetak_ulang', $id);
        return $this->db->delete('tbl_cetak_ulang');
    }

    public function update($data, $id) {
        $this->db->where("id_cetak_ulang", $id);
        return $this->db->update('tbl_cetak_ulang', $data);
    }

    public function insert($data) {
        return $this->db->insert('tbl_cetak_ulang', $data);
    }
}
