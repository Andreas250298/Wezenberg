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
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('notation');
        $this->load->helper('form');
    }

    /**
    * Weergeven van Startpagina
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

    public function getGebruiker()
    {
        $gebruikerEmail = $this->input->get('email');
        $gebruikerWachtwoord = $this->input->get('wachtwoord');
        $gebruikerGeboortedatum = $this->input->get('geboortedatum');
    }

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

    public function maakGebruiker()
    {
        $data['titel'] = "Registreer";
        $data['paginaVerantwoordelijke'] = '';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'zwemmers_form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function wijzig($id)
    {
        /**
        * Wijzigen van de gebruiker via het gewenste id.
        * \param id De id van de gebruiker die zal moeten worden aangepast.
        */
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

    public function maakInactief($id)
    {
      /**
      * Inactief maken van de gebruiker via de gewenste id.
      * \param id De id van de gebruiker die inactief gemaakt dient te worden.
      */
        $this->load->model('gebruiker_model');
        $huidigeZwemmer = $this->gebruiker_model->get($id);
        $huidigeZwemmer->status = 0;
        $this->gebruiker_model->update($huidigeZwemmer);
        redirect('gebruiker/toonZwemmers');
    }

    public function maakActief($id)
    {
        /**
        * Actief maken van de gebruiker via de gewenste id.
        * \param id De id van de gebruiker die terug actief gemaakt dient te worden.
        */
        $this->load->model('gebruiker_model');
        $huidigeZwemmer = $this->gebruiker_model->get($id);

        $huidigeZwemmer->status = 1;
        $this->gebruiker_model->update($huidigeZwemmer);
        redirect('gebruiker/toonZwemmers');
    }

    public function toonInactieveZwemmers()
    {
        /**
        * Lijst van inactieve zwemmers tonen.
        */
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
