<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="dark txt_title d-inline-block mt-2">Edit RAB Bangunan</h4>
                        <a href="<?= base_url().'rab/unit/'.$kembali ?>" class="float-right mt-2 text-primary"><i class="fa fa-arrow-left text-primary"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <form action="<?php echo base_url(). 'rab/core_update_unit'; ?>" method="post">
                            <input type="hidden" name = "id_detail" value = "<?php echo $k->id_detail ?>"class="form-control" id="exampleInputName1" placeholder="">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleInputName1">nama_detail</label>
                                        <input type="text" name = "nama_detail" value = "<?php echo $k->nama_detail ?>"class="form-control" id="exampleInputName1" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">volume</label>
                                        <input type="text" name = "volume" value = "<?php echo $k->volume ?>"class="form-control" id="exampleInputName1" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">satuan</label>
                                        <input type="text" name = "satuan" value = "<?php echo $k->satuan ?>"class="form-control" id="exampleInputName1" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">harga_satuan</label>
                                        <input type="text" name = "harga_satuan" value = "<?php echo $k->harga_satuan ?>"class="form-control" id="exampleInputName1" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="option">Pilih Kelompok RAB</label>
                                        <select name="select_kelompok" class="form-control">
                                            <option value="">-- Pilih Kelompok RAB --</option>
                                            <?php $select = ""; foreach ($kelompok_rab as $key => $value) :
                                                if ($value->id_kelompok == $k->id_kelompok) {
                                                    $select = "selected";
                                                } ?>
                                                <option value="<?= $value->id_kelompok ?>" <?= $select ?>><?= $value->nama_kelompok ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>