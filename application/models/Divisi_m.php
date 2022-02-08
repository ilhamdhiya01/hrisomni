<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Divisi_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('divisi');
        if ($id != null) {
            $this->db->where('id_divisi', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'id_divisi' => $post['id'],
            'no_divisi' => $post['no_divisi'],
            'divisi_d' => $post['div']
        ];
        $this->db->insert('divisi', $params);
    }

    public function edit($post)
    {
        $params = [
            'id_divisi' => $post['id'],
            'no_divisi' => $post['no_divisi'],
            'divisi_d' => $post['div']
        ];
        $this->db->where('id_divisi', $post['id']);
        $this->db->update('divisi', $params);
    }

    public function del($id)
    {
        $this->db->where('id_divisi', $id);
        $this->db->delete('divisi');
    }
}
