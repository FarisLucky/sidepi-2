<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Laporankonsumen extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library('form_validation');
    }

    public function index($num = 0)
    {
        $data['title'] = 'Laporan Konsumen';
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
        $where = ['status_konsumen' => 'k'];
        $data['konsumen'] = $this->modelapp->getDataLike("*", "konsumen", $search, 'id_konsumen', 'ASC ', $per_page, $num, $where)->result_array();
        $data['total_konsumen'] = $this->modelapp->getData("COUNT(id_konsumen) as jumlah_konsumen", "konsumen", $where)->row_array();
        $data['row'] = $num;
        $this->pagination($where);
        $this->page('laporan/view_konsumen', $data);
    }
    public function detail($id)
    {
        $this->load->helper('date');
        $data['title'] = 'Detail Konsumen';
        $data['img'] = getCompanyLogo();

        $data['doc_konsumen'] = $this->modelapp->getJoinData("*", "persyaratan_konsumen", ['kelompok_persyaratan' => 'kelompok_persyaratan.id_sasaran = persyaratan_konsumen.kelompok_persyaratan'], ['id_konsumen' => $id])->result_array();
        $data['konsumen'] = $this->modelapp->getData("*", "konsumen", ['id_konsumen' => $id])->row_array();
        $data['trans'] = $this->modelapp->getData("*", "tbl_transaksi", ['id_konsumen' => $id, 'status_transaksi !=' => 's'])->row_array();
        $this->page("laporan/view_detail", $data);
    }

    public function printKonsumen($id)
    {
        $this->load->library('Pdf');
        $this->load->helper('date');
        $input = $id;
        $get_data = $this->modelapp->getData('*', 'konsumen', ['id_konsumen' => $input]);
        if ($get_data->num_rows() > 0) {
            $data['rs_konsumen'] = $get_data->row_array();
            $data['img'] = getCompanyLogo();
            // $this->load->view("print/print_konsumen",$data);
            $this->pdf->load_view('Print Konsumen', 'print/print_konsumen', $data);
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
        }
    }

    public function printDoc($id)
    {
        $data_konsumen = $this->modelapp->getJoinData('*', 'persyaratan_konsumen', ['kelompok_persyaratan' => 'persyaratan_konsumen.kelompok_persyaratan = kelompok_persyaratan.id_sasaran'], ['id_persyaratan' => $id])->row_array();
        $data['link'] = base_url('assets/uploads/files/konsumen/' . $data_konsumen['file']);
        $data['name'] = $data_konsumen['kelompok_persyaratan'] . '.pdf';
        $this->load->view('print/custom_print', $data);
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

        $config['base_url'] = base_url('laporankonsumen/index/');
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
