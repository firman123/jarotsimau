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

    public function get_pemeriksaan_all($jenis, $limit, $offset, $tanggal) {
        $sql = "SELECT a.*, b.* FROM tbl_kendaraan a join tbl_pemeriksaan b "
                . " ON b.id_kendaraan = a.no_uji ";
        $tanggal_pemeriksaan = '';
        if ($tanggal != null) {
            $tanggal_pemeriksaan = " AND b.tanggal = '$tanggal'";
        }

        if ($jenis == 'trayek') {
            $sql .= "WHERE a.kp_ijin_trayek!='' " . $tanggal_pemeriksaan . " ORDER BY b.id_pemeriksaan DESC LIMIT $limit OFFSET $offset";
        } else {
            $sql .= "WHERE a.kp_ijin_operasi!='' " . $tanggal_pemeriksaan . " ORDER BY b.id_pemeriksaan DESC LIMIT $limit OFFSET $offset";
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

    public function get_hasil_pemeriksaan_all($jenis, $limit, $offset) {
        $tanggal = date('Y-m-d');

        if ($jenis == 'trayek') {
            $sql = "SELECT a.*, b.*, c.*, d.* FROM tbl_kendaraan a join tbl_pemeriksaan b "
                    . " ON b.id_kendaraan = a.no_uji "
                    . " JOIN tbl_checklist_kendaraan c ON b.id_pemeriksaan = c.id_pemeriksaan "
                    . " JOIN tbl_trayek d ON a.id_trayek = d.id_trayek "
                    . " WHERE a.kp_ijin_trayek!='' AND b.tanggal = '$tanggal'  ORDER BY b.id_pemeriksaan DESC LIMIT $limit OFFSET $offset";
        } else if ($jenis == 'operasi') {
            $sql = "SELECT a.*, b.*, c.*, d.* FROM tbl_kendaraan a join tbl_pemeriksaan b "
                    . " ON b.id_kendaraan = a.no_uji "
                    . " JOIN tbl_checklist_kendaraan c ON b.id_pemeriksaan = c.id_pemeriksaan "
                    . " LEFT JOIN tbl_trayek d ON a.id_trayek = d.id_trayek "
                    . " WHERE a.kp_ijin_operasi!='' AND b.tanggal = '$tanggal'  ORDER BY b.id_pemeriksaan DESC LIMIT $limit OFFSET $offset";
        } else {
            $sql = "SELECT a.*, b.*, c.*, d.* FROM tbl_kendaraan a join tbl_pemeriksaan b "
                    . " ON b.id_kendaraan = a.no_uji "
                    . " JOIN tbl_checklist_kendaraan c ON b.id_pemeriksaan = c.id_pemeriksaan "
                    . " LEFT JOIN tbl_trayek d ON a.id_trayek = d.id_trayek "
                    . " WHERE (a.kp_ijin_trayek!='' OR  a.kp_ijin_operasi!='') AND b.tanggal = '$tanggal'  ORDER BY b.id_pemeriksaan DESC LIMIT $limit OFFSET $offset";
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

    public function get_checklist_pemeriksaan($jenis, $limit, $offset, $tanggal) {
        $tanggal_pemeriksaan = '';
        if ($tanggal != null) {
            $tanggal_pemeriksaan = " AND b.tanggal = '$tanggal'";
        }

        if ($jenis == 'trayek') {
            $sql = "SELECT a.*, b.*, b.id_pemeriksaan as id_tbl_pemeriksaan, c.*, d.* FROM tbl_kendaraan a join tbl_pemeriksaan b "
                    . " ON b.id_kendaraan = a.no_uji "
                    . " JOIN tbl_trayek c ON a.id_trayek = c.id_trayek "
                    . " LEFT JOIN tbl_checklist_kendaraan d ON b.id_pemeriksaan = d.id_pemeriksaan"
                    . " WHERE a.kp_ijin_trayek!='' ".$tanggal_pemeriksaan. " ORDER BY b.id_pemeriksaan DESC LIMIT $limit OFFSET $offset";
        } else {
            $sql = "SELECT a.*, b.*, b.id_pemeriksaan as id_tbl_pemeriksaan,  d.* FROM tbl_kendaraan a join tbl_pemeriksaan b "
                    . " ON b.id_kendaraan = a.no_uji "
                    . " LEFT JOIN tbl_checklist_kendaraan d ON b.id_pemeriksaan = d.id_pemeriksaan"
                    . " WHERE a.kp_ijin_operasi!='' ".$tanggal_pemeriksaan." ORDER BY b.id_pemeriksaan DESC LIMIT $limit OFFSET $offset";
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

    public function get_detail_hasil_pemeriksaan($params) {
        $sql = "SELECT a.*, b.* FROM tbl_checklist_kendaraan a "
                . " JOIN tbl_pemeriksaan c ON a.id_pemeriksaan = c.id_pemeriksaan "
                . " JOIN tbl_kendaraan b ON c.id_kendaraan = b.no_uji "
                . " WHERE a.id_checklist =$params";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result;
        } else {
            return array();
        }
    }

    public function get_total_pemeriksaan($jenis, $tanggal) {
        $sql = "SELECT count(a.*) as total FROM tbl_kendaraan a join tbl_pemeriksaan b "
                . " ON b.id_kendaraan = a.no_uji ";

        if ($jenis == 'trayek') {
            $sql .= " WHERE a.kp_ijin_trayek!=''";
        } else {
            $sql .= " WHERE a.kp_ijin_operasi!=''";
        }

        if ($tanggal != null) {
            $sql .= " AND b.tanggal = '$tanggal'";
        }
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }

    public function get_total_hasil_pemeriksaan($jenis) {
        $tanggal = date('Y-m-d');
        $sql = "SELECT count(a.*) as total FROM tbl_checklist_kendaraan a "
                . " JOIN tbl_pemeriksaan b ON a.id_pemeriksaan = b.id_pemeriksaan "
                . " JOIN tbl_kendaraan c on b.id_kendaraan = c.no_uji";

        if ($jenis != null) {
            if ($jenis == 'trayek') {
                $sql .= " WHERE c.kp_ijin_trayek!='' AND b.tanggal = '$tanggal' ";
            } else {
                $sql .= " WHERE c.kp_ijin_operasi!='' AND b.tanggal = '$tanggal' ";
            }
        } else {
            $sql .= " WHERE b.tanggal = '$tanggal'";
        }

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            $query->free_result();
            return $result['total'];
        } else {
            return 0;
        }
    }

    public function get_total_checklist_pemeriksaan($jenis, $tanggal) {
//        $sql = "SELECT COUNT(a.*) as total FROM tbl_kendaraan a join tbl_pemeriksaan b "
//                . " ON b.id_kendaraan = a.no_uji "
//                . " JOIN tbl_trayek c ON a.id_trayek = c.id_trayek "
//                . " WHERE a.kp_ijin_trayek !=''";

        $sql = "SELECT COUNT(a.*) as total FROM tbl_kendaraan a join tbl_pemeriksaan b "
                . " ON b.id_kendaraan = a.no_uji "
                . " LEFT JOIN tbl_checklist_kendaraan d ON b.id_pemeriksaan = d.id_pemeriksaan";

        if ($jenis == 'trayek') {
            $sql.= " WHERE a.kp_ijin_trayek!=''";
        } else {
            $sql.= " WHERE a.kp_ijin_operasi!=''";
        }

        if ($tanggal != null) {
            $sql .= " AND b.tanggal = '$tanggal'";
        }
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

    // delete
    public function delete_hasil_pemeriksaan($id) {
        $this->db->where("id_checklist", $id);
        return $this->db->delete('tbl_checklist_kendaraan');
    }

    public function delete_hasil_pemeriksaan_by_id_pemeriksaan($id) {
        $this->db->where("id_pemeriksaan", $id);
        return $this->db->delete('tbl_checklist_kendaraan');
    }

    public function insert_checklist($data_field) {
        return $this->db->insert('tbl_checklist_kendaraan', $data_field);
    }

    // update
    public function update_checklist($data_field, $id) {
        $this->db->where("id_checklist", $id);
        return $this->db->update('tbl_checklist_kendaraan', $data_field);
    }

}
