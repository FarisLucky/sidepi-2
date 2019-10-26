<!-- partial Main Menu -->
<?php $user = get_where('user', ['id_user' => $this->session->userdata['id_user']])->row();
$nama_path = $this->uri->segment('1'); ?>
<div class="container-fluid page-body-wrapper">

    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <div class="nav-link">
                    <div class="profile-icon">
                        <div class="profile-image">
                            <img src="<?= base_url() ?>assets/uploads/images/profil/user/<?= $user->foto_user ?>" class="img-profil">
                        </div>
                        <div class="text-wrapper">
                            <p class="profile-name"><?= $user->nama_lengkap ?></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item <?= $this->uri->segment('1') == 'dashboard' ? 'active' : '' ?>">
                <?php $link;
                if ($_SESSION['id_akses'] === '1') {

                    $link = 'dashboard/owner';
                } elseif ($_SESSION['id_akses'] === '2') {

                    $link = 'dashboard/manager';
                } elseif ($_SESSION['id_akses'] === '3') {

                    $link = 'dashboard/admin';
                } else {

                    $link = 'dashboard/marketing';
                }
                ?>
                <a class="nav-link" href="<?= base_url($link); ?>">
                    <i class="menu-icon mdi mdi-television"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>

            <?php if ($_SESSION['id_akses'] === '1' || $_SESSION['id_akses'] === '2') { ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#approve" aria-expanded="false" aria-controls="ui-basic">
                        <i class="menu-icon mdi mdi-approval"></i>
                        <span class="menu-title">Approve</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="approve">
                        <ul class="nav flex-column sub-menu">

                            <?php if ($_SESSION['id_akses'] === '1') { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'approve' ? 'active' : ''; ?>" href="<?= base_url('approve') ?>">Approve Pembayaran</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'approvepengeluaran' ? 'active' : '' ?>" href="<?= base_url('approvepengeluaran') ?>">Approve Pengeluaran</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'approvepemasukan' ? 'active' : '' ?>" href="<?= base_url('approvepemasukan') ?>">Approve Pemasukan</a>
                                </li>
                            <?php } ?>

                            <?php if ($_SESSION['id_akses'] === '2') { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'mngapprove' ? 'active' : '' ?>" href="<?= base_url('mngapprove') ?>">Approve Pembayaran</a>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'mngapprovepengeluaran' ? 'active' : '' ?>" href="<?= base_url('mngapprovepengeluaran') ?>">Approve Pengeluaran</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'mngapprovepemasukan' ? 'active' : '' ?>" href="#">Approve Pemasukan</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('approvetransaksi', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'approvetransaksi' ? 'active' : '' ?>" href="<?= base_url('approvetransaksi') ?>">Approve Transaksi</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php if ($_SESSION['id_akses'] === '1') { ?>
                <li class="nav-item <?= $nama_path == 'profilperusahaan' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('profilperusahaan') ?>">
                        <i class="menu-icon mdi mdi-settings"></i>
                        <span class="menu-title">Setting</span>
                    </a>
                </li>
            <?php } ?>

            <?php if ($_SESSION['id_akses'] === '1' || $_SESSION['id_akses'] === '2') { ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#kelola-proyek" aria-expanded="false" aria-controls="ui-basic">
                        <i class="menu-icon mdi mdi-widgets"></i>
                        <span class="menu-title">Kelola Proyek</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="kelola-proyek">
                        <ul class="nav flex-column sub-menu">

                            <?php if (in_array('properti', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'properti' ? 'active' : '' ?>" href="<?= base_url('properti') ?>">Data Properti</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('unitproperti', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'unitproperti' ? 'active' : '' ?>" href="<?= base_url('unitproperti') ?>">Data Unit</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('rab', $_SESSION['controllers']) && $_SESSION['id_akses'] !== '1') { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'rab' && $this->uri->segment('2') == 'unit' ? 'active' : '' ?>" href="<?= base_url('rab/unit') ?>">RAB Unit</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('rab', $_SESSION['controllers']) && $_SESSION['id_akses'] !== '1') { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'rab' && $this->uri->segment('2') == 'properti' ? 'active' : '' ?>" href="<?= base_url('rab/properti') ?>">RAB Properti</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('kartukontrol', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'kartukontrol' ? 'active' : '' ?>" href="<?= base_url('kartukontrol') ?>">Kartu Kontrol</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php if ($_SESSION['id_akses'] === '3') { ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#pembayaran" aria-expanded="false" aria-controls="ui-basic">
                        <i class="menu-icon mdi mdi-credit-card"></i>
                        <span class="menu-title">Pembayaran</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="pembayaran">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link <?= $nama_path == 'pembayaran' && $this->uri->segment('2') == 'tandajadi' ? 'active' : '' ?>" href="<?= base_url('pembayaran/tandajadi') ?>">Tanda Jadi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  <?= $nama_path == 'pembayaran' && $this->uri->segment('2') == 'uangmuka' ? 'active' : '' ?>" href="<?= base_url('pembayaran/uangmuka') ?>">Uang Muka</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link  <?= $nama_path == 'pembayaran' && $this->uri->segment('2') == 'cicilan' ? 'active' : '' ?>" href="<?= base_url('pembayaran/cicilan') ?>">Cicilan</a>
                            </li>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <?php if (in_array('transaksi', $_SESSION['controllers']) && $_SESSION['id_akses'] !== '1') { ?>
                <li class="nav-item  <?= $nama_path == 'transaksi' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('transaksi') ?>">
                        <i class="menu-icon mdi mdi-cart"></i>
                        <span class="menu-title">Transaksi</span>
                    </a>
                </li>
            <?php } ?>

            <?php if ($_SESSION['id_akses'] !== '2') { ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#kelola-data" aria-expanded="false" aria-controls="ui-basic">
                        <i class="menu-icon mdi mdi-folder-star"></i>
                        <span class="menu-title">Kelola Data</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="kelola-data">
                        <ul class="nav flex-column sub-menu">

                            <?php if (in_array('kelolauser', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'kelolauser' ? 'active' : '' ?>" href="<?= base_url('kelolauser') ?>">Data User</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('rekening', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'rekening' ? 'active' : '' ?>" href="<?= base_url('rekening') ?>">Data Rekening</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('item', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'item' ? 'active' : '' ?>" href="<?= base_url('item') ?>">Data Kelompok</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('persyaratan', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'persyaratan' ? 'active' : '' ?>" href="<?= base_url('persyaratan') ?>">Data Persyaratan</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('pengeluaran', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'pengeluaran' ? 'active' : '' ?>" href="<?= base_url('pengeluaran') ?>">Data Pengeluaran</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('pemasukan', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'pemasukan' ? 'active' : '' ?>" href="<?= base_url('pemasukan') ?>">Data Pemasukan</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('calonkonsumen', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'calonkonsumen' ? 'active' : '' ?>" href="<?= base_url('calonkonsumen') ?>">Data Calon</a>
                                </li>
                            <?php } ?>

                            <?php if (in_array('followcalon', $_SESSION['controllers'])) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $nama_path == 'followcalon' ? 'active' : '' ?>" href="<?= base_url('followcalon') ?>">Data Follow Calon</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            <?php } ?>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-book"></i>
                    <span class="menu-title">Laporan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="laporan">
                    <ul class="nav flex-column sub-menu">

                        <?php if (in_array('laporanpengeluaran', $_SESSION['controllers'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $nama_path == 'laporanpengeluaran' ? 'active' : '' ?>" href="<?= base_url('laporanpengeluaran') ?>">Laporan Pengeluaran</a>
                            </li>
                        <?php } ?>

                        <?php if (in_array('laporanpemasukan', $_SESSION['controllers'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $nama_path == 'laporanpemasukan' ? 'active' : '' ?>" href="<?= base_url('laporanpemasukan') ?>">Laporan Pemasukan</a>
                            </li>
                        <?php } ?>

                        <?php if (in_array('laporanpembayaran', $_SESSION['controllers'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $nama_path == 'laporanpembayaran' ? 'active' : '' ?>" href="<?= base_url('laporanpembayaran') ?>">Laporan Pembayaran</a>
                            </li>
                        <?php } ?>

                        <?php if (in_array('laporankonsumen', $_SESSION['controllers'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $nama_path == 'laporankonsumen' ? 'active' : '' ?>" href="<?= base_url('laporankonsumen') ?>">Laporan Konsumen</a>
                            </li>
                        <?php } ?>

                        <?php if (in_array('laporancalon', $_SESSION['controllers'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $nama_path == 'laporancalon' ? 'active' : '' ?>" href="<?= base_url('laporancalon') ?>">Laporan Calon</a>
                            </li>
                        <?php } ?>

                        <?php if (in_array('laporanunit', $_SESSION['controllers'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $nama_path == 'laporanunit' ? 'active' : '' ?>" href="<?= base_url('laporanunit') ?>">Laporan Unit</a>
                            </li>
                        <?php } ?>

                        <?php if (in_array('listtransaksi', $_SESSION['controllers'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $nama_path == 'listtransaksi' ? 'active' : '' ?>" href="<?= base_url('listtransaksi') ?>">Laporan Transaksi</a>
                            </li>
                        <?php } ?>

                        <?php if (in_array('laporanmarketing', $_SESSION['controllers'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $nama_path == 'laporanmarketing' ? 'active' : '' ?>" href="<?= base_url('laporanmarketing') ?>">Laporan Marketing</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>

        </ul>
    </nav>
    <div class="main-panel">