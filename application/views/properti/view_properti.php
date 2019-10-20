<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Kelola Properti</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block"><i class="fa fa-m"></i>Table Properti</h5>
            <a href="<?= base_url() ?>properti/tambah" class="btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
        <hr>
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <form action="<?= base_url('properti') ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
              <div class="form-row m-0">
                <div class="col-7">
                  <input type="text" name="search" class="form-control form-control-sm">
                </div>
                <div class="col-auto">
                  <button name="submit" class="btn btn-sm btn-inverse-success"><span class="fa fa-search"></span></button>
                </div>
                <div class="col-auto">
                  <button name="reset" class="btn btn-sm btn-inverse-secondary"><span class="fa fa-refresh"></span></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-borderless table-striped table-hover" id="tbl_propertis">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Nama</th>
                  <th>Luas Tanah</th>
                  <th>Rekening</th>
                  <th>Bank</th>
                  <th>Status</th>
                  <th>Foto</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($properti)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($properti as $value) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $value->nama_properti ?></td>
                      <td><?= $value->luas_tanah ?></td>
                      <td><?= $value->no_rekening ?></td>
                      <td><?= $value->bank ?></td>
                      <td><span class="badge badge-warning"><?= $value->status ?></span></td>
                      <td><?= '<a href="' . base_url() . 'assets/uploads/images/properti/' . $value->foto_properti . '" data-lightbox="example' . $value->id_properti . '" data-title="' . $value->nama_properti . '"><img src="' . base_url() . 'assets/uploads/images/properti/' . $value->foto_properti . '"></a>' ?></td>
                      <td>

                        <?php if ($value->status != 'publish') { ?>
                          <a href="' . base_url() . 'properti/detailproperti/' . $value->id_properti . '" class="btn btn-icons btn-inverse-info mr-1" id="detail_data_properti"><i class="fa fa-info"></i></a><button type="button" class="btn btn-icons btn-inverse-danger mr-1" onclick="deleteItem('<?= base_url('properti/hapus/' . $value->id_properti) ?>')"><i class="fa fa-trash"></i></button><button type="button" class="btn btn-sm btn-warning" onclick="setItem('<?= base_url('properti/publish/' . $value->id_properti) ?>','publish')">Publish</button>

                        <?php } else { ?>
                          <a href="' . base_url() . 'properti/detailproperti/' . $value->id_properti . '" class="btn btn-icons btn-inverse-info mr-1" id="detail_data_properti"><i class="fa fa-info"></i></a><a href="<?= base_url('properti/detailproperti/' . $value->id_properti) ?>" class="btn btn-sm btn-info mr-1" id="rab_data_properti">RAB Properti</a><a href="<?= base_url("rab/unit/" . $value->id_properti) ?>" class="btn btn-sm btn-success mr-1" id="rab_data_unit">RAB Unit</button>

                          <?php } ?>

                      </td>
                    </tr>
                  <?php $no++;
                  } ?>
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