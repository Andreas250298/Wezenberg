<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Wedstrijd extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    public function index(){
      $data['titel'] = 'Wedstrijden bekijken';

      $this->load->model('wedstrijd_model');
      $data['wedstrijden'] = $this->wedstrijd_model->toonWedstrijden();

      $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Wedstrijd/bekijken',
          'voetnoot' => 'main_footer');
      $this->template->load('main_master', $partials, $data);
    }

    public function maakWedstrijd(){
      $data['titel'] = 'Wedstrijden aanmaken';

      $this->load->model('wedstrijd_model');

      $this->load->model('wedstrijd_model');
      $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Wedstrijd/maken',
          'voetnoot' => 'main_footer');
      $this->template->load('main_master', $partials, $data);
    }

    public function registreer() {
        $artikel = new stdClass();
        $wedstrijd->id = $this->input->post('id');
        $wedstrijd->plaats = $this->input->post('plaats');
        $wedstrijd->naam = $this->input->post('naam');
        $wedstrijd->beginDatum = $this->input->post('beginDatum');
        $wedstrijd->eindDatum = $this->input->post('eindDatum');
        $wedstrijd->laatsteInschrijvingDatum = $this->input->post('laatsteInschrijvingDatum');
        $wedstrijd->beschrijving = $this->input->post('beschrijving');

        $this->load->model('wedstrijd_model');
        if($wedstrijd->id == null) {
            $this->wedstrijd_model->insert($wedstrijd);
        }
        else {
            $this->wedstrijd_model->update($wedstrijd);
        }

        redirect('/wedstrijd/index');
    }

    public function updateWedstrijd($id){
      $data['titel'] = 'Wedstrijden wijzigen';
      $this->load->model('wedstrijd_model');
      $data['wedstrijd'] = $this->wedstrijd_model->get($id);

      $this->load->model('wedstrijd_model');
      $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Wedstrijd/beheren',
          'voetnoot' => 'main_footer');
      $this->template->load('main_master', $partials, $data);
    }


}
