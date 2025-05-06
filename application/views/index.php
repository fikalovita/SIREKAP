<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RS ISLAM LUMAJNG | Dashboard</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>plugins/summernote/summernote-bs4.min.css">
</head>

<body class="layout-top-nav">
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="<?= base_url('Assets/') ?>img/rsi-logo.jpg" alt="AdminLTELogo" height="60" width="60">
    </div>
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container-fluid">
            <a href="<?= base_url('sirekap') ?>" class="navbar-brand">
                <img src="<?= base_url('Assets/') ?>img/rsi-logo.jpg" alt="AdminLTE Logo" class="brand-image" width="30px">
                <span class="brand-text font-weight-light"><strong>Dashboard Rumah Sakit Islam Lumajang</strong></span>
            </a>
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <span class="brand-text font-weight-light"><strong><?= date('d-F-Y') ?></strong></span>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('auth') ?>" class="btn btn-sm btn-info ml-3">Masuk</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="content-header">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3 id="ranap"><?= $ranap ?></h3>

                                <p>Rawat Inap</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-procedures"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $poli ?></h3>

                                <p>Poliklinik</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clinic-medical"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $igd ?></h3>

                                <p>IGD</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-ambulance"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $jkn ?></h3>

                                <p>JKN Mobile</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer fixed-bottom">
        <strong>Copyright &copy; <?= date('Y') ?> <a href="https://rsislamlumajang.co.id/">RUMAH SAKIT ISLAM LUMAJANG</a>.</strong> All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>

    <!-- jQuery -->
    <script src="<?= base_url('Assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('Assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="<?= base_url('Assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url('Assets/') ?>plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url('Assets/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('Assets/') ?>js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
</body>

</html>