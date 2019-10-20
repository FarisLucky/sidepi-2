<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="dark txt_title d-inline-block mt-2">Ubah Data Konsumen</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <a href="<?= base_url("calonkonsumen") ?>" class="btn btn-sm btn-dark float-right"><i
                    class="fa fa-arrow-circle-left"></i> Kembali</a>
              </div>
            </div>
            <form method="post" action="<?= base_url('calonkonsumen/coreubah') ?>">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="val_id_konsumen" value="<?= $konsumen['id_konsumen'] ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="form-label-group">
                      <label>Type ID</label>
                      <select name="val_id_type" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="sim" <?php echo ($konsumen["id_type"] == "sim") ? "selected" : "" ; ?>>KTP
                        </option>
                        <option value="ktp" <?php echo ($konsumen["id_type"] == "ktp") ? "selected" : "" ; ?>>SIM
                        </option>
                      </select>
                      <small class="text-danger"><?php echo form_error('val_id_type') ?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="input_idcard">Id Card</label>
                      <input type="text" class="form-control" id="input_idcard" name="val_id_card"
                        value="<?= $konsumen['id_card'] ?>" placeholder="Masukan Id Card" required>
                      <small class="text-danger"><?= form_error("val_id_card") ?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="input_nama">Nama Lengkap</label>
                      <input type="text" class="form-control" id="input_nama" name="val_nama_konsumen"
                        value="<?= $konsumen['nama_lengkap'] ?>" placeholder="Masukan Nama Lengkap" required>
                      <small class="text-danger"><?= form_error("val_nama_konsumen") ?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="input_email">Email</label>
                      <input type="text" class="form-control" id="input_email" name="val_email"
                        value="<?= $konsumen['email'] ?>" placeholder="Masukan Email">
                      <small class="text-danger"><?= form_error("val_email") ?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="input_telepon">No Telepon</label>
                      <input type="text" class="form-control" id="input_telepon" name="val_nomor_telepon"
                        value="<?= $konsumen['telp'] ?>" placeholder="Masukan Nomer Telepon" required>
                      <small class="text-danger"><?= form_error("val_telepon") ?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="input_alamat">Alamat</label>
                      <textarea type="text" class="form-control" id="input_alamat" name="val_alamat" rows="3"
                        placeholder="Masukan Alamat" required><?= $konsumen['alamat'] ?></textarea>
                      <small class="text-danger"><?= form_error("val_alamat") ?></small>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-sm btn-success mr-2"><i class="fa fa-save"></i>Submit</button>
                  <button type="reset" class="btn btn-sm btn-secondary"><i class="fa fa-refresh"></i>Reset</button>
                </div>
              </div>
            </form>
            <div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>