<div class="content-wrapper" id="view_konsumen">
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Laporan Konsumen</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <div class="border-left-color py-3">
              <small class="txt-normal">Total konsumen : <b><?= $total_konsumen['jumlah_konsumen'] ?></b></small>
            </div>
          </div>
        </div>
        <hr>
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <div class="filter">
              <small class="text-danger ml-2">cari nama konsumen</small>
            </div>
            <form action="<?= base_url('laporankonsumen/index') ?>" method="post">
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
              <table class="table table-hover table-striped">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Card</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Telp</th>
                  <th>email</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($konsumen)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($konsumen as $value) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $value['id_card'] ?></td>
                      <td><?= $value['nama_lengkap'] ?></td>
                      <td><?= $value['jenis_kelamin'] == 'l' ? 'laki-laki' : 'perempuan' ?></td>
                      <td><?= $value['telp'] ?></td>
                      <td><?= $value['email'] ?></td>
                      <td>
                        <a href="<?= base_url('laporankonsumen/detail/' . $value['id_konsumen']) ?>" class="btn btn-icons btn-inverse-info"><i class="fa fa-info"></i></a><a href="<?= base_url() . " laporankonsumen/printkonsumen/" . $value['id_konsumen'] ?>" class="btn btn-icons btn-inverse-warning mx-2"><i class="fa fa-print"></i></a>
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