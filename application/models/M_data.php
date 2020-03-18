<?php
class M_data extends CI_Model
{
    function get_data_scan_in()
    {
        $query = $this->db->query("SELECT * FROM scan_in order by id desc");
        return $query->result();
    }

    function get_data_scan_out()
    {
        $query = $this->db->query("SELECT * FROM scan_out order by id desc");
        return $query->result();
    }
}
