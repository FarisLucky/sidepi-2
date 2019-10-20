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
                  <th>Status Owner</th>
                  <th>Status Manager</th>
                  <th>Bukti</th>
                  <th>Aksi</th>
                </thead>
                <tbody>

                  <?php $no = $row + 1;
                  if (empty($detail)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($detail as $key => $value) :
                    if ($value['bukti_bayar'] != '') {
                      $img = '<img src="' . base_url('assets/uploads/images/pembayaran/' . $value['bukti_bayar']) . '">';
                    } else {
                      $img = '<i>Belum Upload</i>';
                    }
                    $url = base_url('pembayaran/');
                    if ($value['status_owner'] == 's') {

                      $button = '<a href=' . base_url("pembayaran/ubahbayar/" . $value['id_detail']) . ' class="btn btn-icons btn-inverse-info"><i class="fa fa-edit"></i></a><button class="btn btn-icons btn-inverse-danger mx-2" onclick="deleteItem(' . "'{$url}hapus/{$value['id_detail']}'" . ')"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-icons btn-inverse-warning" onclick="setItem(' . "'{$url}paylock/{$value['id_detail']}','lock'" . ')"><i class="fa fa-lock"></i></button>';
                    } elseif ($value['status_owner'] == 'p' || $value['status_manager'] == 'p') {

                      $button = "<i>Menunggu Approve</i>";
                    } else {
                      $button = '<a href="' . base_url('pembayaran/printdata/' . $value['id_detail']) . '" class="btn btn-icons btn-inverse-warning mr-1" ><i class="fa fa-print"></i></a>';
                    } ?>

                    <tr>
                      <td><?= $no ?></td>
                      <td>
                        <?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $value['tgl_bayar']);
                          echo tanggal($date->format('d'), $date->format('m'), $date->format('Y')) . ' ' . $date->format('H:i:s')  ?>
                      </td>
                      <td><?= number_format($value['jumlah_bayar'], 2, ',', '.') ?></td>
                      <td>
                        <?= $value['status_owner'] == 's' ? '-' : ($value['status_owner'] == 'p' ? 'pending' : 'selesai') ?>
                      </td>
                      <td>
                        <?= $value['status_manager'] == 's' ? '-' : ($value['status_manager'] == 'p' ? 'pending' : 'selesai') ?>
                      </td>
                      <td><?= $img ?></td>
                      <td><?= $button ?></td>
                    </tr>
                  <?php $no++;
                  endforeach;  ?>
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