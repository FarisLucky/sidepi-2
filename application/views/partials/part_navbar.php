<?php
$properti = get_where('properti', ['id_properti' => $this->session->userdata('id_properti')])->row();
$assign_properti = get_where('tbl_user_assign_properti', ['id_user' => $this->session->userdata('id_user')])->result();
$users = get_where('user', ['id_user' => $this->session->userdata['id_user']])->row(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?> || Sidepi</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/iconfonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/icheck/skins/all.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.min.css">

    <!-- Custom css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/css/custom_css.css">
    <!-- Toastr Css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/toastr/toastr.min.css">
    <!-- Select Css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/select2/css/select2.min.css">
    <!-- Lightbox -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/custom/lightbox2-11/css/lightbox.min.css">
    <script>
        var base = '<?= base_url() ?>'
        var csrf_name = '<?= $this->security->get_csrf_token_name() ?>'
        var csrf_val = '<?= $this->security->get_csrf_hash() ?>'
        var time;
    </script>
</head>

<body data-base="<?= base_url() ?>">
    <div class="overlay">
        <div class="loader"></div>
    </div>
    <div class="flash-data" flash-failed="<?= $this->session->flashdata("failed") ?>" flash-success="<?= $this->session->flashdata("success"); ?>" flash-error="<?= $this->session->flashdata("error"); ?>"></div>
    <div class="token" data-nama="<?= $this->security->get_csrf_token_name(); ?>" data-class="<?= $this->security->get_csrf_hash() ?>"></div>
    <div class="container-scroller">

        <!-- Part Navbar -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/uploads/app/logo.png') ?>" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/uploads/app/logo-mini.png') ?>" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-file-document-box"></i>
                            <span class="count">7</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                            <div class="dropdown-item">
                                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                                </p>
                                <span class="badge badge-info badge-pill float-right">View all</span>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="<?= base_url() ?>assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow">
                                    <h6 class="preview-subject ellipsis font-weight-medium text-dark">David Grey
                                        <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                                    </h6>
                                    <p class="font-weight-light small-text">
                                    </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="<?= base_url() ?>assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow">
                                    <h6 class="preview-subject ellipsis font-weight-medium text-dark">Tim Cook
                                        <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                                    </h6>
                                    <p class="font-weight-light small-text">
                                        New product launch
                                    </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="<?= base_url() ?>assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                                </div>
                                <div class="preview-item-content flex-grow">
                                    <h6 class="preview-subject ellipsis font-weight-medium text-dark"> Johnson
                                        <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                                    </h6>
                                    <p class="font-weight-light small-text">
                                        Upcoming board meeting
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="mdi mdi-bell"></i>
                            <span class="count">4</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <a class="dropdown-item">
                                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                                </p>
                                <span class="badge badge-pill badge-warning float-right">View all</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-alert-circle-outline mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-medium text-dark">Application Error</h6>
                                    <p class="font-weight-light small-text">
                                        Just now
                                    </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="mdi mdi-comment-text-outline mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-medium text-dark">Settings</h6>
                                    <p class="font-weight-light small-text">
                                        Private message
                                    </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="mdi mdi-email-outline mx-0"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <h6 class="preview-subject font-weight-medium text-dark">New user registration</h6>
                                    <p class="font-weight-light small-text">
                                        2 days ago
                                    </p>
                                </div>
                            </a>
                        </div>
                    </li>
                    <?php if ($_SESSION['id_akses'] != 1) { ?>
                        <li class="nav-item dropdown bg_red">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                                <span class="profile-text nav_properti"><?= $properti->nama_properti ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                <a class="dropdown-item">
                                    <p class="mb-0 font-weight-normal float-left">Pilih perumahan yang mau dikelola :</p>
                                </a>
                                <?php $session = $_SESSION['id_properti'];
                                    foreach ($assign_properti as $key => $p_item) :
                                        $selected = ($session == $p_item->id_properti) ? 'assign' : ''; ?>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?= base_url() . 'auth/reselectproperti/' . $p_item->id_properti ?>" class="<?= $selected ?> dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-success">
                                                <img src="<?= base_url() . 'assets/uploads/images/properti/' . $p_item->foto_properti ?>" alt="">
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject font-weight-medium text-dark">
                                                <?= $p_item->nama_properti ?></h6>
                                            <p class="font-weight-light small-text">Assign Properti</p>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    <?php } ?>
                    <li class="nav-item dropdown d-xl-inline-block">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <span class="profile-text"><i class="mdi mdi-settings"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="bg-setting padding-setting">
                                <small class="text-setting">Pilih Setting</small>
                            </div>
                            <a href="<?= base_url() . 'profileuser' ?>" class="dropdown-item mt-2">Manage Accounts
                            </a>
                            <a href="<?= base_url() . 'profileuser/authpassword' ?>" class="dropdown-item">Change
                                Password
                            </a>
                            <a href="<?= base_url() ?>auth/logout" class="dropdown-item">Sign Out
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>