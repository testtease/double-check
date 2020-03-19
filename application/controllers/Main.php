<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login Page | Double Check';
            $this->load->view('main/index', $data);
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('mst_user', ['email' => $email])->row_array();
        var_dump($user);

        if ($user) {
            if ($user['password'] == $password) {
                $data = [
                    'email' => $user['email'],
                    'nama' => $user['nama'],
                    'nik' => $user['nik'],
                    'level' => $user['level'],
                    'sect' => $user['sect']
                ];
                $this->session->set_userdata($data);
                redirect('user', $data);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password Salah!</div>');
                redirect('main');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> User Tidak Terdaftar!</div>');
            redirect('main');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('main');
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

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> User Berhasil Terdaftar!</div>');
            $this->db->insert('mst_user', $data);
            redirect('main');
        }
    }
}
