<?php
class ModelCuciTangan extends CI_Model
{
    public function cuciTangan($tanggal1 = null,$tanggal2 = null, $start = 0, $length = 0, $search = ' ') {
        $this->db->select("audit_cuci_tangan_medis.nik,pegawai.nama,IF(pegawai.nama LIKE '%dr.%',s.nm_sps, j.nm_jbtn) AS jabatan,audit_cuci_tangan_medis.tanggal,audit_cuci_tangan_medis.sebelum_menyentuh_pasien,
                    audit_cuci_tangan_medis.sebelum_tehnik_aseptik,audit_cuci_tangan_medis.setelah_terpapar_cairan_tubuh_pasien,
                    audit_cuci_tangan_medis.setelah_kontak_dengan_pasien,audit_cuci_tangan_medis.setelah_kontak_dengan_lingkungan_pasien ");
        $this->db->from('audit_cuci_tangan_medis');
        $this->db->join('pegawai', 'audit_cuci_tangan_medis.nik=pegawai.nik', 'inner');
        $this->db->join('petugas p', 'pegawai.nik = p.nip', 'left');
        $this->db->join('jabatan j', 'p.kd_jbtn=j.kd_jbtn', 'left');
        $this->db->join('dokter d','pegawai.nik = d.kd_dokter','left');
        $this->db->join('spesialis s', 'd.kd_sps=s.kd_sps', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('audit_cuci_tangan_medis.nik',$search);
            $this->db->or_like('pegawai.nama',$search);
            $this->db->group_end();

        }
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('date(audit_cuci_tangan_medis.tanggal) >=', $tanggal1);
            $this->db->where('date(audit_cuci_tangan_medis.tanggal) <=', $tanggal2);
        }
        $this->db->order_by('audit_cuci_tangan_medis.tanggal', 'DESC');
        $this->db->limit($length,$start);
        return $this->db->get();
    }

    public function countCuciTangan($tanggal1 = null,$tanggal2 = null,$search = ' ') {
        $this->db->select('audit_cuci_tangan_medis.nik,pegawai.nama, if(pegawai.nama LIKE "%dr.%", s.nm_sps, j.nm_jbtn) as jabatan, audit_cuci_tangan_medis.tanggal,audit_cuci_tangan_medis.sebelum_menyentuh_pasien,audit_cuci_tangan_medis.sebelum_tehnik_aseptik,audit_cuci_tangan_medis.setelah_terpapar_cairan_tubuh_pasien,audit_cuci_tangan_medis.setelah_kontak_dengan_pasien,audit_cuci_tangan_medis.setelah_kontak_dengan_lingkungan_pasien');
        $this->db->from('audit_cuci_tangan_medis');
        $this->db->join('pegawai', 'audit_cuci_tangan_medis.nik=pegawai.nik', 'inner');
        $this->db->join('petugas p', 'pegawai.nik = p.nip', 'left');
        $this->db->join('jabatan j', 'p.kd_jbtn=j.kd_jbtn', 'left');
        $this->db->join('dokter d','pegawai.nik = d.kd_dokter','left');
        $this->db->join('spesialis s', 'd.kd_sps=s.kd_sps', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('audit_cuci_tangan_medis.nik',$search);
            $this->db->or_like('pegawai.nama',$search);
            $this->db->group_end();

        }
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('date(audit_cuci_tangan_medis.tanggal) >=', $tanggal1);
            $this->db->where('date(audit_cuci_tangan_medis.tanggal) <=', $tanggal2);
        }

       
        return $this->db->get();
    }

    public function excelCuciTangan($tanggal1,$tanggal2) {
        $this->db->select('audit_cuci_tangan_medis.nik,pegawai.nama, if(pegawai.nama LIKE "%dr.%", s.nm_sps, j.nm_jbtn) as jabatan, audit_cuci_tangan_medis.tanggal,audit_cuci_tangan_medis.sebelum_menyentuh_pasien,audit_cuci_tangan_medis.sebelum_tehnik_aseptik,audit_cuci_tangan_medis.setelah_terpapar_cairan_tubuh_pasien,audit_cuci_tangan_medis.setelah_kontak_dengan_pasien,audit_cuci_tangan_medis.setelah_kontak_dengan_lingkungan_pasien');
        $this->db->from('audit_cuci_tangan_medis');
        $this->db->join('pegawai', 'audit_cuci_tangan_medis.nik=pegawai.nik', 'inner');
        $this->db->join('petugas p', 'pegawai.nik = p.nip', 'left');
        $this->db->join('jabatan j', 'p.kd_jbtn=j.kd_jbtn', 'left');
        $this->db->join('dokter d','pegawai.nik = d.kd_dokter','left');
        $this->db->join('spesialis s', 'd.kd_sps=s.kd_sps', 'left');
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('date(audit_cuci_tangan_medis.tanggal) >=', $tanggal1);
            $this->db->where('date(audit_cuci_tangan_medis.tanggal) <=', $tanggal2);
        }
        $this->db->order_by('audit_cuci_tangan_medis.tanggal', 'ASC');
       
        return $this->db->get();
    }
}
