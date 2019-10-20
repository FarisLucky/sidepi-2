<div class="content-wrapper" id="detail_user_content">
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Kelola User</h4>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5 class="d-inline-block">Detail User</h5>
                        <div class="badge badge-primary float-right"><?php echo $users->akses ?></div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txti_nama">Nama</label>
                                    <input type="text" name="txt_nama" class="form-control" id="txt_nama_user"
                                        value="<?php echo $users->nama_lengkap; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Jenis Kelamin</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-radio form-radio-flat">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="membershipRadios"
                                                        id="membershipRadios1" value=""
                                                        <?php echo (($users->jenis_kelamin == "laki-laki") ? $check = "checked" : $check = "") ?>
                                                        disabled>Laki - Laki
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-radio form-radio-flat">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="membershipRadios"
                                                        id="membershipRadios2" value="option2"
                                                        <?php echo (($users->jenis_kelamin == "perempuan") ? $check = "checked" : $check = "") ?>
                                                        disabled>Perempuan
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="txt_telp_user">Telp</label>
                                    <input type="number" name="txt_telp" class="form-control" id="txt_telp_user"
                                        value="<?= $users->no_hp; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="txt_alamat_user">Alamat</label>
                                    <textarea class="form-control" name="txt_alamat" id="txt_alamat_user" rows="3"
                                        disabled><?= $users->alamat; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="txt_username_user">Username</label>
                                    <input type="text" name="txt_username" class="form-control" id="txt_username_user"
                                        value="<?= $users->username; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="txt_email_user">Email</label>
                                    <input type="text" name='txt_email' class="form-control" id="txt_email_user"
                                        value="<?= $users->email; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <small class="txt-normal mb-2">Foto Profil</small>
                                <a href="<?= base_url() . "assets/uploads/images/profil/user/" . $users->foto_user ?>"
                                    data-lightbox="example"><img
                                        src="<?= base_url() . "assets/uploads/images/profil/user/" . $users->foto_user ?>"
                                        width="85%" class="img-thumbnail"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <h6>Silahkan Atur Properti yang akan di Kelola oleh User</h6>
                    </div>
                </div>
                <form action="<?= base_url() ?>kelolauser/userproperti" method="post">
                    <input type="hidden" name="hidden_user" value="<?= $users->id_user ?>">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>">
                    <div class="row">
                        <?php
            foreach ($properti as $key => $prop) :
              $id = $prop->id_properti;
              $check = getProperti($id, $users->id_user);
              ?>
                        <div class="col-sm-3 mt-3">
                            <a href="<?= base_url('assets/uploads/images/properti/' . $prop->foto_properti) ?>"
                                data-lightbox="foto_properti"><img
                                    src="<?= base_url('assets/uploads/images/properti/' . $prop->foto_properti) ?>"
                                    width="120px" class="img-rounded text-center"></a>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="user_properti[]"
                                                id="user_properti" value="<?= $prop->id_properti ?>"
                                                <?php echo $check ?>><?php echo $prop->nama_properti ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary mr-2">Simpan</button>
                            <a href="<?= base_url() ?>kelolauser" class="btn btn-sm btn-dark">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>