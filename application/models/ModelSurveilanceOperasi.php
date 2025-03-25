<?php
class ModelSurveilanceOperasi extends CI_Model
{
    public function pasien($norawat)
    {
        $this->db->select('p.nm_pasien, p.no_rkm_medis, p.tgl_lahir, rp.tgl_registrasi');
        $this->db->from('reg_periksa rp');
        $this->db->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis', 'inner');
        $this->db->where('rp.no_rawat', $norawat);

        return $this->db->get();
    }

    public function operasi($norawat)
    {
        $this->db->select('lo.nm_operasi, d.nm_dokter, lo.waktu_pembedahan, lo.diagnosa_preop, lo.tanggal,TIMEDIFF(lo.tanggal,lo.selesaioperasi) as durasi');
        $this->db->from('laporan_operasi lo');
        $this->db->join('reg_periksa rp', 'lo.no_rawat = rp.no_rawat', 'inner');
        $this->db->join('operasi o', 'rp.no_rawat = o.no_rawat', 'inner');
        $this->db->join('dokter d', 'o.operator1 = d.kd_dokter');
        $this->db->where('lo.no_rawat', $norawat);

        return $this->db->get();
    }

    public function operasi_validasi($norawat)
    {
        $this->db->select('COUNT(o.no_rawat) as row');
        $this->db->from('laporan_operasi o');
        $this->db->where('o.no_rawat', $norawat);

        return $this->db->get();
    }
    public function preanastesi($norawat)
    {
        $this->db->select('ppa.riwayat_kebiasaan_merokok, ppa.suhu, ppa.riwayat_penyakit_terapi, ppa.asa');
        $this->db->from('penilaian_pre_anestesi ppa');
        $this->db->where('ppa.no_rawat', $norawat);

        return $this->db->get();
    }

    public function preoperasi($norawat)
    {
        $this->db->select('cpo.perlengkapan_khusus');
        $this->db->from('checklist_pre_operasi cpo');
        $this->db->where('cpo.no_rawat', $norawat);

        return $this->db->get();
    }
    public function timeout_sebelum_insisi($norawat)
    {
        $this->db->select('tsi.antibiotik_profilaks, tsi.nama_antibiotik, tsi.jam_pemberian, tsi.petujuk_sterilisasi');
        $this->db->from('timeout_sebelum_insisi tsi');
        $this->db->where('tsi.no_rawat', $norawat);

        return $this->db->get();
    }

    public function signin_sebelum_anestesi($norawat)
    {
        $this->db->select('ssa.resiko_kehilangan_darah');
        $this->db->from('signin_sebelum_anestesi ssa');
        $this->db->where('ssa.no_rawat', $norawat);

        return $this->db->get();
    }
}
