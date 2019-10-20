<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="dark txt_title d-inline-block mt-2">Tambah Data Pengeluaran</h4>
                <img id="logo_perusahaan" width="50px"
                  src="<?= base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right"
                  alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-sm-12">
                <a href="<?= base_url('pengeluaran') ?>" class="btn btn-sm btn-dark float-right"><i
                    class="fa fa-arrow-circle-left"></i> Kembali</a>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <form action="<?=base_url('pengeluaran/coretambah') ?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">
                  <div class="form-group">
                    <label for="exampleInputName1">Pengeluaran</label>
                    <input type="text" name="nama_pengeluaran" class="form-control"
                      value="<?= set_value("nama_pengeluaran") ?>">
                    <small class="text-small text-danger"><?= form_error("nama_pengeluaran") ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Volume</label>
                    <input type="number" name="volume" class="form-control" value="<?= set_value("volume") ?>">
                    <small class="text-small text-danger"><?= form_error("volume") ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Satuan</label>
                    <input type="text" name="satuan" class="form-control" value="<?= set_value("satuan") ?>">
                    <small class="text-small text-danger"><?= form_error("satuan") ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Harga Satuan</label>
                    <input type="number" name="harga_satuan" class="form-control"
                      value="<?= set_value("harga_satuan") ?>">
                    <small class="text-small text-danger"><?= form_error("harga_satuan") ?></small>
                  </div>
                  <div class="form-group">
                    <label for="txt_file">Pilih Unit</label>
                    <select name="unit" class="form-control select-opt">
                      <option value="">-- Pilih Unit --</option>
                      <?php foreach ($unit as $u) { ?>
                      <option value="<?= $u->id_unit ?>"><?= $u->nama_unit ?></option>
                      <?php } ?>
                    </select>
                    <small class="text-small text-danger"><?= form_error("unit") ?></small>
                  </div>
                  <div class="form-group">
                    <label for="txt_file">Pilih Kelompok</label>
                    <select name="kelompok" class="form-control select-opt">
                      <option value="">-- Pilih Kelompok --</option>
                      <?php foreach ($kelompok as $key => $value) { ?>
                      <option value="<?= $value->id_kelompok ?>"><?= $value->nama_kelompok ?></option>
                      <?php } ?>
                    </select>
                    <small class="text-small text-danger"><?= form_error("kelompok") ?></small>
                  </div>
                  <div class="form-group">
                    <label for="txt_file">Bukti </label><br>
                    <img class="img-thumbnail" id="preview">
                    <input type="file" name="bukti_kwitansi" class="form-control"
                      onchange="validateFileUpload(this);readURL(this,'#preview')">
                  </div>
                  <div class="form-group">
                    <div class="form-check form-check-flat">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="lock" value="l">pengeluaran akan dilock
                        otomatis</label>
                    </div>
                  </div>
                  <br>
                  <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-success mr-2"><i class="fa fa-save"></i> Simpan</button>
                    <button type="reset" class="btn btn-sm btn-secondary"><i class="fa fa-refresh"></i> Reset</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>