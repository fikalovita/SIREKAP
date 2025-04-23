<?php
class ModelSensusHarian extends CI_Model
{
    public function pasienKeluar($tglKeluar1, $tglKeluar2)
    {
        $this->db->select('kamar_inap.no_rawat,dokter.nm_dokter,pasien.jk,dpjp_ranap.no_rawat,reg_periksa.no_rkm_medis,sum(pasien.jk== "P") as pr,sum(pasien.jk = "L")as lk');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('kamar_inap', 'reg_periksa.no_rawat=kamar_inap.no_rawat', 'left');
        $this->db->join('dpjp_ranap', 'reg_periksa.no_rawat=dpjp_ranap', 'inner');
        $this->db->join('dokter', 'dpjp_ranap.kd_dokter=dokter.kd_dokter', 'inner');
        $this->db->where('kamar_inap.stts_pulang <>', '-');
        if (!empty($tglKeluar1) && !empty($tglKeluar2)) {
            $this->db->where('kamar_inap.tgl_keluar >=', $tglKeluar1);
            $this->db->where('kamar_inap.tgl_keluar <=', $tglKeluar2);
        }
        $this->db->where('TIMESTAMPDIFF(HOUR,CONCAT(kamar_inap.tgl_masuk," ",kamar_inap.jam_masuk),CONCAT(kamar_inap.tgl_keluar," ",kamar_inap.jam_keluar)>', '48');
        $this->db->group_by('dpjp_ranap.kd_dokter');

        return $this->db->get();
    }
}
