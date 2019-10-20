<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Edit Jenis Pembayaran</h4>
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
                        <form method="post" action="<?= base_url() ?>index.php/jenis_pembayaran/corePerbarui">
                            <div class="form-group">
                                <label for="input_jenis_pembayaran">Id Jenis</label>
                                <input type="text" readonly class="form-control" id="input_jenis_pembayaran" name="edit_id_jenis" value="<?= $jenispembayaran[0]['id_jenis'] ?>" placeholder="Masukan id jenis" required><br>
                                <label for="input_jenis_pembayaran">Jenis Pembayaran</label>
                                <input type="text" class="form-control" id="input_jenis_pembayaran" name="edit_jenis_pembayaran" value="<?= $jenispembayaran[0]['jenis_pembayaran'] ?>" placeholder="Masukan Jenis Pembayaran" required>
                            </div>
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                            <a href="<?= base_url() ?>index.php/jenis_pembayaran" class="btn btn-dark mr-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
