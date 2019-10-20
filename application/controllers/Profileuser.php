<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profileuser extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library('form_validation');
        //Do your magic here
    }

    public function index($error = null)
    {
        $data['title'] = 'Profile';

        $data['user'] = $this->modelapp->getData('*', 'user', ["id_user" => $_SESSION["id_user"]])->row();
        $data["error"] = $error;
        $data['img'] = getCompanyLogo();
        $this->pages("profile/view_profil", $data);
    }

    public function coreUpdateUser()
    {
        $this->validate();
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $id = $this->session->userdata("id_user");
            $data = [
                "nama_lengkap" => $this->input->post("txt_nama", true),
                "username" => $this->input->post("txt_username", true),
                "jenis_kelamin" => $this->input->post("txt_jk", true),
                "alamat" => $this->input->post("txt_alamat", true),
                "email" => $this->input->post("txt_email", true),
                "no_hp" => $this->input->post("txt_telp", true)
            ];
            $config['upload_path'] = './assets/uploads/images/profil/user/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size']     = '800';
            $config['encrypt_name'] = true;
            $config['max_width'] = '500';
            $config['max_height'] = '500';
            $this->load->library('upload', $config);
            if ($_FILES["upload"]["name"] != "") {
                if ($this->upload->do_upload('upload')) {
                    $getData = $this->modelapp->getData("foto_user", "user", ["id_user" => $id])->row();
                    $path = base_url("assets/uploads/images/profil/user/" . $getData->foto_user);
                    if (!is_dir($path)) {
                        if (file_exists($path)) {
                            unlink($path);
                        }
                    }
                    $img = $this->upload->data();
                    $data += [
                        "foto_user" => $img["file_name"]
                    ];
                    $query = $this->modelapp->updateData($data, "user", ["id_user" => $id]);
                    if ($query) {
                        $this->session->set_flashdata('success', 'Data berhasil diubah');
                        redirect("profileuser");
                    } else {
                        $this->session->set_flashdata('success', 'Data berhasil diubah');
                        redirect("profileuser");
                    }
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect("profileuser");
                }
            } else {
                $query = $this->modelapp->updateData($data, "user", ["id_user" => $id]);
                if ($query) {
                    $this->session->set_flashdata('success', 'Data berhasil diubah');
                    redirect("profileuser");
                } else {
                    $this->session->set_flashdata('success', 'Data berhasil diubah');
                    redirect("profileuser");
                }
            }
        }
    }

    public function authPassword()
    {
        $data['title'] = 'Password';

        $data['img'] = getCompanyLogo();
        $this->pages("profile/view_password", $data);
    }
    public function corePassword()
    {
        $data = ["success" => false];
        $this->form_validation->set_rules('pass_baru', 'Password Baru', 'trim|required');
        $this->form_validation->set_rules('pass_lama', 'Password Lama', 'trim|required');
        $this->form_validation->set_rules('confirm_pass_baru', 'Confirm Password Baru', 'trim|required|matches[pass_baru]');
        if ($this->form_validation->run() == FALSE) {
            $this->authPassword();
        } else {
            $id_user = $this->session->userdata('id_user');
            $pass_lama = $this->input->post('pass_lama', true);
            $pass_baru = $this->input->post('pass_baru', true);
            $getData = $this->modelapp->getData("password", "user", ["id_user" => $id_user]);
            if ($getData->num_rows() > 0) {
                $result = $getData->row();
                $confirm_pass_lama = password_verify($pass_lama, $result->password);
                if ($confirm_pass_lama) {
                    $password = password_hash($pass_baru, PASSWORD_DEFAULT);
                    $this->modelapp->updateData(["password" => $password], "user", ["id_user" => $id_user]);
                    $this->session->sess_destroy();
                    redirect('profileuser/authpassword');
                } else {
                    $this->session->set_flashdata('failed', 'Password lama salah');
                    redirect('profileuser/authpassword');
                }
            }
        }
    }
    private function validate()
    {
        $this->form_validation->set_rules('txt_nama', 'Nama', 'trim|required|min_length[2]|max_length[25]');
        $this->form_validation->set_rules('txt_username', 'Username', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('txt_telp', 'Telepon', 'trim|required|min_length[12]|max_length[13]|numeric');
        $this->form_validation->set_rules('txt_email', 'Email', 'trim|required|min_length[3]|max_length[25]|valid_email');
        $this->form_validation->set_rules('txt_jk', 'Jenis Kelamin', 'trim|required');
        $this->form_validation->set_rules('txt_alamat', 'Alamat', 'trim|required');
    }
    private function pages($view, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($view, $data);
        $this->load->view('partials/part_footer', $data);
    }
}

/* End of file Controllername.php */