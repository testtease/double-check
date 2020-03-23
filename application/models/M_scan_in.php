<?php
class M_scan_in extends CI_Model
{
    function insert_label($jai_label, $assy_code_label, $ctn_no1, $ctn_no2, $jai_qr, $assy_code_qr, $ctn_no_qr, $status, $username, $nik)
    {
        $query = "INSERT INTO `scan_in`( `nama`, `nik`, `jai_label`, `assy_code_label`, `ctn_no1`, `ctn_no2`, `jai_qr`, `assy_code_qr`, `ctn_no_qr`, `status`) 
		VALUES ('$username','$nik','$jai_label','$assy_code_label','$ctn_no1','$ctn_no2','$jai_qr','$assy_code_qr','$ctn_no_qr','$status')";
        $this->db->query($query);

        if ($status == "TIDAK VALID") {
            $this->db->query("UPDATE status_scan SET status=1 WHERE menu='scan_in'");
        }
    }

    function check_status()
    {
        return $this->db->count_all_results("status_scan WHERE menu='scan_in' AND status='1'");
    }
}
