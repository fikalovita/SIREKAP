<?php
class ModelDiagnosaPerUmur extends CI_Model
{
    public function getDiagnosaUmur($diagnosa, $tgl_awal, $tgl_akhir, $start, $length, $draw, $search = "")
    {
        $this->db->select("
            CASE  
            WHEN TIMESTAMPDIFF(SECOND, tgl_lahir, reg_periksa.tgl_registrasi) < 3600 THEN 'Umur < 1 Jam'
            WHEN TIMESTAMPDIFF(HOUR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 23 THEN 'Umur 1 - 23 Jam'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 7 THEN 'Umur 1 - 7 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 8 AND 28 THEN 'Umur 8 - 28 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 29 AND 89 THEN 'Umur 29 Hari - <3 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 3 AND 5 THEN 'Umur 3 - <6 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 6 AND 11 THEN 'Umur 6 - 11 Bulan'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 4 THEN 'Umur 1 - 4 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 5 AND 9 THEN 'Umur 5 - 9 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 10 AND 14 THEN 'Umur 10 - 14 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 15 AND 19 THEN 'Umur 15 - 19 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 20 AND 24 THEN 'Umur 20 - 24 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 25 AND 29 THEN 'Umur 25 - 29 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 30 AND 34 THEN 'Umur 30 - 34 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 35 AND 39 THEN 'Umur 35 - 39 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 40 AND 44 THEN 'Umur 40 - 44 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 45 AND 49 THEN 'Umur 45 - 49 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 50 AND 54 THEN 'Umur 50 - 54 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 55 AND 59 THEN 'Umur 55 - 59 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 60 AND 64 THEN 'Umur 60 - 64 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 65 AND 69 THEN 'Umur 65 - 69 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 70 AND 74 THEN 'Umur 70 - 74 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 75 AND 79 THEN 'Umur 75 - 79 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 80 AND 84 THEN 'Umur 80 - 84 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) >= 85 THEN 'Umur ≥ 85 Tahun'
            END AS kategori_umur,
            SUM(pasien.jk = 'L') as px_lk,
            SUM(pasien.jk = 'P') as px_pr,
            diagnosa_pasien.kd_penyakit");
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('diagnosa_pasien', 'reg_periksa.no_rawat=diagnosa_pasien.no_rawat', 'left');
        $this->db->where('diagnosa_pasien.kd_penyakit', $diagnosa);
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('diagnosa_pasien.kd_penyakit', $search);
            $this->db->like('kategori_umur', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->limit($length, $start);
        $this->db->group_by('diagnosa_pasien.kd_penyakit,kategori_umur');
        return $this->db->get();
    }
    public function countDiagnosaUmur($diagnosa, $tgl_awal, $tgl_akhir, $search = "")
    {
        $this->db->select("
            CASE  
            WHEN TIMESTAMPDIFF(SECOND, tgl_lahir, reg_periksa.tgl_registrasi) < 3600 THEN 'Umur < 1 Jam'
            WHEN TIMESTAMPDIFF(HOUR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 23 THEN 'Umur 1 - 23 Jam'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 7 THEN 'Umur 1 - 7 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 8 AND 28 THEN 'Umur 8 - 28 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 29 AND 89 THEN 'Umur 29 Hari - <3 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 3 AND 5 THEN 'Umur 3 - <6 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 6 AND 11 THEN 'Umur 6 - 11 Bulan'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 4 THEN 'Umur 1 - 4 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 5 AND 9 THEN 'Umur 5 - 9 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 10 AND 14 THEN 'Umur 10 - 14 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 15 AND 19 THEN 'Umur 15 - 19 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 20 AND 24 THEN 'Umur 20 - 24 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 25 AND 29 THEN 'Umur 25 - 29 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 30 AND 34 THEN 'Umur 30 - 34 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 35 AND 39 THEN 'Umur 35 - 39 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 40 AND 44 THEN 'Umur 40 - 44 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 45 AND 49 THEN 'Umur 45 - 49 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 50 AND 54 THEN 'Umur 50 - 54 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 55 AND 59 THEN 'Umur 55 - 59 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 60 AND 64 THEN 'Umur 60 - 64 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 65 AND 69 THEN 'Umur 65 - 69 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 70 AND 74 THEN 'Umur 70 - 74 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 75 AND 79 THEN 'Umur 75 - 79 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 80 AND 84 THEN 'Umur 80 - 84 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) >= 85 THEN 'Umur ≥ 85 Tahun'
            END AS kategori_umur,
            SUM(pasien.jk = 'L') as px_lk,
            SUM(pasien.jk = 'P') as px_pr,
            diagnosa_pasien.kd_penyakit");
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('diagnosa_pasien', 'reg_periksa.no_rawat=diagnosa_pasien.no_rawat', 'left');
        $this->db->where('diagnosa_pasien.kd_penyakit', $diagnosa);
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('diagnosa_pasien.kd_penyakit', $search);
            $this->db->like('kategori_umur', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by('diagnosa_pasien.kd_penyakit,kategori_umur');
        return $this->db->get();
    }
    public function getDiagnosaUmurRanap($diagnosa, $tgl_awal, $tgl_akhir, $start, $length, $draw, $search = "")
    {
        $this->db->select("
            CASE  
            WHEN TIMESTAMPDIFF(SECOND, tgl_lahir, reg_periksa.tgl_registrasi) < 3600 THEN 'Umur < 1 Jam'
            WHEN TIMESTAMPDIFF(HOUR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 23 THEN 'Umur 1 - 23 Jam'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 7 THEN 'Umur 1 - 7 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 8 AND 28 THEN 'Umur 8 - 28 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 29 AND 89 THEN 'Umur 29 Hari - <3 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 3 AND 5 THEN 'Umur 3 - <6 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 6 AND 11 THEN 'Umur 6 - 11 Bulan'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 4 THEN 'Umur 1 - 4 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 5 AND 9 THEN 'Umur 5 - 9 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 10 AND 14 THEN 'Umur 10 - 14 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 15 AND 19 THEN 'Umur 15 - 19 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 20 AND 24 THEN 'Umur 20 - 24 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 25 AND 29 THEN 'Umur 25 - 29 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 30 AND 34 THEN 'Umur 30 - 34 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 35 AND 39 THEN 'Umur 35 - 39 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 40 AND 44 THEN 'Umur 40 - 44 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 45 AND 49 THEN 'Umur 45 - 49 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 50 AND 54 THEN 'Umur 50 - 54 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 55 AND 59 THEN 'Umur 55 - 59 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 60 AND 64 THEN 'Umur 60 - 64 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 65 AND 69 THEN 'Umur 65 - 69 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 70 AND 74 THEN 'Umur 70 - 74 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 75 AND 79 THEN 'Umur 75 - 79 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 80 AND 84 THEN 'Umur 80 - 84 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) >= 85 THEN 'Umur ≥ 85 Tahun'
            END AS kategori_umur,
            SUM(pasien.jk = 'L') as px_lk,
            SUM(pasien.jk = 'P') as px_pr,
            diagnosa_pasien.kd_penyakit");
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('diagnosa_pasien', 'reg_periksa.no_rawat=diagnosa_pasien.no_rawat', 'left');
        $this->db->where('diagnosa_pasien.kd_penyakit', $diagnosa);
        $this->db->where('reg_periksa.status_lanjut', 'Ranap');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('diagnosa_pasien.kd_penyakit', $search);
            $this->db->like('kategori_umur', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->limit($length, $start);
        $this->db->group_by('diagnosa_pasien.kd_penyakit,kategori_umur');
        return $this->db->get();
    }
    public function countDiagnosaUmurRanap($diagnosa, $tgl_awal, $tgl_akhir, $search = "")
    {
        $this->db->select("
            CASE  
            WHEN TIMESTAMPDIFF(SECOND, tgl_lahir, reg_periksa.tgl_registrasi) < 3600 THEN 'Umur < 1 Jam'
            WHEN TIMESTAMPDIFF(HOUR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 23 THEN 'Umur 1 - 23 Jam'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 7 THEN 'Umur 1 - 7 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 8 AND 28 THEN 'Umur 8 - 28 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 29 AND 89 THEN 'Umur 29 Hari - <3 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 3 AND 5 THEN 'Umur 3 - <6 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 6 AND 11 THEN 'Umur 6 - 11 Bulan'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 4 THEN 'Umur 1 - 4 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 5 AND 9 THEN 'Umur 5 - 9 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 10 AND 14 THEN 'Umur 10 - 14 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 15 AND 19 THEN 'Umur 15 - 19 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 20 AND 24 THEN 'Umur 20 - 24 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 25 AND 29 THEN 'Umur 25 - 29 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 30 AND 34 THEN 'Umur 30 - 34 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 35 AND 39 THEN 'Umur 35 - 39 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 40 AND 44 THEN 'Umur 40 - 44 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 45 AND 49 THEN 'Umur 45 - 49 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 50 AND 54 THEN 'Umur 50 - 54 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 55 AND 59 THEN 'Umur 55 - 59 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 60 AND 64 THEN 'Umur 60 - 64 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 65 AND 69 THEN 'Umur 65 - 69 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 70 AND 74 THEN 'Umur 70 - 74 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 75 AND 79 THEN 'Umur 75 - 79 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 80 AND 84 THEN 'Umur 80 - 84 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) >= 85 THEN 'Umur ≥ 85 Tahun'
            END AS kategori_umur,
            SUM(pasien.jk = 'L') as px_lk,
            SUM(pasien.jk = 'P') as px_pr,
            diagnosa_pasien.kd_penyakit");
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('diagnosa_pasien', 'reg_periksa.no_rawat=diagnosa_pasien.no_rawat', 'left');
        $this->db->where('diagnosa_pasien.kd_penyakit', $diagnosa);
        $this->db->where('reg_periksa.status_lanjut', 'Ranap');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('diagnosa_pasien.kd_penyakit', $search);
            $this->db->like('kategori_umur', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by('diagnosa_pasien.kd_penyakit,kategori_umur');
        return $this->db->get();
    }

    public function diagnosaKasusBaru($diagnosa, $tgl_awal, $tgl_akhir, $start, $length, $draw,  $search = "")
    {
        $this->db->select("
            CASE  
            WHEN TIMESTAMPDIFF(SECOND, tgl_lahir, reg_periksa.tgl_registrasi) < 3600 THEN 'Umur < 1 Jam'
            WHEN TIMESTAMPDIFF(HOUR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 23 THEN 'Umur 1 - 23 Jam'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 7 THEN 'Umur 1 - 7 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 8 AND 28 THEN 'Umur 8 - 28 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 29 AND 89 THEN 'Umur 29 Hari - <3 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 3 AND 5 THEN 'Umur 3 - <6 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 6 AND 11 THEN 'Umur 6 - 11 Bulan'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 4 THEN 'Umur 1 - 4 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 5 AND 9 THEN 'Umur 5 - 9 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 10 AND 14 THEN 'Umur 10 - 14 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 15 AND 19 THEN 'Umur 15 - 19 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 20 AND 24 THEN 'Umur 20 - 24 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 25 AND 29 THEN 'Umur 25 - 29 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 30 AND 34 THEN 'Umur 30 - 34 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 35 AND 39 THEN 'Umur 35 - 39 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 40 AND 44 THEN 'Umur 40 - 44 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 45 AND 49 THEN 'Umur 45 - 49 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 50 AND 54 THEN 'Umur 50 - 54 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 55 AND 59 THEN 'Umur 55 - 59 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 60 AND 64 THEN 'Umur 60 - 64 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 65 AND 69 THEN 'Umur 65 - 69 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 70 AND 74 THEN 'Umur 70 - 74 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 75 AND 79 THEN 'Umur 75 - 79 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 80 AND 84 THEN 'Umur 80 - 84 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) >= 85 THEN 'Umur ≥ 85 Tahun'
            END AS kategori_umur,
            SUM(pasien.jk = 'L') as px_lk,
            SUM(pasien.jk = 'P') as px_pr,
            diagnosa_pasien.kd_penyakit");
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('diagnosa_pasien', 'reg_periksa.no_rawat=diagnosa_pasien.no_rawat', 'left');
        $this->db->where('diagnosa_pasien.kd_penyakit', $diagnosa);
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        $this->db->where('diagnosa_pasien.status_penyakit', 'Baru');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('diagnosa_pasien.kd_penyakit', $search);
            $this->db->like('kategori_umur', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->limit($length, $start);
        $this->db->group_by('diagnosa_pasien.kd_penyakit,kategori_umur');
        return $this->db->get();
    }
    public function countDiagnosaKasusBaru($diagnosa, $tgl_awal, $tgl_akhir, $search = "")
    {
        $this->db->select("
            CASE  
            WHEN TIMESTAMPDIFF(SECOND, tgl_lahir, reg_periksa.tgl_registrasi) < 3600 THEN 'Umur < 1 Jam'
            WHEN TIMESTAMPDIFF(HOUR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 23 THEN 'Umur 1 - 23 Jam'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 7 THEN 'Umur 1 - 7 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 8 AND 28 THEN 'Umur 8 - 28 Hari'
            WHEN TIMESTAMPDIFF(DAY, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 29 AND 89 THEN 'Umur 29 Hari - <3 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 3 AND 5 THEN 'Umur 3 - <6 Bulan'
            WHEN TIMESTAMPDIFF(MONTH, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 6 AND 11 THEN 'Umur 6 - 11 Bulan'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 1 AND 4 THEN 'Umur 1 - 4 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 5 AND 9 THEN 'Umur 5 - 9 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 10 AND 14 THEN 'Umur 10 - 14 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 15 AND 19 THEN 'Umur 15 - 19 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 20 AND 24 THEN 'Umur 20 - 24 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 25 AND 29 THEN 'Umur 25 - 29 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 30 AND 34 THEN 'Umur 30 - 34 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 35 AND 39 THEN 'Umur 35 - 39 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 40 AND 44 THEN 'Umur 40 - 44 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 45 AND 49 THEN 'Umur 45 - 49 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 50 AND 54 THEN 'Umur 50 - 54 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 55 AND 59 THEN 'Umur 55 - 59 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 60 AND 64 THEN 'Umur 60 - 64 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 65 AND 69 THEN 'Umur 65 - 69 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 70 AND 74 THEN 'Umur 70 - 74 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 75 AND 79 THEN 'Umur 75 - 79 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) BETWEEN 80 AND 84 THEN 'Umur 80 - 84 Tahun'
            WHEN TIMESTAMPDIFF(YEAR, tgl_lahir, reg_periksa.tgl_registrasi) >= 85 THEN 'Umur ≥ 85 Tahun'
            END AS kategori_umur,
            SUM(pasien.jk = 'L') as px_lk,
            SUM(pasien.jk = 'P') as px_pr,
            diagnosa_pasien.kd_penyakit");
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('diagnosa_pasien', 'reg_periksa.no_rawat=diagnosa_pasien.no_rawat', 'left');
        $this->db->where('diagnosa_pasien.kd_penyakit', $diagnosa);
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        $this->db->where('diagnosa_pasien.status_penyakit', 'Baru');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('diagnosa_pasien.kd_penyakit', $search);
            $this->db->like('kategori_umur', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by('diagnosa_pasien.kd_penyakit,kategori_umur');
        return $this->db->get();
    }

    public function jumlahKunjungan($tgl_awal, $tgl_akhir)
    {
        $this->db->select("
            reg_periksa.no_rawat,
            SUM(pasien.jk = 'L') as kunjungan_lk,
            SUM(pasien.jk = 'P') as kunjungan_pr,
        ");
        $this->db->from("reg_periksa");
        $this->db->join("pasien", "reg_periksa.no_rkm_medis=pasien.no_rkm_medis", "left");

        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->where("reg_periksa.status_lanjut", "Ralan");
        return $this->db->get();
    }

    public function pasienMeninggal($tgl_awal, $tgl_akhir)
    {
        $this->db->select("
            reg_periksa.no_rawat,
            SUM(pasien.jk = 'L') as mati_lk,
            SUM(pasien.jk = 'P') as mati_pr,
        ");
        $this->db->from("reg_periksa");
        $this->db->join("kamar_inap", "reg_periksa.no_rawat=kamar_inap.no_rawat", "left");
        $this->db->join("pasien", "reg_periksa.no_rkm_medis=pasien.no_rkm_medis", "left");
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->where("kamar_inap.stts_pulang", "Meninggal");
        return $this->db->get();
    }
}
