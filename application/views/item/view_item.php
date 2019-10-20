<div class="content-wrapper">
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Kelompok Item</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5 class="d-inline-block"><i class="fa fa-m"></i>All Item</h5>
                        <a href="<?= base_url() ?>item/tambah" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus"></span> Tambah</a>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-end">
                    <div class="col-sm-4">
                        <form action="<?= base_url('item') ?>" method="post">
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
                                    <th>Nama Kelompok</th>
                                    <th>Kategori</th>
                                    <th>status</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php $no = $row + 1;
                                    if (empty($kategori_item)) {
                                        echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                                    }
                                    foreach ($kategori_item as $k) {
                                        $bg = $k->id_kategori;
                                        $badge = "";
                                        if ($bg == 1) {
                                            $badge = "badge-primary";
                                        } else if ($bg == 2) {
                                            $badge = "badge-info";
                                        } else if ($bg == 3) {
                                            $badge = "badge-danger";
                                        } else {
                                            $badge = "badge-success";
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $k->nama_kelompok ?></td>
                                            <td>
                                                <div class="badge <?= $badge ?>"><?php echo $k->nama_kategori ?>
                                            </td>
                                            <td>
                                                <div class="badge badge-dark">
                                                    <?= ($k->status == 'a') ? 'Aktif' : 'Tidak Aktif'; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url() . 'item/ubah' ?>/<?= $k->id_kelompok ?>" class="btn btn-icons btn-inverse-info"><i class="fa fa-edit"></i></a>
                                                <?php if ($k->status == "a") { ?>
                                                    <button class="btn btn-icons btn-inverse-warning btn-nonaktif" onclick="setItem('<?= base_url('item/status/' . $k->id_kelompok) ?>','Nonaktifkan')"><span class="fa fa-times"></span></button>
                                                <?php } else { ?>
                                                    <button class="btn btn-icons btn-inverse-danger btn-aktif" onclick="setItem('<?= base_url('item/status/' . $k->id_kelompok) ?>','Aktifkan')"><span class="fa fa-check"></span></button>
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