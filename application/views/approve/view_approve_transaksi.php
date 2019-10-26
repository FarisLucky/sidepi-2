<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Approve Transaksi</h4>
            <hr>
            <div class="border-left-color span-font">
              <div class="flex-column">
                <div class="d-flex flex-row justify-content-between p-2">
                  <h5 class="border-bottom border-secondary">Format Tabel</h5>
                </div>
                <div class="border-bottom border-secondary d-flex flex-row justify-content-between p-2">
                  <span>Tgl_transaksi</span>
                  <span></span>
                  <span>Pembuat</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Nama Konsumen</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Nama Unit</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Total Kesepakatan</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Total Tanda Jadi (Masuk Harga Jual atau tidak) - Tanggal Bayar Tanda Jadi (Hari-bulan-tahun)</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Total Uang Muka / Periode Uang Muka - Tanggal Bayar Uang Muka (Hari-bulan-tahun)</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Total Cicilan / Periode Cicilan - Tanggal Bayar Cicilan (Hari-bulan-tahun)</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Type Cicilan</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-2">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-6">
            <h5 class="d-inline-block">Data Transaksi</h5>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="table-primary">
                  <th width="15%">No</th>
                  <th>Transaksi</th>
                </thead>
                <tbody>
                  <?php $no = 1;
                  if (empty($transaksi)) {
                    echo "<tr><td colspan='2' class='text-center'>Data Kosong</td></tr>";
                  }
                  foreach ($transaksi as $key => $value) { ?>
                    <tr>
                      <td class="text-center"><?= $no ?></td>
                      <td>
                        <div class="flex-column">
                          <div class="border-bottom border-secondary d-flex flex-row justify-content-between p-2">
                            <span><?= date('d-m-Y', strtotime($value['tgl_transaksi'])); ?></span>
                            <span></span>
                            <span><?= $value['nama_user'] ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span><?= ucfirst($value['nama_konsumen']) ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span><?= $value['nama_unit'] ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span>Rp. <?= number_format($value['total_kesepakatan'], 2, '.', ',') ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span>Rp. <?= number_format($value['total_tanda_jadi']) ?> / (<?= $value['tanda_jadi'] ?> Harga Jual) </span>
                            <span class="mx-4"><?= date('d-m-Y', strtotime($value['tgl_tanda_jadi'])) ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span>Rp. <?= number_format($value['total_uang_muka']) . ' / ' . $value['periode_uang_muka'] . ' periode' ?></span>
                            <span class="mx-4"><?= date('d-m-Y', strtotime($value['tgl_uang_muka'])) ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span>Rp. <?= number_format($value['total_cicilan']) . ' / ' . $value['periode_cicilan'] . ' periode' ?></span>
                            <span class="mx-4"> <?= date('d-m-Y', strtotime($value['tgl_cicilan'])) ?></span>
                          </div>
                          <div class="border-bottom border-secondary d-flex flex-row justify-content-start p-2">
                            <span class="font-weight-bold"><?= $value['nama_type'] ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <button class="btn btn-sm btn-primary" onclick="setItem('<?= base_url('approvetransaksi/terima/' . $value['id_transaksi']) ?>','Terima')">Terima</button>
                            <button class="mx-2 btn btn-sm btn-secondary modal_tolak" data-id="<?= $value['id_transaksi'] ?>">Tolak</button>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php $no++;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alasan Ditolak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('approvetransaksi/tolak') ?>" method="post">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
          <input type="hidden" name="input_hidden" id="input_hidden">
          <div class="form-group">
            <label for="">Deskripsi ditolak</label>
            <textarea name="penolakan" cols="30" rows="10" class="form-control"></textarea>
          </div>
          <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>Simpan</button>
          <button type="reset" class="btn btn-sm btn-secondary"><i class="fa fa-refresh"></i>Reset</button>
        </form>
      </div>
    </div>
  </div>
</div>