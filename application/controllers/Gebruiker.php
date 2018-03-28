<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
* @class Gebruiker
* @brief Controller-klasse voor Gebruiker
*
* Controller-klasse met methoden die worden gebruikt door de Gebruiker
*/
class Gebruiker extends CI_Controller
{
    /**
    * Constructor
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('notation');
        $this->load->helper('form');
    }

    /**
    * Weergeven van Startpagina
    * Functie te vinden in \dotinclude Gebruiker.php
    *\see Authex::getGebruikerInfo()
    *\see Nieuws_model::getAllNieuwsArtikels()
    *\see Wedstrijd_model::toonWedstrijden()
    *\see startpagina.php
    */
    public function index()
    {
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

    /**
    * Opvragen van input in verband met de gebruiker
    */
    public function getGebruiker()
    {
        $gebruikerEmail = $this->input->get('email');
        $gebruikerWachtwoord = $this->input->get('wachtwoord');
        $gebruikerGeboortedatum = $this->input->get('geboortedatum');
    }

    /**
    * Weergeven van zwemmers op zwemmers.php
    *\see Authex::getGebruikerInfo()
    *\see Gebruiker_model::toonZwemmers()
    *\see zwemmers.php
    */
    public function toonZwemmers()
    {
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

    /**
    * Aanmaken van gebruiker via input uit zwemmers_form.php
    *\see Authex::getGebruikerInfo()
    *\see Gebruiker_model::voegToe()
    *\see zwemmers_form.php
    */
    public function maakGebruiker()
    {
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
        if ($gebruiker->id == null) {
            $this->gebruiker_model->voegToe($gebruiker->$email, $gebruiker->$wachtwoord, $gebruiker->$naam, $gebruiker->$adres, $gebruiker->$woonplaats, $gebruiker->$soort, $gebruiker->$geboortedatum);
        } else {
            $this->gebruiker_model->update($gebruiker->$email, $gebruiker->$wachtwoord, $gebruiker->$naam, $gebruiker->$adres, $gebruiker->$woonplaats, $gebruiker->$soort, $gebruiker->$geboortedatum);
        }
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'zwemmers_form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
    * Wijzigen van de gebruiker volgens id
    * \param id De id van de gebruiker die zal moeten worden aangepast
    */
    public function wijzig($id)
    {
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

    /**
    * Zwemmer of inactief zetten volgens id
    *\see Gebruiker_model::get()
    *\see Gebruiker_model::update()
    *\see Gebruiker::toonZwemmers()
    */
    public function maakInactief($id)
    {
        $this->load->model('gebruiker_model');
        $huidigeZwemmer = $this->gebruiker_model->get($id);
        $huidigeZwemmer->status = 0;
        $this->gebruiker_model->update($huidigeZwemmer);
        redirect('gebruiker/toonZwemmers');
    }

    /**
    * Zwemmer of actief zetten volgens id
    *\see Gebruiker_model::get()
    *\see Gebruiker_model::update
    *\see Gebruiker::toonZwemmers()
    */
    public function maakActief($id)
    {
        $this->load->model('gebruiker_model');
        $huidigeZwemmer = $this->gebruiker_model->get($id);

        $huidigeZwemmer->status = 1;
        $this->gebruiker_model->update($huidigeZwemmer);
        redirect('gebruiker/toonZwemmers');
    }

    /**
    * Inactieve zwemmers tonen
    *\see Authex::getGebruikerInfo()
    *\see Gebruiker_model::toonInactieveZwemmers()
    *\see inactieveZwemmers.php
    */
    public function toonInactieveZwemmers()
    {
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

    /**
    * Info tonen van zwemmer volgens id
    *\see Gebruiker_model::getGebruikerInfo()
    *\see Authex::getGebruikerInfo()
    *\see zwemmer_info.php
    */
    public function toonZwemmerInfo($id)
    {
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

    /**
    * Wedstrijden tonen
    *\see Authex::getGebruikerInfo()
    *\see Wedstrijd_model::toonWedstrijden()
    *\see wedstrijd/bekijken.php
    */
    public function toonWedstrijden()
    {
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
