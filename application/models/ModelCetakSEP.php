<?php
class ModelCetakSEP extends CI_Model
{
    public function getPasien($tglSep1, $tglSep2, $start = 0, $length = 0, $search = "")
    {
        $this->db->select('reg_periksa.no_rawat,reg_periksa.no_rkm_medis,pasien.nm_pasien,dokter.nm_dokter,poliklinik.nm_poli,penjab.png_jawab');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('dokter', 'reg_periksa.kd_dokter=dokter.kd_dokter', 'inner');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli');
        $this->db->join('penjab', 'reg_periksa.kd_pj=penjab.kd_pj');
        $this->db->where('poliklinik.kd_poli<>', 'IGDK');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.no_rawat', $search);
            $this->db->or_like('reg_periksa.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->or_like('dokter.nm_dokter', $search);
            $this->db->group_end();
        }
        if (!empty($tglSep1) && !empty($tglSep2)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tglSep1);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tglSep2);
        }


        $this->db->limit($length, $start);
        return $this->db->get();
    }

    public function countPasien($tglSep1, $tglSep2, $search)
    {
        $this->db->select('reg_periksa.no_rawat,reg_periksa.no_rkm_medis,pasien.nm_pasien,dokter.nm_dokter,poliklinik.nm_poli');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('dokter', 'reg_periksa.kd_dokter=dokter.kd_dokter', 'inner');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli');

        $this->db->where('poliklinik.kd_poli<>', 'IGDK');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.no_rawat', $search);
            $this->db->or_like('reg_periksa.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->or_like('dokter.nm_dokter', $search);
            $this->db->group_end();
        }

        if (!empty($tglSep1) && !empty($tglSep2)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tglSep1);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tglSep2);
        }

        return $this->db->get();
    }

    public function getSEP($no_rawat)
    {
        $this->db->select('bridging_sep.no_sep');
        $this->db->from('reg_periksa');
        $this->db->join('bridging_sep', 'reg_periksa.no_rawat=bridging_sep.no_rawat', 'left');
        $this->db->where('bridging_sep.no_rawat', $no_rawat);

        return $this->db->get();
    }
}
