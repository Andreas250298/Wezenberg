<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gebruiker extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('notation');
        $this->load->helper('form');
    }

    public function index() {
        $data['titel'] = 'Startpagina';
        $data['paginaVerantwoordelijke'] = '';
        $data['gebruiker']  = $this->authex->getGebruikerInfo();

        $this->load->model('nieuws_model');
        $data['nieuwsArtikels'] = $this->nieuws_model->getAllNieuwsArtikels();
        $this->load->model('wedstrijd_model');
      $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijden();

        $this->load->model('gebruiker_model');

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'startpagina',
                'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }

    public function getGebruiker(){
      $gebruikerEmail = $this->input->get('email');
      $gebruikerWachtwoord = $this->input->get('wachtwoord');
      $gebruikerGeboortedatum = $this->input->get('geboortedatum');
    }

    public function toonZwemmers() {
        $data['titel'] = 'Zwemmers';
        $data['paginaVerantwoordelijke'] = '';
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
        $data['paginaVerantwoordelijke'] = '';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $gebruiker = new stdClass();
        $gebruiker->id = $this->input->get('id');
        $gebruiker->naam = $this->input->get('naam');
        $gebruiker->adres = $this->input->get('adres');
        $gebruiker->woonplaats = $this->input->get('woonplaats');
        $gebruiker->soort = $this->input->get('soort');
        $gebruiker->email = $this->input->get('email');
        $gebruiker->geboortedatum = $this->input->get('geboortedatum');
        $gebruiker->wachtwoord = $this->input->get('wachtwoord');

        $this->load->model('gebruiker_model');
        if($gebruiker->id == null) {
            $this->gebruiker_model->voegToe($gebruiker->$email, $gebruiker->$wachtwoord, $gebruiker->$naam, $gebruiker->$adres, $gebruiker->$woonplaats, $gebruiker->$soort, $gebruiker->$geboortedatum);
        }
        else {
            $this->gebruiker_model->update($gebruiker->$email, $gebruiker->$wachtwoord, $gebruiker->$naam, $gebruiker->$adres, $gebruiker->$woonplaats, $gebruiker->$soort, $gebruiker->$geboortedatum);
        }

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'zwemmers_form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function wijzig($id) {
        $data['paginaVerantwoordelijke'] = '';

        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $this->load->model('gebruiker_model');
        $data['zwemmer'] = $this->gebruiker_model->get($id);
        $data['titel'] = 'Zwemmer wijzigen';

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'zwemmers_form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function maakInactief($id) {
        $this->load->model('gebruiker_model');
        $huidigeZwemmer = $this->gebruiker_model->get($id);
        $huidigeZwemmer->status = 0;
        $this->gebruiker_model->update($huidigeZwemmer);
        redirect('gebruiker/toonZwemmers');
    }

    public function maakActief($id) {
        $this->load->model('gebruiker_model');
        $huidigeZwemmer = $this->gebruiker_model->get($id);

        $huidigeZwemmer->status = 1;
        $this->gebruiker_model->update($huidigeZwemmer);
        redirect('gebruiker/toonZwemmers');
    }

    public function toonInactieveZwemmers() {
        $data['titel'] = 'Zwemmers';
        $data['paginaVerantwoordelijke'] = '';
        $data['gebruiker']  = $this->authex->getGebruikerInfo();

        //gebruiker_model inladen
        $this->load->model('gebruiker_model');
        $data['zwemmers'] = $this->gebruiker_model->toonInactieveZwemmers();
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'inactieveZwemmers',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function toonZwemmerInfo($id) {
        $data['paginaVerantwoordelijke'] = '';

        $this->load->model('gebruiker_model');
        $huidigeZwemmer = $this->gebruiker_model->get($id);

        $data['titel'] = $huidigeZwemmer->naam;
        $data['gebruiker']  = $this->authex->getGebruikerInfo();
        $data['zwemmer'] = $huidigeZwemmer;

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'zwemmer_info',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function toonWedstrijden() {
        $data['titel'] = 'Wedstrijden';
        $data['paginaVerantwoordelijke'] = '';

        $data['gebruiker']  = $this->authex->getGebruikerInfo();
        $this->load->model('wedstrijd_model');
        $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijden();
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'wedstrijd/bekijken',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

}
