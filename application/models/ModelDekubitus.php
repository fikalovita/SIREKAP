<?php
class ModelDekubitus extends CI_Model
{

    public function tampilanPenilaianDekubitus($tanggal1, $tanggal2, $start, $length, $search){
        $this->db->select('penilaian_risiko_dekubitus.no_rawat, 
                        pasien.no_rkm_medis, 
                        pasien.nm_pasien,
                        pasien.jk, 
                        pasien.tgl_lahir, 
                        penilaian_risiko_dekubitus.tanggal,
                        penilaian_risiko_dekubitus.totalnilai,
                        penilaian_risiko_dekubitus.kategorinilai,
                        petugas.nama');
        $this->db->from('penilaian_risiko_dekubitus');
        $this->db->join('reg_periksa','penilaian_risiko_dekubitus.no_rawat = reg_periksa.no_rawat','inner');
        $this->db->join('pasien','reg_periksa.no_rkm_medis=pasien.no_rkm_medis','inner');
        $this->db->join('petugas','penilaian_risiko_dekubitus.nip=petugas.nip','inner');

         if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.no_rawat', $search);
            $this->db->or_like('pasien.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->or_like('petugas.nama', $search);
            $this->db->group_end();
        }
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('DATE(penilaian_risiko_dekubitus.tanggal) >=', $tanggal1);
            $this->db->where('DATE(penilaian_risiko_dekubitus.tanggal) <=', $tanggal2);
        }

        $this->db->order_by('penilaian_risiko_dekubitus.tanggal');
        $this->db->limit($length, $start);

        return $this->db->get();
    }

    public function countPenilaianDekubitus($tanggal1, $tanggal2, $search){
        $this->db->select('penilaian_risiko_dekubitus.no_rawat, 
                        pasien.no_rkm_medis, 
                        pasien.nm_pasien,
                        pasien.jk, 
                        pasien.tgl_lahir, 
                        penilaian_risiko_dekubitus.tanggal,
                        penilaian_risiko_dekubitus.totalnilai,
                        penilaian_risiko_dekubitus.kategorinilai,
                        petugas.nama');
        $this->db->from('penilaian_risiko_dekubitus');
        $this->db->join('reg_periksa','penilaian_risiko_dekubitus.no_rawat = reg_periksa.no_rawat','inner');
        $this->db->join('pasien','reg_periksa.no_rkm_medis=pasien.no_rkm_medis','inner');
        $this->db->join('petugas','penilaian_risiko_dekubitus.nip=petugas.nip','inner');

         if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.no_rawat', $search);
            $this->db->or_like('pasien.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->or_like('petugas.nama', $search);
            $this->db->group_end();
        }
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('DATE(penilaian_risiko_dekubitus.tanggal) >=', $tanggal1);
            $this->db->where('DATE(penilaian_risiko_dekubitus.tanggal) <=', $tanggal2);
        }

        $this->db->order_by('penilaian_risiko_dekubitus.tanggal');

        return $this->db->get();
    }

    public function tampilanDekubitus($tanggal1, $tanggal2, $start, $length, $search)
    {
        $this->db->select('kamar_inap.no_rawat,
                        pasien.no_rkm_medis,
                        pasien.nm_pasien,
                        reg_periksa.tgl_registrasi,
                        IF(kamar_inap.tgl_keluar="0000/00/00","-",kamar_inap.tgl_keluar) as tgl_keluar,
                        DATEDIFF(IF(kamar_inap.tgl_keluar = "0000-00-00", CURDATE(), kamar_inap.tgl_keluar), reg_periksa.tgl_registrasi) + 1 AS lama,
                        kamar_inap.stts_pulang AS status_pulang');
        $this->db->from('penilaian_risiko_dekubitus');
        $this->db->join('reg_periksa', 'penilaian_risiko_dekubitus.no_rawat = reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');
        $this->db->join('kamar_inap', 'reg_periksa.no_rawat = kamar_inap.no_rawat', 'inner');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('kamar_inap.no_rawat', $search);
            $this->db->or_like('pasien.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->group_end();
        }

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('DATE(penilaian_risiko_dekubitus.tanggal) >=', $tanggal1);
            $this->db->where('DATE(penilaian_risiko_dekubitus.tanggal) <=', $tanggal2);
        }
        $this->db->where_in('penilaian_risiko_dekubitus.kategorinilai', ['Risiko Tinggi', 'Risiko Sedang']);
        $this->db->where('kamar_inap.stts_pulang !=', 'Pindah Kamar');
        $this->db->group_by('penilaian_risiko_dekubitus.no_rawat');
        $this->db->order_by('penilaian_risiko_dekubitus.tanggal', 'DESC');
        $this->db->limit($length, $start);

        return $this->db->get();
    }

    public function countDekubitus($tanggal1, $tanggal2, $search)
    {
        $this->db->select('kamar_inap.no_rawat,
                        pasien.no_rkm_medis,
                        pasien.nm_pasien,
                        reg_periksa.tgl_registrasi,
                        IF(kamar_inap.tgl_keluar="0000/00/00","-",kamar_inap.tgl_keluar) as tgl_keluar,
                        DATEDIFF(IF(kamar_inap.tgl_keluar = "0000-00-00", CURDATE(), kamar_inap.tgl_keluar), reg_periksa.tgl_registrasi) + 1 AS lama,
                        kamar_inap.stts_pulang AS status_pulang');
        $this->db->from('penilaian_risiko_dekubitus');
        $this->db->join('reg_periksa', 'penilaian_risiko_dekubitus.no_rawat = reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');
        $this->db->join('kamar_inap', 'reg_periksa.no_rawat = kamar_inap.no_rawat', 'inner');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('kamar_inap.no_rawat', $search);
            $this->db->or_like('pasien.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->group_end();
        }

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('DATE(penilaian_risiko_dekubitus.tanggal) >=', $tanggal1);
            $this->db->where('DATE(penilaian_risiko_dekubitus.tanggal) <=', $tanggal2);
        }
        $this->db->where_in('penilaian_risiko_dekubitus.kategorinilai', ['Risiko Tinggi', 'Risiko Sedang']);
        $this->db->where('kamar_inap.stts_pulang !=', 'Pindah Kamar');
        $this->db->group_by('penilaian_risiko_dekubitus.no_rawat');

        return $this->db->get();
    }

    //MEMBUAT EXCEL DATA DEKUBITUS
    public function ExcelDekubitus($tanggal1, $tanggal2)
    {
        $this->db->select('kamar_inap.no_rawat,
                        pasien.no_rkm_medis,
                        pasien.nm_pasien,
                        reg_periksa.tgl_registrasi,
                        IF(kamar_inap.tgl_keluar="0000/00/00","-",kamar_inap.tgl_keluar) as tgl_keluar,
                        DATEDIFF(IF(kamar_inap.tgl_keluar = "0000-00-00", CURDATE(), kamar_inap.tgl_keluar), reg_periksa.tgl_registrasi) + 1 AS lama,
                        kamar_inap.stts_pulang AS status_pulang');
        $this->db->from('penilaian_risiko_dekubitus');
        $this->db->join('reg_periksa', 'penilaian_risiko_dekubitus.no_rawat = reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');
        $this->db->join('kamar_inap', 'reg_periksa.no_rawat = kamar_inap.no_rawat', 'inner');

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('DATE(penilaian_risiko_dekubitus.tanggal) >=', $tanggal1);
            $this->db->where('DATE(penilaian_risiko_dekubitus.tanggal) <=', $tanggal2);
        }
        $this->db->where_in('penilaian_risiko_dekubitus.kategorinilai', ['Risiko Tinggi', 'Risiko Sedang']);
        $this->db->where('kamar_inap.stts_pulang !=', 'Pindah Kamar');
        $this->db->group_by('penilaian_risiko_dekubitus.no_rawat');
        $this->db->order_by('penilaian_risiko_dekubitus.tanggal', 'DESC');

        return $this->db->get();
    }

    public function TampilAsesmenAwalIGD($tanggal1, $tanggal2, $start, $length, $search)
    {
        $this->db->select('penilaian_awal_keperawatan_igd.no_rawat, 
                        pasien.no_rkm_medis, 
                        pasien.nm_pasien, 
                        penilaian_awal_keperawatan_igd.tanggal,
                        penilaian_awal_keperawatan_igd.aktifitas');
        $this->db->from('penilaian_awal_keperawatan_igd');
        $this->db->join('reg_periksa', 'penilaian_awal_keperawatan_igd.no_rawat = reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('penilaian_awal_keperawatan_igd.no_rawat', $search);
            $this->db->or_like('pasien.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->group_end();
        }

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('DATE(penilaian_awal_keperawatan_igd.tanggal) >=', $tanggal1);
            $this->db->where('DATE(penilaian_awal_keperawatan_igd.tanggal) <=', $tanggal2);
        }

        $this->db->order_by('penilaian_awal_keperawatan_igd.tanggal', 'DESC');
        $this->db->limit($length, $start);

        return $this->db->get();
    }

    public function CountAsesmenAwalIGD($tanggal1 = null, $tanggal2 = null, $search = null)
    {
        $this->db->from('penilaian_awal_keperawatan_igd');
        $this->db->join('reg_periksa', 'penilaian_awal_keperawatan_igd.no_rawat = reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('penilaian_awal_keperawatan_igd.no_rawat', $search);
            $this->db->or_like('pasien.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->group_end();
        }

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('DATE(penilaian_awal_keperawatan_igd.tanggal) >=', $tanggal1);
            $this->db->where('DATE(penilaian_awal_keperawatan_igd.tanggal) <=', $tanggal2);
        }

        return $this->db->count_all_results(); // Menggunakan count_all_results() agar lebih cepat
    }

    public function KetDekubitus($norawat)
    {
        $this->db->select('if(count(penilaian_risiko_dekubitus.no_rawat)>0,"Ada","Tidak Ada") as  kelengkapan');
        $this->db->from('penilaian_risiko_dekubitus');
        $this->db->where('penilaian_risiko_dekubitus.no_rawat', $norawat);

        return $this->db->get();
    }

    public function ExcelTampilAsesmenAwalIGD($tanggal1, $tanggal2)
    {
        $this->db->select('penilaian_awal_keperawatan_igd.no_rawat, 
                        pasien.no_rkm_medis, 
                        pasien.nm_pasien, 
                        penilaian_awal_keperawatan_igd.tanggal,
                        penilaian_awal_keperawatan_igd.aktifitas');
        $this->db->from('penilaian_awal_keperawatan_igd');
        $this->db->join('reg_periksa', 'penilaian_awal_keperawatan_igd.no_rawat = reg_periksa.no_rawat', 'inner');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('DATE(penilaian_awal_keperawatan_igd.tanggal) >=', $tanggal1);
            $this->db->where('DATE(penilaian_awal_keperawatan_igd.tanggal) <=', $tanggal2);
        }

        $this->db->order_by('penilaian_awal_keperawatan_igd.tanggal', 'DESC');

        return $this->db->get();
    }
}
