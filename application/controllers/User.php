<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $data['user'] = $this->db->get_where('mst_user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user'] !== NULL) {
            $data['title'] = "Dashboard | Double Check";
            $this->load->view('user/header', $data);
            $this->load->view('user/dashboard');
            $this->load->view('user/footer');
        } else {
            redirect('Main');
        }
    }
}
