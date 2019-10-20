<?php if ($unit->status_unit == 'bt') {
  $status = "Belum Terjual";
} elseif ($unit->status_unit == 'b') {
  $status = "Booking";
} else {
  $status = "Terjual";
} ?>
<div class="content-wrapper" id="detail_unit">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Detail Unit</h4>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block mr-4">Detail Unit Properti</h5>
            <small class="badge badge-info"><?= $status ?></small>
            <a href="<?= base_url() ?>laporanunit" class="btn btn-dark float-right"><i class="fa fa-arrow-circle-left"></i>Kembali</a>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <input type="hidden" name="txt_id" class="form-control" id="txt_id" value="<?= $unit->id_unit ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="txt_nama">Nama Unit</label>
                  <input type="text" name="txt_nama" class="form-control" id="txt_nama" value="<?= $unit->nama_unit ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="txt_type">Type</label>
                  <input type="text" name="txt_type" class="form-control" id="txt_type" value="<?= $unit->type ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="txt_tanah">Luas Tanah</label>
                  <input type="text" name="txt_tanah" class="form-control" id="txt_tanah" value="<?= $unit->luas_tanah . " " . $unit->satuan_tanah; ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="txt_bangunan">Luas Bangunan</label>
                  <input type="text" name="txt_bangunan" class="form-control" id="txt_bangunan" value="<?= $unit->luas_bangunan . " " . $unit->satuan_bangunan; ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="txt_harga">Harga</label>
                  <input type="text" name="txt_harga" class="form-control" id="txt_harga" value="<?= $unit->harga_unit ?>" disabled>
                </div>
                <div class="form-group">
                  <label for="txt_alamat">Alamat</label>
                  <textarea class="form-control" name="txt_alamat" id="txt_alamat" rows="5" disabled><?= $unit->alamat_unit ?></textarea>
                </div>
                <div class="form-group">
                  <label for="txt_desc">Deskripsi</label>
                  <textarea class="form-control" name="txt_desc" id="txt_desc" rows="5" disabled><?= $unit->deskripsi ?></textarea>
                </div>
                <div class="form-group">
                  <label for="txt_foto" class="d-flex">Foto Properti</label>
                  <img src="<?= base_url() ?>assets/uploads/images/unit_properti/<?= $unit->foto_unit ?>" alt="" id="foto_unit" class="img-thumbnail" width="200px">
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <h5>Data Booking atau Jual</h5>
              </div>
              <div class="col-sm-6">
                <?php if ($unit->status_unit == 'bt') { ?>
                  <h4 class="text-center text-center m-3">Unit belum Terjual</h4>
                <?php } else { ?>
                  <div class="alert alert-secondary" id="info">
                    <div class="row">
                      <div class="col-sm-6">
                        <small class="txt-semi-high">Nama Pembeli :</small>
                      </div>
                      <div class="col-sm-6">
                        <small class="txt-semi-high font-weight-medium"><?= ucfirst($booking['nama_lengkap']) ?></small><br>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <small class="txt-semi-high">Tanggal Transaksi :</small>
                      </div>
                      <div class="col-sm-6">
                        <small class="txt-semi-high font-weight-medium"><?= ucfirst($booking['tgl_transaksi']) ?></small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <small class="txt-semi-high">Kesepakatan :</small>
                      </div>
                      <div class="col-sm-6">
                        <small class="txt-semi-high font-weight-medium"><?= number_format($booking['total_kesepakatan'], 2, ',', '.') ?></small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <small class="txt-semi-high">Tanda Jadi :</small>
                      </div>
                      <div class="col-sm-6">
                        <small class="txt-semi-high font-weight-medium"><?= number_format($booking['total_tanda_jadi'], 2, ',', '.') ?></small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <small class="txt-semi-high">Uang Muka :</small>
                      </div>
                      <div class="col-sm-6">
                        <small class="txt-semi-high font-weight-medium"><?= number_format($booking['total_uang_muka'], 2, ',', '.') ?></small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <small class="txt-semi-high">Cicilan :</small>
                      </div>
                      <div class="col-sm-6">
                        <small class="txt-semi-high font-weight-medium"><?= number_format($booking['total_cicilan'], 2, ',', '.') ?></small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <small class="txt-semi-high">Type Bayar :</small>
                      </div>
                      <div class="col-sm-6">
                        <small class="txt-semi-high font-weight-medium"><?= ucfirst($booking['type_bayar']) ?></small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <small class="txt-semi-high">Dibuat oleh :</small>
                      </div>
                      <div class="col-sm-6">
                        <small class="txt-semi-high font-weight-medium"><?= ucfirst($booking['pembuat']) ?></small>
                      </div>
                    </div>
                  </div>
                <?php } ?>
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
            <small class="txt-semi-high font-weight-medium">Dokumen Unit</small>
            <a data-target="#segment2" data-toggle="collapse" class="text-primary float-right"><i class="fa fa-circle"></i></a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <button class="btn btn-sm btn-inverse-primary float-right" data-target="#modal_doc" data-toggle="modal"><i class="fa fa-plus"></i> Tambah</button>
          </div>
        </div>
        <hr>
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <div class="filter">
              <small class="text-danger ml-2">cari nama kelompok</small>
            </div>
            <form action="<?= base_url('laporanunit/detail/' . $unit->id_unit . '/') ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
              <div class="form-row m-0">
                <div class="col-7">
                  <input type="text" name="search" class="form-control form-control-sm">
                </div>
                <div class="col-auto">
                  <button name="submit" class="btn btn-sm btn-inverse-success"><span class="fa fa-search"></span></button>
                </div>
                <div class="col-auto">
                  <button name="reset" class="btn btn-sm btn-inverse-secondary"><span class="fa fa-refresh"></span></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row collapse show mt-3" id="segment2">
          <div class="col-sm-12">
            <table class="table table-hover table-striped">
              <thead class="table-primary">
                <th>No</th>
                <th>Nama Kelompok</th>
                <th>Status</th>
                <th>Aksi</th>
              </thead>
              <tbody>
                <?php $no = 1;
                if (empty($doc_unit)) {
                  echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                }
                foreach ($doc_unit as $key => $value) { ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $value['nama_kelompok'] ?></td>
                    <td class="text-center">
                      <?php $path = './assets/uploads/files/unit/' . $value['file'];
                        echo file_exists($path) && !is_dir($path) ? '<i style="font-size: 13px;">sudah upload</i>' : '<i style="font-size: 13px;">belum upload</i>'; ?>
                    </td>
                    <td class="text-center">
                      <?php if (file_exists($path) && !is_dir($path)) { ?>
                        <a href="<?= base_url('laporanunit/printdoc/' . $value['id_persyaratan']) ?>" class="btn btn-icons btn-inverse-warning" target="blank"><i class="fa fa-print"></i></a>
                      <?php } else { ?>
                        <i class="txt-normal">Belum Upload</i>
                      <?php } ?>
                    </td>
                  </tr>
                <?php $no++;
                } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="row justify-content-center">
          <nav class="mt-3">
            <?php echo $this->pagination->create_links(); ?>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>