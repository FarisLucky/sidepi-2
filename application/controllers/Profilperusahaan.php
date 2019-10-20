<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profilperusahaan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Profil';

        $data['perusahaan'] = $this->modelapp->getData("*", "perusahaan")->row_array();
        $data['img'] = getCompanyLogo();
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view('profil_perusahaan/view_profil', $data);
        $this->load->view('partials/part_footer', $data);
    }
    public function update()
    {
        $this->form_validation->set_rules('txt_siup', 'SIUP', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('txt_tdp', 'TDP', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('txt_namaperusahaan', 'Nama', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('txt_email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('txt_telp', 'Telp', 'trim|required|max_length[13]');
        $this->form_validation->set_rules('txt_alamat', 'Alamat', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $input = [
                'siup' => $this->input->post('txt_siup', true),
                'tanda_daftar_perusahaan' => $this->input->post('txt_tdp', true),
                'nama' => $this->input->post('txt_namaperusahaan', true),
                'email' => $this->input->post('txt_email', true),
                'telepon' => $this->input->post('txt_telp', true),
                'alamat' => $this->input->post('txt_alamat')
            ];
            $data_id = $this->input->post('txt_id');
            $config['upload_path'] = './assets/uploads/images/profil/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['encrypt_name'] = true;
            $config['max_size']  = '1028';
            $config['max_width']  = '500';
            $config['max_height']  = '500';
            $this->load->library('upload', $config);
            if ($_FILES['image']['name'] != "") {
                if ($this->upload->do_upload('image')) {
                    $link = $this->modelapp->getData("logo_perusahaan", "perusahaan", ["id_perusahaan" => $data_id])->row_array();
                    $path = "./assets/uploads/images/properti/" . $link['logo_perusahaan'];
                    if (file_exists($path) && !is_dir($path)) {
                        unlink($path);
                    }
                    $img = $this->upload->data();
                    $input += ['logo_perusahaan' => $img['file_name']];
                    $query = $this->modelapp->updateData($input, "perusahaan", ["id_perusahaan" => $data_id]);
                    if ($query) {
                        $this->session->set_flashdata("success", "Berhasil diubah");
                        redirect("profilperusahaan");
                    }
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata("error", $error);
                    $this->index();
                }
            } else {
                $query = $this->modelapp->updateData($input, "perusahaan", ["id_perusahaan" => $data_id]);
                if ($query) {
                    $this->session->set_flashdata("success", "Berhasil diubah");
                    redirect("profilperusahaan");
                }
            }
        }
    }
}

/* End of file ProfilPerumahan.php */
