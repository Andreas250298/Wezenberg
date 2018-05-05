<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @class Activiteit
 * @brief Controller-klasse voor Activiteit
 *
 * Controller-klasse met methoden die worden gebruikt bij het tonen en beren van activiteiten.
 */
class Activiteit extends CI_Controller {
  /**
   * Constructor
   */
  public function __construct() {
      parent::__construct();
      $this->load->helper('form');
  }

  /**
   * Haalt alle activiteiten op via activiteitPerGebruiker_model en toont deze in de view bekijken.php
   *\see Authex::getGebruikerInfo()
   *\see activiteitPerGebruiker_model::getInformatieActiviteiten()
   *\see bekijken.php
   * @param week De week om te tonen in de agenda
   * @param jaar Het jaar om te tonen in de agenda
   */
  public function index($week, $jaar)
  {
    $data['titel'] = 'Activiteiten';
    $data['paginaVerantwoordelijke'] = 'Bols Jordi';
    $gebruiker = $this->authex->getGebruikerInfo();
    $data['gebruiker'] = $gebruiker;

    $data['week'] = $week;
    $data['jaar'] = $jaar;

    $this->load->model('activiteitPerGebruiker_model');
    $data['activiteiten'] = $this->activiteitPerGebruiker_model->getInformatieActiviteiten($gebruiker->id, $week, $jaar);

    $partials = array('hoofding' => 'main_header',
        'inhoud' => 'Activiteit/bekijken',
        'voetnoot' => 'main_footer');
    $this->template->load('main_master', $partials, $data);
  }

  public function maken()
  {
    $data['titel'] = 'Activiteit aanmaken';
    $data['paginaVerantwoordelijke'] = 'Bols Jordi';
    $gebruiker = $this->authex->getGebruikerInfo();
    $data['gebruiker'] = $gebruiker;

    $partials = array('hoofding' => 'main_header',
        'inhoud' => 'Activiteit/maken',
        'voetnoot' => 'main_footer');
    $this->template->load('main_master', $partials, $data);
  }

  public function aanpassen($id)
  {
    $data['titel'] = 'Activiteit aanpassen';
    $data['paginaVerantwoordelijke'] = 'Bols Jordi';
    $gebruiker = $this->authex->getGebruikerInfo();
    $data['gebruiker'] = $gebruiker;

    $this->model->load('andereActiviteit_model');
    $data['activiteit'] = $this->andereActiviteit_model->get($id);

    $this->model->load('gebruiker_model');
    $data['zwemmers'] = $this->gebruiker_model->getAllZwemmers();

    $partials = array('hoofding' => 'main_header',
        'inhoud' => 'Activiteit/aanpassen',
        'voetnoot' => 'main_footer');
    $this->template->load('main_master', $partials, $data);
  }

  public function verwijderen($id)
  {
    $data['titel'] = 'Activiteit verwijderen';
    $data['paginaVerantwoordelijke'] = 'Bols Jordi';
    $gebruiker = $this->authex->getGebruikerInfo();
    $data['gebruiker'] = $gebruiker;

    $this->db->load('andereActiviteit_model');
    $data['activiteit'] = $this->andereActiviteit_model->get($id);

    $partials = array('hoofding' => 'main_header',
        'inhoud' => 'Activiteit/verwijderen',
        'voetnoot' => 'main_footer');
    $this->template->load('main_master', $partials, $data);
  }
}
