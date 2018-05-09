<?php

defined('BASEPATH') or exit('No direct script access allowed');
/**
 * @class Nieuws
 * @brief Controller-klasse voor Nieuws
 *
 * Controller-klasse met methoden die worden gebruikt bij het tonen en beheren van nieuwsartikels.
 */
class Nieuws extends CI_Controller
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form', 'date', 'file');
        $this->load->library('pagination');
    }

    /**
     * Toont een lijst van nieuwsartikels startend vanaf een bepaalde rij (standaard de 0ste rij).
     *
     * @param startrij de rij dat moet worden getoond.
     */
    public function index($startrij = 0)
    {
        $data['paginaVerantwoordelijke'] = 'Sacha De Pauw';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['titel'] = "Nieuws beheren";


        $this->load->model('nieuws_model');

        $aantal = 10;

        $config['base_url'] = site_url('Nieuws/index/');
        $config['total_rows'] = $this->nieuws_model->getCountAll();
        $config['per_page'] = $aantal;

        $this->pagination->initialize($config);

        $data['nieuwsArtikels'] = $this->nieuws_model->getAllNieuwsArtikelsPaging($aantal, $startrij);

        $data['links'] = $this->pagination->create_links();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Nieuws/beheren',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Toont het formulier om een nieuw nieuwsartikel aan te maken.
     */
    public function maakNieuwsArtikel()
    {
        $data['paginaVerantwoordelijke'] = 'Sacha De Pauw';
        $data['titel'] = 'Nieuwsartikel aanmaken';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $data['nieuwsArtikel'] = null;


        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Nieuws/form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Voegt een nieuw nieuwsartikel toe aan de databank en toont dan opnieuw de lijst van nieuwsartikels.
     */
    public function registreer()
    {
        $artikel = new stdClass();
        $artikel->id = $this->input->post('id');
        $artikel->titel = $this->input->post('titel');
        $artikel->beschrijving = $this->input->post('beschrijving');
        $artikel->gebruikerIdTrainer = $this->authex->getGebruikerInfo()->id;
        $datestring = date("Y-m-d");
        $artikel->datumAangemaakt = $datestring;
        $config['upload_path']          = './uploads/nieuws';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $this->load->library('upload', $config);
        $this->load->model('nieuws_model');
        if($this->upload->do_upload('userfile')){
          $upload_data = $this->upload->data();
          $oudArtikel = $this->nieuws_model->get($artikel->id);
          $this->load->helper("file");
          unlink($oudArtikel->foto);
          $artikel->foto = 'uploads/nieuws/' . $upload_data['file_name'];
        }
        $this->load->model('nieuws_model');
        if ($artikel->id == null) {
            $this->nieuws_model->insert($artikel);
        } else {
            $this->nieuws_model->update($artikel);
        }
        redirect('/nieuws/index');
    }

    /**
     * Toont een formulier met alle gegevens ingevuld van het gekoze nieuwsartikel.
     * @param id het id van het te wijzigen nieuwsartikel.
     */
    public function wijzig($id)
    {
        $data['paginaVerantwoordelijke'] = 'Sacha De Pauw';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $this->load->model('nieuws_model');
        $data['nieuwsArtikel'] = $this->nieuws_model->get($id);
        $data['titel'] = 'Nieuwsartikel wijzigen';

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Nieuws/form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Verwijdert het nieuwsartikel en toont opnieuw de lijst van nieuwsartikels.
     * @param id het id van de te verwijderen nieuwsartikel.
     */
    public function verwijder()
    {
        $id = $this->input->get('id');
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Sacha De Pauw';
        $this->load->model('nieuws_model');
        $nieuwsArtikel = $this->nieuws_model->get($id);
        $this->load->helper("file");
        unlink($nieuwsArtikel->foto);
        $this->nieuws_model->delete($id);

        redirect("/nieuws/index");
    }

    /**
     * Toont een bepaald artikel volledig op een aparte pagina.
     * @param id het id van het te bekijken nieuwsartikel.
     */
    public function bekijk($id)
    {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $data['paginaVerantwoordelijke'] = 'Sacha De Pauw';


        $this->load->model('nieuws_model');
        $data['nieuwsArtikel'] = $this->nieuws_model->get($id);
        $data['titel'] = $data['nieuwsArtikel']->titel;

        $partials = array('hoofding' => 'main_header',
           'inhoud' => 'Nieuws/bekijken',
           'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }


    /**
     * Toont een tutorial over hoe je het nieuws op de pagina van nieuws/beheren kan aanpassen
     */
    public function tutorial()
    {
        $data['paginaVerantwoordelijke'] = 'Florian D\'Haene';
        $data['titel'] = 'Tutorial - Nieuws beheren';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Nieuws/tutorial',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
}
