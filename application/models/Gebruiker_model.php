<?php

class Gebruiker_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('notation');
        $this->load->helper('date');
    }

    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('gebruiker');
	      return $query->row();
    }

    public function getGebruiker($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('gebruiker');

        if ($query->num_rows() == 1) {
            $gebruiker = $query->row();
                return $gebruiker;
        } else {
            return null;
        }
    }

    public function getGebruikerMetWachtwoord($email, $wachtwoord)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('gebruiker');

        if ($query->num_rows() == 1) {
            $gebruiker = $query->row();
            if (password_verify($wachtwoord, $gebruiker->wachtwoord)) {
                return $gebruiker;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    function controleerEmailVrij($email) {
        // is email al dan niet aanwezig
        $this->db->where('email', $email);
        $query = $this->db->get('gebruiker');

        if ($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insert($gebruiker)
    {
      $this->db->insert('gebruiker', $gebruiker);
      return $this->db->insert_id();
    }

    public function update($gebruiker)
    {
      $this->db->where('id', $gebruiker->id);
      $this->db->update('gebruiker', $gebruiker);
    }

    public function toonZwemmers() {
        $this->db->where('soort', 'zwemmer');
        $this->db->where('status', '1');
        $query = $this->db->get('gebruiker');
        return $query->result();
    }

    function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('gebruiker');
    }

    public function toonInactieveZwemmers() {
        $this->db->where('soort', 'zwemmer');
        $this->db->where('status', '0');
        $query = $this->db->get('gebruiker');
        return $query->result();
    }

}
