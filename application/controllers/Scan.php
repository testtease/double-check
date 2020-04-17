<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_scan_in');
        $this->load->model('M_scan_out');
        $this->load->model('M_data');
    }
    public function scan_in()
    {
        $check_status_scan_in = $this->M_scan_in->check_status();
        if ($check_status_scan_in > 0) {
            redirect("scan/approve_gl_in");
        } else {
            $data['user'] = $this->db->get_where('mst_user', ['nik' => $this->session->userdata('nik')])->row_array();
            $data['title'] = "Scan In | Double Check";
            $this->load->view('scan/header', $data);
            $this->load->view('scan/scan_in');
            $this->load->view('scan/footer');
        }
    }
    public function scan_out()
    {
        $check_status_scan_out = $this->M_scan_out->check_status();
        if ($check_status_scan_out > 0) {
            redirect("scan/approve_gl_out");
        } else {
            $data['user'] = $this->db->get_where('mst_user', ['nik' => $this->session->userdata('nik')])->row_array();
            $data['title'] = "Scan Out | Double Check";
            $this->load->view('scan/header', $data);
            $this->load->view('scan/scan_out');
            $this->load->view('scan/footer');
        }
    }
    public function log()
    {
        $data['user'] = $this->db->get_where('mst_user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['title'] = "Log History | Double Check";
        $this->load->view('user/header', $data);
        $this->load->view('scan/log');
        $this->load->view('user/footer');
    }
    public function log_scan_in()
    {
        $data['user'] = $this->db->get_where('mst_user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['title'] = "Log History Scan In | Double Check";
        $data['history_in'] = $this->M_data->get_data_scan_in();
        // var_dump($data['history_in']);
        $this->load->view('scan/header', $data);
        $this->load->view('scan/scan_in_history');
        $this->load->view('scan/footer');
    }
    public function log_scan_out()
    {
        $data['user'] = $this->db->get_where('mst_user', ['nik' => $this->session->userdata('nik')])->row_array();
        $data['title'] = "Log History Scan Out | Double Check";
        $data['history_out'] = $this->M_data->get_data_scan_out();
        $this->load->view('scan/header', $data);
        $this->load->view('scan/scan_out_history');
        $this->load->view('scan/footer');
    }

    public function insert_scan_out()
    {
        $data['user'] = $this->db->get_where('mst_user', ['nik' => $this->session->userdata('nik')])->row_array();
        $username = $data['user']['username'];
        $nik = $data['user']['nik'];

        if ($this->input->post('tipe') == "label") {
            $label = $this->input->post('jai_label');
            $explode_a = explode(",", $label);
            $explode_b = explode(".", $explode_a[1]);
            $explode_c = explode("-", $explode_b[1]);
            $jai_label = $explode_a[0];
            $assy_code_label = substr($explode_b[0], 4, 4);
            $ctn_no1 = $explode_c[0];
            $ctn_no2 = $explode_c[1];

            $qr = $this->input->post('jai_qr');
            $explode_qr = explode(",", $qr);
            $jai_qr = $explode_qr[0];
            $assy_code_qr = substr($explode_qr[0], 4, 4);
            $ctn_no_qr = substr($explode_qr[0], 9, 7);

            $pallet = $this->input->post('jai_pallet');
            $explode_pallet = explode(",", $pallet);
            $jai_pallet = $explode_pallet[0];
            $assy_code_pallet = substr($explode_pallet[0], 4, 4);
            $ctn_no_pallet = explode("-", $explode_pallet[1]);
            $ctn_no1_pallet = $ctn_no_pallet[0];
            $ctn_no2_pallet = $ctn_no_pallet[1];

            // $count_ctn_pallet = $ctn_no2_pallet - $ctn_no1_pallet + 1;


            $jml_ctn = $ctn_no2 - $ctn_no1 + 1;
            $ctn_label = (int) $ctn_no1;
            $ctn_qr = (int) $ctn_no_qr;
            for ($i = 0; $i < $jml_ctn; $i++) {
                // echo $assy_code_label . $ctn_label;
                // echo "<br>";
                // echo $assy_code_qr . $ctn_qr;
                // echo "<br>";
                // echo "------------------------------";
                // echo "<br>";

                if ($assy_code_label . $ctn_label == $assy_code_qr . $ctn_qr) {
                    // echo $assy_code_label . (int) $ctn_no1 . (int) $ctn_no2;
                    // echo "<br>";
                    // echo $assy_code_pallet . (int) $ctn_no1_pallet . (int) $ctn_no2_pallet;
                    // echo "<br>";

                    if ($assy_code_label . (int) $ctn_no1 . (int) $ctn_no2 == $assy_code_pallet . (int) $ctn_no1_pallet . (int) $ctn_no2_pallet) {
                        $status = "VALID";
                        $i = 10000;
                    } else {
                        $status = "TIDAK VALID";
                    }
                } else {
                    $status = "TIDAK VALID";
                    $ctn_label++;
                }

                // echo $status;
                // echo "<br>";
            }

            $this->M_scan_out->insert_data($jai_label, $assy_code_label, $ctn_no1, $ctn_no2, $jai_qr, $assy_code_qr, $ctn_no_qr, $jai_pallet, $assy_code_pallet, $ctn_no1_pallet, $ctn_no2_pallet, $status, $username, $nik);
            echo json_encode(array(
                "statusCode" => $status,
                "assyCode" => $assy_code_label
            ));
        }
    }


    public function insert_scan_in()
    {
        $data['user'] = $this->db->get_where('mst_user', ['nik' => $this->session->userdata('nik')])->row_array();
        $username = $data['user']['username'];
        $nik = $data['user']['nik'];

        if ($this->input->post('tipe') == "label") {
            $label = $this->input->post('jai_label');
            $explode_a = explode(",", $label);
            $explode_b = explode(".", $explode_a[1]);
            $explode_c = explode("-", $explode_b[1]);
            $jai_label = $explode_a[0];
            $assy_code_label = substr($explode_b[0], 4, 4);
            $ctn_no1 = $explode_c[0];
            $ctn_no2 = $explode_c[1];

            $qr = $this->input->post('jai_qr');
            $explode_qr = explode(",", $qr);
            $jai_qr = $explode_qr[0];
            $assy_code_qr = substr($explode_qr[0], 4, 4);
            $ctn_no_qr = substr($explode_qr[0], 9, 7);

            $jml_ctn = $ctn_no2 - $ctn_no1 + 1;
            $ctn_label = (int) $ctn_no1;
            $ctn_qr = (int) $ctn_no_qr;



            for ($i = 0; $i < $jml_ctn; $i++) {
                if ($assy_code_label . $ctn_label == $assy_code_qr . $ctn_qr) {
                    $status = "VALID";
                    $i = 1000;
                } else {
                    $status = "TIDAK VALID";
                    $ctn_label++;
                }
            }

            $this->M_scan_in->insert_label($jai_label, $assy_code_label, $ctn_no1, $ctn_no2, $jai_qr, $assy_code_qr, $ctn_no_qr, $status, $username, $nik);
            echo json_encode(array(
                "statusCode" => $status,
                "assyCode" => $assy_code_label
            ));
        }
    }

    function check_scan_in()
    {
        $label = $this->input->post('jai_label');
        $explode_a = explode(",", $label);
        $jai_label = $explode_a[0];

        $check = $this->M_scan_out->check_jai_label($jai_label);
        if ($check > 0) {
            echo json_encode(array(
                "statusCode" => "ADA",
                "jaiLabel" => $jai_label
            ));
        } else {
            echo json_encode(array(
                "statusCode" => "TIDAK ADA",
                "jaiLabel" => $jai_label
            ));
        }
    }


    function approve_gl_out()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required');

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->db->get_where('mst_user', ['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = "Scan Out | Double Check";
            $this->load->view('scan/header', $data);
            $this->load->view('scan/approve_gl_out');
            $this->load->view('scan/footer');
        } else {
            $nik = $this->input->post('nik');

            $user = $this->db->get_where('mst_user', ['nik' => $nik])->row_array();
            if ($user) {
                if (strtoupper($user['level']) == "GL") {
                    $update = [
                        'status' => '0',
                    ];
                    $this->db->where('menu', 'scan_out');
                    $this->db->update('status_scan', $update);
                    redirect("scan/scan_out");
                    // echo "BENAR";
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong class="text-center"> USER BUKAN GL !</strong></div>');
                    redirect("scan/approve_gl_out");
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong class="text-center"> USER TIDAK TERDAFTAR !</strong></div>');
                redirect("scan/approve_gl_out");
            }
        }
    }


    function approve_gl_in()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required');

        if ($this->form_validation->run() == false) {
            $data['user'] = $this->db->get_where('mst_user', ['email' => $this->session->userdata('email')])->row_array();
            $data['title'] = "Scan In | Double Check";
            $this->load->view('scan/header', $data);
            $this->load->view('scan/approve_gl_in');
            $this->load->view('scan/footer');
        } else {
            $nik = $this->input->post('nik');

            $user = $this->db->get_where('mst_user', ['nik' => $nik])->row_array();
            if ($user) {
                if (strtoupper($user['level']) == "GL") {
                    $update = [
                        'status' => '0',
                    ];
                    $this->db->where('menu', 'scan_in');
                    $this->db->update('status_scan', $update);
                    redirect("scan/scan_in");
                    // echo "BENAR";
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong class="text-center"> USER BUKAN GL !</strong></div>');
                    redirect("scan/approve_gl_in");
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong class="text-center"> USER TIDAK TERDAFTAR !</strong></div>');
                redirect("scan/approve_gl_in");
            }
        }
    }
}
