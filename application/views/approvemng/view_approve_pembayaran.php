<div class="content-wrapper" id="approve_bayar">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Approve Pembayaran</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Pembayaran</th>
                  <th>Unit</th>
                  <th>Jumlah Bayar</th>
                  <th>Rekening</th>
                  <th>Status Owner</th>
                  <th>Tanggal Bayar</th>
                  <th>Bukti</th>
                  <th>Pembuat</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($approve_bayar)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($approve_bayar as $key => $value) :
                    if ($value->bukti_bayar != '') {
                      $img = '<img src="' . base_url('assets/uploads/images/pembayaran/' . $value->bukti_bayar) . '">';
                    } else {
                      $img = '<i>Belum Upload</i>';
                    }
                    ?>
                    <tr>
                      <td><?= $value->nama_pembayaran ?></td>
                      <td><?= $value->nama_unit ?></td>
                      <td> <?= number_format($value->jumlah_bayar, 2, ',', '.') ?></td>
                      <td><?= $value->no_rekening . " " . $value->bank ?></td>
                      <td><span class="badge badge-info"><?= $value->status_owner == 's' ? '-' : ($value->status_owner == 'p' ? 'pending' : 'selesai'); ?></span>
                      </td>
                      <td><?= $value->tgl_bayar ?></td>
                      <td><?= $img ?>
                      <td><?php echo $value->nama_lengkap; ?></td>
                      </td>
                      <td>
                        <button type="button" class="btn btn-icons btn-inverse-primary ml-2" onclick="setItem('<?= base_url('mngapprove/accept/' . $value->id_detail) ?>','Terima')">
                          <i class="fa fa-check"></i></button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
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

<!-- Modal -->
<div class="modal fade" id="modal_approve_pembayaran">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 text-center">
            <h6>Angsuran</h6>
          </div>
        </div>
        <div class="row m-3">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="">Nama Properti</label>
              <input type="text" class="form-control" name="properti" disabled>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="">Nama Unit</label>
              <input type="text" class="form-control" name="unit" disabled>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="">Tanggal Jatuh Tempo</label>
              <input type="text" class="form-control" name="tgl_tempo" disabled>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="">Tanggal Bayar</label>
              <input type="text" class="form-control" name="tgl_bayar" disabled>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="">Total Tagihan</label>
              <input type="text" class="form-control" name="tagihan" disabled>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="">Jumlah Bayar</label>
              <input type="text" class="form-control" name="bayar" disabled>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="">Hutang</label>
              <input type="text" class="form-control" name="hutang" disabled>
            </div>
          </div>
          <hr>
          <div class="col-sm-12 image">
            <img src="" alt="" class="img-responsive gambar_bukti" width="100%">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>