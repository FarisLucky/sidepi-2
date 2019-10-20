<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporancalon extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
    }

    public function index($num = 0)
    {
        $data['title'] = 'Laporan';
        $per_page = 10;
        $search = '';
        // Pencarian Action
        if (isset($_POST['submit']) && $_POST['search'] != '') {
            $search = ['nama_lengkap' => $this->input->post('search')];
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
        $where = ['status_konsumen' => 'ck'];
        $data['calon'] = $this->modelapp->getDataLike("*", "konsumen", $search, 'id_konsumen', 'ASC ', $per_page, $num, $where)->result_array();
        $data['total_konsumen'] = $this->modelapp->getData("COUNT(id_konsumen) as jumlah_konsumen", "konsumen", $where)->row_array();
        $data['row'] = $num;
        $this->pagination($where);
        $this->page('laporan/view_calon', $data);
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Konsumen';

        $data['konsumen'] = $this->modelapp->getData('*', 'konsumen', ['id_konsumen' => $id])->row_array();
        $data['sasaran'] = $this->modelapp->getData('*', 'kelompok_persyaratan')->result_array();
        $data['follow'] = $this->modelapp->getData('*', 'follow_up', ['id_konsumen' => $id], 'id_follow', 'ASCp
        ')->result_array();
        $this->page("laporan/view_detail_calon", $data);
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

        $config['base_url'] = base_url('laporancalon/index/');
        $config['total_rows'] = $this->modelapp->getData('id_konsumen', 'konsumen', $where)->num_rows();
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
