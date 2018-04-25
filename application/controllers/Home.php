<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @class Home
 * @brief Controller-klasse voor de startpagina en navigatie
 *
 * Controller-klasse met methoden die worden gebruikt bij het tonen van de startpagina.
 */
class Home extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    /**
     * Haalt alles op dat op de startpagina van de verschillende gebruikers getoond moet worden, zoals: nieuws via nieuws_model, 
     * wedstrijden via Wedstrijd_model, deelname via deelname_model en trainingcentrum gegevens via trainingscentrum_model deze worden getoond in de view startpagina.php
     *\see Authex::getGebruikerInfo()
     *\see Wedstrijd_model::toonWedstrijden()
     *\see Wedstrijd_model::toonWedstrijden()
     *\see Wedstrijd_model::toonWedstrijden()
     *\see Wedstrijd_model::toonWedstrijden()
     * 
     *\see bekijken.php
     */
    public function index() {
        $data['titel'] = 'Wezenberg | startpagina';
        $data['paginaVerantwoordelijke'] = 'Florian D\'Haene';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $gebruiker = $data['gebruiker'];
        
        $this->load->model('nieuws_model');
        $data['nieuwsArtikels'] = $this->nieuws_model->getAllNieuwsArtikels();

        $this->load->model('wedstrijd_model');
        $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijdenASC();

        if ($gebruiker != null) {
            
        $this->load->model('deelname_model');
            $data['status'] = $this->deelname_model->getStatusPerGebruiker($gebruiker->id);
            $data['deelname'] = $this->deelname_model->get($gebruiker->id);
        }
        
        $this->load->model('trainingscentrum_model');
        $data['trainingscentrum'] = $this->trainingscentrum_model->get();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'startpagina',
            'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }

    public function meldAan() {
        $data['titel'] = 'Aanmelden';
        $data['paginaVerantwoordelijke'] = '';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'startpagina',
            'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }

    public function toonFout($foutMelding) {
        $data['titel'] = 'Fout';
        $data['paginaVerantwoordelijke'] = '';

        switch ($foutMelding) {
            case 'aanmelden':
                $data['foutMelding'] = 'Foute aanmeld gegevens, probeer opnieuw!';
                break;

            default:
                $data['foutMelding'] = '';
                break;
        }



        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'login_fout',
            'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }

    public function controleerAanmelden() {
        $email = $this->input->post('email');
        $wachtwoord = $this->input->post('wachtwoord');

        if ($this->authex->meldAan($email, $wachtwoord)) {
            redirect('home');
        } else {
            redirect('home/toonFout/aanmelden');
        }
    }

    public function meldAf() {
        $this->authex->meldAf();
        redirect('home/index');
    }

}
