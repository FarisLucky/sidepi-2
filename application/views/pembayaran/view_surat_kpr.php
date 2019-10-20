<div class="content-wrapper" id="view_surat_kpr">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Surat SP3K</h4>
          </div>
        </div>
      </div>
    </div>
    <br>
    <form action="<?php echo base_url('pembayaran/coresuratkpr') ?>" method="post" enctype="multipart/form-data"
      id="kpr_form">
      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
        value="<?= $this->security->get_csrf_hash(); ?>">
      <input type="hidden" name="input_hidden" value="<?= $id ?>">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <a href="<?= base_url("pembayaran/cicilan") ?>" class="btn btn-dark float-right"><i
                  class="fa fa-arrow-circle-left"></i>
                Kembali</a>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-12">
              <label for="">Upload Surat</label>
            </div>
          </div>
          <br>
          <div class="row justify-content-md-center">
            <div class="col-sm-6">
              <?php if ($trans['sp3k'] == "") { ?>
              <small class="txt-semi-high ml-3 p-2 border border-dark">Belum Upload</small>
              <?php } else { ?>
              <small class="txt-semi-high ml-3 p-2 border border-dark">Sudah Upload</small>
              <?php } ?>
            </div>
          </div>
          <br>
          <?php if (!file_exists('assets/uploads/files/spk/'.$trans['sp3k'])) { ?>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <input type="file" name="upload" class="form-control">
                <small class="text-danger"><?php echo ($error != null) ? $error : "" ; ?></small>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan</button>
              <button type="reset" class="btn btn-sm btn-secondary"><i class="fa fa-refresh"></i> Reset</button>
            </div>
          </div>
          <?php } else { ?>
          <div class="row">
            <div class="col-sm-12">
              <a href="<?= base_url('pembayaran/printspk/'.$trans['id_transaksi']) ?>" class="btn btn-sm btn-warning"><i
                  class="fa fa-print"></i> Print</a>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </form>
  </div>
</div>