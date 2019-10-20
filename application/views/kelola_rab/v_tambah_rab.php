<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="d-inline-block mt-2">Tambah RAB Properti</h4>
            <a href="<?= base_url().'rab/properti/'.$kembali ?>" class="float-right btn btn-dark" id="kembali"><i
                class="fa fa-arrow-left"></i> Kembali</a>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <form action="<?php echo base_url(). 'rab/coretambah'; ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash() ?>">
              <input type="hidden" name="txt_hidden" value="<?= $data_id ?>">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nama Detail</label>
                    <input type="text" name="nama_detail" class="form-control" value="<?= set_value("nama_detail") ?>"
                      placeholder="Nama" required>
                    <small class="form-text text-danger"><?= form_error ('nama_detail'); ?></small>
                  </div>
                  <div class="form-group">
                    <label>Volume</label>
                    <input type="number" name="volume" class="form-control" value="<?= set_value("volume") ?>"
                      placeholder="Volume" required>
                    <small class="form-text text-danger"><?= form_error ('volume'); ?></small>
                  </div>
                  <div class="form-group">
                    <label>Satuan</label>
                    <input type="text" name="satuan" class="form-control" value="<?= set_value("satuan") ?>"
                      placeholder="Satuan" required>
                    <small class="form-text text-danger"><?= form_error ('satuan'); ?></small>
                  </div>
                  <div class="form-group">
                    <label>Harga Satuan</label>
                    <input type="number" name="harga_satuan" class="form-control"
                      value="<?= set_value("harga_satuan") ?>" placeholder="Harga" required>
                    <small class="form-text text-danger"><?= form_error ('harga_satuan'); ?></small>
                  </div>
                  <div class="form-group">
                    <label>Kategori Kelompok</label>
                    <select name="select_kelompok" class="form-control select-opt" required>
                      <option value="">-- Pilih Kelompok --</option>
                      <?php foreach ($kelompok_rab as $key => $value) { ?>
                      <option
                        value=<?php echo "'$value->id_kelompok'";echo (set_value("select_kelompok") == $value->id_kelompok) ? "selected" : "" ; ?>>
                        <?= $value->nama_kelompok ?></option>
                      <?php } ?>
                    </select>
                    <small class="form-text text-danger"><?= form_error ('select_kelompok'); ?></small>
                  </div>
                  <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>