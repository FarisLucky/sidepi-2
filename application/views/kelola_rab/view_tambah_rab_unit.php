<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <h4 class="dark txt_title d-inline-block mt-2">Tambah RAB Perumahan</h4>
            <a href="<?= base_url().'rab/unit/'.$kembali ?>" class="float-right btn btn-dark"><i
                class="fa fa-arrow-left"></i> Kembali</a>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <form action="<?php echo base_url(). 'rab/coretambahUnit/'; ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash() ?>">
              <input type="hidden" name="txt_hidden" value="<?= $data_id ?>">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nama Detail</label>
                    <input type="text" name="nama_detail" class="form-control" value="<?= set_value("nama_detail") ?>"
                      required>
                    <small class="form-text text-danger"><?= form_error ('nama_detail'); ?></small>
                  </div>
                  <div class="form-group">
                    <label>Volume</label>
                    <input type="number" name="volume" class="form-control" value="<?= set_value("volume") ?>" required>
                    <small class="form-text text-danger"><?= form_error ('volume'); ?></small>
                  </div>
                  <div class="form-group">
                    <label>satuan</label>
                    <input type="text" name="satuan" class="form-control" value="<?= set_value("satuan") ?>" required>
                    <small class="form-text text-danger"><?= form_error ('satuan'); ?></small>
                  </div>
                  <div class="form-group">
                    <label>Harga_satuan</label>
                    <input type="number" name="harga_satuan" class="form-control"
                      value="<?= set_value("harga_satuan") ?>" required>
                    <small class="form-text text-danger"><?= form_error ('harga_satuan'); ?></small>
                  </div>
                  <div class="form-group">
                    <label>id_kelompok</label>
                    <select name="select_kelompok" class="form-control select-opt" required>
                      <option value=""> -- Pilih Kelompok --</option>
                      <?php foreach ($kelompok_rab as $key => $value) { ?>
                      <option value="<?= $value->id_kelompok ?>"><?= $value->nama_kelompok ?></option>
                      <?php } ?>
                    </select>
                    <small class="form-text text-danger"><?= form_error ('select_kelompok'); ?></small>
                  </div>
                  <button type="submit" class="btn btn-sm btn-success">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>