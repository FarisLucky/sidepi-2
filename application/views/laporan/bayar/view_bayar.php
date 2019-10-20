<div class="content-wrapper" id="view_bayar">
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <small class="d-inline-block mt-2 bg-inverse-success" style="border-radius: 5px;padding: 5px;font-size:15px;font-weight: 500"><?= $properti['nama_properti'] ?></small>
            <?php if (isset($_SESSION['laporan_pembayaran'])) { ?>
              <a href="<?= base_url('laporanpembayaran/resetproperti/') ?>" class="mx-2 text-primary">Pilih Properti</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Laporan Pembayaran </h4>
          </div>
        </div>
        <hr>
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <form action="<?= base_url('laporanpembayaran/list') ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
              <div class="filter">
                <small class="text-danger ml-2">cari nama unit</small>
              </div>
              <div class="form-row m-0">
                <div class="col-7">
                  <input type="text" name="search" class="form-control form-control-sm">
                </div>
                <div class="col-auto">
                  <button name="submit" class="btn btn-sm btn-inverse-success"><span class="fa fa-search"></span></button>
                </div>
                <div class="col-auto">
                  <button name="reset" class="btn btn-sm btn-inverse-secondary"><span class="fa fa-refresh"></span></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Nama Pembayaran</th>
                  <th>Unit</th>
                  <th>Jumlah Bayar</th>
                  <th>Rekening</th>
                  <th>Bukti</th>
                  <th>Tanggal Buat</th>
                  <th>Pembuat</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($bayar)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($bayar as $value) {
                    $d = DateTime::createFromFormat('Y-m-d H:i:s', $value['tgl_bayar']); ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $value['nama_pembayaran'] ?></td>
                      <td><?= $value['nama_unit'] ?></td>
                      <td><?= number_format($value['jumlah_bayar'], 2, ",", ".") ?></td>
                      <td><?= $value['no_rekening'] ?></td>
                      <td>
                        <a href="<?= base_url('assets/uploads/images/pembayaran/' . $value['bukti_bayar']) ?>" data-lightbox="data <?= $value['id_detail'] ?>"><img src="<?= base_url('assets/uploads/images/pembayaran/' . $value['bukti_bayar']) ?>"></a>
                      </td>
                      <td><?= tanggal($d->format('d'), $d->format('m'), $d->format('Y')) . ' ' . $d->format('H:i:s') ?></td>
                      <td><?= $value['nama_lengkap'] ?></td>
                      <td>
                        <a href="<?= base_url('laporanpembayaran/printdata/' . $value['id_detail']) ?>" class="btn btn-icons btn-inverse-warning"><i class="fa fa-print"></i></a>
                      </td>
                    </tr>
                  <?php $no++;
                  } ?>
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