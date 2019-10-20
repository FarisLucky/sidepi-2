<div class="content-wrapper" id="view_marketing">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Laporan Marketing</h4>
          </div>
        </div>
        <hr>
        <div class="text-jual border-left-color py-2 mt-3">
          <div class="row">
            <div class="col-sm-12">
              <small class="txt-normal">Total Marketing</small>
              <small class="txt-normal-b" id="ttl">:&emsp;<?= $total['total'] ?></small>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-4">
      <div class="card-body">
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <div class="filter">
              <small class="text-danger ml-2">cari nama marketing</small>
            </div>
            <form action="<?= base_url('laporanmarketing/index') ?>" method="post">
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
                  <th>Nama</th>
                  <th>Telp</th>
                  <th>Email</th>
                  <th>Total Calon</th>
                  <th>Penjualan</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = 1;
                  if (empty($marketing)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($marketing as $key => $value) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $value['nama_lengkap'] ?></td>
                      <td><?= $value['no_hp'] ?></td>
                      <td><?= $value['email'] ?></td>
                      <td>
                        <?php $c = getDataWhere('COUNT(id_konsumen) as calon', 'konsumen', ['status_konsumen' => 'ck', 'id_user' => $value['id_user']])->row_array();
                          echo $c['calon']; ?>
                      </td>
                      <td>
                        <?php $t = getDataWhere('COUNT(id_transaksi) as transaksi', 'transaksi', ['id_user' => $value['id_user'], 'status_transaksi !=' => 's'])->row_array();
                          echo $t['transaksi'] ?>
                      </td>
                      <td>
                        <a href="<?= base_url('laporanmarketing/detailunit/' . $value['id_user']) ?>" class="btn btn-icons btn-inverse-info"><i class="fa fa-eye"></i></a>
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