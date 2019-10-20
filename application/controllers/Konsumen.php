<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Konsumen extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Konsumen';

        $data['konsumen'] = $this->modelapp->getData("*", 'konsumen', ['status_konsumen' => 'k', 'id_user' => $this->session->userdata('id_user')])->result();
        $this->pages("konsumen/view_konsumen", $data);
    }

    public function dataProses() //Fungsi Untuk Load Datatable
    {
        $this->load->model('Server_side', 'ssd');
        $column = "*";
        $tbl = "konsumen";
        $order = "nama_lengkap";
        $having = ['status_konsumen' => 'k'];
        $search = ['nama_lengkap'];
        $fetch_values = $this->ssd->makeDataTables($column, $tbl, $search, $order, $having);
        $data = array();
        foreach ($fetch_values as $value) {
            $sub = array();
            $sub[] = $value->id_type . ' ' . $value->id_card;
            $sub[] = $value->nama_lengkap;
            $sub[] = $value->jenis_kelamin == 'l' ? 'Laki - laki' : 'Perempuan';
            $sub[] = $value->telp;
            $sub[] = $value->email;
            $sub[] = $value->alamat;
            $sub[] = '<a href="' . base_url('konsumen/ubah/' . $value->id_konsumen) . '" class="btn btn-icons btn-inverse-info btn-details"><i class="fa fa-edit"></i></a><a href="' . base_url() . "konsumen/printkonsumen/" . $value->id_konsumen . '" class="btn btn-icons btn-inverse-warning mx-2"><i class="fa fa-print"></i></a>';
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

    public function ubah($id)
    {
        $this->load->helper('date');

        $data['title'] = 'Ubah Data';

        $data['doc_konsumen'] = $this->modelapp->getJoinData("*", "persyaratan_konsumen", ['kelompok_persyaratan' => 'kelompok_persyaratan.id_sasaran = persyaratan_konsumen.kelompok_persyaratan'], ['id_konsumen' => $id])->result_array();
        $data['kelompok'] = $this->modelapp->getData("*", "kelompok_persyaratan", ['kategori_persyaratan' => 'konsumen', 'status' => '1'])->result_array();
        $data['konsumen'] = $this->modelapp->getData("*", "konsumen", ['id_konsumen' => $id])->row_array();
        $data['trans'] = $this->modelapp->getData("*", "tbl_transaksi", ['id_konsumen' => $id, 'status_transaksi !=' => 's'])->row_array();
        $this->pages('konsumen/view_edit', $data);
    }

    public function coreUbah()
    {
        $id = $this->input->post("konsumen", true);
        if (isset($_POST['fm_data_diri'])) {
            $this->validate_data_diri();
            if ($this->form_validation->run() == false) {
                $this->ubah($id);
            } else {
                $input = $this->input_diri();
                $config = $this->initImage();
                $this->load->library('upload', $config);
                if ($_FILES['upload_foto']['name']) {
                    $data_konsumen = $this->modelapp->getData('id_konsumen,foto_ktp', 'konsumen', ['id_konsumen' => $id])->row_array();
                    $path = './assets/uploads/images/konsumen/' . $data_konsumen['foto_ktp'];
                    if (file_exists($path) && !is_dir($path)) {
                        unlink($path);
                    }
                    if (!$this->upload->do_upload('upload_foto')) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('error', $error['error']);
                        $this->ubah($data_konsumen['id_konsumen']);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $input += [
                            'foto_ktp' => $data['upload_data']['file_name']
                        ];
                    }
                }
                $query = $this->modelapp->updateData($input, "konsumen", ["id_konsumen" => $id]);
                if ($query) {
                    $this->session->set_flashdata("success", "Data berhasil diubah");
                    redirect('konsumen/ubah/' . $id);
                } else {
                    $this->session->set_flashdata("failed", "Tidak ada perubahan");
                    redirect('konsumen/ubah/' . $id);
                }
            }
        } elseif (isset($_POST['fm_data_pasangan'])) {
            $this->validate_pasangan();
            if ($this->form_validation->run() == false) {
                $this->ubah($id);
            } else {
                $input = $this->input_pasangan();
                $query = $this->modelapp->updateData($input, "konsumen", ["id_konsumen" => $id]);
                if ($query) {
                    $this->session->set_flashdata("success", "Data berhasil diubah");
                    redirect('konsumen/ubah/' . $id);
                } else {
                    $this->session->set_flashdata("failed", "Tidak ada perubahan");
                    redirect('konsumen/ubah/' . $id);
                }
            }
        } elseif (isset($_POST['fm_pekerjaan_pemohon'])) {
            $this->validate_pekerjaan_pemohon();
            if ($this->form_validation->run() == false) {
                $this->ubah($id);
            } else {
                $input = $this->input_pekerjaan_pemohon();
                $query = $this->modelapp->updateData($input, "konsumen", ["id_konsumen" => $id]);
                if ($query) {
                    $this->session->set_flashdata("success", "Data berhasil diubah");
                    redirect('konsumen/ubah/' . $id);
                } else {
                    $this->session->set_flashdata("failed", "Tidak ada perubahan");
                    redirect('konsumen/ubah/' . $id);
                }
            }
        } elseif (isset($_POST['fm_pekerjaan_pasangan'])) {
            $this->validate_pekerjaan_pasangan();
            if ($this->form_validation->run() == false) {
                $this->ubah($id);
            } else {
                $input = $this->input_pekerjaan_pasangan();
                $query = $this->modelapp->updateData($input, "konsumen", ["id_konsumen" => $id]);
                if ($query) {
                    $this->session->set_flashdata("success", "Data berhasil diubah");
                    redirect('konsumen/ubah/' . $id);
                } else {
                    $this->session->set_flashdata("failed", "Tidak ada perubahan");
                    redirect('konsumen/ubah/' . $id);
                }
            }
        } else {
            $this->session->set_flashdata("error", "Data gagal ditambahkan");
            redirect('konsumen/edit/' . $id);
        }
    }

    public function coreTambahSyarat()
    {
        $id = $this->input->post('input_hidden', true);

        $get_konsumen = $this->modelapp->getData('id_konsumen', 'konsumen', ['id_konsumen' => $id]);
        if ($get_konsumen->num_rows() > 0) {
            $data_konsumen = $get_konsumen->row_array();
            $this->form_validation->set_rules('kelompok', 'Kelompok Persyaratan', 'trim|required');

            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('error', form_error('kelompok'));
                $this->ubah($data_konsumen['id_konsumen']);
            } else {
                if (!empty($_FILES['file_img']['name'])) {

                    $config['upload_path'] = './assets/uploads/files/konsumen/';
                    $config['allowed_types'] = 'pdf';
                    $config['encrypt_name'] = true;
                    $config['max_size']  = '1024';
                    $config['max_width']  = '1024';
                    $config['max_height']  = '768';

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('file_img')) {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata('error', $error['error']);
                        $this->ubah($data_konsumen['id_konsumen']);
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $input = [
                            'kelompok_persyaratan' => $this->input->post('kelompok', true),
                            'id_konsumen' => $data_konsumen['id_konsumen'],
                            'id_user' => $_SESSION['id_user'],
                            'file' => $data['upload_data']['file_name']
                        ];
                        $query_update = $this->modelapp->insertData($input, 'persyaratan_konsumen');
                        if ($query_update) {
                            $this->session->set_flashdata('success', 'berhasil ditambahkan');
                            redirect('konsumen/ubah/' . $data_konsumen['id_konsumen']);
                        } else {
                            $this->session->set_flashdata('failed', 'Gagal ditambahkan');
                            redirect('konsumen/ubah/' . $data_konsumen['id_konsumen']);
                        }
                    }
                } else {
                    $this->session->set_flashdata('error', 'Data tidak boleh kosong');
                    redirect('konsumen/ubah/' . $id);
                }
            }
        } else {
            $this->session->set_flashdata('failed', 'Data Konsumen tidak ditemukan');
            redirect('konsumen/ubah/' . $id);
        }
    }
    public function coreTambahFile()
    {
        $id = $this->input->post('input_hidden', true);
        $data_konsumen = $this->modelapp->getData('id_konsumen', 'persyaratan_konsumen', ['id_persyaratan' => $id])->row_array();
        $config['upload_path'] = './assets/uploads/files/konsumen/';
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = true;
        $config['max_size']  = '1024';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file_upload')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('error', $error['error']);
            $this->ubah($data_konsumen['id_konsumen']);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $input = [
                'file' => $data['upload_data']['file_name']
            ];
            $query_update = $this->modelapp->updateData($input, 'persyaratan_konsumen', ['id_persyaratan' => $id]);
            if ($query_update) {
                $this->session->set_flashdata('success', 'berhasil ditambahkan');
                redirect('konsumen/ubah/' . $data_konsumen['id_konsumen']);
            }
        }
    }

    public function hapusSyarat($id, $konsumen)
    {
        $id_persyaratan = $id;
        $get_persyaratan = $this->modelapp->getData('id_persyaratan,id_konsumen,file', 'persyaratan_konsumen', ['id_persyaratan' => $id_persyaratan]);
        if ($get_persyaratan->num_rows() > 0) {
            $data_persyaratan = $get_persyaratan->row_array();
            $query_delete = $this->modelapp->deleteData(['id_persyaratan' => $data_persyaratan['id_persyaratan']], 'persyaratan_konsumen');
            if ($query_delete) {
                $this->session->set_flashdata('success', 'Data berhasil dihapus');
                redirect('konsumen/ubah/' . $data_persyaratan['id_konsumen']);
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('konsumen/ubah/' . $konsumen);
        }
    }

    public function hapusFile($id, $konsumen)
    {
        $id_persyaratan = $id;
        $get_persyaratan = $this->modelapp->getData('id_persyaratan,id_konsumen,file', 'persyaratan_konsumen', ['id_persyaratan' => $id_persyaratan]);
        if ($get_persyaratan->num_rows() > 0) {
            $data_persyaratan = $get_persyaratan->row_array();
            $path = './assets/uploads/files/konsumen/' . $data_persyaratan['file'];
            if (file_exists($path) && !is_dir($path)) {
                unlink($path);
            }
            $query_delete = $this->modelapp->updateData(['file' => ''], 'persyaratan_konsumen', ['id_persyaratan' => $data_persyaratan['id_persyaratan']]);
            if ($query_delete) {
                $this->session->set_flashdata('success', 'File berhasil dihapus');
                redirect('konsumen/ubah/' . $data_persyaratan['id_konsumen']);
            }
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
            redirect('konsumen/ubah/' . $konsumen);
        }
    }

    public function printKonsumen($id)
    {
        $this->load->library('Pdf');
        $input = $id;
        $get_data = $this->modelapp->getData('*', 'konsumen', ['id_konsumen' => $input]);
        if ($get_data->num_rows() > 0) {
            $data['rs_konsumen'] = $get_data->row_array();
            $data['img'] = getCompanyLogo();
            // $this->load->view("print/print_konsumen",$data);
            $this->pdf->load_view('Print Konsumen', 'print/print_konsumen', $data);
        } else {
            $this->session->set_flashdata('failed', 'Data tidak ditemukan');
        }
    }

    public function printDoc($id)
    {
        // $data_konsumen = $this->modelapp->getData('kelompok_persyaratan,file','persyaratan_konsumen',['id_persyaratan'=>$id])->row_array();
        $data_konsumen = $this->modelapp->getJoinData('*', 'persyaratan_konsumen', ['kelompok_persyaratan' => 'persyaratan_konsumen.kelompok_persyaratan = kelompok_persyaratan.id_sasaran'], ['id_persyaratan' => $id])->row_array();
        $data['link'] = base_url('assets/uploads/files/konsumen/' . $data_konsumen['file']);
        $data['name'] = $data_konsumen['nama_kelompok'] . '.pdf';
        $this->load->view('print/custom_print', $data);
    }

    public function validate_data_diri()
    {
        $this->form_validation->set_rules('val_id_type', 'Type Card', 'trim|required');
        $this->form_validation->set_rules('val_id_card', "Id card", "trim|required|numeric");
        $this->form_validation->set_rules('val_nama', "Nama Konsumen", "trim|required");
        $this->form_validation->set_rules('val_alamat', "Alamat", "trim|required");
        $this->form_validation->set_rules('val_telepon', "nomor telepon", "trim|required|numeric");
        $this->form_validation->set_rules('val_email', "Email", "trim|required|valid_email");
        $this->form_validation->set_rules('tgl_lahir', "Tanggal Lahir", "trim|required");
        $this->form_validation->set_rules('val_nikah', "Status Nikah", "trim|required");
        $this->form_validation->set_rules('val_pendidikan', "Pendidikan Terakhir", "trim|required");
        $this->form_validation->set_rules('val_npwp', "Nomor Pokok Wajib Pajak", "trim|required");
        // !Data diri input
    }
    public function validate_pasangan()
    {
        $this->form_validation->set_rules('nama_pasangan', "Nama Pasangan", "trim");
        $this->form_validation->set_rules('hubungan_pasangan', "Hubungan dengan pasangan", "trim");
        $this->form_validation->set_rules('alamat_pasangan', "Alamat pasangan", "trim");
        $this->form_validation->set_rules('telp_pasangan', "Telepon pasangan", "trim");
        // !Data Pasangan
    }
    public function validate_pekerjaan_pemohon()
    {
        $this->form_validation->set_rules('nama_perusahaan', "Nama perusahaan", "trim");
        $this->form_validation->set_rules('telp_perusaahan', "Telepon perusahaan", "trim");
        $this->form_validation->set_rules('bidang_usaha', "Bidang Usaha", "trim");
        $this->form_validation->set_rules('jenis_pekerjaan', "Jenis pekerjaan", "trim");
        $this->form_validation->set_rules('jabatan', "Jabatana di Perusahaan", "trim");
        $this->form_validation->set_rules('atasan', "Atasan di perusahaan", "trim");
        $this->form_validation->set_rules('telp_atasan', "Telepon atasan", "trim");
        $this->form_validation->set_rules('alamat_perusahaan', "Alamat Perusahaan", "trim");
        // !Data Pekerjaan Pemohon
    }
    private function validate_pekerjaan_pasangan()
    {
        $this->form_validation->set_rules('nama_kantor_pasangan', "Kantor Pasangan", "trim");
        $this->form_validation->set_rules('telp_kantor_pasangan', "Telepon Kantor Pasangan", "trim");
        $this->form_validation->set_rules('bidang_usaha_p', "Bidang Usaha", "trim");
        $this->form_validation->set_rules('jenis_pekerjaan2', "Jenis pekerjaan Pasangan", "trim");
        $this->form_validation->set_rules('jabatan_pasangan', "Telepon Kantor", "trim");
        $this->form_validation->set_rules('atasan_pasangan', "Atasan", "trim");
        $this->form_validation->set_rules('telp_atasan_p', "Telepon atasan", "trim");
        $this->form_validation->set_rules('alamat_kantor_pasangan', "Alamat Kantor", "trim");
        // !Data Pekerejaan Pasangan
    }

    public function input_diri()
    {
        return [
            'id_type' => $this->input->post('val_id_type', true), //val_id_type : name yang ada di view
            'id_card' => $this->input->post('val_id_card', true),
            'nama_lengkap' => $this->input->post('val_nama', true),
            'alamat' => $this->input->post('val_alamat', true),
            'telp' => $this->input->post('val_telepon', true),
            'email' => $this->input->post('val_email', true),
            'tgl_lahir' => $this->input->post('tgl_lahir', true),
            'status_nikah' => $this->input->post('val_nikah', true),
            'pendidikan_terakhir' => $this->input->post('val_pendidikan', true),
            'npwp' => $this->input->post('val_npwp', true)
            // !Data diri
        ];
    }
    public function input_pasangan()
    {
        return [
            'nama_pasangan' => $this->input->post('nama_pasangan', true),
            'hubungan_pasangan' => $this->input->post('hubungan_pasangan', true),
            'alamat_pasangan' => $this->input->post('alamat_pasangan', true),
            'telp_pasangan' => $this->input->post('telp_pasangan', true)
            // !Data Pasangan
        ];
    }
    public function input_pekerjaan_pemohon()
    {
        return [
            'nama_perusahaan' => $this->input->post('nama_perusahaan', true),
            'telp_perusahaan' => $this->input->post('telp_perusahaan', true),
            'bidang_usaha' => $this->input->post('bidang_usaha', true),
            'jenis_pekerjaan' => $this->input->post('jenis_pekerjaan', true),
            'jabatan' => $this->input->post('jabatan', true),
            'nama_atasan' => $this->input->post('atasan', true),
            'telp_atasan' => $this->input->post('telp_atasan', true),
            'alamat_perusahaan' => $this->input->post('alamat_perusahaan', true),
            // !Data Kantor Pemohon
        ];
    }
    public function input_pekerjaan_pasangan()
    {
        return [
            'kantor_pasangan' => $this->input->post('nama_kantor_pasangan', true),
            'telp_kantor_pasangan' => $this->input->post('telp_kantor_pasangan', true),
            'bidang_usaha_p' => $this->input->post('bidang_usaha_p', true),
            'jabatan_pasangan' => $this->input->post('jabatan_pasangan', true),
            'pekerjaan_pasangan' => $this->input->post('jenis_pekerjaan2', true),
            'nama_atasan_p' => $this->input->post('atasan_pasangan', true),
            'telp_atasan_p' => $this->input->post('telp_atasan', true),
            'alamat_kantor_pasangan' => $this->input->post('alamat_kantor_pasangan', true)
        ];
    }
    private function pages($path, $data)
    {
        $this->load->view('partials/part_navbar', $data);
        $this->load->view('partials/part_sidebar', $data);
        $this->load->view($path, $data);
        $this->load->view('partials/part_footer', $data);
    }
    private function initImage()
    {
        $config['upload_path'] = "./assets/uploads/images/konsumen/";
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['encrypt_name'] = true;
        $config['max_size']  = '1048';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        return $config;
    }
}
