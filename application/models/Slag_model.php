<?php
/**
 * @class Slag_model
 * @brief Model-klasse voor slagen
 *
 * Model-klasse die alle methodes bevat om te interageren met de slag tabel
 */
class Slag_model extends CI_Model
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Een slag ophalen uit de database
     * @param id Het id van de reeks waar de slag aan gekoppeld is
     * @return De opgevraagde record
     */
    public function get($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('slag');
        return $query->row();
    }

    /**
     * Een afstanden ophalen uit de database voor een keuzenlijst
     * @return Alle bestaande afstanden uit de database
     */
    public function getAllSlagen()
    {
        $query = $this->db->get('slag');
        return $query->result();
    }
}
