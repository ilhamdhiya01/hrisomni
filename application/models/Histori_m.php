<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Histori_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('cuti');
        if ($id != null) {
            $this->db->where('id_cuti', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
