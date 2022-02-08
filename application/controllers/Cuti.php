<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cuti extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['tunggu_m', 'data_m', 'divisi_m']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $data['data_cuti'] = $this->tunggu_m->get_cuti($id_user);
        $this->template->load('template', 'pengajuan/data_cuti_saya', $data);
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
            $this->template->load('template', 'pengajuan/tambah_cuti_saya', $data);
        } else {
            $data_cuti = [
                'user_id' => $this->input->post('nama_pegawai'),
                'divisi_id' => $this->input->post('divisi'),
                'keperluan' => $this->input->post('keperluan'),
                'lama' => $this->input->post('lama'),
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_sampai' => $this->input->post('tgl_sampai'),
                'keterangan' => $this->input->post('keterangan'),
                'status' => $this->session->userdata('level_id') == 1 ? 1 : 2,
                'created_at' => date('d-m-Y')
            ];

            $this->db->insert('pengajuan_cuti', $data_cuti);
            if ($this->db->affected_rows() > 0) {
                echo "<script>
                    alert('Data cuti berhasil di tambahkan');
                </script>";
            }
            echo "<script>window.location='" . site_url('cuti') . "';</script>";
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
            $this->template->load('template', 'pengajuan/edit_cuti_saya', $data);
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
            echo "<script>window.location='" . site_url('cuti') . "';</script>";
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
        echo "<script>window.location='" . site_url('cuti') . "';</script>";
    }

    public function edit_cuti_ajax()
    {
        $user_id = $_GET['user_id'];
        if ($this->input->is_ajax_request()) {
            $data = [
                'status' => 200,
                'cuti' => $this->db->get_where('pengajuan_cuti', ['user_id' => $user_id])->row_array()
            ];
            echo json_encode($data);
        }
    }
}
