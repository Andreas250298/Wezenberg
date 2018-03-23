<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    public function index() {
        $data['titel'] = 'Wezenberg | startpagina';
        $data['paginaVerantwoordelijke'] = '';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $this->load->model('nieuws_model');
        $data['nieuwsArtikels'] = $this->nieuws_model->getAllNieuwsArtikels();
        
        $this->load->model('wedstrijd_model');
        $data['wedstrijden'] = $this->wedstrijd_model->getAll();
        
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
