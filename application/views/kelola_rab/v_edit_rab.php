<div class="content-wrapper">
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Edit RAB Bangunan</h4>
                        <a href="<?= base_url().'rab/properti/'.$kembali ?>" class="btn btn-dark float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <form action="<?php echo base_url(). 'rab/coreubah'; ?>" method="post">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
                        <input type="hidden" name = "id_detail" value = "<?php echo $k->id_detail ?>">
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nama Detail</label>
                                <input type="text" name = "nama_detail" value = "<?php echo $k->nama_detail ?>"class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Volume</label>
                                <input type="text" name = "volume" value = "<?php echo $k->volume ?>"class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <input type="text" name = "satuan" value = "<?php echo $k->satuan ?>"class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Harga Satuan</label>
                                <input type="text" name = "harga_satuan" value = "<?php echo $k->harga_satuan ?>"class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label >Pilih Kelompok RAB</label>
                                <select name="select_kelompok" class="form-control" required>
                                    <option value="">-- Pilih Kelompok RAB --</option>
                                    <?php $select = ""; foreach ($kelompok_rab as $key => $value) : ?>
                                    <option value=<?php echo "'$value->id_kelompok'";echo ($k->id_kelompok == $value->id_kelompok) ? "selected" : "" ; ?>><?= $value->nama_kelompok ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>