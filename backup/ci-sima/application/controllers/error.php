<?php

defined('BASEPATH') or exit('No direct script access allowed');

class error extends CI_Controller
{

    public function err403()
    {
        $this->load->view('error');
    }
    public function err404()
    {
        $this->load->view('error404');
    }
}

/* End of file error.php */
