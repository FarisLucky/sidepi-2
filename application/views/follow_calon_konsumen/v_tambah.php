<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Follow Calon Konsumen</h4>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block">Tambah</h5>
            <a href="<?= base_url('followcalon') ?>" class="btn btn-dark float-right"><i
                class="fa fa-arrow-circle-left"></i> Kembali</a>
          </div>
        </div>
        <hr>
        <form action="<?php echo base_url() . 'followcalon/coretambah'; ?>" method="post">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
            value="<?= $this->security->get_csrf_hash(); ?>">
          <div class="row">
            <div class="col-sm-12">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Pilih Nama Calon Konsumen</label>
                    <select name="val_nama_konsumen" class="form-control select-opt">
                      <option value="">-- Pilih --</option>
                      <?php foreach ($calon as  $value) { ?>
                      <option value="<?= $value['id_konsumen'] ?>"><?= $value['nama_lengkap'] ?></option>
                      <?php } ?>
                    </select>
                    <small class="text-danger"><?= form_error('val_nama_konsumen') ?></small>
                  </div>
                  <div class="form-group">
                    <label for="input_media">Media</label>
                    <select name="val_media" id="input_media"
                      class="form-control <?= form_error('val_media') ? 'is-invalid' : '' ?>">
                      <option value="">-- Pilih Media --</option>
                      <option value="Whatsapp" <?= set_value('val_media') == 'Whatsapp' ? 'selected' : '' ?>>
                        Whatsapp</option>
                      <option value="Facebook" <?= set_value('val_media') == 'Facebook' ? 'selected' : '' ?>>
                        Facebook</option>
                      <option value="Instagram" <?= set_value('val_media') == 'Instagram' ? 'selected' : '' ?>>
                        Instagram</option>
                    </select>
                    <div class="invalid-feedback">
                      <?php echo form_error('val_media') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="input_keterangan">Keterangan</label>
                    <textarea type="text" id="input_keterangan" name="val_keterangan"
                      value="<?= set_value('val_keterangan') ?>" placeholder="Masukan Keterangan"
                      class="form-control <?= form_error('val_keterangan') ? 'is-invalid' : '' ?> " rows="5"></textarea>
                    <div class="invalid-feedback">
                      <?php echo form_error('val_keterangan') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="input_hasil">Hasil</label>
                    <select name='val_hasil' id="input_hasil"
                      class="form-control <?= form_error('val_hasil') ? 'is-invalid' : '' ?>">
                      <option value="">-- Pilih Hasil --</option>
                      <option value="bs" <?= set_value('val_hasil') == 'bs' ? 'selected' : '' ?>>Belum</option>
                      <option value="s" <?= set_value('val_hasil') == 's' ? 'selected' : '' ?>>Selesai</option>
                    </select>
                    <div class="invalid-feedback">
                      <?php echo form_error('val_hasil') ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <button type="submit" id="btn_simpan_follow" class="btn btn-success mr-2"><i class="fa fa-save"></i>
                Simpan</button>
              <button type="reset" class="btn btn-ssecondary mr-2"><i class="fa fa-refresh"></i> Reset</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>