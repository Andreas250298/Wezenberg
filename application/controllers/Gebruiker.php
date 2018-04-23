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
        $this->load->helper('form');
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
        $data['paginaVerantwoordelijke'] = 'Bols Jordi';
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
        $data['titel'] = "Gebruiker aanmaken";
        $data['paginaVerantwoordelijke'] = '';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $this->load->model("gebruiker_model");

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'zwemmers_form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
    * registreer functie voor het aanmaken of update van een gebruiker_id
    *\see Gebruiker_model::insert()
    *\see Gebruiker_model::update()
    *\see zwemmers_form.php
    */
    public function registreer()
    {
        $gebruiker = new stdClass();
        $gebruiker->id = $this->input->post('id');
        $gebruiker->naam = $this->input->post('naam');
        $gebruiker->adres = $this->input->post('adres');
        $gebruiker->woonplaats = $this->input->post('woonplaats');
        $gebruiker->email = $this->input->post('email');
        $gebruiker->geboortedatum = $this->input->post('geboortedatum');
        $gebruiker->beschrijving = $this->input->post('beschrijving');

        $this->load->model('gebruiker_model');
        if ($gebruiker->id == null) {
            $gebruiker->status = 1;
            $gebruiker->soort = "zwemmer";
            $this->gebruiker_model->insert($gebruiker);
        } else {
            $this->gebruiker_model->update($gebruiker);
        }

        redirect('/gebruiker/toonZwemmers');
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

    public function verwijder($id)
    {
        $this->load->model('gebruiker_model');
        $this->gebruiker_model->delete($id);

        redirect('/gebruiker/toonZwemmers');
    }

    /**
    * Zwemmer of inactief zetten volgens id
    * \param id De id van de gebruiker die inactief gemaakt dient te worden.
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

    /**
    * Inactieve zwemmers tonen
    *\see Authex::getGebruikerInfo()
    *\see Gebruiker_model::toonInactieveZwemmers()
    *\see inactieveZwemmers.php
    */
    public function toonInactieveZwemmers()
    {
        $data['titel'] = 'Zwemmers';
        $data['paginaVerantwoordelijke'] = 'Bols Jordi';
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
        $data['paginaVerantwoordelijke'] = 'Bols Jordi';

        $this->load->model('gebruiker_model');
        $huidigeZwemmer = $this->gebruiker_model->get($id);

        $data['titel'] = $huidigeZwemmer->naam;
        $data['gebruiker']  = $this->authex->getGebruikerInfo();
        $data['zwemmer'] = $huidigeZwemmer;

        $this->load->model('wedstrijd_model');
        $data['wedstrijden'] = $this->wedstrijd_model->getWedstrijdenZwemmer($id);

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

    /**
    * Account info tonen aan de hand van de id
    * \param id De id van de gebruiker waarvan de info getoond dient te worden.
    *\see Authex::getGebruikerInfo()
    *\see gebruiker_info.php
    */
    public function account($id) {
      $data['titel'] = 'Account';
      $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
      $data['gebruiker']  = $this->authex->getGebruikerInfo();
      $this->load->model('gebruiker_model');
      $huidigeGebruiker = $this->gebruiker_model->get($id);
      $data['gebruikerInfo'] = $huidigeGebruiker;

      $partials = array('hoofding' => 'main_header',
          'inhoud' => 'gebruiker_info',
          'voetnoot' => 'main_footer');
      $this->template->load('main_master', $partials, $data);
    }

    /** Persoonlijke agenda tonen
    *\see Authex::getGebruikerInfo()
    *\see Wedstrijd_model::getWedstrijdenInWeek()
    *\see zwemmer_agenda.php
    * @param week Te tonen $week
    * @param jaar Jaar van te tonen week
    */
    public function agenda($week, $jaar)
    {
      $data['titel'] = 'Mijn Agenda';
      $data['paginaVerantwoordelijke'] = 'Bols Jordi';
      $gebruiker  = $this->authex->getGebruikerInfo();
      $data['gebruiker'] = $gebruiker;

      $data['week'] = $week;
      $data['jaar'] = $jaar;

      $this->load->model('deelname_model');
      $data['wedstrijden'] = $this->deelname_model->getDeelnamesInWeek($gebruiker->id, $week, $jaar);

      $partials = array('hoofding' => 'main_header',
          'inhoud' => 'zwemmer_agenda',
          'voetnoot' => 'main_footer');
      $this->template->load('main_master', $partials, $data);
    }

    /** Wedstrijden om te tonen in agenda ophalen
    *\see Authex::getGebruikerInfo()
    *\see Wedstrijd_model::getWedstrijdenInWeek()
    */
    public function haalJsonOp_Wedstrijden()
    {
      $gebruiker = $this->authex->getGebruikerInfo();
      $week = $this->input->get('huidigeWeek');
      $jaar = $this->input->get('huidigJaar');

      $this->load->model('deelname_model');
      $deelnames = $this->deelname_model->getDeelnamesInWeek($gebruiker->id, $week, $jaar);

      $i = 0;

      if (isset($deelnames->dezeWeek))
      {
          foreach ($deelnames as $deelname)
          {
              if ($deelname->reeks->isDezeWeek == 1)
              {
                  $deelname->id = $i;
                  $i++;
              }
          }
      }
          echo json_encode($deelnames);
      }

    /** Supplementen om te tonen in agenda ophalen
    *\see Authex::getGebruikerInfo()
    *\see Supplement_model::getSupplementenInWeek()
    */
    public function haalJsonOp_Supplementen()
    {
        $gebruiker = $this->authex->getGebruikerInfo();
        $week = $this->input->get('huidigeWeek');
        $jaar = $this->input->get('huidigJaar');

        $this->load->model('supplement_model');
        $supplementweek = $this->suplement_model->getSupplementenInWeek($gebuiker->id, $week, $jaar);

        echo json_encode($supplementweek);
    }
}
