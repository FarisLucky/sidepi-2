<div class="content-wrapper" id="tambah_property">
    <div class="container">
        <div class="card">
            <div class="card-body h-100 w-100">
                <h4>Pilih Properti</h4>
                <div class="row">
                    <div class="col-sm-6 p-3">
                        <form action="<?= $href ?>" method="POST">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">

                            <div class="form-group">
                                <select name="properti" id="list_properti">
                                    <?php foreach ($properti as $key => $value) { ?>
                                        <option value="<?= $value['id_properti'] ?>"><?= $value['nama_properti'] ?></option>
                                    <?php } ?>
                                </select>
                                <button type="submit" class="btn btn-primary">Pilih</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>