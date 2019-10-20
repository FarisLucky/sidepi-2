<div class="content-wrapper" id="view_pengeluaran">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Laporan Pemasukan </h4>
            <img id="logo_perusahaan" width="50px"
              src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right"
              alt="">
          </div>
        </div>
        <hr>
        <form action="<?php echo base_url('laporanpengeluaran/printall') ?>" method="post">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
            value="<?= $this->security->get_csrf_hash() ?>">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="form-group">
                <label for="unit_id">Pilih Kelompok</label>
                <select name="id_kelompok" id="id_kelompok" class="form-control text-center">
                  <option value=""> -- Kelompok -- </option>
                  <?php foreach ($kelompok as $key => $value) { ?>
                  <option value="<?= $value->id_kelompok ?>"><?= $value->nama_kelompok ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" name="tgl_mulai" class="form-control" id="tgl_mulai">
              </div>
            </div>
            <div class="col-md-3 col-sm-12">
              <div class="form-group">
                <label>Tanggal Akhir</label>
                <input type="date" name="tgl_akhir" class="form-control" id="tgl_akhir">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <button type="button"
                onclick="searchData(['id_kelompok','tgl_mulai','tgl_akhir'],'<?= $this->security->get_csrf_hash() ?>','#tbl_laporan_pemasukan','<?= base_url('laporanpemasukan/dataproses') ?>')"
                class="btn btn-primary" id="search_kontrol"><i class="fa fa-search"></i>Search</button>
              <button type="submit" class="btn btn-warning"><i class="fa fa-print"></i>Print</button>
            </div>
          </div>
        </form>
        <?php if ($_SESSION['id_user'] != "1") { ?>
        <hr>
        <div class="row my-2">
          <div class="col-sm-12">
            <small class="text-normal"> * <small class="text-primary">Laporan ditampilkan Berdasarkan Properti yang
                sedang dikelola</small></small>
          </div>
        </div>
        <?php } ?>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="tbl_to_tables">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Pemasukan</th>
                    <th>Kelompok</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                    <th>Pembuat</th>
                    <th>Tanggal Buat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>