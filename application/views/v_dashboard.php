<section class="content">
    <div class="container-fluid" id="konten">
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