<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @class Trainingscentrum
 * @brief Controller-klasse voor Trainingscentrum
 *
 * Model-klasse met alle methoden die worden gebruikt om pagina's te tonen over het trainingscentrum.
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
     * \see Authex::getGebruikerInfo()
     * \see Trainingscentrum_model::get()
     * \see over_ons.php
     */
    public function index() {
        $data['titel'] = 'Over ons';
        $data['paginaVerantwoordelijke'] = '';
        $data['gebruiker'] = $this->authex->getGebruikerInfo();

        $this->load->model('trainingscentrum_model');
        $data['trainingscentrum'] = $this->trainingscentrum_model->get();

        $partials = array('hoofding' => 'main_header',
            'inhoud' => 'over_ons',
            'voetnoot' => 'main_footer');

        $this->template->load('main_master', $partials, $data);
    }

}
