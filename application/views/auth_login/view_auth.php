<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login || Sidepi</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/custom/toastr/toastr.min.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" />
  <style>
  .title-login {
    display: inline-block;
    font-size: 23px;
    font-weight: 500;
    color: #535461;
    text-shadow: 0.3px 0.5px 1px rgba(66, 165, 245, 0.72);
    padding-bottom: 5px;
    border-bottom: 1.5px solid rgba(83, 84, 97, 0.72);
  }

  .auto-form-wrapper {
    box-shadow: 5px 5px 30px 11.3px rgba(8, 143, 220, 0.2) !important;
    padding: 50px !important;
  }

  .form {
    margin-top: 75px;
    margin-left: 25px;
  }

  @media only screen and (max-width : 700px) {
    .img {
      text-align: center;
      width: 400px;
    }

    .auto-form-wrapper {
      padding: 20px !important;
    }

    .form {
      margin: 0px;
    }
  }
  </style>
</head>

<body>
  <div class="flash-data" flash-error="<?= $this->session->flashdata("error") ?>"></div>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-md-6">
            <img src="<?= base_url('assets/custom/bg-login2.png') ?>" alt="" class="img">
          </div>
          <div class="col-md-6 mx-auto mt-4">
            <div class="form">
              <div class="row">
                <div class="col-sm-12 text-center">
                  <h4 class="title-login text-center">Silahkan login</h4>
                </div>
              </div>
              <br>
              <div class="auto-form-wrapper mx-auto w-75 py-5">
                <form action="<?= base_url("auth/corelogin") ?>" id="form_logins" method="post">
                  <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash() ?>">
                  <div class="form-group">
                    <label class="label">Username</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="auth_user" name="auth_user" placeholder="Username">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                    <small class="text-danger"><?php echo form_error("auth_user") ?></small>
                  </div>
                  <div class="form-group">
                    <label class="label">Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control" name="auth_pass" id="auth_pass"
                        placeholder="*********">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                    <small class="text-danger"><?php echo form_error("auth_pass") ?></small>
                  </div>
                  <br>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <!-- plugins:js -->
  <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.addons.js"></script>
  <script src="<?= base_url() ?>assets/custom/toastr/toastr.min.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
  <script src="<?= base_url() ?>assets/js/misc.js"></script>

  <!-- endinject -->
  <script src="<?= base_url() ?>assets/custom/js/indexing.js"></script>
</body>

</html>