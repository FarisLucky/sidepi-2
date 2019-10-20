<div class="content-wrapper" id="detail_kontrol">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Detail Transaksi</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <small style="font-size: 15px;">Status Transaksi : </small>
            <small class="badge badge-primary" style="font-size: 14px;">
              <?= ($transaksi->status_transaksi == 's') ? 'Sementara' : ($transaksi->status_transaksi == 'p') ? 'Progress' : 'Selesai' ?>
            </small>
            <a href="<?= base_url() . 'kartukontrol' ?>" class="btn btn-dark float-right"><i class="fa fa-arrow-circle-left"></i>
              Kembali</a>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12 text-center">
            <h6 class="ttl_um">Semua Pembayaran</h6>
          </div>
          <?php if ($transaksi->status_transaksi != 'sl') { ?>
            <div class="col-sm-12">
              <button class="btn btn-sm btn-success float-right" onclick="setItem('<?= base_url('kartukontrol/selesai/' . $transaksi->id_transaksi) ?>','Confirm')"><i class="fa fa-check"></i>
                Approve Selesai</button>
            </div>
          <?php } ?>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-12">
            <div class="row mb-1">
              <div class="col-md-6">
                <small class="txt-normal font-weight-semibold">Total Kesepakatan</small>
                <small class='txt-normal'><?php echo number_format($transaksi->total_kesepakatan, 2, ',', '.') ?></small>
              </div>
              <div class="col-md-6">
                <small class="txt-normal font-weight-semibold">Total Pemasukan</small>
                <small class="txt-normal"><?= number_format($realisasi->pemasukan, 2, ",", ".") ?></small>
              </div>
            </div>
            <hr>
            <div class="row mb-1">
              <div class="col-md-6">
                <small class="txt-normal font-weight-semibold">Tanda Jadi</small>
                <small class='txt-normal'><?php echo number_format($transaksi->total_tanda_jadi, 2, ",", ".") ?></small>
              </div>
              <div class="col-md-6">
                <small class="txt-normal font-weight-semibold">Realisasi Bayar</small>
                <small class='txt-normal'><?php echo number_format($bayar_tj->tanda_jadi, 2, ",", ".") ?></small>
              </div>
            </div>
            <hr>
            <div class="row mb-1">
              <div class="col-md-6">
                <small class="txt-normal font-weight-semibold">Uang Muka / periode</small>
                <small class='txt-normal'><?php echo number_format($transaksi->total_uang_muka, 2, ",", ".") . " / " . $transaksi->periode_uang_muka ?></small>
              </div>
              <div class="col-md-6">
                <small class="txt-normal font-weight-semibold">Realisasi Bayar</small>
                <small class='txt-normal'><?php echo number_format($bayar_um->uang_muka, 2, ",", ".") ?></small>
              </div>
            </div>
            <hr>
            <div class="row mb-1">
              <div class="col-md-6">
                <small class="txt-normal font-weight-semibold">Cicilan / periode</small>
                <small class='txt-normal'><?php echo number_format($transaksi->total_cicilan, 2, ",", ".") . " / " . $transaksi->periode_cicilan ?></small>
              </div>
              <div class="col-md-6">
                <small class="txt-normal font-weight-semibold">Realisasi Bayar</small>
                <small class='txt-normal'><?php echo number_format($bayar_cicilan->cicilan, 2, ",", ".") ?></small>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Nama</th>
                  <th>jenis Bayar</th>
                  <th>Tagihan</th>
                  <th>Bayar</th>
                  <th>Status</th>
                  <th>Hutang</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  foreach ($detail_kontrol as $key => $value) {
                    $status = $value->status == 'b' ? 'Belum Bayar' : 'Sudah Bayar';
                    $badge = $value->status == 'b' ? 'badge-danger' : 'badge-success';
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $value->nama_pembayaran ?></td>
                      <td><?= $value->nama_jenis ?></td>
                      <td><?= number_format($value->total_tagihan, 2, ',', '.') ?></td>
                      <td><?= number_format($value->total_bayar, 2, ',', '.') ?></td>
                      <td><span class="badge <?= $badge ?>"><?= $status ?></span></td>
                      <td><?= number_format($value->hutang, 2, ',', '.') ?></td>
                      <td>
                        <a href="<?= base_url('kartukontrol/history/' . $value->id_pembayaran) ?>" class="btn btn-icons btn-inverse-info"><i class="fa fa-info"></i></a>
                        <a href="<?= base_url('kartukontrol/print/' . $value->id_pembayaran) ?>" class="btn btn-icons btn-inverse-warning"><i class="fa fa-print"></i></a>
                      </td>
                    </tr>
                  <?php $no++;
                  };  ?>
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
<div class="modal fade" id="modal_detail_kontrol">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <small class="txt-normal user">User : </small><br>
            <small class="txt-normal tgl_bayar">Tanggal Bayar : </small><br>
            <small class="txt-normal tgl_tempo">Tanggal Tempo : </small><br>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <small class="txt-normal">Bukti Bayar</small><br>
            <img src="" class="img-base" width="100%" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>