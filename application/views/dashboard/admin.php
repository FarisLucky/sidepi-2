<div class="content-wrapper">
  <div class="row mt-4">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-widgets text-danger icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right">Unit Belum Terjual</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0"><?= $total_unit['total'] ?></h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-account-convert text-warning icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right">Penjualan Hari ini</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0"><?= $unit_terjual['total'] ?></h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Total Hari ini
            <?= tanggal(date('d'),date('m'),date('Y')) ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-chevron-double-right text-success icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right">Calon</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0">
                  <?= $total_calon['total'] ?></h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Total Hari
            <?= tanggal(date('d'),date('m'),date('Y')) ?>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
      <div class="card card-statistics">
        <div class="card-body">
          <div class="clearfix">
            <div class="float-left">
              <i class="mdi mdi-chevron-double-left text-info icon-lg"></i>
            </div>
            <div class="float-right">
              <p class="mb-0 text-right">Total Calon</p>
              <div class="fluid-container">
                <h3 class="font-weight-medium text-right mb-0"><?= $total_semua_calon['total'] ?>
                </h3>
              </div>
            </div>
          </div>
          <p class="text-muted mt-3 mb-0">
            <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Total Bulan <?= bulan(date('m')) ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>