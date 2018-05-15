<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @class Wedstrijd
 * @brief Controller-klasse voor Wedstrijden
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
     * @see Authex::getGebruikerInfo()
     * @see Wedstrijd_model::toonWedstrijden()
     * @see bekijken.php
     */
    public function index() {
        $data['titel'] = 'Wedstrijden bekijken';
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $this->load->model('wedstrijd_model');
        $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijdenVanafVandaagASC();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Wedstrijd/bekijken',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Toont het scherm om een nieuwe wedstrijd te maken
     * @param tijd of de datum voor of na vandaag ligt
     * @see maken.php
     */
    public function maakWedstrijd($tijd) {
        $data['tijd'] = $tijd;
        $data['titel'] = 'Wedstrijden aanmaken';
        $data['paginaVerantwoordelijke'] = 'De Coninck Mattias';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $this->load->model('afstand_model');
        $data['afstanden'] = $this->afstand_model->getAllAfstanden();
        $this->load->model('slag_model');
        $data['slagen'] = $this->slag_model->getAllSlagen();
        $this->load->model('status_model');
        $data['statussen'] = $this->status_model->getAll();
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Wedstrijd/maken',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Maakt een nieuwe entry aan in de wedstrijd-database met de opgegeven info uit maken.php
     * @param tijd of de datum voor of na vandaag ligt
     * @see Wedstrijd_model::insert()
     * @see Wedstrijd_model::update()
     */
    public function registreer($tijd)
    {
        $data['tijd'] = $tijd;

        $wedstrijd = new stdClass();
        $wedstrijd->id = html_escape($this->input->post('id'));
        $wedstrijd->plaats = html_escape($this->input->post('plaats'));
        $wedstrijd->naam = html_escape($this->input->post('naam'));
        $wedstrijd->beginDatum = html_escape($this->input->post('beginDatum'));
        $wedstrijd->eindDatum = html_escape($this->input->post('eindDatum'));
        $wedstrijd->laatsteInschrijvingDatum = html_escape($this->input->post('laatsteInschrijvingDatum'));
        $wedstrijd->beschrijving = html_escape($this->input->post('beschrijving'));

        if ($wedstrijd->beginDatum > $wedstrijd->eindDatum || $wedstrijd->laatsteInschrijvingDatum >= $wedstrijd->beginDatum || $wedstrijd->beginDatum <= date('Y-m-d')){
            $message = "Zorg dat de datums kloppen, een wedstrijd kan niet in het verleden liggen. Een einddatum kan niet vroeger liggen als een startdatum, ook kan een inschrijfdatum niet na een startdatum liggen.";
            return $this->error($message);
        }

        $afstand = new stdClass();
        $afstand->naam = $this->input->post('afstand');

        $this->load->model('wedstrijd_model');
        if ($wedstrijd->id == null) {
            $this->wedstrijd_model->insert($wedstrijd);
            $this->wedstrijdMelding('Nieuwe wedstrijd: ' . $wedstrijd->naam);
        } else {
            $this->wedstrijd_model->update($wedstrijd);
            $this->wedstrijdMelding('Wedstrijd gewijzigd: ' . $wedstrijd->naam);
        }

        $this->load->model('deelname_model');
        $status = $this->deelname_model->get($wedstrijd->id);
        $status->statusId = '4';

        redirect('/wedstrijd/bekijkenWedstrijden/'.$tijd);
    }

    public function wedstrijdMelding($boodschap, $ontvangerId = 0) {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $this->load->model('melding_model');

        $melding = new stdClass();
        $melding->boodschap = $boodschap;
        $melding->gebruikerIdTrainer = $data['gebruiker']->id;
        $melding->verzondenDatum = date('Y-m-d');

        $meldingId = $this->melding_model->insert($melding);

        $this->load->model('meldingPerGebruiker_model');

        if ($ontvangerId === 0) {
            $this->load->model('gebruiker_model');
            $gebruikers = $this->gebruiker_model->getActieveGebruikers();
            foreach ($gebruikers as $gebruiker) {
                $meldingPerGebruiker = new stdClass();
                $meldingPerGebruiker->gebruikerId = $gebruiker->id;
                $meldingPerGebruiker->meldingId = $meldingId;
                $meldingPerGebruiker->gezien = 0;

                $this->meldingPerGebruiker_model->insert($meldingPerGebruiker);
            }
        } elseif ($ontvangerId === -1) {
            $this->load->model('gebruiker_model');
            $trainers = $this->gebruiker_model->getActieveTrainers();
            foreach ($trainers as $trainer) {
                $meldingPerGebruiker = new stdClass();
                $meldingPerGebruiker->gebruikerId = $trainer->id;
                $meldingPerGebruiker->meldingId = $meldingId;
                $meldingPerGebruiker->gezien = 0;

                $this->meldingPerGebruiker_model->insert($meldingPerGebruiker);
            }
        } else{
            $meldingPerGebruiker = new stdClass();
            $meldingPerGebruiker->gebruikerId = $ontvangerId;
            $meldingPerGebruiker->meldingId = $meldingId;
            $meldingPerGebruiker->gezien = 0;

            $this->meldingPerGebruiker_model->insert($meldingPerGebruiker);
        }
    }

    /**
     * Maakt een nieuwe entry aan in de wedstrijd-database met de opgegeven info uit maken.php
     * @param tijd of de datum voor of na vandaag ligt
     * @see Wedstrijd_model::insert()
     * @see Wedstrijd_model::update()
     */
    public function registreerReeks($tijd)
    {
        $data['tijd'] = $tijd;
        $reeks = new stdClass();
        $reeks->id = html_escape($this->input->post('id'));
        $reeks->datum = html_escape($this->input->post('datum'));
        $reeks->afstandId = html_escape($this->input->post('afstand'));
        $reeks->tijdstip = html_escape($this->input->post('tijdstip'));
        $reeks->slagId = html_escape($this->input->post('slag'));
        $reeks->wedstrijdId = html_escape($this->input->post('wedstrijdId'));
        /*$afstand = new stdClass();
        $afstand->afstand = $this->input->post('afstand');*/

        $this->load->model('reeks_model');
        if ($reeks->id == null) {
            $this->reeks_model->insert($reeks);
        } else {
            $this->reeks_model->update($reeks);
        }

        $this->load->model('deelname_model');
        $gebruiker = $this->authex->getGebruikerInfo();
        $status = $this->deelname_model->getStatusPerGebruiker($gebruiker->id);
        $status->statusId = '4';

        redirect('/wedstrijd/reeksenToevoegen/' . $reeks->wedstrijdId."/".$tijd);
    }

    /**
     * Toont de pagina voor de wedstrijd-informatie aan te passen
     * @param id De id van de aan te passen wedstrijd
     * @param tijd of de datum voor of na vandaag ligt
     * @see Wedstrijd_model::get()
     * @see beheren.php
     */
    public function updateWedstrijd($id, $tijd)
    {
        $data['tijd'] = $tijd;
        $data['titel'] = 'Wedstrijden wijzigen';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $this->load->model('wedstrijd_model');
        $data['wedstrijd'] = $this->wedstrijd_model->get($id);

        $this->load->model('wedstrijd_model');
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Wedstrijd/maken',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Toont de pagina voor de wedstrijden te beheren
     * @param tijd of de datum voor of na vandaag ligt
     * @see Authex::getGebruikerInfo()
     * @see Wedstrijd_model::toonWedstrijden()
     * @see bekijken.php
     */
    public function bekijkenWedstrijden($tijd)
    {
        $data['titel'] = 'Wedstrijden bekijken';
        $data['paginaVerantwoordelijke'] = 'Mattias De Coninck';
        $data['gebruiker']  = $this->authex->getGebruikerInfo();
        $data['tijd'] = $tijd;

        $this->load->model('wedstrijd_model');
        if ($tijd === "voor"){
            $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijdenVoorVandaagASC();
        } else {
            $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijdenVanafVandaagASC();
        }


        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Wedstrijd/bekijken',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Ajax functie die wedstrijden zal ophalen via juiste GET input
     * @see Wedstrijd_model::toonWedstrijdenVoorVandaagASC()
     * @see Wedstrijd_model::toonWedstrijdenVanafVandaagASC()
     */
    public function haalAjaxOp_bekijkenWedstrijden(){
        $plaats = $this->input->get('plaats');
        $tijd = $this->input->get('tijd');
        $data['tijd'] = $tijd;

        $data['gebruiker']  = $this->authex->getGebruikerInfo();

        $this->load->model('wedstrijd_model');
        if ($tijd == 'voor'){
            $wedstrijdenZonderPlaats = $this->wedstrijd_model->toonWedstrijdenVoorVandaagASC();
        } else {
            $wedstrijdenZonderPlaats = $this->wedstrijd_model->toonWedstrijdenVanafVandaagASC();
        }
        $data['wedstrijden'] = $wedstrijdenZonderPlaats;
        $wedstrijden = [];

        if ($wedstrijdenZonderPlaats != null){
            if ($plaats != 'Alle')
            {
                foreach($wedstrijdenZonderPlaats as $wedstrijd){
                 if ($wedstrijd->plaats === $plaats){
                        array_push($wedstrijden, $wedstrijd);
                    }
                }
                $data['wedstrijden'] = $wedstrijden;
            }
            $this->load->view('Wedstrijd/ajax_bekijken', $data);
        }
    }

    /**
    * Hiermee verwijdert de trainer een wedstrijd
    * @param id De id van de aan te verwijderen wedstrijd
    * @see Authex::getGebruikerInfo()
    */
    public function verwijder()
    {
        $id = $this->input->get('id');
        $tijd = $this->input->get('tijd');
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Mattias De Coninck';
        $this->load->model('wedstrijd_model');
        $this->wedstrijd_model->delete($id);

        if ($tijd === 'na'){
            redirect('/wedstrijd/bekijkenWedstrijden/na');
        } else {
            redirect('/wedstrijd/bekijkenWedstrijden/voor');
        }
    }

    /**
     * Verwijdert het nieuwsartikel en toont opnieuw de lijst van nieuwsartikels.
     * @param id van de te verwijderen nieuwsartikel
     * @param tijd of de datum voor of na vandaag ligt
     */

    public function verwijderReeks($id, $tijd)
    {
        //$id = $this->input->get('id');
        $data['tijd'] = $tijd;
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $this->load->model('reeks_model');
        $this->reeks_model->delete($id);

        redirect("/wedstrijd/bekijkenWedstrijden/".$tijd);
    }

    /**
    * Toont de pagina waarin een zwemmer zich kan inschrijven voor een wedstrijd
    * @see Authex::getGebruikerInfo()
    * @see Wedstrijd_model::toonWedstrijden()
    * @see Deelname_model::getStatusPerGebruiker()
    * @see Deelname_model::get()
    * @see inschrijvingen.php
    */
    public function inschrijvingen()
    {
        $data['titel'] = "Inschrijven wedstrijden";
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $gebruiker = $data['gebruiker'];
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';

        $this->load->model('wedstrijd_model');
        $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijdenASC();
        $this->load->model('deelname_model');
        $data['deelnames'] = $this->deelname_model->getStatusPerGebruiker($gebruiker->id);

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Wedstrijd/inschrijvingen',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
    * Toont de pagina waarin een zwemmer de melding krijgt om te wachten op goedkeuring voor de inschrijving
    * @see Authex::getGebruikerInfo()
    * @see inschrijven.php
    */
    public function inschrijven($reeksId, $tijd)
    {
        $data['titel'] = "Inschrijving ontvangen";
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';

        if ($reeksId != null && $tijd == "na") {
            $deelname = new stdClass();
            $deelname->gebruikerIdZwemmer = $data['gebruiker']->id;
            $deelname->statusId = 1;
            $deelname->reeksId = $reeksId;

            $this->load->model('deelname_model');
            $this->deelname_model->insert($deelname);

            $partials = array('hoofding' => 'main_header',
                'inhoud' => 'Wedstrijd/inschrijven',
                'voetnoot' => 'main_footer');
            $this->template->load('main_master', $partials, $data);
        } else {
            redirect('/Wedstrijd/info/' . $reeksId . '/' . $tijd);
        }



    }

    /**
    * Toont de pagina waarin een trainer reeksen per wedstrijd kan toevoegen
    * @param id De id van de wedstrijd waar reeksen aan moeten toegevoegd worden
    * @param $tijd of de datum voor of na vandaag ligt
    * @see Authex::getGebruikerInfo()
    * @see Wedstrijd_model::getReeksenPerWedstrijd()
    * @see reeksen.php
    */
    public function reeksenToevoegen($id, $tijd)
    {
        $data['titel'] = "Reeksen toeveogen";
        $data['gebruiker']  = $this->authex->getGebruikerInfo();
        $data['tijd'] = $tijd;

        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $this->load->model('wedstrijd_model');
        //$data['wedstrijd'] = $this->wedstrijd_model->get($id);
        $data['wedstrijdId'] = $id;
        $data['reeksen'] = $this->wedstrijd_model->getReeksenPerWedstrijd($id);
        $this->load->model('reeks_model');
        $data['slagen'] = $this->reeks_model->getSlagenPerReeks($id);
        $data['afstanden'] = $this->reeks_model->getAfstandenPerReeks($id);

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Wedstrijd/reeksen',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
    * Toont het invulformulier dat de trainer dient in te vullen om een reeks toe te voegen
    * @param tijd of de datum voor of na vandaag ligt
    * @see Authex::getGebruikerInfo()
    * @see Wedstrijd_model::getReeksenPerWedstrijd()
    * @see Wedstrijd_model::getSlagenPerWedstrijd()
    * @see Wedstrijd_model::getAfstandenPerWedstrijd()
    * @see Slag_model::getAllSlagen()
    * @see Afstand_model::getAllAfstanden()
    * @see maakReeks.php
    */
    public function maakReeks($id, $tijd)
    {
        $data['tijd'] = $tijd;
        $data['titel'] = "Reeksen toevoegen";
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $this->load->model('wedstrijd_model');
        $data['wedstrijd'] = $this->wedstrijd_model->get($id);
        $this->load->model('slag_model');
        $data['slagen'] = $this->slag_model->getAllSlagen();
        $this->load->model('afstand_model');
        $data['afstanden'] = $this->afstand_model->getAllAfstanden();
        $data['reeks'] = null;
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Wedstrijd/maakReeks',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
    * Toont en overzicht met meer informatie over een bepaalde wedstrijd
    * @param id van de aangeklikte wedstrijd
    * @param tijd of de datum voor of na vandaag ligt
    * @see Authex::getGebruikerInfo()
    * @see Wedstrijd_model::get($id)
    * @see Wedstrijd_model::getReeksenPerWedstrijd()
    * @see Wedstrijd_model::getSlagenPerWedstrijd()
    * @see Wedstrijd_model::getAfstandenPerWedstrijd()
    * @see info.php
    */
    public function info($id, $tijd)
    {
        $data['titel'] = "Meer info van wedstrijd";
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $data['tijd'] = $tijd;

        $this->load->model('wedstrijd_model');
        $this->load->model('deelname_model');
        $data['reeksen'] = $this->wedstrijd_model->getReeksenPerWedstrijd($id);
        $data['wedstrijd'] = $this->wedstrijd_model->get($id);
        $data['deelnames'] = $this->deelname_model->getDeelnamesBijWedstrijd($id, $data['gebruiker']->id);

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Wedstrijd/info',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Toont de pagina met alle afgelopen wedstrijden
     * @see Authex::getGebruikerInfo()
     * @see Wedstrijd_model::toonWedstrijdenASC()
     * @see afgelopen.php
     */
    public function toonAfgelopen() {
        $data['titel'] = 'Wedstrijden bekijken';
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $this->load->model('wedstrijd_model');
        $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijdenASC();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Wedstrijd/afgelopen',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Toont de pagina met alle afgelopen wedstrijden
     *\see Authex::getGebruikerInfo()
     *\see Wedstrijd_model::toonWedstrijdenASC()
     *\see afgelopen.php
     */
    public function voegResultatenToe()
    {
        $data['titel'] = 'Resultaten toevoegen';
        $data['paginaVerantwoordelijke'] = 'Andreas Aerts';
        $data['gebruiker']  = $this->authex->getGebruikerInfo();

        $this->load->model('gebruiker_model');
        $data['zwemmers'] = $this->gebruiker_model->toonZwemmers();
        //$this->load->model('RondeResultaat_model');
        //$data['wedstrijden'] = $this->RondeResultaat_model->get($id);

        $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Wedstrijd/resultaatToevoegen',
          'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Tonen van error
     * @param message de boodschap die moet worden weergegeven
     * @see Authex::GetGebruikerInfo()
     */
    public function error($message){
        $data['paginaVerantwoordelijke'] = 'Mattias De Coninck';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['message'] = $message;

        $data['titel'] = 'Error';
        $partials = array('hoofding' => 'main_header',
          'inhoud' => 'error',
          'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function toonInschrijvingen()
    {
        $data['paginaVerantwoordelijke'] = 'Mattias De Coninck';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['titel'] = 'Inschrijvingen bekijken';

        $this->load->model('deelname_model');
        $data['deelnames'] = $this->deelname_model->getDeelnamesMetStatus();

        $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Wedstrijd/inschrijvingen_trainer',
          'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
}
