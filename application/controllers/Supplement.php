<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Supplement extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
    }

    public function index()
    {
        $data['titel'] = 'Supplement bekijken';
        $data['gebruiker']  = $this->authex->getGebruikerInfo();
        $this->load->model('supplement_model');
        $data['supplementen'] = $this->supplement_model->toonSupplementen();

        $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Supplement/bekijken',
          'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function maakSupplement()
    {
        $data['titel'] = 'Supplementen aanmaken';
        $data['gebruiker']  = $this->authex->getGebruikerInfo();
        $data['supplement'] = null;
        $this->load->model('supplement_model');

        $partials = array('hoofding' => 'main_header',
         'inhoud' => 'Supplement/form',
         'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function registreer()
    {
        $supplement = new stdClass();
        $supplement->id = $this->input->post('id');
        $supplement->naam = $this->input->post('naam');
        $supplement->beschrijving = $this->input->post('beschrijving');

        $this->load->model('supplement_model');
        if ($supplement->id == null) {
            $this->supplement_model->insert($supplement);
        } else {
            $this->supplement_model->update($supplement);
        }
        
        redirect('/supplement/beheerSupplementen');
    }
    
    public function beheerSupplementen() {
        $data['titel'] = 'Supplementen beheren';
        $data['gebruiker']  = $this->authex->getGebruikerInfo();

      $this->load->model('supplement_model');
      $data['supplementen'] = $this->supplement_model->toonSupplementen();

      $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Supplement/beheren',
          'voetnoot' => 'main_footer');
      $this->template->load('main_master', $partials, $data);
    }
    
    public function wijzig($id) {
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $this->load->model('supplement_model');
        $data['supplement'] = $this->supplement_model->get($id);
        $data['titel'] = 'Supplementen wijzigen';

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'Supplement/form',
            'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }
    
    public function verwijder($id){
        $data['gebruiker'] = $this->authex->getGebruikerInfo();
        $this->load->model('supplement_model');
        $this->supplement_model->delete($id);
        
        redirect("/supplement/index");
    }
}
