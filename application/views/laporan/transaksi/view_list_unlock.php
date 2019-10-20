<div class="content-wrapper" id="laporan_unlock_transaksi">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">List Unlock Transaksi</h4>
            <img id="logo_perusahaan" width="50px" src="<?php echo base_url() . 'assets/uploads/images/properti/' . $img->logo_perusahaan ?>" class="float-right" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12">
                <h5 class="d-inline">List Unlock Transaksi Unit</h5>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-hover table-bordered" id="tbl_to_tables">
                  <thead class="thead-light">
                    <tr>
                      <th>No SPR</th>
                      <th>Konsumen</th>
                      <th>Unit</th>
                      <th>Tanggal Transaksi</th>
                      <th>Status</th>
                      <th>Pembuat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($transaksi as $key => $value) {
                      if ($value->status_transaksi == "p") {
                        $status = 'Progress';
                      } elseif ($value->status_transaksi == "s") {
                        $status = 'Sementara';
                      } else {
                        $status = 'Selesai';
                      }
                      ?>
                      <tr>
                        <td><?= $value->no_spr ?></td>
                        <td><?= $value->nama_lengkap ?></td>
                        <td><?= $value->nama_unit ?></td>
                        <td><?= $value->tgl_transaksi ?></td>
                        <td><?= '<div class="badge badge-primary">' . $status . '</badge>' ?></td>
                        <td><?= $value->pembuat ?></td>
                        <td>
                          <a href="<?= base_url('listunlocktransaksi/getdetail/' . $value->id_transaksi) ?>" class="btn btn-icons btn-inverse-info mx-2"><i class="fa fa-info"></i></a>
                          <button class="btn btn-icons btn-inverse-danger btn-hapus" onclick="setItem('<?= base_url('listunlocktransaksi/hapus/' . $value->id_transaksi) ?>','Hapus')"><i class="fa fa-trash"></i></button>
                          <?php if ($_SESSION["id_akses"] == 1) { ?>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>