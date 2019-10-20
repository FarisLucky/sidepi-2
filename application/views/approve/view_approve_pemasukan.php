<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Approve Pemasukan</h4>
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
                  <th>Nama Pemasukan</th>
                  <th>Kelompok</th>
                  <th>Jumlah</th>
                  <th>Harga Satuan</th>
                  <th>Total Harga</th>
                  <th>Bukti</th>
                  <th>Tanggal Buat</th>
                  <th>Status Manager</th>
                  <th>Pembuat</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($approve_bayar as $key => $value) :
                    if ($value->bukti_kwitansi != '') {
                      $img = '<a href="' . base_url('assets/uploads/images/pengeluaran/' . $value->bukti_kwitansi) . '" data-lightbox="' . $value->id_pemasukan . '"><img src="' . base_url('assets/uploads/images/pengeluaran/' . $value->bukti_kwitansi) . '"></a>';
                    } else {
                      $img = '<i>Belum Upload</i>';
                    } ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $value->nama_pemasukan ?></td>
                      <td><?= $value->nama_kelompok ?></td>
                      <td><?= $value->volume . ' ' . $value->satuan ?></td>
                      <td><?= $value->harga_satuan ?></td>
                      <td><?= $value->total_harga ?></td>
                      <td><?= $img ?></td>
                      <td>
                        <?php $date = DateTime::createFromFormat('Y-m-d', $value->tgl_buat);
                          echo tanggal($date->format('d'), $date->format('m'), $date->format('Y')) ?>
                      </td>
                      <td><span class="badge badge-info"><?= $value->status_manager == 's' ? '-' : ($value->status_manager == 'p' ? 'pending' : 'selesai'); ?></span>
                      </td>
                      <td><?php echo $value->nama_lengkap; ?></td>
                      <td>
                        <button type="button" class="btn btn-icons btn-inverse-primary ml-2" onclick="setItem('<?= base_url('approvepemasukan/accept/' . $value->id_pemasukan) ?>','Terima')">
                          <i class="fa fa-check"></i></button>
                        <button type="button" class="btn btn-icons btn-inverse-danger" onclick="setItem('<?= base_url('approvepemasukan/reject/' . $value->id_pemasukan) ?>','Tolak')">
                          <i class="fa fa-ban"></i></button>
                      </td>
                    </tr>
                  <?php $no++;
                  endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
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