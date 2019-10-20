<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Jenis Pembayaran</h4>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="d-inline-block"><i class="fa fa-m"></i>Data Jenis Pembayaran</h5><br>
                                <hr>
                                <!-- alert-->
                                <?php
                                if ($this->session->flashdata('success')) {
                                    echo "<div class='alert alert-primary' role='alert'>" . $this->session->flashdata('success') . "</div>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>

                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($jenispembayaran as $j) :
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $j->jenis_pembayaran ?></td>
                                            <td width="250">
                                                <a href="<?php echo site_url('index.php/jenis_pembayaran/edit/' . $j->id_jenis) ?>" class="btn btn btn-primary btn-fw"></i> Edit</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
