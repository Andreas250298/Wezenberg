<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wedstrijd extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    public function getGebruiker(){
      $gebruikerEmail = $this->input->get('email');
      $gebruikerWachtwoord = $this->input->get('wachtwoord');
    }


}
