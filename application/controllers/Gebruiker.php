<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gebruiker extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    public function getGebruiker(){
      $gebruikerEmail = $this->input->get('email');
      $gebruikerWachtwoord = $this->input->get('wachtwoord');
    }
    
    public function toonZwemmers() {
        $data['titel'] = 'Zwemmers';
        $data['gebruiker']  = $this->authex->getGebruikerInfo();
        /**
         * gebruiker_model inladen
         */
        $this->load->model('gebruiker_model');
        $data['zwemmers'] = $this->gebruiker_model->toonZwemmers();
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'zwemmers',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

}
