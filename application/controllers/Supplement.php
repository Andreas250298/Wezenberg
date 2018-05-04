<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
* @class Supplement
* @brief Controller-klasse voor Supplement
*
* Controller-klasse met methoden die worden gebruikt door het Supplement
*/
class Supplement extends CI_Controller
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
    * Weergeven van Supplementen
    *\see Authex::getGebruikerInfo()
    *\see Supplement_model::toonSupplementen()
    *\see Supplement/bekijken.php
    */
    public function index()
    {
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $data['titel'] = 'Supplement bekijken';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $this->load->model('supplement_model');
        $data['supplementen'] = $this->supplement_model->getSupplementen();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Supplement/beheren',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
    * Aanmaken van supplement
    *\see Authex::getGebruikerInfo()
    *\see Supplement/form.php
    */
    public function maakSupplement()
    {
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $data['titel'] = 'Supplementen aanmaken';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['supplement'] = null;
        $this->load->model('supplement_model');

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Supplement/form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
    * Registreren van supplement
    *\see Supplement_model::insert()
    *\see Supplement_model::update()
    *\see Supplement::beheerSupplementen()
    */
    public function registreer()
    {
        $supplement = new stdClass();
        $supplement->id = $this->input->post('id');
        $supplement->naam = $this->input->post('naam');
        $supplement->beschrijving = $this->input->post('beschrijving');

        $this->load->model('supplement_model');
        if ($supplement->id == null) {
            $this->supplement_model->insert($supplement);
        } else {
            $this->supplement_model->update($supplement);
        }

        redirect('/supplement/beheerSupplementen');
    }

    /**
    * Beheren van supplementen
    *\see Authex::getGebruikerInfo()
    *\see Supplement_model::toonSupplementen()
    *\see Supplementen/beheren.php
    */
    public function beheerSupplementen()
    {
        $data['titel'] = 'Supplementen beheren';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';

        $this->load->model('supplement_model');
        $data['supplementen'] = $this->supplement_model->getSupplementen();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Supplement/beheren',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
    * Wijzigen van supplement volgens id
    *\see Authex::getGebruikerInfo()
    *\see Supplement_model::get()
    *\see Supplementen/form.php
    */
    public function wijzig($id)
    {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $this->load->model('supplement_model');
        $data['supplement'] = $this->supplement_model->get($id);
        $data['titel'] = 'Supplementen wijzigen';

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Supplement/form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
    * Verwijderen van supplement volgens id
    *\see Authex::getGebruikerInfo()
    *\see Supplement_model::delete()
    *\see Supplement::index()
    */
    public function verwijder($id)
    {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $this->load->model('supplement_model');
        $this->supplement_model->delete($id);

        redirect("/supplement/index");
    }

     /**
    * Verwijderen van supplementPerZwemmer volgens id
    *\see Authex::getGebruikerInfo()
    *\see Supplement_model::delete()
    *\see Supplement::index()
    */
    public function verwijderSupplementPerZwemmer()
    {
        $id = $this->input->get('id');
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Mattias De Coninck';
        $this->load->model('supplementPerZwemmer_model');
        $this->supplementPerZwemmer_model->delete($id);

        redirect("/supplement/supplementenPerZwemmerTrainer");
    }

    /**
    * Tonen van supplementen voor een zwemmer
    * @param id id van de Zwemmer
    *\see SupplementPerZwemmer_model::getSupplementenPerZwemmer()
    *\see Authex::getGebruikerInfo()
    */
    public function supplementenPerZwemmer($id)
    {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Mattias De Coninck';
        $this->load->model('supplementPerZwemmer_model');
        $data['supplementenPerZwemmer'] = $this->supplementPerZwemmer_model->getSupplementenPerZwemmer($id);


        $data['titel'] = 'Supplementen voor zwemmer';
        $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Supplement/zwemmer',
          'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

     /**
     * Alle supplementPerZwemmer tonen aan de trainer
     * \see SupplementPerZwemmer_model::getSupplementenPerAlleZwemmers
     * \see Gebruiker_model::toonZwemmers
     */
    public function supplementenPerZwemmerTrainer()
    {
        $data['paginaVerantwoordelijke'] = 'Mattias De Coninck';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $this->load->model('supplementPerZwemmer_model');
        $this->load->model('gebruiker_model');
        $data['supplementenPerAlleZwemmers'] = $this->supplementPerZwemmer_model->getSupplementenPerAlleZwemmers();
        $data['zwemmers'] = $this->gebruiker_model->toonZwemmers();

        $data['titel'] = 'Supplementen voor alle zwemmers';
        $partials = array('hoofding' => 'main_header',
          'inhoud' => 'SupplementPerZwemmer/bekijken',
          'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    /**
    * Als trainer supplementen toekennen aan een zwemmer
    *\see Supplementen_model::getSupplementen()
    *\see Gebruiker_model::toonZwemmers()
    */
    public function supplementenToekennen()
    {
        $data['paginaVerantwoordelijke'] = 'Mattias De Coninck';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $this->load->model('supplement_model');
        $this->load->model('gebruiker_model');

        $data['supplementen'] = $this->supplement_model->getSupplementen();
        $data['zwemmers'] = $this->gebruiker_model->toonZwemmers();

        $data['titel'] = 'Supplement toekennen';
        $partials = array('hoofding' => 'main_header',
          'inhoud' => 'SupplementPerZwemmer/toekennen',
          'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

     /**
     * Aanpassen supplementPerZwemmer als de trainer
     * \see SupplementPerZwemmer_model::get
     * \see Supplement_model->getSupplementen
     */
    public function aanpassenSupplementPerZwemmer($id){
        $this->load->model('supplementPerZwemmer_model');
        $this->load->model('supplement_model');

        $data['paginaVerantwoordelijke'] = 'Mattias De Coninck';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['supplementPerZwemmer'] = $this->supplementPerZwemmer_model->get($id);
        $data['supplementen'] = $this->supplement_model->getSupplementen();

        $data['titel'] = 'Supplement aanpassen';
        $partials = array('hoofding' => 'main_header',
          'inhoud' => 'SupplementPerZwemmer/aanpassen',
          'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

     /**
     * Aanpassen supplementPerZwemmer als de trainer
     * \see SupplementPerZwemmer_model::get
     * \see Supplement_model->getSupplementen
     */
    public function aanpassen()
    {
        $supplementPerZwemmer = new stdClass();
        $supplementPerZwemmer->id = $this->input->post('id');
        $supplementPerZwemmer->supplementId = $this->input->post('supplement');
        $supplementPerZwemmer->gebruikerIdZwemmer = $this->input->post('zwemmer');
        $supplementPerZwemmer->hoeveelheid = $this->input->post('hoeveelheid');
        $supplementPerZwemmer->datumInname = $this->input->post('datum');
        $supplementPerZwemmer->tijdstipInname = $this->input->post('tijdstip');

        if ($supplementPerZwemmer->datumInname < date('Y-m-d')){
            $message = "Datum moet verder liggen als vandaag!";
            return $this->error($message);
        } else{
            $this->load->model('supplementPerZwemmer_model');
            $this->supplementPerZwemmer_model->update($supplementPerZwemmer);
            redirect("/supplement/supplementenPerZwemmerTrainer");
        }
    }

     /**
     * Toekennen supplementPerZwemmer als de trainer
     * \see SupplementPerZwemmer_model::insert
     * \see Supplement::error
     */
    public function toekennen()
    {
        $zwemmers = $this->input->post('zwemmers');
        foreach ($zwemmers as $zwemmer) {
            $this->load->model('supplementPerZwemmer_model');

            $supplementPerZwemmer = new stdClass();
            $supplementPerZwemmer->gebruikerIdZwemmer = $zwemmer;
            $supplementPerZwemmer->supplementId = $this->input->post('supplement');
            $supplementPerZwemmer->hoeveelheid = $this->input->post('hoeveelheid');
            $startDatum = new DateTime($this->input->post('startDatum'));
            $eindeDatum = new DateTime($this->input->post('eindeDatum'));

            if ($startDatum > $eindeDatum){
                $message = "Start datum ligt verder in de toekomst dan Einde datum!";
                return $this->error($message);
            }
            else {
                for ($i = $startDatum; $startDatum <= $eindeDatum; $i->modify('+1 day')) {
                    $supplementPerZwemmer->datumInname = $i->format('Y-m-d');
                    $supplementPerZwemmer->tijdstipInname = $this->input->post('tijdstip');
                    $this->supplementPerZwemmer_model->insert($supplementPerZwemmer);
                }
            }

        }
        redirect("/supplement/supplementenPerZwemmerTrainer");
    }

    /**
     * Tonen van error
     * @param message de boodschap die moet worden weergegeven
     */
    public function error($message){
        $data['paginaVerantwoordelijke'] = 'Mattias De Coninck';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['message'] = $message;

        $data['titel'] = 'Error';
        $partials = array('hoofding' => 'main_header',
          'inhoud' => 'SupplementPerZwemmer/error',
          'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
}
