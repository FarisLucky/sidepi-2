<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Persyaratanunit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library('form_validation');
    }

    public function dataUnit() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side', 'ssd');
        $column = "*";
        $tbl = "unit";
        $order = "id_unit";
        $id_properti = $this->session->userdata('id_properti');
        $column_where = ["id_properti" => $id_properti];
        $search = ['nama_unit'];
        $fetch_values = $this->ssd->makeDataTables($column, $tbl, $search, $order, $column_where);
        $data = array();
        $no = 1;
        foreach ($fetch_values as $value) {
            if ($value->status_unit == "t") {
                $status = "Terjual";
                $badge = "badge-success";
            } elseif ($value->status_unit == "b") {
                $status = "Booking";
                $badge = "badge-info";
            } else {
                $status = "Belum Terjual";
                $badge = "badge-primary";
            }
            $sub = array();
            $sub[] = $value->nama_unit;
            $sub[] = $value->type;
            $sub[] = $value->luas_tanah;
            $sub[] = $value->luas_bangunan;
            $sub[] = "Rp. " . number_format($value->harga_unit, 2, ',', '.');
            $sub[] = '<small class="badge ' . $badge . '">' . $status . '</small>';
            $sub[] = '<img id="foto_properti" width="250px" src="' . base_url() . 'assets/uploads/images/unit_properti/' . $value->foto_unit . '" class="img-thumbnail" alt="">';
            $sub[] = '<a href="' . base_url() . 'persyaratanunit/detailunit/' . $value->id_unit . '" class="btn btn-icons btn-inverse-info mr-1"><i class="fa fa-info"></i></a>';
            $data[] = $sub;
            $no++;
        }
        $output = array(
            'draw' => intval($this->input->post('draw')),
            'recordsTotal' => intval($this->ssd->get_all_datas($tbl, $column_where)),
            'recordsFiltered' => intval($this->ssd->get_filtered_datas($column, $tbl, $search, $order, $column_where)),
            'data' => $data
        );
        return $this->output->set_output(json_encode($output));
    }

    public function index()
    {
        $data['title'] = 'Persyaratan Unit';

        $data['unit'] = $this->modelapp->getData('*', 'tbl_unit')->result_array();
        $this->pages("persyaratan/view_unit", $data);
    }

    public function detailUnit($id) //Menampilkan Form Tambah
    {
        $data['title'] = 'Detail Unit';

        $data['img'] = getCompanyLogo();
        $data['unit'] = $this->modelapp->getData("*", "unit", ["id_unit" => $id])->row();
        $data['doc_unit'] = $this->modelapp->getJoinData("*", "persyaratan_unit", ['kelompok_persyaratan' => 'kelompok_persyaratan.id_sasaran = persyaratan_unit.kelompok_persyaratan'], ['id_unit' => $id])->result_array();
        $data['kelompok'] = $this->modelapp->getData("*", "kelompok_persyaratan", ['kategori_persyaratan' => 'unit', 'status' => '1'])->result_array();
        $this->pages("persyaratan/view_ubah_unit", $data);
    }

    public function ubah($id)
    {
        $data['title'] = 'Ubah Persyaratan';

        $data['unit'] = $this->modelapp->getData('*', 'tbl_unit', ['id_unit' => $id])->row_array();
        $data['doc_unit'] = $this->modelapp->getJoinData("*", "persyaratan_unit", ['kelompok_persyaratan' => 'kelompok_persyaratan.id_sasaran = persyaratan_unit.kelompok_persyaratan'], ['id_unit' => $id])->result_array();
        $data['kelompok'] = $this->modelapp->getData("*", "kelompok_persyaratan", ['kategori_persyaratan' => 'unit'])->result_array();
        $this->pages("persyaratan/view_ubah_unit", $data);
    }

    public function coreUbah()
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
                        redirect("persyaratanunit/detailunit/" . $id);
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
                    redirect("persyaratanunit/detailunit/" . $id);
                }
            }
        }
    }

    public function coreTambahSyarat()
    {
        $id = $this->input->post('input_hidden', true);

        $get_unit = $this->modelapp->getData('id_unit', 'unit', ['id_unit' => $id]);
        if ($get_unit->num_rows() > 0) {
            $data_unit = $get_unit->row_array();
            $this->form_validation->set_rules('kelompok', 'Kelompok Persyaratan', 'trim|required');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('error', form_error('kelompok'));
                $this->detailUnit($data_unit['id_unit']);
            } else {
                if (!empty($_FILES['file_img']['name'])) {

                    $config['upload_path'] = './assets/uploads/files/unit/';
                    $config['allowed_types'] = 'pdf';
                    $config['encrypt_name'] = true;
                    $config['max_size']  = '1024';
                    $config['max_width']  = '1024';
                    $config['max_height']  = '768';

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('file_img')) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('error', $error['error']);
                        $this->detailUnit($data_unit['id_unit']);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $input = [
                            'kelompok_persyaratan' => $this->input->post('kelompok', true),
                            'id_unit' => $data_unit['id_unit'],
                            'id_user' => $_SESSION['id_user'],
                            'file' => $data['upload_data']['file_name']
                        ];
                        $query_update = $this->modelapp->insertData($input, 'persyaratan_unit');
                        if ($query_update) {
                            $this->session->set_flashdata('success', 'berhasil ditambahkan');
                            redirect('persyaratanunit/detailunit/' . $data_unit['id_unit']);
                        } else {
                            $this->session->set_flashdata('failed', 'Gagal ditambahkan');
                            redirect('persyaratanunit/detailunit/' . $data_unit['id_unit']);
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', 'Data tidak boleh kosong');
                    redirect('persyaratanunit/detailunit/' . $id);
                }
            }
        } else {
            $this->session->set_flashdata('failed', 'Data Unit tidak ditemukan');
            redirect('persyaratanunit/detailunit/' . $id);
        }
    }

    public function coreTambahFile()
    {
        $id = $this->input->post('input_hidden', true);
        $data_unit = $this->modelapp->getData('id_unit', 'persyaratan_unit', ['id_persyaratan' => $id])->row_array();
        $config['upload_path'] = './assets/uploads/files/unit/';
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = true;
        $config['max_size']  = '1024';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_upload')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
        } else {
            $this->ubah($data_unit['id_unit']);
            $data = array('upload_data' => $this->upload->data());
            $input = [
                'file' => $data['upload_data']['file_name']
            ];
            $query_update = $this->modelapp->updateData($input, 'persyaratan_unit', ['id_persyaratan' => $id]);
            if ($query_update) {
                $this->session->set_flashdata('success', 'berhasil ditambahkan');
                redirect('persyaratanunit/detailunit/' . $data_unit['id_unit']);
            }
        }
    }

    public function hapusSyarat($id, $unit)
    {
        $id_persyaratan = $id;
        $get_persyaratan = $this->modelapp->getData('id_persyaratan,id_unit,file', 'persyaratan_unit', ['id_persyaratan' => $id_persyaratan]);
        if ($get_persyaratan->num_rows() > 0) {
            $data_persyaratan = $get_persyaratan->row_array();
            $query_delete = $this->modelapp->deleteData(['id_persyaratan' => $data_persyaratan['id_persyaratan']], 'persyaratan_unit');
            if ($query_delete) {
                $this->session->set_flashdata('success', 'Data berhasil dihapus');
                redirect('persyaratanunit/detailunit/' . $data_persyaratan['id_unit']);
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('persyaratanunit/detailunit/' . $data_persyaratan['id_unit']);
        }
    }

    public function hapusFile($id, $unit)
    {
        $id_persyaratan = $id;
        $get_persyaratan = $this->modelapp->getData('id_persyaratan,id_unit,file', 'persyaratan_unit', ['id_persyaratan' => $id_persyaratan]);
        if ($get_persyaratan->num_rows() > 0) {
            $data_persyaratan = $get_persyaratan->row_array();
            $path = './assets/uploads/files/unit/' . $data_persyaratan['file'];
            if (file_exists($path) && !is_dir($path)) {
                unlink($path);
            }
            $query_delete = $this->modelapp->updateData(['file' => ''], 'persyaratan_unit', ['id_persyaratan' => $data_persyaratan['id_persyaratan']]);
            if ($query_delete) {
                $this->session->set_flashdata('success', 'File berhasil dihapus');
                redirect('persyaratanunit/detailunit/' . $data_persyaratan['id_unit']);
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('persyaratanunit/detailunit/' . $$unit);
        }
    }

    public function printDoc($id)
    {
        $data_unit = $this->modelapp->getJoinData('*', 'persyaratan_unit', ['kelompok_persyaratan' => 'persyaratan_unit.kelompok_persyaratan = kelompok_persyaratan.id_sasaran'], ['id_persyaratan' => $id])->row_array();
        $data['link'] = base_url('assets/uploads/files/unit/' . $data_unit['file']);
        $data['name'] = $data_unit['kelompok_persyaratan'] . '.pdf';
        $this->load->view('print/custom_print', $data);
    }

    private function validate()
    {
        $this->form_validation->set_rules('txt_nama', 'Nama Unit', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('txt_type', 'Type', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('txt_tanah', 'Luas Tanah', 'trim|required|numeric|max_length[5]');
        $this->form_validation->set_rules('satuan_tanah', 'Satuan Tanah', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('txt_bangunan', 'Luas Bangunan', 'trim|required|numeric|max_length[5]');
        $this->form_validation->set_rules('satuan_bangunan', 'Satuan Bangunan', 'trim|required|max_length[10]');
        $this->form_validation->set_rules('txt_harga', 'Harga', 'trim|required|numeric|max_length[10]');
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
        $config['max_size']  = '2048';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        return $config;
    }

    private function pages($core_page, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($core_page, $data);
        $this->load->view('partials/part_footer', $data);
    }
}

    /* End of file PersyaratanKonsumen.php */
