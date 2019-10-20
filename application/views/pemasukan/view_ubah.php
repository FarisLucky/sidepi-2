<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="dark txt_title d-inline-block mt-2">Edit Pengeluaran</h4>
                <img id="logo_perusahaan" width="50px"
                  src="<?= base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right"
                  alt="">
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
                <a href="<?= base_url('pemasukan') ?>" class="btn btn-dark float-right"><i
                    class="fa fa-arrow-circle-left"></i> Kembali</a>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <form action="<?php echo base_url(). 'pemasukan/coreubah'; ?>" method="post"
                  enctype="multipart/form-data">
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">
                  <input type="hidden" name="params" value="<?php echo $p->id_pemasukan ?>">
                  <div class="form-group">
                    <label>Pengeluaran</label>
                    <input type="text" name="nama_pemasukan" value="<?php echo $p->nama_pemasukan ?>"
                      class="form-control">
                    <small class="text-danger"><?= form_error('nama_pemasukan') ?></small>
                  </div>
                  <div class="form-group">
                    <label>Volume</label>
                    <input type="text" name="volume" value="<?php echo $p->volume ?>" class="form-control">
                    <small class="text-danger"><?= form_error('volume') ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Satuan</label>
                    <input type="text" name="satuan" value="<?php echo $p->satuan ?>" class="form-control">
                    <small class="text-danger"><?= form_error('satuan') ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Harga</label>
                    <input type="text" name="harga_satuan" value="<?php echo $p->harga_satuan ?>" class="form-control">
                    <small class="text-danger"><?= form_error('harga_satuan') ?></small>
                  </div>
                  <div class="form-group">
                    <label for="txt_file">Pilih Kelompok</label>
                    <select name="kelompok" class="form-control">
                      <option value="">-- Pilih Kelompok --</option>
                      <?php foreach ($kelompok as $key => $value) { ?>
                      <option
                        value=<?= '"'.$value->id_kelompok.'"'; echo ($value->id_kelompok == $p->id_kelompok) ? "selected" : ""; ?>>
                        <?= $value->nama_kelompok ?></option>
                      <?php } ?>
                    </select>
                    <small class="text-danger"><?= form_error('kelompok') ?></small>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName1">Bukti Bayar</label>
                    <br>
                    <?php if (!empty($p->bukti_kwitansi)) { ?>
                    <img src="<?= base_url('assets/uploads/images/pemasukan/'.$p->bukti_kwitansi) ?>" id="tampil_foto"
                      class="img-thumbnail">
                    <?php } else { ?>
                    <img id="tampil_foto" class="img-thumbnail">
                    <h4 class="p-4">Gambar Kosong</h4>
                    <?php }; ?>
                    <input type="file" name="bukti_kwitansi" class="form-control"
                      onchange="validateFileUpload(this);readURL(this,'#tampil_foto')">
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