<section class="content">
    <div class="container-fluid" id="konten">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-procedures"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Rawat Inap</span>
                        <span class="info-box-number"><?= $ranap ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= $ranap ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- info box -->
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-clinic-medical"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Poliklinik</span>
                        <span class="info-box-number"><?= $poli ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= $poli ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- info box -->
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-ambulance"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">IGD</span>
                        <span class="info-box-number"><?= $igd ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= $igd ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <div class="info-box bg-danger">
                    <span class="info-box-icon"><i class="fas fa-mobile-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">JKN</span>
                        <span class="info-box-number"><?= $jkn ?></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: <?= $jkn ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Kamar Inap
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-lg table-sm table-bordered" id="tabel-ranap">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Kamar</th>
                                    <th scope="col">Jumlah Kamar</th>
                                    <th scope="col">Isi</th>
                                    <th scope="col">Kosong</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($statusKamar as $sk): ?>
                                    <tr>
                                        <td><?= $sk->nm_bangsal ?></td>
                                        <td><?= $sk->jumlah_kmr ?></td>
                                        <td><?= $sk->kmr_isi ?></td>
                                        <td><?= $sk->kmr_kosong ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Poliklinik
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-lg table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Poliklinik</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Jumlah Pasien</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pasienPoli as $px): ?>
                                    <tr>
                                        <td><?= $px->nm_poli ?></td>
                                        <td><?= $px->nm_dokter ?></td>
                                        <td><?= $px->jumlah ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Poliklinik
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-lg table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Poliklinik</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Jenis Bayar</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($caraBayar as $cb): ?>
                                    <tr>
                                        <td><?= $cb->nm_poli ?></td>
                                        <td><?= $cb->nm_dokter ?></td>
                                        <td><?= $cb->png_jawab ?></td>
                                        <td><?= $cb->jns_bayar ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $('#tabel-ranap').DataTable();
</script>