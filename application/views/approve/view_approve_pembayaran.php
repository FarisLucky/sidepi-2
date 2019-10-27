<div class="content-wrapper" id="approve_bayar">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Approve Pembayaran</h4>
            <hr>
            <div class="border-left-color span-font">
              <div class="flex-column">
                <div class="d-flex flex-row justify-content-between p-2">
                  <h5 class="border-bottom border-secondary">Format Tabel</h5>
                </div>
                <div class="border-bottom border-secondary d-flex flex-row justify-content-between p-2">
                  <span>Tgl Bayar</span>
                  <span></span>
                  <span>Pembuat</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Nama Pembayaran</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Nama Konsumen</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Nama Unit</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Total Tagihan</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Total Bayar</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Total Hutang</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>No Rekening</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Jumlah Bayar Sekarang</span>
                  <i class="ml-5">Bukti Bayar</i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body pt-5">
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Detail Pembayaran</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($approve_bayar)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($approve_bayar as $key => $value) {
                    if ($value['bukti_bayar'] != '') {
                      $img = '<a href="' . base_url('assets/uploads/images/pembayaran/' . $value['bukti_bayar']) . '" data-lightbox="data' . $value['id_detail'] . '">Bukti Bayar</a>';
                    } else {
                      $img = '<i>Belum Upload</i>';
                    }
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td>
                        <div class="flex-column">
                          <div class="border-bottom border-secondary d-flex flex-row justify-content-between p-2">
                            <span><?= date('d-m-Y H:i:s', strtotime($value['tgl_bayar'])) ?></span>
                            <span></span>
                            <span><?= ucfirst($value['nama_pembuat']) ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span><?= ucfirst($value['nama_konsumen']) ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span><?= ucfirst($value['nama_unit']) ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span>Rp. <?= number_format($value['total_tagihan'], 2, ',', '.') ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span>Rp. <?= number_format($value['total_bayar'], 2, ',', '.') ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span>Rp. <?= number_format($value['hutang'], 2, ',', '.') ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span><?= $value['no_rekening'] ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span>Rp. <?= number_format($value['jumlah_bayar'], 2, ',', '.') ?></span>
                            <span class="ml-5"><?= $img ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <button type="button" class="btn btn-icons btn-inverse-primary" onclick="setItem('<?= base_url('approve/accept/' . $value['id_detail']) ?>','Terima')">
                              <i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-icons btn-inverse-danger mx-2 modal_tolak" data-id="<?= $value['id_detail'] ?>">
                              <i class="fa fa-ban"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php $no++;
                  }; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <nav class="mt-3">
            <?php echo $this->pagination->create_links(); ?>
          </nav>
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
        <form action="<?= base_url('approve/reject') ?>" method="post">
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