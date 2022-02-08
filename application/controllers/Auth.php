<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function login()
    {
        // check_already_login();
        $this->load->view('login');
    }

    // public function process()
    // {
    //     $post = $this->input->post(null, TRUE);
    //     if (isset($post['login'])) {
    //         $this->load->model('user_m');
    //         $query = $this->user_m->login($post);
    //         if ($query->num_rows() > 0) {
    //             $row = $query->row();
    //             $params = array(
    //                 'id_user' => $row->id_user,
    //                 'level' => $row->level
    //             );
    //             $this->session->set_userdata($params);
    //             echo "<script>
    //             alert ('Selamat, login berhasil');
    //             window.location='" . site_url('dashboard') . "'; 
    //             </script>";
    //         } else {
    //             echo "<script>
    //             alert ('Login gagal, username / password salah');
    //             window.location='" . site_url('auth/login') . "'; 
    //             </script>";
    //         }
    //     }
    // }

    public function process()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');

        if ($this->form_validation->run() == false) {
            $this->load->view('login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $users = $this->db->get_where('users', ['username' => $username])->row_array();

            if (is_null($users)) {
                echo "<script>
                        alert ('Username belum terdaftar !');
                        window.location='" . site_url('auth/login') . "'; 
                    </script>";
            } else {
                if (password_verify($password, $users['password'])) {
                    $data = [
                        'id_user' => $users['id'],
                        'username' => $users['username'],
                        'level_id' => $users['level_id']
                    ];
                    $this->session->set_userdata($data);
                    echo "<script>
                            alert ('Login success');
                            window.location='" . site_url('dashboard') . "'; 
                        </script>";
                } else {
                    echo "<script>
                    alert ('Password salah !');
                    window.location='" . site_url('auth/login') . "'; 
                    </script>";
                }
            }
        }
    }
    public function logout()
    {
        $params = array('username', 'level_id', 'id_user');
        $this->session->unset_userdata($params);
        redirect('auth/login');
    }
}
