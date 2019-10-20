<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Follow Calon Konsumen</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block"><i class="fa fa-m"></i>Data Follow Calon</h5>
            <a href="<?= base_url() ?>followcalon/tambah" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Tambah</a>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <div class="table-responsive">
              <table class="table table-hover table-striped">
                <thead class="table-primary">
                  <th>No</th>
                  <th>Nama Konsumen</th>
                  <th>Tanggal Mendaftar</th>
                  <th>Media</th>
                  <th>Hasil Follow</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <?php
                  $no = $row + 1;
                  if (empty($follow_calon_konsumen)) {
                    echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                  }
                  foreach ($follow_calon_konsumen as $f) :
                    $tanggal = date('d-m-Y', strtotime($f['tgl_follow']));
                    ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $f['nama_lengkap'] ?></td>
                      <td><?php echo $tanggal ?></td>
                      <td><?php echo $f['media'] ?></td>
                      <td><?php echo $f['hasil_follow'] == 'bs' ? 'belum selesai' : 'selesai' ?></td>
                      <td><?php echo $f['keterangan'] ?></td>
                      <td width="250">
                        <a href="<?php echo site_url('followcalon/ubah/' . $f['id_follow']) ?>" class="btn btn-icons btn-inverse-primary"><i class="fa fa-edit"></i></a>
                        <a href="<?php echo site_url('followcalon/hapus/' . $f['id_follow']) ?>" onclick="deleteItem('<?= base_url('followcalon/hapus/' . $f['id_konsumen']) ?>');" class="btn btn-icons btn-inverse-danger"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php $no++;
                  endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>