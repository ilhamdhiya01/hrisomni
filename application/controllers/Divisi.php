<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Divisi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('divisi_m');
    }

    public function index()
    {
        $data['row'] = $this->divisi_m->get();
        $this->template->load('template', 'divisi/divisi_data', $data);
    }

    public function add()
    {
        $divisi = new stdClass();
        $divisi->id_divisi = null;
        $divisi->no_divisi = null;
        $divisi->divisi_d = null;
        $data = array(
            'page' => 'add',
            'row' => $divisi
        );
        $this->template->load('template', 'divisi/divisi_form', $data);
    }

    public function edit($id)
    {
        $query = $this->divisi_m->get($id);
        if ($query->num_rows() > 0) {
            $data = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $data
            );
            $this->template->load('template', 'divisi/divisi_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('divisi') . "';</script>";
        }
    }


    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->divisi_m->add($post);
        } else if (isset($_POST['edit'])) {
            $this->divisi_m->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data berhasil disimpan');</script>";
        }
        echo "<script>window.location='" . site_url('divisi') . "';</script>";
    }

    public function del($id)
    {
        $this->divisi_m->del($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data berhasil dihapus');</script>";
        }
        echo "<script>window.location='" . site_url('divisi') . "';</script>";
    }
}
