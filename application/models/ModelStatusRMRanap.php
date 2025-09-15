<?php
class ModelStatusRMRanap extends CI_Model
{
    public function getPasienRanap($tgl_awal, $tgl_akhir, $status_ranap, $start, $length, $search = "")
    {
        $this->db->select('reg_periksa.no_rawat,reg_periksa.tgl_registrasi,dp.nm_dokter as dpjp,dr.nm_dokter as dr_jaga,reg_periksa.no_rkm_medis,pasien.nm_pasien,kamar_inap.stts_pulang');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'inner');
        $this->db->join('kamar_inap', 'reg_periksa.no_rawat=kamar_inap.no_rawat', 'left');
        $this->db->join('dpjp_ranap', 'reg_periksa.no_rawat=dpjp_ranap.no_rawat', 'left');
        $this->db->join('dokter dp', 'dpjp_ranap.kd_dokter=dp.kd_dokter', 'left');
        $this->db->join('dokter dr', 'reg_periksa.kd_dokter=dr.kd_dokter', 'left');
        $this->db->where('kamar_inap.stts_pulang <>', 'Pindah Kamar');
        if (!empty($status_ranap)) {
            $this->db->where('kamar_inap.stts_pulang', $status_ranap);
        } else {
            $this->db->where('kamar_inap.stts_pulang <>', 'Pindah Kamar');
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.no_rawat', $search);
            $this->db->or_like('reg_periksa.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->or_like('dp.nm_dokter', $search);
            $this->db->or_like('dr.nm_dokter', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        $this->db->limit($length, $start);
        return $this->db->get();
    }
    public function countPasienRanap($tgl_awal, $tgl_akhir, $status_ranap, $search = "")
    {
        $this->db->select('reg_periksa.no_rawat,reg_periksa.tgl_registrasi,dp.nm_dokter as dpjp,dr.nm_dokter as dr_jaga,reg_periksa.no_rkm_medis,pasien.nm_pasien,kamar_inap.stts_pulang');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'inner');
        $this->db->join('kamar_inap', 'reg_periksa.no_rawat=kamar_inap.no_rawat', 'left');
        $this->db->join('dpjp_ranap', 'reg_periksa.no_rawat=dpjp_ranap.no_rawat', 'left');
        $this->db->join('dokter dp', 'dpjp_ranap.kd_dokter=dp.kd_dokter', 'left');
        $this->db->join('dokter dr', 'reg_periksa.kd_dokter=dr.kd_dokter', 'left');
        $this->db->where('kamar_inap.stts_pulang <>', 'Pindah Kamar');
        if (!empty($status_ranap)) {
            $this->db->where('kamar_inap.stts_pulang', $status_ranap);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.no_rawat', $search);
            $this->db->or_like('reg_periksa.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->or_like('dp.nm_dokter', $search);
            $this->db->or_like('dr.nm_dokter', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        return $this->db->get();
    }

    public function getSoapie($no_rawat)
    {
        $this->db->select('if(count(pemeriksaan_ranap.no_rawat)>0,"Ada","Tidak Ada") as soap');
        $this->db->from('pemeriksaan_ranap');
        $this->db->where('pemeriksaan_ranap.no_rawat', $no_rawat);

        return $this->db->get();
    }

    public function getResume($no_rawat)
    {
        $this->db->select('if(count(resume_pasien_ranap.no_rawat)>0,"Ada","Tidak Ada") as resume');
        $this->db->from('resume_pasien_ranap');
        $this->db->where('resume_pasien_ranap.no_rawat', $no_rawat);

        return $this->db->get();
    }

    public function getTriaseIGD($no_rawat)
    {
        $this->db->select('if(count(data_triase_igd.no_rawat)>0,"Ada","Tidak Ada") as triase');
        $this->db->from('data_triase_igd');
        $this->db->where('data_triase_igd.no_rawat', $no_rawat);

        return $this->db->get();
    }

    public function getAskepIGD($no_rawat)
    {
        $this->db->select('if(count(penilaian_awal_keperawatan_igd.no_rawat)>0,"Ada","Tidak Ada") as askep');
        $this->db->from('penilaian_awal_keperawatan_igd');
        $this->db->where('penilaian_awal_keperawatan_igd.no_rawat', $no_rawat);

        return $this->db->get();
    }

    public function getICD9($no_rawat)
    {
        $this->db->select('if(count(prosedur_pasien.no_rawat)>0,"Ada","Tidak Ada") as icd9');
        $this->db->from('prosedur_pasien');
        $this->db->where('prosedur_pasien.no_rawat', $no_rawat);
        $this->db->where('prosedur_pasien.status', 'Ranap');
        return $this->db->get();
    }

    public function getICD10($no_rawat)
    {
        $this->db->select('if(count(diagnosa_pasien.no_rawat)>0,"Ada","Tidak Ada") as icd10');
        $this->db->from('diagnosa_pasien');
        $this->db->where('diagnosa_pasien.no_rawat', $no_rawat);
        $this->db->where('diagnosa_pasien.status', 'Ranap');

        return $this->db->get();
    }

    public function exportExcelRanap($tgl_awal, $tgl_akhir, $status_ranap)
    {
        $this->db->select('reg_periksa.no_rawat,reg_periksa.tgl_registrasi,dp.nm_dokter as dpjp,dr.nm_dokter as dr_jaga,reg_periksa.no_rkm_medis,pasien.nm_pasien,kamar_inap.stts_pulang');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'inner');
        $this->db->join('kamar_inap', 'reg_periksa.no_rawat=kamar_inap.no_rawat', 'left');
        $this->db->join('dpjp_ranap', 'reg_periksa.no_rawat=dpjp_ranap.no_rawat', 'left');
        $this->db->join('dokter dp', 'dpjp_ranap.kd_dokter=dp.kd_dokter', 'left');
        $this->db->join('dokter dr', 'reg_periksa.kd_dokter=dr.kd_dokter', 'left');
        $this->db->where('kamar_inap.stts_pulang <>', 'Pindah Kamar');
        if (!empty($status_ranap)) {
            $this->db->where('kamar_inap.stts_pulang', $status_ranap);
        } else {
            $this->db->where('kamar_inap.stts_pulang <>', 'Pindah Kamar');
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        return $this->db->get();
    }
}
