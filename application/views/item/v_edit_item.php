<div class="content-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">
              <div class="col-sm-12">
                <h4 class="dark txt_title d-inline-block mt-2">Edit Kategori Item</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body p-4">
            <form action="<?php echo base_url(). 'item/coreubah'; ?>" method="post">
              <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                value="<?= $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="id_kelompok" value="<?php echo $kategori_item->id_kelompok ?>">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="exampleInputName1">Nama Kelompok</label>
                    <input type="text" name="nama_kelompok" value="<?php echo $kategori_item->nama_kelompok ?>"
                      class="form-control">
                    <small class="text-danger"><?= form_error('nama_kelompok') ?></small>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="item_name">Kategori Kelompok</label>
                    <select name="select_kategori" class="form-control">
                      <option value="">-- Pilih Kategori Kelompok</option>
                      <?php $select = "";
                            foreach ($kategori as $key => $value) :
                            if ($value->id_kategori == $kategori_item->id_kategori) {
                                $select = "selected";
                            }else{
                                $select = "";
                            }
                        ?>
                      <option value="<?= $value->id_kategori ?>" <?= $select ?>><?= $value->nama_kategori ?></option>
                      <?php endforeach; ?>
                    </select>
                    <small class="form-text text-danger"><?= form_error ('select_kategori'); ?></small>
                  </div>
                </div>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-sm btn-success ">Simpan</button>
                  <a href="<?php echo base_url("item") ?>" class="btn btn-sm btn-dark mx-2">Batal</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>