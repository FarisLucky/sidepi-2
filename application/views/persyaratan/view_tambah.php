<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="dark txt_title d-inline-block mt-2">Tambah Persyaratan Sasaran</h4>
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
            <form action="<?php echo base_url("persyaratan/coretambah"); ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="exampleInputName1">Nama Persyaratan</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Persyaratan">
                    <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Type</label>
                    <select name="type" class="form form-control">
                      <option value="">-- Pilih Type --</option>
                      <option value="konsumen">Konsumen</option>
                      <option value="unit">Unit</option>
                    </select>
                    <small class="form-text text-danger"><?= form_error('type'); ?></small>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="exampleInputName1">Keterangan</label>
                    <input type="text" name="ket" class="form-control" placeholder="Keterangan">
                    <small class="form-text text-danger"><?= form_error('ket'); ?></small>
                  </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>Simpan</button>
                  <button type="reset" class="btn btn-sm btn-secondary"><i class="fa fa-refresh"></i>Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>