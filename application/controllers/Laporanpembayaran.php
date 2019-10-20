<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Laporanpembayaran extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
    }
    public function index()
    {
        if (isset($_SESSION['id_properti']) || isset($_SESSION['laporan_pembayaran'])) {
            redirect('laporanpembayaran/list');
            exit();
        }
        $data['title'] = 'Laporan Pembayaran';
        $data['href'] = base_url('laporanpembayaran/coreauth');
        $data['properti'] = $this->modelapp->getData('id_properti,nama_properti', 'properti')->result_array();
        $this->page('auth_laporan/auth_laporan', $data);
    }

    public function coreAuth()
    {
        $properti = $this->input->post('properti', true);
        if (!empty($properti)) {
            $session = ['laporan_pembayaran' => $properti];
            $this->session->set_userdata($session);
            redirect('laporanpembayaran/list', 'refresh');
        } else {
            redirect('laporanpembayaran');
        }
    }

    public function list($num = 0)
    {
        $this->load->helper('date');
        $data['title'] = 'Laporan';
        if (isset($_SESSION['id_properti'])) {
            $id = $_SESSION['id_properti'];
        } elseif (isset($_SESSION['laporan_pembayaran'])) {
            $id = $_SESSION['laporan_pembayaran'];
        } else {
            redirect('laporanpembayaran');
            exit();
        }
        $per_page = 10;
        $search = '';
        // Pencarian Action
        if (isset($_POST['submit']) && $_POST['search'] != '') {
            $search = ['nama_pembayaran' => $this->input->post('search')];
            $this->session->set_userdata(array("search" => $search));
        } elseif (isset($_POST['reset'])) {
            $this->session->unset_userdata('search');
        } else {
            if (isset($_SESSION['search'])) {
                $search = $this->session->userdata('search');
            }
        }
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $where = ['status_owner' => 'sl', 'status_manager' => 'sl', 'id_properti' => $id];
        $data['bayar'] = $this->modelapp->getDataLike('*', 'tbl_detail_pembayaran', $search, 'id_detail', 'ASC', $per_page, $num, $where)->result_array();
        $data['properti'] = $this->modelapp->getData('nama_properti', 'properti', ['id_properti' => $id])->row_array();
        $data['row'] = $num;
        $this->pagination($where);
        $this->page('laporan/bayar/view_bayar', $data);
    }

    public function resetProperti()
    {
        if (isset($_SESSION['laporan_pembayaran'])) {
            $session = ['laporan_pembayaran', 'search'];
            $this->session->unset_userdata($session);
        }
        redirect('laporanpembayaran');
    }

    public function printData($id_detail)
    {
        $this->load->library('Pdf');
        $this->load->helper('date');
        $data['img'] = getCompanyLogo();
        $where = ["id_detail" => $id_detail];
        $data['detail_bayar'] = $this->modelapp->getData("*", "tbl_detail_pembayaran", $where)->row_array();
        $data['bayar'] = $this->modelapp->getData("hutang,total_bayar,total_tagihan", "tbl_pembayaran", ['id_pembayaran' => $data['detail_bayar']['id_pembayaran']])->row_array();
        // $this->load->view('print/print_tandajadi', $data);
        $this->pdf->load_view('Kwitansi', 'print/print_bayar', $data);
    }

    // Private function 
    private function page($core_page, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($core_page, $data);
        $this->load->view('partials/part_footer', $data);
    }
    private function pagination($where)
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('laporanpembayaran/list/');
        $config['total_rows'] = $this->modelapp->getData('id_pembayaran', 'tbl_detail_pembayaran', $where)->num_rows();
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

/* End of file Laporan_cuy.php */
