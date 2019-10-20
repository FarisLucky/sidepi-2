<div class="content-wrapper" id="tanda_jadi">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Tanda Jadi</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <span>Cari Unit</span>
          </div>
        </div>
        <hr>
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <form action="<?= base_url('pembayaran/tandajadi') ?>" method="post">
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
              <table class="table table-hover text-center">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Pembayaran</th>
                  <th>Nama Unit</th>
                  <th>Status</th>
                  <th>Tagihan</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($tanda_jadi)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($tanda_jadi as $key => $value) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $value['nama_pembayaran'] ?></td>
                      <td><?= $value['nama_unit'] ?></td>
                      <td><span class="badge badge-primary"><?= $value['status'] == 'b' ? 'belum bayar' : 'sudah bayar' ?><span></td>
                      <td><?= "Rp. " . number_format($value['total_tagihan'], 2, ',', '.') ?></td>
                      <td>
                        <?php if ($value['status'] == 'b') { ?>
                          <a href="<?= base_url("pembayaran/history/" . $value['id_pembayaran']) ?>" class="btn btn-icons btn-inverse-danger"><i class="fa fa-money"></i></a>
                        <?php } else { ?>
                          <a href="<?= base_url("pembayaran/history/" . $value['id_pembayaran']) ?>" class="btn btn-icons btn-inverse-info"><i class="fa fa-info"></i></a><a href="<?= base_url('pembayaran/printall/' . $value['id_pembayaran']) ?>" class="btn btn-icons btn-inverse-warning mx-2"><i class="fa fa-print"></i></a>
                        <?php } ?>
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