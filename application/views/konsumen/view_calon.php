<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <h4 class="dark txt_title d-inline-block mt-2">Calon Konsumen</h4>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block"><i class="fa fa-m"></i>Data Calon</h5>
            <a href="<?= site_url() ?>calonkonsumen/tambah" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <div class="table table-responsive">
              <table class="table table-hover table-striped">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Id Card</th>
                  <th>Nama Calon</th>
                  <th>No Telepon</th>
                  <th>Status Konsumen</th>
                  <th>Tanggal dibuat</th>
                  <th>Alamat</th>
                  <th>Email</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php $no = $row + 1;
                  if (empty($konsumen)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($konsumen as $k) : ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $k->id_type . ' ' . $k->id_card ?></td>
                      <td><?php echo $k->nama_lengkap ?></td>
                      <td><?php echo $k->telp ?></td>
                      <td>
                        <div class="badge badge-info">
                          <?php echo ($k->status_konsumen == "ck") ? "Calon Konsumen" : "Konsumen"; ?></div>
                      </td>
                      <td><?php echo $k->tgl_buat ?></td>
                      <td><?php echo $k->alamat ?></td>
                      <td><?php echo empty($k->email) ? '<i style="font-size: 13px;">Kosong</i>' : $k->email ?>
                      </td>
                      <td>
                        <a href="<?php echo site_url('calonkonsumen/edit/' . $k->id_konsumen) ?>" class="btn btn-icons btn-inverse-info"><i class="fa fa-edit"></i></a>
                        <button onclick="deleteItem('<?php echo site_url('calonkonsumen/hapus/' . $k->id_konsumen) ?>')" class="btn btn-icons btn-inverse-danger"><i class="fa fa-trash"></i></b>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>