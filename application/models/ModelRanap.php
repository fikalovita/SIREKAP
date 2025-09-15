<?php
class ModelRanap extends CI_Model
{

    public function getPasienRanap($tglAwal, $tglAkhir, $search)
    {
        $this->db->select('ki.no_rawat, rp.tgl_registrasi, ki.tgl_masuk, p.nm_pasien, b.nm_bangsal');
        $this->db->from('kamar_inap ki');
        $this->db->join('reg_periksa rp', 'ki.no_rawat = rp.no_rawat', 'inner');
        $this->db->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis', 'inner');
        $this->db->join('kamar k', 'ki.kd_kamar = k.kd_kamar', 'inner');
        $this->db->join('bangsal b', 'k.kd_bangsal = b.kd_bangsal', 'inner');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('ki.no_rawat', $search);
            $this->db->or_like('p.nm_pasien', $search);
            $this->db->or_like('b.nm_bangsal', $search);
            $this->db->group_end();
        }

        if (!empty($tglAwal) && !empty($tglAkhir)) {
            $this->db->where('ki.tgl_masuk >=', $tglAwal);
            $this->db->where('ki.tgl_masuk <=', $tglAkhir);
        }
        //$this->db->group_by('ki.no_rawat');
        $this->db->where('ki.stts_pulang <>', 'Pindah Kamar');
    }

    public function TampilPasienRanap($tglAwal, $tglAkhir, $start, $length, $search)
    {
        $this->getPasienRanap($tglAwal, $tglAkhir, $search);
        $this->db->order_by('ki.tgl_masuk');
        $this->db->limit($length, $start);

        return $this->db->get();
    }

    public function JmlHalamanPasienRanap($tglAwal, $tglAkhir, $search)
    {
        $this->getPasienRanap($tglAwal, $tglAkhir, $search);

        return $this->db->get();
    }

    public function JmlBangsal($tglAwal, $tglAkhir)
    {
        $this->db->select('CASE WHEN b.nm_bangsal LIKE "RUANG ISOLASI%" THEN "RUANG ISOLASI" 
        WHEN b.nm_bangsal LIKE "RUANGAN ISOLASI%" THEN "MARWAH-ISOLASI" 
        WHEN b.nm_bangsal LIKE "MARWAH NIFAS%" THEN "MARWAH-NIFAS"
        ELSE SUBSTRING_INDEX (b.nm_bangsal, " ", 1) END AS nama_group, SUM(ki.lama) as total_perawatan, count(ki.lama) as total, k.kelas');
        $this->db->from('kamar_inap ki');
        $this->db->join('kamar k', 'ki.kd_kamar = k.kd_kamar', 'inner');
        $this->db->join('bangsal b', 'k.kd_bangsal = b.kd_bangsal', 'inner');

        if (!empty($tglAwal) && !empty($tglAkhir)) {
            $this->db->where('ki.tgl_masuk >=', $tglAwal);
            $this->db->where('ki.tgl_masuk <=', $tglAkhir);
        }
    }

    public function TampilJmlBangsal($tglAwal, $tglAkhir)
    {
        $this->JmlBangsal($tglAwal, $tglAkhir);
        $this->db->where('k.statusdata', '1');
        $this->db->where_not_in('k.kd_bangsal', ['VK', 'B0062']);
        //$this->db->where('ki.stts_pulang <>', 'Pindah Kamar');
        $this->db->group_by('nama_group');
        $this->db->order_by('k.kelas');

        return $this->db->get();
    }

    public function jumlahTT()
    {
        $this->db->select('count(kamar.kd_bangsal) as jml_tt');
        $this->db->from('kamar');
        $this->db->where('kamar.statusdata', '1');
        $this->db->where_not_in('kamar.kd_bangsal', ['VK', 'B0062']);
        return $this->db->get();
    }

    public function kunjunganRanap($tglAwal, $tglAkhir)
    {
        $this->db->select('count(kamar_inap.no_rawat) as jml_kunjungan_ranap');
        $this->db->from('kamar_inap');
        $this->db->where('kamar_inap.tgl_masuk >=', $tglAwal);
        $this->db->where('kamar_inap.tgl_masuk <=', $tglAkhir);
        $this->db->where('kamar_inap.stts_pulang <>', 'Pindah Kamar');

        return $this->db->get();
    }
}
