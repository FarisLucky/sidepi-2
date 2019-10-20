<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Unitproperti extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library('form_validation');
    }

    public function index($num = 0)
    {
        $data['title'] = 'Unit Properti';
        $data["site_plan"] = $this->modelapp->getData("foto_properti", "properti", ["id_properti" => $_SESSION["id_properti"]])->row_array();
        $data["list_unit"] = $this->modelapp->getData("nama_unit,status_unit", "unit", ["id_properti" => $_SESSION["id_properti"]])->result();
        $per_page = 10;
        if ($num != 0) {
            $num = ($num - 1) * $per_page;
        }
        $data['unit'] = $this->modelapp->getData('*', 'unit', ['id_properti' => $_SESSION['id_properti']], 'id_unit', 'ASC', $per_page, $num)->result_array();
        $data['row'] = $num;
        $this->pagination();
        $this->pages("unit_properti/view_unit", $data);
    }

    public function tambah() //Menampilkan Form Tambah
    {
        $data['title'] = 'Tambah Unit';

        $data['img'] = getCompanyLogo();
        $this->pages("unit_properti/view_tambah_unit", $data);
    }
    public function multiTambah() //Menampilkan Form Tambah
    {
        $data['title'] = 'Tambah Unit';

        $data['img'] = getCompanyLogo();
        $this->pages("unit_properti/view_tambah_multiunit", $data);
    }
    public function detailUnit($id) //Menampilkan Form Tambah
    {
        $data['title'] = 'Detail Unit';

        $data['img'] = getCompanyLogo();
        $data['unit'] = $this->modelapp->getData("*", "unit", ["id_unit" => $id])->row();
        $this->pages("unit_properti/view_detail_unit", $data);
    }

    public function coreTambah() //Unit Core Tambah
    {
        $this->validate();
        if ($this->form_validation->run() == false) {
            $this->tambah();
        } else {
            $id_properti = $this->session->userdata('id_properti');
            $inputData = $this->inputData();
            $inputData += ["id_properti" => $id_properti];
            $jumlah_unit = $this->modelapp->getData("jumlah_unit", "properti", ["id_properti" => $id_properti])->row_array();
            $total_unit = $this->modelapp->getData("SUM(id_unit) as total_unit", "unit", ["id_properti" => $id_properti])->row_array();

            if ($total_unit["total_unit"] >= $jumlah_unit["jumlah_unit"]) {
                $this->session->set_flashdata("failed", "Jumlah Unit sudah mencapai batas");
                $this->tambah();
            } else {
                $config = $this->imageInit('./assets/uploads/images/unit_properti/');
                $this->load->library('upload', $config);
                if ($_FILES['foto']['name'] != "") {
                    if ($this->upload->do_upload('foto')) {
                        $img = $this->upload->data();
                        $inputData += ["foto_unit" => $img['file_name']];
                        $query = $this->modelapp->insertData($inputData, "unit");
                        if ($query) {
                            $this->session->set_flashdata("success", "Unit berhasil ditambahkan");
                            redirect("unitproperti/tambah");
                        }
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata("error", $error);
                        $this->tambah();
                    }
                } else {
                    $inputData += ["foto_unit" => "default.jpg"];
                    $act = $this->modelapp->insertData($inputData, "unit");
                    if ($act) {
                        $this->session->set_flashdata("success", "Unit berhasil ditambahkan");
                        redirect("unitproperti/tambah");
                    } else {
                        $this->session->set_flashdata("failed", "Gagal ditambahkan");
                        redirect("unitproperti/tambah");
                    }
                }
            }
        }
    }
    public function coreMultiTambah() //Unit Core Tambah
    {
        $this->validate();
        $this->form_validation->set_rules('txt_blok_awal', 'Blok Awal', 'trim|required|numeric|max_length[3]');
        $this->form_validation->set_rules('txt_jumlah_blok', 'Blok Akhir', 'trim|required|numeric|max_length[4]');
        if ($this->form_validation->run() == false) {
            $this->multiTambah();
        } else {
            $awal = (int) $this->input->post("txt_blok_awal", true);
            $jumlah = (int) $this->input->post("txt_jumlah_blok", true);
            $id_properti = $this->session->userdata("id_properti");
            $query = $this->modelapp->getData("jumlah_unit", "properti", ["id_properti" => $id_properti])->row();
            $query_unit = $this->modelapp->getData("COUNT(id_unit) as jumlah_unit", "unit", ["id_properti" => $id_properti])->row();
            if ($jumlah > 0) {
                if ($query_unit->jumlah_unit < $query->jumlah_unit) {
                    $sisa = ($query->jumlah_unit - $query_unit->jumlah_unit);
                    if ($jumlah > $sisa) {
                        $this->session->set_flashdata("error", "Jumlah terlalu banyak");
                        $this->multiTambah();
                    } else {
                        $nama = $this->input->post("txt_nama", true);
                        $input = $this->inputData();
                        $input += ["id_properti" => $id_properti];
                        $input += ["foto_unit" => "default.jpg"];
                        $total = $awal + $jumlah;
                        for ($i = $awal; $i < $total; $i++) {
                            $input["nama_unit"] = $nama . $i;
                            $this->modelapp->insertData($input, "unit");
                        }
                        $this->session->set_flashdata("success", "Berhasil ditambahkan");
                        redirect("unitproperti/multitambah");
                    }
                } else {
                    $this->session->set_flashdata("error", "Unit sudah Full");
                    $this->multiTambah();
                }
            } else {
                $this->session->set_flashdata("error", "Jumlah blok harus lebih dari 0");
                $this->multiTambah();
            }
        }
    }

    public function coreDetail() //Unit Core Tambah
    {
        $id = $this->input->post("txt_id", true);
        $this->validate();
        if ($this->form_validation->run() == false) {
            $this->detailUnit($id);
        } else {
            $inputData = $this->inputData();
            $config = $this->imageInit("./assets/uploads/images/unit_properti/");
            $this->load->library('upload', $config);
            if ($_FILES['foto']['name'] != "") {
                if ($this->upload->do_upload('foto')) {
                    $link = $this->modelapp->getData("foto_unit", "unit", ["id_unit" => $id])->row();
                    $path = "./assets/uploads/images/unit_properti/" . $link->foto_unit;
                    if (file_exists($path) && !is_dir($path)) {
                        if ($link != "default.jpg") {
                            unlink($path);
                        }
                    }
                    $img = $this->upload->data();
                    $inputData += ["foto_unit" => $img["file_name"]];
                    $query = $this->modelapp->updateData($inputData, "unit", ["id_unit" => $id]);
                    if ($query) {
                        $this->session->set_flashdata("success", "Berhasil diubah");
                        redirect("unitproperti/detailunit/" . $id);
                    }
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata("error", $error);
                    $this->detailUnit($id);
                }
            } else {
                $act = $this->modelapp->updateData($inputData, "unit", ["id_unit" => $id]);
                if ($act) {
                    $this->session->set_flashdata("success", "Berhasil diubah");
                    redirect("unitproperti/detailunit/" . $id);
                }
            }
        }
    }

    public function coreHapus($id)
    {
        $input = $id;
        if (!empty($input)) {
            $image = $this->modelapp->getData("foto_unit", "unit", ["id_unit" => $input])->row_array();
            if ($image["foto_unit"] != null) {
                if ($image['foto_unit'] != "default.jpg") {
                    $path = "./assets/uploads/images/unit_properti/" . $image["foto_unit"];
                    if (file_exists($path) && !is_dir($path)) {
                        unlink($path);
                    }
                }
            }
            $query = $this->modelapp->deleteData(["id_unit" => $input], "unit");
            if ($query) {
                $this->session->set_flashdata("success", "Berhasil dihapus");
                redirect("unitproperti");
            }
        } else {
            $this->session->set_flashdata("failed", "Unit tidak ditemukan");
            redirect("unitproperti");
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
        $this->form_validation->set_rules('txt_nama', 'Nama Unit', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('txt_type', 'Type', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('txt_tanah', 'Luas Tanah', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan_tanah', 'Satuan Tanah', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('txt_bangunan', 'Luas Bangunan', 'trim|required|numeric');
        $this->form_validation->set_rules('satuan_bangunan', 'Satuan Bangunan', 'trim|required|max_length[5]');
        $this->form_validation->set_rules('txt_harga', 'Harga', 'trim|required|numeric|max_length[9]');
        $this->form_validation->set_rules('txt_alamat', 'Alamat', 'trim|required');
        $this->form_validation->set_rules('txt_desc', 'Deskripsi', 'trim|required');
    }
    private function inputData()
    {
        $input = [
            "nama_unit" => $this->input->post("txt_nama", true),
            'type' => $this->input->post('txt_type', true),
            'luas_tanah' => $this->input->post('txt_tanah', true),
            'satuan_tanah' => $this->input->post('satuan_tanah', true),
            'luas_bangunan' => $this->input->post('txt_bangunan', true),
            'satuan_bangunan' => $this->input->post('satuan_bangunan', true),
            'harga_unit' => $this->input->post('txt_harga', true),
            'alamat_unit' => $this->input->post('txt_alamat', true),
            'tgl_buat' => date("Y-m-d"),
            'status_unit' => "bt",
            'deskripsi' => $this->input->post('txt_desc', true),
            'id_user' => $this->session->userdata("id_user"),
        ];
        return $input;
    }
    private function imageInit($path)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['encrypt_name'] = true;
        $config['max_size']  = '1024';
        $config['max_width']  = '800';
        $config['max_height']  = '800';
        return $config;
    }
    private function pagination()
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url('unitproperti/index/');
        $config['total_rows'] = $this->modelapp->getData("id_unit", "unit", ["id_properti" => $_SESSION["id_properti"]])->num_rows();
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

/* End of file Unit_properti.php */
