<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library("form_validation");
    }
    public function index($num = 0)
    {
        $params = ['id_user' => $this->session->userdata('id_user'), 'id_properti' => $this->session->userdata('id_properti')];
        $data['title'] = 'Transaksi';

        $per_page = 10;
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $data['row'] = $num;
        $data['list_transaksi'] = $this->modelapp->getData("*", "tbl_transaksi", $params, 'id_transaksi', 'ASC', $per_page, $num)->result();
        $data['list_unlock'] = $this->modelapp->getData("id_transaksi,no_spr,nama_lengkap,nama_unit,type_bayar,total_kesepakatan,tgl_transaksi", "tbl_transaksi", ["kunci" => "unlock", "id_user" => $_SESSION['id_user']])->result();
        $this->pagination();
        $this->pages("transaksi/view_list_transaksi", $data);
    }
    public function tambah()
    {
        $data['title'] = 'Transaksi';

        $data['img'] = getCompanyLogo();
        $data['konsumen'] = $this->modelapp->getData("*", "konsumen", ['status_konsumen' => 'ck', 'id_user' => $_SESSION['id_user']])->result();
        $data['unit'] = $this->modelapp->getData("*", "unit", ["id_properti" => $_SESSION['id_properti'], "status_unit" => "bt"])->result();
        $data['type'] = $this->modelapp->getData("*", "type_bayar")->result_array();
        $this->pages("transaksi/view_transaksi", $data);
    }
    public function detail($id)
    {
        $this->load->helper('date');
        $data['title'] = 'Detail Transaksi';

        $data['img'] = getCompanyLogo();
        $data['transaksi'] = $this->modelapp->getData('*', 'tbl_transaksi', ['id_transaksi' => $id])->row();
        $id_transaksi = $data['transaksi']->id_transaksi;
        $id_konsumen = $data['transaksi']->id_konsumen;
        $id_unit = $data['transaksi']->id_unit;
        $min_tj = $data['transaksi'] == 'masuk' ? $data['transaksi']->total_kesepakatan - $data['transaksi']->total_tanda_jadi : $data['transaksi']->total_kesepakatan;
        $min_um = $min_tj - $data['transaksi']->total_uang_muka;
        $data['cicilan'] = $data['transaksi']->id_type == '1' ? $min_um / $data['transaksi']->periode_cicilan : $min_um;
        $data['uang_muka'] = $this->modelapp->getData('nama_pembayaran,total_tagihan', 'pembayaran', ['id_transaksi' => $id_transaksi, 'jenis_pembayaran' => 2])->result_array();
        $data['konsumen'] = $this->modelapp->getData('*', 'konsumen', ['id_konsumen' => $id_konsumen])->row();
        $data['unit'] = $this->modelapp->getData('*', 'unit', ['id_unit' => $id_unit])->row();
        $data['detail_transaksi'] = $this->modelapp->getData('*', 'detail_transaksi', ['id_detail' => $id_transaksi])->result();
        $this->pages("transaksi/view_detail", $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Transaksi';

        $data['img'] = getCompanyLogo();
        $data['transaksi'] = $this->modelapp->getData("*", "tbl_transaksi", ["id_transaksi" => $id])->row();
        $id_transaksi = $data['transaksi']->id_transaksi;
        $id_konsumen = $data['transaksi']->id_konsumen;
        $id_unit = $data['transaksi']->id_unit;
        $data['konsumen'] = $this->modelapp->getData("id_konsumen,nama_lengkap", "konsumen", ["status_konsumen" => "ck"])->result();
        $data['unit'] = $this->modelapp->getData("id_unit,nama_unit", "unit", ["id_properti" => $this->session->userdata('id_properti'), "status_unit" => "bt"])->result();
        $data['detail_konsumen'] = $this->modelapp->getData("*", "konsumen", ["id_konsumen" => $id_konsumen])->row();
        $data['detail_unit'] = $this->modelapp->getData("*", "unit", ["id_unit" => $id_unit])->row();
        $data['detail_transaksi'] = $this->modelapp->getData("*", "detail_transaksi", ["id_transaksi" => $id_transaksi])->result();
        $data['type'] = $this->modelapp->getData("*", "type_bayar")->result_array();
        $data['uang_muka'] = $this->modelapp->getData('nama_pembayaran,total_tagihan', 'pembayaran', ['id_transaksi' => $id_transaksi, 'jenis_pembayaran' => 2])->result_array();
        $this->pages("transaksi/view_edit", $data);
    }
    public function dataKonsumen()
    {
        $data = ['success' => false];
        $input = $this->input->post('id', true);
        $query = $this->modelapp->getData("*", "konsumen", ["id_konsumen" => $input]);
        $data["query"] = $query->num_rows();
        if ($query->num_rows() > 0) {
            $data['success'] = true;
            $data['obj'] = $query->row();
        } else {
            $data['success'] = false;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function dataUnit()
    {
        $data = ['success' => false];
        $input = $this->input->post('id', true);
        $query = $this->modelapp->getData("*", "unit", ["id_unit" => $input]);
        $data["query"] = $query->num_rows();
        if ($query->num_rows() > 0) {
            $data['success'] = true;
            $data['obj'] = $query->row();
            $data["harga"] = number_format($data["obj"]->harga_unit, 2, ",", ".");
        } else {
            $data['success'] = false;
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function getHarga()
    {
        $data = ['success' => false];
        $input = $this->input->post('kesepakatan');
        $data['ttl_harga'] = $input;
        return $this->output->set_output(json_encode($data));
    }

    public function total_transaksi()
    {
        $data = ['success' => false];
        $check_tj = $this->input->post('t_j');
        $val_tj = $this->input->post('val_tj');
        $ttl_sementara = $this->input->post('sementara');
        if ($check_tj == "tidak_masuk_harga_jual") {
            $data['success'] = true;
            $data['hasil'] = $ttl_sementara;
        } else {
            $data['success'] = true;
            $data['hasil'] = $ttl_sementara - $val_tj;
        }
        return $this->output->set_output(json_encode($data));
    }
    // Insert Transaksi
    public function coreTambah()
    {
        $this->validate();
        if ($this->form_validation->run() ==  false) {
            $this->tambah();
        } else {
            $input = $this->inputData();
            $total_transaksi = 0;
            if ($_POST["radio_tj"] == "tidak_masuk") {
                $input += ["tanda_jadi" => $this->input->post("radio_tj", true)];
                $total_transaksi = $input["total_kesepakatan"];
            } else {
                $input += ["tanda_jadi" => $this->input->post("radio_tj", true)];
                $total_transaksi = (int) ($input["total_kesepakatan"] - $input["total_tanda_jadi"]);
            }
            // !Validasi Cicilan

            if (!empty($_POST["periode_Um"]) && !empty($_POST["txt_angsuran"])) {
                $total_um = 0;
                foreach ($_POST["txt_angsuran"] as $key => $value) {
                    $total_um += $value;
                }
                $total_transaksi -= $total_um;
                $input += ["periode_uang_muka" => $this->input->post("periode_Um", true)];
                $input += ["total_uang_muka" => $total_um];
            } else {
                $input += ["periode_uang_muka" => $this->input->post("periode_Um", true)];
                $input += ["total_uang_muka" => 0];
            }
            // !Validasi Uang Muka

            if (!empty($_POST["txt_type_pembayaran"])) {
                if ($_POST["txt_type_pembayaran"] == "2") {
                    $count = 1;
                    $input += ["periode_cicilan" => 1];
                    $input += ["total_cicilan" => $total_transaksi];
                } elseif ($_POST["txt_type_pembayaran"] == "3") {
                    $count = 1;
                    $input += ["periode_cicilan" => $this->input->post('periode_bayar', true)];
                    $input += ["total_cicilan" => $total_transaksi];
                } else {
                    $count = $this->input->post("periode_bayar", true);
                    $total_transaksi = $total_transaksi / $_POST["periode_bayar"];
                    $input += ["periode_cicilan" => $this->input->post("periode_bayar", true)];
                    $input += ["total_cicilan" => $total_transaksi];
                }
            }
            // !Validasi Cicilan

            $this->db->trans_start(); //Start Transaction Database auth concept

            $query = $this->modelapp->insertData($input, "transaksi");
            $get_id_insert = $this->db->insert_id();
            $detail = [$this->input->post('txt_nama_tambah', true), $this->input->post('txt_volume_tambah', true), $this->input->post('txt_satuan_tambah', true), $this->input->post('txt_harga_tambah', true)];
            $data['detail'] = $this->reArray($detail);
            // Detail Transaksi
            if (!empty($data['detail'])) {
                $detail_transaksi = [];
                foreach ($data['detail'] as $key => $value) {
                    if (!empty($key)) {
                        $detail_transaksi['penambahan'] = $value[0];
                        $detail_transaksi['volume'] = $value[1];
                        $detail_transaksi['satuan'] = $value[2];
                        $detail_transaksi['total'] = $value[3];
                        $detail_transaksi['transaksi'] = $get_id_insert;
                        $this->modelapp->insertData($detail_transaksi, "detail_transaksi");
                    }
                }
            }

            // Uang Tanda Jadi 
            if (!empty($input["total_tanda_jadi"])) {
                $this->tambahTandaJadi($get_id_insert, $input);
            }
            // Uang Muka Angsuran 
            if (!empty($input["periode_uang_muka"])) {
                $angsuran = $this->input->post('txt_angsuran', true);
                $this->tambahAngsuran($get_id_insert, $angsuran);
            }
            //  Periode pembayaran
            if (!empty($input["type_bayar"])) {
                $this->tambahCicilan($get_id_insert, $input, $count);
            }

            $this->db->trans_complete(); // End of Transaction Database Auth concept

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata("failed", "Gagal ditambahkan");
                redirect("transaksi/tambah");
            } else {
                $this->session->set_flashdata("success", "Berhasil ditambahkan");
                redirect("transaksi/tambah");
            }
        }
    }

    // Ubah Transaksi
    public function coreUbah()
    {
        $get_id_insert = $this->input->post('hidden', true);
        $this->validate();
        if ($this->form_validation->run() ==  false) {
            $this->edit($get_id_insert);
        } else {
            $input = $this->inputData();
            $total_transaksi = 0;

            if ($_POST["radio_tj"] == "tidak_masuk") {
                $input += ["tanda_jadi" => $this->input->post("radio_tj", true)];
                $total_transaksi = $input["total_kesepakatan"];
            } else {
                $input += ["tanda_jadi" => $this->input->post("radio_tj", true)];
                $total_transaksi = (int) ($input["total_kesepakatan"] - $input["total_tanda_jadi"]);
            }
            // !Validasi Tanda Jadi
            if (!empty($_POST["periode_Um"]) && !empty($_POST["txt_angsuran"])) {
                $total_um = 0;
                foreach ($_POST["txt_angsuran"] as $key => $value) {
                    $total_um += $value;
                }
                $total_transaksi -= $total_um;
                $input += ["periode_uang_muka" => $this->input->post("periode_Um", true)];
                $input += ["total_uang_muka" => $total_um];
            } else {
                $input += ["periode_uang_muka" => $this->input->post("periode_Um", true)];
                $input += ["total_uang_muka" => 0];
            }
            // !validasi Uang Muka

            if (!empty($_POST["txt_type_pembayaran"])) {
                if ($_POST["txt_type_pembayaran"] == "2") {
                    $count = 1;
                    $input += ["periode_cicilan" => 1];
                    $input += ["total_cicilan" => $total_transaksi];
                } elseif ($_POST["txt_type_pembayaran"] == "3") {
                    $count = 1;
                    $input += ["periode_cicilan" => $this->input->post('periode_bayar', true)];
                    $input += ["total_cicilan" => $total_transaksi];
                } else {
                    $count = $this->input->post("periode_bayar", true);
                    $total_transaksi = $total_transaksi / $_POST["periode_bayar"];
                    $input += ["periode_cicilan" => $this->input->post("periode_bayar", true)];
                    $input += ["total_cicilan" => $total_transaksi];
                }
            }
            // !Validasi Cicilan

            $this->db->trans_start(); //Start Transaction Database Auth Concept

            $query = $this->modelapp->updateData($input, "transaksi", ["id_transaksi" => $get_id_insert]);

            $detail = [$this->input->post('txt_nama_tambah', true), $this->input->post('txt_volume_tambah', true), $this->input->post('txt_satuan_tambah', true), $this->input->post('txt_harga_tambah', true)];
            $detail_array['detail'] = $this->reArray($detail);
            $this->modelapp->deleteData(['id_transaksi' => $get_id_insert], 'detail_transaksi');
            $this->modelapp->deleteData(['id_transaksi' => $get_id_insert], 'pembayaran');
            // Detail Transaksi
            if (!empty($detail_array['detail'])) {
                $data = [];
                foreach ($detail_array['detail'] as $key => $value) {
                    if (!empty($key)) {
                        $data['penambahan'] = $value[0];
                        $data['volume'] = $value[1];
                        $data['satuan'] = $value[2];
                        $data['total'] = $value[3];
                        $this->modelapp->insertData($data, "detail_transaksi");
                    }
                }
            }
            // Uang Tanda Jadi 
            if (!empty($input["total_tanda_jadi"])) {
                $this->tambahTandaJadi($get_id_insert, $input);
            }
            // Uang Muka Angsuran 
            if (!empty($input["periode_uang_muka"])) {
                $angsuran = $this->input->post('txt_angsuran', true);
                $this->tambahAngsuran($get_id_insert, $angsuran);
            }
            //  Periode pembayaran
            if (!empty($input["type_bayar"])) {
                $this->tambahCicilan($get_id_insert, $input, $count);
            }

            $this->db->trans_complete(); // End Transaction Database Auth Concept

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata("failed", "Gagal diubah");
                redirect("transaksi/edit/" . $get_id_insert);
            } else {
                $this->session->set_flashdata("success", "Berhasil diubah");
                redirect("transaksi/edit/" . $get_id_insert);
            }
        }
    }
    public function lock($params)
    {
        $id = $params;
        $get_data = $this->modelapp->getData("id_transaksi,id_konsumen,id_unit,status_transaksi", "transaksi", ["id_transaksi" => $id]);

        if ($get_data->num_rows() > 0) {
            $result = $get_data->row_array();

            if ($result['status_transaksi'] == 'p') {
                $query = $this->modelapp->updateData(['kunci' => 'l'], 'transaksi', ['id_transaksi' => $result['id_transaksi']]);
                if ($query) {
                    $this->session->set_flashdata("success", "Berhasil dilock");
                    redirect("transaksi");
                } else {
                    $this->session->set_flashdata("failed", "Berhasil dilock");
                    redirect("transaksi");
                }
            } else {

                $this->db->trans_start(); // Start Transaction Database Auth Concept

                $status_bayar = $this->modelapp->updateData(['status' => 'b'], 'pembayaran', ['id_transaksi' => $result['id_transaksi']]);
                $status_konsumen = $this->modelapp->getData('status_konsumen', 'konsumen', ['id_konsumen' => $result['id_konsumen']])->row_array();
                $status_unit = $this->modelapp->getData('status_unit', 'unit', ['id_unit' => $result['id_unit']])->row_array();

                if ($status_konsumen['status_konsumen'] == 'ck' && $status_unit['status_unit'] == 'bt') {
                    if ($result["status_transaksi"] == "s") {
                        $this->modelapp->updateData(['status_konsumen' => 'k'], 'konsumen', ['id_konsumen' => $result['id_konsumen']]);
                        $this->modelapp->updateData(['status_unit' => 'b'], 'unit', ['id_unit' => $result['id_unit']]);
                        $query = $this->modelapp->updateData(['status_transaksi' => 'p', 'kunci' => 'l'], 'transaksi', ['id_transaksi' => $result['id_transaksi']]);
                    }
                } else {
                    $this->session->set_flashdata("failed", "Konsumen Atau Unit tidak tersedia");
                    redirect("transaksi");
                }

                $this->db->trans_complete(); // End Transaction Database Auth Concept

            }
        } else {
            $this->session->set_flashdata("failed", "Data tidak ditemukan");
            redirect("transaksi");
        }
    }

    // Hapus Transaksi
    public function delete($params)
    {
        $id = $params;
        $get_data = $this->modelapp->getData("id_transaksi", "transaksi", ["id_transaksi" => $id]);

        if ($get_data->num_rows() > 0) {
            $result = $get_data->row_array();
            // $query = $this->modelapp->deleteData(["id_transaksi"=>$result["id_transaksi"]],"pembayaran");
            $query = $this->modelapp->deleteData(["id_transaksi" => $params], "transaksi");

            if ($query) {
                $this->session->set_flashdata("success", "Berhasil dihapus");
                redirect("transaksi");
            } else {
                $this->session->set_flashdata("success", "Berhasil dihapus");
                redirect("transaksi");
            }
        } else {
            $this->session->set_flashdata("failed", "Data tidak ditemukan");
            redirect("transaksi");
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
    // This function is private. so , anyone cannot to access this function from web based
    private function pages($core_page, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($core_page, $data);
        $this->load->view('partials/part_footer', $data);
    }
    private function validate()
    {
        $this->form_validation->set_rules('txt_spr', 'no spr', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('select_konsumen', 'Nama Unit', 'trim|required');
        $this->form_validation->set_rules('radio_tj', 'Pilih tipe', 'trim|required');
        $this->form_validation->set_rules('select_unit', 'select_unit', 'trim|required');
        $this->form_validation->set_rules('txt_kesepakatan', 'Kesepakatan', 'trim|required|max_length[11]');
        $this->form_validation->set_rules('txt_tanda_jadi', 'Tanda Jadi', 'trim|required|max_length[11]');
        $this->form_validation->set_rules('txt_type_pembayaran', 'Total Transaksi', 'trim|required');
        $this->form_validation->set_rules('tgl_tanda_jadi', 'Tanggal Tanda Jadi', 'trim|required');
        $this->form_validation->set_rules('tgl_pembayaran', 'Tanggal Pembayaran', 'trim|required');
    }
    private function reArray($data)
    {
        $uploads = array();
        foreach ($data as $key0 => $value0) {
            foreach ($value0 as $key => $value) {
                $uploads[$key][$key0] = $value;
            }
        }
        // $files = $uploads;
        return $uploads; // prevent misuse issue
    }
    private function inputData()
    {
        return [
            'no_spr' => $this->input->post('txt_spr', true),
            'id_konsumen' => $this->input->post('select_konsumen', true),
            'id_unit' => $this->input->post('select_unit', true),
            'tgl_transaksi' => date("Y-m-d"),
            'total_kesepakatan' => str_replace('.', '', $this->input->post('txt_kesepakatan', true)),
            "total_tanda_jadi" => str_replace('.', '', $this->input->post('txt_tanda_jadi', true)),
            'type_bayar' => $this->input->post('txt_type_pembayaran', true),
            'status_transaksi' => "s",
            'kunci' => 'u',
            'tgl_tanda_jadi' => $this->input->post('tgl_tanda_jadi', true),
            'tgl_uang_muka' => $this->input->post('tgl_uang_muka', true),
            'tgl_cicilan' => $this->input->post('tgl_pembayaran', true),
            'total_tambahan' => str_replace('.', '', $this->input->post('txt_total_tambahan', true)),
            'id_user' => $this->session->userdata('id_user')
        ];
    }
    private function tambahAngsuran($id_transaksi, $angsuran)
    {
        $data_angsuran = [];
        $no = 1;
        foreach ($angsuran as $key => $value) {
            $date = new DateTime($this->input->post('tgl_uang_muka'));
            addmonths($date, $no);
            $data_angsuran['id_transaksi'] = $id_transaksi;
            $data_angsuran['nama_pembayaran'] = 'Angsuran ' . $no;
            $data_angsuran['total_tagihan'] = $value;
            $data_angsuran['total_bayar'] = 0;
            $data_angsuran['jatuh_tempo'] = $date->format("Y-m-d");
            $data_angsuran['hutang'] = $value;
            $data_angsuran['status'] = 's';
            $data_angsuran['jenis_pembayaran'] = 2;
            $this->modelapp->insertdata($data_angsuran, "pembayaran");
            $no++;
        }
    }
    private function tambahTandaJadi($id_transaksi, $input)
    {
        $data_tj = [];
        $get_unit = $this->modelapp->getData("nama_unit", "unit", ["id_unit" => $input["id_unit"]])->row();
        $data_tj['id_transaksi'] = $id_transaksi;
        $data_tj['nama_pembayaran'] = 'Tanda Jadi ' . $get_unit->nama_unit;
        $data_tj['total_tagihan'] = $input["total_tanda_jadi"];
        $data_tj['total_bayar'] = 0;
        $data_tj['jatuh_tempo'] = $input["tgl_tanda_jadi"];
        $data_tj['hutang'] = $input["total_tanda_jadi"];
        $data_tj['status'] = 's';
        $data_tj['jenis_pembayaran'] = 1;
        $this->modelapp->insertData($data_tj, "pembayaran");
    }
    private function tambahCicilan($id_transaksi, $input, $count)
    {
        $data = [];
        $get_nama = $this->modelapp->getData("type_bayar", "type_bayar", ["id_type_bayar" => $input["type_bayar"]])->row_array();
        if ($input["type_bayar"] == 1) {
            $periode = $count;
            $no = 1;
            for ($i = 1; $i <= $periode; $i++) {
                $date = new DateTime($input["tgl_cicilan"]);
                addmonths($date, $i);
                $data['id_transaksi'] = $id_transaksi;
                $data['nama_pembayaran'] = 'Cicilan ' . $no;
                $data['total_tagihan'] = $input["total_cicilan"];
                $data['total_bayar'] = 0;
                $data['jatuh_tempo'] = $date->format("Y-m-d");
                $data['hutang'] = $input["total_cicilan"];
                $data['status'] = 's';
                $data['jenis_pembayaran'] = 3;
                $this->modelapp->insertData($data, "pembayaran");
                $no++;
            }
        } else {
            $periode = 1;
            for ($i = 1; $i <= $periode; $i++) {
                $data['id_transaksi'] = $id_transaksi;
                $data['nama_pembayaran'] = $get_nama["type_bayar"];
                $data['total_tagihan'] = $input["total_cicilan"];
                $data['total_bayar'] = 0;
                $data['jatuh_tempo'] = $input["tgl_cicilan"];
                $data['hutang'] = $input["total_cicilan"];
                $data['status'] = 's';
                $data['jenis_pembayaran'] = 3;
                $this->modelapp->insertData($data, "pembayaran");
            }
        }
    }
    private function pagination()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('transaksi/index/');
        $config['total_rows'] = $this->modelapp->getData("id_transaksi", "tbl_transaksi", ["id_properti" => $_SESSION["id_properti"], 'id_user' => $_SESSION['id_user']])->num_rows();
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
