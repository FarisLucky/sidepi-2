<div class="content-wrapper" id="detail_unit">
    <div class="container">
        <br>
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Detail Unit</h4>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5 class="d-inline-block mr-4">Detail Unit Properti</h5>
                        <?php if ($unit->status_unit == "bt") {
              $status = "Belum Terjual";
            } elseif ($unit->status_unit == "b") {
              $status = "Booking";
            } else {
              $status = "Terjual";
            } ?>
                        <small class="badge badge-info"><?= $status ?></small>
                        <a href="<?= base_url() ?>unitproperti" class="btn btn-dark float-right"><i
                                class="fa fa-arrow-circle-left"></i>Kembali</a>
                    </div>
                </div>
                <hr>
                <form id="form_detail_unit" action="<?= base_url() ?>unitproperti/coredetail" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="txt_id" class="form-control" id="txt_id" value="<?= $unit->id_unit ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="txt_nama">Nama Unit</label>
                                <input type="text" name="txt_nama" class="form-control" id="txt_nama"
                                    value="<?= $unit->nama_unit ?>" readonly>
                                <small class="text-danger"><?= form_error("txt_nama") ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="txt_type">Type</label>
                                <input type="text" name="txt_type" class="form-control" id="txt_type"
                                    value="<?= $unit->type ?>" readonly>
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
                                <input type="text" name="satuan_tanah" class="form-control"
                                    value="<?= $unit->satuan_tanah ?>" readonly>
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
                                <input type="text" name="satuan_bangunan" class="form-control"
                                    value="<?= $unit->satuan_bangunan ?>" readonly>
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
                                <img src="<?= base_url() ?>assets/uploads/images/unit_properti/<?= $unit->foto_unit ?>"
                                    alt="" id="foto_unit" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" id="ubah_unit" class="btn btn-info mr-2 float-right">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>