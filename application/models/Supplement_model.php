<?php

/**
 * @class Supplement_model
 * @brief Model-klasse voor supplementen
 *
 * Model-klasse die alle methodes bevat om te interageren met de supplementen tabel
 */
class Supplement_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Een supplement ophalen uit de database
     * @param $id Het id van het supplement dat opgevraagd wordt
     * @return De opgevraagde records
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('supplement');
        return $query->row();
    }

    /**
     * Opvragen van supplementen uit de database
     * @return De opgevraagde records
     */
    public function toonSupplementen()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('supplement');
        return $query->result();
    }

    /**
    ** Opvragen van supplementen volgens id zwemmer
    * @param $id Het ID van de zwememr
    */
    public function toonSupplementenPerZemmer($id)
    {
        $this->db->where('gebruikerIdZwemmer', $id);
        $query = $this->db->get('supplementPerZwemmer');
    }

    /**
     * Een supplement toevoegen aan de database
     * @param $supplement Het supplement dat moet toegevoegd worden
     * @return De insert functie van het supplement
     */
    public function insert($supplement)
    {
        $this->db->insert('supplement', $supplement);
        return $this->db->insert_id();
    }

    /**
     * Een supplement wijzigen in de database
     * @param $supplement Het supplement dat moet gewijzigd worden
     */
    public function update($supplement)
    {
        $this->db->where('id', $supplement->id);
        $this->db->update('supplement', $supplement);
    }

    /**
     * Een supplement verwijderen uit de database
     * @param $id Het id van het supplement dat moet verwijderd worden
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('supplement');
    }
}
