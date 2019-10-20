<div class="content-wrapper" id="v_persyaratan_sasaran">
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Kelola Persyaratan Sasaran</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5 class="d-inline-block"><i class="fa fa-m"></i>Kelola Persyaratan</h5>
                        <a href="<?= base_url() ?>persyaratan/tambah" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i>Tambah</a>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-end">
                    <div class="col-sm-4">
                        <form action="<?= base_url('persyaratan') ?>" method="post">
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
                            <table class="table table-hover table-striped">
                                <thead class="table-primary">
                                    <th>No</th>
                                    <th>Nama Persyaratan</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    if (empty($persyaratan)) {
                                        echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                                    }
                                    foreach ($persyaratan as $p) { ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $p->nama_kelompok ?></td>
                                            <td>
                                                <div class="badge badge-primary"><?php echo $p->kategori_persyaratan ?></div>
                                            </td>
                                            <td>
                                                <div class="badge badge-dark"><?= $p->status == '1' ? 'aktif' : 'tidak aktif' ?></div>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('persyaratan/ubah/' . $p->id_sasaran) ?>" class="btn btn-icons btn-inverse-info"><i class="fa fa-edit"></i></a>
                                                <?php if ($p->status == '1') { ?>
                                                    <button class="btn btn-icons btn-inverse-warning" onclick="setItem('<?= base_url('persyaratan/lock/' . $p->id_sasaran) ?>','NonAktifkan')"><i class="fa fa-times"></i></button>
                                                <?php } else { ?>
                                                    <button class="btn btn-icons btn-inverse-success" onclick="setItem('<?= base_url('persyaratan/lock/' . $p->id_sasaran) ?>','Aktifkan')"><i class="fa fa-check"></i></button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
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