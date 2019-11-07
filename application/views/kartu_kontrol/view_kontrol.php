<div class="content-wrapper" id="view_kontrol">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Kartu Kontrol </h4>
            <?php if (isset($_SESSION['kartu_kontrol'])) { ?>
              <a href="<?= base_url('kartukontrol/resetproperti/') ?>" class="mx-2 text-primary">Pilih Properti</a>
            <?php } ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-10">
            <form action="<?= base_url('kartukontrol/list') ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="unit_id">Pilih Unit</label>
                    <select name="id_unit" class="form-control text-center select-opt">
                      <option value=""> -- Unit -- </option>
                      <?php foreach ($unit as $key => $value) { ?>
                        <option value="<?= $value['id_unit'] ?>"><?= $value['nama_unit'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Tanggal Mulai</label>
                    <input type="date" name="tgl_mulai" class="form-control" id="tgl_mulai">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <button name="filter_submit" class="btn btn-sm btn-inverse-success"><span class="fa fa-search"></span></button>
                  <button name="filter_reset" class="btn btn-sm btn-inverse-secondary"><span class="fa fa-refresh"></span></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <hr>
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <div class="filter">
              <small class="text-danger ml-2">cari konsumen</small>
            </div>
            <form action="<?= base_url('kartukontrol/list') ?>" method="post">
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
                  <th>SPR</th>
                  <th>Konsumen</th>
                  <th>unit</th>
                  <th>Status Transaksi</th>
                  <th>Status Diterima</th>
                  <th>Diterima Oleh</th>
                  <th>Tgl dibuat</th>
                  <th>Pembuat</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($transaksi)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($transaksi as $key => $value) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $value['no_spr'] ?></td>
                      <td><?= $value['nama_lengkap'] ?></td>
                      <td><?= $value['nama_unit'] ?></td>
                      <td><span class="badge badge-primary"><?= $value['status_transaksi'] == '0' ? 'proses' : 'selesai'; ?></span></td>
                      <td><span class="badge badge-success"><?= $value['status_diterima'] == 'terima' ? 'diterima' : 'ditolak' ?></span></td>
                      <td><?= $value['nama_penerima'] ?></td>
                      <td><?= date('d-m-Y', strtotime($value['tgl_transaksi'])) ?></td>
                      <td><?= $value['nama_pembuat'] ?></td>
                      <td>
                        <a href="<?= base_url("kartukontrol/detail/" . $value['id_transaksi']) ?>" class="btn btn-icons btn-inverse-info"><i class="fa fa-info"></i></a>
                        <button class="btn btn-icons btn-inverse-danger" onclick="deleteItem('<?= base_url('kartukontrol/hapus/' . $value['id_transaksi']) ?>','hapus')"><i class="fa fa-trash"></i></button>
                        <?php if ($value['status_diterima'] == 'tolak') { ?>
                          <button class="btn btn-sm btn-danger alasan_kartu_kontrol" data-id="<?= $value['id_transaksi'] ?>">alasan</button>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal_kontrol">
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