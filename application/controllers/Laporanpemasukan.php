<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporanpemasukan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
    }
    public function index()
    {
        $data['title'] = 'Laporan Pemasukan';

        $data['img'] = getCompanyLogo();
        $data["kelompok"] = $this->modelapp->getData("*", "kelompok_item", ["id_kategori" => 4])->result();
        $this->pages("laporan/pemasukan/view_pemasukan", $data);
    }

    public function dataProses() //Fungsi Untuk Load Datatable
    {
        $where = $this->whereData();
        $this->load->model('Server_side', 'ssd');
        $column = "*";
        $tbl = "tbl_pemasukan";
        $order = "id_pemasukan";
        $fetch_values = $this->ssd->makeDataTables($column, $tbl, null, $order, null, $where);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            $sub = array();
            $sub[] = $no;
            $sub[] = $value->nama_pemasukan;
            $sub[] = $value->nama_kelompok;
            $sub[] = $value->volume . " " . $value->satuan;
            $sub[] = number_format($value->harga_satuan, 2, ",", ".");
            $sub[] = number_format($value->total_harga, 2, ",", ".");
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->tgl_buat;
            $sub[] = '<a href="' . base_url('laporanpemasukan/printpemasukan/' . $value->id_pemasukan) . '" class="btn btn-sm btn-info mx-2">Print</a>';
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw' => intval($this->input->post('draw')),
            'recordsTotal' => intval($this->ssd->get_all_datas($tbl, $where)),
            'recordsFiltered' => intval($this->ssd->get_filtered_datas($column, $tbl, null, $order, null, $where)),
            'data' => $data
        );
        return $this->output->set_output(json_encode($output));
    }

    public function printAll()
    {
        $this->load->library('Pdf');
        $where = $this->whereData();
        $data['pemasukan'] = $this->modelapp->getData("*", "tbl_pemasukan", $where)->result();
        $this->pdf->load_view('Semua Pemasukan', 'print/print_pemasukan', $data);
    }
    public function printPemasukan($id_pemasukan)
    {
        $this->load->library('Pdf');
        $this->load->helper('date');
        $data['img'] = getCompanyLogo();
        $where = ["id_pemasukan" => $id_pemasukan];
        $data['detail_bayar'] = $this->modelapp->getData("*", "tbl_pemasukan", $where)->row_array();
        $this->pdf->load_view('Pemasukan', 'print/print_pemasukan', $data);
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
            } elseif ((!empty($tgl_akhir)) && (empty($tgl_mulai))) {
                $where += ["tgl_buat <=" => $tgl_akhir];
            } elseif ((!empty($tgl_mulai)) && (!empty($tgl_akhir))) {
                $where += ["tgl_buat >=" => $tgl_mulai, "tgl_buat <=" => $tgl_akhir];
            }
        }
        if ($session != 1) {
            $where += ["id_properti" => $this->session->userdata('id_properti')];
        }
        return $where;
    }
}

/* End of file Laporan_Keuangan.php */
