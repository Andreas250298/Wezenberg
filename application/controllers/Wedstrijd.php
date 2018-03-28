<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @class Wedstrijd
 * @brief Controller-klasse voor wedstrijden
 *
 * Controller-klasse met methoden die worden gebruikt bij het tonen en beren van wedstrijden.
 */
class Wedstrijd extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    /**
     * Haalt alle wedstrijden op via Wedstrijd_model en toont deze in de view bekijken.php
     *\see Authex::getGebruikerInfo()
     *\see Wedstrijd_model::toonWedstrijden()
     *\see bekijken.php
     */
    public function index(){
      $data['titel'] = 'Wedstrijden bekijken';
      $data['paginaVerantwoordelijke'] = '';
      $data['gebruiker']  = $this->authex->getGebruikerInfo();
      $this->load->model('wedstrijd_model');
      $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijden();

      $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Wedstrijd/bekijken',
          'voetnoot' => 'main_footer');
      $this->template->load('main_master', $partials, $data);
    }

    /**
     * Toont het scherm om een nieuwe wedstrijd te maken
     *\see maken.php
     */
    public function maakWedstrijd(){
      $data['titel'] = 'Wedstrijden aanmaken';
      $data['paginaVerantwoordelijke'] = '';

      $this->load->model('wedstrijd_model');

      $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Wedstrijd/maken',
          'voetnoot' => 'main_footer');
      $this->template->load('main_master', $partials, $data);
    }

    /**
     * Maakt een nieuwe entry aan in de wedstrijd-database met de opgegeven info uit maken.php
     *\see Wedstrijd_model::insert()
     *\see Wedstrijd_model::update()
     */
    public function registreer() {
        $wedstrijd = new stdClass();
        $wedstrijd->id = $this->input->post('id');
        $wedstrijd->plaats = $this->input->post('plaats');
        $wedstrijd->naam = $this->input->post('naam');
        $wedstrijd->beginDatum = $this->input->post('beginDatum');
        $wedstrijd->eindDatum = $this->input->post('eindDatum');
        $wedstrijd->laatsteInschrijvingDatum = $this->input->post('laatsteInschrijvingDatum');
        $wedstrijd->beschrijving = $this->input->post('beschrijving');

        $this->load->model('wedstrijd_model');
        if($wedstrijd->id == null) {
            $this->wedstrijd_model->insert($wedstrijd);
        }
        else {
            $this->wedstrijd_model->update($wedstrijd);
        }

        redirect('/wedstrijd/index');
    }

    /**
     * Toont de pagina voor de wedstrijd-informatie aan te passen
     *\param id De id van de aan te passen wedstrijd
     *\see Wedstrijd_model::get()
     *\see beheren.php
     */
    public function updateWedstrijd($id){
      $data['titel'] = 'Wedstrijden wijzigen';
      $data['paginaVerantwoordelijke'] = '';
      $this->load->model('wedstrijd_model');
      $data['wedstrijd'] = $this->wedstrijd_model->get($id);

      $this->load->model('wedstrijd_model');
      $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Wedstrijd/beheren',
          'voetnoot' => 'main_footer');
      $this->template->load('main_master', $partials, $data);
    }

    /**
     * Toont de pagina voor de wedstrijden te beheren
     *\see Authex::getGebruikerInfo()
     *\see Wedstrijd_model::toonWedstrijden()
     *\see beheren.php
     */
    public function beheerWedstrijden() {
        $data['titel'] = 'Wedstrijden bekijken';
        $data['paginaVerantwoordelijke'] = '';
        $data['gebruiker']  = $this->authex->getGebruikerInfo();

      $this->load->model('wedstrijd_model');
      $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijden();

      $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Wedstrijd/beheren',
          'voetnoot' => 'main_footer');
      $this->template->load('main_master', $partials, $data);
    }

}
