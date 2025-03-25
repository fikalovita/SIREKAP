<?php
class Dashboard_Model extends CI_Model
{

    public function jkn()
    {
        $this->db->select('no_rawat,nomorkartu,nik,nohp,kodepoli,pasienbaru,norm,tanggalperiksa,kodedokter,jampraktek,jeniskunjungan,nomorreferensi,nomorantrean,angkaantrean,estimasidilayani,sisakuotajkn,sisakuotanonjkn,kuotanonjkn,status,validasi,statuskirim');
        $this->db->from('referensi_mobilejkn_bpjs');
        $this->db->where('tanggalperiksa', date('Y-m-d'));

        return $this->db->get();
    }

    public function poliklinik()
    {
        $this->db->select('reg_periksa.no_rawat');
        $this->db->from('reg_periksa');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli');
        $this->db->where('tgl_registrasi', date('Y-m-d'));
        $this->db->where('reg_periksa.kd_poli <>', 'IGDK');

        return $this->db->get();
    }
    public function igd()
    {
        $this->db->select('reg_periksa.no_rawat');
        $this->db->from('reg_periksa');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli', 'inner');
        $this->db->where('tgl_registrasi', date('Y-m-d'));
        $this->db->where('reg_periksa.kd_poli', 'IGDK');

        return $this->db->get();
    }

    public function rawatInap()
    {
        $this->db->select('kamar_inap.no_rawat,kamar_inap.tgl_masuk,bangsal.nm_bangsal,pasien.no_rkm_medis, pasien.nm_pasien, dokter.nm_dokter,kamar_inap.stts_pulang');
        $this->db->from('kamar_inap');
        $this->db->join('kamar', 'kamar_inap.kd_kamar=kamar.kd_kamar');
        $this->db->join('bangsal', 'kamar.kd_bangsal=bangsal.kd_bangsal');
        $this->db->join('reg_periksa', 'kamar_inap.no_rawat = reg_periksa.no_rawat');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis');
        $this->db->join('dpjp_ranap', 'reg_periksa.no_rawat=dpjp_ranap.no_rawat');
        $this->db->join('dokter', 'dpjp_ranap.kd_dokter=dokter.kd_dokter');
        $this->db->where('stts_pulang', '-');

        return $this->db->get();
    }

    public function pasienPoliklinik()
    {
        $this->db->select("poliklinik.nm_poli, dokter.nm_dokter, count(reg_periksa.kd_poli) as jumlah");
        $this->db->from("reg_periksa");
        $this->db->join("poliklinik", "reg_periksa.kd_poli=poliklinik.kd_poli");
        $this->db->join("dokter", "reg_periksa.kd_dokter=dokter.kd_dokter");
        $this->db->where("reg_periksa.tgl_registrasi", date('Y-m-d'));
        $this->db->where("reg_periksa.kd_poli <>", 'IGDK');
        $this->db->group_by("reg_periksa.kd_dokter");

        return $this->db->get();
    }

    public function statusKamar()
    {
        $this->db->select("bangsal.nm_bangsal,count(kamar.kd_bangsal) AS jumlah_kmr,SUM(kamar.status='ISI') AS kmr_isi,SUM(kamar.status='KOSONG') AS kmr_kosong, kamar.kelas");
        $this->db->from("kamar");
        $this->db->join("bangsal", "kamar.kd_bangsal = bangsal.kd_bangsal");
        $this->db->where("statusdata ='1'");
        $this->db->group_by("kamar.kd_bangsal");

        return $this->db->get();
    }

    public function pasienPerCaraBayar()
    {
        $this->db->select("COUNT(reg_periksa.kd_pj) as jns_bayar,penjab.png_jawab,reg_periksa.kd_poli,poliklinik.nm_poli,reg_periksa.kd_dokter,dokter.nm_dokter");
        $this->db->from("reg_periksa");
        $this->db->join('penjab', 'reg_periksa.kd_pj=penjab.kd_pj', 'inner');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli');
        $this->db->join('dokter', 'reg_periksa.kd_dokter=dokter.kd_dokter');
        $this->db->where('reg_periksa.tgl_registrasi', date('Y-m-d'));
        $this->db->where('reg_periksa.kd_poli <>', 'IGDK');
        $this->db->group_by('reg_periksa.kd_dokter,reg_periksa.kd_pj');

        return $this->db->get();
    }
}
