<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemasukan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->rolemenu->init();
		$this->load->library('form_validation');
		$this->load->helper('date');
	}
	public function index($num = 0)
	{
		$data["title"] = "Pemasukan";
		$per_page = 10;
		$search = '';
		if (isset($_POST['submit'])) {
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
		$data['pemasukan'] = $this->modelapp->getDataLike("*", "tbl_pemasukan", $search, 'id_pemasukan', 'DESC', $per_page, $num, ["id_properti" => $_SESSION["id_properti"]])->result();
		$data['row'] = $num;
		$this->pagination();
		$this->pages('pemasukan/view_pemasukan', $data);
	}
	public function tambah()
	{
		$data['title'] = "Tambah";

		$data['img'] = getCompanyLogo();
		$data['kelompok'] = $this->modelapp->getData('*', 'kelompok_item', ['id_kategori' => 4, "status" => "a"])->result();
		$data['unit'] = $this->modelapp->getData('id_unit,nama_unit', 'unit', ['id_properti' => $_SESSION['id_properti']])->result();
		$this->pages('pemasukan/view_tambah', $data);
	}
	public function coreTambah()
	{
		$this->validate();
		if ($this->form_validation->run() == false) {
			$this->tambah();
		} else {
			$input = $this->inputData();
			$input += [
				'tgl_buat' => date('Y-m-d'),
				'id_user' => $this->session->userdata("id_user"),
				'id_properti' => $this->session->userdata('id_properti')
			];
			$config = $this->initImage();
			$this->load->library('upload', $config);
			if ($_FILES['bukti_kwitansi']['name'] != "") {
				if ($this->upload->do_upload('bukti_kwitansi')) {
					$img = $this->upload->data();
					$gambar = $img['file_name'];
					$input += ['bukti_kwitansi' => $gambar];
					$query = $this->modelapp->insertData($input, 'pemasukan');
					if ($query) {
						$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
						redirect('pemasukan/tambah');
					}
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					$this->tambah();
				}
			} else {
				$query = $this->modelapp->insertData($input, 'pemasukan');
				if ($query) {
					$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
					redirect('pemasukan/tambah');
				}
			}
		}
	}

	public function hapus($id)
	{
		$input = $id;
		$get_data = $this->modelapp->getData('id_pemasukan,bukti_kwitansi', 'pemasukan', ['id_pemasukan' => $input]);
		if ($get_data->num_rows() > 0) {
			$rs_pemasukan = $get_data->row();
			$path = "./assets/uploads/images/pemasukan/" . $rs_pemasukan->bukti_kwitansi;
			if (file_exists($path) && !is_dir($path)) {
				unlink($path);
			}
			$query = $this->modelapp->deleteData(["id_pemasukan" => $rs_pemasukan->id_pemasukan], 'pemasukan');
			if ($query) {
				$this->session->set_flashdata('success', 'Data berhasil dihapus');
				redirect('pemasukan');
			}
		} else {
			$this->session->set_flashdata('failed', 'Data tidak ditemukan');
			redirect('pemasukan');
		}
	}

	public function lock($id)
	{
		$input = $id;
		$get_data = $this->modelapp->getData('id_pemasukan,status_manager', 'pemasukan', ['id_pemasukan' => $input]);
		if ($get_data->num_rows() > 0) {
			$rs_pemasukan = $get_data->row_array();
			if ($rs_pemasukan['status_manager'] == 'sl') {
				$query_update = $this->modelapp->updateData(['status_owner' => 'p'], 'pemasukan', ['id_pemasukan' => $rs_pemasukan['id_pemasukan']]);
				if ($query_update) {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect('pemasukan');
				}
			} else {
				$query_update = $this->modelapp->updateData(['status_owner' => 'p', 'status_manager' => 'p'], 'pemasukan', ['id_pemasukan' => $rs_pemasukan['id_pemasukan']]);
				if ($query_update) {
					$this->session->set_flashdata('success', 'Berhasil disimpan');
					redirect('pemasukan');
				}
			}
		} else {
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			redirect('pemasukan');
		}
	}

	public function ubah($id)
	{
		$data['title'] = "Ubah";
		$active = "pengeluaran";
		$data['menus'] = $this->rolemenu->getMenus($active);
		$where = array('id_pemasukan' => $id);
		$data['img'] = getCompanyLogo();
		$data['kelompok'] = $this->modelapp->getData('*', 'kelompok_item', ['id_kategori' => 4, "status" => "a"])->result();
		$data['p'] = $this->modelapp->getData('*', 'pemasukan', $where)->row();
		$this->pages('pemasukan/view_ubah', $data);
	}
	public function coreUbah()
	{
		$id = $this->input->post('params', true);
		$this->validate();
		if ($this->form_validation->run() == false) {
			$this->ubah($id);
		} else {
			$input = $this->inputData();
			$config = $this->initImage();
			$this->load->library('upload', $config);
			if ($_FILES['bukti_kwitansi']['name'] != "") {
				if ($this->upload->do_upload('bukti_kwitansi')) {
					$result = $this->modelapp->getData('bukti_kwitansi', 'pemasukan', ['id_pemasukan' => $id])->row();
					$path = "./assets/uploads/images/pemasukan/" . $result->bukti_kwitansi;
					if (file_exists($path) && !is_dir($path)) {
						unlink($path);
					}
					$img = $this->upload->data();
					$input += ['bukti_kwitansi' => $img['file_name']];
					$update = $this->modelapp->updateData($input, 'pemasukan', ['id_pemasukan' => $id]);
					if ($update) {
						$this->session->set_flashdata('success', 'Data berhasil diubah');
						redirect('pemasukan/ubah/' . $id);
					} else {
						$this->session->set_flashdata('failed', 'Data tidak ada perubahan');
						redirect('pemasukan/ubah/' . $id);
					}
				} else {
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('failed', $error);
					redirect('pemasukan/ubah/' . $id);
				}
			} else {
				$update = $this->modelapp->updateData($input, 'pemasukan', ["id_pemasukan" => $id]);
				if ($update) {
					$this->session->set_flashdata('success', 'Data berhasil diubah');
					redirect('pemasukan/ubah/' . $id);
				} else {
					$this->session->set_flashdata('failed', 'tidak ada perubahan data');
					redirect('pemasukan/ubah/' . $id);
				}
			}
		}
	}

	private function validate()
	{
		$this->form_validation->set_rules('nama_pemasukan', 'Nama', 'trim|required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('volume', 'Jumlah', 'trim|required|numeric');
		$this->form_validation->set_rules('satuan', 'Satuan', 'trim|required|min_length[1]|max_length[50]');
		$this->form_validation->set_rules('harga_satuan', 'Harga', 'trim|required|numeric');
		$this->form_validation->set_rules('kelompok', 'Kelompok Pengeluaran', 'trim|required');
		$this->form_validation->set_rules('unit', 'Unit', 'trim|required');
	}
	private function pages($path, $data)
	{
		$this->load->view('partials/part_navbar', $data);
		$this->load->view('partials/part_sidebar', $data);
		$this->load->view($path, $data);
		$this->load->view('partials/part_footer', $data);
	}
	private function inputData()
	{
		$data = array(
			'nama_pemasukan' => $this->input->post('nama_pemasukan', true),
			'volume' => $this->input->post('volume', true),
			'satuan' => $this->input->post('satuan', true),
			'harga_satuan' => $this->input->post('harga_satuan', true),
			'total_harga' => (int) ($this->input->post('volume') * $this->input->post('harga_satuan')),
			'id_unit' => $this->input->post('unit', true),
			'id_kelompok' => $this->input->post('kelompok', true)
		);
		return $data;
	}
	private function initImage()
	{
		$config['upload_path'] = './assets/uploads/images/pemasukan/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['encrypt_name'] = true;
		$config['max_size']  = '1024';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		return $config;
	}
	private function pagination()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url('pemasukan/index/');
		$config['total_rows'] = $this->modelapp->getData('id_pemasukan', 'tbl_pemasukan')->num_rows();
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
