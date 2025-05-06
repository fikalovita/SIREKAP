<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapSEP extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelCetakSEP');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Data Bridging SEP BPJS';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('v_cetak_sep');
        $this->load->view('layout/footer');
    }

    public function dataSEP()
    {
        $tglSep1 = $this->input->post('tglSep1') ?: date('Y-m-d');
        $tglSep2 = $this->input->post('tglSep2') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $dataPx = $this->ModelCetakSEP->getPasien($tglSep1, $tglSep2, $start, $length, $search)->result();
        $recordTotal = $this->ModelCetakSEP->countPasien($tglSep1, $tglSep2, $search)->num_rows();
        $data = [];
        foreach ($dataPx as $sep) {
            $row = [];
            $row[] = $sep->no_rawat;
            $row[] = $sep->no_rkm_medis;
            $row[] = $sep->nm_pasien;
            $row[] = $sep->nm_dokter;
            $row[] = $sep->nm_poli;
            $row[] = $sep->png_jawab;
            $dataSEP = $this->ModelCetakSEP->getSEP($sep->no_rawat)->result();
            if (!empty($dataSEP)) {
                foreach ($dataSEP as $sep_item) {
                    $row[] = !empty($sep_item->no_sep) ? $sep_item->no_sep : "Belum SEP";
                }
            } else {
                $row[] = '<span class="badge badge-danger">Belum SEP</span>';
            }

            $data[] = $row;
        }

        $data_json = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data
        ];
        echo json_encode($data_json);
    }
}
