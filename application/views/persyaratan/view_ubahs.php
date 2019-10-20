<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="dark txt_title d-inline-block mt-2">Ubah Data Persyaratan</h4>
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
                <a href="<?= base_url('persyaratan') ?>" class="btn btn-dark float-right"><i
                    class="fa fa-arrow-circle-left"></i>
                  Kembali</a>
              </div>
            </div>
            <form action="<?php echo base_url("persyaratan/coreubah"); ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="input_hidden" value="<?= $persyaratan->id_sasaran ?>">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="exampleInputName1">Nama Persyaratan</label>
                    <input type="text" name="nama" class="form-control" value="<?= $persyaratan->nama_kelompok ?>">
                    <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Kategori</label>
                    <select name="type" class="form-control">
                      <option value="">-- Pilih Type --</option>
                      <option value="konsumen"
                        <?= $persyaratan->kategori_persyaratan == 'konsumen' ? 'selected' : '' ?>>Konsumen </option>
                      <option value="unit" <?= $persyaratan->kategori_persyaratan == 'unit' ? 'selected' : '' ?>>
                        Unit</option>
                    </select>
                    <small class="form-text text-danger"><?= form_error('poin'); ?></small>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="exampleInputName1">Keterangan</label>
                    <input type="text" name="ket" class="form-control" value="<?= $persyaratan->keterangan ?>">
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