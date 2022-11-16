<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Laporan extends CI_Controller {

        public function pdf()
        {
            $this->load->library('pdfgenerator');

            $data=[
                
            ];

            $html = $this->load->view('table_report', $data,true);

            $this->pdfgenerator->generate($html,'contoh');
        }
    }

    
    /* End of file Laporan.php */
