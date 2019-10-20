<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Listtransaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
    }
    public function index()
    {
        if (isset($_SESSION['id_properti']) || isset($_SESSION['list_transaksi'])) {
            redirect('listtransaksi/list');
            exit();
        }
        $data['title'] = 'Laporan Transaksi';
        $data['href'] = base_url('listtransaksi/coreauth');
        $data['properti'] = $this->modelapp->getData('id_properti,nama_properti', 'properti')->result_array();
        $this->pages('auth_laporan/auth_laporan', $data);
    }

    public function coreAuth()
    {
        $properti = $this->input->post('properti', true);
        if (!empty($properti)) {
            $session = ['list_transaksi' => $properti];
            $this->session->set_userdata($session);
            redirect('listtransaksi/list', 'refresh');
        } else {
            redirect('listtransaksi');
        }
    }

    public function list($num = 0)
    {
        $data['title'] = 'Laporan Transaksi';
        if (isset($_SESSION['id_properti'])) {
            $id = $_SESSION['id_properti'];
        } elseif (isset($_SESSION['list_transaksi'])) {
            $id = $_SESSION['list_transaksi'];
        } else {
            redirect('listtransaksi');
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
            if ($_POST['filter_cari'] != '') {
                $where += ['kunci' => $this->input->post('filter_cari')];
                $search = $this->session->set_userdata(['filter_cari' => $where]);
            }
            if ($_POST['tgl_mulai'] != '') {
                $where += ['tgl_transaksi >=' => $this->input->post('tgl_mulai')];
            }
            if ($_POST['tgl_akhir'] != '') {
                $where += ['tgl_transaksi <=' => $this->input->post('tgl_akhir')];
            }
        } elseif (isset($_POST['filter_reset'])) {
            $this->session->unset_userdata('filter_cari');
        } else {
            if (isset($_SESSION['filter_cari'])) {
                $search = $this->session->userdata('filter_cari');
            }
        }
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $where += ['status_transaksi !=' => 's', 'id_properti' => $id];
        $data['list_pembayaran'] = $this->modelapp->getDataLike("*", "tbl_transaksi", $search, 'id_transaksi', 'ASC ', $per_page, $num, $where)->result_array();
        $data['row'] = $num;
        $this->pagination($where);
        $data["properti"] = $this->modelapp->getData("nama_properti", "properti", ['id_properti' => $id])->row_array();
        $data["semua"] = $this->modelapp->getData("COUNT(id_transaksi) as total", "transaksi", ['status_transaksi !=' => 's'])->row_array();
        $data["progress"] = $this->modelapp->getData("COUNT(id_transaksi) as progress", "transaksi", ['status_transaksi' => 'p'])->row_array();
        $data["selesai"] = $this->modelapp->getData("COUNT(id_transaksi) as selesai", "transaksi", ['status_transaksi' => 'sl'])->row_array();
        $this->pages("laporan/transaksi/view_transaksi_unit", $data);
    }

    public function resetProperti()
    {
        if (isset($_SESSION['list_transaksi'])) {
            $session = ['list_transaksi', 'search', 'filter_cari'];
            $this->session->unset_userdata($session);
        }
        redirect('listtransaksi');
    }
    public function getUnit()
    {
        $id = $this->input->post('params1');
        $query = $this->modelapp->getData("id_unit,nama_unit,id_properti", "unit", ["id_properti" => $id, 'status_unit !=' => 'bt'])->result();
        $html = "<option value=''> -- Units -- </option>";
        foreach ($query as $key => $value) {
            $html .= '<option value="' . $value->id_unit . '"> ' . $value->nama_unit . ' </option>';
        }
        $data["html"] = $html;
        return $this->output->set_output(json_encode($data));
    }
    public function getDetail($id)
    {
        $this->load->helper('date');
        $data["title"] = "Detail Transaksi";

        if (!empty($id)) {
            $query = $this->modelapp->getData("*", "tbl_transaksi", ["id_transaksi" => $id]);
            if ($query->num_rows() > 0) {
                $data["transaksi"] = $query->row();
                $data["konsumen"] = $this->modelapp->getData("*", "konsumen", ["id_konsumen" => $data["transaksi"]->id_konsumen])->row();
                $data["unit"] = $this->modelapp->getData("*", "unit", ["id_unit" => $data["transaksi"]->id_unit])->row();
                $data["detail_transaksi"] = $this->modelapp->getData("*", "detail_transaksi", ["id_transaksi" => $data["transaksi"]->id_transaksi])->result();
            }
        }
        $this->pages("laporan/transaksi/view_detail", $data);
    }

    public function unlock($id)
    {
        $input = $id;
        $get_data = $this->modelapp->getData('id_transaksi,kunci', 'transaksi', ['id_transaksi' => $input]);
        if ($get_data->num_rows() > 0) {
            $rs_transaksi = $get_data->row_array();
            if ($rs_transaksi['kunci'] == 'l') {
                $params = 'u';
            } else {
                $params = 'l';
            }
            $query = $this->modelapp->updateData(["kunci" => $params], "transaksi", ["id_transaksi" => $rs_transaksi['id_transaksi']]);
            if ($query) {
                $this->session->set_flashdata('success', 'Data berhasil diubah');
                redirect('listtransaksi');
            } else {
                $this->session->set_flashdata('failed', 'Data tidak ada perubahan');
                redirect('listtransaksi');
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('listtransaksi');
        }
    }

    public function printSpr()
    {
        $this->load->library('Pdf');
        $id = $this->uri->segment(3);
        if (!empty($id)) {
            $session = $this->session->userdata('id_properti');
            $where = ['id_transaksi' => $id];
            $data['img'] = getCompanyLogo();
            $getData = $this->modelapp->getData("id_konsumen,id_unit,pembuat", "tbl_transaksi", $where)->row_array();
            $data["konsumen"] = $this->modelapp->getData("*", "konsumen", ["id_konsumen" => $getData['id_konsumen']])->row_array();
            $data["unit"] = $this->modelapp->getData("*", "tbl_unit", ["id_unit" => $getData['id_unit']])->row_array();
            $data['spr'] = $this->modelapp->getData("setting_spr", "tbl_properti", ['id_properti' => $session])->row_array();
            $data['pembuat'] = $getData['pembuat'];
            // $this->load->view('print/print_spr',$data);
            $this->pdf->load_view('Surat SPR', 'print/print_spr', $data);
        }
    }

    public function printSpk($id)
    {
        $data_transaksi = $this->modelapp->getData('sp3k,no_spr,nama_lengkap', 'tbl_transaksi', ['id_transaksi' => $id])->row_array();
        $data['link'] = base_url('assets/uploads/files/spk/' . $data_transaksi['sp3k']);
        $data['name'] = 'SP3k ' . $data_transaksi['nama_lengkap'] . ' Transaksi (' . $data_transaksi['no_spr'] . ').pdf';
        $this->load->view('print/custom_print', $data);
    }

    public function hapus($id)
    {
        $input = $id;
        $get_data = $this->modelapp->getData('nama_lengkap,id_transaksi,id_properti,id_unit,id_konsumen', 'tbl_transaksi', ['id_transaksi' => $input]);
        if ($get_data->num_rows() > 0) {
            $rs_transaksi = $get_data->row_array();
            $rs_dp = $this->modelapp->getData('SUM(total_bayar) as total', 'pembayaran', ['id_transaksi' => $rs_transaksi['id_transaksi'], 'jenis_pembayaran' => '2'])->row_array();
            if ($rs_dp['total'] != '0') {
                redirect('listtransaksi/datahapus/' . $rs_transaksi['id_transaksi']);
            } else {

                $this->db->trans_start(); //Start Transaction Database Auth Concept
                $delete_data = $this->modelapp->deleteData(['id_transaksi' => $rs_transaksi['id_transaksi']], 'transaksi');
                $update = $this->modelapp->updateData(['status_unit' => 'bt'], 'unit', ['id_unit' => $rs_transaksi['id_unit']]);
                $delete = $this->modelapp->deleteData(['id_konsumen' => $rs_transaksi['id_konsumen']], 'konsumen');

                $this->db->trans_complete(); // End Transaction Database Auth Concept

                if ($this->db->trans_status() === FALSE) {
                    $this->session->set_flashdata("failed", "Gagal dihapus");
                    redirect("listtransaksi");
                } else {
                    $this->session->set_flashdata("success", "Berhasil dihapus");
                    redirect("listtransaksi");
                }
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('listtransaksi');
        }
    }

    public function dataHapus($input)
    {
        $this->load->library('form_validation');
        $id = $input;
        $data["title"] = "Detail Transaksi";
        $transaksi = $this->modelapp->getData('id_transaksi,nama_lengkap,id_unit,nama_unit', 'tbl_transaksi', ['id_transaksi' => $id])->row_array();
        $data['dp'] = $this->modelapp->getData('SUM(total_bayar) as total', 'pembayaran', ['id_transaksi' => $transaksi['id_transaksi'], 'jenis_pembayaran' => '2'])->row_array();
        $total = ($data['dp']['total'] * 10) / 100;
        $data['pengeluaran'] = [
            'nama_pengeluaran' => 'Dp dari ' . $transaksi['nama_lengkap'],
            'volume' => '1',
            'id_unit' => $transaksi['id_unit'],
            'nama_unit' => $transaksi['nama_unit'],
            'satuan' => 'transaksi',
            'harga_satuan' => $total,
            'id_transaksi' => $transaksi['id_transaksi']
        ];
        $this->pages('laporan/transaksi/tambah_pengeluaran', $data);
    }
    public function coreTambah()
    {
        $id = $this->input->post('input_hidden', true);
        $rs_transaksi = $this->modelapp->getData('id_unit,id_konsumen', 'tbl_transaksi', ['id_transaksi' => $input])->row_array();
        $this->form_validation->set_rules('nama_pengeluaran', 'Nama', 'trim|required|min_length[5]|max_length[50]');
        $this->form_validation->set_rules('volume', 'Jumlah', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|min_length[1]|max_length[10]');
        $this->form_validation->set_rules('harga_satuan', 'Harga', 'trim|required|numeric');

        if ($this->form_validation->run() == false) {
            $this->dataHapus($id);
        } else {
            $input_data = [
                'nama_pengeluaran' => $this->input->post('nama_pengeluaran', true),
                'volume' => $this->input->post('volume', true),
                'satuan' => $this->input->post('satuan', true),
                'harga_satuan' => $this->input->post('harga_satuan', true),
                'total_harga' => $this->input->post('volume', true) * $this->input->post('harga_satuan', true),
                'id_user' => $_SESSION['id_user'],
                'id_kelompok' => '7',
                'tgl_buat' => date('Y-m-d'),
                'status_owner' => 'sl',
                'status_manager' => 's'
            ];
            $data_properti = $this->modelapp->getData('id_properti,id_unit', 'unit', ['id_unit' => $this->input->post('unit', true)])->row_array();
            $input_data += ['id_properti' => $data_properti['id_properti'], 'id_unit' => $data_properti['id_unit']];

            $config['upload_path'] = './assets/uploads/images/pengeluaran/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['encrypt_name'] = true;
            $config['max_size']  = '1024';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';

            $this->load->library('upload', $config);
            if ($_FILES['bukti_kwitansi']['name'] != "") {
                if ($this->upload->do_upload('bukti_kwitansi')) {
                    $img = $this->upload->data();
                    $input_data += ['bukti_kwitansi' => $img['file_name']];
                    $update = $this->modelapp->insertData($input_data, 'pengeluaran'); //Tambah Pengeluaran
                    if ($update) {
                        $delete_transaksi = $this->modelapp->deleteData(['id_transaksi' => $id], 'transaksi');
                        if ($delete_transaksi) {
                            $update = $this->modelapp->updateData(['status_unit' => 'bt'], 'unit', ['id_unit' => $rs_transaksi['id_unit']]);
                            $delete = $this->modelapp->deleteData(['id_konsumen' => $rs_transaksi['id_konsumen']], 'konsumen');
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                            redirect('listunlocktransaksi');
                        }
                    } else {
                        $this->session->set_flashdata('failed', 'Data tidak ada perubahan');
                        redirect('listunlocktransaksi');
                    }
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('listunlocktransaksi/datahapus/' . $id);
                }
            } else {
                $this->session->set_flashdata('failed', "Bukti bayar kosong");
                $this->dataHapus($id);
            }
        }
    }
    // This function is private. so , anyone cannot to access this function from web based
    private function pages($core_page, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($core_page, $data);
        $this->load->view('partials/part_footer', $data);
    }
    private function pagination($where)
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('listtransaksi/list/');
        $config['total_rows'] = $this->modelapp->getData('id_transaksi', 'tbl_transaksi', $where)->num_rows();
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

/* End of file Approve.php */
