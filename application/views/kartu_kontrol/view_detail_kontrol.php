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
            <small class="badge badge-primary" style="font-size: 13px;">
              <?= ($transaksi->status_transaksi == '0') ? 'Proses' : 'Selesai' ?>
            </small>
            <a href="<?= base_url() . 'kartukontrol' ?>" class="btn btn-dark float-right"><i class="fa fa-arrow-circle-left"></i>
              Kembali</a>
          </div>
        </div>
        <hr>
        <?php if ($transaksi->status_transaksi != '1') { ?>
          <div class="d-flex">
            <button class="btn btn-sm btn-success float-right" onclick="setItem('<?= base_url('kartukontrol/selesai/' . $transaksi->id_transaksi) ?>','Confirm')"><i class="fa fa-check"></i>
              Approve Selesai</button>
          </div>
        <?php } ?>
        <div class="row">
          <div class="col-sm-12 text-center">
            <h6 class="ttl_um">Data Pembayaran</h6>
          </div>
        </div>
        <hr>
        <div class="d-flex flex-column flex-md-row justify-content-between">
          <div>
            <small class="txt-normal font-weight-semibold">Tanggal Transaksi</small>
            <small class='txt-normal'><?php echo date('d-m-Y', strtotime($transaksi->tgl_transaksi)) ?></small>
          </div>
          <div>
            <small class="txt-normal font-weight-semibold">Pembuat</small>
            <small class='txt-normal'><?php echo $transaksi->pembuat ?></small>
          </div>
        </div>
        <hr>
        <div class="d-flex flex-column flex-md-row justify-content-between">
          <div>
            <small class="txt-normal font-weight-semibold">Nama Konsumen</small>
            <small class='txt-normal'><?php echo $transaksi->nama_konsumen ?></small>
          </div>
          <div>
            <small class="txt-normal font-weight-semibold">Nama Unit</small>
            <small class='txt-normal'><?php echo $transaksi->nama_unit ?></small>
          </div>
          <div>
            <small class="txt-normal font-weight-semibold">Harga Unit</small>
            <small class='txt-normal'><?php echo number_format($transaksi->harga_unit, 2, ',', '.'); ?></small>
          </div>
        </div>
        <hr>
        <div class="d-flex flex-column flex-md-row justify-content-between">
          <div>
            <small class="txt-normal font-weight-semibold">Total Kesepakatan</small>
            <small class="txt-normal"><?php echo number_format($transaksi->total_kesepakatan, 2, ',', '.') ?></small>
          </div>
          <div>
            <small class="txt-normal font-weight-semibold">Total Semua Pemasukan</small>
            <small class="txt-normal"><?= number_format($realisasi->pemasukan, 2, ",", ".") ?></small>
          </div>
        </div>
        <hr class="bg-danger">
        <div class="d-flex flex-column flex-md-row justify-content-between">
          <div>
            <small class="txt-normal font-weight-semibold">Tanda Jadi</small>
            <small class='txt-normal'><?php echo number_format($transaksi->total_tanda_jadi, 2, ",", ".") . ' (' . $transaksi->tanda_jadi ?> harga jual)</small>
          </div>
          <div>
            <small class="txt-normal font-weight-semibold">Realisasi Bayar</small>
            <small class='txt-normal'><?php echo number_format($bayar_tj->tanda_jadi, 2, ",", ".") ?></small>
          </div>
        </div>
        <hr>
        <div class="d-flex flex-column flex-md-row justify-content-between">
          <div>
            <small class="txt-normal font-weight-semibold">Uang Muka / periode</small>
            <small class='txt-normal'><?php echo number_format($transaksi->total_uang_muka, 2, ",", ".") . " / " . $transaksi->periode_uang_muka ?></small>
          </div>
          <div>
            <small class="txt-normal font-weight-semibold">Realisasi Bayar</small>
            <small class='txt-normal'><?php echo number_format($bayar_um->uang_muka, 2, ",", ".") ?></small>
          </div>
        </div>
        <hr>
        <div class="d-flex flex-column flex-md-row justify-content-between">
          <div>
            <small class="txt-normal font-weight-semibold">Cicilan / periode</small>
            <small class='txt-normal'><?php echo number_format($transaksi->total_cicilan, 2, ",", ".") . " / " . $transaksi->periode_cicilan ?></small>
          </div>
          <div>
            <small class="txt-normal font-weight-semibold">Realisasi Bayar</small>
            <small class='txt-normal'><?php echo number_format($bayar_cicilan->cicilan, 2, ",", ".") ?></small>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-sm-12 text-center">
            <h6 class="ttl_um">Detail Pembayaran</h6>
          </div>
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Nama</th>
                  <th>Tagihan</th>
                  <th>Bayar</th>
                  <th>Hutang</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  foreach ($detail_kontrol as $key => $value) {
                    $badge = $value->status == 'b' ? 'badge-danger' : 'badge-success';
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $value->nama_pembayaran ?></td>
                      <td><?= number_format($value->total_tagihan, 2, ',', '.') ?></td>
                      <td><?= number_format($value->total_bayar, 2, ',', '.') ?></td>
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