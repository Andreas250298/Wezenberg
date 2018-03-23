<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trainer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }


    public function registreer()
    {
        $data['paginaVerantwoordelijke'] = '';
        $data['titel'] = 'Wezenberg | Gebruiker aanmaken';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'trainer_registreer',
            'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }


    public function controleerRegistratie()
    {
        $naam = $this->input->post('naam');
        $address = $this->input->post('adres');
        $woonplaats = $this->input->post('woonplaats');
        $soort = $this->input->post('soort');
        $email = $this->input->post('email');
        $wachtwoord = $this->input->post('wachtwoord');

        if ($naam != null || $address != null || $woonplaats != null || $soort != null || $email != null || $wachtwoord != null)
        {
            $this->authex->registreer($email, $wachtwoord, $naam, $address, $woonplaats, $soort);
            redirect('gebruiker/toonZwemmers');
        }
        else
        {
            redirect('login_fout');
        }

    }


}
