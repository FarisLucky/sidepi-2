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
        $data['title'] = 'Approve Pembayaran';
        $per_page = 10;
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $select = '*';
        $tbl = 'tbl_detail_pembayaran';
        $where = ["status_diterima" => NULL];
        if (isset($_SESSION['id_properti'])) {
            $where += ['id_properti' => $_SESSION['id_properti']];
        }
        $order_by = 'id_detail';
        $order_tipe = 'ASC';
        $data['approve_bayar'] = $this->modelapp->getData($select, $tbl, $where, $order_by, $order_tipe, $per_page, $num)->result_array();
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

                $this->db->trans_start(); //Database Transacation
                $hutang = $data_bayar['hutang'] - $data_detail['jumlah_bayar'];
                $ttl_bayar = $data_bayar['total_bayar'] + $data_detail['jumlah_bayar'];
                $data_update_detail = ['status_diterima' => 'terima', 'diterima_oleh' => $_SESSION['id_user']];
                $where_detail = ['id_detail' => $data_detail['id_detail']];
                //Update Detail Pembayaran
                $this->modelapp->updateData($data_update_detail, 'detail_pembayaran', $where_detail);
                //Update Hutang dan Total Bayar di Pembayaran
                $this->modelapp->updateData(['hutang' => $hutang, 'total_bayar' => $ttl_bayar], 'pembayaran', ['id_pembayaran' => $data_detail['id_pembayaran']]);
                //Ambil Data Pembayaran lagi untuk status pembayaran di tabel transaksi
                $data_pembayaran = $this->modelapp->getData('hutang,jenis_pembayaran,id_transaksi', 'pembayaran', ['id_pembayaran' => $data_detail['id_pembayaran']])->row_array();
                if ($data_pembayaran['hutang'] == '0') {
                    $data_update = ['status' => 'sb'];
                    $this->modelapp->updateData($data_update, 'pembayaran', ['id_pembayaran' => $data_detail['id_pembayaran']]);
                }
                $this->db->trans_complete(); // End of Transaction Database Auth concept

                if ($this->db->trans_status() === FALSE) {
                    $this->session->set_flashdata("failed", "Gagal disimpan");
                    redirect('approve');
                } else {
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    redirect('approve');
                }
            }
        } else {
            $this->session->set_flashdata('failed', 'Data detail pembayaran tidak ditemukan');
            redirect('approve');
        }
    }

    public function reject()
    {
        $id_detail = $this->input->post('input_hidden', true);
        $deskripsi_tolak = $this->input->post('penolakan', true);
        $get_data = $this->modelapp->getData('id_detail,id_pembayaran,jumlah_bayar', 'detail_pembayaran', ['id_detail' => $id_detail]);
        if ($get_data->num_rows() > 0) {
            $rs_detail = $get_data->row_array();
            $data_update = ['status_diterima' => 'tolak', 'deskripsi_tolak' => $deskripsi_tolak, 'diterima_oleh' => $_SESSION['id_user']];
            $where = ['id_detail' => $rs_detail['id_detail']];
            $sql_reject = $this->modelapp->updateData($data_update, 'detail_pembayaran', $where);
            if ($sql_reject) {
                $this->session->set_flashdata('success', 'Data berhasil diubah');
                redirect('approve');
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('approve');
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
