<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporanpengeluaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
    }
    public function index()
    {
        if (isset($_SESSION['id_properti']) || isset($_SESSION['laporan_pengeluaran'])) {
            redirect('laporanpengeluaran/list');
            exit();
        }
        $data['title'] = 'Laporan Pengeluaran';
        $data['href'] = base_url('laporanpengeluaran/coreauth');
        $data['properti'] = $this->modelapp->getData('id_properti,nama_properti', 'properti')->result_array();
        $this->pages('auth_laporan/auth_laporan', $data);
    }
    public function coreAuth()
    {
        $properti = $this->input->post('properti', true);
        if (!empty($properti)) {
            $session = ['laporan_pengeluaran' => $properti];
            $this->session->set_userdata($session);
            redirect('laporanpengeluaran/list', 'refresh');
        } else {
            redirect('laporanpengeluaran');
        }
    }
    public function list($num = 0)
    {
        if (isset($_SESSION['id_properti'])) {
            $id = $_SESSION['id_properti'];
        } elseif (isset($_SESSION['laporan_pengeluaran'])) {
            $id = $_SESSION['laporan_pengeluaran'];
        } else {
            redirect('laporanpengeluaran');
            exit();
        }
        $per_page = 10;
        $search = '';
        // Pencarian Action
        if (isset($_POST['submit']) && $_POST['search'] != '') {
            $search = ['nama_unit' => $this->input->post('search')];
            $this->session->set_userdata(array("search" => $search));
        } elseif (isset($_POST['reset'])) {
            $this->session->unset_userdata('search');
        } else {
            if (isset($_SESSION['search'])) {
                $search = $this->session->userdata('search');
            }
        }
        // Filter Action
        $where = [];
        if (isset($_POST['filter_submit'])) {
            if ($_POST['id_kelompok'] != '') {
                $where += ['id_kelompok' => $this->input->post('id_kelompok')];
                $this->session->set_userdata(array("filter_cari" => $where));
            }
            if ($_POST['tgl_mulai'] != '') {
                $where += ['tgl_buat >=' => $this->input->post('tgl_mulai')];
            }
            if ($_POST['tgl_akhir'] != '') {
                $where += ['tgl_buat <=' => $this->input->post('tgl_akhir')];
            }
        } elseif (isset($_POST['filter_reset'])) {
            $this->session->unset_userdata('filter_cari');
            $where = [];
        } else {
            if (isset($_SESSION['filter_cari'])) {
                $where = $this->session->userdata('filter_cari');
            }
        }
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $where += ['status_owner' => 'sl', 'status_manager' => 'sl', 'id_properti' => $id];
        $data['title'] = 'Laporan Pengeluaran';
        $data['pengeluaran'] = $this->modelapp->getDataLike("*", "tbl_pengeluaran", $search, 'id_pengeluaran', 'ASC ', $per_page, $num, $where)->result_array();
        $data["kelompok"] = $this->modelapp->getData("*", "kelompok_item", ["id_kategori" => 3])->result();
        $data['total'] = $this->modelapp->getData('SUM(total_harga) as total', 'tbl_pengeluaran', $where)->row_array();
        $data['row'] = $num;
        $this->pagination($where);
        $data['properti'] = $this->modelapp->getData('nama_properti', 'properti', ['id_properti' => $id])->row_array();
        $this->pages("laporan/pengeluaran/view_pengeluaran", $data);
    }
    public function resetProperti()
    {
        if (isset($_SESSION['laporan_pengeluaran'])) {
            $session = ['laporan_pengeluaran', 'filter_cari', 'search'];
            $this->session->unset_userdata($session);
        }
        redirect('laporanpengeluaran');
    }

    public function printAll()
    {
        $this->load->library('Pdf');
        $this->load->helper('date');
        $data['img'] = getCompanyLogo();
        $where = $this->whereData();
        $data['pengeluaran'] = $this->modelapp->getData("*", "tbl_pengeluaran", $where)->result_array();
        // $this->load->view("print/print_pengeluaran",$where);
        $this->pdf->load_view('Semua Pengeluaran', 'print/print_all_pengeluaran', $data);
    }
    public function printPengeluaran($id_pengeluaran)
    {
        $this->load->library('Pdf');
        $this->load->helper('date');
        $data['img'] = getCompanyLogo();
        $where = ["id_pengeluaran" => $id_pengeluaran];
        $data['detail_bayar'] = $this->modelapp->getData("*", "tbl_pengeluaran", $where)->row_array();
        $this->pdf->load_view('Pengeluaran', 'print/print_pengeluaran', $data);
    }
    // This function is private. so , anyone cannot to access this function from web based
    private function pages($core_page, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($core_page, $data);
        $this->load->view('partials/part_footer', $data);
    }
    private function whereData()
    {
        $where = [];
        $session = $this->session->userdata("id_akses");
        if (isset($_POST["id_kelompok"]) || isset($_POST["tgl_mulai"]) || isset($_POST["tgl_akhir"])) {
            $id_kelompok = $this->input->post('id_kelompok', true);
            $tgl_mulai = $this->input->post('tgl_mulai', true);
            $tgl_akhir = $this->input->post('tgl_akhir', true);
            if (!empty($id_kelompok)) {
                $where += ["id_kelompok" => $id_kelompok];
            }
            if ((!empty($tgl_mulai)) && (empty($tgl_akhir))) {
                $where += ["tgl_buat >=" => $tgl_mulai];
            } else if ((!empty($tgl_akhir)) && (empty($tgl_mulai))) {
                $where += ["tgl_buat <=" => $tgl_akhir];
            } else if ((!empty($tgl_mulai)) && (!empty($tgl_akhir))) {
                $where += ["tgl_buat >=" => $tgl_mulai, "tgl_buat <=" => $tgl_akhir];
            }
        }
        if ($session != 1) {
            $where += ["id_properti" => $this->session->userdata('id_properti')];
        }
        $where += ['status_owner' => 'sl', 'status_manager' => 'sl'];
        return $where;
    }
    private function pagination($where)
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('laporanpengeluaran/list/');
        $config['total_rows'] = $this->modelapp->getData('id_pengeluaran', 'tbl_pengeluaran', $where)->num_rows();
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
