<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <h4 class="dark txt_title d-inline-block mt-2">Kelola RAB Bangunan</h4>
        <?php if ($_SESSION['id_user'] == 1) { ?>
          <a href="<?= base_url() . 'properti' ?>" class="btn btn-dark float-right"><i class="fa fa-arrow-circle-left"></i>
            Lihat Properti</a>
        <?php } ?>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body p-4">
        <h4 class="mb-3">Data RAB Unit </h4>
        <div class="row">
          <div class="col-sm-12">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="txt_names">Nama Rab</label>
                <input type="text" name="nama_rab" value="<?php echo $rab_unit->nama_rab ?> " class="form-control" id="txt_names" readonly>
              </div>
              <div class="form-group col-md-6">
                <label for="txt_total">Total Anggaran</label>
                <input type="text" name="total_anggaran" value="<?php echo number_format($rab_unit->total_anggaran, 2, ',', '.') ?> " class="form-control" id="txt_total" readonly>
              </div>
            </div>
          </div>
          <div class="col-sm-12 button">
            <?php if ($_SESSION['id_user'] == 1) { ?>
              <a href="#" data-target="#modal_dialog" data-toggle="modal" class="btn btn-info mr-2"><i class="fa fa-edit"></i> Ubah</a>
            <?php } ?>
            <a href="<?= base_url("rab/printrab/" . $rab_unit->id_rab) ?>" class="btn btn-warning"><i class="fa fa-print"></i> Print</a>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block"><i class="fa fa-m"></i>Kelola RAB</h5>
            <a href="<?= base_url() ?>rab/tambahunit/<?= $rab_unit->id_rab ?>" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i>Tambah</a>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead clas="table-primary">
                  <th>No</th>
                  <th>Nama Detail</th>
                  <th>Volume</th>
                  <th>Satuan</th>
                  <th>Harga Satuan</th>
                  <th>Total Harga</th>
                  <th>Kelompok</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($kelola_rab)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($kelola_rab as $k) {
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $k->nama_detail ?></td>
                      <td><?php echo $k->volume ?></td>
                      <td><?php echo $k->satuan ?></td>
                      <td><?php echo number_format($k->harga_satuan, 2, ',', '.') ?></td>
                      <td><?php echo number_format($k->total_harga, 2, ',', '.') ?></td>
                      <td><?php echo $k->kelompok_pengeluaran ?></td>
                      <td><a href="<?= base_url() . 'rab/editunit' ?>/<?= $k->id_detail ?>" class="btn btn-sm btn-primary mx-2"><i class="fa fa-edit"></i> Edit</a><button type="button" class="btn btn-sm btn-danger" onclick="deleteItem('<?= base_url('rab/hapus/' . $k->id_detail) ?>')"><i class="fa fa-trash"></i>
                          Delete</a></td>
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

<div class="modal fade" id="modal_dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Ubah Data RAB</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url() ?>rab/ubahrab" method="post" id="form_modal">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
          <input type="hidden" name="input_hidden" value="<?= $rab_properti['id_rab'] ?>">
          <input type="hidden" name="input_hidden2" value="<?= $rab_properti['id_properti'] ?>">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Nama Rab</label>
                <input type="text" name="nama_rab" id="nama_rab" value="<?php echo $rab_properti['nama_rab'] ?> " class="form-control">
              </div>
              <input type="submit" class="btn btn-success" name="properti" value="Simpan">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>