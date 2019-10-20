<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kelolauser extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library("form_validation");
    }

    public function index($num = 0)
    {
        $data['title'] = 'User';
        $search = '';
        if (isset($_POST['search'])) {
            $search = ['nama_lengkap' => $this->input->post('search')];
            $this->session->set_userdata(array("search" => $search));
        } elseif (isset($_POST['reset'])) {
            $this->session->unset_userdata('search');
        }
        $per_page = 10;
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $data['user'] = $this->modelapp->getDataLike('*', 'tbl_users', $search, 'id_user', 'ASC', $per_page, $num)->result();
        $data['row'] = $num;
        $this->pagination();
        $this->pages('kelola_user/view_kelola_user', $data);
    }

    public function tambah() //Menampilkan Form Tambah
    {
        $data['title'] = 'Tambah User';
        $data['akses'] = $this->modelapp->getData("*", "user_role")->result(); //Mengambil data role akses
        $data['img'] = getCompanyLogo();
        $this->pages('kelola_user/view_tambah_user', $data);
    }
    public function coreTambah() //Core Tambah
    {
        $this->validate();
        if ($this->form_validation->run() == false) {
            $this->tambah();
        } else {
            $input = $this->inputPost();
            $password = password_hash($this->input->post('txt_password', true), PASSWORD_DEFAULT);
            $input += ["password" => $password, "foto_user" => "default.jpg", 'tanggal_buat' => date('Y-m-d')];
            $act = $this->modelapp->insertData($input, "user");
            if ($act) {
                $this->session->set_flashdata('success', "Berhasil ditambahkan");
                redirect("kelolauser/tambah");
            }
        }
    }

    public function aktifNonaktif($id) //Fungsi Mengubah status User
    {
        $input = (int) $id;
        $get_status = $this->modelapp->getData("status_user", "user", ["id_user" => $input]);
        if ($get_status->num_rows() > 0) {
            $status = $get_status->row_array();
            if ($status["status_user"] == "aktif") {
                $set_status = "nonaktif";
            } else {
                $set_status = "aktif";
            }
            $query = $this->modelapp->updateData(["status_user" => $set_status], "user", ["id_user" => $input]);
            if ($query) {
                $this->session->set_flashdata("success", "Berhasil diubah");
                redirect("kelolauser");
            } else {
                $this->session->set_flashdata("failed", "Gagal diubah");
                redirect("kelolauser");
            }
        } else {
            $this->session->set_flashdata("failed", "User tidak ditemukan");
            redirect("kelolauser");
        }
    }

    public function detailUser($id) //FUngsi menampilkan form detail
    {
        $active = 'Detail User';
        $data['title'] = 'Detail User';

        $data['users'] = $this->modelapp->getJoinData('*', 'user', ['user_role' => 'user.id_akses = user_role.id_akses'], ["id_user" => $id])->row();
        $data['properti'] = $this->modelapp->getData("id_properti,nama_properti,foto_properti", "properti", ["status" => "publish"])->result();
        $data['img'] = getCompanyLogo();
        $this->pages('kelola_user/view_detail_user', $data);
    }
    public function userProperti() //Menambahkan user assign properti
    {
        $id = $this->input->post('hidden_user', true);
        $properti = $this->input->post('user_properti');
        if (isset($properti)) {
            $this->modelapp->deleteData(["id_user" => $id], "user_assign_properti");
            foreach ($properti as $key => $value) {
                $this->modelapp->insertData(["id_properti" => $value, "id_user" => $id], "user_assign_properti");
            }
            $this->session->set_flashdata("success", "Berhasil ditambahkan");
            redirect("kelolauser/detailuser/" . $id);
        } else {
            $this->modelapp->deleteData(["id_user" => $id], "user_assign_properti");
            $this->session->set_flashdata("success", "Berhasil diubah");
            redirect("kelolauser/detailuser" . $id);
        }
    }
    public function hapus($id) //Menghapus User
    {
        $foto = $this->modelapp->getData("foto_user", "user", ["id_user" => $id])->row_array();
        $path = "./assets/uploads/images/profil/user/" . $foto["foto_user"];
        if ($foto["foto_user"] != "default.jpg") {
            if (file_exists($path) && !is_dir($path)) {
                unlink($path);
            }
        }
        $hapus = $this->modelapp->deleteData(["id_user" => $id], "user");
        if ($hapus) {
            $this->session->set_flashdata('success', "Berhasil dihapus");
            redirect("kelolauser");
        } else {
            $this->session->set_flashdata('failed', "Gagal dihapus");
            redirect("kelolauser");
        }
    }
    public function changePassword()
    {
        $this->form_validation->set_rules('pw_baru', 'Password Baru', 'trim|required');
        $this->form_validation->set_rules('confirm_pw_baru', 'Confirm Password', 'trim|required|matches[pw_baru]');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', form_error('confirm_pw_baru'));
            redirect('kelolauser');
        } else {
            $id = $this->input->post('input_hidden', true);
            $new_pass = $this->input->post("pw_baru", true);
            $password = password_hash($new_pass, PASSWORD_DEFAULT);
            $change = $this->modelapp->updateData(["password" => $password], "user", ["id_user" => $id]);
            if ($change) {
                $this->session->set_flashdata('success', "Data berhasil disimpan");
                redirect("kelolauser");
            } else {
                $this->session->set_flashdata('failed', "Tidak ada perubahan");
                redirect("kelolauser");
            }
        }
    }

    private function validate()
    {
        $this->form_validation->set_rules('txt_nama', 'Nama', 'trim|required|max_length[25]|min_length[3]');
        $this->form_validation->set_rules('txt_akses', 'Hak Akses', 'trim|required');
        $this->form_validation->set_rules('txt_telp', 'Telp', 'trim|required|max_length[13]|min_length[10]|greater_than[0]|is_unique[user.no_hp]');
        $this->form_validation->set_rules('txt_username', 'Username', 'trim|required|is_unique[user.username]|max_length[20]');
        $this->form_validation->set_rules('txt_email', 'Email', 'trim|required|valid_email|max_length[25]');
        $this->form_validation->set_rules('txt_status', 'Status', 'trim|required');
        $this->form_validation->set_rules('txt_password', 'Password', 'trim|required');
        $this->form_validation->set_rules('txt_retype_password', 'Password', 'trim|required|matches[txt_password]');
        $this->form_validation->set_rules('radio_jk', 'jenis kelamin', 'trim|required');
    }

    private function inputPost()
    {
        $input = [
            'nama_lengkap' => $this->input->post('txt_nama', true),
            'id_akses' => $this->input->post('txt_akses', true),
            'no_hp' => $this->input->post('txt_telp', true),
            'email' => $this->input->post('txt_email', true),
            'jenis_kelamin' => $this->input->post('radio_jk', true),
            'username' => $this->input->post('txt_username', true),
            'status_user' => $this->input->post('txt_status', true)
        ];
        return $input;
    }

    private function pages($page, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($page, $data);
        $this->load->view('partials/part_footer', $data);
    }
    private function pagination()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('kelolauser/index/');
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

/* End of file Controllername.php */
