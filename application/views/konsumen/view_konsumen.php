<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-sm-6">
                <h4 class="dark txt_title d-inline-block mt-2">Konsumen</h4>
              </div>
              <?php if ($this->session->flashdata('category_success')) { ?>
              <div class="col-sm-6">
                <div class="alert alert-success"> <?= $this->session->flashdata('edit_success') ?> </div>
              </div>
              <?php } ?>
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
                <h5 class="d-inline-block"><i class="fa fa-m"></i>Data Konsumen</h5>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <div class="table-responsive">
                  <table class="table table-hover" id="tbl_konsumen">
                    <thead>
                      <tr>
                        <th>Id Card</th>
                        <th>Konsumen</th>
                        <th>Jenis Kelamin</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Alamat</th>
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
  </div>
</div>