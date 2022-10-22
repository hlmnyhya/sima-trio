<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_profil','mprofil');
        
    }
 
    public function profil()
    {
        $this->load->view('_partial/header.php');
        $this->load->view('v_profil.php');
        			
    }

}

/* End of file Profile.php */
