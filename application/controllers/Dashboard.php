<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $session = $this->session->userdata('id_user');
        $this->load->helper('date');
        if (empty($session)) {
            redirect('auth');
        } else if (($this->session->userdata('id_properti') == null) && ($_SESSION['id_akses'] != 1)) {
            redirect("auth/authproperti");
        }
    }
    public function index()
    {
        if (($this->session->userdata('login') == null)) {
            redirect('auth');
        } else {
            $id_user = $this->session->userdata('id_user');
            $query = $this->modelapp->getData("*", 'user', ['id_user' => $id_user])->row();
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
    }
    public function owner()
    {
        $id_user = $this->session->userdata('id_user');
        $query = $this->modelapp->getData("*", 'user', ['id_user' => $id_user])->row();
        if ($query->id_akses != 1) {
            redirect('auth/blocked');
        } else {
            $data['title'] = "Dashboard";
            $data['total_transaksi'] = $this->modelapp->getData('COUNT(id_transaksi) as total', 'transaksi', ['MONTH(tgl_transaksi)' => date('m')])->row_array();
            $data['total_konsumen'] = $this->modelapp->getData('COUNT(id_konsumen) as total', 'konsumen', ['MONTH(tgl_buat)' => date('m'), 'status_konsumen' => 'ck'])->row_array();
            $data['total_pengeluaran'] = $this->modelapp->getData('SUM(total_harga) as total', 'pengeluaran', ['MONTH(tgl_buat)' => date('m')])->row_array();
            $data['total_pemasukan'] = $this->modelapp->getData('SUM(total_harga) as total', 'pemasukan', ['MONTH(tgl_buat)' => date('m')])->row_array();

            $this->load->view('partials/part_navbar', $data);
            $this->load->view('partials/part_sidebar', $data);
            $this->load->view('dashboard/owner', $data);
            $this->load->view('partials/part_footer', $data);
        }
    }
    public function manager()
    {
        $id_user = $this->session->userdata('id_user');
        $query = $this->modelapp->getData("*", 'user', ['id_user' => $id_user])->row();
        if ($query->id_akses != 2) {
            redirect('auth/blocked');
        } else {
            $id_properti = $_SESSION['id_properti'];
            $data['title'] = "Manager Dashboard";
            $data['total_unit'] = $this->modelapp->getData('COUNT(id_unit) as total', 'unit', ['status_unit' => 'bt', 'id_properti' => $id_properti])->row_array();
            $data['total_konsumen'] = $this->modelapp->getData('COUNT(id_konsumen) as total', 'konsumen', ['MONTH(tgl_buat)' => date('m'), 'status_konsumen' => 'ck'])->row_array();
            $data['total_pengeluaran'] = $this->modelapp->getData('SUM(total_harga) as total', 'pengeluaran', ['MONTH(tgl_buat)' => date('m'), 'id_properti' => $id_properti])->row_array();
            $data['total_pemasukan'] = $this->modelapp->getData('SUM(total_harga) as total', 'pemasukan', ['MONTH(tgl_buat)' => date('m'), 'id_properti' => $id_properti])->row_array();

            $this->load->view('partials/part_navbar', $data);
            $this->load->view('partials/part_sidebar', $data);
            $this->load->view('dashboard/manager', $data);
            $this->load->view('partials/part_footer', $data);
        }
    }
    public function marketing()
    {
        $id_user = $this->session->userdata('id_user');
        $query = $this->modelapp->getData("*", 'user', ['id_user' => $id_user])->row();
        if ($query->id_akses != 4) {
            redirect('auth/blocked');
        } else {
            $data['title'] = "Marketing Dashboard";
            $user = $_SESSION['id_user'];
            $id_properti = $_SESSION['id_properti'];
            $data['total_unit'] = $this->modelapp->getData('COUNT(id_unit) as total', 'unit', ['status_unit' => 'bt', 'id_properti' => $id_properti])->row_array();
            $data['unit_terjual'] = $this->modelapp->getData('COUNT(id_unit) as total', 'transaksi', ['id_user' => $user, 'DAY(tgl_transaksi)' => date('d'), 'status_transaksi' => 'p'])->row_array();
            $data['total_calon'] = $this->modelapp->getData('COUNT(id_konsumen) as total', 'konsumen', ['DAY(tgl_buat)' => date('d'), 'id_user' => $user, 'status_konsumen' => 'ck'])->row_array();
            $data['total_semua_calon'] = $this->modelapp->getData('COUNT(id_konsumen) as total', 'konsumen', ['id_user' => $user, 'status_konsumen' => 'ck'])->row_array();

            $this->load->view('partials/part_navbar', $data);
            $this->load->view('partials/part_sidebar', $data);
            $this->load->view('dashboard/marketing', $data);
            $this->load->view('partials/part_footer', $data);
        }
    }
    public function admin()
    {
        $id_user = $this->session->userdata('id_user');
        $query = $this->modelapp->getData("*", 'user', ['id_user' => $id_user])->row();
        if ($query->id_akses != 3) {
            redirect('auth/blocked');
        } else {
            $data['title'] = "Admin Dashboard";
            $user = $_SESSION['id_user'];
            $id_properti = $_SESSION['id_properti'];
            $data['total_unit'] = $this->modelapp->getData('COUNT(id_unit) as total', 'unit', ['status_unit' => 'bt', 'id_properti' => $id_properti])->row_array();
            $data['unit_terjual'] = $this->modelapp->getData('COUNT(id_unit) as total', 'transaksi', ['id_user' => $user, 'DAY(tgl_transaksi)' => date('d'), 'status_transaksi' => 'p'])->row_array();
            $data['total_calon'] = $this->modelapp->getData('COUNT(id_konsumen) as total', 'konsumen', ['DAY(tgl_buat)' => date('d'), 'id_user' => $user, 'status_konsumen' => 'ck'])->row_array();
            $data['total_semua_calon'] = $this->modelapp->getData('COUNT(id_konsumen) as total', 'konsumen', ['id_user' => $user, 'status_konsumen' => 'ck'])->row_array();

            $this->load->view('partials/part_navbar', $data);
            $this->load->view('partials/part_sidebar', $data);
            $this->load->view('dashboard/admin', $data);
            $this->load->view('partials/part_footer', $data);
        }
    }

    // Polling Request
    public function get_new_msgs()
    {

        $data = $this->modelapp->getData('*', 'pengeluaran')->row_array();
        echo json_encode(array(
            'msgs' => $data,
            // response again the server time to update the "js time variable"
            'time' => time()
        ));
    }
    public function get_time()
    {
        echo time();
    }
}

/* End of file Controllername.php */
