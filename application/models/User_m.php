<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    // public function login($post)
    // {
    //     $this->db->select('*');
    //     $this->db->from('user');
    //     $this->db->where('username', $post['username']);
    //     $this->db->where('password', sha1($post['password']));
    //     $query = $this->db->get();
    //     return $query;
    // }

    public function get($username = null)
    {
        $this->db->select('divisi.divisi_d, level.level, users.*');
        $this->db->from('users');
        $this->db->join('divisi','users.divisi_id = divisi.id_divisi');
        $this->db->join('level','users.level_id = level.id');
        if ($username != null) {
            $this->db->where('username', $username);
        }
        $query = $this->db->get();
        return $query;
    }

    // public function add($post)
    // {
    //     $params['no_user'] = $post['no_user'];
    //     $params['username'] = $post['username'];
    //     $params['password'] = sha1($post['password']);
    //     $params['id_nama'] = $post['id_nama'];
    //     $params['id_divisi'] = $post['id_divisi'];
    //     $params['level'] = $post['level'];
    //     $this->db->insert('user', $params);
    // }

    // public function edit($post)
    // {
    //     $params['no_user'] = $post['no_user'];
    //     $params['username'] = $post['username'];
    //     if (!empty($post['password'])) {
    //         $params['password'] = sha1($post['password']);
    //     }
    //     $params['id_nama'] = $post['id_nama'];
    //     $params['id_divisi'] = $post['id_divisi'];
    //     $params['level'] = $post['level'];
    //     $this->db->where('id_user', $post['id_user']);
    //     $this->db->update('user', $params);
    // }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }
}
