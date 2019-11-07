<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Kelola Pengeluaran</h4>
            <?php if (isset($_SESSION['pengeluaran'])) { ?>
              <a href="<?= base_url('pengeluaran/resetproperti') ?>" class="mx-2 text-primary">Pilih Properti</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block"><i class="fa fa-m"></i>Pengeluaran</h5>
            <a href="<?= base_url() ?>pengeluaran/tambah" class="btn btn-sm btn-primary btn-sm float-right"><i class="fa fa-plus"></i>Tambah</a>
          </div>
        </div>
        <hr>
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <form action="<?= base_url('pengeluaran') ?>" method="post">
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
                  <th>Nama Pengeluaran</th>
                  <th>Kelompok</th>
                  <th>Unit</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Total Harga</th>
                  <th>Bukti</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php
                  $no = $row + 1;
                  if (empty($pengeluaran)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($pengeluaran as $p) {
                    $img = (!empty($p->bukti_kwitansi)) ? $img = '<a href="' . base_url('assets/uploads/images/pengeluaran/' . $p->bukti_kwitansi) . '" data-lightbox="data' . $p->id_pengeluaran . '"><img src="' . base_url('assets/uploads/images/pengeluaran/' . $p->bukti_kwitansi) . '"' : '<i style="font-size:12px;">Belum Upload</i>';
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $p->nama_pengeluaran ?></td>
                      <td><?php echo $p->nama_kelompok ?></td>
                      <td><?= $p->nama_unit ?></td>
                      <td><?php echo $p->volume . " " . $p->satuan ?></td>
                      <td><?php echo number_format($p->harga_satuan, 2, ',', '.') ?></td>
                      <td><?php echo number_format($p->total_harga, 2, ',', '.') ?></td>
                      <td><?= $img ?></td>
                      <td><span class="badge badge-danger"><?= $p->status_diterima == 'terima' ? 'diterima' : ($p->status_diterima == 'tolak' ? 'ditolak' : 'pending') ?></span></td>
                      <td>
                        <?php if ($p->status_diterima == NULL) { ?>

                          <a href="<?= base_url() . 'pengeluaran/ubah/' . $p->id_pengeluaran ?>" class="btn btn-icons btn-inverse-primary"><i class="fa fa-edit"></i></a>
                          <button onclick="deleteItem('<?= base_url('pengeluaran/hapus/' . $p->id_pengeluaran) ?>')" class="btn btn-icons btn-inverse-danger"><i class="fa fa-trash"></i></button>
                        <?php } elseif ($p->status_diterima == 'tolak') { ?>
                          <button class="btn btn-sm btn-danger alasan_pengeluaran" data-id="<?= $p->id_pengeluaran ?>">alasan</button>
                        <?php } else { ?>
                          <a href="<?= base_url('pengeluaran/printdata/' . $p->id_pengeluaran) ?>" class="btn btn-sm btn-warning" target="blank">print</a>
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