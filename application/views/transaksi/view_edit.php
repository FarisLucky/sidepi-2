<div class="content-wrapper" id="tambah_property">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block">Transaksi SPR</h4>
            <img id="logo_perusahaan" width="50px"
              src="<?= base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right"
              alt="">
          </div>
        </div>
      </div>
    </div>
    <form id="form_transaksi" action="<?= base_url() ?>transaksi/coreubah" method="post">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
        value="<?= $this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="hidden" value="<?= $transaksi->id_transaksi ?>">
      <div class="row mt-2">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <h5 class="d-inline-block">Data Konsumen</h5>
                  <a href="<?= base_url("transaksi") ?>" class="btn btn-dark float-right"><i
                      class="fa fa-arrow-circle-left"></i> Kembali</a>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">No SPR</label>
                    <input type="text" class="form-control" name="txt_spr" value="<?= $transaksi->no_spr ?>">
                    <small class="text-danger"><?= form_error("txt_spr") ?></small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="select_konsumen">Pilih Konsumen</label>
                    <select name="select_konsumen" class="form-control p-2" id="select_konsumen">
                      <option value="">Pilih Konsumen</option>
                      <?php foreach ($konsumen as $key => $value) : ?>
                      <option value=<?= $value->id_konsumen ?>
                        <?= ($value->id_konsumen == $transaksi->id_konsumen ? "selected" : "" ) ?>>
                        <?= $value->nama_lengkap ?></option>
                      <?php endforeach; ?>
                    </select>
                    <small class="text-danger"><?= form_error("select_konsumen") ?></small>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="txt_card">Card</label>
                    <input type="text" name="txt_card" class="form-control" value="<?= $detail_konsumen->id_card ?>"
                      disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="txt_telp">Telp</label>
                    <input type="text" name="txt_telp" class="form-control" value="<?= $detail_konsumen->telp ?>"
                      disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="txt_email">Email</label>
                    <input type="text" class="form-control" name="txt_email"
                      value="<?= empty($detail_konsumen->email) ? 'Kosong' : $detail_konsumen->email ?>" disabled>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="txt_alamat">Alamat</label>
                    <input class="form-control" name="txt_alamat" value="<?= $detail_konsumen->alamat ?>" disabled>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <h5 class="d-inline-block">Data Unit</h5>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="select_unit">Pilih Unit</label>
                    <select name="select_unit" class="form-control p-2" id="select_unit">
                      <option value="">Unit Properti</option>
                      <?php foreach ($unit as $key => $value) : ?>
                      <option value="<?= $value->id_unit ?>"
                        <?= ($value->id_unit == $transaksi->id_unit ) ? "selected" : "" ; ?>><?= $value->nama_unit?>
                      </option>
                      <?php endforeach; ?>
                    </select>
                    <small class="text-danger"><?= form_error("select_unit") ?></small>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="txti_nama">Deskripsi</label>
                    <input type="text" name="txt_deskripsi" class="form-control" value="<?= $detail_unit->deskripsi ?>"
                      disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="txt_type">Type Unit</label>
                    <input type="text" name="txt_type" class="form-control" value="<?= $detail_unit->type ?>" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="txt_bangunan">Luas Bangunan</label>
                    <input type="text" name="txt_bangunan" class="form-control"
                      value="<?= $detail_unit->luas_bangunan." ".$detail_unit->satuan_bangunan ?>" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="txt_bangunan">Luas Tanah</label>
                    <input type="text" name="txt_tanah" class="form-control"
                      value="<?= $detail_unit->luas_tanah." ".$detail_unit->satuan_tanah  ?>" disabled>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="txt_harga">Harga</label>
                    <input type="text" name="txt_harga" class="form-control"
                      value="<?= number_format($detail_unit->harga_unit,2,',','.') ?>" disabled>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row justify-content-end">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label for="txt_nama_tambah" class="col-sm-5 col-form-label f-29">Kesepakatan Harga</label>
                    <div class="col-sm-7">
                      <input type="text" name="txt_kesepakatan" class="form-control" id="txt_kesepakatan"
                        value="<?= $transaksi->total_kesepakatan ?>">
                      <small class="form-text text-danger"><?= form_error("txt_kesepakatan") ?></small>
                    </div>
                  </div>
                </div>
                <div class="col-md-1 pr-0">
                  <div class="form-group">
                    <button class="btn btn-sm btn-info " id="lock_kesepakatan"><i class="fa fa-lock"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body" id="clone_form">
              <div class="row">
                <div class="col-sm-12">
                  <h5 class="d-inline-block">Data Tambahan</h5>
                  <button type="button" class="btn btn-sm btn-primary float-right" id="tambah_form">Tambah</button>
                </div>
              </div>
              <hr>
              <div class="form-clone">
                <?php if (empty($detail_transaksi)) { ?>

                <div class="form-tambah">
                  <small class="tambah_txt">Penambahan</small>
                  <button type="button" class="btn btn-sm btn-danger float-right" id="hapus_form">Hapus</button>
                  <div class="row mt-2">
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="txt_nama_tambah">Nama</label>
                        <input type="text" name="txt_nama_tambah[]" class="form-control" id="txt_nama_tambah">
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="txt_volume_tambah">Volume</label>
                        <input type="number" name="txt_volume_tambah[]" class="form-control" id="txt_volume_tambah">
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="txt_satuan_tambah">Satuan</label>
                        <input type="text" name="txt_satuan_tambah[]" class="form-control" id="txt_satuan_tambah">
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="txt_harga_tambah">Harga per M2</label>
                        <input type="text" name="txt_harga_tambah[]" class="form-control" id="txt_harga_tambah">
                      </div>
                    </div>
                  </div>
                </div>

                <?php } else { foreach ($detail_transaksi as $key => $value) : ?>

                <div class="form-tambah">
                  <small class="tambah_txt">Penambahan</small>
                  <button type="button" class="btn btn-sm btn-danger float-right" id="hapus_form">Hapus</button>
                  <div class="row mt-2">
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="txt_nama_tambah">Nama</label>
                        <input type="text" name="txt_nama_tambah[]" class="form-control" id="txt_nama_tambah"
                          value="<?= $value->penambahan ?>">
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="txt_volume_tambah">Volume</label>
                        <input type="number" name="txt_volume_tambah[]" class="form-control" id="txt_volume_tambah"
                          value="<?= $value->volume ?>">
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="txt_satuan_tambah">Satuan</label>
                        <input type="text" name="txt_satuan_tambah[]" class="form-control" id="txt_satuan_tambah"
                          value="<?= $value->satuan ?>">
                      </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="txt_harga_tambah">Harga per M2</label>
                        <input type="text" name="txt_harga_tambah[]" class="form-control" id="txt_harga_tambah"
                          value="<?= $value->harga ?>">
                      </div>
                    </div>
                  </div>
                </div>

                <?php endforeach;} ?>
              </div>
              <hr>
              <div class="row justify-content-end">
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-sm-2 pt-4">
                      <button type="button" class="btn btn-sm btn-info btn-kunci"><i
                          class="mdi mdi-lock-outline"></i></button>
                    </div>
                    <div class="col-sm-10">
                      <div class="form-group">
                        <label for="txt_total">Total Tambahan</label>
                        <input type="text" name="txt_total_tambahan" class="form-control" id="txt_total_tambahan"
                          value="<?= $transaksi->total_tambahan ?>" readonly>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body" id="clone_form">
              <div class="row">
                <div class="col-sm-12">
                  <h5 class="d-inline-block">Total</h5>
                </div>
              </div>
              <hr>
              <div class="row mt-2 periode_row mb-2">
                <div class="col-md-3 border-right border-info">
                  <div class="form-group">
                    <label for="txt_ttl_transaksi">Total Transaksi</label>
                    <input type="text" name="txt_ttl_transaksi" class="form-control" id="txt_ttl_transaksi"
                      value="<?= ($transaksi->total_kesepakatan + $transaksi->total_tambahan) ?>" Readonly>
                  </div>
                </div>
                <div class="col-md-3 col-sm-10">
                  <div class="form-group">
                    <label for="txt_tanda_jadi">Tanda Jadi</label>
                    <input type="text" name="txt_tanda_jadi" class="form-control" id="txt_tanda_jadi"
                      value="<?= $transaksi->total_tanda_jadi ?>">
                    <small class="text-danger"><?= form_error("txt_tanda_jadi") ?></small>
                  </div>
                  <div class="form-group">
                    <div class="form-radio form-radio-flat">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input btn-check" name="radio_tj" id="radio2"
                          value="tidak_masuk" <?= ($transaksi->tanda_jadi == "tidak_masuk") ? "checked" : ""; ?>>Tidak
                        masuk harga jual
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-radio form-radio-flat">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input btn-check" name="radio_tj" id="radio1" value="masuk"
                          <?= ($transaksi->tanda_jadi == "masuk") ? "checked" : ""; ?>>Masuk harga jual
                      </label>
                    </div>
                  </div>
                  <small class="text-danger"><?= form_error("radio_tj") ?></small>
                </div>
                <div class="col-md-1 col-sm-2 border-right border-info">
                  <div class="form-group">
                    <label>Lock</label>
                    <button class="btn btn-sm btn-info" id="lock_tanda_jadi"><i class="fa fa-lock"></i></button>
                  </div>
                </div>
                <div class="col-md-3 col-sm-10">
                  <div class="form-group">
                    <label for="periode_Um">Periode Uang Muka</label>
                    <select name="periode_Um" id="periode_Um" class="form-control form-control-sm">
                      <option value="">Pilih Periode</option>
                      <?php $p = 36; for ($i=1; $i < $p ; $i++) { ?>
                      <option value="<?= $i ?>" <?= $i == $transaksi->periode_uang_muka ? 'selected' : ''; ?>><?= $i ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-1 col-sm-2 pr-0">
                  <div class="form-group">
                    <label>Lock</label>
                    <button class="btn btn-sm btn-info" id="lock_uang_muka"><i class="fa fa-lock"></i></button>
                  </div>
                </div>
              </div>
              <div class="row text-uang-muka">

                <?php foreach ($uang_muka as $key => $value) { ?>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label><?= $value['nama_pembayaran'] ?></label>
                    <input type="text" name="txt_angsuran[]" class="form-control"
                      value="<?= $value['total_tagihan'] ?>">
                  </div>
                </div>
                <?php } ?>

              </div>
              <hr>
              <div class="row justify-content-end">
                <div class="col-md-4 col-sm-6 pl-0">
                  <div class="form-group row">
                    <label for="txt_uang_muka" class="col-md-5 f-29 col-form-label">Uang Muka</label>
                    <div class="col-md-7">
                      <input type="text" name="txt_uang_muka" class="form-control" id="txt_uang_muka"
                        value="<?= $transaksi->total_uang_muka ?>" Readonly>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-sm-6">
                  <div class="form-group row">
                    <label for="txt_nama_tambah" class="col-md-5 col-form-label f-29 border-left border-dark">Total
                      Akhir</label>
                    <div class="col-md-7">
                      <input type="text" name="txt_ttl_akhir" class="form-control" id="txt_ttl_akhir"
                        value="<?= $transaksi->total_cicilan * $transaksi->periode_cicilan ?>" Readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-12">
                  <h5 class="d-inline-block">Pembayaran dan Tanggal Penting</h5>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-1 col-sm-2 pr-0 text-center">
                  <div class="form-group">
                    <label>Lock</label>
                    <button class="btn btn-sm btn-info" id="lock_type_bayar"><i class="fa fa-lock"></i></button>
                  </div>
                </div>
                <div class="col-md-3 col-sm-10 bayar pl-0">
                  <div class="form-group">
                    <label for="txt_type_pembayaran">Type Pembayaran</label>
                    <select name="txt_type_pembayaran" id="txt_type_pembayaran" class="form-control form-control-sm">
                      <option value="">Pilih Type</option>
                      <?php foreach ($type as $key => $value): ?>
                      <option value="<?= $value['id_type_bayar'] ?>"
                        <?= ($value["id_type_bayar"] == $transaksi->id_type) ? "selected" : "" ;?>>
                        <?= $value['type_bayar'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <small class="text-danger"><?= form_error("txt_type_pembayaran") ?></small>
                  </div>
                </div>
                <div class="col-md-3 col-sm-12 val_periode">
                  <div class="form-group">
                    <label for="periode_bayar">Periode Bayar(Bulan)</label>
                    <input type="number" name="periode_bayar" class="form-control" id="periode_bayar"
                      value="<?= $transaksi->periode_cicilan ?>" required>
                  </div>
                </div>
              </div>
              <div class="row justify-content-end">
                <div class="col-md-5">
                  <div class="form-group row">
                    <label class="col-md-7 col-form-label f-29 border-left border-dark">Pembayaran Per Periode</label>
                    <div class="col-md-5">
                      <input type="text" name="total_bayar_periode" class="form-control" id="total_bayar_periode"
                        value="<?= $transaksi->total_cicilan ?>" Readonly>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="txt_type_pembayaran">Perkiraan Bayar Tanda Jadi</label>
                    <input type="date" class="form-control" name="tgl_tanda_jadi" id="tgl_tanda_jadi"
                      value="<?= $transaksi->tgl_tanda_jadi ?>">
                    <small class="text-danger"><?= form_error("tgl_tanda_jadi") ?></small>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="txt_type_pembayaran">Perkiraan Bayar Uang Muka</label>
                    <input type="date" class="form-control" name="tgl_uang_muka" id="tgl_uang_muka"
                      value="<?= $transaksi->tgl_uang_muka ?>">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="txt_type_pembayaran">Perkiraan Bayar Cicilan</label>
                    <input type="date" class="form-control" name="tgl_pembayaran" id="tgl_pembayaran"
                      value="<?= $transaksi->tgl_cicilan ?>">
                    <small class="text-danger"><?= form_error("tgl_pembayaran") ?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-success mr-2 simpan" disabled><i
                      class="fa fa-save"></i>Simpan</button>
                  <button type="reset" class="btn btn-dark mr-2"><i class="fa fa-refresh"></i> Reset</>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>