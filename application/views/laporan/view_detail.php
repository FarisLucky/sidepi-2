<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Data Konsumen</h4>
            <a href="<?= base_url("laporankonsumen") ?>" class="btn btn-sm btn-dark float-right"><i
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
            <small class="txt-semi-high font-weight-medium">Data Diri</small>
            <a href="#" data-target="#tabs" data-toggle="collapse" class="text-primary float-right"><i
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
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Pilih Type ID Card</label>
                    <input type="text" class="form-control" value="<?= $konsumen['id_type'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="input_idcard">Id Card</label>
                    <input type="text" class="form-control" name="val_id_card" value="<?= $konsumen['id_card'] ?>"
                      readonly>
                  </div>
                  <div class="form-group">
                    <label for="input_nama">Nama Lengkap</label>
                    <input type="text" class="form-control" name="val_nama" value="<?= $konsumen['nama_lengkap'] ?>"
                      readonly>
                  </div>
                  <div class="form-group">
                    <label for="input_email">Email</label>
                    <input type="text" class="form-control" name="val_email" value="<?= $konsumen['email'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="input_telepon">No Telepon</label>
                    <input type="text" class="form-control" name="val_telepon" value="<?= $konsumen['telp'] ?>"
                      readonly>
                  </div>
                  <div class="form-group">
                    <label for="input_alamat">Alamat</label>
                    <textarea type="text" class="form-control" name="val_alamat" rows="3"
                      readonly><?= $konsumen['alamat'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>NPWP</label>
                    <input type="text" class="form-control" name="val_npwp" value="<?= $konsumen['npwp'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="text" class="form-control" name="tgl_lahir" value="<?= $konsumen['tgl_lahir'] ?>"
                      readonly>
                  </div>
                  <div class="form-group">
                    <label>Status Pernikahan</label>
                    <input type="text" class="form-control"
                      value="<?= $konsumen['status_nikah'] == 'm' ? 'menikah' : 'belum menikah' ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Pendidikan</label>
                    <input type="text" class="form-control" value="<?= $konsumen['pendidikan_terakhir'] ?>" readonly>
                    </select>
                  </div>
                </div>
                <div class="col-sm-5">
                  <small class="d-block">Foto</small>
                  <?php if(file_exists('./assets/uploads/images/konsumen/'.$konsumen['foto_ktp'])) { ?>
                  <a href="<?= base_url('assets/uploads/images/konsumen/'.$konsumen['foto_ktp']) ?>"
                    data-lightbox="datas"><img
                      src="<?= base_url('assets/uploads/images/konsumen/'.$konsumen['foto_ktp']) ?>"
                      class="img-thumbnail"></a>
                  <?php } else { ?>
                  <i style="font-size: 18px">Foto Kosong</i>
                  <?php }  ?>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="data_pasangan" role="tabpanel">
              <br>
              <h5>Data Pasangan Konsumen</h5>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Nama Pasangan</label>
                    <input type="text" class="form-control" name="nama_pasangan"
                      value="<?= $konsumen['nama_pasangan'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Hubungan dengan Pemohon</label>
                    <input type="text" class="form-control" name="hubungan_pasangan"
                      value="<?= $konsumen['hubungan_pasangan'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Alamat Rumah</label>
                    <textarea class="form-control" name="alamat_pasangan" rows="3"
                      readonly><?= $konsumen['alamat_pasangan'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Telepon Pasangan</label>
                    <input type="text" class="form-control" name="telp_pasangan"
                      value="<?= $konsumen['telp_pasangan'] ?>" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pekerjaan_pemohon" role="tabpanel">
              <br>
              <h4>Data Pekerjaan Pemohon</h4>
              <hr>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input type="text" class="form-control" name="nama_perusahaan"
                      value="<?= $konsumen['nama_perusahaan'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Telp Perusahaan</label>
                    <input type="text" class="form-control" name="telp_perusahaan"
                      value="<?= $konsumen['telp_perusahaan'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Alamat Perusahaan</label>
                    <textarea class="form-control" name="alamat_perusahaan" rows="3"
                      readonly><?= $konsumen['alamat_perusahaan'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Jenis Pekerjaan</label>
                    <input type="text" class="form-control" value=<?= $konsumen['jenis_pekerjaan'] ?> readonly>
                  </div>
                  <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="jabatan" value="<?= $konsumen['jabatan'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Atasan</label>
                    <input type="text" class="form-control" name="atasan" value="<?= $konsumen['nama_atasan'] ?>"
                      readonly>
                  </div>
                  <div class="form-group">
                    <label>Telepon Atasan</label>
                    <input type="text" class="form-control" name="telp_atasan" value="<?= $konsumen['telp_atasan'] ?>"
                      readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pekerjaan_pasangan" role="tabpanel">
              <br>
              <h4>Data Pekerjaan Pasangan</h4>
              <hr>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <input type="text" class="form-control" name="nama_kantor_pasangan"
                      value="<?= $konsumen['kantor_pasangan'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Telp Perusahaan</label>
                    <input type="text" class="form-control" name="telp_kantor_pasangan"
                      value="<?= $konsumen['telp_kantor_pasangan'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Alamat Perusahaan</label>
                    <textarea class="form-control" name="alamat_kantor_pasangan" rows="3"
                      readonly><?= $konsumen['alamat_kantor_pasangan'] ?></textarea>
                  </div>
                  <div class="form-group">
                    <label>Jenis Pekerjaan</label>
                    <input type="text" class="form-control" value="<?= $konsumen['pekerjaan_pasangan'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Jabatan</label>
                    <input type="text" class="form-control" name="jabatan_pasangan"
                      value="<?= $konsumen['jabatan_pasangan'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Atasan</label>
                    <input type="text" class="form-control" name="atasan_pasangan"
                      value="<?= $konsumen['nama_atasan_p'] ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Telepon Atasan</label>
                    <input type="text" class="form-control" name="telp_atasan_p"
                      value="<?= $konsumen['telp_atasan_p'] ?>" readonly>
                  </div>
                </div>
              </div>
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
              <table class="table table-condensed table-striped" width="100%" id="tbl_to_tables">
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
                      <a href="<?= base_url('laporankonsumen/printdoc/'.$value['id_persyaratan']) ?>"
                        class="btn btn-icons btn-inverse-warning"><i class="fa fa-print"></i></a>
                      <?php } else { ?>
                      <i>No Action</i>
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