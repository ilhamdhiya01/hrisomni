<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tunggu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['tunggu_m', 'data_m', 'divisi_m']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['data_cuti'] = $this->tunggu_m->get();
        $this->template->load('template', 'pengajuan/tunggu_data', $data);
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
            $this->template->load('template', 'pengajuan/ajukan_form', $data);
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
            echo "<script>window.location='" . site_url('tunggu') . "';</script>";
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
            $this->template->load('template', 'pengajuan/ajukan_form_edit', $data);
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
            echo "<script>window.location='" . site_url('tunggu') . "';</script>";
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
        echo "<script>window.location='" . site_url('tunggu') . "';</script>";
    }

    public function ubah_status()
    {
        $id_cuti = $_POST['id_cuti'];
        $user_id = $_POST['user_id'];
        $status = $_POST['status'];

        $data = [
            'user_id' => $user_id,
            'cuti_id' => $id_cuti,
            'status' => $status,
            'approve_at' => date('d-m-Y')
        ];


        if ($this->input->is_ajax_request()) {
            $this->db->set('status', $status);
            $this->db->where('id', $id_cuti);
            $this->db->update('pengajuan_cuti');

            $this->db->insert('notif_staff', $data);

            $data = [
                'status' => 200,
                'message' => 'Status berhasil di ubah'
            ];

            echo json_encode($data);
        } else {
            echo json_encode("Request Failed");
        }
    }
}
