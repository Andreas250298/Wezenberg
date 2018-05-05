<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @class Home
 * @brief Controller-klasse voor de startpagina en navigatie
 *
 * Controller-klasse met methoden die worden gebruikt bij het tonen van de startpagina.
 */
class Home extends CI_Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('pagination');
    }

    /**
     * Haalt alles op dat op de startpagina van de verschillende gebruikers getoond moet worden, zoals: nieuws via nieuws_model,
     * wedstrijden via Wedstrijd_model, deelname via deelname_model en trainingcentrum gegevens via trainingscentrum_model deze worden getoond in de view startpagina.php
     *\see Authex::getGebruikerInfo()
     *\see Wedstrijd_model::toonWedstrijden()
     *
     *\see bekijken.php
     */
    public function index($nieuwsRij = 0, $agendaRij = 0)
    {
        $data['titel'] = 'Wezenberg | startpagina';
        $data['paginaVerantwoordelijke'] = 'Florian D\'Haene';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $gebruiker = $data['gebruiker'];

        $data['nieuwsStartRij'] = $nieuwsRij;
        
        $aantal = 5;

        
        $this->load->model('wedstrijd_model');
        
        $config['base_url'] = site_url('Home/index/');
        $config['total_rows_wedstrijden'] = $this->wedstrijd_model->getCountAll();
        $config['per_page'] = $aantal;
        
        $this->pagination->initialize($config);
        
        $data['wedstrijden'] = $this->wedstrijd_model->getAllWedstrijdPaging($aantal, $agendaRij);
        
        if ($gebruiker != null) {
            $this->load->model('deelname_model');
            $data['status'] = $this->deelname_model->getStatusPerGebruiker($gebruiker->id);
            $data['deelname'] = $this->deelname_model->get($gebruiker->id);
        }

        $this->load->model('trainingscentrum_model');
        $data['trainingscentrum'] = $this->trainingscentrum_model->get();

        $data['links'] = $this->pagination->create_links();
        
        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'startpagina',
            'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }

    public function meldAan()
    {
        $data['titel'] = 'Aanmelden';
        $data['paginaVerantwoordelijke'] = '';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'startpagina',
            'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }

    public function toonFout($foutMelding)
    {
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

    public function controleerAanmelden()
    {
        $email = $this->input->post('email');
        $wachtwoord = $this->input->post('wachtwoord');

        if ($this->authex->meldAan($email, $wachtwoord)) {
            redirect('home');
        } else {
            redirect('home/toonFout/aanmelden');
        }
    }

    public function meldAf()
    {
        $this->authex->meldAf();
        redirect('home/index');
    }

    public function demo()
    {
        $data['titel'] = 'Wezenberg | Demo';
        $data['paginaVerantwoordelijke'] = 'Florian D\'Haene';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $gebruiker = $data['gebruiker'];

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'zwemmer_demo',
            'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }
    
    public function haalAjaxOp_Nieuwsartikels()
    {
        $data['nieuwsStartRij'] = intval($this->input->get('nieuwsStartRij'));
        $aantalArtikels = 5;
       
        $this->load->model('nieuws_model');

        $config['total_rows_nieuws'] = $this->nieuws_model->getCountAll();
        $config['per_page'] = $aantalArtikels;
        
        $this->pagination->initialize($config);
        
        $data['nieuwsArtikels'] = $this->nieuws_model->getAllNieuwsArtikelsPaging($aantalArtikels, intval($data['nieuwsStartRij']));
        
        $this->load->view('ajax_nieuwsartikels', $data);
    }
    
        public function haalAjaxOp_AgendaItems()
    {
        $data['agendaStartRij'] = intval($this->input->get('agendaStartRij'));
        $aantalAgendaItems= 3;
       
        $this->load->model('wedstrijd_model');

        $config['total_rows_nieuws'] = $this->wedstrijd_model->getCountAll();
        $config['per_page'] = $aantalAgendaItems;
        
        $this->pagination->initialize($config);
        
        $data['agendaItems'] = $this->wedstrijd_model->getAllWedstrijdPaging($aantalAgendaItems, intval($data['agendaStartRij']));
        
        $this->load->view('ajax_agendaItems', $data);
    }
    
    public function haalAjaxOp_MaakMeldingGezien()
    {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $meldingPerGebruiker->id = $this->input->get('id');
        $meldingPerGebruiker->gezien = 1;

        $this->load->model('meldingPerGebruiker_model');
        $this->meldingPerGebruiker_model->update($meldingPerGebruiker);



        $data['meldingGezien'] = $this->meldingPerGebruiker_model->update($id);

        $data['meldingenPerGebruiker'] = $this->meldingPerGebruiker_model->getAllPerGebruiker($data['gebruiker']->id);

        $this->load->view('ajax_meldingTonen', $data);
    }
}
