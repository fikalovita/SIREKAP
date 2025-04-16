<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SensusHarian extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Sensus Harian';
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar', $data);
        $this->load->view('v_sensus_harian');
        $this->load->view('layout/footer');
    }
    public function pasienMasuk() {}
}
