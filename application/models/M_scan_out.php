<?php
class M_scan_out extends CI_Model
{
    function insert_data($jai_label, $assy_code_label, $ctn_no1, $ctn_no2, $jai_qr, $assy_code_qr, $ctn_no_qr, $jai_pallet, $assy_code_pallet, $ctn_no1_pallet, $ctn_no2_pallet, $status, $username, $nik)
    {
        $query = "INSERT INTO `scan_out`( `nama`, `nik`, `jai_label`, `assy_code_label`, `ctn_no1`, `ctn_no2`, `jai_qr`, `assy_code_qr`, `ctn_no_qr`, `master_pallet`,`assy_code_pallet`,`ctn_no1_pallet`,`ctn_no2_pallet`, `status`) 
		VALUES ('$username','$nik','$jai_label','$assy_code_label','$ctn_no1','$ctn_no2','$jai_qr','$assy_code_qr','$ctn_no_qr','$jai_pallet','$assy_code_pallet','$ctn_no1_pallet','$ctn_no2_pallet','$status')";
        $this->db->query($query);
    }

    function check_jai_label($jai_label)
    {
        return $this->db->count_all_results("SELECT * FROM scan_in WHERE jai_label='$jai_label' AND status='VALID'");
    }
}
