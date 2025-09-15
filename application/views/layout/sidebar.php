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
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?= $this->session->userdata('nama_pegawai') ?></a>
        </div>
      </div>
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
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
                Rekam Medis
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('StatusRM') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Status RM</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('DemografiRegistrasi') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Demografi Registrasi</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('DiagnosaPasienPerUmur') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Diagnosa Pasien</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                Pasien
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('LaporanPasien') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jumlah Pasien Per-Dokter</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('SensusHarian') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sensur Harian Pasien</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('RekapRujukan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rujukan Pasien</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                Rawat Jalan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('SEPRajal') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pasien</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                Rawat Inap
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('RekapanRanap') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pasien Ranap</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('RekapanRanapKamar') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kamar Inap</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                IGD/UGD
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('RekapIGDJumlahPasien') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pasien</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="<?= base_url('RekapIGD') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Indikator Triase</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('rekapanRadiologi') ?>" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>Radiologi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                PPI
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('rekapanAuditAPD') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Audit APD</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('rekapanCuciTangan') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cuci Tangan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('RekapanSurveilanceOperasi1') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surveilance Operasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('RekapanDekubitus') ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dekubitus</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-chart-line"></i>
              <p>
                Farmasi
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
                <a href="<?= base_url('ApiBpjs') ?>" class="nav-link">
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
    <script>
      $(document).ready(function() {
        var currentUrl = window.location.origin + window.location.pathname;
        $('.nav-sidebar a').each(function() {
          if (this.href === currentUrl) {
            $(this).addClass('active');
            var treeview = $(this).closest('.nav-treeview');
            if (treeview.length) {
              var parent = treeview.closest('.nav-item');
              parent.children('.nav-link').addClass('active');
            }
          }
        });
      });
    </script>