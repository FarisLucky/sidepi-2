<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Approvepemasukan extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
    }

    public function index()
    {
        $this->load->helper('date');
        $data['title'] = 'Approve Pemasukan';
        $data['img'] = getCompanyLogo();
        $data['approve_bayar'] = $this->modelapp->getData("*", "tbl_pemasukan", ['status_owner' => 'p'], 'id_pemasukan', 'DESC')->result();
        $this->pages("approve/view_approve_pemasukan", $data);
    }

    public function accept($id)
    {
        $input = $id;
        $get_pemasukan = $this->modelapp->getData("id_pemasukan", "pemasukan", ["id_pemasukan" => $input]);
        if ($get_pemasukan->num_rows() > 0) {
            $data_pemasukan = $get_pemasukan->row_array();
            $update_pemasukan = $this->modelapp->updateData(['status_owner' => 'sl'], 'pemasukan', ['id_pemasukan' => $data_pemasukan['id_pemasukan']]);
            if ($update_pemasukan) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('approvepemasukan');
            }
        } else {
            $this->session->set_flashdata('failed', 'Data Pemasukan tidak ditemukan');
            redirect('approvepemasukan');
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
}

/* End of file Approve.php */
