<?php
class ModelPemeriksaanLaborat extends CI_Model
{
    public function getPeriksaLab($tglAwal = null, $tglAkhir = null, $start = 0, $length = 0, $search = '')
    {
        $this->db->select('periksa_lab.kd_jenis_prw,jns_perawatan_lab.nm_perawatan,count(jns_perawatan_lab.kd_jenis_prw) as jml_periksa,jns_perawatan_lab.kd_jenis_prw,SUM(pasien.jk = "P") AS perempuan,SUM(pasien.jk = "L") AS lk');
        $this->db->from('periksa_lab');
        $this->db->join('jns_perawatan_lab', 'periksa_lab.kd_jenis_prw=jns_perawatan_lab.kd_jenis_prw', 'inner');
        $this->db->join('reg_periksa', 'periksa_lab.no_rawat=reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('periksa_lab.kd_jenis_prw', $search);
            $this->db->or_like('jns_perawatan_lab.nm_perawatan', $search);
            $this->db->group_end();
        }
        if (!empty($tglAwal) && !empty($tglAkhir)) {
            $this->db->where('periksa_lab.tgl_periksa >=', $tglAwal);
            $this->db->where('periksa_lab.tgl_periksa <=', $tglAkhir);
        }
        $this->db->group_by('jns_perawatan_lab.kd_jenis_prw');
        $this->db->limit($length, $start);
        return $this->db->get();
    }
    public function countPeriksaLab($tglAwal, $tglAkhir, $search)
    {
        $this->db->select('periksa_lab.kd_jenis_prw,jns_perawatan_lab.nm_perawatan,count(jns_perawatan_lab.kd_jenis_prw) as jml_periksa,jns_perawatan_lab.kd_jenis_prw,SUM(pasien.jk = "P") AS perempuan,SUM(pasien.jk = "L") AS lk');
        $this->db->from('periksa_lab');
        $this->db->join('jns_perawatan_lab', 'periksa_lab.kd_jenis_prw=jns_perawatan_lab.kd_jenis_prw', 'inner');
        $this->db->join('reg_periksa', 'periksa_lab.no_rawat=reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('periksa_lab.kd_jenis_prw', $search);
            $this->db->or_like('jns_perawatan_lab.nm_perawatan', $search);
            $this->db->group_end();
        }
        if (!empty($tglAwal) && !empty($tglAkhir)) {
            $this->db->where('periksa_lab.tgl_periksa >=', $tglAwal);
            $this->db->where('periksa_lab.tgl_periksa <=', $tglAkhir);
        }
        $this->db->group_by('jns_perawatan_lab.kd_jenis_prw');
        return $this->db->get();
    }
    public function getDetailPeriksaLab($tglAwal, $tglAkhir, $kd_jenis_prw)
    {
        $this->db->select('template_laboratorium.pemeriksaan,count(template_laboratorium.pemeriksaan) as jml_detail, detail_periksa_lab.tgl_periksa,SUM(pasien.jk = "P") AS perempuan,SUM(pasien.jk = "L") AS lk,detail_periksa_lab.tgl_periksa,template_laboratorium.kd_jenis_prw');
        $this->db->from('detail_periksa_lab');
        $this->db->join('template_laboratorium', 'detail_periksa_lab.id_template=template_laboratorium.id_template', 'inner');
        $this->db->join('reg_periksa', 'detail_periksa_lab.no_rawat=reg_periksa.no_rawat', 'left');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'inner');
        $this->db->where('template_laboratorium.kd_jenis_prw=', $kd_jenis_prw);

        if (!empty($tglAwal) && !empty($tglAkhir)) {
            $this->db->where('detail_periksa_lab.tgl_periksa >=', $tglAwal);
            $this->db->where('detail_periksa_lab.tgl_periksa <=', $tglAkhir);
        }

        $this->db->group_by('template_laboratorium.Pemeriksaan');
        return $this->db->get();
    }


    public function excelGetPeriksaLab($tglAwal = null, $tglAkhir = null)
    {
        $this->db->select('periksa_lab.kd_jenis_prw,jns_perawatan_lab.nm_perawatan,count(jns_perawatan_lab.kd_jenis_prw) as jml_periksa,jns_perawatan_lab.kd_jenis_prw,SUM(pasien.jk = "P") AS perempuan,SUM(pasien.jk = "L") AS lk');
        $this->db->from('periksa_lab');
        $this->db->join('jns_perawatan_lab', 'periksa_lab.kd_jenis_prw=jns_perawatan_lab.kd_jenis_prw', 'inner');
        $this->db->join('reg_periksa', 'periksa_lab.no_rawat=reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        // if (!empty($search)) {
        //     $this->db->group_start();
        //     $this->db->like('periksa_lab.kd_jenis_prw', $search);
        //     $this->db->or_like('jns_perawatan_lab.nm_perawatan', $search);
        //     $this->db->group_end();
        // }
        if (!empty($tglAwal) && !empty($tglAkhir)) {
            $this->db->where('periksa_lab.tgl_periksa >=', $tglAwal);
            $this->db->where('periksa_lab.tgl_periksa <=', $tglAkhir);
        }
        $this->db->group_by('jns_perawatan_lab.kd_jenis_prw');
        // $this->db->limit($length, $start);
        return $this->db->get();
    }
}
