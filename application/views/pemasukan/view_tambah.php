<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Tambah Pemasukan</h4>
            <img id="logo_perusahaan" width="50px"
              src="<?= base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right"
              alt="">
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <a href="<?= base_url('pemasukan') ?>" class="btn btn-sm btn-dark float-right"><i
                class="fa fa-arrow-circle-left"></i> Kembali</a>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <form action="<?=base_url('pemasukan/coretambah') ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">
              <div class="form-group">
                <label for="exampleInputName1">Pemasukan</label>
                <input type="text" name="nama_pemasukan" class="form-control"
                  value="<?= set_value("nama_pemasukan") ?>">
                <small class="text-small text-danger"><?= form_error("nama_pemasukan") ?></small>
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
                <input type="number" name="harga_satuan" class="form-control" value="<?= set_value("harga_satuan") ?>">
                <small class="text-small text-danger"><?= form_error("harga_satuan") ?></small>
              </div>
              <div class="form-group">
                <label for="txt_file">Pilih Unit</label>
                <select name="unit" class="form-control select-opt">
                  <option value="">-- Pilih Unit --</option>
                  <?php foreach ($unit as $key => $value) { ?>
                  <option value="<?= $value->id_unit ?>"><?= $value->nama_unit ?></option>
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
                <label for="txt_file">Bukti </label>
                <input type="file" name="bukti_kwitansi" class="form-control">
              </div>
              <button type="submit" class="btn btn-sm btn-success mx-2"><i class="fa fa-save"></i> Simpan</button>
              <button type="reset" class="btn btn-sm btn-secondary"><i class="fa fa-refresh"></i> Reset</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>