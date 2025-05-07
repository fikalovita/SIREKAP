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
}
