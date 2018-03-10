<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Nieuws extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    public function index(){
        $data['gebruiker']  = $this->authex->getGebruikerInfo();
        
        $data['titel'] = "Nieuws beheren";
        
        $this->load->model('nieuws_model');
        $data['nieuwsArtikels'] = $this->nieuws_model->getAllNieuwsArtikels();
        
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Trainer/nieuws_beheren',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

public function maakNieuwsArtikel() {
    $data['titel'] = 'Nieuw artikel aanmaken';
    $data['gebruiker']  = $this->authex->getGebruikerInfo();
    
    $partials = array('hoofding' => 'main_header',
        'inhoud' => 'nieuwsArtikel_wijzig',
        'voetnoot' => 'main_footer');
    $this->template->load('main_master', $partials, $data);
    
}
}
