<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {
    
    
    public function __construct()
    {
        parent::__construct();
        $this->rolemenu->init();
        $this->load->library('Pdf');
    }
    
    public function index()
    {
        $this->pdf->load_view('item/cetak');
    }

}

/* End of file Cetak.php */
