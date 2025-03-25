<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ModelAuditKepatuhan extends CI_Model
{
    public function auditKepatuhan($tanggal1 = null,$tanggal2 = null,$start = 0,$length = 0,$search = ' ') {
        $this->db->select('audit_kepatuhan_apd.nik,pegawai.nama,IF(pegawai.nama LIKE "%dr.%" ,s.nm_sps, j.nm_jbtn) as jabatan,audit_kepatuhan_apd.tindakan,audit_kepatuhan_apd.tanggal,audit_kepatuhan_apd.topi, audit_kepatuhan_apd.masker,audit_kepatuhan_apd.kacamata,audit_kepatuhan_apd.sarungtangan,audit_kepatuhan_apd.apron,audit_kepatuhan_apd.sepatu ');
        $this->db->from('audit_kepatuhan_apd');
        $this->db->join('pegawai','audit_kepatuhan_apd.nik=pegawai.nik ','left');
        $this->db->join('petugas p', 'pegawai.nik = p.nip ','left');
        $this->db->join('jabatan j', 'p.kd_jbtn = j.kd_jbtn','left');
        $this->db->join('dokter d', 'pegawai.nik = d.kd_dokter','left');
        $this->db->join('spesialis s', 'd.kd_sps = s.kd_sps','left');
        if (!empty($search)) {
           $this->db->group_start();
           $this->db->like('audit_kepatuhan_apd.nik', $search);
           $this->db->or_like('pegawai.nama', $search);
           $this->db->or_like('j.nm_jbtn', $search);
           $this->db->or_like('s.nm_sps', $search);
           $this->db->or_like('audit_kepatuhan_apd.tindakan', $search);
           $this->db->group_end();
        }
        if (!empty($tanggal1) && !empty($tanggal2)) {
           $this->db->where('date(audit_kepatuhan_apd.tanggal) >=', $tanggal1);
           $this->db->where('date(audit_kepatuhan_apd.tanggal) <=', $tanggal2);
        }
        
        $this->db->order_by('audit_kepatuhan_apd.tanggal', 'DESC');
        $this->db->limit($length,$start);
        return $this->db->get();
    }

    public function countAuditKepatuhan($tanggal1 = null,$tanggal2 = null,$search = ' ') {
        $this->db->select('audit_kepatuhan_apd.nik,pegawai.nama,IF(pegawai.nama LIKE "%dr.%" ,s.nm_sps, j.nm_jbtn) as jabatan,audit_kepatuhan_apd.tindakan,audit_kepatuhan_apd.tanggal,audit_kepatuhan_apd.topi, audit_kepatuhan_apd.masker,audit_kepatuhan_apd.kacamata,audit_kepatuhan_apd.sarungtangan,audit_kepatuhan_apd.apron,audit_kepatuhan_apd.sepatu ');
        $this->db->from('audit_kepatuhan_apd');
        $this->db->join('pegawai','audit_kepatuhan_apd.nik=pegawai.nik ','left');
        $this->db->join('petugas p', 'pegawai.nik = p.nip ','left');
        $this->db->join('jabatan j', 'p.kd_jbtn = j.kd_jbtn','left');
        $this->db->join('dokter d', 'pegawai.nik = d.kd_dokter','left');
        $this->db->join('spesialis s', 'd.kd_sps = s.kd_sps','left');
        if (!empty($search)) {
           $this->db->group_start();
           $this->db->like('audit_kepatuhan_apd.nik', $search);
           $this->db->or_like('pegawai.nama', $search);
           $this->db->or_like('j.nm_jbtn', $search);
           $this->db->or_like('s.nm_sps', $search);
           $this->db->or_like('audit_kepatuhan_apd.tindakan', $search);
           $this->db->group_end();
        }
        if (!empty($tanggal1) && !empty($tanggal2)) {
           $this->db->where('date(audit_kepatuhan_apd.tanggal) >=', $tanggal1);
           $this->db->where('date(audit_kepatuhan_apd.tanggal) <=', $tanggal2);
        }
        
        return $this->db->get();
    }

    public function excelAuditApd($tanggal1,$tanggal2) {
        $this->db->select('audit_kepatuhan_apd.nik,pegawai.nama,IF(pegawai.nama LIKE "%dr.%" ,s.nm_sps, j.nm_jbtn) as jabatan,audit_kepatuhan_apd.tindakan,audit_kepatuhan_apd.tanggal,audit_kepatuhan_apd.topi, audit_kepatuhan_apd.masker,audit_kepatuhan_apd.kacamata,audit_kepatuhan_apd.sarungtangan,audit_kepatuhan_apd.apron,audit_kepatuhan_apd.sepatu ');
        $this->db->from('audit_kepatuhan_apd');
        $this->db->join('pegawai','audit_kepatuhan_apd.nik=pegawai.nik ','left');
        $this->db->join('petugas p', 'pegawai.nik = p.nip ','left');
        $this->db->join('jabatan j', 'p.kd_jbtn = j.kd_jbtn','left');
        $this->db->join('dokter d', 'pegawai.nik = d.kd_dokter','left');
        $this->db->join('spesialis s', 'd.kd_sps = s.kd_sps','left');
        
        if (!empty($tanggal1) && !empty($tanggal2)) {
           $this->db->where('audit_kepatuhan_apd.tanggal >=', $tanggal1);
           $this->db->where('audit_kepatuhan_apd.tanggal <=', $tanggal2);
        }
        $this->db->order_by('audit_kepatuhan_apd.tanggal', 'ASC');
        return $this->db->get();
    }
}
