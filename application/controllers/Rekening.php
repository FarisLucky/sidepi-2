<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekening extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library("form_validation");
    }
    public function index($num = 0)
    {
        $data['title'] = 'Rekening';
        $search = '';
        if (isset($_POST['search'])) {
            $search = ['pemilik' => $this->input->post('search')];
            $this->session->set_userdata(array("search" => $search));
        } elseif (isset($_POST['reset'])) {
            $this->session->unset_userdata('search');
        }
        $per_page = 10;
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $data['title'] = 'Properti';
        $data['rekening'] = $this->modelapp->getDataLike('*', 'rekening_properti', $search, 'id_rekening', 'ASC', $per_page, $num)->result_array();
        $data['row'] = $num;
        $this->pagination();
        $this->pages("rekening/view_rekening", $data);
    }
    public function tambah()
    {
        $data['title'] = 'Tambah Rekening';
        $this->pages("rekening/view_tambah", $data);
    }

    public function coreTambah()
    {
        $this->validate();
        if ($this->form_validation->run() == false) {
            $this->tambah();
        } else {
            $input = $this->input();
            if ($_POST['lock'] == 'l') {
                $input += ['status' => '1'];
            } else {
                $input += ['status' => '0'];
            }
            $query_insert = $this->modelapp->insertData($input, 'rekening_properti');
            if ($query_insert) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
                redirect('rekening/tambah');
            } else {
                $this->session->set_flashdata('failed', 'Data gagal ditambahkan');
                redirect('rekening/tambah');
            }
        }
    }

    public function ubah($id)
    {
        $data['title'] = 'Ubah Rekening';

        $data['img'] = getCompanyLogo();
        $data["rek"] = $this->modelapp->getData('*', 'rekening_properti', ['id_rekening' => $id])->row_array();
        $this->pages("rekening/view_ubah", $data);
    }

    public function coreUbah()
    {
        $id = $this->input->post("input_hidden", true);
        $config = $this->validate();
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->ubah($id);
        } else {
            $input = [
                "nama_kelompok" => $this->input->post("nama", true),
                "kategori_persyaratan" => $this->input->post("type", true),
                "keterangan" => $this->input->post("ket", true)
            ];
            if ($_POST['lock'] == 'l') {
                $input += ['status' => '1'];
            } else {
                $input += ['status' => '0'];
            }
            $query = $this->modelapp->updateData($input, 'kelompok_persyaratan', ['id_sasaran' => $id]);
            if ($query) {
                $this->session->set_flashdata('success', 'Data Berhasil diubah');
                redirect('persyaratan');
            }
        }
    }
    public function hapus($id)
    {
        $status = '';
        $input = $id;
        $get_data = $this->modelapp->getData('id_sasaran,status', 'kelompok_persyaratan');
        if ($get_data->num_rows() > 0) {
            $rs_sasaran = $get_data->row();
            if ($rs_sasaran->status == 'a') {
                $status = 't';
            } else {
                $status = 'a';
            }
            $query = $this->modelapp->deleteData('kelompok_persyaratan', ['id_sasaran' => $rs_sasaran->id_sasaran]);
            if ($query) {
                $this->session->set_flashdata('success', 'Data berhasil diUbah');
                redirect('persyaratan');
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('persyaratan');
        }
    }

    public function coreStatus($id)
    {
        $input = $id;
        $get_data = $this->modelapp->getData('id_rekening,status', 'rekening_properti', ['id_rekening' => $input]);
        if ($get_data->num_rows() > 0) {
            $rs_rekening = $get_data->row_array();
            if ($rs_rekening['status'] == '0') {
                $data_update = ['status' => '1'];
            } else {
                $data_update = ['status' => '0'];
            }
            $query_update = $this->modelapp->updateData($data_update, 'rekening_properti', ['id_rekening' => $rs_rekening['id_rekening']]);
            if ($query_update) {
                $this->session->set_flashdata('success', 'Data berhasil diubah');
                redirect('rekening');
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('rekening');
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
    private function validate()
    {
        $this->form_validation->set_rules('no_rek', 'No Rekening', 'trim|required|min_length[3]|max_length[16]');
        $this->form_validation->set_rules('bank', 'Bank', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('pemilik', 'Pemilik Rekening', 'trim|required|min_length[5]|max_length[25]');
    }
    private function input()
    {
        return [
            'no_rekening' => $this->input->post('no_rek', true),
            'bank' => $this->input->post('bank', true),
            'pemilik' => $this->input->post('pemilik', true),
        ];
    }
    private function pagination()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('rekening/index/');
        $config['total_rows'] = $this->modelapp->getData('id_user', 'user')->num_rows();
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

/* End of file Laporan_Keuangan.php */
