<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->rolemenu->init();
		$this->load->library('form_validation');
	}
	public function index($num = 0)
	{
		$data['title'] = "Kategori";
		$search = '';
		if (isset($_POST['search'])) {
			$search = ['nama_kelompok' => $this->input->post('search')];
			$this->session->set_userdata(array("search" => $search));
		} elseif (isset($_POST['reset'])) {
			$this->session->unset_userdata('search');
		}
		$per_page = 10;
		if ($num != 0) {
			$num = ($num - 1) * $per_page;
		}
		$data['kategori_item'] = $this->modelapp->getDataLike('*', 'tbl_item', $search, 'id_kelompok', 'ASC', $per_page, $num)->result();
		$data['row'] = $num;
		$this->pagination();
		$this->pages('item/view_item', $data);
	}
	public function tambah()
	{
		$data['title'] = "Tambah Kategori";
		$data['img'] = getCompanyLogo();

		$data['kategori'] = $this->modelapp->getData("*", 'kategori_kelompok')->result();
		$this->pages('item/v_tambah_item', $data);
	}
	public function coreTambah()
	{
		$config = $this->validate();
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == true) {
			$nama_kelompok = $this->input->post('nama_kelompok');
			$data = array(
				'nama_kelompok' => $nama_kelompok,
				'id_user' => $this->session->userdata('id_user'),
				'id_kategori' => $this->input->post('select_kategori'),
				'status' => 'a'
			);
			$query = $this->modelapp->insertData($data, 'kelompok_item');
			if ($query) {
				$this->session->set_flashdata('success', 'Data berhasil ditambahkan');
				redirect('item');
			}
		} else {
			$this->tambah();
		}
	}
	public function ubah($id_kelompok)
	{
		$data["title"] = "Edit Item";

		$data['img'] = getCompanyLogo();
		$where = array('id_kelompok' => $id_kelompok);
		$data['kategori_item'] = $this->modelapp->getData('*', 'kelompok_item', $where)->row();
		$data['kategori'] = $this->modelapp->getData("*", 'kategori_kelompok')->result();
		$this->pages('item/v_edit_item', $data);
	}
	public function coreUbah()
	{
		$id_kelompok = $this->input->post('id_kelompok', true);
		$config = $this->validate();
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == false) {
			$this->ubah($id_kelompok);
		} else {
			$input = [
				'nama_kelompok' => $this->input->post('nama_kelompok', true),
				'id_user' => $this->session->userdata('id_user'),
				'id_kategori' => $this->input->post('select_kategori', true),
				'status' => 'a'
			];
			$query = $this->modelapp->updateData($input, 'kelompok_item', ['id_kelompok' => $id_kelompok]);
			if ($query) {
				$this->session->set_flashdata('success', 'Data berhasil diubah');
				redirect('item/ubah/' . $id_kelompok);
			}
		}
	}
	public function status($id)
	{
		$input = $id;
		$get_data = $this->modelapp->getData('*', 'kelompok_item', ['id_kelompok' => $input]);
		if ($get_data->num_rows() > 0) {
			$rs_status = $get_data->row();
			$set_st = '';
			if ($rs_status->status == 'a') {
				$set_st = 't';
			} else {
				$set_st = 'a';
			}
			$query = $this->modelapp->updateData(["status" => $set_st], 'kelompok_item', ['id_kelompok' => $id]);
			if ($query) {
				$this->session->set_flashdata('success', 'Data berhasil diubah');
				redirect('item');
			}
		} else {
			$this->session->set_flashdata('failed', 'Data tidak ditemukan');
			redirect('item');
		}
	}
	private function pages($path, $data)
	{
		$this->load->view('partials/part_navbar', $data);
		$this->load->view('partials/part_sidebar', $data);
		$this->load->view($path, $data);
		$this->load->view('partials/part_footer', $data);
	}
	private function validate()
	{
		return array(
			array(
				'field' => 'nama_kelompok',
				'label' => 'Nama Kelompok',
				'rules' => 'trim|required|max_length[50]'
			), array(
				'field' => 'select_kategori',
				'label' => 'Kategori Kelompok',
				'rules' => 'trim|required'
			)
		);
	}
	private function pagination()
	{
		$this->load->library('pagination');

		$config['base_url'] = base_url('kelolauser/index/');
		$config['total_rows'] = $this->modelapp->getData('id_kelompok', 'tbl_item')->num_rows();
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
