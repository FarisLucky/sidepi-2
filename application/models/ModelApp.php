<?php


defined('BASEPATH') or exit('No direct script access allowed');

class ModelApp extends CI_Model
{

    public function getData($select, $tbl, $where = null, $order = null, $order_by = null, $limit = null, $offset = null)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        if ($where != null) {
            $this->db->where($where);
        }
        if ($order != null) {
            $this->db->order_by($order, $order_by);
        }
        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get();
    }
    public function getDataLike($select, $tbl, $like = null, $order = null, $order_by = null, $limit = null, $offset = null, $where = null)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        if ($where != null) {
            $this->db->where($where);
        }
        if ($like != null) {
            foreach ($like as $key => $value) {
                if ($key == 0) {
                    $this->db->like($key, $value);
                } else {
                    $this->db->or_like($key, $value);
                }
            }
        }
        if ($order != null) {
            $this->db->order_by($order, $order_by);
        }
        if ($limit != null) {
            $this->db->limit($limit, $offset);
        }
        return $this->db->get();
    }
    public function getJoinData($select, $tbl, $join, $where = null, $order = null, $order_by = null)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        if (is_array($join)) {
            foreach ($join as $key => $value) {
                $this->db->join($key, $value, 'inner');
            }
        }
        if ($where != null) {
            $this->db->where($where);
        }
        if ($order != null) {
            $this->db->order_by($order, $order_by);
        }
        return $this->db->get();
    }
    public function updateData($data, $tbl, $where)
    {
        $this->db->update($tbl, $data, $where);
        return $this->db->affected_rows();
    }
    public function insertData($data, $tbl)
    {
        $this->db->insert($tbl, $data);
        return $this->db->affected_rows();
    }
    public function deleteData($where, $tbl)
    {
        $this->db->where($where);
        $this->db->delete($tbl);
        return $this->db->affected_rows();
    }
}

/* End of file ModelApp.php */
