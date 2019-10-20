<div class="content-wrapper" id="view_password">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <h4 class="txt_title d-inline pt-2">Ganti Password</h4>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <form action="<?= base_url("profileuser/corepassword") ?>" method="POST" id="form_password">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
            value="<?= $this->security->get_csrf_hash() ?>">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="pass_lama">Password Lama</label>
                <input type="password" name="pass_lama" class="form-control" id="pass_lama" required>
                <small class="text-danger"><?= form_error('pass_lama') ?></small>
                <div class="form-check form-check-flat my-1">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="show_pw2"
                      onclick="showPass(this,'pass_lama')">Show Password
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="pass_baru">Password Baru</label>
                <input type="password" name="pass_baru" id="pass_baru" class="form-control" required>
                <small class="text-danger"><?= form_error('pass_baru') ?></small>
                <div class="form-check form-check-flat my-1">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="show_pw1"
                      onclick="showPass(this,'pass_baru')">Show Password
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="pass_confirm">Confirm Password Baru</label>
                <input type="password" name="confirm_pass_baru" class="form-control" id="confirm_pass_baru" required>
                <small class="text-danger"><?= form_error('confirm_pass_baru') ?></small>
                <div class="form-check form-check-flat my-1">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="show_pw3"
                      onclick="showPass(this,'confirm_pass_baru')">Show Password
                  </label>
                </div>
              </div>
              <hr>
              <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan</button>
              <button type="reset" class="btn btn-sm btn-secondary"><i class="fa fa-refresh"></i> Reset</button>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
</div>