<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SEPRajal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
        $this->load->model('ModelSEPRajal');
        $this->load->model('ModelCetakSEP');
    }
    public function index()
    {
        $data['title'] = 'Data SEP Rawat Jalan';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('v_sep_rajal');
        $this->load->view('layout/footer');
    }

    public function dataSEPRajal()
    {
        $tglSepRajal1 = $this->input->post('tglSepRajal1') ?: date('Y-m-d');
        $tglSepRajal2 = $this->input->post('tglSepRajal2') ?: date('Y-m-d');
        $search = $this->input->post('search')['value'];
        $dataSEP = $this->ModelSEPRajal->getPoliklinik($tglSepRajal1, $tglSepRajal2, $search)->result();
        $data = [];
        foreach ($dataSEP as $sep) {
            $row = [];
            $row[] = '<div class="text-center">
                <button class="btn btn-info kd-dokter-btn btn-sm" data-toggle="modal" data-target="#' . $sep->kd_dokter . '" data-dokter="' . $sep->kd_dokter . '">
                    <i class="fas fa-eye"></i>
                </button>
            </div>';
            $row[] = $sep->nm_poli;
            $row[] = $sep->nm_dokter;
            $row[] = $sep->jumlah_sep;
            $row[] = $sep->bpjs;
            $row[] = $sep->umum;
            $row[] = $sep->lainnya;
            $data[] = $row;
        }

        $data_json = ['data' => $data];

        echo json_encode($data_json);
    }

    public function dataPasienSEP()
    {
        $kd_dokter = $this->input->post('kd_dokter');
        $tglSepRajal1 = $this->input->post('tglSepRajal1') ?: date('Y-m-d');
        $tglSepRajal2 = $this->input->post('tglSepRajal2') ?: date('Y-m-d');
        $search = $this->input->post('search')['value'];
        // var_dump($kd_dokter);
        $getPasienSEP = $this->ModelCetakSEP->getPasien($kd_dokter, $tglSepRajal1, $tglSepRajal2, $search)->result();


        $data = [];

        foreach ($getPasienSEP as $getPasienSEP) {
            $row = [];
            $row[] = $getPasienSEP->no_rawat;
            $row[] = $getPasienSEP->no_rkm_medis;
            $row[] = $getPasienSEP->nm_pasien;
            $row[] = $getPasienSEP->nm_dokter;
            $row[] = $getPasienSEP->nm_poli;
            $row[] = $getPasienSEP->png_jawab;
            $getSEP = $this->ModelCetakSEP->getSEP($getPasienSEP->no_rawat)->result();
            if (!empty($getSEP)) {
                foreach ($getSEP as $getSEP) {
                    $row[] = !empty($getSEP->no_sep) ? $getSEP->no_sep : "Belum SEP";
                }
            } else {
                $row[] = '<span class="badge badge-danger">Belum SEP</span>';
            }

            $data[] = $row;
        }

        $data_json = ['data' => $data];
        echo json_encode($data_json);
    }
}
