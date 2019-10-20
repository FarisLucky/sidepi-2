<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Listunlocktransaksi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->rolemenu->init();
    $this->load->library('form_validation');
  }

  public function list()
  {
    $data['title'] = 'List Unlock Transaksi';
    $data['img'] = getCompanyLogo();
    $data["transaksi"] = $this->modelapp->getData("*", "tbl_transaksi", ["kunci" => "u", "status_transaksi" => "p"])->result();
    $this->pages("laporan/transaksi/view_list_unlock", $data);
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

  public function hapus($id)
  {
    $input = $id;
    $get_data = $this->modelapp->getData('nama_lengkap,id_transaksi,id_properti,id_unit,id_konsumen', 'tbl_transaksi', ['id_transaksi' => $input]);
    if ($get_data->num_rows() > 0) {
      $rs_transaksi = $get_data->row_array();
      $rs_dp = $this->modelapp->getData('SUM(total_bayar) as total', 'pembayaran', ['id_transaksi' => $rs_transaksi['id_transaksi'], 'jenis_pembayaran' => '2'])->row_array();
      if ($rs_dp['total'] != '0') {
        redirect('listunlocktransaksi/datahapus/' . $rs_transaksi['id_transaksi']);
      } else {
        $delete_data = $this->modelapp->deleteData(['id_transaksi' => $rs_transaksi['id_transaksi']], 'transaksi');
        if ($delete_data) {
          $update = $this->modelapp->updateData(['status_unit' => 'bt'], 'unit', ['id_unit' => $rs_transaksi['id_unit']]);
          $delete = $this->modelapp->deleteData(['id_konsumen' => $rs_transaksi['id_konsumen']], 'konsumen');
          $this->session->set_flashdata('success', 'Data berhasil dihapus');
          redirect('listunlocktransaksi');
        } else {
          $this->session->set_flashdata('failed', 'Data gagal dihapus');
          redirect('listunlocktransaksi');
        }
      }
    } else {
      $this->session->set_flashdata('failed', 'Data tidak ditemukan');
      redirect('listunlocktransaksi');
    }
  }

  public function dataHapus($input)
  {
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


  private function pages($core_page, $data)
  {
    $this->load->view('partials/part_navbar', $data);
    $this->load->view('partials/part_sidebar', $data);
    $this->load->view($core_page, $data);
    $this->load->view('partials/part_footer', $data);
  }
}

/* End of file ListUnlockTransaksi.php */
