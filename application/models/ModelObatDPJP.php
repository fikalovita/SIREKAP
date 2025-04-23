<?php
class ModelObatDPJP extends CI_Model
{
    public function getDokterDPJP($nmDokter)
    {
        $this->db->select('dokter.nm_dokter, dokter.kd_dokter');
        $this->db->from('dokter');
        $this->db->where('dokter.kd_dokter <>', '-');
        $this->db->where('dokter.kd_dokter', $nmDokter);
        $this->db->where('dokter.status', '1');


        return $this->db->get();
    }

    public function getDokterDPJPFilter()
    {
        $this->db->select('dokter.nm_dokter, dokter.kd_dokter');
        $this->db->from('dokter');
        $this->db->where('dokter.kd_dokter <>', '-');
        $this->db->where('dokter.status', '1');


        return $this->db->get();
    }

    public function getPasien($kd_dokter, $tanggal1 = null, $tanggal2 = null)
    {
        $this->db->select('reg_periksa.no_rawat, reg_periksa.no_rkm_medis, pasien.nm_pasien, dpjp_ranap.no_rawat, detail_pemberian_obat.status');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'inner');
        $this->db->join('dpjp_ranap', 'reg_periksa.no_rawat=dpjp_ranap.no_rawat', 'left');
        $this->db->join('detail_pemberian_obat', 'reg_periksa.no_rawat=detail_pemberian_obat.no_rawat', 'inner');
        $this->db->where('detail_pemberian_obat.status', 'Ranap');
        $this->db->where('dpjp_ranap.kd_dokter', $kd_dokter);
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tanggal1);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tanggal2);
        }
        $this->db->group_by(['reg_periksa.no_rawat', 'pasien.nm_pasien']);
        return $this->db->get();
    }

    public function getTglDetailObat($no_rawat)
    {
        $this->db->select('detail_pemberian_obat.tgl_perawatan');
        $this->db->from('detail_pemberian_obat');
        $this->db->where('detail_pemberian_obat.status', 'Ranap');
        $this->db->where('detail_pemberian_obat.no_rawat', $no_rawat);
        $this->db->group_by('detail_pemberian_obat.tgl_perawatan');
        $this->db->order_by('detail_pemberian_obat.tgl_perawatan', 'ASC');
        return $this->db->get();
    }

    public function getDetailObat($no_rawat, $tgl_perawatan)
    {
        $this->db->select('detail_pemberian_obat.kode_brng,databarang.nama_brng,sum(detail_pemberian_obat.jml) as jml,sum(detail_pemberian_obat.total)-sum(detail_pemberian_obat.embalase+detail_pemberian_obat.tuslah) as total,sum(detail_pemberian_obat.embalase) as embalase,sum(detail_pemberian_obat.tuslah) as tuslah,sum(total) as subtotal');
        $this->db->from('detail_pemberian_obat');
        $this->db->join('databarang', 'detail_pemberian_obat.kode_brng=databarang.kode_brng', 'inner');
        $this->db->where('detail_pemberian_obat.status', 'Ranap');
        $this->db->where('detail_pemberian_obat.no_rawat', $no_rawat);
        $this->db->where('detail_pemberian_obat.tgl_perawatan', $tgl_perawatan);
        $this->db->group_by('detail_pemberian_obat.kode_brng');
        return $this->db->get();
    }
}
