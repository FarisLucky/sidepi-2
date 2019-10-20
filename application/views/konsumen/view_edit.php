<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Ubah Data Konsumen</h4>
            <a href="<?= base_url("konsumen") ?>" class="btn btn-sm btn-dark float-right"><i
                class="fa fa-arrow-circle-left"></i> Kembali</a>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <small class="txt-semi-high font-weight-medium">Data Konsumen</small>
            <a href="" class="text-primary float-right" data-target="#tabs" data-toggle="collapse"><i
                class="fa fa-circle"></i></a>
          </div>
        </div>
        <hr>
        <div id="tabs" class="collapse">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#data_diri" role="tab"
                aria-selected="true">Pemohon</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data_pasangan" role="tab"
                aria-controls="profile" aria-selected="false">Pasangan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#pekerjaan_pemohon" role="tab"
                aria-selected="false">Pekerjaan Pemohon</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#pekerjaan_pasangan" role="tab"
                aria-selected="false">Pekerjaan Pasangan</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="data_diri" role="tabpanel">
              <br>
              <h5>Data Diri Konsumen</h5>
              <hr>
              <form action="<?= base_url('konsumen/coreubah') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                  value="<?= $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="konsumen" value="<?= $konsumen['id_konsumen'] ?>">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Pilih Type ID Card</label>
                      <select name="val_id_type" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="sim" <?php echo ($konsumen["id_type"] == "sim") ? "selected" : "" ; ?>>KTP
                        </option>
                        <option value="ktp" <?php echo ($konsumen["id_type"] == "ktp") ? "selected" : "" ; ?>>SIM
                        </option>
                      </select>
                      <small class="text-danger"><?php echo form_error('val_id_type') ?></small>
                    </div>
                    <div class="form-group">
                      <label for="input_idcard">Id Card</label>
                      <input type="text" class="form-control" name="val_id_card" value="<?= $konsumen['id_card'] ?>"
                        placeholder="Masukan Id Card" required>
                      <small class="text-danger"><?= form_error("val_id_card") ?></small>
                    </div>
                    <div class="form-group">
                      <label for="input_nama">Nama Lengkap</label>
                      <input type="text" class="form-control" name="val_nama" value="<?= $konsumen['nama_lengkap'] ?>"
                        placeholder="Masukan Nama Lengkap">
                      <small class="text-danger"><?= form_error("val_nama") ?></small>
                    </div>
                    <div class="form-group">
                      <label for="input_email">Email</label>
                      <input type="text" class="form-control" name="val_email" value="<?= $konsumen['email'] ?>"
                        placeholder="Masukan Email">
                      <small class="text-danger"><?= form_error("val_email") ?></small>
                    </div>
                    <div class="form-group">
                      <label for="input_telepon">No Telepon</label>
                      <input type="text" class="form-control" name="val_telepon" value="<?= $konsumen['telp'] ?>"
                        placeholder="Masukan Nomer Telepon">
                      <small class="text-danger"><?= form_error("val_telepon") ?></small>
                    </div>
                    <div class="form-group">
                      <label for="input_alamat">Alamat</label>
                      <textarea type="text" class="form-control" name="val_alamat" rows="3"
                        placeholder="Masukan Alamat"><?= $konsumen['alamat'] ?></textarea>
                      <small class="text-danger"><?= form_error("val_alamat") ?></small>
                    </div>
                    <div class="form-group">
                      <label>NPWP</label>
                      <input type="text" class="form-control" name="val_npwp" value="<?= $konsumen['npwp'] ?>"
                        placeholder="Masukan NPWP">
                      <small class="text-danger"><?= form_error("val_npwp") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <input type="date" class="form-control" name="tgl_lahir" value="<?= $konsumen['tgl_lahir'] ?>">
                      <small class="text-danger"><?= form_error("tgl_lahir") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Status Pernikahan</label>
                      <select name="val_nikah" class="form-control">
                        <option value="">-- Pilih Pernikahan --</option>
                        <option value="m" <?= $konsumen['status_nikah'] == 'm' ? 'selected' : '' ?>>Menikah</option>
                        <option value="bm" <?= $konsumen['status_nikah'] == 'bm' ? 'selected' : '' ?>>Belum Menikah
                        </option>
                      </select>
                      <small class="text-danger"><?= form_error("val_nikah") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Pendidikan</label>
                      <select name="val_pendidikan" class="form-control">
                        <option value="">-- Pilih Pendidikan --</option>
                        <option value="sd" <?= $konsumen['pendidikan_terakhir'] == 'sd' ? 'selected' : '' ?>>SD
                        </option>
                        <option value="smp" <?= $konsumen['pendidikan_terakhir'] == 'smp' ? 'selected' : '' ?>>SMP
                        </option>
                        <option value="sma" <?= $konsumen['pendidikan_terakhir'] == 'sma' ? 'selected' : '' ?>>SMA
                        </option>
                        <option value="diploma" <?= $konsumen['pendidikan_terakhir'] == 'diploma' ? 'selected' : '' ?>>
                          Diploma</option>
                        <option value="s1" <?= $konsumen['pendidikan_terakhir'] == 's1' ? 'selected' : '' ?>>S1
                        </option>
                        <option value="s2/s3" <?= $konsumen['pendidikan_terakhir'] == 's2/s3' ? 'selected' : '' ?>>
                          S2/S3
                        </option>
                      </select>
                      <small class="text-danger"><?= form_error("val_pendidikan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Foto Konsumen</label>
                      <?php if ($konsumen['foto_ktp'] == '') { ?>
                      <br>
                      <small class="p-4" style="font-size: 15px;">Foto Kosong</small>
                      <br>
                      <img src="" id="img_konsumen" class="col-sm-6">
                      <?php } else { ?>
                      <img src="<?= base_url('assets/uploads/images/konsumen/'.$konsumen['foto_ktp']) ?>"
                        id="img_konsumen" class="col-sm-6">
                      <?php } ?>
                      <input type="file" name="upload_foto" class="form-control"
                        onchange="validateFileUpload(this),readURL(this,'#img_konsumen')">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input type="submit" class="btn btn-sm btn-primary float-right mx-3" name="fm_data_diri"
                        value="Submit">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="data_pasangan" role="tabpanel">
              <br>
              <h5>Data Pasangan Konsumen</h5>
              <hr>
              <form action="<?= base_url('konsumen/coreubah') ?>" method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                  value="<?= $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="konsumen" value="<?= $konsumen['id_konsumen'] ?>">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Nama Pasangan</label>
                      <input type="text" class="form-control" name="nama_pasangan"
                        value="<?= $konsumen['nama_pasangan'] ?>">
                      <small class="text-danger"><?= form_error("nama_pasangan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Hubungan dengan Pemohon</label>
                      <input type="text" class="form-control" name="hubungan_pasangan"
                        value="<?= $konsumen['hubungan_pasangan'] ?>">
                      <small class="text-danger"><?= form_error("hubungan_pasangan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Alamat Rumah</label>
                      <textarea class="form-control" name="alamat_pasangan"
                        rows="3"><?= $konsumen['alamat_pasangan'] ?></textarea>
                      <small class="text-danger"><?= form_error("alamat_pasangan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Telepon Pasangan</label>
                      <input type="text" class="form-control" name="telp_pasangan"
                        value="<?= $konsumen['telp_pasangan'] ?>">
                      <small class="text-danger"><?= form_error("telp_pasangan") ?></small>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input type="submit" class="btn btn-sm btn-primary float-right mx-3" name="fm_data_pasangan"
                        value="Submit">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="pekerjaan_pemohon" role="tabpanel">
              <br>
              <h4>Data Pekerjaan Pemohon</h4>
              <hr>
              <form action="<?= base_url('konsumen/coreubah') ?>" method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                  value="<?= $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="konsumen" value="<?= $konsumen['id_konsumen'] ?>">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Nama Perusahaan</label>
                      <input type="text" class="form-control" name="nama_perusahaan"
                        value="<?= $konsumen['nama_perusahaan'] ?>">
                      <small class="text-danger"><?= form_error("nama_perusahaan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Telp Perusahaan</label>
                      <input type="text" class="form-control" name="telp_perusahaan"
                        value="<?= $konsumen['telp_perusahaan'] ?>">
                      <small class="text-danger"><?= form_error("telp_perusahaan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Alamat Perusahaan</label>
                      <textarea class="form-control" name="alamat_perusahaan"
                        rows="3"><?= $konsumen['alamat_perusahaan'] ?></textarea>
                      <small class="text-danger"><?= form_error("alamat_perusahaan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Jenis Pekerjaan</label>
                      <select name="jenis_pekerjaan" class="form-control">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="bumn" <?= $konsumen['jenis_pekerjaan'] == 'bumn' ? 'selected' : '' ?>>BUMN
                        </option>
                        <option value="pns" <?= $konsumen['jenis_pekerjaan'] == 'pns' ? 'selected' : '' ?>>PNS
                        </option>
                        <option value="swasta" <?= $konsumen['jenis_pekerjaan'] == 'swasta' ? 'selected' : '' ?>>
                          SWASTA
                        </option>
                        <option value="tni" <?= $konsumen['jenis_pekerjaan'] == 'tni' ? 'selected' : '' ?>>TNI
                        </option>
                        <option value="wiraswasta"
                          <?= $konsumen['jenis_pekerjaan'] == 'wiraswasta' ? 'selected' : '' ?>>TNI</option>
                        <option value="lainnya" <?= $konsumen['jenis_pekerjaan'] == 'lainnya' ? 'selected' : '' ?>>
                          LAINNYA</option>
                      </select>
                      <small class="text-danger"><?= form_error("jenis_pekerjaan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Bidang Usaha</label>
                      <input type="text" class="form-control" name="bidang_usaha"
                        value="<?= $konsumen['bidang_usaha'] ?>" required>
                      <small class="text-danger"><?= form_error("bidang_usaha") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Jabatan</label>
                      <input type="text" class="form-control" name="jabatan" value="<?= $konsumen['jabatan'] ?>">
                      <small class="text-danger"><?= form_error("jabatan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Nama Atasan</label>
                      <input type="text" class="form-control" name="atasan" value="<?= $konsumen['nama_atasan'] ?>">
                      <small class="text-danger"><?= form_error("atasan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Telepon Atasan</label>
                      <input type="text" class="form-control" name="telp_atasan"
                        value="<?= $konsumen['telp_atasan'] ?>">
                      <small class="text-danger"><?= form_error("telp_atasan") ?></small>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input type="submit" class="btn btn-sm btn-primary float-right mx-3 next"
                        name="fm_pekerjaan_pemohon" value="Submit">
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="tab-pane fade" id="pekerjaan_pasangan" role="tabpanel">
              <br>
              <h4>Data Pekerjaan Pasangan</h4>
              <hr>
              <form action="<?= base_url('konsumen/coreubah') ?>" method="post">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                  value="<?= $this->security->get_csrf_hash(); ?>">
                <input type="hidden" name="konsumen" value="<?= $konsumen['id_konsumen'] ?>">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Nama Perusahaan</label>
                      <input type="text" class="form-control" name="nama_kantor_pasangan"
                        value="<?= $konsumen['kantor_pasangan'] ?>">
                      <small class="text-danger"><?= form_error("nama_kantor_pasangan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Telp Perusahaan</label>
                      <input type="text" class="form-control" name="telp_kantor_pasangan"
                        value="<?= $konsumen['telp_kantor_pasangan'] ?>">
                      <small class="text-danger"><?= form_error("telp_kantor_pasangan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Alamat Perusahaan</label>
                      <textarea class="form-control" name="alamat_kantor_pasangan"
                        rows="3"><?= $konsumen['alamat_kantor_pasangan'] ?></textarea>
                      <small class="text-danger"><?= form_error("alamat_kantor_pasangan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Jenis Pekerjaan</label>
                      <select name="jenis_pekerjaan2" class="form-control">
                        <option value="">-- Pilih Jenis --</option>
                        <option value="bumn" <?= $konsumen['pekerjaan_pasangan'] == 'bumn' ? 'selected' : '' ?>>BUMN
                        </option>
                        <option value="pns" <?= $konsumen['pekerjaan_pasangan'] == 'pns' ? 'selected' : '' ?>>PNS
                        </option>
                        <option value="swasta" <?= $konsumen['pekerjaan_pasangan'] == 'swasta' ? 'selected' : '' ?>>
                          SWASTA</option>
                        <option value="tni" <?= $konsumen['pekerjaan_pasangan'] == 'tni' ? 'selected' : '' ?>>TNI
                        </option>
                        <option value="wiraswasta"
                          <?= $konsumen['pekerjaan_pasangan'] == 'wiraswasta' ? 'selected' : '' ?>>WIRASWASTA</option>
                        <option value="lainnya" <?= $konsumen['pekerjaan_pasangan'] == 'lainnya' ? 'selected' : '' ?>>
                          LAINNYA</option>
                      </select>
                      <small class="text-danger"><?= form_error("jenis_pekerjaan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Bidang Usaha</label>
                      <input type="text" class="form-control" name="bidang_usaha_p"
                        value="<?= $konsumen['bidang_usaha_p'] ?>" required>
                      <small class="text-danger"><?= form_error("bidang_usaha_p") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Jabatan</label>
                      <input type="text" class="form-control" name="jabatan_pasangan"
                        value="<?= $konsumen['jabatan_pasangan'] ?>">
                      <small class="text-danger"><?= form_error("jabatan_pasangan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Nama Atasan</label>
                      <input type="text" class="form-control" name="atasan_pasangan"
                        value="<?= $konsumen['nama_atasan_p'] ?>">
                      <small class="text-danger"><?= form_error("atasan_pasangan") ?></small>
                    </div>
                    <div class="form-group">
                      <label>Telepon Atasan</label>
                      <input type="text" class="form-control" name="telp_atasan_p"
                        value="<?= $konsumen['telp_atasan_p'] ?>">
                      <small class="text-danger"><?= form_error("telp_atasan_p") ?></small>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <input type="submit" class="btn btn-sm btn-primary float-right mx-3 next"
                        name="fm_pekerjaan_pasangan" value="Submit">
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <small class="txt-semi-high font-weight-medium">Dokumen Konsumen</small>
            <a data-target="#segment2" data-toggle="collapse" class="text-primary float-right"><i
                class="fa fa-circle"></i></a>
          </div>
        </div>
        <hr>
        <div id="segment2" class="collapse">
          <div class="row">
            <div class="col-sm-12">
              <button class="btn btn-sm btn-inverse-primary float-right" data-target="#modal_doc" data-toggle="modal"><i
                  class="fa fa-plus"></i> Tambah</button>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-condensed table-striped" id="tbl_to_tables">
                <thead>
                  <th>No</th>
                  <th>Nama Kelompok</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = 1; foreach ($doc_konsumen as $key => $value) { ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $value['nama_kelompok'] ?></td>
                    <td class="text-center">
                      <?php $path = './assets/uploads/files/konsumen/'.$value['file'] ;echo file_exists($path) && !is_dir($path) ? '<i style="font-size: 13px;">sudah upload</i>' : '<i style="font-size: 13px;">belum upload</i>'; ?>
                    </td>
                    <td class="text-center">
                      <?php if (file_exists($path) && !is_dir($path)) { ?>
                      <a href="<?= base_url('konsumen/printdoc/'.$value['id_persyaratan']) ?>"
                        class="btn btn-icons btn-inverse-warning" target="blank"><i class="fa fa-print"></i></a>
                      <button class="btn btn-icons btn-inverse-danger"
                        onclick="deleteItem('<?= base_url('konsumen/hapusfile/'.$value['id_persyaratan'].'/'.$konsumen['id_konsumen']) ?>')"><i
                          class="fa fa-remove"></i></button>
                      <?php } else { ?>
                      <button class="btn btn-icons btn-inverse-primary" id="upload_file"
                        data-id="<?= $value['id_persyaratan'] ?>"><i class="fa fa-file-archive-o"></i></button>
                      <button class="btn btn-icons btn-inverse-danger"
                        onclick="deleteItem('<?= base_url('konsumen/hapussyarat/'.$value['id_persyaratan'].'/'.$konsumen['id_konsumen']) ?>')"><i
                          class="fa fa-trash"></i></button>
                      <?php } ?>
                    </td>
                  </tr>
                  <?php $no++; } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>

    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <small class="txt-semi-high font-weight-medium">Data Transaksi</small>
            <a href="" class="text-primary float-right" data-target="#data_transaksi" data-toggle="collapse"><i
                class="fa fa-circle"></i></a>
          </div>
        </div>
        <hr>
        <div id="data_transaksi" class="collapse border-left-color">
          <div class="row">
            <div class="col-sm-12">
              <small class="txt-normal">No SPR</small>
              <small class="txt-normal-b">: <?= $trans['no_spr'] ?></small>
            </div>
            <div class="col-sm-12">
              <small class="txt-normal">Properti</small>
              <small class="txt-normal-b">: <?= $trans['nama_properti'] ?></small>
            </div>
            <div class="col-sm-12">
              <small class="txt-normal">Nama Unit</small>
              <small class="txt-normal-b">: <?= $trans['nama_unit'] ?></small>
            </div>
            <div class="col-sm-12">
              <small class="txt-normal">Tgl Transaksi</small>
              <small class="txt-normal-b">:
                <?php $d = DateTime::createFromFormat("Y-m-d",$trans['tgl_transaksi']); echo tanggal($d->format('d'),$d->format('m'),$d->format('Y')) ?></small>
            </div>
            <div class="col-sm-12">
              <small class="txt-normal">Kesepakatan</small>
              <small class="txt-normal-b">: <?= number_format($trans['total_kesepakatan'],2,',','.'); ?></small>
            </div>
            <div class="col-sm-12">
              <small class="txt-normal">Tambahan</small>
              <small class="txt-normal-b">: <?= number_format($trans['total_tambahan'],2,',','.'); ?></small>
            </div>
            <div class="col-sm-12">
              <small class="txt-normal">Tanda Jadi</small>
              <small class="txt-normal-b">:
                <?= number_format($trans['total_tanda_jadi'],2,',','.'); ?></small>
            </div>
            <div class="col-sm-12">
              <small class="txt-normal">Uang Muka</small>
              <small class="txt-normal-b">:
                <?= number_format($trans['total_uang_muka'],2,',','.').' / '.$trans['periode_uang_muka']; ?></small>
            </div>
            <div class="col-sm-12">
              <small class="txt-normal">Cicilan</small>
              <small class="txt-normal-b">:
                <?= number_format($trans['total_cicilan'],2,',','.').' / '.$trans['periode_cicilan']; ?></small>
            </div>
            <div class="col-sm-12">
              <small class="txt-normal">Type Bayar</small>
              <small class="txt-normal-b">: <?= strtoupper($trans['type_bayar']); ?></small>
            </div>
            <div class="col-sm-12">
              <small class="txt-normal">Pembuat</small>
              <small class="txt-normal-b">: <?= ucfirst($trans['pembuat']); ?></small>
            </div>
            <?php $status = $trans['status_transaksi'] == 'p' ? 'Progress' : ($trans['status_transaksi'] == 'sl' ? 'Selesai' : '-'); ?>
            <div class="col-sm-12">
              <small class="txt-normal">Status</small>
              <small class="txt-normal-b">: &nbsp;<span class="badge badge-primary"><?= $status ?></span></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_doc">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('konsumen/coretambahsyarat') ?>" method="post" enctype="multipart/form-data"
          id="modal_user">
          <input type="hidden" name="input_hidden" value="<?= $konsumen['id_konsumen'] ?>">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>"
            value="<?= $this->security->get_csrf_hash(); ?>">
          <div class="row">
            <div class="col-sm-12" id="form_change">
              <div class="form-group">
                <label>Pilih Kelompok</label>
                <select name="kelompok" class="select-opt">
                  <option value=""> -- Pilih Options -- </option>
                  <?php foreach ($kelompok as $key => $value) {
                    $where = get_where('persyaratan_konsumen',['id_konsumen'=>$konsumen['id_konsumen'],'kelompok_persyaratan'=>$value['id_sasaran']]);
                    if ($where->num_rows() < 1) {
                      echo '<option value="'.$value['id_sasaran'].'">'.$value['nama_kelompok'].'</option>';
                    } } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Upload File</label>
                <input type="file" name="file_img" class="form-control">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>