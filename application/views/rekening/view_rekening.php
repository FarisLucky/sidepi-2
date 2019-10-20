<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Kelola Rekening</h4>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block"><i class="fa fa-m"></i>Kelola Rekening</h5>
            <a href="<?= base_url() ?>rekening/tambah" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i>Tambah</a>
          </div>
        </div>
        <hr>
        <div class="row justify-content-end">
          <div class="col-sm-4">
            <form action="<?= base_url('kelolauser') ?>" method="post">
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
        <div class="row mt-3">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover table-striped table-bordered">
                <thead class="table-primary">
                  <th>No</th>
                  <th>No Rekening</th>
                  <th>Bank</th>
                  <th>Pemilik</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = 1;
                  if (empty($rekening)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($rekening as $value) { ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $value['no_rekening'] ?></td>
                      <td><?= $value['bank'] ?></td>
                      <td><?= $value['pemilik'] ?></td>
                      <td>
                        <div class="badge badge-info"><?= $value['status'] == '1' ? 'aktif' : 'tidak aktif' ?></div>
                      </td>
                      <td>
                        <a href="<?= base_url('rekening/ubah/' . $value['id_rekening']) ?>" class="btn btn-icons btn-inverse-info"><i class="fa fa-edit"></i></a>
                        <?php if ($value['status'] == '0') { ?>
                          <a href="#" class="btn btn-icons btn-inverse-success" onclick="setItem('<?= base_url('rekening/corestatus/' . $value['id_rekening']) ?>','Aktifkan')"><i class="fa fa-check-circle"></i></a>
                        <?php } else { ?>
                          <a href="#" onclick="setItem('<?= base_url('rekening/corestatus/' . $value['id_rekening']) ?>','Nonaktifkan')" class="btn btn-icons btn-inverse-warning"><i class="fa fa-times-circle"></i></a>
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