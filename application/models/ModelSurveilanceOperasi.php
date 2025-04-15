<?php
class ModelSurveilanceOperasi extends CI_Model
{
    public function DaftarPasien_OP($tanggal3, $tanggal4, $start, $length, $search)
    {
        $this->db->select('laporan_operasi.no_rawat, pasien.no_rkm_medis, pasien.nm_pasien, reg_periksa.status_lanjut');
        $this->db->from('laporan_operasi');
        $this->db->join('reg_periksa', 'laporan_operasi.no_rawat = reg_periksa.no_rawat');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('laporan_operasi.no_rawat', $search);
            $this->db->or_like('pasien.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->group_end();
        }

        $this->db->where('date(laporan_operasi.tanggal) >=', $tanggal3);
        $this->db->where('date(laporan_operasi.tanggal) <=', $tanggal4);
        $this->db->group_by('laporan_operasi.no_rawat');
        $this->db->order_by('laporan_operasi.tanggal', 'DESC');
        $this->db->limit($length, $start);


        return $this->db->get();
    }

    public function CountDaftarPasien_OP($tanggal3, $tanggal4, $search)
    {
        $this->db->select('laporan_operasi.no_rawat, pasien.no_rkm_medis, pasien.nm_pasien');
        $this->db->from('laporan_operasi');
        $this->db->join('reg_periksa', 'laporan_operasi.no_rawat = reg_periksa.no_rawat');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('laporan_operasi.no_rawat', $search);
            $this->db->or_like('pasien.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->group_end();
        }

        $this->db->where('date(laporan_operasi.tanggal) >=', $tanggal3);
        $this->db->where('date(laporan_operasi.tanggal) <=', $tanggal4);
        $this->db->group_by('laporan_operasi.no_rawat');
        $this->db->order_by('laporan_operasi.tanggal', 'DESC');

        return $this->db->count_all_results();
    }

    public function totalOperasi($norawat)
    {
        $this->db->select('COUNT(laporan_operasi.no_rawat) AS total_op');
        $this->db->from('laporan_operasi');
        $this->db->where('laporan_operasi.no_rawat', $norawat);

        return $this->db->get();
    }

    public function totalPreAnastesi($norawat)
    {
        $this->db->select('COUNT(penilaian_pre_anestesi.no_rawat) as total_preanastesi');
        $this->db->from('penilaian_pre_anestesi');
        $this->db->where('penilaian_pre_anestesi.no_rawat', $norawat);

        return $this->db->get();
    }

    public function totalPreOp($norawat)
    {
        $this->db->select('COUNT(checklist_pre_operasi.no_rawat) as total_preop');
        $this->db->from('checklist_pre_operasi');
        $this->db->where('checklist_pre_operasi.no_rawat', $norawat);

        return $this->db->get();
    }

    public function totalTimeoutSebelumInsisi($norawat)
    {
        $this->db->select('COUNT(timeout_sebelum_insisi.no_rawat) as total_tsi');
        $this->db->from('timeout_sebelum_insisi');
        $this->db->where('timeout_sebelum_insisi.no_rawat', $norawat);

        return $this->db->get();
    }

    public function totalSigninSebelumAnestesi($norawat)
    {
        $this->db->select('COUNT(signin_sebelum_anestesi.no_rawat) as total_ssa');
        $this->db->from('signin_sebelum_anestesi');
        $this->db->where('signin_sebelum_anestesi.no_rawat', $norawat);

        return $this->db->get();
    }

    public function pasien($norawat)
    {
        $this->db->select('pasien.nm_pasien, pasien.no_rkm_medis, pasien.tgl_lahir, reg_periksa.tgl_registrasi');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');
        $this->db->where('reg_periksa.no_rawat', $norawat);

        return $this->db->get();
    }

    public function LaporanOperasi($norawat)
    {
        $this->db->select('laporan_operasi.no_rawat,laporan_operasi.nm_operasi, 
                        laporan_operasi.waktu_pembedahan,
                        laporan_operasi.diagnosa_preop,
                        laporan_operasi.tanggal,
                        laporan_operasi.selesaioperasi,
                        TIMEDIFF(laporan_operasi.selesaioperasi,laporan_operasi.tanggal) as durasi');
        $this->db->from('laporan_operasi');
        $this->db->where('laporan_operasi.no_rawat', $norawat);

        return $this->db->get()->result();;
    }

    public function OperasiCoba($norawat)
    {
        $this->db->select('operasi.no_rawat,operasi.tgl_operasi, dokter.nm_dokter');
        $this->db->from('operasi');
        $this->db->join('dokter', 'operasi.operator1 = dokter.kd_dokter', 'inner');
        $this->db->where('operasi.no_rawat', $norawat);

        return $this->db->get()->result();;
    }

    public function GabunganOperasi($norawat)
    {
        $LaporanOperasi = $this->LaporanOperasi($norawat);
        $Operasi = $this->OperasiCoba($norawat);

        $result = [];
        foreach ($LaporanOperasi as $LO) {
            foreach ($Operasi as $O) {
                if ($LO->no_rawat == $O->no_rawat && $LO->tanggal == $O->tgl_operasi) {
                    $result[] = (object)[
                        'nm_operasi' => $LO->nm_operasi,
                        'nm_dokter' => $O->nm_dokter,
                        'waktu_pembedahan' => $LO->waktu_pembedahan,
                        'diagnosa_preop' => $LO->diagnosa_preop,
                        'tanggal' => $LO->tanggal,
                        'selesaioperasi' => $LO->selesaioperasi,
                        'durasi' => $LO->durasi
                    ];
                }
            }
        }
        return $result;
    }

    // public function operasi($norawat)
    // {
    //     $this->db->select('lo.nm_operasi, d.nm_dokter, lo.waktu_pembedahan, lo.diagnosa_preop, lo.tanggal,lo.selesaioperasi,TIMEDIFF(lo.selesaioperasi,lo.tanggal) as durasi');
    //     $this->db->from('laporan_operasi lo');
    //     $this->db->join('reg_periksa rp', 'lo.no_rawat = rp.no_rawat', 'inner');
    //     $this->db->join('operasi o', 'rp.no_rawat = o.no_rawat', 'inner');
    //     $this->db->join('dokter d', 'o.operator1 = d.kd_dokter');
    //     $this->db->where('lo.no_rawat', $norawat);
    //     $this->db->group_by('o.tgl_operasi');

    //     return $this->db->get();
    // }

    public function operasi_validasi($norawat)
    {
        $this->db->select('COUNT(laporan_operasi.no_rawat) as row');
        $this->db->from('laporan_operasi');
        $this->db->where('laporan_operasi.no_rawat', $norawat);

        return $this->db->get();
    }

    public function preanastesi($norawat)
    {
        $this->db->select('penilaian_pre_anestesi.no_rawat, penilaian_pre_anestesi.tanggal, penilaian_pre_anestesi.riwayat_kebiasaan_merokok, penilaian_pre_anestesi.suhu, penilaian_pre_anestesi.riwayat_penyakit_terapi, penilaian_pre_anestesi.asa');
        $this->db->from('penilaian_pre_anestesi');
        $this->db->where('penilaian_pre_anestesi.no_rawat', $norawat);

        return $this->db->get();
    }

    public function preoperasi($norawat)
    {
        $this->db->select('checklist_pre_operasi.tanggal, checklist_pre_operasi.perlengkapan_khusus');
        $this->db->from('checklist_pre_operasi');
        $this->db->where('checklist_pre_operasi.no_rawat', $norawat);

        return $this->db->get();
    }

    public function timeout_sebelum_insisi($norawat)
    {
        $this->db->select('timeout_sebelum_insisi.tanggal, timeout_sebelum_insisi.antibiotik_profilaks, timeout_sebelum_insisi.nama_antibiotik, timeout_sebelum_insisi.jam_pemberian, timeout_sebelum_insisi.petujuk_sterilisasi');
        $this->db->from('timeout_sebelum_insisi');
        $this->db->where('timeout_sebelum_insisi.no_rawat', $norawat);

        return $this->db->get();
    }

    public function signin_sebelum_anestesi($norawat)
    {
        $this->db->select('signin_sebelum_anestesi.tanggal, signin_sebelum_anestesi.resiko_kehilangan_darah');
        $this->db->from('signin_sebelum_anestesi');
        $this->db->where('signin_sebelum_anestesi.no_rawat', $norawat);

        return $this->db->get();
    }

    public function excelLaporanOperasi($tanggal1, $tanggal2)
    {

        $this->db->select('laporan_operasi.no_rawat, reg_periksa.no_rkm_medis, pasien.nm_pasien, dokter.nm_dokter, laporan_operasi.diagnosa_preop, laporan_operasi.tanggal, laporan_operasi.selesaioperasi, TIMEDIFF(laporan_operasi.selesaioperasi,laporan_operasi.tanggal) as durasi');
        $this->db->from('laporan_operasi');
        $this->db->join('reg_periksa', 'laporan_operasi.no_rawat=reg_periksa.no_rawat', 'inner');
        $this->db->join('operasi', 'reg_periksa.no_rawat=operasi.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'inner');
        $this->db->join('dokter', 'operasi.operator1=dokter.kd_dokter', 'inner');
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('date(laporan_operasi.tanggal) >=', $tanggal1);
            $this->db->where('date(laporan_operasi.tanggal) <=', $tanggal2);
        }
        $this->db->order_by('laporan_operasi.tanggal', 'ASC');

        return $this->db->get();
    }

    public function excelPreAnastesi($tanggal1, $tanggal2)
    {

        $this->db->select('penilaian_pre_anestesi.no_rawat,pasien.no_rkm_medis,pasien.nm_pasien,dokter.nm_dokter, penilaian_pre_anestesi.no_rawat,penilaian_pre_anestesi.riwayat_kebiasaan_merokok, penilaian_pre_anestesi.suhu, penilaian_pre_anestesi.riwayat_penyakit_terapi, penilaian_pre_anestesi.asa');
        $this->db->from('penilaian_pre_anestesi');
        $this->db->join('reg_periksa', 'penilaian_pre_anestesi.no_rawat=reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'inner');
        $this->db->join('dokter', 'penilaian_pre_anestesi.kd_dokter=dokter.kd_dokter', 'inner');
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('date(penilaian_pre_anestesi.tanggal) >=', $tanggal1);
            $this->db->where('date(penilaian_pre_anestesi.tanggal) <=', $tanggal2);
        }
        $this->db->order_by('penilaian_pre_anestesi.tanggal', 'ASC');

        return $this->db->get();
    }

    public function excelChecklistPreOperasi($tanggal1, $tanggal2)
    {
        $this->db->select('checklist_pre_operasi.no_rawat, pasien.no_rkm_medis,pasien.nm_pasien,dokter.nm_dokter, checklist_pre_operasi.perlengkapan_khusus');
        $this->db->from('checklist_pre_operasi');
        $this->db->join('reg_periksa', 'checklist_pre_operasi.no_rawat = reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');
        $this->db->join('dokter', 'checklist_pre_operasi.kd_dokter_bedah = dokter.kd_dokter', 'inner');
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('date(checklist_pre_operasi.tanggal) >=', $tanggal1);
            $this->db->where('date(checklist_pre_operasi.tanggal) <=', $tanggal2);
        }
        $this->db->order_by('checklist_pre_operasi.tanggal', 'ASC');

        return $this->db->get();
    }

    public function excelTimeoutSebelumInsisi($tanggal1, $tanggal2)
    {
        $this->db->select('timeout_sebelum_insisi.no_rawat, pasien.no_rkm_medis, pasien.nm_pasien, dokter.nm_dokter, timeout_sebelum_insisi.antibiotik_profilaks, timeout_sebelum_insisi.nama_antibiotik, timeout_sebelum_insisi.jam_pemberian, timeout_sebelum_insisi.petujuk_sterilisasi');
        $this->db->from('timeout_sebelum_insisi');
        $this->db->join('reg_periksa', 'timeout_sebelum_insisi.no_rawat = reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');
        $this->db->join('dokter', 'timeout_sebelum_insisi.kd_dokter_bedah = dokter.kd_dokter', 'inner');
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('date(timeout_sebelum_insisi.tanggal) >=', $tanggal1);
            $this->db->where('date(timeout_sebelum_insisi.tanggal) <=', $tanggal2);
        }
        $this->db->order_by('timeout_sebelum_insisi.tanggal', 'ASC');

        return $this->db->get();
    }

    public function excelSigninSebelumAnestesi($tanggal1, $tanggal2)
    {
        $this->db->select('signin_sebelum_anestesi.no_rawat, pasien.no_rkm_medis, pasien.nm_pasien, dokter.nm_dokter, signin_sebelum_anestesi.resiko_kehilangan_darah');
        $this->db->from('signin_sebelum_anestesi');
        $this->db->join('reg_periksa', 'signin_sebelum_anestesi.no_rawat = reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');
        $this->db->join('dokter', 'signin_sebelum_anestesi.kd_dokter_bedah = dokter.kd_dokter', 'inner');
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('date(signin_sebelum_anestesi.tanggal) >=', $tanggal1);
            $this->db->where('date(signin_sebelum_anestesi.tanggal) <=', $tanggal2);
        }
        $this->db->order_by('signin_sebelum_anestesi.tanggal', 'ASC');

        return $this->db->get();
    }
}
