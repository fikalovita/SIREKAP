function hapusdata() {
    document.getElementById("namapasien").innerHTML = "";
    document.getElementById("norkm").innerHTML = "";
    document.getElementById("tgl_lahir").innerHTML = "";
    document.getElementById("tgl_ranap").innerHTML = "";

    document.getElementById("nm_operasi").innerHTML = "";
    document.getElementById("dokter_bedah").innerHTML = "";
    document.getElementById("waktu_pembedahan").innerHTML = "";
    document.getElementById("diagnosa_preop").innerHTML = "";
    document.getElementById("tanggal").innerHTML = "";
    document.getElementById("durasi").innerHTML = "";
    document.getElementById("merokok").innerHTML = "";
    document.getElementById("suhu").innerHTML = "";
    document.getElementById("terapi").innerHTML = "";
    document.getElementById("asa").innerHTML = "";
    document.getElementById("perlengkapan_khusus").innerHTML = "";
    document.getElementById("antibiotik_profilaks").innerHTML = "";
    document.getElementById("nama_antibiotik").innerHTML = "";
    document.getElementById("jam_pemberian").innerHTML = "";
    document.getElementById("petujuk_sterilisasi").innerHTML = "";
    document.getElementById("resiko_kehilangan_darah").innerHTML = "";
  }

  $(document).ready(function() {
  $('#btn_tampil').on('click', function() {
    var norawat = $('#no_rawat').val();
    hapusdata()
    $.ajax({
      type: "POST",
      url: "http://192.168.1.144/dashboard/RekapanSurveilanceOperasi1/data",
      async: true,
      dataType: "JSON",
      data: {
        jnorawat: norawat,
      },
      success: function(data) {
        let operasi = data['validasi_operasi'][0]['row'];
        // console.log(operasi);
        if (operasi == '0') {
          alert("Data Rekapan Surveilance yang dicari tidak ada");
        } else {
          $("#modal-xl").modal('show');

          document.getElementById("namapasien").innerHTML += data['pasien'][0]['nm_pasien'];
          document.getElementById("norkm").innerHTML += data['pasien'][0]['no_rkm_medis'];
          document.getElementById("tgl_lahir").innerHTML += data['pasien'][0]['tgl_lahir'];
          document.getElementById("tgl_ranap").innerHTML += data['pasien'][0]['tgl_registrasi'];
          document.getElementById("nm_operasi").innerHTML += data['operasi'][0]['nm_operasi'];
          document.getElementById("dokter_bedah").innerHTML += data['operasi'][0]['nm_dokter'];
          document.getElementById("waktu_pembedahan").innerHTML += data['operasi'][0]['waktu_pembedahan'];
          document.getElementById("diagnosa_preop").innerHTML += data['operasi'][0]['diagnosa_preop'];
          document.getElementById("tanggal").innerHTML += data['operasi'][0]['tanggal'];
          document.getElementById("durasi").innerHTML += data['operasi'][0]['durasi'];
          document.getElementById("merokok").innerHTML += data['preanastesi'][0]['riwayat_kebiasaan_merokok'];
          document.getElementById("suhu").innerHTML += data['preanastesi'][0]['suhu'];
          document.getElementById("terapi").innerHTML += data['preanastesi'][0]['riwayat_penyakit_terapi'];
          document.getElementById("asa").innerHTML += data['preanastesi'][0]['asa'];
          document.getElementById("perlengkapan_khusus").innerHTML += data['checklist_preoperasi'][0]['perlengkapan_khusus'];
          document.getElementById("antibiotik_profilaks").innerHTML += data['datatimeout'][0]['antibiotik_profilaks'];
          document.getElementById("nama_antibiotik").innerHTML += data['datatimeout'][0]['nama_antibiotik'];
          document.getElementById("jam_pemberian").innerHTML += data['datatimeout'][0]['jam_pemberian'];
          document.getElementById("petujuk_sterilisasi").innerHTML += data['datatimeout'][0]['petujuk_sterilisasi'];
          document.getElementById("resiko_kehilangan_darah").innerHTML += data['signin_sebelum_anestesi'][0]['resiko_kehilangan_darah'];
        }
      }
    });
  });
  });