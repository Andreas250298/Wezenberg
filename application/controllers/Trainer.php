<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Trainer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('notation');
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
        $geboortedatum = zetOmNaarYYYYMMDD($this->input->post('geboortedatum'));

        if ($naam != null || $address != null || $woonplaats != null || $soort != null || $email != null || $wachtwoord != null || $geboortedatum != null)
        {
            $this->authex->registreer($email, $wachtwoord, $naam, $address, $woonplaats, $soort, $geboortedatum);
            redirect('gebruiker/toonZwemmers');
        }
        else
        {
            redirect('login_fout');
        }

    }


}
