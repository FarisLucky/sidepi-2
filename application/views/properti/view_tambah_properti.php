<div class="content-wrapper" id="tambah_property">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Kelola Properti</h4>
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
                                <h5 class="d-inline-block">Tambah Properti</h5>
                                <a href="<?= base_url() ?>properti" class="btn btn-dark mr-2 float-right"><i class="fa fa-arrow-circle-left"></i>Kembali</a>
                            </div>
                        </div>
                        <hr>
                        <form action="<?= base_url() ?>properti/coretambah" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Nama Properti</label>
                                        <input type="text" name="txt_nama" class="form-control" value="<?= set_value("txt_nama") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_nama") ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="txt_luas">Luas Tanah </label>
                                        <input type="number" name="txt_luas" class="form-control" value="<?= set_value("txt_luas") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_luas") ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="txt_luas">Satuan Luas</label>
                                        <input type="text" name="txt_satuan" class="form-control" value="<?= set_value("txt_satuan") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_satuan") ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="txt_jumlah">Jumlah Unit</label>
                                        <input type="number" name='txt_jumlah' class="form-control" value="<?= set_value("txt_jumlah") ?>" required>
                                        <small class="text-danger"><?= form_error("txt_jumlah") ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Pilih Rekening</label>
                                        <select name="txt_rekening" class="form-control" required>
                                            <option value="">-- Pilih Rekening -- </option>
                                            <?php foreach ($rekening as $key => $value) : ?>
                                                <option value=<?php echo "'$value->id_rekening'";
                                                                    echo ($value->id_rekening == set_value("txt_rekening")) ? "selected" : ""; ?>>
                                                    <?= $value->no_rekening ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="text-danger"><?= form_error("txt_rekening") ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="txt_status" class="form-control" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="publish" <?= (set_value("txt_status") == "publish") ? "selected" : ""; ?>>Publish
                                            </option>
                                            <option value="non-publish" <?= (set_value("txt_status") == "non-publish") ? "selected" : ""; ?>>Non
                                                Publish</option>
                                        </select>
                                        <small class="text-danger"><?= form_error("txt_status") ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="txt_alamat">Alamat</label>
                                        <textarea class="form-control" name="txt_alamat" rows="3" required><?= set_value("txt_alamat") ?></textarea>
                                        <small class="text-danger"><?= form_error("txt_alamat") ?></small>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="txt_foto" class="d-flex">Foto Properti &nbsp;<i class="text-info float-right">Max Upload 1024kb</i></label>
                                        <img id="foto_properti" style="max-width:100%;max-height:350px">
                                        <input type="file" name="foto" class="form-control" onchange="validateFileUpload(this);">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="txt_foto" class="font-weight-light">SPR</label>
                                        <textarea class="form-control" name="txt_spr" rows="5"><?= set_value("txt_spr") ?></textarea>
                                        <small class="text-danger"><?= form_error("txt_spr") ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success mr-2">Simpan</button>
                                    <a href="<?= base_url() ?>properti" id="btn_batal_properti" class="btn btn-dark mr-2">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>