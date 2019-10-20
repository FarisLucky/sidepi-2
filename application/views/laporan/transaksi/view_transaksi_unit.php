<div class="content-wrapper" id="laporan_transaksi">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <small class="d-inline-block mt-2 bg-inverse-success" style="border-radius: 5px;padding: 5px;font-size:15px;font-weight: 500"><?= $properti['nama_properti'] ?></small>
            <?php if (isset($_SESSION['list_transaksi'])) { ?>
              <a href="<?= base_url('listtransaksi/resetproperti/') ?>" class="mx-2 text-primary">Pilih Properti</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <small class="txt-semi-high font-weight-medium">Filter Transaksi</small>
            <a href="" class="text-primary float-right" data-target="#filter" data-toggle="collapse"><i class="fa fa-circle"></i></a>
          </div>
        </div>
        <hr>
        <div class="collapse show" id="filter">
          <div class="border-left-color">
            <form action="<?= base_url('listtransaksi/list') ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Pilih Status</label>
                    <?php $params = isset($_SESSION['filter_cari']) ? $_SESSION['filter_cari']['kunci'] : ''; ?>
                    <select name="filter_cari" class="form-control">
                      <option value="">-- Pilih Status --</option>
                      <option value="l" <?= $params == 'l' ? 'selected' : '' ?>>terkunci</option>
                      <option value="u" <?= $params == 'u' ? 'selected' : '' ?>>terbuka</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" id="tgl_mulai">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" name="filter_submit" class="btn btn-sm btn-inverse-success"><span class="fa fa-search"></span></button>
                  <button type="submit" name="filter_reset" class="btn btn-sm btn-inverse-secondary"><span class="fa fa-refresh"></span></button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="card">
    <div class="card-body">
      <div class="row justify-content-end">
        <div class="col-sm-4">
          <form action="<?= base_url('listtransaksi/list') ?>" method="post">
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
            <table class="table table-hover table-striped">
              <thead class="table-primary">
                <th>No</th>
                <th>No SPR</th>
                <th>Konsumen</th>
                <th>Unit</th>
                <th>Tanggal Transaksi</th>
                <th>Status Transaksi</th>
                <th>Status</th>
                <th>Aksi</th>
              </thead>
              <tbody>
                <?php $no = $row + 1;
                if (empty($list_pembayaran)) {
                  echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                }
                foreach ($list_pembayaran as $value) { ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $value['no_spr'] ?></td>
                    <td><?= $value['nama_lengkap'] ?></td>
                    <td><?= $value['nama_unit'] ?></td>
                    <td><?= date('d-m-Y', strtotime($value['tgl_transaksi'])) ?></td>
                    <td>
                      <span class="badge badge-info"><?= $value['status_transaksi'] == 'p' ? 'progress' : ($value['status_transaksi'] == 's' ? 'sementara' : 'selesai') ?></span>
                    </td>
                    <td><span class="badge badge-dark"><?= $value['kunci'] == 'l' ? 'terkunci' : 'terbuka' ?></span></td>
                    <td>
                      <a href="<?= base_url('listtransaksi/getdetail/' . $value['id_transaksi']) ?>" class="btn btn-sm btn-inverse-info" data-id="<?= $value['id_transaksi'] ?>"><i class="fa fa-info"></i></a>
                      <?php if ($value['kunci'] == 'u') { ?>
                        <button class="btn btn-sm btn-inverse-danger" onclick="setItem('<?= base_url('listtransaksi/hapus/' . $value['id_transaksi']) ?>','Hapus')"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-sm btn-inverse-warning" onclick="setItem('<?= base_url('listtransaksi/unlock/' . $value['id_transaksi']) ?>','Kunci')"><i class="fa fa-lock"></i></button>
                      <?php } else { ?>
                        <button class="btn btn-sm btn-inverse-warning" onclick="setItem('<?= base_url('listtransaksi/unlock/' . $value['id_transaksi']) ?>','Buka Kunci')"><i class="fa fa-unlock"></i></button>
                      <?php } ?>
                      <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">action</button>
                        <div class="dropdown-menu">
                          <a href="<?= base_url('listtransaksi/printspr/' . $value['id_transaksi']) ?>" class="dropdown-item"><i class="fa fa-print"></i> SPR</a>
                          <?php if (file_exists('assets/uploads/files/spk/' . $value['sp3k'])) { ?>
                            <a href="<?= base_url('listtransaksi/printspk/' . $value['id_transaksi']) ?>" class="dropdown-item" target="blank"><i class="fa fa-print"></i> SP3K</a>
                          <?php } ?>
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
      <hr>
      <div class="border-right-color">
        <div class="row text-right">
          <div class="col-md-12">
            <small class="txt-normal">Total Transaksi</small>
            <small class="txt-normal-b" id="s">: &emsp;<?= $semua['total'] ?></small>
          </div>
          <div class="col-md-12">
            <small class="txt-normal">Progress</small>
            <small class="txt-normal-b" id="p">: &emsp;<?= $progress['progress'] ?></small>
          </div>
          <div class="col-md-12">
            <small class="txt-normal">Selesai</small>
            <small class="txt-normal-b" id="sl">: &emsp;<?= $selesai['selesai'] ?></small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>