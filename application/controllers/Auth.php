<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('login') == true) {
            $id_user = $this->session->userdata('id_user');
            $this->checkDashboard($id_user);
        }
        $this->load->view('auth_login/view_auth');
    }
    public function coreLogin()
    {
        $this->form_validation->set_rules('auth_user', 'Username', 'trim|required');
        $this->form_validation->set_rules('auth_pass', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $input = [
                'username' => $this->input->post('auth_user', true),
                'password' => $this->input->post('auth_pass', true)
            ];
            $user = $this->modelapp->getData("*", "user", ["username" => $input["username"]]);
            if ($user->num_rows() > 0) {
                $rows = $user->row();
                if (password_verify($input['password'], $rows->password)) {
                    if ($rows->status_user === 'aktif') {

                        $role_access = $this->modelapp->getData('controller_name', 'tbl_role_access', ['id_role' => $rows->id_akses])->result_array();
                        $data_access = [];
                        if (!empty($role_access)) {
                            foreach ($role_access as $value) {
                                $data_access[] = $value['controller_name'];
                            }
                        }

                        $data['auth'] = "Berhasil Login";
                        $data['success'] = true;
                        $data['redirect'] = "dashboard";

                        $session = [
                            'id_user' => $rows->id_user,
                            'username' => $rows->username,
                            'id_akses' => $rows->id_akses,
                            'controllers' => $data_access,
                            'login' => true
                        ];
                        $this->session->set_userdata($session);
                        if ($rows->id_akses != 1) {
                            redirect('auth/authproperti');
                        } else {
                            redirect('dashboard');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Akun Anda Sedang dinonaktifkan');
                        $this->index();
                    }
                } else {
                    $this->session->set_flashdata('error', 'Password tidak cocok');
                    $this->index();
                }
            } else {
                $this->session->set_flashdata('error', 'User tidak ditemukan');
                $this->index();
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
    public function blocked()
    {
        $this->checkLogin();
        $id_user = $this->session->userdata('id_user');
        $query = $this->modelapp->getData("*", 'user', ['id_user' => $id_user])->row();
        if ($query->id_akses == 1) {
            $data['redirect'] = base_url() . 'dashboard';
        } elseif ($query->id_akses == 2) {
            $data['redirect'] = base_url() . 'dashboard/manager';
        } elseif ($query->id_akses == 3) {
            $data['redirect'] = base_url() . 'dashboard/admin';
        } else {
            $data['redirect'] = base_url() . 'dashboard/marketing';
        }
        $this->load->view('errors/custom_error_access', $data);
    }

    public function coreAuthProperti()
    {
        $id_user = $this->session->userdata('id_user');
        $id = (int)$this->input->post('check_properti', true);
        if (!empty($id)) {
            $array = array(
                'id_properti' => $id
            );
            $this->session->set_userdata($array);
            redirect("dashboard");
        } else {
            $this->session->set_flashdata('error', 'Pilih properti dulu');
            $this->authProperti();
        }
    }

    public function authProperti()
    {
        if ((empty($_SESSION['id_properti'])) && ($_SESSION["id_akses"] != 1)) {
            $id_user = $this->session->userdata('id_user');
            $get_user = $this->modelapp->getData("*", "user_assign_properti", ["id_user" => $id_user]);
            if ($get_user->num_rows() > 0) {
                $result = $get_user->result();
                $query_result = [];
                foreach ($result as $key => $value) {
                    $id_properti = $value->id_properti;
                    $properti = $this->modelapp->getData("*", "properti", ["id_properti" => $id_properti])->row();
                    $array = [];
                    $array['id'] = $properti->id_properti;
                    $array['nama'] = $properti->nama_properti;
                    $array['foto'] = $properti->foto_properti;
                    $query_result[] = $array;
                }
            } else {
                $query_result = null;
            }
            $data['properti_user'] = $query_result;
            $this->load->view('auth_login/view_auth_properti', $data);
        } else {
            $id_user = $this->session->userdata('id_user');
            $this->checkDashboard($id_user);
        }
    }

    public function reSelectProperti($id)
    {
        if (intval($id)) {
            $_SESSION['id_properti'] = $id;
        }
        redirect('dashboard');
    }

    private function checkDashboard($id_user)
    {
        $query = $this->modelapp->getData('*', 'user', ['id_user' => $id_user])->row();
        if ($query->id_akses == 1) {
            redirect('dashboard/owner');
        } elseif ($query->id_akses == 2) {
            redirect('dashboard/manager');
        } elseif ($query->id_akses == 3) {
            redirect('dashboard/admin');
        } else {
            redirect('dashboard/marketing');
        }
    }
    private function checkLogin()
    {
        $login = $this->session->userdata('login');
        if ($login == null) {
            redirect('auth');
        }
    }
}

/* End of file Auth.php */
