<?php
class ModelDemografiRegistrasi extends CI_Model
{
    public function getPasienSuku($tgl_awal, $tgl_akhir, $start, $length, $draw, $search = "")
    {
        $this->db->select('suku_bangsa.nama_suku_bangsa,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        // $this->db->join('kabupaten', 'pasien.kd_kab=kabupaten.kd_kab', 'left');
        // $this->db->join('kecamatan', 'pasien.kd_kec=kecamatan.kd_kec', 'left');
        $this->db->join('suku_bangsa', 'pasien.suku_bangsa=suku_bangsa.id', 'left');
        $this->db->join('bahasa_pasien', 'pasien.bahasa_pasien=bahasa_pasien.id', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('suku_bangsa.nama_suku_bangsa', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }

        $this->db->group_by('pasien.suku_bangsa');
        $this->db->limit($length, $start);

        return $this->db->get();
    }
    public function countPasienSuku($tgl_awal, $tgl_akhir, $search = "")
    {
        $this->db->select('suku_bangsa.nama_suku_bangsa,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        // $this->db->join('kabupaten', 'pasien.kd_kab=kabupaten.kd_kab', 'left');
        // $this->db->join('kecamatan', 'pasien.kd_kec=kecamatan.kd_kec', 'left');
        $this->db->join('suku_bangsa', 'pasien.suku_bangsa=suku_bangsa.id', 'left');
        $this->db->join('bahasa_pasien', 'pasien.bahasa_pasien=bahasa_pasien.id', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('suku_bangsa.nama_suku_bangsa', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }

        $this->db->group_by('pasien.suku_bangsa');

        return $this->db->get();
    }
    public function getPasienPendidikan($tgl_awal, $tgl_akhir, $start, $length, $draw, $search = "")
    {
        $this->db->select('pasien.pnd,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('pasien.pnd', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by('pasien.pnd');
        $this->db->limit($length, $start);

        return $this->db->get();
    }
    public function countPasienPendidikan($tgl_awal, $tgl_akhir, $search = "")
    {
        $this->db->select('pasien.pnd,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('pasien.pnd', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by('pasien.pnd');

        return $this->db->get();
    }
    public function getPasienAgama($tgl_awal, $tgl_akhir, $start, $length, $draw, $search = "")
    {
        $this->db->select('pasien.agama,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('pasien.agama', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }

        $this->db->group_by('pasien.agama');
        $this->db->limit($length, $start);

        return $this->db->get();
    }
    public function countPasienAgama($tgl_awal, $tgl_akhir, $search = "")
    {
        $this->db->select('pasien.agama,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('pasien.agama', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by('pasien.agama');

        return $this->db->get();
    }
    public function getPasienBahasa($tgl_awal, $tgl_akhir, $start, $length, $draw, $search = "")
    {
        $this->db->select('bahasa_pasien.nama_bahasa,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('bahasa_pasien', 'pasien.bahasa_pasien=bahasa_pasien.id', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('bahasa_pasien.nama_bahasa', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by('pasien.bahasa_pasien');
        $this->db->limit($length, $start);

        return $this->db->get();
    }
    public function countPasienBahasa($tgl_awal, $tgl_akhir, $search = "")
    {
        $this->db->select('bahasa_pasien.nama_bahasa,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('bahasa_pasien', 'pasien.bahasa_pasien=bahasa_pasien.id', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('bahasa_pasien.nama_bahasa', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }

        $this->db->group_by('pasien.bahasa_pasien');

        return $this->db->get();
    }
    public function getPasienUmur($tgl_awal, $tgl_akhir, $start, $length, $draw, $search = "")
    {
        $this->db->select("
        CASE
            WHEN reg_periksa.sttsumur = 'Hr' AND reg_periksa.umurdaftar < 365 THEN '< 1 tahun'
            WHEN reg_periksa.sttsumur = 'Bl' AND reg_periksa.umurdaftar < 12 THEN '< 1 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar < 1 THEN '< 1 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 1 AND 20 THEN '1–20 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 21 AND 40 THEN '21–40 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 41 AND 60 THEN '41–60 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 61 AND 80 THEN '61–80 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar > 80 THEN '> 80 tahun'
            ELSE 'LAINNYA'
            END AS kelompok_umur,
            COUNT(reg_periksa.no_rawat) AS jumlah
        ");
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.umurdaftar', $search);
            $this->db->or_like('reg_periksa.sttsumur', $search);
            $this->db->group_end();
        }
        $this->db->from('reg_periksa');
        $this->db->group_by('kelompok_umur');
        $this->db->limit($length, $start);
        return $this->db->get();
    }
    public function countPasienUmur($tgl_awal, $tgl_akhir, $search = "")
    {
        $this->db->select("
        CASE
            WHEN reg_periksa.sttsumur = 'Hr' AND reg_periksa.umurdaftar < 365 THEN '< 1 tahun'
            WHEN reg_periksa.sttsumur = 'Bl' AND reg_periksa.umurdaftar < 12 THEN '< 1 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar < 1 THEN '< 1 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 1 AND 20 THEN '1–20 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 21 AND 40 THEN '21–40 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 41 AND 60 THEN '41–60 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 61 AND 80 THEN '61–80 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar > 80 THEN '> 80 tahun'
            ELSE 'LAINNYA'
        END AS kelompok_umur,
        COUNT(reg_periksa.no_rawat) AS jumlah");

        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.umurdaftar', $search);
            $this->db->or_like('reg_periksa.sttsumur', $search);
            $this->db->group_end();
        }

        $this->db->from('reg_periksa');
        $this->db->group_by('kelompok_umur');
        return $this->db->get();
    }
    public function getPasienKecamatan($tgl_awal, $tgl_akhir, $start, $length, $draw, $search = "")
    {
        $this->db->select("count(reg_periksa.no_rawat) as jumlah, kecamatan.nm_kec, kabupaten.nm_kab");
        $this->db->from("reg_periksa");
        $this->db->join("pasien", "reg_periksa.no_rkm_medis=pasien.no_rkm_medis", "left");
        $this->db->join("kabupaten", "pasien.kd_kab=kabupaten.kd_kab", "left");
        $this->db->join("kecamatan", "pasien.kd_kec=kecamatan.kd_kec", "left");
        $this->db->where_in("kabupaten.kd_kab", [5, 6185]);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('kecamatan.nm_kec', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->limit($length, $start);
        $this->db->group_by("kabupaten.kd_kab,kecamatan.kd_kec");
        return $this->db->get();
    }
    public function countPasienKecamatan($tgl_awal, $tgl_akhir, $search = "")
    {
        $this->db->select("count(reg_periksa.no_rawat) as jumlah, kecamatan.nm_kec, kabupaten.nm_kab");
        $this->db->from("reg_periksa");
        $this->db->join("pasien", "reg_periksa.no_rkm_medis=pasien.no_rkm_medis", "left");
        $this->db->join("kabupaten", "pasien.kd_kab=kabupaten.kd_kab", "left");
        $this->db->join("kecamatan", "pasien.kd_kec=kecamatan.kd_kec", "left");
        $this->db->where_in("kabupaten.kd_kab", [5, 6185]);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('kecamatan.nm_kec', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by("kabupaten.kd_kab,kecamatan.kd_kec");
        return $this->db->get();
    }
    public function getPasienKecamatan2($tgl_awal, $tgl_akhir, $start, $length, $draw, $search = "")
    {
        $this->db->select("count(reg_periksa.no_rawat) as jumlah, kecamatan.nm_kec, kabupaten.nm_kab");
        $this->db->from("reg_periksa");
        $this->db->join("pasien", "reg_periksa.no_rkm_medis=pasien.no_rkm_medis", "left");
        $this->db->join("kabupaten", "pasien.kd_kab=kabupaten.kd_kab", "left");
        $this->db->join("kecamatan", "pasien.kd_kec=kecamatan.kd_kec", "left");
        $this->db->where_not_in("kabupaten.kd_kab", [5, 6185]);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('kecamatan.nm_kec', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->limit($length, $start);
        $this->db->group_by("kabupaten.kd_kab,kecamatan.kd_kec");
        return $this->db->get();
    }
    public function countPasienKecamatan2($tgl_awal, $tgl_akhir, $search = "")
    {
        $this->db->select("count(reg_periksa.no_rawat) as jumlah, kecamatan.nm_kec, kabupaten.nm_kab");
        $this->db->from("reg_periksa");
        $this->db->join("pasien", "reg_periksa.no_rkm_medis=pasien.no_rkm_medis", "left");
        $this->db->join("kabupaten", "pasien.kd_kab=kabupaten.kd_kab", "left");
        $this->db->join("kecamatan", "pasien.kd_kec=kecamatan.kd_kec", "left");
        $this->db->where_not_in("kabupaten.kd_kab", [5, 6185]);
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('kecamatan.nm_kec', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by("kabupaten.kd_kab,kecamatan.kd_kec");
        return $this->db->get();
    }
    public function excelPasienSuku($tgl_awal, $tgl_akhir)
    {
        $this->db->select('suku_bangsa.nama_suku_bangsa,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('suku_bangsa', 'pasien.suku_bangsa=suku_bangsa.id', 'left');
        $this->db->join('bahasa_pasien', 'pasien.bahasa_pasien=bahasa_pasien.id', 'left');
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }

        $this->db->group_by('pasien.suku_bangsa');
        return $this->db->get();
    }
    public function excelPasienPendidikan($tgl_awal, $tgl_akhir)
    {
        $this->db->select('pasien.pnd,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by('pasien.pnd');


        return $this->db->get();
    }
    public function excelPasienAgama($tgl_awal, $tgl_akhir)
    {
        $this->db->select('pasien.agama,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by('pasien.agama');
        return $this->db->get();
    }
    public function excelPasienBahasa($tgl_awal, $tgl_akhir)
    {
        $this->db->select('bahasa_pasien.nama_bahasa,count(reg_periksa.no_rawat) jml_px');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('bahasa_pasien', 'pasien.bahasa_pasien=bahasa_pasien.id', 'left');
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by('pasien.bahasa_pasien');

        return $this->db->get();
    }
    public function excelPasienUmur($tgl_awal, $tgl_akhir)
    {
        $this->db->select("
        CASE
            WHEN reg_periksa.sttsumur = 'Hr' AND reg_periksa.umurdaftar < 365 THEN '< 1 tahun'
            WHEN reg_periksa.sttsumur = 'Bl' AND reg_periksa.umurdaftar < 12 THEN '< 1 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar < 1 THEN '< 1 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 1 AND 20 THEN '1–20 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 21 AND 40 THEN '21–40 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 41 AND 60 THEN '41–60 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar BETWEEN 61 AND 80 THEN '61–80 tahun'
            WHEN reg_periksa.sttsumur = 'Th' AND reg_periksa.umurdaftar > 80 THEN '> 80 tahun'
            ELSE 'LAINNYA'
            END AS kelompok_umur,
            COUNT(reg_periksa.no_rawat) AS jumlah
        ");
        $this->db->from('reg_periksa');
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by('kelompok_umur');
        return $this->db->get();
    }
    public function excelKecamatan($tgl_awal, $tgl_akhir)
    {
        $this->db->select("count(reg_periksa.no_rawat) as jumlah, kecamatan.nm_kec, kabupaten.nm_kab");
        $this->db->from("reg_periksa");
        $this->db->join("pasien", "reg_periksa.no_rkm_medis=pasien.no_rkm_medis", "left");
        $this->db->join("kabupaten", "pasien.kd_kab=kabupaten.kd_kab", "left");
        $this->db->join("kecamatan", "pasien.kd_kec=kecamatan.kd_kec", "left");
        $this->db->where_in("kabupaten.kd_kab", [5, 6185]);

        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by("kabupaten.kd_kab,kecamatan.kd_kec");
        return $this->db->get();
    }
    public function excelKecamatan2($tgl_awal, $tgl_akhir)
    {
        $this->db->select("count(reg_periksa.no_rawat) as jumlah, kecamatan.nm_kec, kabupaten.nm_kab");
        $this->db->from("reg_periksa");
        $this->db->join("pasien", "reg_periksa.no_rkm_medis=pasien.no_rkm_medis", "left");
        $this->db->join("kabupaten", "pasien.kd_kab=kabupaten.kd_kab", "left");
        $this->db->join("kecamatan", "pasien.kd_kec=kecamatan.kd_kec", "left");
        $this->db->where_not_in("kabupaten.kd_kab", [5, 6185]);
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->group_by("kabupaten.kd_kab,kecamatan.kd_kec");
        return $this->db->get();
    }
}
