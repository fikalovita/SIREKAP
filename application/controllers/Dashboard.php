<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_Model');
		if (!$this->session->userdata('isLogin')) {
			redirect('Auth');
		}
	}
	public function index()
	{
		$data['pasienPoli'] = $this->Dashboard_Model->pasienPoliklinik()->result();
		$data['jkn'] = $this->Dashboard_Model->jkn()->num_rows();
		$data['poli'] = $this->Dashboard_Model->poliklinik()->num_rows();
		$data['igd'] = $this->Dashboard_Model->igd()->num_rows();
		$data['ranap'] = $this->Dashboard_Model->rawatInap()->num_rows();
		$data['statusKamar'] = $this->Dashboard_Model->statusKamar()->result();
		$data['caraBayar'] = $this->Dashboard_Model->pasienPerCaraBayar()->result();
		$data['title'] = 'Dashboard';
		$this->load->view('layout/header');
		$this->load->view('layout/sidebar', $data);
		$this->load->view('v_dashboard', $data);
		$this->load->view('layout/footer');
	}
}
