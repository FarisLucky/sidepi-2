<div class="content-wrapper" id="approve_bayar">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Approve Pengeluaran</h4>
            <div class="border-left-color span-font">
              <div class="flex-column">
                <div class="d-flex flex-row justify-content-between p-2">
                  <h5 class="border-bottom border-secondary">Format Tabel</h5>
                </div>
                <div class="border-bottom border-secondary d-flex flex-row justify-content-between p-2">
                  <span>Tgl_Dibuat</span>
                  <span></span>
                  <span>Pembuat</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Nama Pengeluaran</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Nama Kelompok</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Nama Unit</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Harga / Satuan</span>
                </div>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Jumlah & satuan</span>
                </div>
                <hr class="m-0" style="display:inline-block; width: 200px;">
                <span> x</span>
                <div class="d-flex flex-row justify-content-start p-2">
                  <span>Total Harga</span>
                  <span>Bukti Kwitansi</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Pengeluaran</th>
                </thead>
                <tbody>
                  <?php $no = 1 + $row;
                  if (empty($approve_pengeluaran)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($approve_pengeluaran as $key => $value) :
                    $img = ($value->bukti_kwitansi != '') ? '<a href="' . base_url('assets/uploads/images/pengeluaran/' . $value->bukti_kwitansi) . '" data-lightbox="' . $value->id_pengeluaran . '">Bukti Kwitansi</a>' : '<i>Belum Upload</i>';
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td>
                        <div class="flex-column">
                          <div class="border-bottom border-secondary d-flex flex-row justify-content-between p-2">
                            <span><?= $value->tgl_buat  ?></span>
                            <span></span>
                            <span><?= $value->nama_pembuat ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span style="font-weight:500;"><?= $value->nama_pengeluaran ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span><?= $value->nama_kelompok ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span><?= $value->nama_unit ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span>Rp. <?= number_format($value->harga_satuan, 2, ',', '.') . ' ' . $value->satuan ?></span>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <span><?= $value->volume . ' ' . $value->satuan ?>Jumlah & satuan</span>
                          </div>
                          <hr class="m-0" style="display:inline-block; width: 200px;">
                          <span> x</span>
                          <div class="border-bottom border-secondary d-flex flex-row justify-content-start p-2">
                            <span class="mr-4">Rp. <?= number_format($value->total_harga, 2, ',', '.') ?></span>
                            <?php if ($value->bukti_kwitansi != NULL) { ?>
                              <a href="<?= base_url('assets/uploads/images/pengeluaran/' . $value->bukti_kwitansi) ?>" data-lightbox="data<?= $value->id_pengeluaran ?>">Bukti Kwitansi</a>
                            <?php } else { ?>
                              <i>Belum Upload Kwitansi</i>
                            <?php } ?>
                          </div>
                          <div class="d-flex flex-row justify-content-start p-2">
                            <button type="button" class="btn btn-icons btn-inverse-primary" onclick="setItem('<?= base_url('approvepengeluaran/accept/' . $value->id_pengeluaran) ?>','Terima')">
                              <i class="fa fa-check"></i></button>
                            <button type="button" class="btn btn-icons btn-inverse-danger mx-2 modal_tolak" data-id="<?= $value->id_pengeluaran ?>">
                              <i class="fa fa-ban"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php $no++;
                  endforeach; ?>
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
        <form action="<?= base_url('approvepengeluaran/reject') ?>" method="post">
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