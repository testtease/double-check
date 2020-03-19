<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trial extends CI_Controller
{
    public function index()
    {
        $ctn_label = 1;
        for ($i = 0; $i < 10; $i++) {
            echo $ctn_label . "<br>";
            if ($ctn_label == 5) {
                $status = "valid";
                $i = 1000;
            } else {
                $status = "TIDAK VALID";
            }
            $ctn_label++;
        }

        echo $status;
    }
}
