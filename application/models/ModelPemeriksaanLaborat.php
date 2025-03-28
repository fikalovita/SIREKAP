<?php
class ModelPemeriksaanLaborat extends CI_Model
{
    public function getJnsPerawatan($start = 0, $length = 0)
    {

        $this->db->select('jns_perawatan_lab.kd_jenis_prw,jns_perawatan_lab.nm_perawatan');
        $this->db->from('jns_perawatan_lab');
        $this->db->where('jns_perawatan_lab.status', '1');
        $this->db->order_by('jns_perawatan_lab.nm_perawatan');
        $this->db->limit($length, $start);
        return $this->db->get();
    }
    public function getJnsPerawatanAll()
    {

        $this->db->select('jns_perawatan_lab.kd_jenis_prw,jns_perawatan_lab.nm_perawatan');
        $this->db->from('jns_perawatan_lab');
        $this->db->where('jns_perawatan_lab.status', '1');
        $this->db->order_by('jns_perawatan_lab.nm_perawatan');
        return $this->db->get();
    }

    public function getPeriksaLab($kd_jenis_prw, $tahun, $bulan)
    {

        $this->db->select('count(kd_jenis_prw) as jml_periksa,SUM(pasien.jk = "P") as perempuan,SUM(pasien.jk = "L") as laki');
        $this->db->from('periksa_lab');
        $this->db->join('reg_periksa', 'periksa_lab.no_rawat=reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->where('kd_jenis_prw', $kd_jenis_prw);
        $this->db->like('tgl_periksa', $tahun . '-' . $bulan);
        return $this->db->get();
    }

    public function getTemplateLab($kd_jenis_prw)
    {
        $this->db->select('id_template,Pemeriksaan');
        $this->db->from('template_laboratorium');
        $this->db->where('kd_jenis_prw', $kd_jenis_prw);
        $this->db->order_by('urut');
        return $this->db->get();
    }

    public function getDetailPeriksaLab($id_template, $bulan, $tahun)
    {
        $this->db->select('count(id_template) as jml_detail,SUM(pasien.jk = "P") as perempuan,SUM(pasien.jk = "L") as laki');
        $this->db->from('detail_periksa_lab');
        $this->db->join('reg_periksa', 'detail_periksa_lab.no_rawat=reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->where('id_template', $id_template);
        $this->db->like('tgl_periksa', $tahun . '-' . $bulan);
        return $this->db->get();
    }
}
