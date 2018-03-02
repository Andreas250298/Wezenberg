<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    public function index() {
        $data['titel'] = 'Wezenberg | startpagina';
            
            $partials = array('hoofding' => 'main_header', 
                'inhoud' => 'startpagina', 
                'voetnoot' => 'main_footer');
            
            $this->template->load('main_master', $partials, $data);
    }

}
