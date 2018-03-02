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

    public function meldAan()
{
    $data['titel'] = 'Aanmelden';
    $data['gebruiker']  = $this->authex->getGebruikerInfo();

    $partials = array('hoofding' => 'main_header',
        'menu' => 'main_menu',
        'inhoud' => 'startpagina',
        'voetnoot' => 'main_footer');

    $this->template->load('main_master', $partials, $data);
}

}
