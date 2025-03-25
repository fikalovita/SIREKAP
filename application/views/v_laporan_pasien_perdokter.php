<section class="content">
    <div class="container-fluid" id="konten">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Laporan Pasien Per Dokter Ranap
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalPx">
                                <i class="fas fa-filter"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal fade" id="modalPx" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal1">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div method="post">
                                        <div class="form-row">
                                            <div class="col">
                                                <?php
                                                $startYear = '2018';
                                                $endYear = date('Y');
                                                ?>
                                                <div class="form-group">
                                                    <select class="form-control" id="tahun" name="tahun">
                                                        <option>--Pilih Tahun--</option>
                                                        <?php for ($i = $startYear; $i <= $endYear; $i++) : ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php endfor ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select class="form-control" id="bulan" name="bulan">
                                                        <option>--Pilih Bulan--</option>
                                                        <option value="01">Januari</option>
                                                        <option value="02">Februari</option>
                                                        <option value="03">Maret</option>
                                                        <option value="04">April</option>
                                                        <option value="05">Mei</option>
                                                        <option value="06">Juni</option>
                                                        <option value="07">Juli</option>
                                                        <option value="08">Agustus</option>
                                                        <option value="09">September</option>
                                                        <option value="10">Oktober</option>
                                                        <option value="11">November</option>
                                                        <option value="12">Desember</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" id="tampil-pasien-ranap">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 flex-wrap">
                            </div>
                        </div>
                        <table class="table table-responsive-lg table-bordered" id="tabel-laporan-pasien">
                            <thead>
                                <tr>
                                    <th>Nama Dokter</th>
                                    <th>Jumlah Pasien</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer">
                        Footer
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Laporan Pasien Per Dokter IGD
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalPx2">
                                <i class="fas fa-filter"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal fade" id="modalPx2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal2">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div method="post">
                                        <div class="form-row">
                                            <div class="col">
                                                <?php
                                                $startYear = '2018';
                                                $endYear = date('Y');
                                                ?>
                                                <div class="form-group">
                                                    <select class="form-control" id="tahun2" name="tahun2">
                                                        <option>--Pilih Tahun--</option>
                                                        <?php for ($i = $startYear; $i <= $endYear; $i++) : ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php endfor ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select class="form-control" id="bulan2" name="bulan2">
                                                        <option>--Pilih Bulan--</option>
                                                        <option value="01">Januari</option>
                                                        <option value="02">Februari</option>
                                                        <option value="03">Maret</option>
                                                        <option value="04">April</option>
                                                        <option value="05">Mei</option>
                                                        <option value="06">Juni</option>
                                                        <option value="07">Juli</option>
                                                        <option value="08">Agustus</option>
                                                        <option value="09">September</option>
                                                        <option value="10">Oktober</option>
                                                        <option value="11">November</option>
                                                        <option value="12">Desember</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" id="tampil-pasien-igd">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 flex-wrap">
                            </div>
                        </div>
                        <table class="table table-responsive-lg table-bordered" id="tabel-laporan-pasien2">
                            <thead>
                                <tr>
                                    <th>Nama Dokter</th>
                                    <th>Jumlah Pasien</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer">
                        Footer
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        let tabelLaporanPasien = $('#tabel-laporan-pasien').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('LaporanPasien/dataPasienPerBulan') ?>",
                type: "POST",
                data: function(data) {
                    data.bulan = $('#bulan').val();
                    data.tahun = $('#tahun').val();
                }

            }
        })

        $('#tampil-pasien-ranap').on('click', function() {
            tabelLaporanPasien.ajax.reload();
            $('#modalPx').modal('hide');
        })
    });
</script>
<script>
    $(document).ready(function() {
        let tabelLaporanPasien2 = $('#tabel-laporan-pasien2').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('LaporanPasien/dataPasienIGD') ?>",
                type: "POST",
                data: function(data) {
                    data.bulan2 = $('#bulan2').val();
                    data.tahun2 = $('#tahun2').val();
                }
            }
        })
        $('#tampil-pasien-igd').on('click', function() {
            tabelLaporanPasien2.ajax.reload();
            $('#modalPx2').modal('hide');
        })
    });
</script>