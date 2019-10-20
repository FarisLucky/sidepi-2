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
            <h5 class="d-inline-block">Edit Follow Calon Konsumen</h5>
            <a href="<?= base_url('followcalon') ?>" class="btn btn-sm btn-dark float-right"><i
                class="fa fa-arrow-circle-left"></i>
              Kembali</a>
          </div>
        </div>
        <hr>
        <form method="post" action="<?= base_url() ?>followcalon/corePerbarui">
          <div class="form-group">
            <input type="hidden" name="input_hidden" value="<?= $follow_calon_konsumen['id_follow']; ?>">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
              value="<?= $this->security->get_csrf_hash(); ?>">
            <!-- itu hidden buat nnt ngirim id nya jd di view nya ga keliatan-->
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="form-label-group">
                    <label>Pilih Nama Calon Konsumen</label>
                    <select name="edit_nama_konsumen" value="<?= $follow_calon_konsumen['id_konsumen']; ?>"
                      class="form-control select-opt">
                      <?php foreach ($konsumen as  $value) { ?>
                      <option value="<?= $value['id_konsumen'] ?>"
                        <?= $value['id_konsumen'] == $follow_calon_konsumen['id_konsumen'] ? 'selected' : '' ?>>
                        <?= $value['nama_lengkap'] ?></option>
                      <?php } ?>
                    </select>
                    <div class="invalid-feedback">
                      <?php echo form_error('edit_nama_konsumen') ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="form-label-group">
                    <label for="input_media">Media</label>
                    <select name="edit_media" id="input_media" value=""
                      class="form-control <?= form_error('edit_media') ? 'is-invalid' : '' ?>">
                      <?php foreach ($media as $m) : ?>
                      <?php if ($m == $follow_calon_konsumen['media']) : ?>
                      <option value="<?= $m ?>" selected><?= $m ?></option>
                      <?php else : ?>
                      <option value="<?= $m ?>"><?= $m ?></option>
                      <?php endif ?>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                      <?php echo form_error('edit_media') ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="form-label-group">
                    <label for="input_keterangan">Keterangan</label>
                    <textarea name="edit_keterangan" class="form-control" cols="30"
                      rows="3"><?= $follow_calon_konsumen['keterangan']; ?></textarea>
                    <small class="text-danger"><?php echo form_error('edit_keterangan') ?></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-group">
                  <div class="form-label-group">
                    <label for="input_hasil">Hasil</label>
                    <select name='edit_hasil' class="form-control">
                      <option value="bs" <?= $follow_calon_konsumen['hasil_follow'] == 'bs' ? 'selected' : '' ?>>Belum
                        Selesai</option>
                      <option value="s" <?= $follow_calon_konsumen['hasil_follow'] == 's' ? 'selected' : '' ?>>Selesai
                      </option>
                    </select>
                    <small class="text-danger"><?php echo form_error('edit_hasil') ?></small>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <button type="submit" id="btn_simpan_properti" class="btn btn-success mr-2"><i
                    class="fa fa-save"></i>Simpan</button>
                <button type="reset" id="btn_simpan_properti" class="btn btn-secondary mr-2"><i
                    class="fa fa-refresh"></i>Reset</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>