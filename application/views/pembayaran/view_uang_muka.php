<div class="content-wrapper" id="uang_muka">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Uang Muka</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <small class="txt-semi-high">Search</small>
          </div>
        </div>
        <form action="<?= base_url('pembayaran/uangmuka') ?>" method="post">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
          <input type="hidden" name="id_jenis" value="1">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-row m-0">
                <div class="col-sm-8">
                  <select name="search" class="form-control select-opt">
                    <option value="">-- Pilih Unit --</option>
                    <?php foreach ($unit as $key => $value) : ?>
                      <option value="<?= $value['id_unit'] ?>"><?= $value['nama_unit'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-auto">
                  <button type="submit" name="submit" class="btn btn-sm btn-icons btn-inverse-primary"><i class="fa fa-search"></i></button>
                </div>
                <div class="col-auto">
                  <button type="submit" name="reset" class="btn btn-icons btn-sm btn-inverse-secondary"><i class="fa fa-refresh"></i></button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover table-striped text-center">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Konsumen</th>
                  <th>Pembayaran</th>
                  <th>Nama Unit</th>
                  <th>Status</th>
                  <th>Tagihan</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($uang_muka)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($uang_muka as $key => $value) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= ucfirst($value['nama_lengkap']) ?></td>
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