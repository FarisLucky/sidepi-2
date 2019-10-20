<div class="content-wrapper" id="view_update_bayar">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="dark txt_title d-inline-block mt-2">Ubah Bayar</h4>
                <img id="logo_perusahaan" width="50px"
                  src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>"
                  class="float-right" alt="">
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
                <a href="<?= base_url('pembayaran/history/'.$id) ?>" class="btn btn-dark float-right"><i
                    class="fa fa-arrow-circle-left"></i>Kembali</a>
              </div>
            </div>
            <hr>
            <form action="<?= base_url("pembayaran/coreubahbayar") ?>" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="txt_id" value="<?= $detail["id_detail"] ?>">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Nama Pembayaran</label>
                    <input type="text" name="txt_nama" class="form-control" value="<?= $bayar["nama_pembayaran"] ?>"
                      readonly>
                    <small class="text-danger"><?= form_error("txt_nama") ?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Hutang</label>
                    <input type="text" name="txt_hutang" class="form-control"
                      value="<?= number_format($bayar["hutang"],2,",",".") ?>" readonly>
                    <small class="text-danger"><?= form_error("txt_hutang") ?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Jumlah Bayar</label>
                    <input type="text" name="txt_jumlah" class="form-control" value="<?= $detail['jumlah_bayar'] ?>">
                    <small class="text-danger"><?= form_error("txt_jumlah") ?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Rekening</label>
                    <select name="txt_rekening" class="form-control">
                      <option value="">-- Pilih Rekening --</option>
                      <?php foreach ($rekening as $key => $value) : ?>
                      <option value="<?= $value["id_rekening"] ?>"
                        <?= $value['id_rekening'] == $detail['id_rekening'] ? 'selected' : ''; ?>>
                        <?= $value["bank"]." ".$value["no_rekening"]." ".$value["pemilik"] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <small class="text-danger"><?= form_error("txt_rekening") ?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Bukti Bayar</label><br>
                    <img src="<?= base_url("assets/uploads/images/pembayaran/".$detail["bukti_bayar"]) ?>"
                      id="tampil_foto" class="img-thumbnail" width="300px">
                    <input type="file" name="txt_bukti" class="form-control"
                      onchange="validateFileUpload(this);readURL(this,'#tampil_foto')">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <div class="form-check form-check-flat">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="lock" value="l">pembayaran akan dilock
                        otomatis</label>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-success mx-2"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                  <button type="reset" class="btn btn-secondary mx-2"><i class="fa fa-refresh"></i>&nbsp;Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>