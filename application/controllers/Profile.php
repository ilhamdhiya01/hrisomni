<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        check_not_login();
    }

    public function index()
    {
        $this->template->load('template', 'profile/index');
    }

    public function load_profile()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('ajax/ajax-profile'));
        }
    }

    public function load_form_password()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('ajax/ajax-form-edit-password'));
        }
    }

    public function load_form_username()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('ajax/ajax-form-edit-username'));
        }
    }

    public function load_upload_foto()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->load->view('ajax/ajax-upload-foto'));
        }
    }

    public function ajax_edit_password_validation()
    {
        $username = $_POST['username'];
        $password_sekarang = $_POST['password_sekarang'];
        $password_baru = $_POST['password_baru'];

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password_sekarang', 'Password sekarang', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('password_baru', 'Password baru', 'required|trim|min_length[5]');

        if ($this->form_validation->run() == false) {
            $msg = [
                "error" => [
                    "username" => form_error("username"),
                    "password_sekarang" => form_error("password_sekarang"),
                    "password_baru" => form_error("password_baru")
                ]
            ];
        } else {
            $data_user = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
            $msg = [
                "cek_username" => $this->session->userdata('username'),
                "cek_password" => password_verify($password_sekarang, $data_user['password']),
                "cek_password_baru" => $password_baru
            ];
        }
        echo json_encode($msg);
    }

    public function proses_ubah_password()
    {
        if ($this->input->is_ajax_request()) {
            $username = $_POST['username'];
            $password_sekarang = $_POST['password_sekarang'];
            $password_baru = $_POST['password_baru'];

            $this->db->set('password', password_hash($password_baru, PASSWORD_DEFAULT));
            $this->db->where('username', $username);
            $this->db->update('users');

            $msg = [
                'status' => 200,
                'message' => 'Password berhasil di ubah'
            ];

            echo json_encode($msg);
        }
    }

    public function ajax_edit_username_validation()
    {
        $password = $_POST['password'];
        $username_sekarang = $_POST['username_sekarang'];
        $username_baru = $_POST['username_baru'];

        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');
        $this->form_validation->set_rules('username_sekarang', 'Username sekarang', 'required|trim');
        $this->form_validation->set_rules('username_baru', 'Username baru', 'required|trim');

        if ($this->form_validation->run() == false) {
            $msg = [
                "error" => [
                    "password" => form_error("password"),
                    "username_sekarang" => form_error("username_sekarang"),
                    "username_baru" => form_error("username_baru")
                ]
            ];
        } else {
            $data_user = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();
            $msg = [
                "cek_password" => password_verify($password, $data_user['password']),
                "cek_username_sekarang" => $this->session->userdata('username'),
                "cek_username_baru" => $username_baru
            ];
        }
        echo json_encode($msg);
    }

    public function proses_ubah_username()
    {
        if ($this->input->is_ajax_request()) {
            $username_baru = $_POST['username_baru'];

            $this->db->set('username', $username_baru);
            $this->db->where('username', $this->session->userdata('username'));
            $this->db->update('users');

            $msg = [
                'status' => 200,
                'message' => 'Username berhasil di ubah'
            ];

            echo json_encode($msg);
        }
    }

    public function edit_img_profile($id)
    {
        $config = [
            'upload_path' => './uploads',
            'allowed_types' => 'gif|jpg|png|jpeg'
        ];

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar')) {
            echo "<script>window.location='" . site_url('profile') . "';</script>";
            // echo $this->upload->display_errors();
        } else {
            $new_img = $this->upload->data('file_name');
            $this->db->set('gambar', $new_img);
            $this->db->where('id', $id);
            $this->db->update('users');

            if ($this->db->affected_rows() > 0) {
                echo "<script>
                        alert('Data user berhasil ubah');
                    </script>";
            }
            echo "<script>window.location='" . site_url('profile') . "';</script>";
        }
    }
}
