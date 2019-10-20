<div class="content-wrapper" id="ubah_persyaratan">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="dark txt_title d-inline-block mt-2">Ubah Persyaratan</h4>
            <a href="<?= base_url() ?>persyaratanunit" class=" btn btn-dark btn-sm float-right"><i
                class="fa fa-arrow-circle-left"></i> Kembali</a>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <h5 class="d-inline-block mr-4">Detail Unit</h5>
            <?php if ($unit->status_unit == "bt") {
                      $status = "Belum Terjual";
                  } elseif ($unit->status_unit == "b") {
                      $status = "Booking";
                  } else {
                      $status = "Terjual";
                  } ?>
            <small class="badge badge-info"><?= $status ?></small>
            <a href="#" class="text-primary float-right" data-target="#collapse1" data-toggle="collapse"><i
                class="fa fa-circle"></i></a>
          </div>
        </div>
        <hr>
        <div class="data-unit collapse show" id="collapse1">
          <form id="form_detail_unit" action="<?= base_url('persyaratanunit/coreubah/') ?>" method="post"
            enctype="multipart/form-data">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
              value="<?= $this->security->get_csrf_hash() ?>">
            <input type="hidden" name="txt_id" class="form-control" id="txt_id" value="<?= $unit->id_unit ?>">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="txt_nama">Nama Unit</label>
                  <input type="text" name="txt_nama" class="form-control" id="txt_nama" value="<?= $unit->nama_unit ?>"
                    readonly>
                  <small class="text-danger"><?= form_error("txt_nama") ?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="txt_type">Type</label>
                  <input type="text" name="txt_type" class="form-control" id="txt_type" value="<?= $unit->type?>"
                    readonly>
                  <small class="text-danger"><?= form_error("txt_type") ?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8">
                <div class="form-group">
                  <label for="txt_tanah">Luas Tanah</label>
                  <input type="text" name="txt_tanah" class="form-control" id="txt_tanah"
                    value="<?= $unit->luas_tanah ?>" readonly>
                  <small class="text-danger"><?= form_error("txt_tanah") ?></small>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="satuan">Satuan Tanah</label>
                  <input type="text" name="satuan_tanah" class="form-control" value="<?= $unit->satuan_tanah ?>"
                    readonly>
                  <small class="text-danger"><?= form_error("satuan_tanah") ?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8">
                <div class="form-group">
                  <label for="txt_bangunan">Luas Bangunan</label>
                  <input type="text" name="txt_bangunan" class="form-control" id="txt_bangunan"
                    value="<?= $unit->luas_bangunan ?>" readonly>
                  <small class="text-danger"><?= form_error("txt_bangunan") ?></small>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="satuan">Satuan Bangunan</label>
                  <input type="text" name="satuan_bangunan" class="form-control" value="<?= $unit->satuan_bangunan ?>"
                    readonly>
                  <small class="text-danger"><?= form_error("satuan_bangunan") ?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="txt_harga">Harga</label>
                  <input type="text" name="txt_harga" class="form-control" id="txt_harga"
                    value="<?= $unit->harga_unit ?>" readonly>
                  <small class="text-danger"><?= form_error("txt_harga") ?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="txt_alamat">Alamat</label>
                  <textarea class="form-control" name="txt_alamat" id="txt_alamat" rows="5"
                    readonly><?= $unit->alamat_unit ?></textarea>
                  <small class="text-danger"><?= form_error("txt_alamat") ?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="txt_desc">Deskripsi</label>
                  <textarea class="form-control" name="txt_desc" id="txt_desc" rows="5"
                    readonly><?= $unit->deskripsi ?></textarea>
                  <small class="text-danger"><?= form_error("txt_desc") ?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="txt_foto" class="d-flex">Foto Properti</label>
                  <img src="<?= base_url() ?>assets/uploads/images/unit_properti/<?= $unit->foto_unit ?>" alt=""
                    id="foto_unit" class="img-thumbnail">
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-12">
                <button type="button" id="btn_ubah_unit" class="btn btn-sm btn-info mr-2 float-right"
                  onclick="ubahUnit(this)"><i class="fa fa-edit"></i> Ubah</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <br>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <small class="txt-semi-high font-weight-medium">Dokumen Unit</small>
            <a data-target="#segment2" data-toggle="collapse" class="text-primary float-right"><i
                class="fa fa-circle"></i></a>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-12">
            <button class="btn btn-sm btn-inverse-primary float-right" data-target="#modal_doc" data-toggle="modal"><i
                class="fa fa-plus"></i> Tambah</button>
          </div>
        </div>
        <br>
        <div class="row collapse show" id="segment2">
          <div class="col-sm-12">
            <table class="table table-condensed table-striped" id="tbl_to_tables">
              <thead>
                <th>No</th>
                <th>Nama Kelompok</th>
                <th>Status</th>
                <th>Aksi</th>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($doc_unit as $key => $value) { ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $value['nama_kelompok'] ?></td>
                  <td class="text-center">
                    <?php $path = './assets/uploads/files/unit/'.$value['file'] ;echo file_exists($path) && !is_dir($path) ? '<i style="font-size: 13px;">sudah upload</i>' : '<i style="font-size: 13px;">belum upload</i>'; ?>
                  </td>
                  <td class="text-center">
                    <?php if (file_exists($path) && !is_dir($path)) { ?>
                    <a href="<?= base_url('persyaratanunit/printdoc/'.$value['id_persyaratan']) ?>"
                      class="btn btn-icons btn-inverse-warning" target="blank"><i class="fa fa-print"></i></a>
                    <button class="btn btn-icons btn-inverse-danger"
                      onclick="deleteItem('<?= base_url('persyaratanunit/hapusfile/'.$value['id_persyaratan'].'/'.$unit->id_unit) ?>')"><i
                        class="fa fa-remove"></i></button>
                    <?php } else { ?>
                    <button class="btn btn-icons btn-inverse-primary" id="file_unit"
                      data-id="<?= $value['id_persyaratan'] ?>"><i class="fa fa-file-archive-o"></i></button>
                    <button class="btn btn-icons btn-inverse-danger"
                      onclick="deleteItem('<?= base_url('persyaratanunit/hapussyarat/'.$value['id_persyaratan'].'/'.$unit->id_unit) ?>')"><i
                        class="fa fa-trash"></i></button>
                    <?php } ?>
                  </td>
                </tr>
                <?php $no++; } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_doc">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('persyaratanunit/coretambahsyarat') ?>" method="post" enctype="multipart/form-data"
          id="modal_user">
          <input type="hidden" name="input_hidden" value="<?= $unit->id_unit ?>">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>"
            value="<?= $this->security->get_csrf_hash(); ?>">
          <div class="row">
            <div class="col-sm-12" id="form_change">
              <div class="form-group">
                <label>Pilih Kelompok</label>
                <select name="kelompok" class="select-opt">
                  <option value=""> -- Pilih Options -- </option>
                  <?php foreach ($kelompok as $key => $value) {
                    $where = get_where('persyaratan_unit',['id_unit'=>$unit->id_unit,'kelompok_persyaratan'=>$value['id_sasaran']]);
                    if ($where->num_rows() < 1) {
                      echo '<option value="'.$value['id_sasaran'].'">'.$value['nama_kelompok'].'</option>';
                    } } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Upload File</label>
                <input type="file" name="file_img" class="form-control">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Simpan</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>