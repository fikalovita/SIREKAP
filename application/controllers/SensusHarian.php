<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SensusHarian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
        $this->load->model('ModelSensusHarian');
    }
    public function index()
    {
        $data['title'] = 'Sensus Harian';
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $data);
        $this->load->view('v_sensus_harian');
        $this->load->view('layout/footer');
    }
    public function dataPasienKeluar()
    {
        $pxKeluar =  $this->ModelSensusHarian->pasienKeluar($tglKeluar1, $tglKeluar2)->result();
        $data = [];
        foreach ($pxKeluar as $px) {
            $row = [];
            $row[] = $px->nm_dokter;
            $row[] = $px->lk;
        }
    }
}
