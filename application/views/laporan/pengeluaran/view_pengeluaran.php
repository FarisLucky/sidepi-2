<div class="content-wrapper" id="view_pengeluaran">
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <small class="d-inline-block mt-2 bg-inverse-success" style="border-radius: 5px;padding: 5px;font-size:15px;font-weight: 500"><?= $properti['nama_properti'] ?></small>
            <?php if (isset($_SESSION['laporan_pengeluaran'])) { ?>
              <a href="<?= base_url('laporanpengeluaran/resetproperti/') ?>" class="mx-2 text-primary">Pilih Properti</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <!-- <?php var_dump ?> -->
    <div class="card mt-3">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="dark txt_title d-inline-block py-3">Laporan Pengeluaran</h5>
            <a data-toggle="collapse show" href="#collapseOne" class="text-primary float-right"><span class="fa fa-circle"></span></a>
          </div>
        </div>
        <div class="border-left-color mt-2" id="collapseOne">
          <form action="<?php echo base_url('laporanpengeluaran/list') ?>" method="post">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="form-group">
                  <label for="unit_id">Pilih Kelompok</label>
                  <select name="id_kelompok" class="form-control select-opt">
                    <option value=""> -- Kelompok -- </option>
                    <?php $params = isset($_SESSION['filter_cari']) ? $_SESSION['filter_cari']['id_kelompok'] : '';
                    foreach ($kelompok as $key => $value) { ?>
                      <option value="<?= $value->id_kelompok ?>" <?= $params == $value->id_kelompok ? 'selected' : '' ?>><?= $value->nama_kelompok ?></option>
                    <?php } ?>

                  </select>
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>Tanggal Mulai</label>
                  <input type="date" name="tgl_mulai" class="form-control" id="tgl_mulai">
                </div>
              </div>
              <div class="col-md-3 col-sm-12">
                <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <button type="submit" name="filter_submit" class="btn btn-sm btn-inverse-primary"><span class="fa fa-search"></span></button>
                <button type="submit" name="filter_reset" class="btn btn-sm btn-inverse-secondary"><span class="fa fa-refresh"></span></button>
                <a href="<?php echo base_url('laporanpengeluaran/printall') ?>" class="btn btn-sm btn-inverse-warning"><i class="fa fa-print"></i></a>
              </div>
            </div>
          </form>
        </div>
        <hr>
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <div class="filter">
              <small class="text-danger ml-2">cari nama unit</small>
            </div>
            <form action="<?= base_url('laporanpengeluaran/list') ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
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
              <table class="table table-bordered table-hover">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Pengeluaran</th>
                  <th>Kelompok</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Total Harga</th>
                  <th>Unit</th>
                  <th>Bukti</th>
                  <th>Tanggal Buat</th>
                  <th>Pembuat</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  $total_filter = 0;
                  if (empty($pengeluaran)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($pengeluaran as $value) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $value['nama_pengeluaran'] ?></td>
                      <td><?= $value['nama_kelompok'] ?></td>
                      <td><?= $value['volume'] . ' ' . $value['satuan'] ?></td>
                      <td><?= number_format($value['harga_satuan'], 2, ",", ".") ?></td>
                      <td><?= number_format($value['total_harga'], 2, ",", ".") ?></td>
                      <td><?= $value['nama_unit'] ?></td>
                      <td>
                        <a href="<?= base_url('assets/uploads/images/pengeluaran/' . $value['bukti_kwitansi']) ?>" data-lightbox="data <?= $value['id_pengeluaran'] ?>"><img src="<?= base_url('assets/uploads/images/pengeluaran/' . $value['bukti_kwitansi']) ?>"></a>
                      </td>
                      <td><?= $value['tgl_buat'] ?></td>
                      <td><?= $value['nama_lengkap'] ?></td>
                      <td>
                        <a href="<?= base_url('laporanpengeluaran/printpengeluaran/' . $value['id_pengeluaran']) ?>" class="btn btn-icons btn-inverse-warning"><i class="fa fa-print"></i></a>
                      </td>
                    </tr>
                  <?php $total_filter += $value['total_harga'];
                    $no++;
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
        <div class="text-jual text-right border-right-color py-2 mt-3">
          <div class="row">
            <div class="col-sm-12">
              <small class="txt-normal">Total Pengeluaran Filter</small>
              <small class="txt-normal-b" id="ttl">:&emsp;<?= number_format($total_filter, 2, ',', '.'); ?></small>
            </div>
            <div class="col-sm-12">
              <small class="txt-normal">Total Semua Pengeluaran</small>
              <small class="txt-normal-b" id="ttl">:&emsp;<?= number_format($total['total'], 2, ',', '.'); ?></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>