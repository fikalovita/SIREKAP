<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_Model');
	}

	public function index()
	{
		$data['jkn'] = $this->Dashboard_Model->jkn()->num_rows();
		$data['poli'] = $this->Dashboard_Model->poliklinik()->num_rows();
		$data['igd'] = $this->Dashboard_Model->igd()->num_rows();
		$data['ranap'] = $this->Dashboard_Model->rawatInap()->num_rows();

		$this->load->view('index',$data);
	}
}
