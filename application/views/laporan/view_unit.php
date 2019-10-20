<div class="content-wrapper" id="laporan_view_unit">
    <div class="container">
        <form action="<?= base_url('laporanunit/printunit') ?>" method="post">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
            <div class="card">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <small class="d-inline-block mt-2 bg-inverse-success" style="border-radius: 5px;padding: 5px;font-size:15px;font-weight: 500"><?= $site_plan['nama_properti'] ?></small>
                            <?php if (isset($_SESSION['laporan_unit'])) { ?>
                                <a href="<?= base_url('laporanunit/resetproperti/') ?>" class="mx-2 text-primary">Pilih Properti</a>
                            <?php } ?>
                            <a data-toggle="collapse" href="#collapseOne" class="text-primary float-right"><span class="fa fa-circle"></span></a>
                        </div>
                    </div>
                    <hr>
                    <div class="collapse" id="collapseOne">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <img src="<?= base_url('assets/uploads/images/properti/' . $site_plan["foto_properti"]) ?>" style="max-width:100%;max-height:300px">
                            </div>
                        </div>
                        <!-- Title Page -->
                        <small class="txt-normal text-danger">* yang di centang berarti sudah terjual</small>
                        <div class="row">
                            <?php
                            foreach ($list_unit as $key => $value) :
                                if ($value['status_unit'] == "sudah terjual") {
                                    $check = "checked";
                                } else {
                                    $check = "";
                                }
                                ?>
                                <div class="col-sm-3">
                                    <div class="form-check form-check-flat">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="unit_properti" disabled <?php echo $check ?>><?php echo $value['nama_unit'] ?>
                                        </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- Site Plan Unit -->
                        <hr>
                    </div>
                </div>
            </div>
        </form>
        <!-- box filter -->
        <br>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="d-inline-block">Laporan Unit</h4>
                        <a href="#collapseTwo" class="text-primary float-right" data-toggle="collapse"><i class="fa fa-circle"></i></a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="border-left-color">
                            <h5>Filter Pencarian</h5>
                            <form action="<?= base_url('laporanunit/unit') ?>" method="post">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
                                <div class="form-row">
                                    <div class="col-sm-4">
                                        <select type="text" name="filter_cari" class="form-control form-control-sm" required>
                                            <?php $params = isset($_SESSION['filter_cari']) ? $_SESSION['filter_cari']['status_unit'] : ''; ?>

                                            <option value="">-- pilih status --</option>
                                            <option value="bt" <?= $params == 'bt' ? 'selected' : '' ?>>Belum Terjual</option>
                                            <option value="b" <?= $params == 'b' ? 'selected' : '' ?>>Booking</option>
                                            <option value="t" <?= $params == 't' ? 'selected' : '' ?>>Terjual</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" name="filter_submit" class="btn btn-sm btn-inverse-success"><span class="fa fa-search"></span></button>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" name="filter_reset" class="btn btn-sm btn-inverse-secondary"><span class="fa fa-refresh"></span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-end">
                    <div class="col-sm-4">
                        <form action="<?= base_url('laporanunit/unit') ?>" method="post">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash() ?>">
                            <div class="filter">
                                <small class="text-danger ml-2">cari nama unit</small>
                            </div>
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
                <div class="collapse show mt-3" id="collapseTwo">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-primary">
                                        <th>No</th>
                                        <th>Nama Unit</th>
                                        <th>Type</th>
                                        <th>Tanah</th>
                                        <th>Bangunan</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php $no = $row + 1;
                                        if (empty($list_unit)) {
                                            echo "<tr><td class='text-center' colspan='100%'><h5>Data Kosong</h5></td></tr>";
                                        }
                                        foreach ($list_unit as $value) { ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value['nama_unit'] ?></td>
                                                <td><?= $value['type'] ?></td>
                                                <td><?= $value['luas_tanah'] . ' ' . $value['satuan_tanah'] ?></td>
                                                <td><?= $value['luas_bangunan'] . ' ' . $value['satuan_bangunan'] ?></td>
                                                <td><?= number_format($value['harga_unit'], 2, ",", ".") ?></td>
                                                <td><span class="badge badge-primary"><?= $value['status_unit'] == 'bt' ? 'belum terjual' : ($value['status_unit'] == 'b' ? 'booking' : 'terjual') ?></span></td>
                                                <td>
                                                    <a href="<?= base_url('assets/uploads/images/unit_properti/' . $value['foto_unit']) ?>" data-lightbox="data <?= $value['id_unit'] ?>"><img src="<?= base_url('assets/uploads/images/unit_properti/' . $value['foto_unit']) ?>"></a>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('laporanunit/detail/' . $value['id_unit']) ?>" class="btn btn-icons btn-inverse-info"><i class="fa fa-info"></i></a>
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
                    <hr>
                    <div class="text-jual text-right border-right-color py-2">
                        <div class="row">
                            <div class="col-sm-12">
                                <small class="txt-normal">Jumlah Unit</small>
                                <small class="txt-normal-b" id="ttl">:&emsp;<?= $total['total'] ?></small>
                            </div>
                            <div class="col-sm-12">
                                <small class="txt-normal ">Belum Terjual</small>
                                <small class="txt-normal-b" id="bt">:&emsp;<?= $bt['bt'] ?></small>
                            </div>
                            <div class="col-sm-12">
                                <small class="txt-normal ">Booking</small>
                                <small class="txt-normal-b" id="b">:&emsp;<?= $b['b'] ?></small>
                            </div>
                            <div class="col-sm-12">
                                <small class="txt-normal ">Terjual</small>
                                <small class="txt-normal-b" id="t">:&emsp;<?= $t['t'] ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page -->