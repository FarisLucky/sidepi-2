<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporanunit extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        //Do your magic here
    }

    public function index()
    {
        if (isset($_SESSION['id_properti']) || isset($_SESSION['laporan_unit'])) {
            redirect('laporanunit/unit');
            exit();
        }
        $data['title'] = 'Laporan Unit';
        $data['href'] = base_url('laporanunit/coreauth');
        $data['properti'] = $this->modelapp->getData('id_properti,nama_properti', 'properti')->result_array();
        $this->pages('auth_laporan/auth_laporan', $data);
    }

    public function coreAuth()
    {
        $properti = $this->input->post('properti', true);
        if (!empty($properti)) {
            $session = ['laporan_unit' => $properti];
            $this->session->set_userdata($session);
            redirect('laporanunit/unit', 'refresh');
        } else {
            redirect('laporanunit');
        }
    }

    public function unit($num = 0)
    {
        if (isset($_SESSION['id_properti'])) {
            $id = $_SESSION['id_properti'];
        } elseif (isset($_SESSION['laporan_unit'])) {
            $id = $_SESSION['laporan_unit'];
        } else {
            redirect('laporanunit');
            exit();
        }
        $data['title'] = 'Laporan Unit';
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
        if (isset($_POST['filter_submit']) && $_POST['filter_cari'] != '') {
            $where = ['status_unit' => $this->input->post('filter_cari')];
            $this->session->set_userdata(array("filter_cari" => $where));
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
        $where += ["id_properti" => $id];
        $data['list_unit'] = $this->modelapp->getDataLike("*", "tbl_unit", $search, 'id_unit', 'ASC ', $per_page, $num, $where)->result_array();
        $data['row'] = $num;
        $base = base_url('laporanunit/unit/');
        $this->pagination($where, $base);
        $data['site_plan'] = $this->modelapp->getData('nama_properti,foto_properti', 'properti', ['id_properti' => $id])->row_array();
        // $data["list_unit"] = $this->modelapp->getData("nama_unit,status_unit", "unit", ["id_properti" => $id])->result();
        $data['total'] = $this->modelapp->getData('COUNT(id_unit) as total', 'unit', ['id_properti' => $id])->row_array();
        $bt = ['status_unit' => 'bt', 'id_properti' => $id];
        $b = ['status_unit' => 'b', 'id_properti' => $id];
        $t = ['status_unit' => 't', 'id_properti' => $id];
        $data['bt'] = $this->modelapp->getData('COUNT(id_unit) as bt', 'unit', $bt)->row_array();
        $data['b'] = $this->modelapp->getData('COUNT(id_unit) as b', 'unit', $b)->row_array();
        $data['t'] = $this->modelapp->getData('COUNT(id_unit) as t', 'unit', $t)->row_array();
        $data["properti"] = $this->modelapp->getData('*', 'tbl_properti')->result();
        $this->pages("laporan/view_unit", $data);
    }

    public function resetProperti()
    {
        if (isset($_SESSION['laporan_unit'])) {
            $session = ['laporan_unit', 'filter_cari', 'search'];
            $this->session->unset_userdata($session);
        }
        redirect('laporanunit');
    }

    public function printUnit()
    {
        $where = $this->whereData();
        $this->load->library('Pdf');
        $data['img'] = getCompanyLogo();
        $data['unit'] = $this->modelapp->getData("*", "tbl_unit", $where)->result_array();
        // $this->load->view('print/print_unit',$data);
        $this->pdf->load_view('List Unit', 'print/print_unit', $data, 'landscape');
    }

    public function getUnit()
    {
        $id = $this->input->post('params1', true);
        if (!empty($id)) {
            $result = $this->modelapp->getData("id_unit,nama_unit", "unit", ["id_properti" => $id])->result();
            $data["html"] = "<option value=''>-- Pilih Unit --</option>";
            foreach ($result as $key => $value) {
                $data["html"] .= "<option value='" . $value->id_unit . "'>" . $value->nama_unit . "</option>";
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function detail($id, $num = 0) //Menampilkan Form Tambah
    {
        $data['title'] = 'Detail Unit';
        $per_page = 10;
        $search = '';
        // Pencarian Action
        if (isset($_POST['submit']) && $_POST['search'] != '') {
            $search = ['nama_kelompok' => $this->input->post('search')];
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
        $where = ['id_unit' => $id];
        $data['unit'] = $this->modelapp->getData("*", "unit", ["id_unit" => $id])->row();
        $data['detail_unit'] = $this->modelapp->getData("*", "kelompok_persyaratan", ["kategori_persyaratan" => "unit"])->result();
        $data['get_unit'] = $this->modelapp->getData("*", "persyaratan_unit", ["id_unit" => $id])->result();
        $data['doc_unit'] = $this->modelapp->getJoinData("*", "persyaratan_unit", ['kelompok_persyaratan' => 'kelompok_persyaratan.id_sasaran = persyaratan_unit.kelompok_persyaratan'], $where)->result_array();
        $data['booking'] = $this->modelapp->getData('*', 'tbl_transaksi', ['id_unit' => $id, 'status_transaksi' => 'p'])->row_array();
        $data['row'] = $num;
        $base = base_url('laporanunit/detail/' . $data['unit']->id_unit . '/');
        $this->pagination($where, $base);
        $this->pages("laporan/view_detail_unit", $data);
    }

    public function getJumlah()
    {
        $id = $this->input->post('id', true);
        $data['ttl'] = $this->modelapp->getData('COUNT(id_unit) as total', 'unit', ['id_properti' => $id])->row_array();
        $data['bt'] = $this->modelapp->getData('COUNT(id_unit) as bt', 'unit', ['status_unit' => 'bt', 'id_properti' => $id])->row_array();
        $data['b'] = $this->modelapp->getData('COUNT(id_unit) as b', 'unit', ['status_unit' => 'b', 'id_properti' => $id])->row_array();
        $data['t'] = $this->modelapp->getData('COUNT(id_unit) as t', 'unit', ['status_unit' => 't', 'id_properti' => $id])->row_array();
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function printDoc($id)
    {
        $data_unit = $this->modelapp->getJoinData('*', 'persyaratan_unit', ['kelompok_persyaratan' => 'persyaratan_unit.kelompok_persyaratan = kelompok_persyaratan.id_sasaran'], ['id_persyaratan' => $id])->row_array();
        $data['link'] = base_url('assets/uploads/files/unit/' . $data_unit['file']);
        $data['name'] = $data_unit['kelompok_persyaratan'] . '.pdf';
        $this->load->view('print/custom_print', $data);
    }

    private function pages($url, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($url, $data);
        $this->load->view('partials/part_footer', $data);
    }

    private function whereData()
    {
        $where = [];
        $session = $this->session->userdata("id_akses");
        if (isset($_POST["properti"]) || isset($_POST["id_unit"])) {
            $properti = $this->input->post('id_properti', true);
            $id_unit = $this->input->post('id_unit', true);
            if (!empty($properti)) {
                $where = ['id_properti' => $properti];
            }
            if (!empty($id_unit)) {
                $where = ['id_unit' => $id_unit];
            }
        }
        if ($session != 1) {
            $where = ["id_properti" => $this->session->userdata('id_properti')];
        }
        return $where;
    }

    private function pagination($where, $base)
    {
        $this->load->library('pagination');

        $config['base_url'] = $base;
        $config['total_rows'] = $this->modelapp->getData('id_unit', 'tbl_unit', $where)->num_rows();
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

/* End of file laporan.php */
