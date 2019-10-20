<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Tambah Data Pengeluaran</h4>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block">Total Dp <span class="badge badge-inverse-primary ml-3" style="font-size: 13px;">Rp
                <?= number_format($dp['total'], 2, ',', '.'); ?></span>
            </h5>
            <a href="<?= base_url('listtransaksi') ?>" class="btn btn-sm btn-dark float-right"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <form action="<?= base_url('listunlocktransaksi/coretambah') ?>" method="post" enctype="multipart/form-data" id="p_transaksi">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="input_hidden" value="<?= $pengeluaran['id_transaksi'];  ?>">
              <div class="form-group">
                <label for="exampleInputName1">Pengeluaran</label>
                <input type="text" name="nama_pengeluaran" class="form-control" value="<?= $pengeluaran['nama_pengeluaran'] ?>">
                <small class="text-small text-danger"><?= form_error("nama_pengeluaran") ?></small>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Volume</label>
                <input type="number" name="volume" class="form-control" value="<?= $pengeluaran['volume'] ?>">
                <small class="text-small text-danger"><?= form_error("volume") ?></small>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Satuan</label>
                <input type="text" name="satuan" class="form-control" value="<?= $pengeluaran['satuan'] ?>">
                <small class="text-small text-danger"><?= form_error("satuan") ?></small>
              </div>
              <div class="form-group">
                <label for="exampleInputName1">Harga Satuan</label>
                <input type="number" name="harga_satuan" class="form-control" value="<?= $pengeluaran['harga_satuan'] ?>">
                <small class="text-small text-danger"><?= form_error("harga_satuan") ?></small>
              </div>
              <div class="form-group">
                <label for="txt_file">Pilih Unit</label>
                <select name="unit" class="form-control" readonly>
                  <option value="<?= $pengeluaran['id_unit'] ?>"><?= $pengeluaran['nama_unit'] ?></option>
                </select>
              </div>
              <div class="form-group">
                <label for="txt_file">Bukti </label><br>
                <img class="img-thumbnail" id="preview">
                <input type="file" name="bukti_kwitansi" class="form-control" onchange="validateFileUpload(this);readURL(this,'#preview')">
              </div>
              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" class="btn btn-sm btn-danger" id="batal"><i class="fa fa-close"></i>
                  Batal</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>