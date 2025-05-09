<?php
class ModelSEPRajal extends CI_Model
{
    public function getPoliklinik($tglSepRajal1, $tglSepRajal2, $search = "")
    {
        $this->db->select('
            poliklinik.nm_poli,
            dokter.nm_dokter,
            dokter.kd_dokter,
            SUM(CASE WHEN reg_periksa.kd_pj = "Bpj" THEN 1 ELSE 0 END) AS bpjs,
            SUM(CASE WHEN reg_periksa.kd_pj = "UM" THEN 1 ELSE 0 END) AS umum,
            SUM(CASE WHEN reg_periksa.kd_pj != "BPJ" AND reg_periksa.kd_pj != "UM" THEN 1 ELSE 0 END) AS lainnya,
            COUNT(CASE WHEN bridging_sep.no_sep IS NOT NULL AND bridging_sep.no_sep != "" THEN 1 END) AS jumlah_sep
        ');
        $this->db->from('reg_periksa');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli', 'inner');
        $this->db->join('dokter', 'reg_periksa.kd_dokter=dokter.kd_dokter', 'left');
        $this->db->join('bridging_sep', 'reg_periksa.no_rawat=bridging_sep.no_rawat', 'left');
        $this->db->where('poliklinik.kd_poli<>', 'IGDK');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('dokter.nm_dokter', $search);
            $this->db->or_like('poliklinik.nm_poli', $search);
            $this->db->group_end();
        }
        if (!empty($tglSepRajal1) && !empty($tglSepRajal1)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tglSepRajal1);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tglSepRajal2);
        }
        $this->db->order_by('dokter.nm_dokter');
        $this->db->group_by('reg_periksa.kd_dokter');
        return $this->db->get();
    }
}
