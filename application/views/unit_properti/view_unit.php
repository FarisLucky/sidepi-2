<div class="content-wrapper" id="unit_properti">
    <div class="container">
        <br>
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Site Plan</h4>
                        <a href="#" class="text-primary float-right" data-target="#collapse2" data-toggle="collapse"><i class="fa fa-circle"></i></a>
                    </div>
                </div>
                <hr>
                <div class="collapse show" id="collapse2">
                    <div class="row">
                        <div class="col-sm-12">
                            <img src="<?= base_url('assets/uploads/images/properti/' . $site_plan["foto_properti"]) ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="#" class="text-primary float-right" data-target="#collapse1" data-toggle="collapse"><i class="fa fa-circle"></i></a>
                    </div>
                </div>
                <hr>
                <div class="collapse show" id="collapse1">
                    <small class="txt-normal text-danger">* yang di centang berarti sudah terjual</small>
                    <div class="row mt-3">
                        <?php
                        foreach ($list_unit as $key => $value) :
                            if ($value->status_unit == "sudah terjual") {
                                $check = "checked";
                            } else {
                                $check = "";
                            }
                            ?>
                            <div class="col-sm-3">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="unit_properti" disabled <?php echo $check ?>><?php echo $value->nama_unit ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h5 class="d-inline-block"><i class="fa fa-m"></i>Data Unit</h5>
                        <a href="<?= base_url() ?>unitproperti/multitambah" class="btn btn-warning btn-sm float-right"><i class="fa fa-plus"></i>Tambah Banyak</a>
                        <a href="<?= base_url() ?>unitproperti/tambah" class="btn btn-primary btn-sm float-right mx-2"><i class="fa fa-plus"></i>Tambah</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead class="table-primary">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Type Rumah</th>
                                    <th>Tanah</th>
                                    <th>Bangunan</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php $no = $row + 1;
                                    if (empty($unit)) {
                                        echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                                    }
                                    foreach ($unit as $key => $value) { ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value['nama_unit'] ?></td>
                                            <td><?= $value['type'] ?></td>
                                            <td><?= $value['luas_tanah'] ?></td>
                                            <td><?= $value['luas_bangunan'] ?></td>
                                            <td>"Rp. <?= number_format($value['harga_unit'], 2, ',', '.') ?></td>
                                            <td><small class="badge badge-primary"><?= $value['status_unit'] == 't' ? 'Terjual' : ($value['status_unit'] == 'b' ? 'Booking' : 'Belum Terjual') ?></small></td>
                                            <td><a href="<?= base_url('assets/uploads/images/unit_properti/' . $value['foto_unit']) ?>" data-lightbox="<?= 'example' . $value['id_unit'] ?>" data-title="<?= $value['nama_unit'] ?>"><img src="<?= base_url('assets/uploads/images/unit_properti/' . $value['foto_unit']) ?>"></a></td>
                                            <td>
                                                <a href="<?= base_url('unitproperti/detail_unit/' . $value['id_unit']) ?>" class="btn btn-icons btn-inverse-info mr-1"><i class="fa fa-info"></i></a>
                                                <?php if ($value['status_unit'] == 'bt') { ?>
                                                    <button type="button" class="btn btn-icons btn-inverse-danger mr-1" onclick="deleteItem('<?= base_url('unitproperti/corehapus/' . $value['id_unit']) ?>')"><i class="fa fa-trash"></i></button>
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