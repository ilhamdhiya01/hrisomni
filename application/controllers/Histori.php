<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Histori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // check_not_login();
        $this->load->model('histori_m');
    }

    public function index()
    {
        $data['row'] = $this->histori_m->get();
        $this->template->load('template', 'histori/histori_data', $data);
    }
}
