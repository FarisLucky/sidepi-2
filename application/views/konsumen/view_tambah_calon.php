<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="dark txt_title d-inline-block mt-2">Tambah Calon Konsumen</h4>
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
            <hr>
            <form action="<?php echo base_url("calonkonsumen/coretambah") ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="form-label-group">
                      <label>Pilih Type ID Card</label>
                      <select name="val_id_type" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="sim" <?= (set_value("val_id_type") == "sim" ) ? "selected" : "" ; ?>>SIM</option>
                        <option value="ktp" <?= (set_value("val_id_type") == "ktp" ) ? "selected" : "" ; ?>>KTP</option>
                      </select>
                      <small class="text-danger"><?php echo form_error('val_id_type') ?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="inpt_id_card">Id Card</label>
                      <input type="text" name="val_id_card" value="<?= set_value('val_id_card') ?>"
                        placeholder="Masukan ID Card" class="form-control">
                      <small class="text-danger"><?php echo form_error('val_id_card') ?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="inpt_nama_konsumen">Nama Calon</label>
                      <input type="text" name="val_nama_konsumen" value="<?= set_value('val_nama_konsumen') ?>"
                        placeholder="Masukan Nama Konsumen" class="form-control">
                      <small class="text-danger"><?php echo form_error('val_nama_konsumen') ?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="inpt_nomor_telepon">Nomor Telepon</label>
                      <input type="text" name="val_nomor_telepon" value="<?= set_value('val_nomor_telepon') ?>"
                        placeholder="Masukan Nomor Telepon" class="form-control">
                      <small class="text-danger"><?php echo form_error('val_nomor_telepon') ?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="inpt_email">Email</label>
                      <input type="text" name="val_email" value="<?= set_value('val_email') ?>"
                        placeholder="Masukan Alamat Email" class="form-control">
                      <small class="text-danger"><?php echo form_error('val_email') ?></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <label for="inpt_alamat">Alamat</label>
                      <textarea type="text" name="val_alamat" placeholder="Masukan Alamat"
                        class="form-control"><?= set_value('val_alamat') ?></textarea>
                      <small class="text-danger"><?php echo form_error('val_alamat') ?></small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-sm btn-success mr-2"><i class="fa fa-save"></i>Simpan</button>
                  <button type="reset" class="btn btn-sm btn-secondary"><i class="fa fa-refresh"></i>
                    Reset</button>
                </div>
              </div>
            </form>
          </div>
          <div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>