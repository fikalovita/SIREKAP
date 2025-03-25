<section class="content">
  <div class="container-fluid" id="konten">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
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
            <div class="col-6">
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control form-control-sm" placeholder="Cari Nomer Rawat Pasien.." id="no_rawat" name="no_rawat" required>
                </div>
                <div class="col">
                  <button class="btn btn-info btn-sm" id="btn_tampil"><i class="fas fa-eye"></i> Tampilkan</button>
                  <!-- <a href="<?= base_url('RekapanSurveilanceOperasi1/print') ?>" target="_blank" class="btn btn-info btn-sm" id="btn_tampil"><i class="fas fa-eye"></i> SEK</a> -->
                  <!-- <button class="btn btn-info btn-sm" id="btn_tampil"><i class="fas fa-eye"></i> Tampilkan Coba</button> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-xl">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Formulir Surveilance Infeksi Luka Operasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="invoice p-3 mb-3">
              <h4>
                <i></i> Data Pasien
              </h4>
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  <strong>Nama</strong>
                  <address>
                    <p id="namapasien"></p>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Nomer Rekam Medis</strong>
                  <address>
                    <p id="norkm"></p>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <b>Tanggal Lahir</b><br>
                  <address>
                    <p id="tgl_lahir"></p>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <b>Tanggal Ranap</b><br>
                  <address>
                    <p id="tgl_ranap"></p>
                  </address>
                </div>
              </div>
              <div class="dropdown-divider"></div>
              <h4>
                <i></i> Keterangan Operasi
              </h4>
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <b>Nama Operasi</b>
                  <address>
                    <p id="nm_operasi"></p>
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  <b>Dokter Bedah</b><br>
                  <address>
                    <p id="dokter_bedah"></p>
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  <strong>Waktu Pembedahan</strong>
                  <address>
                    <p id="waktu_pembedahan"></p>
                  </address>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <b>Diagnosa Pre-Operasi</b>
                  <address>
                    <p id="diagnosa_preop"></p>
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  <b>Jam Operasi</b><br>
                  <address>
                    <p id="tanggal"></p>
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  <strong>Selesai</strong>
                  <address>
                    <p id="durasi"></p>
                  </address>
                </div>
              </div>
              <div class="dropdown-divider"></div>
              <h4>
                <i></i> Pre Anastesi
              </h4>
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  <b>Merokok</b>
                  <address>
                    <p id="merokok"></p>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <b>Suhu</b><br>
                  <address>
                    <p id="suhu"></p>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Terapi</strong>
                  <p id="terapi"></p>
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Angka ASA</strong>
                  <p id="asa"></p>
                </div>
              </div>
              <div class="dropdown-divider"></div>
              <h4>
                Pre Operasi
              </h4>
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  <b>Perlengkapan Khusus Alat Implan</b>
                  <p id="perlengkapan_khusus"></p>
                </div>
                <div class="col-sm-3 invoice-col">
                  <b>Pemberian Antibiotik Profilaksis</b><br>
                  <p id="antibiotik_profilaks"></p>
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Jika diberikan</strong>
                  <p id="nama_antibiotik"></p>
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Jam Pemberian</strong>
                  <p id="jam_pemberian"></p>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  <b>Petunjuk Sterilisasi Telah di konfirmasi</b>
                  <p id="petujuk_sterilisasi"></p>
                </div>
                <div class="col-sm-3 invoice-col">
                  <b>Resiko Kehilangan darah > 500ml (7ml/kg untuk anak)</b><br>
                  <p id="resiko_kehilangan_darah"></p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" id="hapus" data-dismiss="modal">Close</button>
            <!-- <button type="button" class="btn btn-success">Print</button> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?= base_url('Assets/') ?>surveilance.min.js"></script>