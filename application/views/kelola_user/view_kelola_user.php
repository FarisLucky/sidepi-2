<div class="content-wrapper" id="view_kelola_user">
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
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5 class="d-inline-block"><i class="fa fa-m"></i>Kelola Perusahaan</h5>
                        <a href="<?= base_url() ?>kelolauser/tambah" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i>Tambah</a>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-end">
                    <div class="col-sm-4">
                        <form action="<?= base_url('kelolauser') ?>" method="post">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
                            <div class="form-row m-0">
                                <div class="col-7">
                                    <input type="text" name="search" class="form-control form-control-sm">
                                </div>
                                <div class="col-auto">
                                    <button name="submit" class="btn btn-sm btn-inverse-success"><span class="fa fa-search"></span></button>
                                </div>
                                <div class="col-auto">
                                    <button name="reset" class="btn btn-sm btn-inverse-secondary"><span class="fa fa-refresh"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="tbl_user">
                                <thead class="table-primary">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telp</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php $no = $row + 1;
                                    if (empty($user)) {
                                        echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                                    }
                                    foreach ($user as $value) { ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value->nama_lengkap ?></td>
                                            <td><?= $value->Email ?></td>
                                            <td><?= $value->no_hp ?></td>
                                            <td><small class="badge badge-primary"><?= $value->akses ?></small></td>
                                            <td><small class="badge badge-info"><?= $value->status_user ?></small></td>
                                            <td>
                                                <?php if ($value->akses != 'owner') { ?>
                                                    <a href="<?= base_url('kelolauser/detailuser/' . $value->id_user) ?>" class="btn btn-icons btn-inverse-info mx-2" id="detail_data_user"><i class="fa fa-info"></i></a><button type="button" class="btn btn-icons btn-inverse-danger" onclick="deleteItem('<?= base_url('kelolauser/hapus/' . $value->id_user) ?>')"><i class="fa fa-trash"></i></button>
                                                    <div class="btn-group" role="group">
                                                        <button type="button" class="btn btn-icons btn-inverse-warning dropdown-toggle" data-toggle="dropdown">
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <?php if ($value->status_user == 'aktif') { ?>
                                                                <button type="button" class="dropdown-item" onclick="setItem('<?= base_url('kelolauser/aktifnonaktif/' . $value->id_user) ?> ','Nonaktifkan')">Nonaktif</button>
                                                            <?php } else { ?>
                                                                <button type="button" class="dropdown-item" onclick="setItem('<?= base_url('kelolauser/aktifnonaktif/' . $value->id_user) ?> ','Aktifkan')">Aktifkan</button>
                                                            <?php } ?>
                                                            <button class="dropdown-item my-2" onclick="getModal('<?= $value->id_user ?>)">Change Password</button>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <span>-</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <nav class="mt-3">
                        <?php echo $this->pagination->create_links(); ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_kelola">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('kelolauser/changepassword') ?>" method="post">
                <input type="hidden" name="input_hidden">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Masukkan Password</label>
                                    <input type="password" class="form-control" name="pw_baru" id="pw_baru" required>
                                    <div class="form-check form-check-flat my-1">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="tampil_pw1" onclick="showPass(this,' pw_baru')">Show Password
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password" class="form-control" name="confirm_pw_baru" id="confirm_pw_baru" required>
                                    <div class="form-check form-check-flat my-1">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="tampil_pw2" onclick="showPass(this,'confirm_pw_baru')">Show Password
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>