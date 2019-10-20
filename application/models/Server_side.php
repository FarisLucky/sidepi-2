<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Server_side extends CI_Model
{
    public function makeQuery($column_orders, $table, $search, $order, $having, $where = null)
    {
        $this->db->select($column_orders);
        $this->db->from($table);
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($this->input->post('search')['value'])) {
            foreach ($search as $key => $value) {
                if ($key == 0) {
                    $this->db->like($value, $_POST['search']['value']);
                } else {
                    $this->db->or_like($value, $_POST['search']['value']);
                }
            }
        }
        if (!empty($having)) {
            $this->db->having($having);
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($order[$this->input->post('order')['0']['column']], $this->input->post('order')['0']['dir']);
        } else {
            $this->db->order_by($order, 'DESC');
        }
    }
    public function makeDataTables($column, $table, $search, $order, $having = null, $where = null)
    {
        $this->makeQuery($column, $table, $search, $order, $having, $where);
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_datas($column, $table, $search, $order, $having = null, $where = null)
    {
        $this->makeQuery($column, $table, $search, $order, $having, $where);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_datas($tbl, $where = null)
    {
        $this->db->select("*");
        $this->db->from($tbl);
        if (!empty($where)) {
            $this->db->where($where);
        }
        return $this->db->count_all_results();
    }
}

/* End of file Server_side.php */
