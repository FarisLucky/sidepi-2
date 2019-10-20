<div class="content-wrapper" id="multi_tambah">
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
                        <form action="<?= base_url() ?>unitproperti/coremultitambah" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash() ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Nama Unit</label>
                                        <input type="text" name="txt_nama" class="form-control"
                                            value="<?= set_value("txt_nama") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_nama") ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Blok Awal</label>
                                        <input type="number" name="txt_blok_awal" class="form-control"
                                            value="<?= set_value("txt_blok_awal") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_nama") ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" name="txt_jumlah_blok" class="form-control"
                                            value="<?= set_value("txt_jumlah_blok") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_jumlah_blok") ?></small>
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
                                        <input type="text" name="txt_tanah" class="form-control"
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
                                        <input type="text" name="txt_bangunan" class="form-control"
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
                                            rows="3"><?= set_value("txt_desc") ?></textarea>
                                        <small class="text-danger"><?= form_error("txt_desc") ?></small>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success mr-2"><i class="fa fa-save"></i>
                                        Simpan</button>
                                    <button type="submit" class="btn btn-secondary mr-2"><i class="fa fa-refresh"></i>
                                        Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>