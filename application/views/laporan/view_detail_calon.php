<div class="content-wrapper" id="detail_calon">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Detail Calon</h4>
            <a href="<?= base_url('laporancalon') ?>" class="btn btn-dark float-right"><i
                class="fa fa-arrow-circle-left"></i> Kembali</a>
          </div>
        </div>
      </div>
    </div>
    <!-- End Title  -->
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block">Data Diri</h5>
            <a href="#collapseOne" class="float-right" data-toggle="collapse" aria-expended="true"><i
                class="fa fa-circle"></i></a>
          </div>
        </div>
        <hr>
        <div id="collapseOne" class="collapse show">
          <div class="row">
            <div class="col-sm-12">
              <div class="alert alert-info">
                <h5>Data konsumen</h5>
                <hr>
                <div class="row">
                  <div class="col-sm-12">
                    <small class="txt-semi-high">Id Card :</small>
                    <small
                      class="txt-semi-high wht-medium"><?= strtoupper($konsumen['id_type']).' '.$konsumen['id_card'] ?></small>
                  </div>
                  <div class="col-sm-12">
                    <small class="txt-semi-high">Nama :</small>
                    <small class="txt-semi-high wht-medium"><?= $konsumen['nama_lengkap'] ?></small>
                  </div>
                  <div class="col-sm-12">
                    <small class="txt-semi-high">Jenis Kelamin :</small>
                    <small
                      class="txt-semi-high wht-medium"><?= $konsumen['jenis_kelamin'] == 'l' ? 'Laki-Laki' : 'Perempuan'; ?></small>
                  </div>
                  <div class="col-sm-12">
                    <small class="txt-semi-high">Telepon :</small>
                    <small class="txt-semi-high wht-medium"><?= $konsumen['telp'] ?></small>
                  </div>
                  <div class="col-sm-12">
                    <small class="txt-semi-high">Email :</small>
                    <small class="txt-semi-high wht-medium"><?= $konsumen['email'] ?></small>
                  </div>
                  <div class="col-sm-12">
                    <small class="txt-semi-high">Tgl Buat :</small>
                    <small class="txt-semi-high wht-medium"><?= $konsumen['tgl_buat'] ?></small>
                  </div>
                  <div class="col-sm-12">
                    <small class="txt-semi-high">Alamat :</small>
                    <small class="txt-semi-high wht-medium"><?= $konsumen['alamat'] ?></small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Data Konsumen -->
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block">Follow Konsumen</h5>
            <a href="#collapseTwo" class="float-right" data-toggle="collapse" aria-expended="true"><i
                class="fa fa-circle"></i></a>
          </div>
        </div>
        <hr>
        <div id="collapseTwo" class="collapse">
          <div class="row">

            <?php $no = 1; if (!empty($follow)) {
             foreach ($follow as $key => $value) { ?>
            <div class="col-md-6">
              <div class="alert alert-success">
                <h5>Follow <?= $no ?></h5>
                <div class="row">
                  <div class="col-md-12">
                    <small class="txt-semi-high">Media</small>
                    <small class="txt-semi-high wht-medium"><?= $value['media'] ?></small>
                  </div>
                  <div class="col-md-12">
                    <small class="txt-semi-high">Tanggal</small>
                    <small class="txt-semi-high wht-medium"><?= $value['tgl_follow'] ?></small>
                  </div>
                  <div class="col-md-12">
                    <small class="txt-semi-high">Hasil</small>
                    <small
                      class="txt-semi-high wht-medium"><?= $value['hasil_follow'] == 'bs' ? 'Belum Selesai' : 'Selesai' ; ?></small>
                  </div>
                  <div class="col-md-12">
                    <small class="txt-semi-high">Keterangan</small>
                    <small class="txt-semi-high wht-medium"><?= $value['keterangan'] ;  ?></small>
                  </div>
                </div>
              </div>
            </div>
            <?php $no++; } } else { ?>
            <div class="col-md-6">
              <div class="alert alert-success">
                <h4>Data Kosong</h4>
              </div>
            </div>
            <?php } ?>

          </div>
        </div>
      </div>
    </div>
    <!-- End Follow -->
  </div>
</div>