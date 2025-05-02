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
        $tglKeluar1 = $this->input->post('tglKeluar1') ?: date('Y-m-d');
        $tglKeluar2 = $this->input->post('tglKeluar2') ?: date('Y-m-d');
        $pxKeluar =  $this->ModelSensusHarian->pasienKeluar($tglKeluar1, $tglKeluar2)->result();
        $pxKeluar2 =  $this->ModelSensusHarian->pasienKeluar2($tglKeluar1, $tglKeluar2)->result();
        $data = [];
        foreach ($pxKeluar as $px) {
            $row = [];
            $nm_dokter = $px->nm_dokter;
            $laki1 = $px->lk; // lebih 48 jam
            $pr1 = $px->pr;
            $laki2 = 0;
            $pr2 = 0;
            foreach ($pxKeluar2 as $px2) {
                if ($px2->nm_dokter == $nm_dokter) {
                    $laki2 = $px2->lk;
                    $pr2 = $px2->pr;
                }
            }
            $row[] = $nm_dokter;
            $row[] = $laki2;
            $row[] = $laki1;
            $row[] = $pr2;
            $row[] = $pr1;
            $data[] = $row;
        }
        $data_json = [
            'data' => $data
        ];
        echo json_encode($data_json);
    }

    public function dataPasienMasuk()
    {
        $tglMasuk1 = $this->input->post('tglMasuk1') ?: date('Y-m-d');
        $tglMasuk2 = $this->input->post('tglMasuk2') ?: date('Y-m-d');
        $getPasienMasuk = $this->ModelSensusHarian->pasienMasuk($tglMasuk1, $tglMasuk2)->result();

        $data = [];
        foreach ($getPasienMasuk as $pxMasuk) {
            $row = [];
            $row[] = $pxMasuk->nm_dokter;
            $row[] = $pxMasuk->jml_pasien_masuk;

            $data[] = $row;
        }
        $data_json = [
            'data' => $data
        ];

        echo json_encode($data_json);
    }

    public function pasienAwal() {
        
    }
}
