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
        $data['paginaVerantwoordelijke'] = '';
        $data['titel'] = 'Supplement bekijken';

        $this->load->model('supplement_model');
        $data['supplementen'] = $this->supplement_model->toonSupplementen();

        $partials = array('hoofding' => 'main_header',
          'inhoud' => 'Supplement/bekijken',
          'voetnoot' => 'main_footer');
        $this->template->load('main_master', $partials, $data);
    }

    public function maakSupplement()
    {
        $data['paginaVerantwoordelijke'] = '';
        $data['titel'] = 'Supplementen aanmaken';

        $this->load->model('supplement_model');

        $partials = array('hoofding' => 'main_header',
         'inhoud' => 'Supplement/maken',
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
    }
}
