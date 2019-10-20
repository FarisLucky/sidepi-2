<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kartukontrol extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
    }

    public function index()
    {
        if (isset($_SESSION['id_properti']) || isset($_SESSION['kartu_kontrol'])) {
            redirect('kartukontrol/list');
            exit();
        }
        $data['title'] = 'Kartu Kontrol';
        $data['href'] = base_url('kartukontrol/coreauth');
        $data['properti'] = $this->modelapp->getData('id_properti,nama_properti', 'properti')->result_array();
        $this->pages('auth_laporan/auth_laporan', $data);
    }

    public function coreAuth()
    {
        $properti = $this->input->post('properti', true);
        if (!empty($properti)) {
            $session = ['kartu_kontrol' => $properti];
            $this->session->set_userdata($session);
            redirect('kartukontrol/list', 'refresh');
        } else {
            redirect('kartukontrol');
        }
    }

    public function list($num = 0)
    {
        if (isset($_SESSION['id_properti'])) {
            $id = $_SESSION['id_properti'];
        } elseif (isset($_SESSION['kartu_kontrol'])) {
            $id = $_SESSION['kartu_kontrol'];
        } else {
            redirect('kartu_kontrol');
            exit();
        }

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
        // Filter Action
        $where = [];
        if (isset($_POST['filter_submit'])) {
            if ($_POST['id_unit'] != '') {
                $where += ['id_unit' => $this->input->post('id_unit')];
                $this->session->set_userdata(array("filter_cari" => $where));
            }
            if ($_POST['tgl_mulai'] != '') {
                $where += ['tgl_transaksi >=' => $this->input->post('tgl_mulai')];
            }
            if ($_POST['tgl_akhir'] != '') {
                $where += ['tgl_transaksi <=' => $this->input->post('tgl_akhir')];
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
        $where += ['status_transaksi !=' => 's'];
        $data["title"] = "Kartu Kontrol";
        $data['properti'] = $this->modelapp->getData('*', 'properti')->result();
        $data['transaksi'] = $this->modelapp->getDataLike('*', "tbl_transaksi", $search, 'id_transaksi', 'ASC', $per_page, $num, $where)->result_array();
        $data['unit'] = $this->modelapp->getData('id_unit,nama_unit', "unit", ['id_properti' => $id, 'status_unit !=' => 'bt'])->result_array();
        $data['row'] = $num;
        $base = base_url('kartukontrol/list/');
        $url = $this->modelapp->getData('*', "tbl_transaksi", $where)->num_rows();
        $this->pagination($url, $base);
        $this->pages("kartu_kontrol/view_kontrol", $data);
    }

    public function resetProperti()
    {
        if (isset($_SESSION['kartu_kontrol'])) {
            $session = ['kartu_kontrol', 'filter_cari', 'search'];
            $this->session->unset_userdata($session);
        }
        redirect('kartukontrol');
    }

    public function detail($input, $num = 0)
    {
        $id = $input;
        $data["title"] = "Detail Kontrol";
        $per_page = 10;
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $where = ["id_transaksi" => $id];
        $data["detail_kontrol"] = $this->modelapp->getData("*", "tbl_pembayaran", $where)->result();
        $data["transaksi"] = $this->modelapp->getData('*', "tbl_transaksi", ["id_transaksi" => $id])->row();
        $data["bayar_tj"] = $this->modelapp->getData("SUM(total_bayar) as tanda_jadi", "tbl_pembayaran", ["id_transaksi" => $id, 'jenis_pembayaran' => 1])->row();
        $data["bayar_um"] = $this->modelapp->getData("SUM(total_bayar) as uang_muka", "tbl_pembayaran", ["id_transaksi" => $id, 'jenis_pembayaran' => 2])->row();
        $data["bayar_cicilan"] = $this->modelapp->getData("SUM(total_bayar) as cicilan", "tbl_pembayaran", ["id_transaksi" => $id, 'jenis_pembayaran' => 3])->row();
        $data["realisasi"] = $this->modelapp->getData("SUM(hutang) as hutang,SUM(total_bayar) as pemasukan", "tbl_pembayaran", ["id_transaksi" => $id])->row();
        $data['row'] = $num;
        $base = base_url('kartukontrol/detail/');
        $url = $this->modelapp->getData('*', "tbl_transaksi", $where)->num_rows();
        $this->pagination($url, $base);
        $this->pages("kartu_kontrol/view_detail_kontrol", $data);
    }

    public function history($id)
    {
        $data['title'] = "History Pembayaran";
        $data["id_pembayaran"] = $id;
        $data["pembayaran"] = $this->modelapp->getData("*", "pembayaran", ["id_pembayaran" => $id])->row_array();
        $data["detail"] = $this->modelapp->getData("*", "detail_pembayaran", ["id_pembayaran" => $id, 'status_owner' => 'sl'])->result_array();
        $this->pages("kartu_kontrol/view_history", $data);
    }

    public function selesai($id)
    {
        $get_data = $this->modelapp->getData('id_transaksi', 'tbl_transaksi', ['id_transaksi' => $id]);
        if ($get_data->num_rows() > 0) {
            $data_transaksi = $get_data->row_array();
            $query_update = $this->modelapp->updateData(['status_transaksi' => 'sl'], 'transaksi', ['id_transaksi' => $data_transaksi['id_transaksi']]);
            if ($query_update) {
                $this->session->set_flashdata('success', 'Data berhasil diubah');
                redirect('kartukontrol/detail/' . $data_transaksi['id_transaksi']);
            }
        } else {
            $this->session->set_flashdata('failed', 'Data Tidak Ditemukan');
            redirect('kartukontrol/detail/' . $id);
        }
    }

    public function getUnit()
    {
        $id = $this->input->post('params1');
        $html = "<option value=''> -- Units -- </option>";
        if (!empty($id)) {
            $query = $this->modelapp->getData("id_unit,nama_unit,id_properti", "unit", ["id_properti" => $id])->result();
            foreach ($query as $key => $value) {
                $html .= '<option value="' . $value->id_unit . '"> ' . $value->nama_unit . ' </option>';
            }
            $data["html"] = $html;
        } else {
            $data['html'] = $html;
        }
        return $this->output->set_output(json_encode($data));
    }

    // Pages
    private function pages($core_page, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($core_page, $data);
        $this->load->view('partials/part_footer', $data);
    }
    private function pagination($url, $base)
    {
        $this->load->library('pagination');

        $config['base_url'] = $base;
        $config['total_rows'] = $url;
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

/* End of file KartuKontrol.php */
