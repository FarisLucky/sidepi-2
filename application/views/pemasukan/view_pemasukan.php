<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Kelola Pemasukan</h4>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block"><i class="fa fa-m"></i>Pemasukan</h5>
            <a href="<?= base_url() ?>pemasukan/tambah" class="btn btn-sm btn-primary btn-sm float-right"><i class="fa fa-plus"></i>Tambah</a>
          </div>
        </div>
        <hr>
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <form action="<?= base_url('pemasukan') ?>" method="post">
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
                  <th>Nama Pemasukan</th>
                  <th>Kelompok</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Bukti</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($pemasukan)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($pemasukan as $p) {  ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $p->nama_pemasukan ?></td>
                      <td><?php echo $p->nama_kelompok ?></td>
                      <td><?php echo $p->volume . " " . $p->satuan ?></td>
                      <td><?php echo number_format($p->harga_satuan, 2, ',', '.') ?></td>
                      <td>
                        <?php if (file_exists('.assets/uploads/images/pemasukan/' . $p->bukti_kwitansi)) { ?>
                          <img src="<?= base_url('assets/uploads/images/pemasukan/' . $p->bukti_kwitansi) ?>" style="max-width:50px;">
                        <?php } else { ?>
                          <i style="font-size: 13px;">Kosong</i>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if ($p->status_owner == 's') { ?>

                          <a href="#" class="btn btn-icons btn-inverse-primary"><i class="fa fa-edit"></i></a>
                          <button onclick="deleteItem('<?= base_url('pemasukan/hapus/' . $p->id_pemasukan) ?>')" class="btn btn-icons btn-inverse-danger"><i class="fa fa-trash"></i></button>
                          <button class="btn btn-icons btn-inverse-warning" onclick="setItem('<?= base_url('pemasukan/lock/' . $p->id_pemasukan) ?>','lock')"><i class="fa fa-lock"></i></button>
                        <?php } elseif ($p->status_owner == 'sl' && $p->status_manager == 'sl') { ?>

                          <i>-</i>
                        <?php } else { ?>

                          <i style="font-size: 13px;">Menunggu Approve</i>
                        <?php } ?>
                      </td>

                    </tr>
                  <?php } ?>
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