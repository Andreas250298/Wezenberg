<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @class Deelname
 * @brief Controller-klasse voor Deelname
 *
 * Controller-klasse met methoden die worden gebruikt bij het tonen en beren van deelnames.
 */
class Deelname extends CI_Controller {
  /**
   * Constructor
   */
  public function __construct() {
      parent::__construct();
      $this->load->helper('form');
  }

  /**
   * Haalt alle wedstrijden op via Wedstrijd_model en toont deze in de view bekijken.php
   * @see Authex::getGebruikerInfo()
   * @see Wedstrijd_model::toonWedstrijdenASC()
   * @see bekijken.php
   */
  public function index(){
    $data['titel'] = 'Deelnames';
    $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
    $data['gebruiker']  = $this->authex->getGebruikerInfo();
    $this->load->model('wedstrijd_model');
    $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijdenASC();

    $partials = array('hoofding' => 'main_header',
        'inhoud' => 'Wedstrijd/bekijken',
        'voetnoot' => 'main_footer');
    $this->template->load('main_master', $partials, $data);
  }
}
