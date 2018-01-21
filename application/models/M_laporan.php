<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_laporan extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_data_kp_trayek($tgl_awal, $tgl_akhir) {
        $sql = "SELECT COUNT(kp_ijin) AS TOTAL_TRAYEK FROM tbl_cetak_kuitansi "
                . "WHERE kp_ijin LIKE 'KPIT%' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir' ";
//        $sql = "SELECT COUNT(kp_ijin) AS TOTAL_TRAYEK FROM tbl_cetak_kuitansi "
//                . "WHERE kp_ijin LIKE 'KPIT%' AND EXTRACT(month from tanggal) = $bulan AND EXTRACT(YEAR from tanggal) = $tahun ";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total_trayek'];
        } else {
            return 0;
        }
    }

    public function get_data_kp_operasi($tgl_awal, $tgl_akhir) {
        $sql = "SELECT COUNT(kp_ijin) AS TOTAL_OPERASI FROM tbl_cetak_kuitansi "
                . "WHERE kp_ijin LIKE 'KPIO%' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total_operasi'];
        } else {
            return 0;
        }
    }

    public function get_data_rubah_sifat($tgl_awal, $tgl_akhir, $sifat) {
        $sql = "SELECT COUNT(no_uji) as total from tbl_kendaraan "
                . " WHERE sifat = '$sifat' AND tanggal >= '$tgl_awal' AND tanggal <= '$tgl_akhir'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }

    public function total_angkot() {
      $tanggal = date("Y-m-d");
      $sql = "SELECT a.id_trayek, a.kd_trayek, count(b.no_uji) as count
                FROM tbl_kendaraan b 
                JOIN tbl_trayek a ON a.id_trayek = b.id_trayek
                JOIN tbl_pemeriksaan c ON c.id_kendaraan = b.no_uji
                WHERE c.masa_berlaku is NOT NULL AND (DATE_PART('year', c.masa_berlaku::date) - DATE_PART('year', '$tanggal'::date)) >= -1
                Group by a.id_trayek";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function total_perpanjangan_kp($tgl_awal, $tgl_akhir) {
        $sql = "select count(a.id_kendaraan) as total , b.id_perusahaan, c.nama_perusahaan from tbl_pemeriksaan a
                JOIN tbl_kendaraan b ON a.id_kendaraan = b.no_uji 
                JOIN tbl_perusahaan c ON c.id = b.id_perusahaan
                WHERE a.jenis = 'Trayek' AND a.tanggal >= '$tgl_awal' AND a.tanggal <= '$tgl_akhir' AND a.masa_berlaku IS NOT NULL
                GROUP by  b.id_perusahaan, c.nama_perusahaan";
        $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }
    
     public function total_pad($tanggal_awal, $tanggal_akhir, $jenis) {
        $sql = "select count(a.id_kendaraan) as total_pendaftar from tbl_pemeriksaan a 
                JOIN tbl_kendaraan b ON a.id_kendaraan = b.no_uji 
                JOIN tbl_perusahaan c ON c.id = b.id_perusahaan
                WHERE a.jenis = '$jenis' AND a.tanggal >= '$tanggal_awal' AND a.tanggal <= '$tanggal_akhir' AND a.masa_berlaku IS NOT NULL";
        $query = $this->db->query($sql);
         if ($query->num_rows() > 0) {
           $result = $query->row_array();
           $query->free_result();
           return $result['total_pendaftar'];
        } else {
            return 0;
        }
    }
    
    public function biaya_pendaftaran($jenis) {
        $sql = "SELECT harga from tbl_kuitansi ";
        if (trim($jenis) == 'Trayek') {
            $sql .= "WHERE id_kwitansi = 1 ";
        } else {
            $sql .= "WHERE id_kwitansi = 2 ";
        }
       
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['harga'];
        }
    }
    
    

}
