<section class="content">
  <div class="container-fluid" id="konten">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            Obat Per Dokter Ranap
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
            <div class="row">
              <div class="col-8 flex-wrap">
                <div method="POST">
                  <div class="row">
                    <div class="col- ">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal1" name="tanggal1" required>
                    </div>
                    <div class="col-">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2" required>
                    </div>
                    <div class="col-">
                      <select class="form-control form-control-sm" name="dokter" id="dokter">
                        <option value="">--Pilih Dokter--</option>
                        <option value="1">Dokter DPJP</option>
                        <option value="2">Dokter Jaga</option>
                      </select>
                    </div>
                    <div class="col- ml-2">
                      <button class="btn btn-info btn-sm" id="tampil-obat-ranap"><i class="fas fa-eye"></i> Tampilkan</button>
                      <button class="btn btn-success btn-sm" id="btn-export-excel"><i class="far fa-file-excel"></i> Export Excel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive-lg table-bordered table-sm" id="table-obat-dokter-ranap">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Dokter</th>
                  <th scope="col">Obat</th>
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
    $("#tanggal1, #tanggal2").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });
  });
</script>
<script>
  $(document).ready(function() {
    let tabelObatDokterRanap = $('#table-obat-dokter-ranap').DataTable({
      processing: true,
      serverSide: true,
      orderable: false,
      searching: false,
      paging: false,
      info: false,
      ajax: {
        url: "<?= base_url('ObatPerDokterRanap/dataObatDokterRanap') ?>",
        type: "POST",
        data: function(data) {
          data.tanggal1 = $('#tanggal1').val();
          data.tanggal2 = $('#tanggal2').val();
          data.dokter = $('#dokter').val();
        },
      }
    })
    $('#tampil-obat-ranap').on('click', function() {
      let tanggal1 = $('#tanggal1').val();
      let tanggal2 = $('#tanggal2').val();
      let dokter = $('#dokter').val();
      if (tanggal1 == '' || tanggal2 == '' || dokter == '') {
        alert("Tanggal dan dokter harus di isi");
      } else {
        tabelObatDokterRanap.ajax.reload();
      }

    })

  });

  $('#btn-export-excel').on('click', function() {
    exportExcelCAuditApd();
  })

  function exportExcelCAuditApd() {
    let tanggal1 = $('#tanggal1').val();
    let tanggal2 = $('#tanggal2').val();
    let dokter = $('#dokter').val();
    if (tanggal1 == '' && tanggal2 == '') {
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
        background: '#17a2b8',
        color: 'white'
      });
      Toast.fire({
        icon: 'error',
        title: 'Tanggal Harus di Isi',
      })
    } else if (dokter == '') {
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
        background: '#17a2b8',
        color: 'white'
      });
      Toast.fire({
        icon: 'error',
        title: 'Dokter Harus di Isi',
      })
    } else {
      if ($('#dokter').val() == '2') {
        let url = window.location.href = '<?= base_url('ObatPerDokterRanap/export_excel/') ?>' + tanggal1 + '/' + tanggal2 + '/' + dokter;
      } else if ($('#dokter').val() == '1') {
        let url = window.location.href = '<?= base_url('ObatPerDokterRanap/export_excel_dpjp/') ?>' + tanggal1 + '/' + tanggal2 + '/' + dokter;
      }

    }

  }
</script>