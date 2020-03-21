<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_data');
    }

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

    public function setup()
    {
        $data['user'] = $this->db->get_where('mst_user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user'] !== NULL) {
            $data['title'] = "Setup User | Double Check";
            $data['mst_user'] = $this->M_data->get_data_user();
            $this->load->view('user/header', $data);
            $this->load->view('user/setup');
            $this->load->view('user/footer');
        } else {
            redirect('Main');
        }
    }

    public function add_user()
    {
        $data['user'] = $this->db->get_where('mst_user', ['email' => $this->session->userdata('email')])->row_array();
        if ($data['user'] !== NULL) {
            $data['title'] = "Setup User | Double Check";
            $this->load->view('user/header', $data);
            $this->load->view('user/add_user');
            $this->load->view('user/footer');
        } else {
            redirect('Main');
        }
    }

    public function daftar()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Registration Page | Double Check";
            $this->load->view('main/daftar', $data);
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username')),
                'email' => htmlspecialchars($this->input->post('email')),
                'password' => $this->input->post('password'),
                'nik' => $this->input->post('nik'),
                // 'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'section' => $this->input->post('section'),
                'level' => $this->input->post('level'),
            ];

            $this->session->set_flashdata('message', '$(".alert-success").show(0).delay(5000).hide(500);');
            $this->db->insert('mst_user', $data);
            redirect('user/setup');
        }
    }
}
