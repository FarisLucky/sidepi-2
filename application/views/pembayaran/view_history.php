<div class="content-wrapper" id="history">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">History Transaksi</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <a href="<?= base_url('pembayaran/printall/' . $id_pembayaran) ?>" class="btn btn-sm btn-warning"><i class="fa fa-print"></i>&nbsp;Print All</a>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12 text-center mb-3">
            <a href="<?= base_url('pembayaran/bayar/' . $id_pembayaran) ?>" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus-circle"></i>&nbsp;Bayar</a>
            <small class="kh-title">Detail History</small>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Tanggal buat</th>
                  <th>Jumlah Bayar</th>
                  <th>Status Diterima</th>
                  <th>Bukti</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($detail)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($detail as $key => $value) {
                    $img = ($value['bukti_bayar'] != '') ? '<img src="' . base_url('assets/uploads/images/pembayaran/' . $value['bukti_bayar']) . '">' : '<i>Belum Upload</i>';
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= date('d-m-Y H:i:s', strtotime($value['tgl_bayar'])) ?></td>
                      <td><?= number_format($value['jumlah_bayar'], 2, ',', '.') ?></td>
                      <td><span class="badge badge-danger"><?= $value['status_diterima'] == 'terima' ? 'diterima' : ($value['status_diterima'] == 'tolak' ? 'Ditolak' : 'tunggu disetujui') ?></span></td>
                      <td><?= $img ?></td>
                      <td>
                        <?php if (empty($value['status_diterima'])) { ?>
                          <a href="<?= base_url('pembayaran/ubahbayar/' . $value['id_detail']) ?>" class="btn btn-icons btn-inverse-info"><i class="fa fa-edit"></i></a><button class="btn btn-icons btn-inverse-danger mx-2" onclick="deleteItem('<?= base_url('pembayaran/hapus/' . $value['id_detail']) ?>')"><i class="fa fa-trash"></i></button>
                        <?php } elseif ($value['status_diterima'] == 'terima') { ?>
                          <a href="<?= base_url('pembayaran/printdata/' . $value['id_detail']) ?>" target="blank" class="btn btn-sm btn-warning" data-id="<?= $value['id_detail'] ?>">print</a>
                        <?php } else { ?>
                          <button class="btn btn-sm btn-danger alasan_di_history" data-id="<?= $value['id_detail'] ?>">alasan</button>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php $no++;
                  }  ?>
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
        <hr>
        <div class="row">
          <div class="col-sm-5">
            <div class="row">
              <div class="col-sm-6">
                <small class="txt-semi-high">Tagihan Bayar </small>
              </div>
              <div class="col-sm-5">
                <small class="txt-filter border-0"><?= number_format($pembayaran['total_tagihan'], 2, ',', '.') ?></small>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <small class="txt-semi-high">Realisasi Bayar</small>
              </div>
              <div class="col-sm-5">
                <small class="txt-filter border-0"><?= number_format($pembayaran['total_bayar'], 2, ',', '.') ?></small>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <small class="txt-semi-high">Pembayaran Pending</small>
              </div>
              <div class="col-sm-5">
                <small class="txt-filter border-0"><?= number_format($bayar['total_pending'], 2, ',', '.') ?></small>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-6">
                <small class="txt-semi-high">Total Hutang</small>
              </div>
              <div class="col-sm-5">
                <small class="txt-filter border-0"><?= number_format($pembayaran['hutang'], 2, ',', '.') ?></small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_history">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alasan Ditolak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="body-modal">/p>
      </div>
    </div>
  </div>
</div>