<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      </li>
      <li class="nav-item">
        <form action="<?= base_url('auth/logout') ?>" method="post" style="display: inline;">
          <button type="submit" class="btn btn-danger btn-sm">
            <i class="fas fa-sign-out-alt"></i> Logout
          </button>
        </form>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <img src="<?= base_url('Assets/') ?>img/rsi.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIREKAP</span>
    </a>
    <div class="sidebar" style="overflow-y: auto; height: 100vh;">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?= $this->session->userdata('nama_pegawai') ?></a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= base_url('Dashboard') ?>" class="nav-link">
              <i class="fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('rekapanauditapd') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Audit APD</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('rekapanRadiologi') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Radiologi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('rekapanCuciTangan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cuci Tangan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                Laporan Obat
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('ObatPerDokter') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Obat Per Dokter Ranap</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                Laporan Pasien
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('LaporanPasien') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jumlah Pasien Per Dokter</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                Rekap Operasi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('RekapanSurveilanceOperasi1') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rekap Surveilance Operasi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('RekapanDekubitus') ?>" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                Rekap Dekubitus
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                Laboratorium
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('PeriksaLab') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Pemeriksaan</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                BPJS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('apiBpjs') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Get Peserta</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('RekapanTaskID') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Task ID</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 page-title">
            <h1><?= $title ?></h1>
          </div>
        </div>
    </section>