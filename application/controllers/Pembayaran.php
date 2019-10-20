<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library("form_validation");
    }
    public function index()
    {
        redirect('pembayaran/tandajadi');
    }
    // View Pembayaran tandajadi,Uang muka,Transaksi
    public function tandajadi($num = 0)
    {
        $data['title'] = "Tanda Jadi";
        $where = ['id_properti' => $_SESSION['id_properti'], 'jenis_pembayaran' => '1', 'status !=' => 's'];
        $per_page = 10;
        $search = '';
        if (isset($_POST['submit'])) {
            $search = ['nama_unit' => $this->input->post('search')];
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
        $data['tanda_jadi'] = $this->modelapp->getDataLike('*', 'tbl_pembayaran', $search, 'id_pembayaran', 'ASC', $per_page, $num, $where)->result_array();
        $url = $this->modelapp->getDataLike('id_pembayaran', 'tbl_pembayaran', $search, 'id_pembayaran', 'ASC', '', '', $where)->num_rows();
        $base = base_url('pembayaran/tandajadi/');
        $data['row'] = $num;
        $this->pagination($base, $url);
        $this->pages("pembayaran/view_tanda_jadi", $data);
    }
    public function uangMuka($num = 0)
    {
        $data['title'] = "Uang Muka";
        $per_page = 10;
        $where = [];
        if (isset($_POST['submit'])) {
            $where = ['id_unit' => $this->input->post('search')];
            $this->session->set_userdata(array("search" => $where));
        } elseif (isset($_POST['reset'])) {
            $this->session->unset_userdata('search');
            $where = [];
        } else {
            if (isset($_SESSION['search'])) {
                $where = $this->session->userdata('search');
            }
        }
        $where += ['id_properti' => $_SESSION['id_properti'], 'jenis_pembayaran' => '2', 'status !=' => 's'];
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $data['uang_muka'] = $this->modelapp->getData('*', 'tbl_pembayaran', $where, 'id_pembayaran', 'ASC', $per_page, $num)->result_array();
        $url = $this->modelapp->getData('id_pembayaran', 'tbl_pembayaran', $where)->num_rows();
        $base = base_url('pembayaran/uangmuka/');
        $data['row'] = $num;
        $this->pagination($base, $url);
        $data['unit'] = $this->modelapp->getData("id_unit,nama_unit", "unit", ["id_properti" => $this->session->userdata("id_properti"), 'status_unit' => 'b'], "nama_unit", "ASC")->result_array();
        $this->pages("pembayaran/view_uang_muka", $data);
    }
    public function cicilan($num = 0)
    {
        $data['title'] = "Cicilan";

        $per_page = 10;
        $where = [];
        if (isset($_POST['submit'])) {
            $where = ['id_unit' => $this->input->post('search')];
            $this->session->set_userdata(array("search" => $where));
        } elseif (isset($_POST['reset'])) {
            $this->session->unset_userdata('search');
            $where = [];
        } else {
            if (isset($_SESSION['search'])) {
                $where = $this->session->userdata('search');
            }
        }
        $where += ['id_properti' => $_SESSION['id_properti'], 'jenis_pembayaran' => '3', 'status !=' => 's'];
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $data['cicilan'] = $this->modelapp->getData('*', 'tbl_pembayaran', $where, 'id_pembayaran', 'ASC', $per_page, $num)->result_array();
        $url = $this->modelapp->getData('id_pembayaran', 'tbl_pembayaran', $where)->num_rows();
        $base = base_url('pembayaran/cicilan/');
        $data['row'] = $num;
        $this->pagination($base, $url);
        $data['unit'] = $this->modelapp->getData("id_unit,nama_unit", "unit", ["id_properti" => $this->session->userdata("id_properti"), 'status_unit' => 'b'], "nama_unit", "ASC")->result_array();
        $this->pages("pembayaran/view_cicilan", $data);
    }
    public function bayar($id)
    {
        $data['title'] = "Form Bayar";
        $data["bayar"] = $this->modelapp->getData("*", "pembayaran", ["id_pembayaran" => $id])->row_array();
        $data['id'] = $id;
        $data["rekening"] = $this->modelapp->getData("rekening,no_rekening,bank", "tbl_properti", ['id_properti' => $_SESSION['id_properti']])->result_array();
        $this->pages("pembayaran/view_form_bayar", $data);
    }
    public function ubahBayar($id)
    {
        $data['title'] = "Ubah Bayar";

        $data['img'] = getCompanyLogo();
        $data['detail'] = $this->modelapp->getData("*", "detail_pembayaran", ["id_detail" => $id])->row_array();
        $get_id = $data['detail']['id_pembayaran'];
        $data['id'] = $get_id;
        $data["bayar"] = $this->modelapp->getData("*", "pembayaran", ["id_pembayaran" => $get_id])->row_array();
        $data["rekening"] = $this->modelapp->getData("*", "rekening_properti")->result_array();
        $this->pages("pembayaran/view_update_bayar", $data);
    }
    public function history($id, $num = 0)
    {
        $this->load->helper('date');
        $data['title'] = "History Pembayaran";
        $per_page = 10;
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $where = ['id_pembayaran' => $id];
        $data["id_pembayaran"] = $id;
        $data["pembayaran"] = $this->modelapp->getData("*", "pembayaran", $where)->row_array();
        $data["detail"] = $this->modelapp->getData("*", "detail_pembayaran", $where, 'id_pembayaran', 'ASC', $per_page, $num)->result_array();
        $data["bayar"] = $this->modelapp->getData("SUM(jumlah_bayar) as total_pending", "detail_pembayaran", ["id_pembayaran" => $id, 'status_owner' => 'p'])->row_array();
        $data['row'] = $num;
        $url = $this->modelapp->getData('id_pembayaran', 'pembayaran', $where)->num_rows();
        $base = base_url('pembayaran/cicilan/');
        $this->pagination($base, $url);
        $this->pages("pembayaran/view_history", $data);
    }
    public function coreBayar()
    {
        $id = $this->input->post("txt_id", true);
        $this->validate();
        if ($this->form_validation->run() == false) {
            $this->bayar($id);
        } else {
            $input =  $this->inputData();
            $get_hutang = $this->modelapp->getData('hutang', 'pembayaran', ['id_pembayaran' => $id])->row_array();
            if ($input['jumlah_bayar'] > $get_hutang['hutang']) {
                $this->session->set_flashdata('error', 'jumlah bayar terlalu besar');
                $this->bayar($id);
            } else {
                if (isset($_POST['lock'])) {
                    if ($_POST['lock'] == 'l') {
                        $input += ['status_owner' => 'p', 'status_manager' => 'p'];
                        $data_pending = $this->modelapp->getData('id_detail', 'detail_pembayaran', ['id_pembayaran' => $id, 'status_owner' => 'p']);
                        if ($data_pending->num_rows() > 0) {
                            $this->session->set_flashdata('failed', 'Tidak bisa di lock, Menunggu approve pembayaran lainnya');
                            redirect('pembayaran/bayar/' . $id);
                            return false;
                        }
                    } else {
                        $input += ['status_owner' => 's', 'status_manager' => 's'];
                    }
                }
                $input += ['id_pembayaran' => $id];
                $config = $this->imageInit('./assets/uploads/images/pembayaran/');
                $this->load->library('upload', $config);
                if ($_FILES['txt_bukti']['name'] != '') {
                    if ($this->upload->do_upload('txt_bukti')) {
                        $img = $this->upload->data();
                        $input += ['bukti_bayar' => $img['file_name']];
                        $sql = $this->modelapp->insertData($input, 'detail_pembayaran');
                        if ($sql) {
                            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
                            redirect('pembayaran/history/' . $id);
                        }
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        $this->bayar($id);
                    }
                } else {
                    $sql = $this->modelapp->insertData($input, 'detail_pembayaran');
                    if ($sql) {
                        $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
                        redirect('pembayaran/history/' . $id);
                    }
                }
            }
        }
    }
    public function coreUbahBayar()
    {
        $id = $this->input->post("txt_id", true);
        $this->validate();
        if ($this->form_validation->run() == false) {
            $this->ubahBayar($id);
        } else {
            $input =  $this->inputData();
            $get_id = $this->modelapp->getData('id_pembayaran,id_detail', 'detail_pembayaran', ['id_detail' => $id])->row_array();
            $get_hutang = $this->modelapp->getData('hutang,total_bayar', 'pembayaran', ['id_pembayaran' => $get_id['id_pembayaran']])->row_array();
            if ($input['jumlah_bayar'] > $get_hutang['hutang']) {
                $this->session->set_flashdata('error', 'jumlah bayar terlalu besar');
                $this->ubahbayar($id);
            } else {
                if (isset($_POST['lock'])) {
                    if ($_POST['lock'] == 'l') {
                        $input += ['status_owner' => 'p', 'status_manager' => 'p'];
                        $data_pending = $this->modelapp->getData('id_detail', 'detail_pembayaran', ['id_pembayaran' => $get_id['id_pembayaran'], 'status_owner' => 'p']);
                        if ($data_pending->num_rows() > 0) {
                            $this->session->set_flashdata('failed', 'Tidak bisa di lock, Menunggu approve pembayaran lainnya');
                            redirect('pembayaran/ubahbayar/' . $get_id['id_detail']);
                            return true;
                        }
                    } else {
                        $input += ['status_owner' => 's', 'status_manager' => 's'];
                    }
                }
                $config = $this->imageInit('./assets/uploads/images/pembayaran/');
                $this->load->library('upload', $config);
                if ($_FILES['txt_bukti']['name'] != '') {
                    if ($this->upload->do_upload('txt_bukti')) {
                        $img = $this->upload->data();
                        $input += ['bukti_bayar' => $img['file_name']];
                        $sql = $this->modelapp->updateData($input, 'detail_pembayaran', ['id_detail' => $id]);
                        if ($sql) {
                            $this->session->set_flashdata('success', 'Data berhasil diubah');
                            redirect('pembayaran/history/' . $get_id['id_pembayaran']);
                            return true;
                        }
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        $this->ubahBayar($id);
                    }
                } else {
                    $sql = $this->modelapp->updateData($input, 'detail_pembayaran', ['id_detail' => $id]);
                    if ($sql) {
                        $this->session->set_flashdata('success', 'Data berhasil diubah');
                        redirect('pembayaran/history/' . $get_id['id_pembayaran']);
                    }
                }
            }
        }
    }

    public function hapus($id)
    {
        $input = $id;
        $get_detail = $this->modelapp->getData('id_detail,id_pembayaran', 'detail_pembayaran', ['id_detail' => $input]);
        $result = $get_detail->row();
        if ($get_detail->num_rows()) {
            $delete = $this->modelapp->deleteData(['id_detail' => $result->id_detail], 'detail_pembayaran');
            if ($delete) {
                $this->session->set_flashdata('success', 'Data berhasil dihapus');
                redirect('pembayaran/history/' . $result->id_pembayaran);
            }
        } else {
            $data['heading'] = "Ups ! Error";
            $data['message'] = "<p>Data tidak ditemukan</p>";
            $this->load->view('errors/html/error_404', $data);
        }
    }
    // Server Side table view tandajadi,uang muka,transaksi
    public function dataProses() //Fungsi Untuk Load Datatable
    {
        $id_properti = $this->session->userdata('id_properti');
        $this->load->model('Server_side', 'ssd');
        $column = "*";
        $tbl = 'tbl_pembayaran';
        $order = 'id_pembayaran';
        $having = ['id_properti' => $id_properti, 'jenis_pembayaran' => $_POST['id_jenis'], 'status !=' => 's'];
        if (!empty($_POST['pilih_unit'])) {
            $having += ['id_unit' => $_POST['pilih_unit']];
        }
        $search = ['nama_unit'];
        $fetch_values = $this->ssd->makeDataTables($column, $tbl, $search, $order, $having);
        $data = array();
        foreach ($fetch_values as $value) {
            if ($value->status == "b") {
                $status = '<span class="badge badge-primary">Belum Bayar</span>';
                $button = '<a href="' . base_url("pembayaran/history/" . $value->id_pembayaran) . '" class="btn btn-icons btn-inverse-danger"><i class="fa fa-money"></i></a>';
            } else {
                $status = '<span class="badge badge-success">Sudah bayar</span>';
                $button = '<a href="' . base_url("pembayaran/history/" . $value->id_pembayaran) . '" class="btn btn-icons btn-inverse-info"><i class="fa fa-info"></i></a><a href="' . base_url('pembayaran/printall/' . $value->id_pembayaran) . '" class="btn btn-icons btn-inverse-warning mx-2"><i class="fa fa-print"></i></a>';
            }
            if ($value->jenis_pembayaran == "3" && $value->nama_pembayaran == "kpr") {
                $button .= '<a href="' . base_url('pembayaran/suratkpr/' . $value->id_transaksi) . '" class="btn btn-sm btn-success mx-2"><i class="fa fa-book"></i> SP3K</a>';
            }
            $sub = array();
            $sub[] = $value->nama_pembayaran;
            $sub[] = $value->nama_unit;
            $sub[] = $status;
            $sub[] = "Rp. " . number_format($value->total_tagihan, 2, ',', '.');
            $sub[] = $button;
            $data[] = $sub;
        }
        $output = array(
            'draw' => intval($this->input->post('draw')),
            'recordsTotal' => intval($this->ssd->get_all_datas($tbl, $having)),
            'recordsFiltered' => intval($this->ssd->get_filtered_datas($column, $tbl, $search, $order, $having)),
            'data' => $data
        );
        return $this->output->set_output(json_encode($output));
    }

    public function payLock($id)
    {
        $input = $id;
        $query = $this->modelapp->getData("*", "detail_pembayaran", ["id_detail" => $id]);
        if ($query->num_rows() > 0) {
            $get_data = $query->row_array();
            $get_pembayaran = $this->modelapp->getData('id_detail', 'detail_pembayaran', ['id_pembayaran' => $get_data['id_pembayaran'], 'status_owner' => 'p']);
            if ($get_pembayaran->num_rows() > 0) {
                $this->session->set_flashdata('failed', 'Tidak bisa di lock, Menunggu approve pembayaran lainnya');
                redirect('pembayaran/history/' . $get_data['id_pembayaran']);
                return true;
            } else {
                $data_bayar = $this->modelapp->getData('status', 'pembayaran', ['id_pembayaran' => $get_data['id_pembayaran']])->row_array();
                if ($data_bayar['status'] == 'sb') {
                    $this->session->set_flashdata('failed', 'Tanda Jadi sudah Selesai');
                    redirect('pembayaran/history/' . $get_data['id_pembayaran']);
                } else {
                    $query_update = $this->modelapp->updateData(['status_owner' => 'p', 'status_manager' => 'p'], 'detail_pembayaran', ['id_detail' => $get_data['id_detail']]);
                    if ($query_update) {
                        $this->session->set_flashdata('success', 'berhasil dilock');
                        redirect('pembayaran/history/' . $get_data['id_pembayaran']);
                    }
                }
            }
        } else {
            $this->session->set_flashdata('failed', 'Data Detail tidak ditemukan');
            redirect('pembayaran/history/' . $get_data['id_pembayaran']);
        }
    }

    public function suratKpr($id, $image = null)
    {
        $data['title'] = "Surat SP3K";

        $data['img'] = getCompanyLogo();
        $data["id"] = $id;
        $data["error"] = $image;
        $data["trans"] = $this->modelapp->getData("id_transaksi,sp3k", "transaksi", ["id_transaksi" => $id])->row_array();
        $this->pages("pembayaran/view_surat_kpr", $data);
    }
    public function coreSuratKpr()
    {
        $id = $this->input->post("input_hidden", true);
        $get_data = $this->modelapp->getData('id_transaksi,sp3k', 'transaksi', ['id_transaksi' => $id]);
        if ($get_data->num_rows() > 0) {
            $rs_kpr = $get_data->row_array();
            $config = $this->imageInit('./assets/uploads/files/spk/');
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('upload')) {
                $file = $this->upload->data();
                $this->modelapp->updateData(["sp3k" => $file["file_name"]], "transaksi", ["id_transaksi" => $rs_kpr['id_transaksi']]);
                redirect('pembayaran/cicilan/');
            } else {
                $files = $this->upload->display_errors();
                $this->suratKpr($id, $files);
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('pembayaran/cicilan/');
        }
        // return $this->output->set_content_type('application/json')->set_output(json_encode($image));
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
    public function printAll($id_pembayaran)
    {
        $this->load->library('Pdf');
        $this->load->helper('date');
        $data['img'] = getCompanyLogo();
        $where = ['id_pembayaran' => $id_pembayaran, 'status_owner' => 'sl', 'status_manager' => 'sl'];
        $data['detail'] = $this->modelapp->getData("*", "tbl_detail_pembayaran", $where)->result_array();
        $data['bayar'] = $this->modelapp->getData("hutang,total_bayar,total_tagihan", "tbl_pembayaran", ['id_pembayaran' => $id_pembayaran])->row_array();
        // $this->load->view('print/print_tandajadi', $data);
        $this->pdf->load_view('Kwitansi', 'print/print_all_bayar', $data);
    }
    public function printSpk($id)
    {
        $data_transaksi = $this->modelapp->getData('sp3k,no_spr,nama_lengkap', 'tbl_transaksi', ['id_transaksi' => $id])->row_array();
        $data['link'] = base_url('assets/uploads/files/spk/' . $data_transaksi['sp3k']);
        $data['name'] = 'SP3k ' . $data_transaksi['no_spr'] . ' ' . $data_transaksi['nama_lengkap'] . '.pdf';
        $this->load->view('print/custom_print', $data);
    }
    // This function is private. so , anyone cannot to access this function from web based *Private*
    private function pages($core_page, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($core_page, $data);
        $this->load->view('partials/part_footer', $data);
    }
    private function validate()
    {
        $this->form_validation->set_rules('txt_jumlah', 'Jumlah Bayar', 'trim|required|numeric');
        $this->form_validation->set_rules('txt_rekening', 'Rekening', 'trim|required');
    }
    private function inputData()
    {
        $config = [
            'id_rekening' => $this->input->post('txt_rekening', true),
            'tgl_bayar' => date('Y-m-d H:i:s'),
            'jumlah_bayar' => $this->input->post('txt_jumlah', true),
            'id_user' => $this->session->userdata('id_user')
        ];
        return $config;
    }
    private function imageInit($path)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = true;
        $config['max_size']  = '1024';
        return $config;
    }
    private function pagination($base, $url)
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

/* End of file Controllername.php */
