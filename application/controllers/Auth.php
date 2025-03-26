<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelAuth');
    }
    public function index()
    {
        $this->load->view('v_auth');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $authResult = $this->ModelAuth->auth($username, $password);
        $auth = $authResult->row();
        if ($authResult && $authResult->num_rows() > 0) {
            $data = [
                'isLogin' => true,
                'id_user' => $auth->id_user,
                'password' => $auth->password,
                'nama_pegawai' => $auth->nama
            ];
            $this->session->set_userdata($data);

            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', '<div class="alert table-danger" role="alert">
            Username atau Password salah ! </div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
