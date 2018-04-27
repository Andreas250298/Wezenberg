<?php

/**
 * @class Afstand_model
 * @brief Model-klasse voor afstanden
 *
 * Model-klasse die alle methodes bevat om te interageren met de afstand tabel
 */
class Afstand_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Een afstand ophalen uit de database
     * @param $id Het id van de reeks waar de slag aan gekoppeld is
     * @return De opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('afstand');
        return $query->row();
    }

    public function getAllAfstanden()
    {
        $query = $this->db->get('afstand');
        return $query->result();
    }
}
