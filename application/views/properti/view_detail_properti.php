<div class="content-wrapper" id="detail_property">
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
                        <h5 class="d-inline-block">Detail Properti</h5>
                        <a href="<?= base_url() ?>properti" class="btn btn-dark mr-2 float-right"><i
                                class="fa fa-arrow-circle-left"></i>Kembali</a>
                    </div>
                </div>
                <hr>
                <form id="form_detail" action="<?= base_url() ?>properti/coreubah" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash() ?>">
                    <input type="hidden" name="txt_id" value="<?= $properti->id_properti ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nama Properti</label>
                                <input type="text" name="txt_nama" class="form-control"
                                    value="<?= $properti->nama_properti ?>" readonly required>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="txt_luas">Luas Tanah </label>
                                <input type="number" name="txt_luas" class="form-control"
                                    value="<?= $properti->luas_tanah ?>" readonly required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="txt_luas">Satuan Luas</label>
                                <input type="text" name="txt_satuan" class="form-control"
                                    value="<?= $properti->satuan_tanah ?>" readonly required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="txt_jumlah">Jumlah Unit</label>
                                <input type="number" name='txt_jumlah' class="form-control"
                                    value="<?= $properti->jumlah_unit ?>" readonly required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Pilih Rekening</label>
                                <select name="txt_rekening" class="form-control" readonly>
                                    <option value="">-- Pilih Rekening -- </option>
                                    <?php foreach ($rekening as $key => $value) : ?>
                                    <option value=<?php echo "'$value->id_rekening'";
                                    echo ($value->id_rekening == $properti->rekening) ? "selected" : ""; ?>>
                                        <?= $value->no_rekening ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <?php if ($properti->status != 'publish') { ?>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="txt_status" class="form-control" readonly>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="publish" <?= ($properti->status == "publish") ? "selected" : ""; ?>>
                                        Publish
                                    </option>
                                    <option value="non-publish"
                                        <?= ($properti->status == "non-publish") ? "selected" : ""; ?>>Non
                                        Publish</option>
                                </select>
                                <small class="text-danger"><?= form_error("txt_status") ?></small>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="txt_alamat">Alamat</label>
                                <textarea class="form-control" name="txt_alamat" rows="3" readonly
                                    required><?= $properti->alamat ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="txt_foto" class="d-flex">Foto Properti &nbsp;<i
                                        class="fa fa-info-circle text-info"></i></label>
                                <img src="<?= base_url("assets/uploads/images/properti/" . $properti->foto_properti) ?>"
                                    id="foto_properti" style="max-width:100%;max-height:350px">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Setting SPR</label>
                                <textarea name="txt_spr" rows="10"
                                    class="form-control"><?= $properti->setting_spr ?></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" id="ubah_properti" class="btn btn-info mr-2 float-right"><i
                                    class="fa fa-pencil-square-o"></i>Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>