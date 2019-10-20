<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calonkonsumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library('form_validation');
    }

    public function index($num = 0)
    {
        $data['title'] = 'Calon Konsumen';
        $per_page = 10;
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $data['konsumen'] = $this->modelapp->getData('*', 'konsumen', ['status_konsumen' => 'ck', 'id_user' => $this->session->userdata('id_user')], 'id_konsumen', 'ASC', $per_page, $num)->result();
        $data['row'] = $num;
        $this->pagination();
        $this->pages("konsumen/view_calon", $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Calon';
        $this->pages('konsumen/view_tambah_calon', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Konsumen';

        $data['konsumen'] = $this->modelapp->getData("*", "konsumen", ['id_konsumen' => $id])->row_array();
        $this->pages('konsumen/view_edit_calon', $data);
    }

    public function hapus($id)
    {
        $value = ['id_konsumen' => $id];
        $query = $this->modelapp->getData("id_konsumen,foto_ktp", "konsumen", $value);
        if ($query->num_rows() > 0) {
            $delete  = $this->modelapp->deleteData($value, "konsumen");
            if ($delete) {
                $this->session->set_flashdata("success", "Data berhasil dihapus");
                redirect("calonkonsumen");
            }
        } else {
            $this->session->set_flashdata("failed", "Data tidak ditemukan");
            redirect("calonkonsumen");
        }
    }

    public function coreTambah()
    {
        $this->validate();
        if ($this->form_validation->run() == false) {
            $this->tambah();
        } else {
            $input = $this->inputData();
            $input += [
                'status_konsumen' => "ck",
                'tgl_buat' => date('Y-m-d H:i:s'),
                'id_user' => $this->session->userdata('id_user')
            ];
            $query = $this->modelapp->insertData($input, "konsumen");
            if ($query) {
                $this->session->set_flashdata("success", "Data berhasil ditambahkan");
                redirect('calonkonsumen/tambah');
            } else {
                $this->session->set_flashdata("failed", "Data gagal ditambahkan");
                redirect('calonkonsumen/tambah');
            }
        }
    }

    public function coreUbah()
    {
        $id = $this->input->post("val_id_konsumen", true);
        $this->validate();
        if ($this->form_validation->run() == false) {
            // var_dump(form_error());
            $this->edit($id);
        } else {
            $input = $this->inputData();
            $query = $this->modelapp->updateData($input, "konsumen", ["id_konsumen" => $id]);
            if ($query) {
                $this->session->set_flashdata("success", "Data berhasil diubah");
                redirect('calonkonsumen/edit/' . $id);
            } else {
                $this->session->set_flashdata("failed", "Data gagal ditambahkan");
                redirect('calonkonsumen/edit/' . $id);
            }
        }
    }

    private function validate()
    {
        $this->form_validation->set_rules('val_id_type', 'Type Card', 'trim|required');
        $this->form_validation->set_rules('val_id_card', "Id card", "trim|required|numeric|max_length[18]");
        $this->form_validation->set_rules('val_nama_konsumen', "Nama Konsumen", "trim|required|max_length[25]");
        $this->form_validation->set_rules('val_alamat', "Alamat", "trim|required");
        $this->form_validation->set_rules('val_nomor_telepon', "nomor telepon", "trim|required|numeric|max_length[13]");
        $this->form_validation->set_rules('val_email', "Email", "trim|valid_email|max_length[25]");
    }

    private function inputData()
    {
        $post = [
            'id_type' => $this->input->post('val_id_type', true), //val_id_type : name yang ada di view
            'id_card' => $this->input->post('val_id_card', true),
            'nama_lengkap' => $this->input->post('val_nama_konsumen', true),
            'alamat' => $this->input->post('val_alamat', true),
            'telp' => $this->input->post('val_nomor_telepon', true),
            'email' => $this->input->post('val_email', true)
        ];
        return $post;
    }

    private function pages($path, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($path, $data);
        $this->load->view('partials/part_footer', $data);
    }
    private function initImage()
    {
        $config['upload_path'] = "./assets/uploads/images/konsumen/";
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['encrypt_name'] = true;
        $config['max_size']  = '1048';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        return $config;
    }
    private function pagination()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('calonkonsumen/index/');
        $config['total_rows'] = $this->modelapp->getData("id_konsumen", 'konsumen', ['status_konsumen' => 'ck', 'id_user' => $this->session->userdata('id_user')])->num_rows();
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
