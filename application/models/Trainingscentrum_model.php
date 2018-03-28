<?php

/**
* @class Trainingscentrum_model
* @brief Model-klasse voor Trainingscentrum
*
* Model-klasse met alle methoden die worden gebruikt om te interageren met de database-tabel trainingscentrum.
*/
class Trainingscentrum_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Ophalen van alle data
     * @return alle opgevraagde data van trainingscentrum
    */
    public function get()
    {
        $this->db->where('id', 1);
        $query = $this->db->get('trainingscentrum');
        return $query->row();
    }
    
    /**
    * Het bewerken van alle data
    */
    public function update(){
        $this->db->where('id', 1);
        $this->db->update('beschrijvingWelkom', $beschrijvingWelkom);
    }
}
