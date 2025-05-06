<?php
class RadiologiModel extends CI_Model
{
    public function radiologi($tanggal1, $tanggal2, $start, $length, $search = "")
    {
        $this->db->select('p.nm_pasien, pr.tgl_periksa, jpr.nm_perawatan, d.nm_dokter');
        $this->db->from('periksa_radiologi pr');
        $this->db->join('reg_periksa rp', 'pr.no_rawat = rp.no_rawat', 'inner');
        $this->db->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis', 'inner');
        $this->db->join('jns_perawatan_radiologi jpr', 'pr.kd_jenis_prw = jpr.kd_jenis_prw', 'inner');
        $this->db->join('dokter d', 'pr.kd_dokter = d.kd_dokter', 'inner');
        $this->db->not_like('jpr.nm_perawatan', 'RETRIBUSI');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('jpr.nm_perawatan', $search);
            $this->db->or_like('p.nm_pasien', $search);
            $this->db->or_like('d.nm_dokter', $search);
            $this->db->group_end();
        }

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('pr.tgl_periksa >=', $tanggal1);
            $this->db->where('pr.tgl_periksa <=', $tanggal2);
        }

        $this->db->order_by('pr.tgl_periksa', 'DESC');
        $this->db->limit($length, $start);
        return $this->db->get();
    }

    public function countRadiologi($tanggal1, $tanggal2, $search = "")
    {
        $this->db->select('p.nm_pasien, pr.tgl_periksa, jpr.nm_perawatan, d.nm_dokter');
        $this->db->from('periksa_radiologi pr');
        $this->db->join('reg_periksa rp', 'pr.no_rawat = rp.no_rawat', 'inner');
        $this->db->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis', 'inner');
        $this->db->join('jns_perawatan_radiologi jpr', 'pr.kd_jenis_prw = jpr.kd_jenis_prw', 'inner');
        $this->db->join('dokter d', 'pr.kd_dokter = d.kd_dokter', 'inner');
        $this->db->not_like('jpr.nm_perawatan', 'RETRIBUSI');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('jpr.nm_perawatan', $search);
            $this->db->or_like('p.nm_pasien', $search);
            $this->db->or_like('d.nm_dokter', $search);
            $this->db->group_end();
        }

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('pr.tgl_periksa >=', $tanggal1);
            $this->db->where('pr.tgl_periksa <=', $tanggal2);
        }

        return $this->db->get();
    }

    public function excelRadiologi($tanggal1, $tanggal2)
    {
        $this->db->select('p.nm_pasien, pr.tgl_periksa, jpr.nm_perawatan, d.nm_dokter');
        $this->db->from('periksa_radiologi pr');
        $this->db->join('reg_periksa rp', 'pr.no_rawat = rp.no_rawat', 'inner');
        $this->db->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis', 'inner');
        $this->db->join('jns_perawatan_radiologi jpr', 'pr.kd_jenis_prw = jpr.kd_jenis_prw', 'inner');
        $this->db->join('dokter d', 'pr.kd_dokter = d.kd_dokter', 'inner');
        $this->db->not_like('jpr.nm_perawatan', 'RETRIBUSI');

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('pr.tgl_periksa >=', $tanggal1);
            $this->db->where('pr.tgl_periksa <=', $tanggal2);
        }

        return $this->db->get();
    }
}
