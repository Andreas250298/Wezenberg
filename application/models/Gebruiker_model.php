<?php
/**
* @class Gebruiker_model
* @brief Model-klasse voor gebruikers
*
* Model-klasse die alle methodes bevat om te interageren met de gebruikers tabel.
*/
class Gebruiker_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('notation');
        $this->load->helper('date');
    }
    /**
     * Een gebruiker ophalen uit de database
     * @param id Het id van de reeks waar de gebruiker aan gekoppeld is
     * @return Het opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('gebruiker');
        return $query->row();
    }
    /**
     * Alle zwemmers ophalen uit de database
     * @return De opgevraagde record(s)
     */
    public function getAllZwemmers()
    {
        $this->db->where('soort', 'zwemmer');
        $query = $this->db->get('gebruiker');
        if ($query->num_rows() == 0) {
            return null;
        } else {
            return $query->result();
        }
    }

    /**
     * Alle trainers ophalen uit de database
     * @return De opgevraagde record(s)
     */
    public function getAllTrainers()
    {
        $this->db->where('soort', 'trainer');
        $query = $this->db->get('gebruiker');
        if ($query->num_rows() == 0) {
            return null;
        } else {
            return $query->result();
        }
    }
    /**
     * Een gebruiker ophalen uit de database
     * @param email Het email van een bepaalde gebruiker
     * @param wachtwoord Het wachtwoord van een bepaalde gebruiker
     * @return Het opgevraagde record
     */
    public function getGebruiker($email, $wachtwoord)
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

    /**
     * haalt alle actieve gebruikers terug uit de databank
     * @return gebruikers Alle actieve gebruikers uit de databank
     */
    public function getActieveGebruikers()
    {
        $this->db->where('status', '1');
        $query = $this->db->get('gebruiker');
        return $query->result();
    }

    /**
     * haalt alle actieve trainers terug uit de databank
     * @return trainers Alle actieve trainers uit de databank
     */
    public function getActieveTrainers()
    {
        $this->db->where('soort', 'trainer');
        $this->db->where('status', '1');
        $query = $this->db->get('gebruiker');
        return $query->result();
    }


    /**
     * Een gebruiker ophalen uit de database
     * @param email Het email van een bepaalde gebruiker
     * @param wachtwoord Het wachtwoord van een bepaalde gebruiker
     * @return Het opgevraagde record
     */

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
    /**
     * Controleert of een bepaalde email al gebruikt is
     * @param email Het email van een bepaalde gebruiker
     * @return true of false
     */
    public function controleerEmailVrij($email)
    {
        // is email al dan niet aanwezig
        $this->db->where('email', $email);
        $query = $this->db->get('gebruiker');

        if ($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * voegt een gebruiker toe aan de database
     * @param gebruiker te toe te voegen gebruiker
     * @return id het id van de toegevoegde gebruiker
     */
    public function insert($gebruiker)
    {
        $this->db->insert('gebruiker', $gebruiker);
        return $this->db->insert_id();
    }
    /**
     * past een gebruiker aan in de database
     * @param gebruiker te toe te voegen gebruiker
     */
    public function update($gebruiker)
    {
        $this->db->where('id', $gebruiker->id);
        $this->db->update('gebruiker', $gebruiker);
    }
    /**
     * haalt alle zwemmers terug uit de databank
     * @return zwemmers Alle zwemmers uit de databank
     */
    public function toonZwemmers()
    {
        $this->db->where('soort', 'zwemmer');
        $this->db->where('status', '1');
        $query = $this->db->get('gebruiker');
        return $query->result();
    }
    /**
     * verwijdert een bepaalde zwemmer
     * @param id Het id van de te verwijderen zwemmer
     */
    public function delete($id)
    {
        $this->db->where('gebruikerIdZwemmer', $id);
        $this->db->delete('supplementPerZwemmer');

        $this->db->where('gebruikerIdZwemmer', $id);
        $this->db->delete('activiteitPerGebruiker');

        $this->db->where('gebruikerId', $id);
        $this->db->delete('meldingPerGebruiker');

        $this->db->where('gebruikerIdZwemmer', $id);
        $this->db->delete('deelname');

        $this->db->where('id', $id);
        $this->db->delete('gebruiker');
    }
    /**
     * haalt alle inactieve zwemmers terug uit de databank
     * @return zwemmers Alle inactieve zwemmers uit de databank
     */
    public function toonInactieveZwemmers()
    {
        $this->db->where('soort', 'zwemmer');
        $this->db->where('status', '0');
        $query = $this->db->get('gebruiker');
        return $query->result();
    }
}
