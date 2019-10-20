<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Approve extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
    }
    public function index($num = 0)
    {
        $this->load->helper('date');
        $data['title'] = 'Approve Pembayaran';
        $data['approve_bayar'] = $this->modelapp->getData("*", "tbl_detail_pembayaran", ["status_owner" => "p"], 'id_detail', 'DESC')->result();
        $per_page = 10;
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $data['approve_bayar'] = $this->modelapp->getData('*', 'tbl_detail_pembayaran', ["status_owner" => "p"], 'id_detail', 'ASC', $per_page, $num)->result();
        $data['row'] = $num;
        $this->pagination();
        $this->pages("approve/view_approve_pembayaran", $data);
    }

    public function accept($id)
    {
        $input = $id;
        $get_detail = $this->modelapp->getData("id_detail,id_pembayaran,jumlah_bayar,status_owner", "detail_pembayaran", ["id_detail" => $input]);
        if ($get_detail->num_rows() > 0) {
            $data_detail = $get_detail->row_array();
            $data_bayar = $this->modelapp->getData('hutang,total_bayar', 'pembayaran', ['id_pembayaran' => $data_detail['id_pembayaran']])->row_array();
            if ($data_detail['jumlah_bayar'] > $data_bayar['hutang']) {
                $this->session->set_flashdata('error', 'Jumlah Bayar terlalu besar');
                redirect('approve');
            } else {
                $hutang = $data_bayar['hutang'] - $data_detail['jumlah_bayar'];
                $ttl_bayar = $data_bayar['total_bayar'] + $data_detail['jumlah_bayar'];
                $this->modelapp->updateData(['status_owner' => 'sl'], 'detail_pembayaran', ['id_detail' => $data_detail['id_detail']]);
                $query_update = $this->modelapp->updateData(['hutang' => $hutang, 'total_bayar' => $ttl_bayar], 'pembayaran', ['id_pembayaran' => $data_detail['id_pembayaran']]);
                if ($query_update) {
                    $data_status = $this->modelapp->getData('status_owner,status_manager', 'detail_pembayaran', ['id_detail' => $data_detail['id_detail']])->row_array();
                    if ($data_status['status_owner'] == 'sl') {
                        $data_pembayaran = $this->modelapp->getData('hutang,jenis_pembayaran,id_transaksi', 'pembayaran', ['id_pembayaran' => $data_detail['id_pembayaran']])->row_array();
                        if ($data_pembayaran['hutang'] == '0') {
                            $this->modelapp->updateData(['status' => 'sb'], 'pembayaran', ['id_pembayaran' => $data_detail['id_pembayaran']]);
                            $this->ubahStatus($data_detail['id_pembayaran'], $data_pembayaran['jenis_pembayaran'], $data_pembayaran['id_transaksi']);
                        }
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        redirect('approve');
                    } else {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        redirect('approve');
                    }
                }
            }
        } else {
            $this->session->set_flashdata('failed', 'Data detail pembayaran tidak ditemukan');
            redirect('approve');
        }
    }

    public function reject($id)
    {
        $escp_id = $id;
        $get_data = $this->modelapp->getData('id_detail,id_pembayaran,jumlah_bayar', 'detail_pembayaran', ['id_detail' => $escp_id]);
        if ($get_data->num_rows() > 0) {
            $rs_detail = $get_data->row_array();
            $sql_reject = $this->modelapp->updateData(['status_owner' => 's'], 'detail_pembayaran', ['id_detail' => $rs_detail['id_detail']]);
            if ($sql_reject) {
                $this->session->set_flashdata('success', 'Data berhasil diubah');
                redirect('approve');
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('approve');
        }
    }

    private function ubahStatus($id_pembayaran, $jenis_pembayaran, $transaksi)
    {
        $data_status = $this->modelapp->getData('COUNT(id_pembayaran) as total', 'pembayaran', ['id_transaksi' => $transaksi, 'jenis_pembayaran' => $jenis_pembayaran])->row_array();
        $total_lunas = $this->modelapp->getData('COUNT(id_pembayaran) as total', 'pembayaran', ['id_transaksi' => $transaksi, 'jenis_pembayaran' => $jenis_pembayaran, 'status' => 'sb'])->row_array();
        if ($data_status['total'] == $total_lunas['total']) {
            if ($jenis_pembayaran == '1') {
                $this->modelapp->updateData(['status_tj' => 's'], 'transaksi', ['id_transaksi' => $transaksi]);
            } elseif ($jenis_pembayaran == '2') {
                $this->modelapp->updateData(['status_um' => 's'], 'transaksi', ['id_transaksi' => $transaksi]);
            } else {
                $this->modelapp->updateData(['status_ccl' => 's'], 'transaksi', ['id_transaksi' => $transaksi]);
            }
        }
    }

    // This function is private. so , anyone cannot to access this function from web based
    private function pages($core_page, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($core_page, $data);
        $this->load->view('partials/part_footer', $data);
    }
    private function pagination()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('approve/index/');
        $config['total_rows'] = $this->modelapp->getData('id_detail', 'tbl_detail_pembayaran')->num_rows();
        $config['use_page_numbers'] = TRUE;
        $config['per_page'] = 10;
        $config['num_links'] = 4;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'Awal';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_link'] = 'Akhir';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';

        $this->pagination->initialize($config);
    }
}

/* End of file Approve.php */
