<section class="content">
    <div class="container-fluid" id="konten">
        <div class="row">
            <div class="col-6">
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
                                    <h5 class="modal-title" id="modalPLab">Filter Tanggal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Pilih Tanggal Awal" name="tglAwal" id="tglAwal">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" placeholder="Pilih Tanggal Akhir" name="tglAkhir" id="tglAkhir">
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
    $(function() {
        $("#tglAwal").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    });
    $(function() {
        $("#tglAkhir").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<script>
    $('#tampil-periksa-lab').on('click', function() {
        $('#modalPLab').modal('hide');
        dataPeriksalab.ajax.reload();
    });
    $('#button-export-excel').on('click', function() {
        exportExcel();
        $('#modalPLab').modal('hide');

    });

    let dataPeriksalab = $('#tabel-periksa-lab').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('PeriksaLab/dataPeriksaLab') ?>",
            type: "POST",
            data: function(data) {
                data.tglAwal = $('#tglAwal').val();
                data.tglAkhir = $('#tglAkhir').val();
            },

            buttons: [{
                extend: 'excelHtml5',
                text: 'Export to Excel',
                title: 'User Data'
            }]
        }
    })

    function exportExcel() {
        let tglAwal1 = $('#tglAwal').val();
        let tglAkhir2 = $('#tglAkhir').val();
        if (tglAwal1 == '' && tglAkhir2 == '') {
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
            let url = window.location.href = '<?= base_url('PeriksaLab/export_excel/') ?>' + tglAwal1 + '/' + tglAkhir2;
        }

    }
</script>