<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_m extends CI_Model
{

    public function get()
    {
        $this->db->select('users.nama_pegawai, data_karyawan.*');
        $this->db->join('users', 'data_karyawan.user_id = users.id');
        $query = $this->db->get('data_karyawan')->result_array();
        return $query;
    }

    // public function edit($id)
    // {
    //     $params = [
    //         'user_id' => $this->input->post('user_id'),
    //         'tgl_masuk' => $this->input->post('tgl_masuk'),
    //         'tgl_lahir' => $this->input->post('tgl_lahir'),
    //         'tempat_lahir' => $this->input->post('kota'),
    //         'jenis_kelamin' => $this->input->post('jenis_kelamin'),
    //         'alamat' => $this->input->post('alamat'),
    //         'nohp' => $this->input->post('nohp'),
    //         'email' => $this->input->post('email'),
    //     ];
    //     $this->db->where('id_nama', $id);
    //     $this->db->update('data_k', $params);
    // }

    public function del($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('data_karyawan');
    }
}
