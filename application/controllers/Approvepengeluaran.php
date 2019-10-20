<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Approvepengeluaran extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
    }

    public function index($num = 0)
    {
        $this->load->helper('date');
        $data['title'] = 'Approve Pengeluaran';
        $per_page = 10;
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $data['approve_bayar'] = $this->modelapp->getData('*', 'tbl_pengeluaran', ["status_owner" => "p"], 'id_pengeluaran', 'DESC', $per_page, $num)->result();
        $data['row'] = $num;
        $this->pagination();
        $this->pages("approve/view_approve_pengeluaran", $data);
    }

    public function accept($id)
    {
        $input = $id;
        $get_pengeluaran = $this->modelapp->getData("id_pengeluaran", "pengeluaran", ["id_pengeluaran" => $input]);
        if ($get_pengeluaran->num_rows() > 0) {
            $data_pengeluaran = $get_pengeluaran->row_array();
            $update_pengeluaran = $this->modelapp->updateData(['status_owner' => 'sl'], 'pengeluaran', ['id_pengeluaran' => $data_pengeluaran['id_pengeluaran']]);
            if ($update_pengeluaran) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('approvepengeluaran');
            }
        } else {
            $this->session->set_flashdata('failed', 'Data Pengeluaran tidak ditemukan');
            redirect('approvepengeluaran');
        }
    }

    public function reject($id)
    {
        $input = $id;
        $get_pengeluaran = $this->modelapp->getData("id_pengeluaran", "pengeluaran", ["id_pengeluaran" => $input]);
        if ($get_pengeluaran->num_rows() > 0) {
            $data_pengeluaran = $get_pengeluaran->row_array();
            $update_pengeluaran = $this->modelapp->updateData(['status_owner' => 's'], 'pengeluaran', ['id_pengeluaran' => $data_pengeluaran['id_pengeluaran']]);
            if ($update_pengeluaran) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('approvepengeluaran');
            }
        } else {
            $this->session->set_flashdata('failed', 'Data Pengeluaran tidak ditemukan');
            redirect('approvepengeluaran');
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

        $config['base_url'] = base_url('approvepengeluaran/index/');
        $config['total_rows'] = $this->modelapp->getData('id_pengeluaran', 'tbl_pengeluaran')->num_rows();
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
