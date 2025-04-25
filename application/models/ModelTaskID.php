<?php
class ModelTaskID extends CI_Model
{
    public function TampilTaskID($tanggal1, $tanggal2, $start, $length, $search)
    {
        $this->db->select('rp.no_rawat, p.no_rkm_medis, p.nm_pasien, rp.tgl_registrasi,rp.stts_daftar');
        $this->db->from('reg_periksa rp');
        $this->db->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis', 'inner');
        $this->db->join('poliklinik p1', 'rp.kd_poli = p1.kd_poli', 'inner');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('rp.no_rawat', $search);
            $this->db->or_like('p.no_rkm_medis', $search);
            $this->db->or_like('p.nm_pasien', $search);
            $this->db->group_end();
        }

        $this->db->where('date(rp.tgl_registrasi) >=', $tanggal1);
        $this->db->where('date(rp.tgl_registrasi) <=', $tanggal2);
        $this->db->where('rp.kd_poli !=', 'IGDK');

        $this->db->order_by('rp.no_rawat');
        $this->db->limit($length, $start);

        return $this->db->get();
    }

    public function CountTampilTaskID($tanggal1, $tanggal2, $search)
    {
        $this->db->select('rp.no_rawat, p.no_rkm_medis, p.nm_pasien, rp.tgl_registrasi,rp.stts_daftar');
        $this->db->from('reg_periksa rp');
        $this->db->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis', 'inner');
        $this->db->join('poliklinik p1', 'rp.kd_poli = p1.kd_poli', 'inner');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('rp.no_rawat', $search);
            $this->db->or_like('p.no_rkm_medis', $search);
            $this->db->or_like('p.nm_pasien', $search);
            $this->db->group_end();
        }

        $this->db->where('date(rp.tgl_registrasi) >=', $tanggal1);
        $this->db->where('date(rp.tgl_registrasi) <=', $tanggal2);
        $this->db->where('rp.kd_poli !=', 'IGDK');


        $this->db->order_by('rp.no_rawat');

        return $this->db->count_all_results();
    }

    public function TaskID_1($norawat)
    {

        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(rmbt.no_rawat) AS taskid1');
        $this->db->from('referensi_mobilejkn_bpjs_taskid rmbt');
        $this->db->where('rmbt.no_rawat', $norawat);
        $this->db->where('rmbt.taskid', '1');

        return $this->db->get();
    }
    public function TaskID_2($norawat)
    {

        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(rmbt.no_rawat) AS taskid2');
        $this->db->from('referensi_mobilejkn_bpjs_taskid rmbt');
        $this->db->where('rmbt.no_rawat', $norawat);
        $this->db->where('rmbt.taskid', '2');

        return $this->db->get();
    }
    public function TaskID_3($norawat)
    {

        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(rmbt.no_rawat) AS taskid3');
        $this->db->from('referensi_mobilejkn_bpjs_taskid rmbt');
        $this->db->where('rmbt.no_rawat', $norawat);
        $this->db->where('rmbt.taskid', '3');

        return $this->db->get();
    }
    public function TaskID_4($norawat)
    {
        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(rmbt.no_rawat) AS taskid4');
        $this->db->from('referensi_mobilejkn_bpjs_taskid rmbt');
        $this->db->where('rmbt.no_rawat', $norawat);
        $this->db->where('rmbt.taskid', '4');

        return $this->db->get();
    }
    public function TaskID_5($norawat)
    {
        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(rmbt.no_rawat) AS taskid5');
        $this->db->from('referensi_mobilejkn_bpjs_taskid rmbt');
        $this->db->where('rmbt.no_rawat', $norawat);
        $this->db->where('rmbt.taskid', '5');

        return $this->db->get();
    }
    public function TaskID_6($norawat)
    {

        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(rmbt.no_rawat) AS taskid6');
        $this->db->from('referensi_mobilejkn_bpjs_taskid rmbt');
        $this->db->where('rmbt.no_rawat', $norawat);
        $this->db->where('rmbt.taskid', '6');

        return $this->db->get();
    }
    public function TaskID_7($norawat)
    {

        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(rmbt.no_rawat) AS taskid7');
        $this->db->from('referensi_mobilejkn_bpjs_taskid rmbt');
        $this->db->where('rmbt.no_rawat', $norawat);
        $this->db->where('rmbt.taskid', '7');

        return $this->db->get();
    }
    public function TaskID_99($norawat)
    {
        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(rmbt.no_rawat) AS taskid99');
        $this->db->from('referensi_mobilejkn_bpjs_taskid rmbt');
        $this->db->where('rmbt.no_rawat', $norawat);
        $this->db->where('rmbt.taskid', '99');

        return $this->db->get();
    }
}
