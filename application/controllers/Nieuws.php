<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Nieuws extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form', 'date');
    }

    public function index() {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $data['titel'] = "Nieuws beheren";

        $this->load->model('nieuws_model');
        $data['nieuwsArtikels'] = $this->nieuws_model->getAllNieuwsArtikels();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Nieuws/beheren',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function maakNieuwsArtikel() {
        $data['titel'] = 'Nieuwsartikel aanmaken';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $data['nieuwsArtikel'] = null;
        
        
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Nieuws/form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function registreer() {
        $artikel = new stdClass();
        $artikel->id = $this->input->post('id');
        $artikel->titel = $this->input->post('titel');
        $artikel->beschrijving = $this->input->post('beschrijving');
        $datestring = date("Y-m-d");
        $artikel->datumAangemaakt = $datestring;
        
        $this->load->model('nieuws_model');
        if($artikel->id == null) {
            $this->nieuws_model->insert($artikel);
        }
        else {
            $this->nieuws_model->update($artikel);
        }
        
        redirect('/nieuws/index');
    }
    
    public function wijzig($id) {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $this->load->model('nieuws_model');
        $data['nieuwsArtikel'] = $this->nieuws_model->get($id);
        $data['titel'] = 'Nieuwsartikel wijzigen';

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Nieuws/form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
}
