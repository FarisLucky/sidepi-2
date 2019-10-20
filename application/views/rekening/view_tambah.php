<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Tambah Rekening</h4>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block">Form Data</h5>
            <a href="<?= base_url('rekening') ?>" class="btn btn-sm btn-dark float-right"><i
                class="fa fa-arrow-circle-left"></i>
              Kembali</a>
          </div>
        </div>
        <hr>
        <form action="<?php echo base_url("rekening/coretambah"); ?>" method="post">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
            value="<?= $this->security->get_csrf_hash(); ?>">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>No Rekening</label>
                <input type="text" name="no_rek" class="form-control" placeholder="No Rekening">
                <small class="form-text text-danger"><?= form_error('no_rek'); ?></small>
              </div>
              <div class="form-group">
                <label>Bank</label>
                <input type="text" name="bank" class="form-control" placeholder="Bank">
                <small class="form-text text-danger"><?= form_error('bank'); ?></small>
              </div>
              <div class="form-group">
                <label>Nama Pemilik</label>
                <input type="text" name="pemilik" class="form-control" placeholder="Nama Pemilik">
                <small class="form-text text-danger"><?= form_error('pemilik'); ?></small>
              </div>
              <div class="form-group">
                <div class="form-check form-check-flat">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="lock" value="l">data akan
                    otomatis aktif</label>
                </div>
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