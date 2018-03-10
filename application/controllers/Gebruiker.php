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
        
        //gebruiker_model inladen
        $this->load->model('gebruiker_model');
        $data['zwemmers'] = $this->gebruiker_model->toonZwemmers();
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'zwemmers',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function maakGebruiker() {
        $data['titel'] = "Registreer";
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        
        $partials = array('hoofding' => 'main_header',
            'menu' => 'main_header',
            'inhoud' => 'zwemmer_registreer',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function wijzig($id) {
        $this->load->model('gebruiker_model');
        $data['brouwerij'] = $this->gebruiker_model->get($id);
        $data['titel'] = 'Zwemmer wijzigen';

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'zwemmer_wijzig');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function schrap($id) {
        $this->load->model('gebruiker_model');
        $data['zwemmer'] = $this->gebruiker_model->delete($id);

        redirect('/gebruiker/toonZwemmers');
    }
    
}
