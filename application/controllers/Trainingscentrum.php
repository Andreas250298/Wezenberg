<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @class Trainingscentrum
 * @brief Controller-klasse voor Trainingscentrum
 *
 * Controller-klasse met alle methoden die worden gebruikt om pagina's te tonen over het trainingscentrum.
 */
class Trainingscentrum extends CI_Controller {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper('notation');
        $this->load->helper('form');
    }

    /**
     * Weergeven van Over_ons
     * @see Authex::getGebruikerInfo()
     * @see Trainingscentrum_model::get()
     * @see over_ons.php
     */
    public function index() {
        $data['titel'] = 'Over ons';
        $data['paginaVerantwoordelijke'] = 'Florian D\'Haene';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $this->load->model('trainingscentrum_model');
        $data['trainingscentrum'] = $this->trainingscentrum_model->get();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'over_ons',
            'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }

    /**
     * Weergeven van Over_ons_aanpassen
     * @see Authex::getGebruikerInfo()
     * @see Trainingscentrum_model::get()
     * @see over_ons_aanpassen.php
     */
    public function aanpassen() {
        $data['titel'] = 'Aanpassen info';
        $data['paginaVerantwoordelijke'] = 'Florian D\'Haene';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $this->load->model('trainingscentrum_model');
        $data['trainingscentrum'] = $this->trainingscentrum_model->get();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'over_ons_aanpassen',
            'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }

     /**
     * Toont een formulier met alle gegevens ingevuld van het gekoze nieuwsartikel.
     * @see trainingscentrum_model::get()
     * @see trainingscentrum_model::update()
     */
    public function registreer() {
        $trainingscentrum = new stdClass();
        $trainingscentrum->id = 1;
        $trainingscentrum->beschrijvingWelkom = $this->input->post('beschrijvingWelkom');
        $trainingscentrum->beschrijvingLocatie = $this->input->post('beschrijvingLocatie');
        $trainingscentrum->beschrijvingTeam = $this->input->post('beschrijvingTeam');
        $trainingscentrum->beschrijvingTrainer = $this->input->post('beschrijvingTrainer');

        $config['upload_path']          = './uploads/info';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';


        $this->load->library('upload', $config);
        $this->load->model('trainingscentrum_model');
        if($this->upload->do_upload('locatie')){
          $upload_data = $this->upload->data();
          $oudTrainingscentrum = $this->trainingscentrum_model->get(1);
          $this->load->helper("file");
          unlink('uploads/info/' . $oudTrainingscentrum->fotoLocatie);
          $trainingscentrum->fotoLocatie = $upload_data['file_name'];
        }
        if($this->upload->do_upload('team')){
          $upload_data = $this->upload->data();
          $oudTrainingscentrum = $this->trainingscentrum_model->get(1);
          $this->load->helper("file");
          unlink('uploads/info/' . $oudTrainingscentrum->fotoTeam);
          $trainingscentrum->fotoTeam = $upload_data['file_name'];
        }
        if($this->upload->do_upload('trainer')){
          $upload_data = $this->upload->data();
          $oudTrainingscentrum = $this->trainingscentrum_model->get(1);
          $this->load->helper("file");
          unlink('uploads/info/' . $oudTrainingscentrum->fotoTrainer);
          $trainingscentrum->fotoTrainer = $upload_data['file_name'];
        }
        if($this->upload->do_upload('welkom')){
          $upload_data = $this->upload->data();
          $oudTrainingscentrum = $this->trainingscentrum_model->get(1);
          $this->load->helper("file");
          unlink('uploads/info/' . $oudTrainingscentrum->fotoWelkom);
          $trainingscentrum->fotoWelkom = $upload_data['file_name'];
        }

        $this->load->model('trainingscentrum_model');
        $this->trainingscentrum_model->update($trainingscentrum);

        redirect("trainingscentrum/aanpassen");
    }

}
