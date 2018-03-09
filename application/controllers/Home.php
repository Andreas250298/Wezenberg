<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    public function index() {
        $data['titel'] = 'Wezenberg | startpagina';
        $data['gebruiker']  = $this->authex->getGebruikerInfo();

            $partials = array('hoofding' => 'main_header',
                'inhoud' => 'startpagina',
                'voetnoot' => 'main_footer');

            $this->template->load('main_master', $partials, $data);
    }

    public function meldAan()
{
    $data['titel'] = 'Aanmelden';
    $data['gebruiker']  = $this->authex->getGebruikerInfo();

    $partials = array('hoofding' => 'main_header',
        'inhoud' => 'startpagina',
        'voetnoot' => 'main_footer');

    $this->template->load('main_master', $partials, $data);
}
    public function toonFout()
    {
        $data['titel'] = 'Fout';
        $data['gebruiker']  = $this->authex->getGebruikerInfo();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'login_fout',
            'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }

    public function controleerAanmelden()
    {
        $email = $this->input->post('email');
        $wachtwoord = $this->input->post('wachtwoord');

        if ($this->authex->meldAan($email, $wachtwoord)) {
            redirect('home');
        } else {
            redirect('home/toonFout');
        }
    }

    public function meldAf()
    {
        $this->authex->meldAf();
        redirect('home/index');
    }
}
