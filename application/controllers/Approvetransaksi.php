<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Approvetransaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
    }

    public function index()
    {
        $data['title'] = 'Approve Transaksi';
        $select = 'id_transaksi,ks.nama_lengkap as nama_konsumen,unit.nama_unit,unit.id_properti,user.nama_lengkap as nama_user,total_kesepakatan,total_tanda_jadi,tanda_jadi,tgl_tanda_jadi,total_uang_muka,periode_uang_muka,tgl_uang_muka,total_cicilan,periode_cicilan,tgl_cicilan,type_bayar.type_bayar as nama_type,tgl_transaksi';
        $join = ['konsumen as ks' => 'transaksi.id_konsumen = ks.id_konsumen', 'unit' => 'transaksi.id_unit = unit.id_unit', 'user' => 'user.id_user = transaksi.id_user', 'type_bayar' => 'transaksi.type_bayar = type_bayar.id_type_bayar'];
        $where = ['status_diterima' => null];
        if (isset($_SESSION['id_properti'])) {
            $where += ['id_properti' => $_SESSION['id_properti']];
        }
        $order_by = 'id_transaksi';
        $order_tipe = 'DESC';
        $tbl = 'transaksi';
        $data['transaksi'] = $this->modelapp->getJoinData($select, $tbl, $join, $where, $order_by, $order_tipe)->result_array();
        $this->pages('approve/view_approve_transaksi', $data);
    }

    public function terima($id)
    {
        $id_transaksi = $id;
        $get_transaksi = $this->modelapp->getData("id_transaksi", "transaksi", ["id_transaksi" => $id_transaksi]);
        if ($get_transaksi->num_rows() > 0) {
            $data_transaksi = $get_transaksi->row_array();

            $this->db->trans_start(); //Start Database Transaction atau Transactional Database concept
            $update = ['status_diterima' => 'terima', 'diterima_oleh' => $_SESSION['id_user']];
            $tbl = 'transaksi';
            $where = ['id_transaksi' => $data_transaksi['id_transaksi']];
            $this->modelapp->updateData($update, $tbl, $where); // query update transaksi (status diterima)
            $update_bayar = ['status' => 'b']; //status diubah dari SEMENTARA to BELUM BAYAR;
            $this->modelapp->updateData($update_bayar, 'pembayaran', ['id_transaksi' => $data_transaksi['id_transaksi']]); //Query update pembayaran
            $this->db->trans_complete(); // Database Transaction

            if ($this->db->trans_status() === TRUE) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('approvetransaksi');
            } else {
                $this->session->set_flashdata('failed', 'Data gagal disimpan');
                redirect('approvetransaksi');
            }
        } else {
            $this->session->set_flashdata('failed', 'Data Transaksi tidak ditemukan');
            redirect('approvetransaksi');
        }
    }
    public function tolak()
    {
        $id_transaksi = $this->input->post('input_hidden', true);
        $input_deskripsi = $this->input->post('penolakan', true);
        if (empty($_POST['input_hidden']) || empty($_POST['penolakan'])) {
            $this->session->set_flashdata('error', 'Data tidak boleh kosong');
            redirect('approvetransaksi');
        } else {
            $get_transaksi = $this->modelapp->getData("id_transaksi", "transaksi", ["id_transaksi" => $id_transaksi]);
            if ($get_transaksi->num_rows() > 0) {
                $data_transaksi = $get_transaksi->row_array();
                $update = ['status_diterima' => 'tolak', 'deskripsi_tolak' => $input_deskripsi, 'diterima_oleh' => $_SESSION['id_user']];
                $tbl = 'transaksi';
                $where = ['id_transaksi' => $data_transaksi['id_transaksi']];
                $query_transaksi = $this->modelapp->updateData($update, $tbl, $where); // query update transaksi (status diterima)
                if ($query_transaksi) {
                    $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    redirect('approvetransaksi');
                } else {
                    $this->session->set_flashdata('failed', 'Data gagal disimpan');
                    redirect('approvetransaksi');
                }
            } else {
                $this->session->set_flashdata('failed', 'Data Transaksi tidak ditemukan');
                redirect('approvetransaksi');
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
        // echo $core_page;
    }
}

/* End of file Approve.php */
