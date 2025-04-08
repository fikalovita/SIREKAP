<?php
class ModelLaporanPasien extends CI_Model
{
    public function getDokterDpjp($start = 0, $length = 0)
    {
        $this->db->select('dokter.kd_dokter,dokter.nm_dokter');
        $this->db->from('dokter');
        $this->db->join('dpjp_ranap', 'dokter.kd_dokter=dpjp_ranap.kd_dokter', 'left');
        $this->db->where('status', '1');
        $this->db->group_by('dpjp_ranap.kd_dokter');
        $this->db->order_by('dokter.kd_dokter');
        $this->db->limit($length, $start);
        return $this->db->get();
    }

    public function getDokterDpjpAll()
    {
        $this->db->select('dokter.kd_dokter,dokter.nm_dokter');
        $this->db->from('dokter');
        $this->db->join('dpjp_ranap', 'dokter.kd_dokter=dpjp_ranap.kd_dokter', 'left');
        $this->db->where('status', '1');
        $this->db->group_by('dpjp_ranap.kd_dokter');
        return $this->db->get();
    }

    public function getPasienInap($kd_dokter, $bulan, $tahun)
    {
        $this->db->select('COUNT(kamar_inap.no_rawat) as jml_px');
        $this->db->from('kamar_inap');
        $this->db->join('dpjp_ranap', 'kamar_inap.no_rawat=dpjp_ranap.no_rawat', 'left');
        $this->db->where('DATE_FORMAT(kamar_inap.tgl_masuk, "%Y-%m")=', '' . $tahun . '-' . $bulan . '');
        $this->db->where('dpjp_ranap.kd_dokter', $kd_dokter);
        return $this->db->get();
    }

    public function getDokterIGD($start = 0, $length = 0)
    {
        $this->db->select('dokter.nm_dokter,dokter.kd_dokter');
        $this->db->from('dokter');
        $this->db->where('status', '1');
        $this->db->limit($length, $start);
        return $this->db->get();
    }
    public function getDokterIGDAll()
    {
        $this->db->select('dokter.nm_dokter,dokter.kd_dokter');
        $this->db->from('dokter');
        $this->db->where('status', '1');
        return $this->db->get();
    }

    public function getPasienIGD($kd_dokter, $bulan, $tahun)
    {
        $this->db->select('count(no_rawat) as jml_px');
        $this->db->from('reg_periksa');
        $this->db->where('DATE_FORMAT(tgl_registrasi,"%Y-%m")=', '' . $tahun . '-' . $bulan . '');
        $this->db->where('reg_periksa.kd_poli', 'IGDK');
        $this->db->where('reg_periksa.kd_dokter', $kd_dokter);
        return $this->db->get();
    }

    public function getPasienMatiRanap($bulan3, $tahun3)
    {
        $this->db->select('reg_periksa.no_rawat');
        $this->db->from('reg_periksa');
        $this->db->where('reg_periksa.kd_poli', 'IGDK');
        $this->db->where('reg_periksa.stts', 'Meninggal');
        $this->db->where('DATE_FORMAT(kamar_inap.tgl_keluar,"%Y-%m")=', '' . $tahun3 . '-' . $bulan3 . '');
        return $this->db->get();
    }

    public function getPasienMatiIgd() {}
}
