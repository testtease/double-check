<?php
class M_scan_out extends CI_Model
{
    function insert_data($jai_label, $assy_code_label, $ctn_no1, $ctn_no2, $jai_qr, $assy_code_qr, $ctn_no_qr, $jai_pallet, $assy_code_pallet, $ctn_no1_pallet, $ctn_no2_pallet, $status)
    {
        $query = "INSERT INTO `scan_out`( `jai_label`, `assy_code_label`, `ctn_no1`, `ctn_no2`, `jai_qr`, `assy_code_qr`, `ctn_no_qr`, `master_pallet`,`assy_code_pallet`,`ctn_no1_pallet`,`ctn_no2_pallet`, `status`) 
		VALUES ('$jai_label','$assy_code_label','$ctn_no1','$ctn_no2','$jai_qr','$assy_code_qr','$ctn_no_qr','$jai_pallet','$assy_code_pallet','$ctn_no1_pallet','$ctn_no2_pallet','$status')";
        $this->db->query($query);
    }
}
