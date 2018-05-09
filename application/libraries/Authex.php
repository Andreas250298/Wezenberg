<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
* @class Authex
* @brief Controller-klasse voor Authenticatie
*
* Controller-klasse met methodes die worden gebruikt voor Authenticatie van de gebruikers.
*/

class Authex {

  /**
   * Constructor
   */
    public function __construct() {
        $CI = & get_instance();

        $CI->load->model('gebruiker_model');
    }

    /**
     * Activeert een gebruiker.
     * @see gebruiker_model::activeer()
     */
    function activeer($id) {
        // nieuwe gebruiker activeren
        $CI = & get_instance();

        $CI->gebruiker_model->activeer($id);
    }

    /**
     * Geeft een gebruiker object als gebruiker aangemeld is.
     * @see gebruiker_model::get()
     */
    function getGebruikerInfo() {
        $CI = & get_instance();

        if (!$this->isAangemeld()) {
            return null;
        } else {
            $id = $CI->session->userdata('gebruiker_id');
            return $CI->gebruiker_model->get($id);
        }
    }
    /**
     * Controleert of een gebruiker aangemeld is.
     */
    function isAangemeld() {
        $CI = & get_instance();

        if ($CI->session->has_userdata('gebruiker_id')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Meldt een gebruiker aan met een opgegeven wachtwoord en email.
     * @see Gebruiker_model::getGebruiker();
     * @param email Email van de gebruiker.
     * @param wachtwoord Wachtwoord van de gebruiker.
     */
    function meldAan($email, $wachtwoord) {
        $CI = & get_instance();

        $gebruiker = $CI->gebruiker_model->getGebruiker($email, $wachtwoord);

        if ($gebruiker == null) {
            return false;
        } else {
            $CI->session->set_userdata('gebruiker_id', $gebruiker->id);
            return true;
        }
    }

    /**
     * Meldt de gebruiker af.
     */
    function meldAf() {
        $CI = & get_instance();

        $CI->session->unset_userdata('gebruiker_id');
    }

    /**
     * Voegt een nieuwe zwemmer toe met de ingegeven waarden.
     * @see gebruiker_model::voegToe()
     * @param email Email van de gebruiker.
     * @param wachtwoord Wachtwoord van de gebruiker.
     * @param naam Naam van de gebruiker.
     * @param adres Adres van de gebruiker.
     * @param woonplaats Woonplaats van de gebruiker.
     * @param soort Soort van de gebruiker.
     * @param geboortedatum Geboortedatum van de gebruiker.
     */
    function registreer($email, $wachtwoord, $naam, $adres, $woonplaats, $soort, $geboortedatum) {
        // nieuwe gebruiker registreren als email nog niet bestaat
        $CI = & get_instance();

        if ($CI->gebruiker_model->controleerEmailVrij($email)) {
            $id = $CI->gebruiker_model->voegToe($email, $wachtwoord, $naam, $adres, $woonplaats, $soort, $geboortedatum);
            return $id;
        } else {
            return 0;
        }
    }

    /**
     * Wijzigt de waarden van een bestaande gebruiker.
     * @see gebruiker_model::update()
     * @param email Email van de gebruiker.
     * @param wachtwoord Wachtwoord van de gebruiker.
     * @param naam Naam van de gebruiker.
     * @param adres Adres van de gebruiker.
     * @param woonplaats Woonplaats van de gebruiker.
     * @param soort Soort van de gebruiker.
     * @param geboortedatum Geboortedatum van de gebruiker.
     */
    function wijzig($email, $wachtwoord, $naam, $adres, $woonplaats, $soort, $geboortedatum) {
        // bestaande gebruiker updaten
        $CI = & get_instance();

        $CI->gebruiker_model->update($email, $wachtwoord, $naam, $adres, $woonplaats, $soort, $geboortedatum);
    }


}
