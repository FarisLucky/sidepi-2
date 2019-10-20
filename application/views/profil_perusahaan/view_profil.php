<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="dark txt_title d-inline-block mt-2">Setting Perusahaan</h4>
              </div>
            </div>
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
                <h5><i class="fa fa-m"></i>Kelola Perusahaan</h5>
              </div>
            </div>
            <hr>
            <form id="form_perusahaan" action="<?= base_url() ?>profilperusahaan/update" method="post"
              enctype="multipart/form-data">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash() ?>">
              <input type="hidden" name="txt_id" value="<?php $id = $perusahaan['id_perusahaan']; echo $id; ?>">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="txti_siup">SIUP</label>
                    <input type="text" name="txt_siup" class="form-control" value="<?= $perusahaan['siup'] ?>"
                      placeholder="SIUP" readonly>
                    <small class="text-danger"><?= form_error("txt_siup") ?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="txti_tdp">TDP</label>
                    <input type="text" name="txt_tdp" class="form-control"
                      value="<?= $perusahaan['tanda_daftar_perusahaan'] ?>" placeholder="Tanda Daftar Perusahan"
                      readonly>
                    <small class="text-danger"><?= form_error("txt_tdp") ?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="txti_namaperusahaan">Nama Perusahaan</label>
                    <input type="text" name="txt_namaperusahaan" class="form-control" value="<?= $perusahaan['nama'] ?>"
                      placeholder="Nama Perusahaan" readonly>
                    <small class="text-danger"><?= form_error("txt_namaperusahaan") ?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="txti_email">Email</label>
                    <input type="text" name='txt_email' class="form-control" value="<?= $perusahaan['email'] ?>"
                      placeholder="Email" readonly>
                    <small class="text-danger"><?= form_error("txt_email") ?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="txti_telp">Telp</label>
                    <input type="number" name="txt_telp" class="form-control" id="txt_telp"
                      value="<?= $perusahaan['telepon'] ?>" placeholder="Telepon" readonly>
                    <small class="text-danger"><?= form_error("txt_telp") ?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="txt_alamat">Alamat</label>
                    <textarea class="form-control" name="txt_alamat" id="txt_alamat" rows="3"
                      readonly><?= $perusahaan['alamat'] ?></textarea>
                    <small class="text-danger"><?= form_error("txt_alamat") ?></small>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Logo</label><br>
                    <a href="<?= base_url().'assets/uploads/images/profil/'.$perusahaan['logo_perusahaan'] ?>"
                      data-lightbox="example"><img id="logo_perusahaan" width="150px"
                        src="<?= base_url().'assets/uploads/images/profil/'.$perusahaan['logo_perusahaan'] ?>"></a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <button type="button" id="btn_ubah_profil" class="btn btn-info mr-2 float-right"
                    onclick="ubahPerusahaan(this)"><i class="fa fa-pencil-square-o"></i> ubah</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>