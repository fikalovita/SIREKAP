<section class="content">
    <div class="container-fluid" id="konten">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        Data Periksa Laboratorium
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalPLab">
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
                    <div class="modal fade" id="modalPLab" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalPLab">Filter</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <div class="form-row">
                                            <div class="col">
                                                <?php
                                                $startYear = '2018';
                                                $endYear = date('Y');
                                                ?>
                                                <div class="form-group">
                                                    <select class="form-control" id="tahun4" name="tahun4">
                                                        <option>--Pilih Tahun--</option>
                                                        <?php for ($i = $startYear; $i <= $endYear; $i++) : ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php endfor ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select class="form-control" id="bulan4" name="bulan4">
                                                        <option value="">--Pilih Bulan--</option>
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
                                    <button class="btn btn-primary" id="tampil-periksa-lab">Tampilkan</button>
                                    <button class="btn btn-success" id="button-export-excel">Export Excel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-lg table-bordered table-sm" id="tabel-periksa-lab">
                            <thead>
                                <tr>
                                    <th>kode</th>
                                    <th>Nama Pemeriksaan</th>
                                    <th>Jumlah Pemeriksaan</th>
                                    <th>Laki-Laki</th>
                                    <th>Perempuan</th>
                                    <th>Rata-rata Periksa Laki-laki</th>
                                    <th>Rata-rata Periksa Perempuan</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer">
                        Footer
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<script>
    $('#button-export-excel').on('click', function() {
        exportExcel();
        $('#modalPLab').modal('hide');
    });

    let dataPeriksalab = $('#tabel-periksa-lab').DataTable({
        processing: true,
        serverSide: true,
        orderable: false,
        searching: false,
        ajax: {
            url: "<?= base_url('PeriksaLab/dataPeriksaLab') ?>",
            type: "POST",
            data: function(data) {
                data.tahun4 = $('#tahun4').val();
                data.bulan4 = $('#bulan4').val();
            },
        }
    })
    $('#tampil-periksa-lab').on('click', function() {
        $('#modalPLab').modal('hide');
        dataPeriksalab.ajax.reload();
    });

    function exportExcel() {
        let tahun4 = $('#tahun4').val();
        let bulan4 = $('#bulan4').val();
        if (tahun4 == '' && bulan4 == '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                background: '#17a2b8', // Warna latar belakang (green)
                color: 'white'
            });
            Toast.fire({
                icon: 'error',
                title: 'Tanggal Harus di Isi',
            })
        } else {
            let url = window.location.href = '<?= base_url('PeriksaLab/export_excel/') ?>' + tahun4 + '/' + bulan4;
        }

    }
</script>