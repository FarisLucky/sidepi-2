<div class="content-wrapper" id="tambah_unit">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Kelola Unit</h4>
                            </div>
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
                                <h5 class="d-inline-block">Tambah Unit Properti</h5>
                                <a href="<?= base_url("unitproperti") ?>" class="btn btn-dark float-right"><i
                                        class="fa fa-arrow-circle-left"></i> Kembali</a>
                            </div>
                        </div>
                        <hr>
                        <form id="form_tambah_unit" action="<?= base_url() ?>unitproperti/coretambah" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash() ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="txt_nama">Nama Unit</label>
                                        <input type="text" name="txt_nama" class="form-control"
                                            value="<?= set_value("txt_nama") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_nama") ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="txt_type">Type</label>
                                        <input type="text" name="txt_type" class="form-control"
                                            value="<?= set_value("txt_type") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_type") ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="txt_tanah">Luas Tanah</label>
                                        <input type="number" name="txt_tanah" class="form-control"
                                            value="<?= set_value("txt_tanah") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_tanah") ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="satuan">Satuan Tanah</label>
                                        <input type="text" name="satuan_tanah" class="form-control"
                                            value="<?= set_value("satuan_tanah") ?>" required>
                                        <small class="text-danger"><?= form_error("satuan_tanah") ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="txt_bangunan">Luas Bangunan</label>
                                        <input type="number" name="txt_bangunan" class="form-control"
                                            value="<?= set_value("txt_bangunan") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_bangunan") ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="satuan">Satuan Bangunan</label>
                                        <input type="text" name="satuan_bangunan" class="form-control"
                                            value="<?= set_value("satuan_bangunan") ?>" required>
                                        <small class="text-danger"><?= form_error("satuan_bangunan") ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="txt_harga">Harga</label>
                                        <input type="text" name="txt_harga" class="form-control"
                                            value="<?= set_value("txt_harga") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_harga") ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="txt_alamat">Alamat</label>
                                        <textarea class="form-control" name="txt_alamat" rows="3"
                                            required><?= set_value("txt_alamat") ?></textarea>
                                        <small class="text-danger"><?= form_error("txt_alamat") ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="txt_desc">Deskripsi</label>
                                        <textarea class="form-control" name="txt_desc" id="txt_desc"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="txt_foto" class="d-flex">Foto Unit</label>
                                        <img id="foto_unit" style="max-width:800px" class="mb-2">
                                        <input type="file" name="foto" class="form-control"
                                            onchange="validateFileUpload(this);readURL(this,'#foto_unit')">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success mr-2"><span
                                            class="fa fa-save"></span> Simpan</button>
                                    <button type="submit" class="btn btn-secondary"><span
                                            class="fa fa-refresh"></span> Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>