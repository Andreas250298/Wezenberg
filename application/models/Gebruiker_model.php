<?php

class Gebruiker_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('gebruiker');
		return $query->row();
    }

    public function getGebruiker($email, $wachtwoord)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('gebruiker');

        if ($query->num_rows() == 1) {
            $gebruiker = $query->row();
            if ($wachtwoord == $gebruiker->wachtwoord) {
                return $gebruiker;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function voegToe($email, $wachtwoord, $naam, $address, $woonplaats, $soort)
    {
        $gebruiker = new stdClass();
        $gebruiker->naam = $naam;
        $gebruiker->address = $address;
        $gebruiker->woonplaats = $woonplaats;
        $gebruiker->soort = $soort;
        $gebruiker->email = $email;
        $gebruiker->wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
        $this->db->insert('Gebruiker', $gebruiker);
        return $this->db->insert_id();
    }
}
