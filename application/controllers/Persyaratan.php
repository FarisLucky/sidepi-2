<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Persyaratan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library("form_validation");
    }
    public function index($num = 0)
    {
        $data['title'] = 'Persyaratan';
        $search = '';
        if (isset($_POST['search'])) {
            $search = ['nama_kelompok' => $this->input->post('search')];
            $this->session->set_userdata(array("search" => $search));
        } elseif (isset($_POST['reset'])) {
            $this->session->unset_userdata('search');
        }
        $per_page = 10;
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $data['persyaratan'] = $this->modelapp->getDataLike('*', 'kelompok_persyaratan', $search, 'id_sasaran', 'ASC', $per_page, $num)->result();
        $data['row'] = $num;
        $this->pagination();
        $this->pages("persyaratan/view_syarat", $data);
    }
    public function tambah()
    {
        $data['title'] = 'Tambah Persyaratan';

        $data['img'] = getCompanyLogo();
        $this->pages("persyaratan/view_tambah", $data);
    }

    public function coreTambah()
    {
        $config = $this->validate();
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $input = [
                "nama_kelompok" => $this->input->post("nama", true),
                "kategori_persyaratan" => $this->input->post("type", true),
                "status" => '1',
                "keterangan" => $this->input->post("ket", true)
            ];
            $query = $this->modelapp->insertData($input, 'kelompok_persyaratan');
            if ($query) {
                $this->session->set_flashdata('success', 'Data Berhasil ditambahkan');
                redirect('persyaratan');
            } else {
                $this->session->set_flashdata('failed', 'Data Gagal ditambahkan');
                redirect('persyaratan');
            }
        }
    }

    public function ubah($id)
    {
        $data['title'] = 'Ubah Persyaratan';

        $data['img'] = getCompanyLogo();
        $data["persyaratan"] = $this->modelapp->getData('*', 'kelompok_persyaratan', ['id_sasaran' => $id])->row();
        $this->pages("persyaratan/view_ubahs", $data);
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
            $query = $this->modelapp->updateData($input, 'kelompok_persyaratan', ['id_sasaran' => $id]);
            if ($query) {
                $this->session->set_flashdata('success', 'Data Berhasil diubah');
                redirect('persyaratan');
            }
        }
    }
    public function lock($id)
    {
        $input = $id;
        $get_data = $this->modelapp->getData('id_sasaran,status', 'kelompok_persyaratan', ['id_sasaran' => $input]);
        if ($get_data->num_rows() > 0) {
            $rs_sasaran = $get_data->row();
            if ($rs_sasaran->status == '1') {
                $status = '0';
            } else {
                $status = '1';
            }
            $query = $this->modelapp->updateData(['status' => $status], 'kelompok_persyaratan', ['id_sasaran' => $rs_sasaran->id_sasaran]);
            if ($query) {
                $this->session->set_flashdata('success', 'Data berhasil diubah');
                redirect('persyaratan');
            } else {
                $this->session->set_flashdata('failed', 'Data gagal diubah');
                redirect('persyaratan');
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('persyaratan');
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
        $config = array(
            array(
                'field' => 'nama',
                'label' => 'Nama Persyaratan',
                'rules' => 'trim|required|max_length[50]'
            ),
            array(
                'field' => 'type',
                'label' => 'Type persyaratan',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'ket',
                'label' => 'Keterangan',
                'rules' => 'trim|required'
            )
        );
        return $config;
    }
    private function pagination()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('persyaratan/index/');
        $config['total_rows'] = $this->modelapp->getData('id_sasaran', 'kelompok_persyaratan')->num_rows();
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
