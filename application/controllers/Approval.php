<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['approval_m', 'data_m', 'divisi_m', 'tunggu_m']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['data_cuti'] = $this->tunggu_m->get();
        $this->template->load('template', 'approval/approval_data', $data);
    }

    public function add()
    {
        $this->db->select('id_divisi, divisi_d');
        $this->db->from('divisi');
        $data = [
            'divisies' => $this->db->get()->result_array(),
            'levels' => $this->db->get('level')->result_array(),
            'users' => $this->db->get('users')->result_array()
        ];


        $this->form_validation->set_rules('nama_pegawai', 'Nama pegawai', 'required');
        $this->form_validation->set_rules('divisi', 'Divisi', 'required');
        $this->form_validation->set_rules('keperluan', 'Keperluan', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Mulai', 'required');
        $this->form_validation->set_rules('tgl_sampai', 'Sampai', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->template->load('template', 'approval/approval_add', $data);
        } else {
            $data_cuti = [
                'user_id' => $this->input->post('nama_pegawai'),
                'divisi_id' => $this->input->post('divisi'),
                'keperluan' => $this->input->post('keperluan'),
                'lama' => $this->input->post('lama'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_sampai' => $this->input->post('tgl_sampai'),
                'keterangan' => $this->input->post('keterangan'),
                'status' => $this->session->userdata('level_id') == 1 ? 1 : 2
            ];

            $this->db->insert('pengajuan_cuti', $data_cuti);
            if ($this->db->affected_rows() > 0) {
                echo "<script>
                    alert('Data cuti berhasil di tambahkan');
                </script>";
            }
            echo "<script>window.location='" . site_url('approval') . "';</script>";
        }
    }

    public function edit($id)
    {
        $this->db->select('id_divisi, divisi_d');
        $this->db->from('divisi');
        $data = [
            'divisies' => $this->db->get()->result_array(),
            'levels' => $this->db->get('level')->result_array(),
            'users' => $this->db->get('users')->result_array(),
            'cuti_by_id' => $this->db->get_where('pengajuan_cuti', ['id' => $id])->row_array()
        ];

        $this->form_validation->set_rules('nama_pegawai', 'Nama pegawai', 'required');
        $this->form_validation->set_rules('divisi', 'Divisi', 'required');
        $this->form_validation->set_rules('keperluan', 'Keperluan', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Mulai', 'required');
        $this->form_validation->set_rules('tgl_sampai', 'Sampai', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() == false) {
            $this->template->load('template', 'approval/approval_edit', $data);
        } else {
            $data_cuti = [
                'user_id' => $this->input->post('nama_pegawai'),
                'divisi_id' => $this->input->post('divisi'),
                'keperluan' => $this->input->post('keperluan'),
                'lama' => $this->input->post('lama'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_sampai' => $this->input->post('tgl_sampai'),
                'keterangan' => $this->input->post('keterangan'),
                'status' => $this->input->post('status')
            ];

            $this->db->where('id', $id);
            $this->db->update('pengajuan_cuti', $data_cuti);
            if ($this->db->affected_rows() > 0) {
                echo "<script>
                    alert('Data cuti berhasil di ubah');
                </script>";
            }
            echo "<script>window.location='" . site_url('approval') . "';</script>";
        }
    }

    public function del($id)
    {
        $this->tunggu_m->del($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>
                alert('Data cuti berhasil di hapus');
            </script>";
        }
        echo "<script>window.location='" . site_url('approval') . "';</script>";
    }
}
