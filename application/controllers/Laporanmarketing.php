<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporanmarketing extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->rolemenu->init();
	}

	public function index($num = 0)
	{
		$data['title'] = 'Laporan Marketing';
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
		if ($num != 0) {
			$num = ($num - 1) * $per_page;
		}
		$where = ['id_akses' => '4'];
		$data['marketing'] = $this->modelapp->getDataLike("id_user,nama_lengkap,no_hp,email", "user", $search, 'id_user', 'ASC ', $per_page, $num, $where)->result_array();
		$data['total'] = $this->modelapp->getData('COUNT(id_akses) as total', 'user', $where)->row_array();
		$data['row'] = $num;
		$this->pagination($where);
		$this->pages('laporan/marketing/view_marketing', $data);
	}

	public function detailUnit($id, $num = 0)
	{
		$input = $this->security->xss_clean($id);
		$data['title'] = 'Detail Marketing';
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
		if ($num != 0) {
			$num = ($num - 1) * $per_page;
		}
		$where = ['id_user' => $id];
		$data['marketing'] = $this->modelapp->getData('*', 'user', ['id_user' => $input])->row_array();
		$data['transaksi'] = $this->modelapp->getData('id_transaksi,no_spr,nama_unit,nama_properti,tgl_transaksi,total_kesepakatan,type_bayar,status_transaksi', 'tbl_transaksi', $search, 'id_transaksi', 'ASC ', $per_page, $num, $where)->result_array();
		$data['row'] = $num;
		$this->pagination($where);
		$this->pages('laporan/marketing/view_detail', $data);
	}

	// Private function 
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

		$config['base_url'] = base_url('laporanmarketing/index/');
		$config['total_rows'] = $this->modelapp->getData('id_user', 'user', $where)->num_rows();
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
	// End Page

}

/* End of file Controllername.php */
