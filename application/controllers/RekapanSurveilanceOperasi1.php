<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapanSurveilanceOperasi1 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelSurveilanceOperasi');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {

        $data['title'] = 'Surveilance Infeksi Luka Operasi';
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $data);
        $this->load->view('v_rekap_surveilance_operasi');
        $this->load->view('layout/footer');
    }

    public function data()
    {
        $norawat = $this->input->post('jnorawat');

        $data['validasi_operasi'] = $this->ModelSurveilanceOperasi->operasi_validasi($norawat)->result();

        $data['pasien'] = $this->ModelSurveilanceOperasi->pasien($norawat)->result();
        $pasien = $this->ModelSurveilanceOperasi->pasien($norawat)->result();
        $data['operasi'] = $this->ModelSurveilanceOperasi->operasi($norawat)->result();
        $data['preanastesi'] = $this->ModelSurveilanceOperasi->preanastesi($norawat)->result();
        $data['checklist_preoperasi'] = $this->ModelSurveilanceOperasi->preoperasi($norawat)->result();
        $data['datatimeout'] = $this->ModelSurveilanceOperasi->timeout_sebelum_insisi($norawat)->result();
        $data['signin_sebelum_anestesi'] = $this->ModelSurveilanceOperasi->signin_sebelum_anestesi($norawat)->result();

        echo json_encode($data);
        // var_dump($data);
    }
    // public function print()
    // {
    //     $this->load->view('print/p_rekap_surveilance');
    // }
}
