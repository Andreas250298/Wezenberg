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

  public function aanmaken()
  {
    $data['titel'] = 'Activiteit aanmaken';
    $data['paginaVerantwoordelijke'] = 'Bols Jordi';
    $gebruiker = $this->authex->getGebruikerInfo();
    $data['gebruiker'] = $gebruiker;

    $this->load->model('gebruiker_model');
    $data['zwemmers'] = $this->gebruiker_model->getAllZwemmers();

    $partials = array('hoofding' => 'main_header',
        'inhoud' => 'Activiteit/form',
        'voetnoot' => 'main_footer');
    $this->template->load('main_master', $partials, $data);
  }

  public function aanpassen($id)
  {
    $data['titel'] = 'Activiteit aanpassen';
    $data['paginaVerantwoordelijke'] = 'Bols Jordi';
    $gebruiker = $this->authex->getGebruikerInfo();
    $data['gebruiker'] = $gebruiker;

    $this->load->model('andereActiviteit_model');
    $data['activiteit'] = $this->andereActiviteit_model->getActiviteitMetSoort($id);

    $this->load->model('gebruiker_model');
    $data['zwemmers'] = $this->gebruiker_model->getAllZwemmers();

    $this->load->model('activiteitPerGebruiker_model');
    $data['zwemmersBijActiviteit'] = $this->activiteitPerGebruiker_model->getZwemmersBijActiviteit($id);

    $partials = array('hoofding' => 'main_header',
        'inhoud' => 'Activiteit/form',
        'voetnoot' => 'main_footer');
    $this->template->load('main_master', $partials, $data);
  }

  public function verwijder()
  {
    $id = $this->input->get('id');
    $data['paginaVerantwoordelijke'] = 'Bols Jordi';
    $data['gebruiker'] = $this->authex->getGebruikerInfo();

    $this->load->model('andereActiviteit_model');
    $this->load->model('activiteitPerGebruiker_model');
    $this->activiteitPerGebruiker_model->deleteZwemmersBijActiviteit($id);
    $this->andereActiviteit_model->delete($id);

  }

  public function nieuw()
  {
    $activiteit = new stdClass();
    $activiteit->id = $this->input->post('id');
    $activiteit->soortId = $this->input->post('soort');
    $activiteit->naam = $this->input->post('naam');
    $activiteit->plaats = $this->input->post('plaats');
    $activiteit->beginDatum = $this->input->post('begindatum');
    $activiteit->eindDatum = $this->input->post('einddatum');
    $activiteit->tijdstip = $this->input->post('tijdstip');
    $activiteit->beschrijving = $this->input->post('beschrijving');

    $zwemmers = $this->input->post('zwemmers');
    $activiteitPerGebruiker = new stdClass();

    $this->load->model('andereActiviteit_model');
    $this->load->model('activiteitPerGebruiker_model');
    if ($activiteit->id == null)
    {
        $id = $this->andereActiviteit_model->insert($activiteit);

        foreach ($zwemmers as $zwemmer)
        {
          $activiteitPerGebruiker->gebruikerIdZwemmer = $zwemmer;
          $activiteitPerGebruiker->andereActiviteitId = $id;
          $this->activiteitPerGebruiker_model->insert($activiteitPerGebruiker);
        }
    } else {
        $this->andereActiviteit_model->update($activiteit);
        $this->activiteitPerGebruiker_model->deleteZwemmersBijActiviteit($activiteit->id);

        foreach ($zwemmers as $zwemmer)
        {
          $activiteitPerGebruiker->gebruikerIdZwemmer = $zwemmer;
          $activiteitPerGebruiker->andereActiviteitId = $activiteit-> id;
          $this->activiteitPerGebruiker_model->insert($activiteitPerGebruiker);
        }
    }

    $dt = new DateTime;
    $week = $dt->format('W');
    $jaar = $dt->format('Y');
    redirect('activiteit/index/' . $week . '/' . $jaar);
  }
}
